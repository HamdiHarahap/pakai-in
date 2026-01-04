<x-layout.admin :title="$title">
    <section class="p-6 md:p-10">
        <div class="mb-10 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-slate-900">
                    Data Keranjang Customer
                </h1>
                <p class="text-slate-600 mt-1">
                    Kelola seluruh keranjang customer yang tersedia di Pakai-in.
                </p>
            </div>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl overflow-x-auto">
            <table class="w-full text-sm text-left min-w-max">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr class="text-slate-600">
                        <th class="px-6 py-4 font-medium">No</th>
                        <th class="px-6 py-4 font-medium">Customer</th>
                        <th class="px-6 py-4 font-medium">Jumlah Item</th>
                        <th class="px-6 py-4 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @foreach ($data as $index => $item)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 text-slate-600">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-900">
                                {{ $item->user->email }}
                            </td>
                            <td class="px-6 py-4 text-slate-600">
                                {{ $item->items->count() }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium"">
                                <a
                                    href="{{ route('adminCartItems.index', ['id' => $item->id]) }}"
                                    class="text-emerald-600 hover:underline"
                                >
                                    Lihat item
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</x-layout.admin>
