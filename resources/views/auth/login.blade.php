<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Vast Hijab</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body class="bg-gradient-to-br from-pink-100 to-pink-200 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-5xl w-full bg-white rounded-3xl shadow-2xl overflow-hidden">

        <div class="grid grid-cols-1 lg:grid-cols-2">

            <!-- KIRI -->
            <div class="bg-pink-500 text-white p-8 md:p-12 flex flex-col justify-center items-center">

                <img src="{{ asset('logo.png') }}" class="w-32 md:w-48 mb-6">

                <h1 class="text-3xl md:text-5xl font-bold text-center">

                    VAST HIJAB

                </h1>

                <p class="mt-5 text-center text-pink-100 max-w-md">

                    Selamat datang kembali.
                    Masuk ke akun Anda untuk mengelola pesanan,
                    melihat transaksi, dan menikmati pengalaman
                    berbelanja yang lebih mudah.

                </p>

            </div>

            <!-- KANAN -->
            <div class="p-8 md:p-12">

                <div class="mb-8">

                    <h2 class="text-3xl font-bold text-gray-800">

                        Masuk Akun

                    </h2>

                    <p class="text-gray-500 mt-2">

                        Silakan login menggunakan email dan password.

                    </p>

                </div>

                <form method="POST" action="{{ route('login') }}">

                    @csrf

                    <!-- EMAIL -->
                    <div class="mb-5">

                        <label class="font-medium">

                            Email

                        </label>

                        <div class="relative mt-2">

                            <i class="fa fa-envelope absolute left-4 top-4 text-gray-400"></i>

                            <input type="email" name="email" value="{{ old('email') }}" required
                                class="w-full border rounded-xl pl-11 pr-4 py-3 focus:ring-2 focus:ring-pink-400 focus:outline-none">

                        </div>

                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-6">

                        <label class="font-medium">

                            Password

                        </label>

                        <div class="relative mt-2">

                            <i class="fa fa-lock absolute left-4 top-4 text-gray-400"></i>

                            <input type="password" id="password" name="password" required
                                class="w-full border rounded-xl pl-11 pr-12 py-3 focus:ring-2 focus:ring-pink-400 focus:outline-none">

                            <button type="button" onclick="togglePassword()"
                                class="absolute right-4 top-3 text-gray-400">

                                <i id="eyeIcon" class="fa-solid fa-eye"></i>

                            </button>

                        </div>

                    </div>

                    <!-- BUTTON -->
                    <button
                        class="w-full bg-pink-500 hover:bg-pink-600 text-white py-3 rounded-xl font-semibold transition">

                        Masuk

                    </button>

                    <!-- REGISTER -->
                    <p class="text-center mt-6 text-gray-500">

                        Belum punya akun?

                        <a href="{{ route('register') }}" class="text-pink-500 font-semibold">

                            Daftar Sekarang

                        </a>

                    </p>

                </form>

            </div>

        </div>

    </div>

    <script>
        function togglePassword() {
            const password =
                document.getElementById('password');

            const eyeIcon =
                document.getElementById('eyeIcon');

            if (password.type === 'password') {
                password.type = 'text';

                eyeIcon.classList.remove('fa-eye');

                eyeIcon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';

                eyeIcon.classList.remove('fa-eye-slash');

                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>

    @if (session('success'))
        <script>
            Swal.fire({

                icon: 'success',

                title: 'Berhasil',

                text: '{{ session('success') }}',

                confirmButtonColor: '#ec4899'

            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({

                icon: 'error',

                title: 'Login Gagal',

                html: `{!! implode('<br>', $errors->all()) !!}`,

                confirmButtonColor: '#ec4899'

            });
        </script>
    @endif

</body>

</html>
