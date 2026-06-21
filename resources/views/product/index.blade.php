@extends('layouts.app')

@section('content')

    <div class="bg-white rounded-2xl shadow-sm p-8">{{-- HEADER --}}
        <div class="flex items-center justify-between mb-8">

            <div>

                <h1 class="text-4xl font-bold text-gray-800">
                    List Product
                </h1>

                <p class="text-gray-400 mt-1">
                    Kelola semua product Vast Hijab Store
                </p>

            </div>

            @if (auth()->user()->role != 'owner')
                <a href="{{ route('product.create') }}"
                    class="inline-flex items-center gap-2
        bg-pink-500 hover:bg-pink-600
        text-white px-5 py-3
        rounded-xl font-medium shadow-sm">

                    <i class="fa-solid fa-plus"></i>

                    Tambah Product

                </a>
            @endif

        </div>


        {{-- SEARCH --}}
        <form action="{{ route('product.index') }}" method="GET" class="flex gap-4 mb-6">

            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari product..."
                class="border rounded-xl px-4 py-3 w-full">

            <select name="brand" class="border rounded-xl px-4 py-3">

                <option value="">
                    Semua Brand
                </option>

                @foreach ($brands as $brand)
                    <option value="{{ $brand->brand }}" {{ request('brand') == $brand->brand ? 'selected' : '' }}>

                        {{ $brand->brand }}

                    </option>
                @endforeach

            </select>

            <select name="sort" class="border rounded-xl px-4 py-3">

                <option value="">
                    Urutkan
                </option>

                <option value="nama_asc" {{ request('sort') == 'nama_asc' ? 'selected' : '' }}>
                    Nama A-Z
                </option>

                <option value="nama_desc" {{ request('sort') == 'nama_desc' ? 'selected' : '' }}>
                    Nama Z-A
                </option>

                <option value="harga_asc" {{ request('sort') == 'harga_asc' ? 'selected' : '' }}>
                    Harga Terendah
                </option>

                <option value="harga_desc" {{ request('sort') == 'harga_desc' ? 'selected' : '' }}>
                    Harga Tertinggi
                </option>

            </select>

            <button class="bg-pink-500 text-white px-6 rounded-xl">

                Cari

            </button>

        </form>


        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="bg-pink-100 text-gray-700">

                        <th class="p-4 text-left rounded-l-xl">
                            ID Product
                        </th>

                        <th class="p-4 text-left">
                            Nama Product
                        </th>

                        <th class="p-4 text-left">
                            Brand
                        </th>

                        <th class="p-4 text-left">
                            Harga
                        </th>

                        <th class="p-4 text-left">
                            Stok
                        </th>

                        <th class="p-4 text-left">
                            Warna
                        </th>

                        <th class="p-4 text-left">
                            Size
                        </th>

                        <th class="p-4 text-left">
                            Gambar
                        </th>

                        <th class="p-4 text-center rounded-r-xl">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($products as $product)
                        <tr class="border-b hover:bg-pink-50 transition">

                            <td class="p-4 font-medium">
                                {{ $product->kode_product }}
                            </td>

                            <td class="p-4">
                                {{ $product->nama }}
                            </td>

                            <td class="p-4">

                                <span class="bg-pink-100 text-pink-600 px-3 py-1 rounded-full text-sm">

                                    {{ $product->brand }}

                                </span>

                            </td>

                            <td class="p-4 font-semibold text-pink-600">

                                Rp {{ number_format($product->harga, 0, ',', '.') }}

                            </td>

                            <td class="p-4">

                                {{ $product->stok }}

                            </td>

                            <td class="p-4">

                                @foreach (explode(',', $product->warna) as $warna)
                                    <span class="bg-pink-100 text-pink-600 px-2 py-1 rounded-full text-xs mr-1">

                                        {{ trim($warna) }}

                                    </span>
                                @endforeach

                            </td>

                            <td class="p-4">

                                @foreach (explode(',', $product->size) as $size)
                                    <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-full text-xs mr-1">

                                        {{ trim($size) }}

                                    </span>
                                @endforeach

                            </td>

                            <td class="p-4">

                                <img src="{{ asset('storage/' . $product->gambar) }}"
                                    class="w-16 h-16 object-cover rounded-xl border shadow-sm">


                            </td>

                            <td class="p-4">

                                <div class="flex justify-center gap-2">

                                    @if (auth()->user()->role != 'owner')
                                        <a href="{{ route('product.edit', $product->id) }}"
                                            class="flex items-center gap-2
                            bg-pink-100 text-pink-600
                            px-4 py-2 rounded-xl
                            hover:bg-pink-500 hover:text-white transition">

                                            <i class="fa-solid fa-pen"></i>

                                            Edit

                                        </a>

                                        <form action="{{ route('product.destroy', $product->id) }}" method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                onclick="return confirm('Yakin ingin menghapus produk ini?')"
                                                class="flex items-center gap-2
                                bg-red-100 text-red-600
                                px-4 py-2 rounded-xl
                                hover:bg-red-500 hover:text-white transition">

                                                <i class="fa-solid fa-trash"></i>

                                                Hapus

                                            </button>

                                        </form>
                                    @else
                                        <span class="bg-gray-100 text-gray-500 px-4 py-2 rounded-xl text-sm">

                                            <i class="fa-solid fa-eye mr-2"></i>

                                            View Only

                                        </span>
                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9" class="text-center p-10 text-gray-400">

                                Product belum tersedia

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        <div class="mt-8">

            {{ $products->links() }}

        </div>

</div>@endsection
