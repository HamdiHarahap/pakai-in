<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductStockController extends Controller
{
    public function index(string $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $stocks = ProductStock::with('product')
            ->where('product_id', $product->id)
            ->get();

        return view('admin.product.stock.index', [
            'title' => 'Produk',
            'product' => $product,
            'data' => $stocks
        ]);
    }

    public function create(string $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $currentStocks = $product->stocks
            ->pluck('stock', 'size')
            ->toArray();

        return view('admin.product.stock.create', [
            'title' => 'Kelola Stok',
            'product' => $product,
            'currentStocks' => $currentStocks
        ]);
    }


    public function store(Request $request, string $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $request->validate([
            'stocks' => 'nullable|array',
            'stocks.*' => 'nullable|integer|min:0',
        ]);

        foreach (['S', 'M', 'L', 'XL'] as $size) {
            $stock = $request->stocks[$size] ?? null;

            if ($stock === null) {
                continue;
            }

            ProductStock::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'size' => $size,
                ],
                [
                    'stock' => $stock,
                ]
            );
        }

        Alert::success('Berhasil', 'Stok produk berhasil diperbarui');

        return redirect()->route('stock.index', ['slug' => $product->slug]);
    }

}
