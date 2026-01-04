<x-layout.admin :title="$title">
    <section class="p-6 md:p-10">
        <div class="mb-10">
            <h1 class="text-2xl font-semibold text-slate-900">
                Kelola Stok Produk
            </h1>
            <p class="text-slate-600 mt-1">
                Atur ketersediaan stok untuk produk <span class="font-medium">{{ $product->name }}</span>.
            </p>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-8">
            <form
                method="POST"
                action="{{ route('stock.store', ['slug' => $product->slug]) }}"
                class="space-y-10"
            >
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @foreach (['S', 'M', 'L', 'XL'] as $size)
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">
                                Ukuran {{ $size }}
                            </label>
                            <input
                                type="number"
                                name="stocks[{{ $size }}]"
                                min="0"
                                value="{{ old("stocks.$size", $currentStocks[$size] ?? 0) }}"
                                class="w-full px-4 py-3 rounded-xl border border-slate-300
                                    focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500
                                    transition"
                                placeholder="0"
                            >
                        </div>
                    @endforeach
                </div>
                <div class="flex justify-end gap-4 pt-6 border-t border-slate-200">
                    <a
                        href="{{ route('stock.index', ['slug' => $product->slug]) }}"
                        class="px-5 py-2.5 rounded-full border border-slate-300
                            text-slate-700 font-medium hover:bg-slate-100 transition"
                    >
                        Batal
                    </a>
                    <button
                        type="submit"
                        class="px-6 py-2.5 rounded-full bg-emerald-600 text-white
                            font-medium hover:bg-emerald-700 transition"
                    >
                        Simpan Stok
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-layout.admin>
