@php
    $user = auth()->user();
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-10">
                    <a href="{{ route('index') }}" class="text-2xl font-bold tracking-wide">Pakai<span class="text-emerald-600">-in</span></a>
                    <nav class="hidden md:flex space-x-4 text-sm font-medium">
                        <a href="{{ route('index') }}" class="hover:text-emerald-600">Beranda</a>
                        <a href="{{ route('collection.index') }}" class="hover:text-emerald-600">Koleksi</a>
                    </nav>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="{{ route('cart.index') }}">
                        <img src="{{ asset('/assets/icons/cart.svg') }}" alt="" class="w-5">
                    </a>
                    @if ($user)
                        <div class="relative">
                            <button id="userMenuButton" class="flex items-center space-x-2 text-sm font-semibold hover:text-emerald-600 focus:outline-none">
                                <span>Hai, {{$user->name}}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </button>   
                            <div id="userMenu" class="hidden absolute right-0 mt-3 w-48 bg-white rounded-xl shadow-lg border">
                                <a href="{{ route('myOrder.index') }}" class="block px-4 py-3 text-sm hover:bg-gray-100">Pesanan Saya</a>
                                <div class="border-t"></div>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button 
                                        type="button"
                                        onclick="confirmLogout()"
                                        class="w-full text-left text-sm px-4 py-2 text-red-600 hover:text-red-800"
                                    >
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="bg-emerald-600 text-white rounded-lg px-5 py-2 hover:bg-emerald-800 transition ease-in ">Masuk</a>
                    @endif
                </div>
            </div>
        </div>
    </header>

    <main>
        {{$slot}}
    </main>

    <footer class="bg-gray-900 text-gray-300">
        <div class="max-w-7xl mx-auto px-6 py-16 grid md:grid-cols-4 gap-10">
            <div>
                <h3 class="text-2xl font-bold text-white mb-4">Pakai-in</h3>
                <p class="text-sm">Brand fashion modern untuk seluruh keluarga.</p>
            </div>
            <div>
                <h4 class="font-semibold text-white mb-4">Navigasi</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white">Beranda</a></li>
                    <li><a href="#" class="hover:text-white">Produk</a></li>
                    <li><a href="#" class="hover:text-white">Tentang Kami</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold text-white mb-4">Bantuan</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white">FAQ</a></li>
                    <li><a href="#" class="hover:text-white">Kontak</a></li>
                    <li><a href="#" class="hover:text-white">Kebijakan</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold text-white mb-4">Ikuti Kami</h4>
                <p class="text-sm">Instagram · Facebook · TikTok</p>
            </div>
        </div>
        <div class="border-t border-gray-700 text-center py-6 text-sm">© 2026 Pakai-in. All rights reserved.</div>
    </footer>
    <script>
        const btn = document.getElementById('userMenuButton');
        const menu = document.getElementById('userMenu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        document.addEventListener('click', (e) => {
            if (!btn.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });

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
    @include('sweetalert::alert')
</body>
</html>
