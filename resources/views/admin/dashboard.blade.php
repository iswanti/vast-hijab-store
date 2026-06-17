@extends('layouts.app')

@section('content')
    <div class="space-y-8">

        <!-- HEADER -->
        <div class="bg-gradient-to-r from-pink-500 via-pink-400 to-pink-500 rounded-3xl p-8 text-white shadow-lg">

            <div class="flex justify-between items-center">

                <div>

                    <h1 class="text-4xl font-bold">

                        Dashboard Administrasi

                    </h1>

                    <p class="mt-3 text-pink-100">

                        Selamat datang kembali. Kelola produk, pesanan dan aktivitas pelanggan Vast Hijab Store.

                    </p>

                </div>

                <div>

                    <i class="fa-solid fa-chart-line text-7xl opacity-20"></i>

                </div>

            </div>

        </div>

        <!-- STATISTIK -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

            <!-- TOTAL PESANAN -->
            <div class="bg-white rounded-3xl p-6 shadow-sm">

                <div class="flex justify-between items-center">

                    <div>

                        <p class="text-gray-500">

                            Total Pesanan

                        </p>

                        <h2 class="text-4xl font-bold mt-2 text-gray-800">

                            {{ $totalPesanan }}

                        </h2>

                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-pink-100 flex items-center justify-center">

                        <i class="fa-solid fa-cart-shopping text-pink-500 text-2xl"></i>

                    </div>

                </div>

            </div>

            <!-- MENUNGGU -->
            <div class="bg-white rounded-3xl p-6 shadow-sm">

                <div class="flex justify-between items-center">

                    <div>

                        <p class="text-gray-500">

                            Menunggu Konfirmasi

                        </p>

                        <h2 class="text-4xl font-bold mt-2 text-yellow-500">

                            {{ $menunggu }}

                        </h2>

                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center">

                        <i class="fa-solid fa-clock text-yellow-500 text-2xl"></i>

                    </div>

                </div>

            </div>

            <!-- DIPROSES -->
            <div class="bg-white rounded-3xl p-6 shadow-sm">

                <div class="flex justify-between items-center">

                    <div>

                        <p class="text-gray-500">

                            Sedang Diproses

                        </p>

                        <h2 class="text-4xl font-bold mt-2 text-blue-500">

                            {{ $diproses }}

                        </h2>

                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center">

                        <i class="fa-solid fa-gears text-blue-500 text-2xl"></i>

                    </div>

                </div>

            </div>

            <!-- DIKIRIM -->
            <div class="bg-white rounded-3xl p-6 shadow-sm">

                <div class="flex justify-between items-center">

                    <div>

                        <p class="text-gray-500">

                            Sudah Dikirim

                        </p>

                        <h2 class="text-4xl font-bold mt-2 text-green-500">

                            {{ $dikirim }}

                        </h2>

                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center">

                        <i class="fa-solid fa-truck text-green-500 text-2xl"></i>

                    </div>

                </div>

            </div>

        </div>

        <!-- PRODUK & USER -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <div class="bg-white rounded-3xl p-6 shadow-sm">

                <div class="flex justify-between items-center">

                    <div>

                        <p class="text-gray-500">

                            Total Produk

                        </p>

                        <h2 class="text-5xl font-bold text-pink-500 mt-3">

                            {{ $totalProduk }}

                        </h2>

                        <p class="text-gray-400 mt-2">

                            Produk aktif dalam sistem

                        </p>

                    </div>

                    <i class="fa-solid fa-box text-6xl text-pink-100"></i>

                </div>

            </div>

            <div class="bg-white rounded-3xl p-6 shadow-sm">

                <div class="flex justify-between items-center">

                    <div>

                        <p class="text-gray-500">

                            Total Customer

                        </p>

                        <h2 class="text-5xl font-bold text-purple-500 mt-3">

                            {{ $totalUser }}

                        </h2>

                        <p class="text-gray-400 mt-2">

                            Pelanggan terdaftar

                        </p>

                    </div>

                    <i class="fa-solid fa-users text-6xl text-purple-100"></i>

                </div>

            </div>

        </div>

        <!-- QUICK MENU -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <a href="{{ route('orders.index') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white p-6 rounded-3xl shadow transition">

                <i class="fa-solid fa-cart-shopping text-3xl"></i>

                <h2 class="font-bold text-xl mt-4">

                    Kelola Pesanan

                </h2>

                <p class="mt-2 text-blue-100">

                    Konfirmasi dan proses pesanan pelanggan.

                </p>

            </a>

            <a href="{{ route('product.index') }}"
                class="bg-pink-500 hover:bg-pink-600 text-white p-6 rounded-3xl shadow transition">

                <i class="fa-solid fa-box text-3xl"></i>

                <h2 class="font-bold text-xl mt-4">

                    Kelola Produk

                </h2>

                <p class="mt-2 text-pink-100">

                    Tambah, edit dan hapus produk.

                </p>

            </a>

            <a href="{{ route('notifications.admin') }}"
                class="bg-green-500 hover:bg-green-600 text-white p-6 rounded-3xl shadow transition">

                <i class="fa-solid fa-bell text-3xl"></i>

                <h2 class="font-bold text-xl mt-4">

                    Notifikasi

                </h2>

                <p class="mt-2 text-green-100">

                    Informasi transaksi terbaru.

                </p>

            </a>

        </div>

        <!-- TRANSAKSI TERBARU -->
        <div class="bg-white rounded-3xl shadow-sm overflow-hidden">

            <div class="flex justify-between items-center px-6 py-5 border-b">

                <div>

                    <h2 class="text-2xl font-bold text-gray-800">

                        Transaksi Terbaru

                    </h2>

                    <p class="text-gray-500 text-sm mt-1">

                        Daftar pesanan pelanggan terbaru.

                    </p>

                </div>

                <a href="{{ route('orders.index') }}" class="bg-pink-500 hover:bg-pink-600 text-white px-5 py-2 rounded-xl">

                    Lihat Semua

                </a>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>

                        <tr class="bg-gray-50">

                            <th class="p-4 text-left">Invoice</th>
                            <th class="p-4 text-left">Customer</th>
                            <th class="p-4 text-left">Total</th>
                            <th class="p-4 text-center">Status</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($pesananTerbaru as $order)
                            <tr class="border-b hover:bg-gray-50">

                                <td class="p-4 font-semibold">

                                    {{ $order->invoice }}

                                </td>

                                <td class="p-4">

                                    {{ $order->user->name }}

                                </td>

                                <td class="p-4 font-bold text-pink-500">

                                    Rp {{ number_format($order->total, 0, ',', '.') }}

                                </td>

                                <td class="p-4 text-center">

                                    @if ($order->status == 'Menunggu Konfirmasi')
                                        <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm">

                                            {{ $order->status }}

                                        </span>
                                    @elseif($order->status == 'Diproses')
                                        <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm">

                                            {{ $order->status }}

                                        </span>
                                    @elseif($order->status == 'Dikirim')
                                        <span class="bg-purple-100 text-purple-700 px-4 py-2 rounded-full text-sm">

                                            {{ $order->status }}

                                        </span>
                                    @else
                                        <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm">

                                            {{ $order->status }}

                                        </span>
                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" class="text-center py-10 text-gray-400">

                                    Belum ada transaksi.

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>
@endsection
