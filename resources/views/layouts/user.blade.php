<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vast Hijab Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite('resources/css/app.css')

</head>

<body class="bg-pink-50">

    <!-- NAVBAR -->
    <nav class="sticky top-0 z-50 bg-white shadow-sm px-10 py-5 flex justify-between items-center">

        <!-- LOGO -->
        <a href="/home" class="text-4xl font-bold text-pink-500">
            VAST HIJAB STORE
        </a>

        <!-- MENU -->
        <div class="flex items-center gap-10 font-semibold text-lg">

            <a href="/home" class="{{ request()->is('home') ? 'text-pink-500' : 'text-black' }}">
                Beranda
            </a>

            <a href="/katalog" class="{{ request()->is('katalog') ? 'text-pink-500' : 'text-black' }}">
                Katalog
            </a>

            <a href="/transaksi-user" class="{{ request()->is('transaksi-user') ? 'text-pink-500' : 'text-black' }}">
                Transaksi
            </a>

            <!-- NOTIFIKASI -->
            @php

                $userNotif = \App\Models\Notification::where('user_id', auth()->id())
                    ->where('is_read', false)
                    ->count();

            @endphp

            <a href="{{ route('notifications.index') }}" class="relative">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-gray-700" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032
            2.032 0 0118 14.158V11a6.002
            6.002 0 00-4-5.659V5a2 2
            0 10-4 0v.341C7.67 6.165
            6 8.388 6 11v3.159c0
            .538-.214 1.055-.595
            1.436L4 17h5m6 0v1a3
            3 0 11-6 0v-1m6 0H9" />
                </svg>

                @if ($userNotif > 0)
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-2 rounded-full">

                        {{ $userNotif }}

                    </span>
                @endif

            </a>
            <!-- KERANJANG -->
            <a href="{{ route('cart.index') }}" class="relative flex items-center">

                <!-- ICON -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-gray-700" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1 5h12m-9 0a1 1 0 102 0m6 0a1 1 0 102 0" />

                </svg>

                <!-- BADGE -->
                <span
                    class="absolute -top-2 -right-2 bg-pink-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center">

                    {{ \App\Models\Cart::where('user_id', auth()->id())->count() }}

                </span>

            </a>

        </div>


        <!-- USER -->
        <div class="flex items-center gap-4">

            <div
                class="w-12 h-12 rounded-full bg-pink-100
                    flex items-center justify-center
                    text-pink-500 font-bold">

                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

            </div>

            <div>
                <h3 class="font-bold">
                    {{ auth()->user()->name }}
                </h3>

                <p class="text-gray-400 text-sm capitalize">
                    {{ auth()->user()->role }}
                </p>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button class="text-red-500 font-semibold">
                    Logout
                </button>
            </form>

        </div>

    </nav>
    @yield('content')

</body>

</html>
