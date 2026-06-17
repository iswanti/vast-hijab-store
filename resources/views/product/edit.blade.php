@extends('layouts.app')

@section('content')
    <div class="bg-white p-8 rounded-2xl shadow-sm">

        <h1 class="text-3xl font-bold mb-8">
            Edit Product
        </h1>

        <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- ID PRODUCT --}}
                <div>
                    <label class="block mb-2 font-medium">
                        ID Product
                    </label>

                    <input type="text" name="kode_product" value="{{ $product->kode_product }}"
                        class="w-full border rounded-xl px-4 py-3">
                </div>

                {{-- NAMA PRODUCT --}}
                <div>
                    <label class="block mb-2 font-medium">
                        Nama Product
                    </label>

                    <input type="text" name="nama" value="{{ $product->nama }}"
                        class="w-full border rounded-xl px-4 py-3">
                </div>

                {{-- BRAND --}}
                <div>
                    <label class="block mb-2 font-medium">
                        Brand
                    </label>

                    <input type="text" name="brand" value="{{ $product->brand }}"
                        class="w-full border rounded-xl px-4 py-3">
                </div>

                {{-- HARGA --}}
                <div>
                    <label class="block mb-2 font-medium">
                        Harga
                    </label>

                    <input type="number" name="harga" value="{{ $product->harga }}"
                        class="w-full border rounded-xl px-4 py-3">
                </div>

                {{-- STOK --}}
                <div>
                    <label class="block mb-2 font-medium">
                        Stok
                    </label>

                    <input type="number" name="stok" value="{{ $product->stok }}"
                        class="w-full border rounded-xl px-4 py-3">
                </div>

                {{-- WARNA --}}
                <div>
                    <label class="block mb-2 font-medium">
                        Warna Product
                    </label>

                    <input type="text" name="warna" value="{{ $product->warna }}"
                        placeholder="Contoh: Hitam,Cream,Burgundy" class="w-full border rounded-xl px-4 py-3">

                    <small class="text-gray-400">
                        Pisahkan dengan koma (,)
                    </small>
                </div>

                {{-- SIZE --}}
                <div>
                    <label class="block mb-2 font-medium">
                        Size Product
                    </label>

                    <input type="text" name="size" value="{{ $product->size }}" placeholder="Contoh: S,M,L,XL"
                        class="w-full border rounded-xl px-4 py-3">

                    <small class="text-gray-400">
                        Pisahkan dengan koma (,)
                    </small>
                </div>

                {{-- UPLOAD GAMBAR --}}
                <div>
                    <label class="block mb-2 font-medium">
                        Upload Gambar
                    </label>

                    <input type="file" name="gambar" class="w-full border rounded-xl px-4 py-3">

                    @if ($product->gambar)
                        <div class="mt-4">

                            <img src="{{ asset('storage/' . $product->gambar) }}"
                                class="w-32 h-32 object-cover rounded-xl border">

                        </div>
                    @endif

                </div>

            </div>

            <button type="submit" class="mt-8 bg-pink-500 hover:bg-pink-600 text-white px-8 py-3 rounded-xl font-semibold">

                Update Product

            </button>

        </form>

    </div>
@endsection
