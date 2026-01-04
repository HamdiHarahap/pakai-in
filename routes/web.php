<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductStockController;

Route::get('/', [PageController::class, 'index'])->name('index');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'storeLogin'])->name('login.post');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'storeRegister'])->name('register.post');

Route::middleware('auth')->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/kategori', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/tambah-kategori', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/tambah-kategori', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/edit-kategori/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('/edit-kategori/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/kategori/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

        Route::get('/produk', [ProductController::class, 'index'])->name('product.index');
        Route::get('/tambah-produk', [ProductController::class, 'create'])->name('product.create');
        Route::post('/tambah-produk', [ProductController::class, 'store'])->name('product.store');
        Route::get('/edit-produk/{slug}', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/edit-produk/{slug}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/produk/{slug}', [ProductController::class, 'destroy'])->name('product.destroy');

        Route::get('/produk/{slug}/stok', [ProductStockController::class, 'index'])->name('stock.index');
        Route::get('/produk/{slug}/tambah-stok', [ProductStockController::class, 'create'])->name('stock.create');
        Route::post('/produk/{slug}/tambah-stok', [ProductStockController::class, 'store'])->name('stock.store');

        Route::get('/customer', [UserController::class, 'index'])->name('user.index');

        Route::get('/keranjang-customer', [AdminController::class, 'cartPage'])->name('adminCart.index');
        Route::get('/keranjang-customer/item/{id}', [AdminController::class, 'cartItemsPage'])->name('adminCartItems.index');

        Route::get('/pesanan', [AdminController::class, 'orderPage'])->name('order.index');
        Route::get('/pesanan/item/{order_code}', [AdminController::class, 'orderItemPage'])->name('orderItem.index');
    });

    Route::middleware('role:customer')->group(function () {
        Route::get('/koleksi', [PageController::class, 'collectionPage'])->name('collection.index');
        Route::get('/koleksi/{slug}', [PageController::class, 'show'])->name('collection.show');

        Route::post('/tambah-keranjang/{slug}', [CartController::class, 'add'])->name('cart.add');

        Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
        Route::delete('/keranjang/{id}', [CartItemController::class, 'destroy'])->name('item.destroy');

        Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
        Route::get('/checkout/payment/{order_code}', [OrderController::class, 'payment'])->name('checkout.payment');
        Route::get('/order/success/{order_code}', function ($order_code) {
            return view('user.checkout.success', compact('order_code'));
        })->name('order.success');
    });
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::post('/midtrans/notification',  [MidtransController::class, 'notification'])->name('midtrans.notification');