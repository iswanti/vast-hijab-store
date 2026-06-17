@extends('layouts.user')

@section('content')
    @if (session('success'))
        <div
            style="
        background: #d1fae5;
        color: #065f46;
        padding: 12px;
        border-radius: 10px;
        margin-bottom: 20px;
    ">

            {{ session('success') }}

        </div>
    @endif
    <section class="px-10 py-20">

        <div class="grid grid-cols-2 gap-10 items-center">

            <!-- TEXT -->
            <div>

                <span class="bg-pink-100 text-pink-500 px-5 py-2 rounded-full">
                    Koleksi Premium {{ now()->year }}
                </span>

                <h1 class="text-7xl font-bold text-slate-800 leading-tight mt-8">

                    Tampil Elegan
                    <br>
                    Dengan Fashion Muslim Modern

                </h1>

                <p class="text-gray-500 text-xl mt-8 leading-relaxed">

                    Fashion Muslim premium dengan kualitas terbaik,
                    nyaman dipakai sehari-hari dan tetap stylish.

                </p>

                <div class="flex gap-5 mt-10">

                    <a href="/katalog"
                        class="bg-pink-500 hover:bg-pink-600 duration-300 text-white px-10 py-5 rounded-2xl font-bold">

                        Belanja Sekarang

                    </a>

                    <a href="/katalog" class="border border-pink-300 text-pink-500 px-10 py-5 rounded-2xl font-bold">

                        Lihat Katalog

                    </a>

                </div>

            </div>

            <!-- IMAGE -->
            <div
                class="bg-gradient-to-br from-pink-100 to-pink-200 rounded-[40px] flex items-center justify-center h-[550px] shadow-2xl">

                <img src="{{ asset('logo.png') }}" class="w-full h-full object-contain p-10">
            </div>

        </div>

    </section>
@endsection
