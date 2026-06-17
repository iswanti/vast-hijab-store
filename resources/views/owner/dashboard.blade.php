@extends('layouts.app')

@section('content')
    <div class="space-y-8">

        ```
        <!-- HEADER -->
        <div class="flex flex-col md:flex-row justify-between items-center">

            <div>

                <h1 class="text-4xl font-bold text-gray-800">

                    Dashboard Owner

                </h1>

                <p class="text-gray-500 mt-2">

                    Ringkasan performa bisnis dan penjualan Vast Hijab Store

                </p>

            </div>

        </div>

        <!-- CARD STATISTIK -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-white rounded-3xl shadow-sm p-6 border-l-4 border-green-500">

                <p class="text-gray-500 text-sm">

                    Total Pendapatan

                </p>

                <h2 class="text-3xl font-bold text-green-500 mt-3">

                    Rp {{ number_format($totalPendapatan, 0, ',', '.') }}

                </h2>

                <p class="text-sm text-gray-400 mt-2">

                    Pendapatan dari transaksi selesai

                </p>

            </div>

            <div class="bg-white rounded-3xl shadow-sm p-6 border-l-4 border-blue-500">

                <p class="text-gray-500 text-sm">

                    Pesanan Selesai

                </p>

                <h2 class="text-3xl font-bold text-blue-500 mt-3">

                    {{ $pesananSelesai }}

                </h2>

                <p class="text-sm text-gray-400 mt-2">

                    Total transaksi berhasil

                </p>

            </div>

            <div class="bg-white rounded-3xl shadow-sm p-6 border-l-4 border-pink-500">

                <p class="text-gray-500 text-sm">

                    Total Produk

                </p>

                <h2 class="text-3xl font-bold text-pink-500 mt-3">

                    {{ $totalProduk }}

                </h2>

                <p class="text-sm text-gray-400 mt-2">

                    Produk aktif di katalog

                </p>

            </div>

            <div class="bg-white rounded-3xl shadow-sm p-6 border-l-4 border-purple-500">

                <p class="text-gray-500 text-sm">

                    Total Customer

                </p>

                <h2 class="text-3xl font-bold text-purple-500 mt-3">

                    {{ $totalUser }}

                </h2>

                <p class="text-sm text-gray-400 mt-2">

                    Customer terdaftar

                </p>

            </div>

        </div>

        <!-- GRAFIK -->
        <div class="bg-white rounded-3xl shadow-sm p-6">

            <div class="flex justify-between items-center mb-6">

                <div>

                    <h2 class="text-2xl font-bold text-gray-800">

                        Grafik Pendapatan Bulanan

                    </h2>

                    <p class="text-sm text-gray-500 mt-1">

                        Monitoring perkembangan pendapatan setiap bulan

                    </p>

                </div>

            </div>

            <div style="height:400px">

                <canvas id="chartPendapatan"></canvas>

            </div>

        </div>

        <!-- PRODUK TERLARIS -->
        <div class="bg-white rounded-3xl shadow-sm p-6">

            <div class="mb-6">

                <h2 class="text-2xl font-bold text-gray-800">

                    Produk Terlaris

                </h2>

                <p class="text-sm text-gray-500 mt-1">

                    Produk dengan jumlah penjualan tertinggi

                </p>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-5">

                @foreach ($produkTerlaris as $item)
                    <div class="bg-white border border-gray-100 rounded-3xl overflow-hidden hover:shadow-lg transition">

                        <img src="{{ asset('storage/' . $item->product->gambar) }}" class="w-full h-48 object-cover">

                        <div class="p-5">

                            <h3 class="font-bold text-gray-800">

                                {{ $item->product->nama }}

                            </h3>

                            <p class="text-gray-500 text-sm mt-2">

                                Produk Terlaris

                            </p>

                            <div class="mt-4">

                                <span class="bg-pink-100 text-pink-600 px-4 py-2 rounded-full text-sm font-semibold">

                                    Terjual {{ $item->total_terjual }} pcs

                                </span>

                            </div>

                        </div>

                    </div>
                @endforeach

            </div>

        </div>

        <!-- TRANSAKSI TERBARU -->
        <div class="bg-white rounded-3xl shadow-sm p-6">

            <div class="mb-6">

                <h2 class="text-2xl font-bold text-gray-800">

                    Transaksi Terbaru

                </h2>

                <p class="text-sm text-gray-500 mt-1">

                    Aktivitas transaksi terbaru pelanggan

                </p>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>

                        <tr class="bg-pink-50 text-gray-700">

                            <th class="p-4 text-left">

                                Invoice

                            </th>

                            <th class="p-4 text-left">

                                Customer

                            </th>

                            <th class="p-4 text-left">

                                Tanggal

                            </th>

                            <th class="p-4 text-left">

                                Total

                            </th>

                            <th class="p-4 text-left">

                                Status

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($transaksiTerbaru as $order)
                            <tr class="border-b hover:bg-gray-50">

                                <td class="p-4 font-medium">

                                    {{ $order->invoice }}

                                </td>

                                <td class="p-4">

                                    {{ $order->user->name }}

                                </td>

                                <td class="p-4">

                                    {{ $order->created_at->format('d M Y') }}

                                </td>

                                <td class="p-4 font-semibold text-pink-500">

                                    Rp {{ number_format($order->total, 0, ',', '.') }}

                                </td>

                                <td class="p-4">

                                    <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm">

                                        {{ $order->status }}

                                    </span>

                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>
        ```

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('chartPendapatan');

        new Chart(ctx, {

            type: 'line',

            data: {

                labels: @json($bulan),

                datasets: [{

                    label: 'Pendapatan',

                    data: @json($pendapatan),

                    borderColor: '#ec4899',

                    backgroundColor: 'rgba(236,72,153,0.15)',

                    fill: true,

                    tension: 0.4,

                    borderWidth: 3

                }]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false

            }

        });
    </script>
@endsection
