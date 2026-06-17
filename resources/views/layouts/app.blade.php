<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Vast Hijab Store</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body class="bg-gray-100">

    <div class="flex min-h-screen">

        <!-- SIDEBAR -->
        <aside class="w-[260px] bg-white border-r shadow-sm">

            <!-- LOGO -->
            <div class="flex items-center gap-3 px-5 py-5 border-b">

                <img src="{{ asset('logo.png') }}" class="w-10 h-10 object-contain">

                <div>

                    <h1 class="font-bold text-gray-800 text-sm">

                        VAST HIJAB STORE

                    </h1>

                    <p class="text-xs text-gray-400">

                        Management System

                    </p>

                </div>

            </div>

            <!-- MENU -->
            <div class="p-4 text-sm space-y-2">

                <!-- DASHBOARD -->
                <a href="{{ auth()->user()->role == 'superadmin'
                    ? route('superadmin.dashboard')
                    : (auth()->user()->role == 'admin'
                        ? route('admin.dashboard')
                        : route('owner.dashboard')) }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->is('superadmin') || request()->is('admin') || request()->is('owner')
                        ? 'bg-pink-500 text-white shadow'
                        : 'hover:bg-pink-100 text-gray-700' }}">

                    <i class="fa-solid fa-house"></i>

                    <span>Dashboard</span>

                </a>

                <!-- DATA ADMIN -->
                @if (auth()->user()->role == 'superadmin')
                    <a href="{{ route('data.admin') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                        {{ request()->is('data-admin*') ? 'bg-pink-500 text-white shadow' : 'hover:bg-pink-100 text-gray-700' }}">

                        <i class="fa-solid fa-user-shield"></i>

                        <span>Kelola Admin</span>

                    </a>
                @endif

                <!-- DATA USER -->
                @if (auth()->user()->role == 'superadmin' || auth()->user()->role == 'admin')
                    <a href="{{ route('data.user') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                        {{ request()->is('data-user*') ? 'bg-pink-500 text-white shadow' : 'hover:bg-pink-100 text-gray-700' }}">

                        <i class="fa-solid fa-users"></i>

                        <span>Data User</span>

                    </a>
                @endif

                <!-- PRODUCT -->
                <a href="{{ route('product.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->is('product*') ? 'bg-pink-500 text-white shadow' : 'hover:bg-pink-100 text-gray-700' }}">

                    <i class="fa-solid fa-box"></i>

                    <span>Produk</span>

                </a>

                <!-- TRANSAKSI -->
                @if (auth()->user()->role == 'superadmin' || auth()->user()->role == 'admin')
                    <a href="{{ route('orders.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                        {{ request()->is('orders*') ? 'bg-pink-500 text-white shadow' : 'hover:bg-pink-100 text-gray-700' }}">

                        <i class="fa-solid fa-money-bill-wave"></i>

                        <span>Transaksi</span>

                    </a>
                @endif

                <!-- LAPORAN -->
                @if (auth()->user()->role == 'admin')
                    <a href="{{ route('admin.laporan') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                        {{ request()->routeIs('admin.laporan') ? 'bg-pink-500 text-white shadow' : 'hover:bg-pink-100 text-gray-700' }}">

                        <i class="fa-solid fa-chart-line"></i>

                        <span>Laporan Penjualan</span>

                    </a>
                @elseif(auth()->user()->role == 'owner')
                    <a href="{{ route('owner.laporan') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                        {{ request()->routeIs('owner.laporan') ? 'bg-pink-500 text-white shadow' : 'hover:bg-pink-100 text-gray-700' }}">

                        <i class="fa-solid fa-chart-line"></i>

                        <span>Laporan Penjualan</span>

                    </a>
                @elseif(auth()->user()->role == 'superadmin')
                    <a href="{{ route('superadmin.laporan') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                        {{ request()->routeIs('superadmin.laporan')
                            ? 'bg-pink-500 text-white shadow'
                            : 'hover:bg-pink-100 text-gray-700' }}">

                        <i class="fa-solid fa-chart-line"></i>

                        <span>Laporan Penjualan</span>

                    </a>
                @endif

            </div>

        </aside>

        <!-- MAIN -->
        <main class="flex-1">

            <!-- NAVBAR -->
            <nav class="bg-white border-b px-6 py-4 flex justify-between items-center">

                <h1 class="text-2xl font-bold text-gray-800">

                    @if (auth()->user()->role == 'superadmin')
                        Dashboard Super Admin
                    @elseif(auth()->user()->role == 'admin')
                        Dashboard Administrasi
                    @elseif(auth()->user()->role == 'owner')
                        Dashboard Owner
                    @endif

                </h1>

                @php

                    $adminNotif = \App\Models\Notification::where('role', 'admin')->where('is_read', false)->count();

                @endphp

                <div class="flex items-center gap-5">

                    @if (auth()->user()->role == 'superadmin' || auth()->user()->role == 'admin')

                        <a href="{{ route('notifications.admin') }}" class="relative">

                            <i class="fa-solid fa-bell text-xl text-gray-600"></i>

                            @if ($adminNotif > 0)
                                <span
                                    class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] px-2 py-1 rounded-full">

                                    {{ $adminNotif }}

                                </span>
                            @endif

                        </a>

                    @endif

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-full border flex items-center justify-center bg-gray-50">

                            <i class="fa-regular fa-user"></i>

                        </div>

                        <div>

                            <h2 class="font-semibold text-sm">

                                {{ auth()->user()->name }}

                            </h2>

                            <p class="text-xs text-gray-400">

                                @if (auth()->user()->role == 'superadmin')
                                    Super Admin
                                @elseif(auth()->user()->role == 'admin')
                                    Administrasi
                                @elseif(auth()->user()->role == 'owner')
                                    Pemilik Toko
                                @else
                                    Customer
                                @endif

                            </p>

                        </div>

                    </div>

                    <form method="POST" action="{{ route('logout') }}">

                        @csrf

                        <button class="text-red-500 hover:text-red-600 font-medium">

                            <i class="fa-solid fa-right-from-bracket mr-1"></i>

                            Logout

                        </button>

                    </form>

                </div>

            </nav>

            <!-- CONTENT -->
            <div class="p-6">

                @yield('content')

            </div>

        </main>

    </div>

    @if (session('success'))
        <script>
            Swal.fire({

                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                confirmButtonColor: '#ec4899'

            });
        </script>
    @endif

</body>

</html>
```
