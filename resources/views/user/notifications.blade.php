@extends('layouts.user')

@section('content')
<div class="max-w-6xl mx-auto py-10">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-4xl font-bold text-gray-800">
                Notifikasi Saya
            </h1>

            <p class="text-gray-500 mt-2">
                Informasi terbaru mengenai pesanan dan aktivitas akun Anda
            </p>

        </div>

        <div
            class="bg-pink-50 text-pink-600 px-5 py-3 rounded-2xl font-semibold">

            {{ $notifications->count() }} Notifikasi

        </div>

    </div>

    <!-- LIST NOTIFIKASI -->
    <div class="bg-white rounded-3xl shadow-sm overflow-hidden">

        @forelse($notifications as $notif)

            <div
                class="p-6 border-b last:border-b-0 hover:bg-gray-50 transition duration-200">

                <div class="flex items-start gap-5">

                    <!-- ICON -->
                    <div
                        class="w-14 h-14 rounded-2xl bg-pink-100 flex items-center justify-center flex-shrink-0">

                        @if (Str::contains(strtolower($notif->title), 'dikirim'))

                            <i class="fa-solid fa-truck text-purple-500 text-xl"></i>

                        @elseif(Str::contains(strtolower($notif->title), 'selesai'))

                            <i class="fa-solid fa-circle-check text-green-500 text-xl"></i>

                        @elseif(Str::contains(strtolower($notif->title), 'dibatalkan'))

                            <i class="fa-solid fa-circle-xmark text-red-500 text-xl"></i>

                        @elseif(Str::contains(strtolower($notif->title), 'diproses'))

                            <i class="fa-solid fa-box-open text-blue-500 text-xl"></i>

                        @else

                            <i class="fa-solid fa-bell text-pink-500 text-xl"></i>

                        @endif

                    </div>

                    <!-- CONTENT -->
                    <div class="flex-1">

                        <div class="flex justify-between items-start">

                            <div>

                                <h2 class="font-bold text-lg text-gray-800">
                                    {{ $notif->title }}
                                </h2>

                                <p class="text-gray-600 mt-2 leading-relaxed">
                                    {{ $notif->message }}
                                </p>

                            </div>

                            @if (!$notif->is_read)

                                <span
                                    class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-semibold">

                                    Baru

                                </span>

                            @endif

                        </div>

                        <div class="mt-4 flex items-center gap-2 text-sm text-gray-400">

                            <i class="fa-regular fa-clock"></i>

                            <span>
                                {{ $notif->created_at->diffForHumans() }}
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <!-- EMPTY STATE -->
            <div class="py-24 text-center">

                <div
                    class="w-24 h-24 mx-auto rounded-full bg-gray-100 flex items-center justify-center">

                    <i class="fa-regular fa-bell-slash text-4xl text-gray-400"></i>

                </div>

                <h2 class="text-2xl font-bold text-gray-500 mt-6">

                    Belum Ada Notifikasi

                </h2>

                <p class="text-gray-400 mt-2">

                    Semua informasi pesanan dan promo terbaru akan muncul di sini

                </p>

            </div>

        @endforelse

    </div>

    <!-- PAGINATION -->
    @if(method_exists($notifications,'links'))

        <div class="mt-8">

            {{ $notifications->links() }}

        </div>

    @endif

</div>
@endsection