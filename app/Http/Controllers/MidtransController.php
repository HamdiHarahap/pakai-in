<?php

namespace App\Http\Controllers;

use Midtrans\Config;
use App\Models\Order;
use Midtrans\Notification;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
    }

    public function notification(Request $request)
    {
        $payload = $request->all();

        $orderCode = $payload['order_id'] ?? null;
        $transactionStatus = $payload['transaction_status'] ?? null;
        $fraudStatus = $payload['fraud_status'] ?? null;

        if (!$orderCode) {
            return response()->json(['message' => 'Invalid payload'], 400);
        }

        $order = Order::where('order_code', $orderCode)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        if ($transactionStatus === 'capture') {
            if ($fraudStatus === 'accept') {
                $this->markAsPaid($order);
            }
        } elseif ($transactionStatus === 'settlement') {
            $this->markAsPaid($order);
        } elseif ($transactionStatus === 'pending') {
            $order->update([
                'payment_status' => 'pending',
                'order_status' => 'pending',
            ]);
        } elseif (in_array($transactionStatus, ['deny', 'cancel', 'expire'])) {
            $order->update([
                'payment_status' => 'failed',
                'order_status' => 'cancelled',
            ]);
        }

        return response()->json(['status' => 'ok'], 200);
    }

    private function markAsPaid(Order $order)
    {
        if ($order->payment_status === 'paid') {
            return;
        }

        $order->update([
            'payment_status' => 'paid',
            'order_status'   => 'processing',
        ]);
    }
}
