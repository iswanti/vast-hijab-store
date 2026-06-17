@extends('layouts.user')

@section('content')
    <div class="max-w-4xl mx-auto py-10">

        <div class="bg-white p-8 rounded-3xl shadow">

            <h1 class="text-3xl font-bold mb-6">

                Checkout Product

            </h1>

            <div class="flex gap-6">

                <img src="{{ asset('storage/' . $cart->product->gambar) }}" class="w-40 rounded-2xl">

                <div>

                    <h2 class="text-2xl font-bold">

                        {{ $cart->product->nama }}

                    </h2>

                    <p>Warna : {{ $cart->warna }}</p>

                    <p>Size : {{ $cart->size }}</p>

                    <p>Qty : {{ $cart->qty }}</p>

                    <p class="text-pink-500 text-2xl font-bold mt-4">

                        Rp
                        {{ number_format($cart->product->harga * $cart->qty, 0, ',', '.') }}

                    </p>

                </div>

            </div>

        </div>

    </div>
@endsection
