<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CartItemController extends Controller
{
    public function destroy(String $id)
    {
        $cartItem = CartItem::find($id);
        $cartItem->delete();

        Alert::success('Berhasil', 'Item berhasil dihapus');
        return back();
    }

}