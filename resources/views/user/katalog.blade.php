@extends('layouts.user')
@if (session('success'))
    <div class="bg-green-100 text-green-700 px-6 py-4 rounded-2xl mb-6">

        {{ session('success') }}

    </div>
@endif

@section('content')
    <!-- HEADER -->
    <section class="px-10 mt-10">

        <div class="flex justify-between items-center">

            <div>
                <h1 class="text-5xl font-black text-gray-800">
                    Katalog Product
                </h1>

                <p class="text-gray-500 mt-3 text-lg">
                    Temukan Fashon Muslim Favorit Kamu
                </p>
            </div>

        </div>

    </section>


    <!-- SEARCH -->
    <section class="px-10 mt-8">

        <form method="GET" action="{{ route('user.katalog') }}">

            <div class="bg-white p-6 rounded-3xl shadow-sm flex gap-4">

                <!-- SEARCH -->
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari product..."
                    class="flex-1 border border-pink-200 rounded-2xl px-6 py-4 outline-none focus:border-pink-400">

                <!-- BRAND -->
                <select name="brand" class="border border-pink-200 rounded-2xl px-6 py-4 outline-none">

                    <option value="">
                        Semua Brand
                    </option>

                    @foreach ($brands as $brand)
                        <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>

                            {{ $brand }}

                        </option>
                    @endforeach

                </select>

                <button class="bg-pink-500 hover:bg-pink-600 text-white px-10 rounded-2xl font-semibold transition">

                    Cari

                </button>

            </div>

        </form>

    </section>


    <!-- PRODUCT -->
    <section class="px-10 mt-10 pb-16">

        <div class="grid grid-cols-4 gap-8">

            @forelse($products as $item)
                <div
                    class="bg-white rounded-[30px] overflow-hidden shadow-sm hover:shadow-2xl hover:-translate-y-2 transition duration-300">

                    <!-- IMAGE -->
                    <div class="relative">

                        <div class="w-full aspect-[3/4] overflow-hidden rounded-t-[30px] bg-gray-100">

                            <img src="{{ asset('storage/' . $item->gambar) }}"
                                class="w-full h-full object-cover hover:scale-110 transition duration-500">

                        </div>

                        <div
                            class="absolute top-4 left-4 bg-white px-4 py-2 rounded-full text-pink-500 text-sm font-semibold shadow">

                            {{ $item->brand }}

                        </div>

                    </div>

                    <!-- CONTENT -->
                    <div class="p-6">

                        <h3 class="text-2xl font-bold text-gray-800 leading-snug">

                            {{ $item->nama }}

                        </h3>

                        <p class="text-3xl font-black text-pink-500 mt-4">

                            Rp {{ number_format($item->harga, 0, ',', '.') }}

                        </p>

                        <!-- DETAIL -->
                        <div class="mt-5 space-y-2 text-sm text-gray-600">

                            <p>
                                <span class="font-semibold">
                                    Warna:
                                </span>

                                {{ $item->warna }}
                            </p>

                            <p>
                                <span class="font-semibold">
                                    Size:
                                </span>

                                {{ $item->size }}
                            </p>

                            <p>
                                <span class="font-semibold">
                                    Stok:
                                </span>

                                {{ $item->stok }}
                            </p>

                        </div>

                        <!-- BUTTON -->
                        <div class="mt-6">

                            <a href="{{ route('user.detail', $item->id) }}"
                                class="block text-center
                                border-2 border-pink-500
                                text-pink-500
                                py-3
                                rounded-2xl
                                font-bold
                                hover:bg-pink-500
                                hover:text-white
                                transition">

                                Lihat Detail

                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-span-4 text-center py-20 text-gray-400 text-2xl">

                    Product belum tersedia

                </div>
            @endforelse

        </div>


        <!-- PAGINATION -->
        <div class="mt-10">

            {{ $products->links() }}

        </div>

    </section>
@endsection
