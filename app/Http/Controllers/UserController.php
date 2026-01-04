<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.customer.index', [
            'title' => 'Customer',
            'data' => User::where('role', 'customer')->get()
        ]);
    }
}
