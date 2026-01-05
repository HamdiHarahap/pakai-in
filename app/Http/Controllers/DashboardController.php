<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'title' => 'Dashboard',
            'countProduct' => Product::count(),
            'countCategory' => Category::count(),
            'countCustomer' => User::where('role', 'customer')->count(),
            'countOrder' => Order::count(),
            'lastOrders' => Order::with(['user', 'items'])->latest()->take(5)->get()
        ]);
    }
}
