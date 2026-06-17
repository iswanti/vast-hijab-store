@extends('layouts.app')

@section('content')
    <div class="space-y-6">

        <!-- HEADER -->
        <div class="flex justify-between items-center">

            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Notifikasi Admin
                </h1>

                <p class="text-gray-500 mt-1">
                    Semua aktivitas dan transaksi terbaru Vast Hijab Store
                </p>
            </div>

            <div class="bg-pink-50 text-pink-600 px-4 py-2 rounded-xl font-semibold">
                {{ $notifications->count() }} Notifikasi
            </div>

        </div>

        <!-- LIST NOTIFIKASI -->
        <div class="bg-white rounded-3xl shadow-sm overflow-hidden">

            @forelse($notifications as $notif)
                <div class="p-6 border-b last:border-b-0 hover:bg-gray-50 transition">

                    <div class="flex items-start gap-4">

                        <!-- ICON -->
                        <div class="w-14 h-14 rounded-2xl bg-pink-100 flex items-center justify-center flex-shrink-0">

                            <i class="fa-solid fa-bell text-pink-500 text-xl"></i>

                        </div>

                        <!-- CONTENT -->
                        <div class="flex-1">

                            <div class="flex justify-between items-start">

                                <div>

                                    <h3 class="font-bold text-gray-800 text-lg">
                                        {{ $notif->title }}
                                    </h3>

                                    <p class="text-gray-600 mt-2 leading-relaxed">
                                        {{ $notif->message }}
                                    </p>

                                </div>

                                @if (!$notif->is_read)
                                    <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-semibold">

                                        Baru

                                    </span>
                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="py-24 text-center">

                    <div class="w-24 h-24 mx-auto rounded-full bg-gray-100 flex items-center justify-center">

                        <i class="fa-regular fa-bell-slash text-4xl text-gray-400"></i>

                    </div>

                    <h3 class="mt-6 text-xl font-bold text-gray-500">
                        Belum Ada Notifikasi
                    </h3>

                    <p class="text-gray-400 mt-2">
                        Semua aktivitas terbaru akan muncul di sini
                    </p>

                </div>
            @endforelse

        </div>

    </div>
@endsection
