<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login', [
            'title' => 'Halaman Login'
        ]);
    }

    public function storeLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if(!$user || !Hash::check($request->input('password'), $user->password)) {
            return redirect()->route('login')->with('error', 'Email dan password tidak sesuai!');
        }

        Auth::login($user);

        if ($user->role == 'admin') {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('index');
        }
    }

    public function storeRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'confirm' => 'required|same:password' 
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer' 
        ]);

        Auth::login($user);

        if ($user->role == 'admin') {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('index');
        }
    }


    public function register()
    {
        return view('auth.register', [
            'title' => 'Halaman Register'
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
