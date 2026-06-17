@extends('layouts.user')

@section('content')
    <div class="max-w-6xl mx-auto py-10">

        <div class="bg-white rounded-3xl p-8 shadow">

            <h1 class="text-4xl font-bold mb-6">

                {{ $order->invoice }}

            </h1>

            <p class="text-gray-500 mb-8">

                Status :
                {{ $order->status }}

            </p>

            @foreach ($order->details as $detail)
                <div class="border rounded-2xl p-5 mb-4">

                    <h2 class="text-2xl font-bold">

                        {{ $detail->product->nama }}

                    </h2>

                    <p>

                        Warna :
                        {{ $detail->warna }}

                    </p>

                    <p>

                        Size :
                        {{ $detail->size }}

                    </p>

                    <p>

                        Qty :
                        {{ $detail->qty }}

                    </p>

                    <p class="text-pink-500 font-bold">

                        Rp {{ number_format($detail->harga, 0, ',', '.') }}

                    </p>

                </div>
            @endforeach

            <div class="text-right mt-8">

                <h2 class="text-3xl font-bold text-pink-500">

                    Rp {{ number_format($order->total, 0, ',', '.') }}

                </h2>

            </div>

            <div class="flex gap-4 mt-8">

                <a href="{{ $waLink }}" target="_blank"
                    class="flex-1 text-center bg-green-500 hover:bg-green-600 text-white py-4 rounded-2xl font-bold">

                    <i class="fa-brands fa-whatsapp mr-2"></i>

                    Hubungi Admin

                </a>

                <a href="{{ route('user.transaksi') }}"
                    class="flex-1 text-center bg-pink-500 hover:bg-pink-600 text-white py-4 rounded-2xl font-bold">

                    Kembali

                </a>

            </div>

        </div>

    </div>
@endsection
