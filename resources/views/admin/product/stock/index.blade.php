<x-layout.admin :title="$title">
    <section class="p-6 md:p-10 ">
        <div class="mb-10 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-slate-900">
                    Stok Produk
                </h1>
                <p class="text-slate-600 mt-1">
                    Informasi ketersediaan stok berdasarkan ukuran produk.
                </p>
            </div>
            <div class="">
                <a
                    href="{{ route('stock.create', ['slug' => $product->slug]) }}"
                    class="px-6 py-2.5 rounded-full bg-emerald-600 text-white
                        font-medium hover:bg-emerald-700 transition"
                >
                    Kelola Stok
                </a>
            </div>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 text-left font-medium text-slate-700">
                            Ukuran
                        </th>
                        <th class="px-6 py-4 text-left font-medium text-slate-700">
                            Jumlah Stok
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @foreach ($data as $item)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 font-medium text-slate-900">
                                {{ $item->size }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($item->stock > 0)
                                    <span class="text-slate-900 font-medium">
                                        {{ $item->stock }}
                                    </span>
                                @else
                                    <span class="text-red-500 font-medium">
                                        Habis
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</x-layout.admin>
