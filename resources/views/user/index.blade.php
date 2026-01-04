<x-layout.user :title="$title">
    <section class="bg-[linear-gradient(135deg,#047857,#10b981)] text-white min-h-screen flex items-center">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <span class="inline-block mb-6 text-sm tracking-widest uppercase text-white/80">
                Koleksi Fashion 2025
            </span>
            <h1 class="text-4xl md:text-6xl font-semibold leading-tight mb-8">
                Tampil Percaya Diri<br class="hidden md:block">
                dengan Gaya Terbaikmu
            </h1>
            <p class="text-lg md:text-xl text-white/90 max-w-2xl mx-auto mb-12">
                Koleksi fashion modern untuk pria, wanita, dan anak-anak.
                Nyaman dipakai, mudah dipadukan, dan siap menemani
                setiap aktivitas harianmu.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-5">
                <a href="#"
                class="bg-white text-emerald-700 px-10 py-4 rounded-xl font-medium
                        hover:bg-slate-100 transition shadow-lg">
                    Mulai Belanja
                </a>
                <a href="{{ route('collection.index') }}"
                class="border border-white px-10 py-4 rounded-xl font-medium
                        hover:bg-white hover:text-emerald-700 transition">
                    Jelajahi Koleksi
                </a>
            </div>
        </div>
    </section>
    <section class="max-w-7xl mx-auto px-6 py-28">
        <div class="grid md:grid-cols-3 gap-12 items-center">
            <div>
                <h2 class="text-4xl font-semibold text-slate-900 leading-tight">
                    Koleksi<br>Terbaru
                </h2>
                <p class="text-slate-600 mt-4 max-w-sm">
                    Koleksi Musim Panas 2025 yang dirancang
                    untuk gaya kasual modern.
                </p>
                <a href="#" class="inline-flex items-center mt-8 text-sm font-medium border border-slate-900 px-6 py-3 hover:bg-slate-900 hover:text-white transition">
                    Lihat Produk →
                </a>
            </div>
            <div class="md:col-span-2 grid grid-cols-2 gap-6">
                @foreach ($new as $item)
                    <img class="rounded-xl h-80 w-full object-cover" src="{{ asset('storage/' . $item->image) }}">
                @endforeach
            </div>
        </div>
    </section>
    <section class="bg-slate-50 py-24">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between mb-12">
                <h2 class="text-2xl font-semibold text-slate-900">
                    Produk Populer
                </h2>
                <a href="{{ route('collection.index') }}" class="text-sm text-slate-600 hover:text-slate-900">
                    Lihat Semua
                </a>
            </div>
            <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-8">
                @foreach ($popular->take(4) as $item)
                    <a href="{{ route('collection.show', ['slug'=>$item->slug]) }}" class="group">
                        <img class="rounded-lg h-72 w-full object-cover group-hover:scale-[1.03] transition"
                        src="{{ asset('storage/' . $item->image) }}">
                        <p class="mt-4 text-sm text-slate-700">
                           {{$item->name}}
                        </p>
                        <p class="text-slate-900 font-medium">
                            Rp {{number_format($item->price,0,',','.')}}
                        </p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    <section id="koleksi" class="max-w-7xl mx-auto px-6 py-28">
        <div class="flex items-center justify-between mb-10">
            <h2 class="text-3xl font-semibold text-slate-900">
                Koleksi 2025
            </h2>
            <div class="flex gap-5 text-sm">
                <a href="{{ route('index') }}#koleksi"
                class="{{ !$activeCategory ? 'text-slate-900 font-medium' : 'text-slate-500 hover:text-slate-900' }}">
                    Semua
                </a>

                <a href="{{ route('index', ['category' => 'pria']) }}#koleksi"
                class="{{ $activeCategory === 'pria' ? 'text-slate-900 font-medium' : 'text-slate-500 hover:text-slate-900' }}">
                    Pria
                </a>

                <a href="{{ route('index', ['category' => 'wanita']) }}#koleksi"
                class="{{ $activeCategory === 'wanita' ? 'text-slate-900 font-medium' : 'text-slate-500 hover:text-slate-900' }}">
                    Wanita
                </a>

                <a href="{{ route('index', ['category' => 'anak']) }}#koleksi"
                class="{{ $activeCategory === 'anak' ? 'text-slate-900 font-medium' : 'text-slate-500 hover:text-slate-900' }}">
                    Anak
                </a>
            </div>

        </div>
        <div class="grid md:grid-cols-3 gap-10">
            @forelse ($category as $item)
                <img class="rounded-xl h-[420px] object-cover"
                    src="{{ asset('storage/' . $item->image) }}"
                    alt="{{ $item->name }}">
            @empty
                <p class="text-slate-500">Produk tidak ditemukan.</p>
            @endforelse
        </div>

    </section>
    <section class="bg-slate-900 text-white py-32">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-semibold mb-6">
                Filosofi Desain Kami
            </h2>
            <p class="text-slate-300 leading-relaxed max-w-3xl mx-auto">
                Pakai-in menghadirkan desain yang timeless,
                nyaman digunakan, dan dibuat dengan perhatian
                pada detail — untuk menunjang kepercayaan diri
                dalam setiap aktivitas.
            </p>
        </div>
    </section>
    <section class="bg-slate-50 py-32">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-20">
                <h2 class="text-3xl md:text-4xl font-semibold text-slate-900 mb-4">
                    Mengapa Memilih Pakai-in
                </h2>
                <p class="text-slate-600 max-w-2xl mx-auto leading-relaxed">
                    Setiap produk Pakai-in dirancang dengan perhatian terhadap detail,
                    kualitas material, dan kenyamanan, untuk mendukung gaya hidup
                    modern Anda setiap hari.
                </p>
            </div>
            <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-10">
                <div class="bg-white rounded-2xl p-8 text-center shadow-sm hover:shadow-lg transition">
                    <div class="w-14 h-14 mx-auto mb-6 flex items-center justify-center rounded-full bg-emerald-50">
                        <img src="{{ asset('/assets/icons/benang.svg') }}" alt="Bahan Berkualitas" class="w-7">
                    </div>
                    <h3 class="font-medium text-slate-900 mb-3">
                        Bahan Berkualitas
                    </h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Kami memilih material dengan standar tinggi agar setiap pakaian
                        terasa lembut, tahan lama, dan nyaman dikenakan sepanjang hari.
                    </p>
                </div>
                <div class="bg-white rounded-2xl p-8 text-center shadow-sm hover:shadow-lg transition">
                    <div class="w-14 h-14 mx-auto mb-6 flex items-center justify-center rounded-full bg-emerald-50">
                        <img src="{{ asset('/assets/icons/gunting.svg') }}" alt="Desain Fungsional" class="w-7">
                    </div>
                    <h3 class="font-medium text-slate-900 mb-3">
                        Desain Fungsional
                    </h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Potongan dirancang rapi, modern, dan mudah dipadukan dengan
                        berbagai gaya, dari kasual hingga semi-formal.
                    </p>
                </div>
                <div class="bg-white rounded-2xl p-8 text-center shadow-sm hover:shadow-lg transition">
                    <div class="w-14 h-14 mx-auto mb-6 flex items-center justify-center rounded-full bg-emerald-50">
                        <img src="{{ asset('/assets/icons/cotton.svg') }}" alt="Nyaman Dipakai" class="w-7">
                    </div>
                    <h3 class="font-medium text-slate-900 mb-3">
                        Nyaman Dipakai
                    </h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Ringan, breathable, dan fleksibel, sehingga pakaian Pakai-in
                        mendukung aktivitas Anda tanpa mengorbankan kenyamanan.
                    </p>
                </div>
                <div class="bg-white rounded-2xl p-8 text-center shadow-sm hover:shadow-lg transition">
                    <div class="w-14 h-14 mx-auto mb-6 flex items-center justify-center rounded-full bg-emerald-50">
                        <img src="{{ asset('/assets/icons/love.svg') }}" alt="Dipercaya Pelanggan" class="w-7">
                    </div>
                    <h3 class="font-medium text-slate-900 mb-3">
                        Dipercaya Pelanggan
                    </h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Dipilih dan digunakan oleh pelanggan di seluruh Indonesia
                        sebagai bagian dari gaya hidup sehari-hari mereka.
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-layout.user>
