<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
}
