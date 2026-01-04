<x-layout.admin :title="$title">
    <section class="p-6 md:p-10">
        <div class="mb-10 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-slate-900">
                    Data Produk
                </h1>
                <p class="text-slate-600 mt-1">
                    Kelola seluruh produk yang tersedia di Pakai-in.
                </p>
            </div>
            <a
                href="{{ route('product.create') }}"
                class="px-6 py-2.5 rounded-full bg-emerald-600 text-white
                    font-medium hover:bg-emerald-700 transition"
            >
                + Tambah Produk
            </a>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl overflow-x-auto">
            <table class="w-full text-sm text-left min-w-max">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr class="text-slate-600">
                        <th class="px-6 py-4 font-medium">No</th>
                        <th class="px-6 py-4 font-medium">Produk</th>
                        <th class="px-6 py-4 font-medium">Kategori</th>
                        <th class="px-6 py-4 font-medium">Harga</th>
                        <th class="px-6 py-4 font-medium">Gambar</th>
                        <th class="px-6 py-4 font-medium text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @foreach ($data as $index => $item)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 text-slate-600">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-slate-900">
                                    {{ $item->name }}
                                </p>
                                <p class="text-xs text-slate-500 mt-1">
                                    {{ $item->slug }}
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $category = $item->category->name ?? '-';
                                    $badgeColor = match($category) {
                                        'Pria' => 'bg-blue-100 text-blue-800',
                                        'Wanita' => 'bg-pink-100 text-pink-800',
                                        'Anak-anak' => 'bg-green-100 text-green-800',
                                        default => 'bg-gray-100 text-gray-800'
                                    };
                                @endphp
                                <span class="inline-block px-3 py-1 rounded-full text-sm font-medium {{ $badgeColor }}">
                                    {{ $category }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-900 font-medium">
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                <img
                                    src="{{ asset('storage/' . $item->image) }}"
                                    alt="{{ $item->name }}"
                                    class="w-14 h-14 object-cover rounded-xl border border-slate-200"
                                >
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-4 text-sm font-medium">
                                    <a
                                        href="{{ route('product.edit', ['slug' => $item->slug]) }}"
                                        class="text-emerald-600 hover:underline"
                                    >
                                        Edit
                                    </a>
                                    <a
                                        href="{{ route('stock.index', ['slug' => $item->slug]) }}"
                                        class="text-amber-600 hover:underline"
                                    >
                                        Stok
                                    </a>
                                    <form
                                        id="delete-form-{{ $item->id }}"
                                        method="POST"
                                        action="{{ route('product.destroy', ['slug' => $item->slug]) }}"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="button"
                                            onclick="confirmDelete({{ $item->id }})"
                                            class="text-red-600 hover:underline"
                                        >
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus produk?',
                text: 'Produk akan dihapus secara permanen.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#dc2626'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        }
    </script>
</x-layout.admin>
