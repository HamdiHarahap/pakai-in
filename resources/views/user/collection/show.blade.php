<x-layout.user :title="$title">
    <section class="max-w-7xl mx-auto px-6 py-24">
        <p class="text-slate-600 leading-relaxed mb-10 text-sm">
            <a href="{{ route('collection.index') }}" class="hover:text-emerald-600 transition">
                Koleksi
            </a> 
            >
            <span class="text-emerald-600">{{ $product->name }}</span>
        </p>
        <div class="grid md:grid-cols-2 gap-20">
            <div class="bg-slate-50 rounded-3xl p-12 flex items-center justify-center">
                <img
                    src="{{ asset('storage/' . $product->image) }}"
                    alt="{{ $product->name }}"
                    class="max-w-md w-full object-contain"
                >
            </div>
            <div>
                <p class="text-sm text-slate-500 uppercase tracking-wide mb-2">
                    {{ $product->category->name }}
                </p>
                <h1 class="text-3xl md:text-4xl font-semibold text-slate-900 mb-6">
                    {{ $product->name }}
                </h1>
                <p class="text-2xl font-medium text-slate-900 mb-8">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </p>
                <p class="text-slate-600 leading-relaxed mb-10">
                    {{ $product->description }}
                </p>
                <form 
                    action="{{ route('cart.add', $product->slug) }}" 
                    method="POST"
                    class="space-y-8"
                >
                    @csrf
                    <div>
                        <label class="text-sm font-medium text-slate-900 mb-3">
                            Pilih Ukuran
                        </label>
                        <div class="relative">
                            <select
                                name="size"
                                required
                                class="
                                    w-full appearance-none rounded-2xl
                                    border border-slate-200
                                    bg-white px-4 py-3 pr-10 text-sm text-slate-900
                                    shadow-sm
                                    transition
                                    focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/20
                                    hover:border-slate-300
                                "
                            >
                                <option value="" disabled selected>
                                    Pilih ukuran
                                </option>
                                @foreach ($product->stocks as $stock)
                                    <option
                                        value="{{ $stock->size }}"
                                        {{ $stock->stock === 0 ? 'disabled' : '' }}
                                    >
                                        {{ $stock->size }}
                                        {{ $stock->stock === 0 ? ' — Habis' : '' }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-slate-400">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                        <p class="mt-2 text-xs text-slate-500">
                            Pilih ukuran sesuai ketersediaan stok
                        </p>
                    </div>
                    <div class="flex items-center gap-4">
                        <label class="text-sm font-medium text-slate-900">
                            Jumlah
                        </label>
                        <input
                            type="number"
                            name="qty"
                            min="1"
                            value="1"
                            class="w-20 border border-slate-300 rounded-lg px-3 py-2 text-sm"
                        >
                    </div>
                    <p class="text-sm text-slate-600">
                        Total stok tersedia:
                        <span class="font-medium text-slate-900">
                            {{ $product->stocks->sum('stock') }}
                        </span>
                    </p>
                    <button
                        type="submit"
                        class="w-full bg-emerald-600 text-white py-4 rounded-full
                        font-medium hover:bg-emerald-700 transition"
                    >
                        Tambah ke Keranjang
                    </button>
                </form>
            </div>
        </div>
    </section>
</x-layout.user>
