@extends('layouts.user')

@section('content')
    <div class="max-w-5xl mx-auto py-10">

        <div class="bg-white p-8 rounded-3xl shadow">

            <h1 class="text-3xl font-bold mb-8">

                Checkout Semua Product

            </h1>

            @foreach ($carts as $cart)
                <div class="flex justify-between border-b py-4">

                    <div>

                        <h2 class="font-bold">

                            {{ $cart->product->nama }}

                        </h2>

                        <p>

                            {{ $cart->warna }}
                            -
                            {{ $cart->size }}

                        </p>

                        <p>

                            Qty :
                            {{ $cart->qty }}

                        </p>

                    </div>

                    <h3 class="font-bold text-pink-500">

                        Rp
                        {{ number_format($cart->product->harga * $cart->qty, 0, ',', '.') }}

                    </h3>

                </div>
            @endforeach

            <div class="mt-8 text-right">

                <h1 class="text-4xl font-black text-pink-500">

                    Rp
                    {{ number_format($total, 0, ',', '.') }}

                </h1>

            </div>

        </div>

    </div>
@endsection
