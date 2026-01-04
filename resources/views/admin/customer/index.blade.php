<x-layout.admin :title="$title">
    <section class="p-6 md:p-10">
        <div class="mb-10 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-slate-900">
                    Data Customer
                </h1>
                <p class="text-slate-600 mt-1">
                    Kelola seluruh customer yang tersedia di Pakai-in.
                </p>
            </div>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl overflow-x-auto">
            <table class="w-full text-sm text-left min-w-max">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr class="text-slate-600">
                        <th class="px-6 py-4 font-medium">No</th>
                        <th class="px-6 py-4 font-medium">Email</th>
                        <th class="px-6 py-4 font-medium">Jumlah Pemesanan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @foreach ($data as $index => $item)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 text-slate-600">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-900">
                                {{ $item->email }}
                            </td>
                            <td class="px-6 py-4 text-slate-600">
                                {{ $item->orders->count() }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</x-layout.admin>
