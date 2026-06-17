@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-xl shadow p-6 w-[500px]">

        <h1 class="text-3xl font-bold mb-6">
            Edit Admin
        </h1>

        <form method="POST" action="/data-admin/{{ $admin->id }}/update">

            @csrf
            @method('PUT')

            <!-- NAMA -->
            <div class="mb-4">

                <label class="block mb-2 font-semibold">
                    Nama
                </label>

                <input type="text" name="name" value="{{ $admin->name }}" class="w-full border p-3 rounded-lg">

            </div>

            <!-- EMAIL -->
            <div class="mb-5">

                <label class="block mb-2 font-semibold">
                    Email
                </label>

                <input type="email" name="email" value="{{ $admin->email }}" class="w-full border p-3 rounded-lg">

            </div>

            <!-- BUTTON -->
            <button class="bg-pink-400 hover:bg-pink-500 text-white px-5 py-3 rounded-lg">

                Update

            </button>

        </form>

    </div>
@endsection
