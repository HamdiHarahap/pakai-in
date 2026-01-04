<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.product.index', [
            'title' => 'Produk',
            'data' => Product::all()
        ]);
    }

    public function create()
    {
        return view('admin.product.create', [
            'title' => 'Produk',
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request) 
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:products,slug',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpg,jpeg,png',
            'category_id' => 'required|exists:categories,id',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product = Product::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        $sizes = ['S', 'M', 'L', 'XL'];

        foreach ($sizes as $size) {
            ProductStock::create([
                'product_id' => $product->id,
                'size' => $size,
                'stock' => 0
            ]);
        }

        Alert::success('Berhasil', 'Produk berhasil ditambahkan');

        return redirect()->route('product.index');
    }

    public function edit(String $slug)
    {
        return view('admin.product.edit', [
            'title' => 'Produk',
            'data' => Product::where('slug', $slug)->firstOrFail(),
            'categories' => Category::all()
        ]);
    }

    public function destroy(String $slug)
    {
        $data = Product::where('slug', $slug)->first();
        $data->delete();

        Alert::success('Berhasil', 'Produk berhasil dihapus');

        return redirect()->route('product.index');
    }
}
