<x-layout.admin :title="$title">
    <section class="p-6 md:p-10">
        <div class="mb-10">
            <h1 class="text-2xl font-semibold text-slate-900">
                Tambah Produk
            </h1>
            <p class="text-slate-600 mt-1">
                Tambahkan produk baru untuk ditampilkan di toko Pakai-in.
            </p>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-8">
            <form 
                method="POST"
                action="{{ route('product.store') }}"
                enctype="multipart/form-data"
                class="space-y-8"
            >
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Nama Produk
                    </label>
                    <input
                        type="text"
                        name="name"
                        class="w-full px-4 py-3 rounded-xl border border-slate-300
                            focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500
                            transition"
                        placeholder="Contoh: Kaos Basic Oversize"
                        required
                    >
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Slug
                    </label>
                    <input
                        type="text"
                        id="slug"
                        name="slug"
                        readonly
                        class="w-full px-4 py-3 rounded-xl border border-slate-300
                            bg-slate-100 text-slate-600 cursor-not-allowed"
                        placeholder="Slug akan dibuat otomatis"
                    >
                    <p class="text-xs text-slate-500 mt-2">
                        Digunakan untuk URL produk.
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Kategori Produk
                    </label>
                    <select
                        name="category_id"
                        class="w-full px-4 py-3 rounded-xl border border-slate-300
                            focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500
                            transition bg-white"
                        required
                    >
                        <option value="">— Pilih Kategori —</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Deskripsi Produk
                    </label>
                    <textarea
                        name="description"
                        rows="4"
                        class="w-full px-4 py-3 rounded-xl border border-slate-300
                            focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500
                            transition"
                        placeholder="Deskripsi singkat mengenai produk"
                    ></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Harga
                    </label>
                    <input
                        type="number"
                        name="price"
                        class="w-full px-4 py-3 rounded-xl border border-slate-300
                            focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500
                            transition"
                        placeholder="Contoh: 150000"
                        required
                    >
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Gambar Produk
                    </label>
                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept="image/*"
                        class="w-full px-4 py-3 rounded-xl border border-slate-300
                            focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500
                            transition"
                        onchange="previewImage(event)"
                        required
                    >
                    <p class="text-xs text-slate-500 mt-2">
                        Format JPG, JPEG, atau PNG.
                    </p>

                    <img
                        id="image-preview"
                        class="mt-4 w-40 h-40 object-cover rounded-xl border border-slate-200 hidden"
                        alt="Preview Gambar"
                    />
                </div>
                <div class="flex justify-end gap-4 pt-6 border-t border-slate-200">
                    <a
                        href="{{ route('product.index') }}"
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
                        Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </section>
    <script>
        const nameInput = document.querySelector('input[name="name"]');
        const slugInput = document.getElementById('slug');

        nameInput.addEventListener('input', function () {
            slugInput.value = this.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
        });

        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('image-preview');

            if (!file) {
                preview.classList.add('hidden');
                return;
            }

            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    </script>
</x-layout.admin>
