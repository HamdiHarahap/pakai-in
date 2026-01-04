<x-layout.admin :title="$title">
    <section class="p-6 md:p-10">
        <div class="mb-10">
            <h1 class="text-2xl font-semibold text-slate-900">
                Edit Kategori
            </h1>
            <p class="text-slate-600 mt-1">
                Perbarui informasi kategori yang sudah ada.
            </p>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-8">
            <form
                method="POST"
                action="{{ route('category.update', ['id' => $category->id]) }}"
                class="space-y-8"
            >
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Nama Kategori
                    </label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $category->name) }}"
                        class="w-full px-4 py-3 rounded-xl border border-slate-300
                            focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500
                            transition"
                        placeholder="Contoh: Pria, Wanita, Anak"
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
                        value="{{ old('slug', $category->slug) }}"
                        class="w-full px-4 py-3 rounded-xl border border-slate-300
                            bg-slate-100 text-slate-600 cursor-not-allowed"
                        readonly
                    >
                    <p class="text-xs text-slate-500 mt-2">
                        Digunakan untuk URL dan identifikasi kategori.
                    </p>
                </div>
                <div class="flex justify-end gap-4 pt-6 border-t border-slate-200">
                    <a
                        href="{{ route('category.index') }}"
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
                        Update Kategori
                    </button>
                </div>
            </form>
        </div>
    </section>
    <script>
        const nameInput = document.querySelector('input[name="name"]');
        const slugInput = document.querySelector('#slug');

        nameInput.addEventListener('input', function () {
            slugInput.value = this.value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
        });
    </script>
</x-layout.admin>
