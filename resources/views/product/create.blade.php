@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-2xl p-8 shadow-sm">

        <div class="mb-8">

            <h1 class="text-3xl font-bold text-gray-800">
                Tambah Product
            </h1>

            <p class="text-gray-400 mt-1">
                Tambahkan product baru ke Vast Hijab Store
            </p>

        </div>

        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- ID PRODUCT --}}
                <div>

                    <label class="block mb-2 font-medium">
                        ID Product
                    </label>

                    <input type="text" name="kode_product" placeholder="Contoh : VH001"
                        class="w-full border rounded-xl px-4 py-3">

                </div>

                {{-- NAMA PRODUCT --}}
                <div>

                    <label class="block mb-2 font-medium">
                        Nama Product
                    </label>

                    <input type="text" name="nama" placeholder="Contoh : Pashmina Ceruty Premium"
                        class="w-full border rounded-xl px-4 py-3">

                </div>

                {{-- BRAND --}}
                <div>

                    <label class="block mb-2 font-medium">
                        Brand
                    </label>

                    <input type="text" name="brand" placeholder="Contoh : Vast Hijab"
                        class="w-full border rounded-xl px-4 py-3">

                </div>

                {{-- HARGA --}}
                <div>

                    <label class="block mb-2 font-medium">
                        Harga
                    </label>

                    <input type="number" name="harga" placeholder="Contoh : 85000"
                        class="w-full border rounded-xl px-4 py-3">

                </div>

                {{-- STOK --}}
                <div>

                    <label class="block mb-2 font-medium">
                        Stok
                    </label>

                    <input type="number" name="stok" placeholder="Contoh : 50"
                        class="w-full border rounded-xl px-4 py-3">

                </div>

                {{-- WARNA --}}
                <div>

                    <label class="block mb-2 font-medium">
                        Warna Product
                    </label>

                    <input type="text" name="warna" placeholder="Contoh : Hitam,Cream,Burgundy"
                        class="w-full border rounded-xl px-4 py-3">

                    <small class="text-gray-400">
                        Pisahkan warna dengan koma (,)
                    </small>

                </div>

                {{-- SIZE --}}
                <div>

                    <label class="block mb-2 font-medium">
                        Size Product
                    </label>

                    <input type="text" name="size" placeholder="Contoh : S,M,L,XL"
                        class="w-full border rounded-xl px-4 py-3">

                    <small class="text-gray-400">
                        Pisahkan size dengan koma (,)
                    </small>

                </div>

                {{-- UPLOAD GAMBAR --}}
                <div>

                    <label class="block mb-2 font-medium">
                        Upload Gambar
                    </label>

                    <input type="file" name="gambar" id="gambar" class="w-full border rounded-xl px-4 py-3">

                    <img id="preview" class="hidden mt-4 w-32 h-32 rounded-xl object-cover border">

                </div>

            </div>

            <button type="submit" class="mt-8 bg-pink-500 hover:bg-pink-600 text-white px-8 py-3 rounded-xl font-semibold">

                Simpan Product

            </button>

        </form>


    </div>

    <script>
        document.getElementById('gambar')
            .addEventListener('change', function(e) {

                const file = e.target.files[0];

                if (file) {

                    const reader = new FileReader();

                    reader.onload = function(event) {

                        const preview =
                            document.getElementById('preview');

                        preview.src = event.target.result;

                        preview.classList.remove('hidden');

                    }

                    reader.readAsDataURL(file);

                }

            });
    </script>
@endsection
