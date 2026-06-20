<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - Vast Hijab</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


</head>

<body class="bg-gradient-to-br from-pink-100 to-pink-200 min-h-screen flex items-center justify-center p-5">


    <div class="max-w-5xl w-full bg-white rounded-3xl shadow-2xl overflow-hidden">

        <div class="grid md:grid-cols-2">

            <!-- KIRI -->
            <div class="bg-pink-500 text-white p-10 flex flex-col justify-center items-center">

                <img src="{{ asset('logo.png') }}" class="w-44 mb-6">

                <h1 class="text-4xl font-bold text-center">

                    VAST HIJAB

                </h1>

                <p class="mt-4 text-center text-pink-100">

                    Bergabunglah bersama Vast Hijab Store dan nikmati
                    pengalaman berbelanja hijab yang mudah,
                    aman dan nyaman.

                </p>

            </div>

            <!-- KANAN -->
            <div class="p-10">

                <h2 class="text-3xl font-bold text-gray-800">

                    Buat Akun

                </h2>

                <p class="text-gray-500 mt-2 mb-8">

                    Silakan isi data di bawah untuk membuat akun baru.

                </p>

                <form method="POST" action="{{ route('register') }}">

                    @csrf

                    <div class="mb-4">

                        <label class="font-medium">

                            Nama Lengkap

                        </label>

                        <div class="relative mt-2">

                            <i class="fa fa-user absolute left-4 top-4 text-gray-400"></i>

                            <input type="text" name="name" value="{{ old('name') }}"
                                class="w-full border rounded-xl pl-11 pr-4 py-3 focus:ring-2 focus:ring-pink-400 focus:outline-none">

                        </div>

                    </div>

                    <div class="mb-4">

                        <label class="font-medium">

                            Email

                        </label>

                        <div class="relative mt-2">

                            <i class="fa fa-envelope absolute left-4 top-4 text-gray-400"></i>

                            <input type="email" name="email" value="{{ old('email') }}"
                                class="w-full border rounded-xl pl-11 pr-4 py-3 focus:ring-2 focus:ring-pink-400 focus:outline-none">

                        </div>

                    </div>

                    <div class="mb-4">

                        <label class="font-medium">

                            Nomor Telepon

                        </label>

                        <div class="relative mt-2">

                            <i class="fa fa-phone absolute left-4 top-4 text-gray-400"></i>

                            <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon') }}"
                                class="w-full border rounded-xl pl-11 pr-4 py-3 focus:ring-2 focus:ring-pink-400 focus:outline-none">

                        </div>

                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-4">
                        <label class="font-medium">
                            Password
                        </label>

                        <div class="relative mt-2">
                            <i class="fa fa-lock absolute left-4 top-4 text-gray-400"></i>

                            <input type="password" id="password" name="password" required
                                class="w-full border rounded-xl pl-11 pr-12 py-3 focus:ring-2 focus:ring-pink-400 focus:outline-none">

                            <button type="button" onclick="togglePassword('password','eyeIcon1')"
                                class="absolute right-4 top-1/2 -translate-y-1/2 z-50 text-gray-400 cursor-pointer">

                                <i id="eyeIcon1" class="fa-solid fa-eye"></i>

                            </button>
                        </div>
                    </div>

                    <!-- KONFIRMASI PASSWORD -->
                    <div class="mb-6">
                        <label class="font-medium">
                            Konfirmasi Password
                        </label>

                        <div class="relative mt-2">
                            <i class="fa fa-lock absolute left-4 top-4 text-gray-400"></i>

                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                class="w-full border rounded-xl pl-11 pr-12 py-3 focus:ring-2 focus:ring-pink-400 focus:outline-none">

                            <button type="button" onclick="togglePassword('password_confirmation','eyeIcon2')"
                                class="absolute right-4 top-1/2 -translate-y-1/2 z-50 text-gray-400 cursor-pointer">

                                <i id="eyeIcon2" class="fa-solid fa-eye"></i>

                            </button>
                        </div>
                    </div>

                    <button
                        class="w-full bg-pink-500 hover:bg-pink-600 transition text-white py-3 rounded-xl font-semibold">

                        Daftar Sekarang

                    </button>

                    <p class="text-center mt-6 text-gray-500">

                        Sudah punya akun?

                        <a href="{{ route('login') }}" class="text-pink-500 font-semibold">

                            Login

                        </a>

                    </p>

                </form>

            </div>

        </div>

    </div>

    @if ($errors->any())
        <script>
            Swal.fire({

                icon: 'error',

                title: 'Registrasi Gagal',

                html: `{!! implode('<br>', $errors->all()) !!}`,

                confirmButtonColor: '#ec4899'

            });
        </script>
    @endif

    @if (session('success'))
        <script>
            Swal.fire({

                icon: 'success',

                title: 'Registrasi Berhasil',

                text: '{{ session('success') }}',

                confirmButtonColor: '#ec4899'

            });
        </script>
    @endif

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>

</body>

</html>
