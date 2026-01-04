<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::with('items.product')
            ->where('user_id', Auth::user()->id)
            ->first();

        $subtotal = $cart ? $cart->items->sum(fn ($i) => $i->product->price * $i->qty) : 0;

        $shipping = 20000;
        $total = $subtotal + $shipping;
        $title = 'Keranjang';

        return view('user.cart.index', compact('cart','subtotal','shipping','total', 'title'));
    }

    public function add(Request $request, string $slug)
    {
        $request->validate([
            'size' => 'required|in:S,M,L,XL',
            'qty' => 'required|integer|min:1',
        ]);

        $product = Product::where('slug', $slug)->firstOrFail();

        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id()
        ]);

        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->where('size', $request->size)
            ->first();
            
        if ($item) {
            $item->qty += $request->qty;
            $item->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id'=> $product->id,
                'size' => $request->size,
                'qty' => $request->qty
            ]);
        }

        Alert::success('Berhasil', 'Produk berhasil ditambahkan ke keranjang');

        return back();
    }

}
