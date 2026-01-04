<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function cartPage()
    {
        return view('admin.cart.index', [
            'title' => 'Keranjang',
            'data' => Cart::with('user')->get()
        ]);
    }

    public function cartItemsPage(String $id)
    {
        $data = Cart::with('items')->find($id);
        return view('admin.cart.items', [
            'title' => 'Keranjang',
            'data' => $data
        ]);
    } 

    public function orderPage()
    {
        return view('admin.order.index', [
            'title' => 'Pesanan',
            'data' => Order::with('user')->get()
        ]);
    }

    public function orderItemPage(String $order_code)
    {
        $data = Order::with('items')->where('order_code', $order_code)->first();
        return view('admin.order.items', [
            'title' => 'Pesanan',
            'data' => $data
        ]);
    } 
}
