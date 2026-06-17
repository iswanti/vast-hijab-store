@extends('layouts.user')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-10">

        {{-- HEADER --}}
        <div class="mb-10">

            <h1 class="text-4xl font-bold text-gray-800">

                Keranjang Belanja

            </h1>

            <p class="text-gray-500 mt-2">

                Kelola produk yang akan Anda checkout

            </p>

        </div>

        @php

            $grandTotal = 0;

        @endphp

        @foreach ($carts as $cart)
            @php

                $grandTotal += $cart->product->harga * $cart->qty;

            @endphp
        @endforeach

        {{-- SUMMARY --}}
        @if ($carts->count())
            <div class="grid md:grid-cols-2 gap-6 mb-8">

                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">

                    <p class="text-gray-500 text-sm">

                        Total Item

                    </p>

                    <h2 class="text-4xl font-bold text-pink-500 mt-2">

                        {{ $carts->count() }}

                    </h2>

                </div>

                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">

                    <p class="text-gray-500 text-sm">

                        Total Belanja

                    </p>

                    <h2 class="text-4xl font-bold text-green-500 mt-2">

                        Rp {{ number_format($grandTotal, 0, ',', '.') }}

                    </h2>

                </div>

            </div>
        @endif

        {{-- CART LIST --}}
        <div class="space-y-6">

            @forelse($carts as $cart)
                @php

                    $subtotal = $cart->product->harga * $cart->qty;

                @endphp

                <div
                    class="bg-white rounded-3xl shadow-sm hover:shadow-lg transition duration-300 border border-gray-100 overflow-hidden">

                    <div class="p-6">

                        <div class="flex flex-col lg:flex-row gap-6">

                            {{-- IMAGE --}}
                            <div class="w-full lg:w-48 h-48 rounded-3xl overflow-hidden bg-gray-100 flex-shrink-0">

                                <img src="{{ asset('storage/' . $cart->product->gambar) }}"
                                    class="w-full h-full object-cover">

                            </div>

                            {{-- CONTENT --}}
                            <div class="flex-1">

                                <div class="flex flex-col lg:flex-row lg:justify-between gap-4">

                                    <div>

                                        <span
                                            class="inline-flex items-center bg-pink-100 text-pink-600 px-4 py-2 rounded-full text-sm font-semibold">

                                            {{ $cart->product->brand }}

                                        </span>

                                        <h2 class="text-2xl font-bold text-gray-800 mt-3">

                                            {{ $cart->product->nama }}

                                        </h2>

                                    </div>

                                    <div class="text-right">

                                        <p class="text-sm text-gray-400">

                                            Harga Satuan

                                        </p>

                                        <h3 class="text-2xl font-bold text-pink-500">

                                            Rp
                                            {{ number_format($cart->product->harga, 0, ',', '.') }}

                                        </h3>

                                    </div>

                                </div>

                                {{-- DETAIL --}}
                                <div class="flex flex-wrap gap-3 mt-5">

                                    <span class="bg-gray-100 px-4 py-2 rounded-xl text-sm">

                                        Warna :
                                        <b>{{ $cart->warna }}</b>

                                    </span>

                                    <span class="bg-gray-100 px-4 py-2 rounded-xl text-sm">

                                        Size :
                                        <b>{{ $cart->size }}</b>

                                    </span>

                                    <span class="bg-gray-100 px-4 py-2 rounded-xl text-sm">

                                        Qty :
                                        <b>{{ $cart->qty }}</b>

                                    </span>

                                </div>

                                {{-- SUBTOTAL --}}
                                <div class="mt-5 border-t pt-4">

                                    <p class="text-sm text-gray-500">

                                        Subtotal

                                    </p>

                                    <h3 class="text-2xl font-bold text-pink-500 mt-1">

                                        Rp
                                        {{ number_format($subtotal, 0, ',', '.') }}

                                    </h3>

                                </div>

                                {{-- ACTION --}}
                                <div class="mt-6 flex flex-wrap gap-3">

                                    <a href="{{ route('user.detail', $cart->product->id) }}"
                                        class="px-5 py-3 border border-pink-500 text-pink-500 rounded-xl font-semibold hover:bg-pink-50 transition">

                                        <i class="fas fa-eye mr-2"></i>

                                        Detail Produk

                                    </a>

                                    <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="px-5 py-3 bg-red-500 hover:bg-red-600 text-white rounded-xl font-semibold transition">

                                            <i class="fas fa-trash mr-2"></i>

                                            Hapus

                                        </button>

                                    </form>

                                    <form action="{{ route('checkout.process', $cart->id) }}" method="POST">

                                        @csrf

                                        <button
                                            class="px-5 py-3 bg-pink-500 hover:bg-pink-600 text-white rounded-xl font-semibold transition">

                                            <i class="fas fa-credit-card mr-2"></i>

                                            Checkout

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                {{-- EMPTY STATE --}}
                <div class="bg-white rounded-3xl shadow-sm p-20 text-center">

                    <div class="text-7xl mb-5">

                        🛍️

                    </div>

                    <h2 class="text-3xl font-bold text-gray-700">

                        Keranjang Belanja Kosong

                    </h2>

                    <p class="text-gray-500 mt-3">

                        Belum ada produk yang ditambahkan ke keranjang.

                    </p>

                    <a href="{{ route('user.katalog') }}"
                        class="inline-block mt-6 bg-pink-500 hover:bg-pink-600 text-white px-8 py-3 rounded-xl font-semibold">

                        Mulai Belanja

                    </a>

                </div>
            @endforelse

        </div>

        {{-- CHECKOUT ALL --}}
        @if ($carts->count())
            <div class="mt-10 bg-white rounded-3xl shadow-lg border border-gray-100 p-8">

                <h2 class="text-2xl font-bold text-gray-800 mb-6">

                    Ringkasan Belanja

                </h2>

                <div class="flex justify-between mb-4">

                    <span class="text-gray-500">

                        Total Produk

                    </span>

                    <span class="font-semibold">

                        {{ $carts->count() }}

                    </span>

                </div>

                <div class="flex justify-between items-center border-b pb-5 mb-5">

                    <span class="text-gray-500">

                        Total Pembayaran

                    </span>

                    <span class="text-3xl font-bold text-pink-500">

                        Rp
                        {{ number_format($grandTotal, 0, ',', '.') }}

                    </span>

                </div>

                <form action="{{ route('checkout.all') }}" method="POST">

                    @csrf

                    <button
                        class="w-full bg-pink-500 hover:bg-pink-600 text-white py-4 rounded-2xl font-bold text-lg transition">

                        <i class="fas fa-shopping-bag mr-2"></i>

                        Checkout Semua Produk

                    </button>

                </form>

            </div>
        @endif

    </div>
@endsection
