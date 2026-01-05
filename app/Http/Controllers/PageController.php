<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $categorySlug = $request->query('category');
        $categoryQuery = Product::with('category');

        if ($categorySlug) {
            $categoryQuery->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        return view('user.index', [
            'title' => 'Beranda',
            'new' => Product::latest()->limit(2)->get(),
            'popular' => Product::limit(4)->get(),
            'category' => $categoryQuery->limit(3)->get(),
            'activeCategory' => $categorySlug
        ]);
    }

    public function collectionPage(Request $request)
    {
        $categorySlug = $request->query('category');

        $query = Product::with('category');

        if ($categorySlug) {
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        return view('user.collection.index', [
            'title' => 'Semua Koleksi',
            'data' => $query->get(),
            'activeCategory' => $categorySlug
        ]);
    }

    public function show(string $slug)
    {
        $product = Product::with(['category', 'stocks'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('user.collection.show', [
            'title' => $product->name,
            'product' => $product
        ]);
    }

    public function cartPage()
    {
        return view('user.cart.index', [
            'title' => 'Keranjang',
        ]);
    }

    public function orderPage()
    {
        $data = Order::with(['items', 'user'])
            ->where('user_id', Auth::user()->id)
            ->orderBy('payment_status')     
            ->orderByDesc('created_at')     
            ->get();

        return view('user.order.index', [
            'title' => 'Pesanan Saya',
            'data' => $data
        ]);
    }
}
