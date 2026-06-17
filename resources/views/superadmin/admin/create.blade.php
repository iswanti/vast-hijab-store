@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-xl shadow p-6 w-[500px]">

        <h1 class="text-2xl font-bold mb-6">
            Tambah Admin
        </h1>

        <form method="POST" action="/data-admin/store">

            @csrf

            <!-- NAMA -->
            <div class="mb-4">

                <label>Nama</label>

                <input type="text" name="name" class="w-full border p-3 rounded-lg">

            </div>

            <!-- EMAIL -->
            <div class="mb-4">

                <label>Email</label>

                <input type="email" name="email" class="w-full border p-3 rounded-lg">

            </div>

            <!-- PASSWORD -->
            <div class="mb-5">

                <label>Password</label>

                <input type="password" name="password" class="w-full border p-3 rounded-lg">

            </div>

            <button class="bg-pink-400 hover:bg-pink-500 text-white px-5 py-3 rounded-lg">

                Simpan

            </button>

        </form>

    </div>
@endsection
