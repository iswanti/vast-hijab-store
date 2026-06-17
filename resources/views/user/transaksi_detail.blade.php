@extends('layouts.user')

@section('content')

    <div class="max-w-7xl mx-auto py-8 space-y-6">
        <!-- HEADER -->
        <div class="bg-gradient-to-r from-pink-500 to-pink-600 rounded-3xl p-8 text-white shadow-lg">

            <div class="flex flex-col lg:flex-row justify-between lg:items-center gap-6">

                <div>

                    <p class="text-pink-100 text-sm uppercase tracking-wider">
                        Detail Transaksi
                    </p>

                    <h1 class="text-4xl font-bold mt-2">
                        {{ $order->invoice }}
                    </h1>

                    <div class="flex flex-wrap gap-8 mt-5">

                        <div>
                            <p class="text-xs uppercase text-pink-100">
                                Customer
                            </p>

                            <p class="font-semibold text-lg">
                                {{ $order->user->name }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs uppercase text-pink-100">
                                Tanggal Pesanan
                            </p>

                            <p class="font-semibold">
                                {{ $order->created_at->format('d F Y H:i') }}
                            </p>
                        </div>

                    </div>

                </div>

                <div>

                    @if ($order->status == 'Menunggu Konfirmasi')
                        <span class="bg-yellow-400 text-white px-6 py-3 rounded-full font-semibold shadow">
                            Menunggu Konfirmasi
                        </span>
                    @elseif($order->status == 'Diproses')
                        <span class="bg-blue-500 text-white px-6 py-3 rounded-full font-semibold shadow">
                            Diproses
                        </span>
                    @elseif($order->status == 'Dikirim')
                        <span class="bg-purple-500 text-white px-6 py-3 rounded-full font-semibold shadow">
                            Dikirim
                        </span>
                    @elseif($order->status == 'Selesai')
                        <span class="bg-green-500 text-white px-6 py-3 rounded-full font-semibold shadow">
                            Selesai
                        </span>
                    @else
                        <span class="bg-red-500 text-white px-6 py-3 rounded-full font-semibold shadow">
                            Dibatalkan
                        </span>
                    @endif

                </div>

            </div>

        </div>

        <!-- TIMELINE -->
        <div class="bg-white rounded-3xl shadow-sm p-8">

            <h2 class="text-xl font-bold mb-8">
                Riwayat Status Pesanan
            </h2>

            <div class="relative">

                <div class="absolute left-5 top-0 bottom-0 w-0.5 bg-gray-200"></div>

                <div class="space-y-8">

                    <div class="flex gap-4 relative">

                        <div class="w-10 h-10 rounded-full bg-pink-500 flex items-center justify-center text-white z-10">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </div>

                        <div>
                            <h3 class="font-semibold">
                                Pesanan Dibuat
                            </h3>

                            <p class="text-sm text-gray-500">
                                {{ $order->created_at->format('d F Y H:i') }}
                            </p>
                        </div>

                    </div>

                    @if ($order->confirmed_at)
                        <div class="flex gap-4 relative">

                            <div
                                class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white z-10">
                                <i class="fa-solid fa-check"></i>
                            </div>

                            <div>
                                <h3 class="font-semibold">
                                    Pesanan Diproses
                                </h3>

                                <p class="text-sm text-gray-500">
                                    {{ $order->confirmed_at->format('d F Y H:i') }}
                                </p>
                            </div>

                        </div>
                    @endif

                    @if ($order->shipped_at)
                        <div class="flex gap-4 relative">

                            <div
                                class="w-10 h-10 rounded-full bg-purple-500 flex items-center justify-center text-white z-10">
                                <i class="fa-solid fa-truck"></i>
                            </div>

                            <div>
                                <h3 class="font-semibold">
                                    Pesanan Dikirim
                                </h3>

                                <p class="text-sm text-gray-500">
                                    {{ $order->shipped_at->format('d F Y H:i') }}
                                </p>

                                @if ($order->resi)
                                    <p class="text-purple-600 text-sm font-medium mt-1">
                                        Resi : {{ $order->resi }}
                                    </p>
                                @endif

                            </div>

                        </div>
                    @endif

                    @if ($order->completed_at)
                        <div class="flex gap-4 relative">

                            <div
                                class="w-10 h-10 rounded-full bg-green-500 flex items-center justify-center text-white z-10">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>

                            <div>
                                <h3 class="font-semibold">
                                    Pesanan Selesai
                                </h3>

                                <p class="text-sm text-gray-500">
                                    {{ $order->completed_at->format('d F Y H:i') }}
                                </p>
                            </div>

                        </div>
                    @endif

                </div>

            </div>

        </div>

        <!-- DETAIL PRODUK -->
        <div class="bg-white rounded-3xl shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b">

                <h2 class="text-xl font-bold">
                    Produk yang Dibeli
                </h2>

            </div>

            @foreach ($order->details as $detail)
                <div class="p-6 border-b last:border-b-0">

                    <div class="flex justify-between items-center">

                        <div>

                            <h3 class="text-xl font-bold text-gray-800">
                                {{ $detail->product->nama_product ?? $detail->product->nama }}
                            </h3>

                            <div class="grid md:grid-cols-2 gap-3 mt-4 text-gray-600">

                                <p>Warna : <b>{{ $detail->warna }}</b></p>

                                <p>Size : <b>{{ $detail->size }}</b></p>

                                <p>Qty : <b>{{ $detail->qty }}</b></p>

                                <p>Harga : <b>Rp {{ number_format($detail->harga, 0, ',', '.') }}</b></p>

                            </div>

                        </div>

                        <div class="text-right">

                            <p class="text-sm text-gray-400">
                                Subtotal
                            </p>

                            <h3 class="text-2xl font-bold text-pink-500">
                                Rp {{ number_format($detail->harga * $detail->qty, 0, ',', '.') }}
                            </h3>

                        </div>

                    </div>

                </div>
            @endforeach

        </div>

        <!-- TOTAL & RESI -->
        <div class="grid md:grid-cols-2 gap-6">

            <div class="bg-white rounded-3xl shadow-sm p-6">

                <p class="text-gray-500 text-sm">
                    Total Pembayaran
                </p>

                <h2 class="text-4xl font-bold text-pink-500 mt-2">
                    Rp {{ number_format($order->total, 0, ',', '.') }}
                </h2>

            </div>

            @if ($order->resi)
                <div class="bg-blue-50 border border-blue-200 rounded-3xl p-6">

                    <p class="text-blue-600 font-semibold">
                        Nomor Resi
                    </p>

                    <h2 class="text-2xl font-bold text-blue-700 mt-2">
                        {{ $order->resi }}
                    </h2>

                </div>
            @endif

        </div>

        <!-- ACTION -->
        <div class="bg-white rounded-3xl shadow-sm p-6">
            <div class="bg-white rounded-3xl shadow-sm p-6">

                <h2 class="text-xl font-bold text-gray-800 mb-5">

                    Aksi Cepat

                </h2>

                <div class="grid md:grid-cols-2 gap-4">

                    <!-- CETAK -->
                    <a href="{{ route('orders.invoice', $order->id) }}" target="_blank"
                        class="group bg-gradient-to-r from-red-500 to-red-600 text-white p-5 rounded-2xl hover:shadow-xl transition duration-300">

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-red-100 text-sm">
                                    Invoice Pesanan
                                </p>

                                <h3 class="font-bold text-lg mt-1">
                                    Cetak Invoice
                                </h3>

                            </div>

                            <i class="fa-solid fa-print text-3xl opacity-70 group-hover:scale-110 transition"></i>

                        </div>

                    </a>

                    <!-- KEMBALI -->
                    <a href="{{ route('orders.index') }}"
                        class="group bg-gradient-to-r from-gray-700 to-gray-800 text-white p-5 rounded-2xl hover:shadow-xl transition duration-300">

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-gray-300 text-sm">
                                    Daftar Pesanan
                                </p>

                                <h3 class="font-bold text-lg mt-1">
                                    Kembali
                                </h3>

                            </div>

                            <i class="fa-solid fa-arrow-left text-3xl opacity-70 group-hover:-translate-x-1 transition"></i>

                        </div>

                    </a>

                </div>

            </div>

        </div>


    </div>
@endsection
