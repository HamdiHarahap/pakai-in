<x-layout.admin :title="$title">
    <section class="p-6 md:p-10">
        <div class="mb-10 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-slate-900">
                    Data Item Keranjang Customer
                </h1>
                <p class="text-slate-600 mt-1">
                    Informasi item keranjang customer.
                </p>
            </div>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl overflow-x-auto">
            <table class="w-full text-sm text-left min-w-max">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr class="text-slate-600">
                        <th class="px-6 py-4 font-medium">No</th>
                        <th class="px-6 py-4 font-medium">Produk</th>
                        <th class="px-6 py-4 font-medium">Size</th>
                        <th class="px-6 py-4 font-medium">Qty</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @foreach ($data->items as $item)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 text-slate-500">
                                {{ $loop->iteration}}
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-900">
                                {{ $item->product->name }}
                            </td>
                            <td class="px-6 py-4 text-slate-700">
                                {{ $item->size }}
                            </td>
                            <td class="px-6 py-4 text-slate-700">
                                {{ $item->qty }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</x-layout.admin>
