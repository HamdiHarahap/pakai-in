<x-layout.user :title="$title">
    <section class="max-w-7xl mx-auto px-6 py-24">
        <div class="grid lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2">
                <h1 class="text-3xl font-semibold text-slate-900 mb-8">
                    Keranjang Belanja
                </h1>
                @if($cart && $cart->items->count())
                    <div class="space-y-6">
                        @foreach ($cart->items as $item)
                            <div class="flex gap-6 border-b pb-6">
                                <img 
                                    src="{{ asset('storage/'.$item->product->image) }}"
                                    alt="{{ $item->product->name }}"
                                    class="w-28 h-36 object-cover rounded-xl bg-slate-100"
                                >
                                <div class="flex-1">
                                    <h3 class="font-medium text-slate-900">
                                        {{ $item->product->name }}
                                    </h3>
                                    <p class="text-sm text-slate-500 mt-1">
                                        Rp {{ number_format($item->product->price,0,',','.') }}
                                    </p>
                                    <p class="text-sm text-slate-400 mt-2">
                                        Size: {{$item->size}}
                                    </p>
                                    <p class="text-sm text-slate-400 mt-1">
                                        Jumlah: {{ $item->qty }}
                                    </p>
                                </div>
                                <div class="text-right font-medium text-slate-900 flex flex-col justify-between items-end">
                                    <p>
                                        Rp {{ number_format($item->product->price * $item->qty,0,',','.') }}
                                    </p>
                                    <form id="delete-form-{{ $item->id }}" action="{{ route('item.destroy', ['id'=>$item->id]) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="button"
                                            onclick="confirmDelete({{ $item->id }})"
                                            class="
                                                group flex items-center justify-center
                                                h-9 w-9 rounded-full
                                                bg-red-200 text-red-600
                                                transition
                                                hover:bg-red-600 hover:text-white
                                                focus:outline-none focus:ring-2 focus:ring-red-600/30
                                            "
                                            aria-label="Hapus item"
                                        >
                                            <img
                                                src="{{ asset('assets/icons/trash.svg') }}"
                                                alt="Hapus"
                                                class="w-4 h-4
                                                    transition
                                                    group-hover:brightness-200"
                                            >
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-slate-500 text-center py-20">
                        Keranjang kamu masih kosong.
                    </div>
                @endif
            </div>
            <div>
                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-8 sticky top-24">
                    <h2 class="text-xl font-semibold text-slate-900 mb-6">
                        Ringkasan Pesanan
                    </h2>
                    <div class="space-y-4 text-sm">
                        <div class="flex justify-between">
                            <span class="text-slate-600">Subtotal</span>
                            <span class="font-medium">
                                Rp {{ number_format($subtotal,0,',','.') }}
                            </span>
                        </div>

                        <div class="flex justify-between">
                            <span class="text-slate-600">Ongkos Kirim</span>
                            <span class="font-medium">
                                Rp {{ number_format($shipping,0,',','.') }}
                            </span>
                        </div>

                        <div class="border-t pt-4 flex justify-between text-base font-semibold">
                            <span>Total</span>
                            <span>
                                Rp {{ number_format($total,0,',','.') }}
                            </span>
                        </div>
                    </div>
                    <form action="{{ route('checkout.store') }}" method="POST" class="mt-8">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-slate-700 mb-1">
                                Alamat Pengiriman
                            </label>
                            <textarea 
                                name="address" 
                                rows="3"
                                required
                                class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-slate-200"
                            ></textarea>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-slate-700 mb-1">
                                Metode Pembayaran
                            </label>
                            <select 
                                name="payment_method" 
                                required
                                class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm"
                            >
                                <option value="transfer">Transfer Bank</option>
                                <option value="cod">COD</option>
                            </select>
                        </div>

                        <button 
                            type="submit"
                            class="w-full bg-slate-900 hover:bg-slate-800 transition text-white py-3 rounded-xl font-medium"
                        >
                            Checkout Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus ini?',
                text: "Anda akan menghapus item dari Keranjang",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
</x-layout.user>
