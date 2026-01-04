<x-layout.user title="Pesanan Berhasil">
    <section class="max-w-xl mx-auto py-24 text-center">
        <div class="bg-white border border-slate-200 rounded-2xl p-10">
            <div class="flex justify-center mb-6">
                <div class="h-16 w-16 rounded-full bg-green-100 flex items-center justify-center">
                    <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
            </div>

            <h1 class="text-2xl font-semibold text-slate-900 mb-2">
                Pesanan Berhasil Dibuat 🎉
            </h1>

            <p class="text-slate-600 mb-6">
                Terima kasih telah melakukan pemesanan.
            </p>

            <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 mb-6 text-left text-sm">
                <div class="flex justify-between mb-2">
                    <span class="text-slate-500">Order ID</span>
                    <span class="font-medium">{{ $order_code }}</span>
                </div>
            </div>

            <p class="text-sm text-slate-500 mb-8">
                Untuk metode <strong>COD</strong>, pesanan akan segera diproses dan
                pembayaran dilakukan saat barang diterima.
            </p>

            <div class="flex gap-4 justify-center">
                <a href="{{ route('index') }}"
                class="px-6 py-3 rounded-xl bg-slate-900 text-white hover:bg-slate-800 transition">
                    Kembali ke Beranda
                </a>

                <a href=""
                class="px-6 py-3 rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-100 transition">
                    Lihat Pesanan Saya
                </a>
            </div>
        </div>
    </section>
</x-layout.user>
