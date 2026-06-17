@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-xl shadow p-6">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-6">

            <h1 class="text-3xl font-bold">
                Data Admin
            </h1>

            <a href="/data-admin/create" class="bg-pink-400 hover:bg-pink-500 text-white px-5 py-3 rounded-lg">

                + Tambah Admin

            </a>

        </div>

        <!-- TABLE -->
        <table class="w-full">

            <thead class="bg-pink-100">

                <tr>

                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-center">Action</th>

                </tr>

            </thead>

            <tbody>

                @foreach ($admins as $admin)
                    <tr class="border-b">

                        <!-- NAMA -->
                        <td class="p-3">
                            {{ $admin->name }}
                        </td>

                        <!-- EMAIL -->
                        <td class="p-3">
                            {{ $admin->email }}
                        </td>

                        <!-- ACTION -->
                        <td class="p-3">

                            <div class="flex justify-center gap-3">

                                <!-- EDIT -->
                                <a href="/data-admin/{{ $admin->id }}/edit"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded">

                                    <i class="fa-solid fa-pen"></i>

                                </a>

                                <!-- DELETE -->
                                <form method="POST" action="/data-admin/{{ $admin->id }}/delete" class="delete-form">

                                    @csrf
                                    @method('DELETE')

                                    <button type="button"
                                        class="delete-btn bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded">

                                        <i class="fa-solid fa-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>
                @endforeach

            </tbody>

        </table>

    </div>
    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {

            button.addEventListener('click', function() {

                let form = this.closest('.delete-form');

                Swal.fire({

                    title: 'Yakin?',
                    text: 'Admin akan dihapus!',
                    icon: 'warning',

                    showCancelButton: true,

                    confirmButtonColor: '#ec4899',
                    cancelButtonColor: '#6b7280',

                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'

                }).then((result) => {

                    if (result.isConfirmed) {

                        form.submit();

                    }

                });

            });

        });
    </script>
@endsection
