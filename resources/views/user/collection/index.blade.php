<x-layout.user :title="$title">
    <section class="max-w-7xl mx-auto px-6 py-24">
        <div class="flex items-center justify-between mb-14">
            <p class="text-sm text-slate-600">
                {{ $data->count() }} Barang ditemukan
            </p>
            <div class="flex gap-6 text-sm">
                <a href="{{ route('collection.index') }}"
                class="{{ !$activeCategory ? 'text-slate-900 font-medium' : 'text-slate-500 hover:text-slate-900' }}">
                    Semua
                </a>
                <a href="{{ route('collection.index', ['category' => 'pria']) }}"
                class="{{ $activeCategory === 'pria' ? 'text-slate-900 font-medium' : 'text-slate-500 hover:text-slate-900' }}">
                    Pria
                </a>
                <a href="{{ route('collection.index', ['category' => 'wanita']) }}"
                class="{{ $activeCategory === 'wanita' ? 'text-slate-900 font-medium' : 'text-slate-500 hover:text-slate-900' }}">
                    Wanita
                </a>
                <a href="{{ route('collection.index', ['category' => 'anak']) }}"
                class="{{ $activeCategory === 'anak' ? 'text-slate-900 font-medium' : 'text-slate-500 hover:text-slate-900' }}">
                    Anak-anak
                </a>
            </div>
        </div>
        <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-x-10 gap-y-20">
            @forelse ($data as $item)
                <div class="group relative">
                    <a href="{{ route('collection.show', ['slug'=>$item->slug]) }}" class="block">
                        <img
                            src="{{ asset('storage/' . $item->image) }}"
                            alt="{{ $item->name }}"
                            class="w-full h-[360px] object-contain transition group-hover:scale-[1.03]"
                        />
                    </a>
                    <div class="mt-6 text-center">
                        <h3
                            class="text-sm uppercase tracking-wide text-slate-800 leading-snug line-clamp-2">
                            {{ $item->name }}
                        </h3>
                        <p class="mt-2 font-medium text-slate-900">
                            Rp {{ number_format($item->price, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            @empty
                <p class="text-slate-500">Produk tidak ditemukan.</p>
            @endforelse
        </div>
    </section>
</x-layout.user>
