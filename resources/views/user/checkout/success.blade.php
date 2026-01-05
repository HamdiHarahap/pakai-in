<x-layout.user :title="$title">
    <section class="max-w-xl mx-auto py-24 px-6 text-center">
        <div class="bg-white border border-slate-200 rounded-2xl p-10">
            <div class="flex justify-center mb-6">
                <div class="h-16 w-16 rounded-full bg-emerald-100 flex items-center justify-center">
                    <svg class="h-8 w-8 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
            </div>
            <h1 class="text-2xl font-semibold text-slate-900 mb-2">
                Pesanan Berhasil Dibuat 
            </h1>

            <p class="text-slate-600 mb-6">
                Terima kasih telah melakukan pemesanan.
            </p>
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 mb-6 text-sm text-left">
                <div class="flex justify-between mb-2">
                    <span class="text-slate-500">Order ID</span>
                    <span class="font-medium text-slate-900">
                        {{ $data->order_code }}
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Tanggal</span>
                    <span class="font-medium text-slate-900">
                        {{ $data->created_at->format('d M Y, H:i') }}
                    </span>
                </div>
            </div>
            <div class="text-left mb-6">
                <h2 class="text-sm font-medium text-slate-700 mb-3">
                    Detail Pesanan
                </h2>
                <div class="space-y-4">
                    @foreach ($data->items as $item)
                        <div class="flex gap-4 items-center">
                            <img
                                src="{{ asset('storage/' . $item->product->image) }}"
                                alt="{{ $item->product->name }}"
                                class="w-14 h-14 rounded-xl object-cover border"
                            >
                            <div class="flex-1">
                                <p class="font-medium text-slate-900 text-sm">
                                    {{ $item->product->name }}
                                </p>
                                <p class="text-xs text-slate-500">
                                    Size {{ $item->size }} • Qty {{ $item->qty }}
                                </p>
                            </div>
                            <p class="text-sm font-medium text-slate-900">
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="border-t border-slate-200 pt-4 mb-6 text-sm">
                <div class="flex justify-between font-semibold text-slate-900">
                    <span>Total Pembayaran</span>
                    <span>
                        Rp {{ number_format($data->total_price, 0, ',', '.') }}
                    </span>
                </div>
            </div>
            <p class="text-sm text-slate-500 mb-8">
                Untuk metode <strong>COD</strong>, pesanan akan segera diproses dan
                pembayaran dilakukan saat barang diterima.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('index') }}"
                    class="px-6 py-3 rounded-xl bg-slate-900 text-white
                        hover:bg-slate-800 transition">
                    Kembali ke Beranda
                </a>
                <a href="{{ route('myOrder.index') }}"
                    class="px-6 py-3 rounded-xl border border-slate-300
                        text-slate-700 hover:bg-slate-100 transition">
                    Lihat Pesanan Saya
                </a>
            </div>
        </div>
    </section>
</x-layout.user>
