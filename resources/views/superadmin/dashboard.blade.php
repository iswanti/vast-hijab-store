@extends('layouts.app')

@section('content')
    <div class="space-y-8">

        <!-- HEADER -->
        <div class="bg-gradient-to-r from-pink-500 to-pink-600 rounded-3xl p-8 text-white shadow-lg">

            <h1 class="text-4xl font-bold">
                Dashboard Super Admin
            </h1>

            <p class="mt-3 text-pink-100 text-lg">
                Monitoring dan pengelolaan seluruh aktivitas Sistem Informasi Penjualan Vast Hijab Store.
            </p>

        </div>

        <!-- STATISTIK UTAMA -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

            <div class="bg-white rounded-3xl p-6 shadow-sm border-l-4 border-blue-500">

                <div class="flex justify-between items-center">

                    <div>

                        <p class="text-gray-500">
                            Total Admin
                        </p>

                        <h2 class="text-4xl font-bold text-gray-800 mt-2">
                            {{ $totalAdmin }}
                        </h2>

                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center">

                        <i class="fa-solid fa-user-shield text-blue-600 text-2xl"></i>

                    </div>

                </div>

            </div>

            <div class="bg-white rounded-3xl p-6 shadow-sm border-l-4 border-green-500">

                <div class="flex justify-between items-center">

                    <div>

                        <p class="text-gray-500">
                            Total Customer
                        </p>

                        <h2 class="text-4xl font-bold text-gray-800 mt-2">
                            {{ $totalUser }}
                        </h2>

                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center">

                        <i class="fa-solid fa-users text-green-600 text-2xl"></i>

                    </div>

                </div>

            </div>

            <div class="bg-white rounded-3xl p-6 shadow-sm border-l-4 border-pink-500">

                <div class="flex justify-between items-center">

                    <div>

                        <p class="text-gray-500">
                            Total Produk
                        </p>

                        <h2 class="text-4xl font-bold text-gray-800 mt-2">
                            {{ $totalProduk }}
                        </h2>

                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-pink-100 flex items-center justify-center">

                        <i class="fa-solid fa-box text-pink-600 text-2xl"></i>

                    </div>

                </div>

            </div>

            <div class="bg-white rounded-3xl p-6 shadow-sm border-l-4 border-purple-500">

                <div class="flex justify-between items-center">

                    <div>

                        <p class="text-gray-500">
                            Total Pesanan
                        </p>

                        <h2 class="text-4xl font-bold text-gray-800 mt-2">
                            {{ $totalOrder }}
                        </h2>

                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-purple-100 flex items-center justify-center">

                        <i class="fa-solid fa-cart-shopping text-purple-600 text-2xl"></i>

                    </div>

                </div>

            </div>

        </div>
        <div class="bg-white rounded-3xl p-6 shadow-sm">

            <h2 class="text-xl font-bold text-gray-800 mb-6">
                Status Pesanan
            </h2>

            <div class="grid grid-cols-2 md:grid-cols-5 gap-5">

                <div class="bg-yellow-50 rounded-2xl p-5 border">
                    <p class="text-yellow-600 font-semibold">Menunggu</p>
                    <h2 class="text-3xl font-bold mt-2">{{ $menunggu }}</h2>
                </div>

                <div class="bg-blue-50 rounded-2xl p-5 border">
                    <p class="text-blue-600 font-semibold">Diproses</p>
                    <h2 class="text-3xl font-bold mt-2">{{ $diproses }}</h2>
                </div>

                <div class="bg-purple-50 rounded-2xl p-5 border">
                    <p class="text-purple-600 font-semibold">Dikirim</p>
                    <h2 class="text-3xl font-bold mt-2">{{ $dikirim }}</h2>
                </div>

                <div class="bg-green-50 rounded-2xl p-5 border">
                    <p class="text-green-600 font-semibold">Selesai</p>
                    <h2 class="text-3xl font-bold mt-2">{{ $selesai }}</h2>
                </div>

                <div class="bg-red-50 rounded-2xl p-5 border">
                    <p class="text-red-600 font-semibold">Dibatalkan</p>
                    <h2 class="text-3xl font-bold mt-2">{{ $dibatalkan }}</h2>
                </div>

            </div>

        </div>

        {{-- GRAFIK PESANAN  --}}
        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-2xl font-bold mb-5"> 📈 Grafik Transaksi Bulanan </h2>
            <div style="height:400px"> <canvas id="chartTransaksi"></canvas> </div>


            {{-- PESANAN TERBARU --}}
            ```blade
            <div class="bg-white rounded-3xl shadow-sm overflow-hidden">

                <!-- HEADER -->
                <div class="flex justify-between items-center px-6 py-5 border-b">

                    <div>

                        <h2 class="text-2xl font-bold text-gray-800">
                            Transaksi Terbaru
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            Monitoring transaksi pelanggan terbaru.
                        </p>

                    </div>

                    <a href="{{ route('orders.index') }}"
                        class="bg-pink-500 hover:bg-pink-600 text-white px-5 py-2 rounded-xl text-sm font-medium transition">

                        Lihat Semua

                    </a>

                </div>

                <!-- TABLE -->
                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead>

                            <tr class="bg-gray-50 text-gray-600 text-sm uppercase">

                                <th class="px-6 py-4 text-left">
                                    Invoice
                                </th>

                                <th class="px-6 py-4 text-left">
                                    Customer
                                </th>

                                <th class="px-6 py-4 text-left">
                                    Tanggal
                                </th>

                                <th class="px-6 py-4 text-left">
                                    Total
                                </th>

                                <th class="px-6 py-4 text-center">
                                    Status
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($pesananTerbaru as $order)
                                <tr class="border-b hover:bg-gray-50 transition">

                                    <td class="px-6 py-4">

                                        <div>

                                            <h4 class="font-semibold text-gray-800">
                                                {{ $order->invoice }}
                                            </h4>

                                            <p class="text-xs text-gray-400">
                                                Order ID #{{ $order->id }}
                                            </p>

                                        </div>

                                    </td>

                                    <td class="px-6 py-4">

                                        <div class="flex items-center gap-3">

                                            <div
                                                class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center">

                                                <i class="fa-solid fa-user text-pink-500"></i>

                                            </div>

                                            <div>

                                                <h4 class="font-medium text-gray-800">
                                                    {{ $order->user->name }}
                                                </h4>

                                                <p class="text-xs text-gray-400">
                                                    Customer
                                                </p>

                                            </div>

                                        </div>

                                    </td>

                                    <td class="px-6 py-4 text-gray-600">

                                        {{ $order->created_at->format('d M Y') }}

                                    </td>

                                    <td class="px-6 py-4">

                                        <span class="font-bold text-gray-800">

                                            Rp {{ number_format($order->total, 0, ',', '.') }}

                                        </span>

                                    </td>

                                    <td class="px-6 py-4 text-center">

                                        @if ($order->status == 'Menunggu Konfirmasi')
                                            <span
                                                class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-xs font-semibold">

                                                Menunggu

                                            </span>
                                        @elseif($order->status == 'Diproses')
                                            <span
                                                class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-xs font-semibold">

                                                Diproses

                                            </span>
                                        @elseif($order->status == 'Dikirim')
                                            <span
                                                class="bg-purple-100 text-purple-700 px-4 py-2 rounded-full text-xs font-semibold">

                                                Dikirim

                                            </span>
                                        @elseif($order->status == 'Selesai')
                                            <span
                                                class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-xs font-semibold">

                                                Selesai

                                            </span>
                                        @else
                                            <span
                                                class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-xs font-semibold">

                                                Dibatalkan

                                            </span>
                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5" class="text-center py-10 text-gray-400">

                                        Belum ada transaksi.

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const ctx =
                document.getElementById('chartTransaksi');

            new Chart(ctx, {

                type: 'bar',

                data: {

                    labels: @json($bulan),

                    datasets: [{

                        label: 'Jumlah Transaksi',

                        data: @json($jumlahTransaksi),

                        backgroundColor: '#ec4899'

                    }]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false

                }

            });
        </script>

    </div>
@endsection
