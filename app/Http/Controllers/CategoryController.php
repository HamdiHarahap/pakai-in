<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index', [
            "title" => "Kategori",
            "data" => Category::all()
        ]);
    }

    public function create()
    {
        return view('admin.category.create', [
            'title' => 'Kategori',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:categories,slug',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        Alert::success('Berhasil', 'Kategori berhasil ditambahkan');

        return redirect()->route('category.index');
    }

    public function edit(string $id)
    {
        return view('admin.category.edit', [
            'title' => 'Edit Kategori',
            'category' => Category::find($id),
        ]);
    }

    public function update(Request $request, string $id)
    {
        $category = Category::find($id);

        $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        Alert::success('Berhasil', 'Kategori berhasil diperbarui');

        return redirect()->route('category.index');
    }

    public function destroy(String $id)
    {
        $data = Category::find($id);
        $data->delete();

        Alert::success('Berhasil', 'Kategori berhasil dihapus');

        return redirect()->route('category.index'); 
    }
}
