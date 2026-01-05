<x-layout.user :title="$title">
    <section class="px-6 py-24 mx-auto max-w-7xl">
        <div class="mb-10">
            <h1 class="text-2xl font-semibold text-slate-900">
                Pesanan Saya
            </h1>
            <p class="text-slate-600 mt-1">
                Daftar seluruh pesanan yang pernah Anda buat.
            </p>
        </div>
        @if ($data->isEmpty())
            <div class="bg-white border border-slate-200 rounded-2xl p-10 text-center">
                <p class="text-slate-500">
                    Anda belum memiliki pesanan.
                </p>
            </div>
        @else
            <div class="space-y-6">
                @foreach ($data as $order)
                    @php
                        $orderStatusStyle = match($order->order_status) {
                            'pending' => 'bg-yellow-100 text-yellow-700',
                            'processing' => 'bg-blue-100 text-blue-700',
                            'shipped' => 'bg-indigo-100 text-indigo-700',
                            'completed' => 'bg-emerald-100 text-emerald-700',
                            'cancelled' => 'bg-red-100 text-red-700',
                        };
                        $paymentStatusStyle = match($order->payment_status) {
                            'paid' => 'bg-emerald-100 text-emerald-700',
                            'unpaid' => 'bg-yellow-100 text-yellow-700',
                            'failed' => 'bg-red-100 text-red-700',
                        };
                        $paymentMethodLabel = match($order->payment_method) {
                            'transfer' => 'Transfer Bank',
                            'cod' => 'COD',
                        };
                    @endphp
                    <div class="bg-white border border-slate-200 rounded-2xl p-6">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                            <div>
                                <p class="text-sm text-slate-500">Order ID</p>
                                <p class="font-semibold text-slate-900">
                                    {{ $order->order_code }}
                                </p>
                                <div class="flex flex-wrap gap-2 mt-3">
                                    <span class="px-3 py-1.5 rounded-full text-xs font-semibold {{ $orderStatusStyle }}">
                                        {{ ucfirst($order->order_status) }}
                                    </span>

                                    <span class="px-3 py-1.5 rounded-full text-xs font-semibold {{ $paymentStatusStyle }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>

                                    <span class="px-3 py-1.5 rounded-full text-xs font-medium bg-slate-100 text-slate-700">
                                        {{ $paymentMethodLabel }}
                                    </span>
                                </div>

                                <p class="text-sm text-slate-500 mt-2">
                                    {{ $order->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-slate-500">Total Pembayaran</p>
                                <p class="text-xl font-bold text-slate-900">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                        <div class="my-6 border-t border-slate-200"></div>
                        <div class="space-y-4">
                            @foreach ($order->items as $item)
                                <div class="flex items-center gap-4">
                                    <img
                                        src="{{ asset('storage/' . $item->product->image) }}"
                                        class="w-16 h-16 rounded-xl object-cover border"
                                        alt="{{ $item->product->name }}"
                                    >
                                    <div class="flex-1">
                                        <p class="font-medium text-slate-900">
                                            {{ $item->product->name }}
                                        </p>
                                        <p class="text-sm text-slate-500">
                                            Size: {{ $item->size }} • Qty: {{ $item->qty }}
                                        </p>
                                    </div>
                                    <p class="font-medium text-slate-900">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                        <div class="flex justify-end gap-3 mt-6">
                            @if ($order->payment_status === 'unpaid')
                                <a
                                    href="{{ route('checkout.payment', ['order_code' => $order->order_code]) }}"
                                    class="px-6 py-2 rounded-full bg-emerald-600 text-white font-medium
                                           hover:bg-emerald-700 transition"
                                >
                                    Bayar Sekarang
                                </a>
                            @else
                                <a
                                    href="{{ route('order.success', ['order_code' => $order->order_code]) }}"
                                    class="px-5 py-2 rounded-full border border-slate-300 text-slate-700
                                           font-medium hover:bg-slate-100 transition"
                                >
                                    Detail
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
</x-layout.user>
