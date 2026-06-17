@extends('layouts.app')

@section('content')
    <div class="space-y-6">

        {{-- HEADER --}}
        <div>

            <h1 class="text-3xl font-bold">

                Laporan Penjualan

            </h1>

            <p class="text-gray-500 mt-1">

                Monitoring transaksi dan pendapatan Vast Hijab Store

            </p>

        </div>

        {{-- FILTER --}}
        <div class="bg-white rounded-2xl shadow p-6">

            <form method="GET">

                <div class="flex flex-wrap gap-4 items-end">

                    <div>

                        <label class="block font-semibold mb-2">

                            Pilih Bulan

                        </label>

                        <select name="bulan" class="border rounded-xl px-4 py-2">

                            <option value="">
                                Semua Bulan
                            </option>

                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>

                                    {{ DateTime::createFromFormat('!m', $i)->format('F') }}

                                </option>
                            @endfor

                        </select>

                    </div>

                    <button class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2 rounded-xl">

                        Filter

                    </button>

                    <a href="{{ route('owner.laporan.pdf', ['bulan' => $bulan]) }}"
                        class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-xl">

                        Export PDF

                    </a>

                </div>

            </form>

        </div>

        {{-- CARD --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="bg-green-500 text-white rounded-2xl p-6 shadow-lg">

                <p class="opacity-80">
                    Total Pendapatan
                </p>

                <h2 class="text-4xl font-bold mt-2">

                    Rp {{ number_format($totalPendapatan, 0, ',', '.') }}

                </h2>

            </div>

            <div class="bg-blue-500 text-white rounded-2xl p-6 shadow-lg">

                <p class="opacity-80">
                    Total Transaksi
                </p>

                <h2 class="text-4xl font-bold mt-2">

                    {{ $orders->count() }}

                </h2>

            </div>

            <div class="bg-pink-500 text-white rounded-2xl p-6 shadow-lg">

                <p class="opacity-80">
                    Produk Terjual
                </p>

                <h2 class="text-4xl font-bold mt-2">

                    {{ $produkTerjual }}

                </h2>

            </div>

        </div>

        {{-- TABEL --}}
        <div class="bg-white rounded-2xl shadow p-6">

            <h2 class="text-2xl font-bold mb-5">

                Data Penjualan

            </h2>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>

                        <tr class="bg-pink-100">

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
                                Status
                            </th>

                            <th class="p-4 text-left">
                                Total
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($orders as $order)
                            <tr class="border-b hover:bg-pink-50">

                                <td class="p-4">

                                    {{ $order->invoice }}

                                </td>

                                <td class="p-4">

                                    {{ $order->user->name }}

                                </td>

                                <td class="p-4">

                                    {{ $order->created_at->format('d M Y') }}

                                </td>

                                <td class="p-4">

                                    @if ($order->status == 'Selesai')
                                        <span class="bg-green-100 text-green-600 px-4 py-2 rounded-full text-sm">

                                            {{ $order->status }}

                                        </span>
                                    @elseif($order->status == 'Dikirim')
                                        <span class="bg-purple-100 text-purple-600 px-4 py-2 rounded-full text-sm">

                                            {{ $order->status }}

                                        </span>
                                    @elseif($order->status == 'Diproses')
                                        <span class="bg-blue-100 text-blue-600 px-4 py-2 rounded-full text-sm">

                                            {{ $order->status }}

                                        </span>
                                    @else
                                        <span class="bg-red-100 text-red-600 px-4 py-2 rounded-full text-sm">

                                            {{ $order->status }}

                                        </span>
                                    @endif

                                </td>

                                <td class="p-4 font-bold text-green-600">

                                    Rp {{ number_format($order->total, 0, ',', '.') }}

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="text-center p-8 text-gray-400">

                                    Tidak ada data penjualan

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>
@endsection
