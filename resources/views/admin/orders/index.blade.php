@extends('layouts.app')

@section('content')
    <div class="space-y-8">

        <!-- HEADER -->
        <div class="bg-gradient-to-r from-pink-500 to-pink-600 rounded-3xl p-8 text-white shadow-lg">

            <div class="flex justify-between items-center">

                <div>

                    <h1 class="text-4xl font-bold">

                        Manajemen Pesanan

                    </h1>

                    <p class="mt-3 text-pink-100">

                        Kelola dan pantau seluruh transaksi pelanggan Vast Hijab Store secara real-time.

                    </p>

                </div>

                <div>

                    <i class="fa-solid fa-cart-shopping text-7xl opacity-20"></i>

                </div>

            </div>

        </div>

        <!-- STATISTIK -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

            <div class="bg-white rounded-3xl p-6 shadow-sm border-l-4 border-yellow-500">

                <div class="flex justify-between items-center">

                    <div>

                        <p class="text-gray-500">

                            Menunggu Konfirmasi

                        </p>

                        <h2 class="text-4xl font-bold text-yellow-500 mt-2">

                            {{ $orders->where('status', 'Menunggu Konfirmasi')->count() }}

                        </h2>

                    </div>

                    <div class="w-14 h-14 bg-yellow-100 rounded-2xl flex items-center justify-center">

                        <i class="fa-solid fa-clock text-yellow-500 text-2xl"></i>

                    </div>

                </div>

            </div>

            <div class="bg-white rounded-3xl p-6 shadow-sm border-l-4 border-blue-500">

                <div class="flex justify-between items-center">

                    <div>

                        <p class="text-gray-500">

                            Diproses

                        </p>

                        <h2 class="text-4xl font-bold text-blue-500 mt-2">

                            {{ $orders->where('status', 'Diproses')->count() }}

                        </h2>

                    </div>

                    <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center">

                        <i class="fa-solid fa-gears text-blue-500 text-2xl"></i>

                    </div>

                </div>

            </div>

            <div class="bg-white rounded-3xl p-6 shadow-sm border-l-4 border-purple-500">

                <div class="flex justify-between items-center">

                    <div>

                        <p class="text-gray-500">

                            Dikirim

                        </p>

                        <h2 class="text-4xl font-bold text-purple-500 mt-2">

                            {{ $orders->where('status', 'Dikirim')->count() }}

                        </h2>

                    </div>

                    <div class="w-14 h-14 bg-purple-100 rounded-2xl flex items-center justify-center">

                        <i class="fa-solid fa-truck text-purple-500 text-2xl"></i>

                    </div>

                </div>

            </div>

            <div class="bg-white rounded-3xl p-6 shadow-sm border-l-4 border-green-500">

                <div class="flex justify-between items-center">

                    <div>

                        <p class="text-gray-500">

                            Selesai

                        </p>

                        <h2 class="text-4xl font-bold text-green-500 mt-2">

                            {{ $orders->where('status', 'Selesai')->count() }}

                        </h2>

                    </div>

                    <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center">

                        <i class="fa-solid fa-circle-check text-green-500 text-2xl"></i>

                    </div>

                </div>

            </div>

        </div>

        <!-- SEARCH -->
        <div class="bg-white rounded-3xl shadow-sm p-6">

            <form method="GET">

                <div class="flex gap-4">

                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari invoice atau customer..."
                        class="flex-1 border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-pink-500">

                    <button class="bg-pink-500 hover:bg-pink-600 text-white px-8 rounded-xl">

                        Cari

                    </button>

                </div>

            </form>

        </div>

        <!-- TABEL -->
        <div class="bg-white rounded-3xl shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b">

                <h2 class="text-2xl font-bold text-gray-800">

                    Daftar Pesanan

                </h2>

                <p class="text-gray-500 text-sm mt-1">

                    Seluruh transaksi pelanggan yang masuk ke sistem.

                </p>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>

                        <tr class="bg-gray-50 text-gray-600">

                            <th class="p-4 text-left">
                                Invoice
                            </th>

                            <th class="p-4 text-left">
                                Customer
                            </th>

                            <th class="p-4 text-left">
                                Total
                            </th>

                            <th class="p-4 text-center">
                                Status
                            </th>

                            <th class="p-4 text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse ($orders as $order)
                            <tr class="border-b hover:bg-gray-50">

                                <td class="p-4">

                                    <div>

                                        <h4 class="font-semibold">

                                            {{ $order->invoice }}

                                        </h4>

                                        <p class="text-xs text-gray-400">

                                            {{ $order->created_at->format('d M Y') }}

                                        </p>

                                    </div>

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

                                <td class="p-4">

                                    <div class="flex justify-center gap-2">

                                        @if ($order->status == 'Menunggu Konfirmasi')
                                            <button onclick="konfirmasiPesanan('{{ $order->id }}')"
                                                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl">

                                                Konfirmasi

                                            </button>
                                        @endif

                                        <a href="{{ route('orders.show', $order->id) }}"
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-xl">

                                            Detail

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="text-center py-12 text-gray-400">

                                    Belum ada pesanan.

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>
    <!-- PAGINATION -->
    <div class="bg-white rounded-3xl shadow-sm p-6">

        <div class="flex flex-col md:flex-row justify-between items-center gap-4">

            <div class="text-sm text-gray-500">

                Menampilkan

                {{ $orders->firstItem() }}

                sampai

                {{ $orders->lastItem() }}

                dari

                {{ $orders->total() }}

                pesanan

            </div>

            {{ $orders->links() }}

        </div>

    </div>

    <form id="formConfirm" method="POST" style="display:none">

        @csrf
        @method('PUT')

    </form>

    <script>
        function konfirmasiPesanan(id) {

            Swal.fire({

                title: 'Konfirmasi Pesanan?',
                text: 'Pesanan akan diproses.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#22c55e',
                cancelButtonColor: '#ef4444',
                confirmButtonText: 'Ya, Konfirmasi'

            }).then((result) => {

                if (result.isConfirmed) {

                    let form = document.getElementById('formConfirm');

                    form.action = '/orders/' + id + '/confirm';

                    form.submit();

                }

            });

        }
    </script>
@endsection
