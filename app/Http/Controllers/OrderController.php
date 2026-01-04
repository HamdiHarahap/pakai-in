<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class OrderController extends Controller
{
    public function __construct()
    {
        Config::$serverKey    = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = true;
        Config::$is3ds        = true;
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $cart = $user->cart;

        if (!$cart || $cart->items->count() === 0) {
            return back()->with('error', 'Keranjang kosong');
        }

        $request->validate([
            'address' => 'required|string',
            'payment_method' => 'required|in:transfer,cod',
        ]);

        $subtotal = $cart->items->sum(fn ($item) =>
            $item->product->price * $item->qty
        );

        $shippingPrice = 20000;
        $totalPrice = $subtotal + $shippingPrice;

        if($request->payment_method === 'cod') {
            $order = Order::create([
                'order_code' => 'ORD-' . strtoupper(Str::random(10)),
                'user_id' => $user->id,
                'total_price' => $totalPrice,
                'shipping_price' => $shippingPrice,
                'payment_method' => $request->payment_method,
                'payment_status' => 'paid',
                'order_status' => 'processing',
                'address' => $request->address,
            ]);
        } else {
            $order = Order::create([
                'order_code' => 'ORD-' . strtoupper(Str::random(10)),
                'user_id' => $user->id,
                'total_price' => $totalPrice,
                'shipping_price' => $shippingPrice,
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'order_status' => 'pending',
                'address' => $request->address,
            ]);
        }

        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'price' => $item->product->price,
                'size' => $item->size,
                'qty' => $item->qty,
                'subtotal' => $item->product->price * $item->qty,
            ]);

            $stokProd = ProductStock::where('product_id', $item->product_id)->where('size', $item->size)->first();
            $stokProd->stock -= $item->qty;

            $stokProd->save();
        }

        $cart->items()->delete();

        if ($request->payment_method === 'cod') {
            return redirect()
                ->route('order.success', $order->order_code)
                ->with('success', 'Pesanan COD berhasil dibuat');
        }

        return redirect()->route(
            'checkout.payment',
            $order->order_code
        );
    }


    public function payment($order_code)
    {
        $order = Order::where('order_code', $order_code)
            ->where('user_id', Auth::user()->id)
            ->firstOrFail();

        if ($order->payment_status === 'paid') {
            return redirect()->route('order.success', $order->order_code);
        }

        $params = [
            'transaction_details' => [
                'order_id' => $order->order_code,
                'gross_amount' => $order->total_price,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('user.checkout.payment', compact('order', 'snapToken'));
    }

}
