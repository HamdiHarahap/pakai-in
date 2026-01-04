<x-layout.user title="Pembayaran">
    <section class="max-w-5xl mx-auto px-6 py-24">
        <div class="text-center mb-16">
            <h1 class="text-3xl font-semibold text-slate-900 mb-3">
                Selesaikan Pembayaran
            </h1>
            <p class="text-slate-500">
                Order ID: <span class="font-medium text-slate-900">{{ $order->order_code }}</span>
            </p>
        </div>
        <div class="grid md:grid-cols-3 gap-12">
            <div class="md:col-span-2 space-y-6">
                <h2 class="text-lg font-medium text-slate-900 mb-4">
                    Ringkasan Pesanan
                </h2>
                <div class="bg-white border border-slate-200 rounded-2xl divide-y">
                    @foreach ($order->items as $item)
                        <div class="flex gap-6 p-6">
                            <div class="w-24 h-28 bg-slate-100 rounded-xl overflow-hidden">
                                <img 
                                    src="{{ asset('storage/' . $item->product->image) }}"
                                    alt="{{ $item->product->name }}"
                                    class="w-full h-full object-cover"
                                >
                            </div>
                            <div class="flex-1">
                                <h3 class="font-medium text-slate-900 mb-1">
                                    {{ $item->product->name }}
                                </h3>
                                <p class="text-sm text-slate-500 mb-2">
                                    Jumlah: {{ $item->qty }}
                                </p>
                                <p class="text-sm text-slate-600">
                                    Harga:
                                    <span class="font-medium text-slate-900">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </span>
                                </p>
                            </div>
                            <div class="text-right font-medium text-slate-900">
                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="bg-slate-50 rounded-2xl p-8 h-fit">
                <h2 class="text-lg font-medium text-slate-900 mb-6">
                    Detail Pembayaran
                </h2>
                <div class="space-y-4 text-sm">
                    <div class="flex justify-between">
                        <span class="text-slate-600">Subtotal</span>
                        <span class="font-medium text-slate-900">
                            Rp {{ number_format($order->total_price - $order->shipping_price, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-600">Pengiriman</span>
                        <span class="font-medium text-slate-900">
                            Rp {{ number_format($order->shipping_price, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="border-t pt-4 flex justify-between text-base">
                        <span class="font-semibold text-slate-900">Total</span>
                        <span class="font-semibold text-slate-900">
                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
                <button 
                    id="pay-button"
                    class="w-full mt-8 bg-emerald-600 hover:bg-emerald-700 transition
                    text-white py-4 rounded-full font-medium"
                >
                    Bayar Sekarang
                </button>
                <p class="text-xs text-slate-500 text-center mt-4">
                    Pembayaran aman dan terenkripsi melalui Midtrans
                </p>
            </div>
        </div>
    </section>
    
    <script 
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <script>
        document.getElementById('pay-button').addEventListener('click', function () {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function () {
                    window.location.href = "{{ route('order.success', $order->order_code) }}";
                },
                onPending: function () {
                    alert('Menunggu pembayaran');
                },
                onError: function () {
                    alert('Pembayaran gagal');
                }
            });
        });
    </script>
</x-layout.user>
