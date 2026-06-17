@extends('layouts.user')

@section('content')
    <div class="max-w-7xl mx-auto py-8">

        <!-- HEADER -->
        <div class="mb-8">

            <h1 class="text-4xl font-bold text-gray-800">
                Riwayat Transaksi
            </h1>

            <p class="text-gray-500 mt-2">
                Pantau seluruh transaksi dan status pesanan Anda di Vast Hijab Store
            </p>

        </div>

        <!-- SUMMARY -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

            <div class="bg-white rounded-3xl shadow-sm p-6 border-l-4 border-pink-500">

                <p class="text-gray-500 text-sm">
                    Total Transaksi
                </p>

                <h2 class="text-4xl font-bold text-pink-500 mt-2">
                    {{ $orders->count() }}
                </h2>

            </div>

            <div class="bg-white rounded-3xl shadow-sm p-6 border-l-4 border-yellow-500">

                <p class="text-gray-500 text-sm">
                    Menunggu
                </p>

                <h2 class="text-4xl font-bold text-yellow-500 mt-2">
                    {{ $orders->where('status', 'Menunggu Konfirmasi')->count() }}
                </h2>

            </div>

            <div class="bg-white rounded-3xl shadow-sm p-6 border-l-4 border-blue-500">

                <p class="text-gray-500 text-sm">
                    Diproses
                </p>

                <h2 class="text-4xl font-bold text-blue-500 mt-2">
                    {{ $orders->where('status', 'Diproses')->count() }}
                </h2>

            </div>

            <div class="bg-white rounded-3xl shadow-sm p-6 border-l-4 border-green-500">

                <p class="text-gray-500 text-sm">
                    Selesai
                </p>

                <h2 class="text-4xl font-bold text-green-500 mt-2">
                    {{ $orders->where('status', 'Selesai')->count() }}
                </h2>

            </div>

        </div>

        <!-- SEARCH -->
        <div class="bg-white rounded-3xl shadow-sm p-6 mb-6">

            <div class="relative">

                <input type="text" id="searchInvoice" placeholder="Cari invoice..."
                    class="w-full border border-gray-200 rounded-2xl px-5 py-3 focus:outline-none focus:ring-2 focus:ring-pink-500">

            </div>

        </div>

        <!-- TABLE -->
        <div class="bg-white rounded-3xl shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b">

                <h2 class="text-xl font-bold text-gray-800">
                    Daftar Transaksi
                </h2>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>

                        <tr class="bg-gray-50 text-gray-700">

                            <th class="p-5 text-left font-semibold">
                                Invoice
                            </th>

                            <th class="p-5 text-left font-semibold">
                                Tanggal
                            </th>

                            <th class="p-5 text-left font-semibold">
                                Total
                            </th>

                            <th class="p-5 text-left font-semibold">
                                Status
                            </th>

                            <th class="p-5 text-center font-semibold">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody id="tableOrder">

                        @forelse($orders as $order)
                            <tr class="border-b hover:bg-pink-50 transition">

                                <td class="p-5 font-semibold text-gray-800">

                                    {{ $order->invoice }}

                                </td>

                                <td class="p-5 text-gray-600">

                                    {{ $order->created_at->format('d M Y') }}

                                </td>

                                <td class="p-5">

                                    <span class="font-bold text-pink-500">

                                        Rp {{ number_format($order->total, 0, ',', '.') }}

                                    </span>

                                </td>

                                <td class="p-5">

                                    @if ($order->status == 'Menunggu Konfirmasi')
                                        <span
                                            class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm font-semibold">

                                            Menunggu

                                        </span>
                                    @elseif($order->status == 'Diproses')
                                        <span
                                            class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-semibold">

                                            Diproses

                                        </span>
                                    @elseif($order->status == 'Dikirim')
                                        <span
                                            class="bg-purple-100 text-purple-700 px-4 py-2 rounded-full text-sm font-semibold">

                                            Dikirim

                                        </span>
                                    @elseif($order->status == 'Selesai')
                                        <span
                                            class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold">

                                            Selesai

                                        </span>
                                    @else
                                        <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-semibold">

                                            Dibatalkan

                                        </span>
                                    @endif

                                </td>

                                <td class="p-5 text-center">

                                    <a href="{{ route('transaksi.detail', $order->id) }}"
                                        class="inline-flex items-center gap-2 bg-pink-500 hover:bg-pink-600 text-white px-5 py-3 rounded-xl font-semibold transition">

                                        Detail

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="p-16 text-center">

                                    <div>

                                        <h3 class="text-xl font-semibold text-gray-500">

                                            Belum Ada Transaksi

                                        </h3>

                                        <p class="text-gray-400 mt-2">

                                            Pesanan yang Anda buat akan muncul di sini.

                                        </p>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <script>
        document.getElementById('searchInvoice').addEventListener('keyup', function() {

            let value = this.value.toLowerCase();

            let rows = document.querySelectorAll('#tableOrder tr');

            rows.forEach(row => {

                row.style.display =
                    row.innerText.toLowerCase().includes(value) ?
                    '' :
                    'none';

            });

        });
    </script>
@endsection
