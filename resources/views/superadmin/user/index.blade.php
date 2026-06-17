@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-2xl shadow p-6">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-6">

            <h1 class="text-4xl font-bold">
                Data User
            </h1>

        </div>

        <!-- TABLE -->
        <table class="w-full">

            <thead class="bg-pink-100">

                <tr>

                    <th class="p-4 text-left">
                        Nama
                    </th>

                    <th class="p-4 text-left">
                        Email
                    </th>
                    
                    <th class="p-4 text-left">
                        Nomor Telepon
                    </th>

                    <th class="p-4 text-center">
                        Action
                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach ($users as $user)
                    <tr class="border-b">

                        <td class="p-4">
                            {{ $user->name }}
                        </td>

                        <td class="p-4">
                            {{ $user->email }}
                        </td>

                        <td class="p-4">
                            {{ $user->nomor_telepon }}
                        </td>

                        <td class="p-4">

                            <div class="flex justify-center gap-3">

                                <!-- DELETE -->
                                <form method="POST" action="/data-user/{{ $user->id }}/delete" class="delete-form">

                                    @csrf
                                    @method('DELETE')

                                    <button type="button"
                                        class="delete-btn bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">

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
                    text: 'User akan dihapus!',
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
