@extends('layouts.app')

@section('content')
    <div class="space-y-6">

        <h1 class="text-3xl font-bold">

            Laporan Transaksi Admin

        </h1>

        {{-- FILTER --}}
        <div class="bg-white p-6 rounded-2xl shadow">
            <form method="GET">

                <div class="flex gap-4 flex-wrap">

                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari invoice atau customer..." class="border rounded-xl px-4 py-2 w-72">

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

                    <button class="bg-pink-500 text-white px-6 rounded-xl">

                        Filter

                    </button>

                </div>

            </form>

        </div>

        {{-- CARD --}}
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">

            <div class="bg-blue-500 text-white p-6 rounded-2xl shadow">

                <p>Total Transaksi</p>

                <h2 class="text-4xl font-bold mt-2">

                    {{ $totalTransaksi }}

                </h2>

            </div>

            <div class="bg-yellow-500 text-white p-6 rounded-2xl shadow">

                <p>Menunggu</p>

                <h2 class="text-4xl font-bold mt-2">

                    {{ $menunggu }}

                </h2>

            </div>

            <div class="bg-indigo-500 text-white p-6 rounded-2xl shadow">

                <p>Diproses</p>

                <h2 class="text-4xl font-bold mt-2">

                    {{ $diproses }}

                </h2>

            </div>

            <div class="bg-purple-500 text-white p-6 rounded-2xl shadow">

                <p>Dikirim</p>

                <h2 class="text-4xl font-bold mt-2">

                    {{ $dikirim }}

                </h2>

            </div>

            <div class="bg-green-500 text-white p-6 rounded-2xl shadow">

                <p>Selesai</p>

                <h2 class="text-4xl font-bold mt-2">

                    {{ $selesai }}

                </h2>

            </div>

        </div>

        {{-- TABEL --}}
        <div class="bg-white rounded-2xl shadow overflow-hidden">

            <div class="p-6 border-b">

                <h2 class="text-xl font-bold">

                    Riwayat Transaksi

                </h2>

            </div>

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

                    @forelse ($orders as $order)
                        <tr class="border-b">

                            <td class="p-4">

                                {{ $order->invoice }}

                            </td>

                            <td class="p-4">

                                {{ $order->user->name }}

                            </td>

                            <td class="p-4">

                                {{ $order->created_at->format('d-m-Y') }}

                            </td>

                            <td class="p-4">

                                @if ($order->status == 'Menunggu Konfirmasi')
                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">

                                        {{ $order->status }}

                                    </span>
                                @elseif ($order->status == 'Diproses')
                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">

                                        {{ $order->status }}

                                    </span>
                                @elseif ($order->status == 'Dikirim')
                                    <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm">

                                        {{ $order->status }}

                                    </span>
                                @else
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                                        {{ $order->status }}

                                    </span>
                                @endif

                            </td>

                            <td class="p-4">

                                Rp {{ number_format($order->total, 0, ',', '.') }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="text-center p-6 text-gray-500">

                                Tidak ada data transaksi

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
@endsection
