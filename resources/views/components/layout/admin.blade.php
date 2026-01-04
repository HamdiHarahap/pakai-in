@props(['title'])
@php
    $role = auth()->user()->role;
@endphp
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800">
<div class="min-h-screen flex">
    <aside class="w-72 bg-white border-r border-slate-200 px-6 py-8 hidden md:flex flex-col">
        <div class="mb-12">
            <h1 class="text-2xl font-semibold tracking-tight text-slate-900">
                Pakai<span class="text-emerald-600">-in</span>
            </h1>
            <p class="text-xs text-slate-500 mt-1">
                Admin Dashboard
            </p>
        </div>
        <nav class="flex-1 space-y-6 text-sm">
            <div>
                <p class="px-3 mb-2 text-xs uppercase tracking-wider text-slate-400">
                    Menu Utama
                </p>
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                   {{ $title == 'Dashboard' ? 'bg-slate-100 text-slate-900 font-medium' : 'hover:bg-slate-100' }}">
                    Dashboard
                </a>
            </div>
            <div>
                <p class="px-3 mb-2 text-xs uppercase tracking-wider text-slate-400">
                    Master Data
                </p>
                <div class="space-y-1">
                    <a href="{{ route('category.index') }}"
                       class="block px-4 py-3 rounded-xl transition
                       {{ $title == 'Kategori' ? 'bg-slate-100 text-slate-900 font-medium' : 'hover:bg-slate-100' }}">
                        Kategori
                    </a>
                    <a href="{{ route('product.index') }}"
                       class="block px-4 py-3 rounded-xl transition
                       {{ $title == 'Produk' ? 'bg-slate-100 text-slate-900 font-medium' : 'hover:bg-slate-100' }}">
                        Produk
                    </a>
                    <a href="{{ route('user.index') }}"
                       class="block px-4 py-3 rounded-xl transition
                       {{ $title == 'Customer' ? 'bg-slate-100 text-slate-900 font-medium' : 'hover:bg-slate-100' }}">
                        Customer
                    </a>
                </div>
            </div>
            <div>
                <p class="px-3 mb-2 text-xs uppercase tracking-wider text-slate-400">
                    Transaksi
                </p>
                <div class="space-y-1">
                    <a href="{{ route('adminCart.index') }}"
                       class="block px-4 py-3 rounded-xl transition
                       {{ $title == 'Keranjang' ? 'bg-slate-100 text-slate-900 font-medium' : 'hover:bg-slate-100' }}">
                        Keranjang
                    </a>
                    <a href="{{ route('order.index') }}"
                       class="block px-4 py-3 rounded-xl transition
                       {{ $title == 'Pesanan' ? 'bg-slate-100 text-slate-900 font-medium' : 'hover:bg-slate-100' }}">
                        Pesanan
                    </a>
                </div>
            </div>
        </nav>
        <div class="pt-6 border-t border-slate-200 text-xs text-slate-400">
            © {{ date('Y') }} Pakai-in
        </div>
    </aside>
    <main class="flex-1 flex flex-col">
        <header class="bg-white border-b border-slate-200 px-8 py-4 flex items-center justify-between sticky top-0 z-20">
            <h2 class="text-lg font-semibold text-slate-900 hidden md:block">
                {{ $title }}
            </h2>
            <div class="relative" x-data="{ open: false }">
                <button
                    @click="open = !open"
                    class="flex items-center gap-3 bg-slate-100 hover:bg-slate-200 transition px-4 py-2 rounded-full"
                >
                    <div class="w-9 h-9 bg-emerald-600 text-white flex items-center justify-center rounded-full font-semibold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <span class="font-medium text-slate-700 hidden sm:block">
                        {{ auth()->user()->name }}
                    </span>
                </button>
                <div
                    x-show="open"
                    @click.away="open = false"
                    x-transition
                    class="absolute right-0 mt-3 w-48 bg-white border border-slate-200 shadow-xl rounded-xl py-2"
                >
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button
                            type="button"
                            onclick="confirmLogout()"
                            class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-slate-100"
                        >
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </header>
        <div class="flex-1">
            {{ $slot }}
        </div>
    </main>
</div>

@include('sweetalert::alert')

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
    function confirmLogout() {
        Swal.fire({
            title: 'Yakin ingin logout?',
            text: "Anda akan keluar dari dashboard",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Logout',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#059669'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }
</script>
</body>
</html>
