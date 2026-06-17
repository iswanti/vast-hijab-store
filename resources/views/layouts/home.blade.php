@extends('layouts.user')

@section('content')
    <section class="px-10 py-20">

        <div class="grid grid-cols-2 gap-10 items-center">

            <!-- TEXT -->
            <div>

                <span class="bg-pink-100 text-pink-500 px-5 py-2 rounded-full">
                    ✨ Koleksi Premium 2025
                </span>

                <h1 class="text-7xl font-bold text-slate-800 leading-tight mt-8">

                    Tampil Elegan
                    <br>
                    Dengan Hijab Modern

                </h1>

                <p class="text-gray-500 text-xl mt-8 leading-relaxed">

                    Hijab premium dengan kualitas terbaik,
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
            <div>

                <img src="https://images.unsplash.com/photo-1602810318383-e386cc2a3ccf?q=80&w=1200"
                    class="rounded-[40px] shadow-2xl">

            </div>

        </div>

    </section>
@endsection
