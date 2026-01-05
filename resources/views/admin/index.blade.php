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
                    {{ $countProduct ?? 0 }}
                </h3>
            </div>
            <div class="bg-white border border-slate-200 rounded-2xl p-6 hover:shadow-md transition">
                <p class="text-sm text-slate-500">
                    Total Kategori
                </p>
                <h3 class="text-3xl font-semibold text-slate-900 mt-3">
                    {{ $countCategory ?? 0 }}
                </h3>
            </div>
            <div class="bg-white border border-slate-200 rounded-2xl p-6 hover:shadow-md transition">
                <p class="text-sm text-slate-500">
                    Total Customer
                </p>
                <h3 class="text-3xl font-semibold text-slate-900 mt-3">
                    {{ $countCustomer ?? 0 }}
                </h3>
            </div>
            <div class="bg-white border border-slate-200 rounded-2xl p-6 hover:shadow-md transition">
                <p class="text-sm text-slate-500">
                    Total Pesanan
                </p>
                <h3 class="text-3xl font-semibold text-slate-900 mt-3">
                    {{ $countOrder ?? 0 }}
                </h3>
            </div>
        </div>
        <div class="my-12 border-t border-slate-200"></div>
         <div>
            <h2 class="text-lg font-semibold text-slate-900 mb-4">
                Pesanan Terbaru
            </h2>

            <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
                @if ($lastOrders->count())
                    <table class="w-full text-sm">
                        <thead class="bg-slate-50 text-slate-600">
                            <tr>
                                <th class="px-6 py-4 text-left">Kode Order</th>
                                <th class="px-6 py-4 text-left">Customer</th>
                                <th class="px-6 py-4 text-left">Total Item</th>
                                <th class="px-6 py-4 text-left">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            @foreach ($lastOrders as $order)
                                <tr class="hover:bg-slate-50">
                                    <td class="px-6 py-4 font-medium text-slate-900">
                                        {{ $order->order_code }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $order->user->name ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $order->items->count() }} item
                                    </td>
                                    <td class="px-6 py-4 text-slate-500">
                                        {{ $order->created_at->format('d M Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="p-8 text-center text-slate-500">
                        Belum ada pesanan terbaru
                    </div>
                @endif
            </div>
        </div>
    </section>
</x-layout.admin>
