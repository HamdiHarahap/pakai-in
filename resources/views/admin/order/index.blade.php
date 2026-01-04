<x-layout.admin :title="$title">
    <section class="p-6 md:p-10">
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-slate-900">Data Pesanan Customer</h1>
            <p class="text-slate-600 mt-1">
                Kelola seluruh pesanan customer di Pakai-in.
            </p>
        </div>

        <div class="overflow-x-auto bg-white border border-slate-200 rounded-2xl">
            <table class="w-full text-sm text-left min-w-max">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr class="text-slate-600">
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Kode</th>
                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4">Metode</th>
                        <th class="px-6 py-4">Status Bayar</th>
                        <th class="px-6 py-4">Status Pesan</th>
                        <th class="px-6 py-4">Alamat</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @foreach ($data as $item)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 text-slate-500">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 font-medium text-slate-900">{{ $item->order_code }}</td>
                            <td class="px-6 py-4 text-slate-700 truncate max-w-[180px]" title="{{ $item->user->email }}">
                                {{ $item->user->email }}
                            </td>
                            <td class="px-6 py-4 text-slate-700">{{ number_format($item->total_price,0,',','.') }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-block px-3 py-1 rounded-full text-sm font-medium
                                    {{ $item->payment_method === 'transfer' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $item->payment_method }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-block px-3 py-1 rounded-full text-sm font-medium
                                    {{ $item->payment_status === 'paid' ? 'bg-green-100 text-green-800' : ($item->payment_status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ $item->payment_status }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-block px-3 py-1 rounded-full text-sm font-medium
                                    {{ $item->order_status === 'completed' ? 'bg-green-100 text-green-800' : ($item->order_status === 'processing' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ $item->order_status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-700 truncate max-w-[200px]" title="{{ $item->address }}">
                                {{ $item->address }}
                            </td>
                            <td class="px-6 py-4 text-slate-700">{{ $item->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-sm font-medium">
                                <a href="{{ route('orderItem.index', ['order_code' => $item->order_code]) }}"
                                   class="text-emerald-600 hover:underline">
                                    Lihat
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</x-layout.admin>
