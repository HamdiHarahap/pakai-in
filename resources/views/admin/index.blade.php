@php
    $role = auth()->user()->role;
@endphp
<x-layout.admin :title="$title">
    <section class="p-6 md:p-10">
        <div class="mb-10">
            <h1 class="text-2xl font-semibold text-slate-900 mb-2">
                Selamat Datang
            </h1>
            <p class="text-slate-600">
                Ringkasan aktivitas toko Pakai-in.
            </p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white border border-slate-200 rounded-2xl p-6 hover:shadow-md transition">
                <p class="text-sm text-slate-500">
                    Total Produk
                </p>
                <h3 class="text-3xl font-semibold text-slate-900 mt-3">
                    {{ $totalProducts ?? 0 }}
                </h3>
            </div>
            <div class="bg-white border border-slate-200 rounded-2xl p-6 hover:shadow-md transition">
                <p class="text-sm text-slate-500">
                    Total Kategori
                </p>
                <h3 class="text-3xl font-semibold text-slate-900 mt-3">
                    {{ $totalCategories ?? 0 }}
                </h3>
            </div>
            <div class="bg-white border border-slate-200 rounded-2xl p-6 hover:shadow-md transition">
                <p class="text-sm text-slate-500">
                    Total Customer
                </p>
                <h3 class="text-3xl font-semibold text-slate-900 mt-3">
                    {{ $totalCustomers ?? 0 }}
                </h3>
            </div>
            <div class="bg-white border border-slate-200 rounded-2xl p-6 hover:shadow-md transition">
                <p class="text-sm text-slate-500">
                    Total Pesanan
                </p>
                <h3 class="text-3xl font-semibold text-slate-900 mt-3">
                    {{ $totalOrders ?? 0 }}
                </h3>
            </div>
        </div>
        <div class="my-12 border-t border-slate-200"></div>
        <div>
            <h2 class="text-lg font-medium text-slate-900 mb-4">
                Pesanan Terbaru
            </h2>
            <div class="bg-white border border-slate-200 rounded-2xl p-6 text-sm text-slate-500">
                Belum ada data pesanan terbaru.
            </div>
        </div>
    </section>
</x-layout.admin>
