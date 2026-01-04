<x-layout.admin :title="$title">
    <section class="p-6 md:p-10">
        @if (session('success'))
            <div 
                id="alert-success"
                class="fixed top-6 right-6 z-50 bg-emerald-600 text-white px-5 py-3 rounded-xl shadow-lg"
            >
                {{ session('success') }}
            </div>
        @endif
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-semibold text-slate-900">
                    Data Kategori
                </h1>
                <p class="text-sm text-slate-500 mt-1">
                    Kelola kategori produk yang tersedia di Pakai-in
                </p>
            </div>
            <a href="{{ route('category.create') }}"
            class="inline-flex items-center gap-2 px-5 py-3
            bg-emerald-600 text-white rounded-full
            hover:bg-emerald-700 transition font-medium text-sm"
            >
                + Tambah Kategori
            </a>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 text-left font-medium text-slate-600 w-16">
                            No
                        </th>
                        <th class="px-6 py-4 text-left font-medium text-slate-600">
                            Nama Kategori
                        </th>
                        <th class="px-6 py-4 text-left font-medium text-slate-600">
                            Slug
                        </th>
                        <th class="px-6 py-4 text-right font-medium text-slate-600 w-32">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($data as $index => $item)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 text-slate-500">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-900">
                                {{ $item->name }}
                            </td>
                            <td class="px-6 py-4 text-slate-600">
                                {{ $item->slug }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-4 text-sm font-medium">
                                    <a
                                        href="{{ route('category.edit', ['id' => $item->id]) }}"
                                        class="text-emerald-600 hover:underline"
                                    >
                                        Edit
                                    </a>
                                    <form
                                        id="delete-form-{{ $item->id }}"
                                        method="POST"
                                        action="{{ route('category.destroy', ['id' => $item->id]) }}"
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
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-slate-500">
                                Belum ada kategori yang tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data kategori akan dihapus permanen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#dc2626'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
</x-layout.admin>
