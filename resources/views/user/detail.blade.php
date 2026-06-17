@extends('layouts.user')

@section('content')
    <div class="max-w-6xl mx-auto py-10">

        <div class="bg-white rounded-3xl shadow p-8 md:p-10 grid md:grid-cols-2 gap-10">

            {{-- GAMBAR --}}
            <div>

                <img src="{{ asset('storage/' . $product->gambar) }}" class="w-full rounded-3xl object-cover shadow">

            </div>

            {{-- DETAIL --}}
            <div>

                {{-- BRAND --}}
                <span class="bg-pink-100 text-pink-600 px-4 py-2 rounded-full text-sm">

                    {{ $product->brand }}

                </span>

                {{-- NAMA --}}
                <h1 class="text-4xl font-bold text-gray-800 mt-4">

                    {{ $product->nama }}

                </h1>

                {{-- HARGA --}}
                <h2 class="text-3xl font-bold text-pink-500 mt-3">

                    Rp {{ number_format($product->harga, 0, ',', '.') }}

                </h2>

                {{-- STOK --}}
                @if ($product->stok > 0)
                    <p class="text-green-600 mt-2">

                        Stok tersedia :
                        {{ $product->stok }}

                    </p>
                @else
                    <p class="text-red-500 mt-2 font-semibold">

                        Stok Habis

                    </p>
                @endif

                {{-- DESKRIPSI --}}
                <div class="mt-6">

                    <h3 class="font-semibold text-lg">

                        Deskripsi

                    </h3>

                    <p class="text-gray-500 mt-2 leading-relaxed">

                        {{ $product->deskripsi }}

                    </p>

                </div>

                <form action="{{ route('cart.store', $product->id) }}" method="POST" onsubmit="return validasiCart()">

                    @csrf

                    {{-- WARNA --}}
                    <div class="mt-8">

                        <h3 class="font-semibold mb-3">

                            Pilih Warna

                        </h3>

                        @php
                            $warnas = explode(',', $product->warna);
                        @endphp

                        <div class="flex flex-wrap gap-3">

                            @foreach ($warnas as $warna)
                                <button type="button" onclick="pilihWarna(this)" data-warna="{{ trim($warna) }}"
                                    class="warna-btn border border-pink-300 px-5 py-2 rounded-xl hover:bg-pink-500 hover:text-white transition">

                                    {{ trim($warna) }}

                                </button>
                            @endforeach

                        </div>

                        <p id="warnaText" class="text-sm text-pink-500 mt-3">

                            Belum memilih warna

                        </p>

                    </div>

                    {{-- SIZE --}}
                    <div class="mt-8">

                        <h3 class="font-semibold mb-3">

                            Pilih Size

                        </h3>

                        @php
                            $sizes = explode(',', $product->size);
                        @endphp

                        <div class="flex flex-wrap gap-3">

                            @foreach ($sizes as $size)
                                <button type="button" onclick="pilihSize(this)" data-size="{{ trim($size) }}"
                                    class="size-btn border border-pink-300 px-5 py-2 rounded-xl hover:bg-pink-500 hover:text-white transition">

                                    {{ trim($size) }}

                                </button>
                            @endforeach

                        </div>

                        <p id="sizeText" class="text-sm text-pink-500 mt-3">

                            Belum memilih size

                        </p>

                    </div>

                    {{-- QTY --}}
                    <div class="mt-8">

                        <h3 class="font-semibold mb-3">

                            Jumlah

                        </h3>

                        <div class="flex items-center gap-4">

                            <button type="button" onclick="kurangQty()"
                                class="w-10 h-10 rounded-lg bg-pink-100 text-pink-600">

                                -

                            </button>

                            <input type="text" id="qty" value="1" readonly
                                class="w-20 text-center border rounded-lg py-2">

                            <button type="button" onclick="tambahQty()"
                                class="w-10 h-10 rounded-lg bg-pink-500 text-white">

                                +

                            </button>

                        </div>

                    </div>

                    {{-- TOTAL --}}
                    <div class="mt-8 bg-pink-50 rounded-2xl p-5">

                        <div class="flex justify-between items-center">

                            <span>

                                Total

                            </span>

                            <span id="total" class="text-2xl font-bold text-pink-500">

                                Rp {{ number_format($product->harga, 0, ',', '.') }}

                            </span>

                        </div>

                    </div>

                    <input type="hidden" name="qty" id="cartQty" value="1">

                    <input type="hidden" name="warna" id="selectedWarna">

                    <input type="hidden" name="size" id="selectedSize">

                    {{-- BUTTON --}}
                    <div class="flex gap-4 mt-8">

                        <button type="submit"
                            class="w-full bg-pink-500 hover:bg-pink-600 text-white py-4 rounded-2xl font-semibold">

                            + Keranjang

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <script>
        let qty = 1;

        let harga = {{ $product->harga }};

        let stok = {{ $product->stok }};

        function updateTotal() {

            let total = qty * harga;

            document.getElementById('qty').value = qty;

            document.getElementById('cartQty').value = qty;

            document.getElementById('total').innerHTML =
                'Rp ' + total.toLocaleString('id-ID');

        }

        function tambahQty() {

            if (qty < stok) {

                qty++;

                updateTotal();

            }

        }

        function kurangQty() {

            if (qty > 1) {

                qty--;

                updateTotal();

            }

        }

        function pilihWarna(button) {

            document.querySelectorAll('.warna-btn')
                .forEach(btn => {

                    btn.classList.remove(
                        'bg-pink-500',
                        'text-white'
                    );

                });

            button.classList.add(
                'bg-pink-500',
                'text-white'
            );

            document.getElementById('selectedWarna').value =
                button.dataset.warna;

            document.getElementById('warnaText').innerHTML =
                'Warna dipilih : ' + button.dataset.warna;

        }

        function pilihSize(button) {

            document.querySelectorAll('.size-btn')
                .forEach(btn => {

                    btn.classList.remove(
                        'bg-pink-500',
                        'text-white'
                    );

                });

            button.classList.add(
                'bg-pink-500',
                'text-white'
            );

            document.getElementById('selectedSize').value =
                button.dataset.size;

            document.getElementById('sizeText').innerHTML =
                'Size dipilih : ' + button.dataset.size;

        }

        function validasiCart() {

            let warna =
                document.getElementById('selectedWarna').value;

            let size =
                document.getElementById('selectedSize').value;

            if (warna === '') {

                alert('Pilih warna terlebih dahulu');

                return false;

            }

            if (size === '') {

                alert('Pilih size terlebih dahulu');

                return false;

            }

            return true;

        }
    </script>
@endsection
