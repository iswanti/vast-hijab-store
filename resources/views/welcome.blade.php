<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <title>Vast Hijab Store</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-pink-50">

    <!-- NAVBAR -->
    <nav
        class="bg-white/90 backdrop-blur-md shadow-sm px-6 lg:px-16 py-5 flex justify-between items-center sticky top-0 z-50 border-b border-pink-100">
        <h1 class="text-2xl lg:text-4xl font-black text-pink-500 tracking-wide">
            VAST HIJAB
        </h1>

        <div class="flex items-center gap-10">

            <a href="#home" class="font-semibold text-slate-700 hover:text-pink-500 duration-300">
                Home
            </a>

            <a href="#product" class="font-semibold text-slate-700 hover:text-pink-500 duration-300">
                Product
            </a>

            <a href="/login"
                class="px-6 py-3 rounded-xl border border-pink-500 text-pink-500 font-semibold hover:bg-pink-50 duration-300">
                Login
            </a>

            <a href="/register"
                class="px-6 py-3 rounded-xl bg-pink-500 text-white font-semibold hover:bg-pink-600 duration-300 shadow-lg">
                Register
            </a>

        </div>

    </nav>

    <!-- HERO -->
    <section id="home" class="px-16 py-20">

        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">

            <!-- LEFT -->
            <div>

                <span class="bg-pink-100 text-pink-500 px-5 py-2 rounded-full font-semibold">
                    Fashion Muslim Modern
                </span>

                <h1 class="text-4xl md:text-5xl lg:text-7xl font-black text-slate-800 leading-tight mt-8">

                    Tampil Cantik
                    <br>

                    Dengan
                    <span class="text-pink-500">
                        Fashion Muslim Favorit
                    </span>

                </h1>

                <p class="text-gray-500 text-xl mt-8 leading-relaxed">

                    Temukan koleksi fashion muslim terbaik dengan kualitas premium,
                    nyaman dipakai, dan cocok untuk semua aktivitasmu.

                </p>

                <div class="flex gap-5 mt-10">

                    <a href="/register"
                        class="bg-pink-500 hover:bg-pink-600 duration-300 text-white px-10 py-5 rounded-2xl font-bold shadow-xl">

                        Belanja Sekarang

                    </a>

                    <a href="#product"
                        class="border-2 border-pink-300 hover:bg-pink-100 duration-300 text-pink-500 px-10 py-5 rounded-2xl font-bold">

                        Lihat Product

                    </a>

                </div>

                <!-- STATS -->
                <div class="flex gap-16 mt-16">

                    <div>
                        <h2 class="text-5xl font-black text-pink-500">
                            {{ $productCount }}+
                        </h2>

                        <p class="text-gray-500 mt-2">
                            Product
                        </p>
                    </div>

                    <div>
                        <h2 class="text-5xl font-black text-pink-500">
                            {{ $userCount }}+
                        </h2>

                        <p class="text-gray-500 mt-2">
                            Customer
                        </p>
                    </div>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="relative">

                <div class="absolute inset-0 bg-pink-300 rounded-[50px] blur-3xl opacity-30"></div>

                <img src="{{ asset('logo.png') }}" class="w-full h-full object-contain p-10">

            </div>

        </div>

    </section>

    <!-- PRODUCT -->
    <section id="product" class="px-16 py-20">

        <div class="flex justify-between items-center">

            <div>

                <h1 class="text-5xl font-black text-slate-800">
                    Product Terbaru
                </h1>

                <p class="text-gray-500 mt-5">
                    Koleksi Fashion terbaru dari Vast Hijab Store
                </p>

            </div>

        </div>

        <div class="swiper productSwiper">

            <div class="swiper-wrapper">

                @foreach ($products as $product)
                    <div
                        class="swiper-slide bg-white rounded-[30px] overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-3 transition-all duration-500">

                        <div class="w-full aspect-[3/4] overflow-hidden rounded-t-[30px] bg-gray-100">

                            <img src="{{ asset('storage/' . $product->gambar) }}"
                                class="w-full h-full object-cover hover:scale-110 transition duration-500">

                        </div>
                        <div class="p-7">

                            <div class="flex justify-between items-center">

                                <span class="bg-pink-100 text-pink-500 px-4 py-1 rounded-full text-sm font-semibold">
                                    {{ $product->brand }}
                                </span>

                                <span class="text-gray-400 text-sm">
                                    Stok {{ $product->stok }}
                                </span>

                            </div>

                            <h1 class="text-3xl font-black text-slate-800 mt-5">
                                {{ $product->nama_product }}
                            </h1>

                            <h2 class="text-4xl font-black text-pink-500 mt-4">
                                Rp {{ number_format($product->harga, 0, ',', '.') }}
                            </h2>

                            <div class="mt-5 space-y-2">

                                <p class="text-gray-600">
                                    Warna: {{ $product->warna }}
                                </p>

                                <p class="text-gray-600">
                                    Size: {{ $product->size }}
                                </p>

                            </div>

                            <a href="{{ auth()->check() ? route('user.detail', $product->id) : route('login') }}"
                                class="block text-center bg-pink-500 hover:bg-pink-600 text-white py-4 rounded-2xl font-bold transition">

                                Lihat Detail

                            </a>

                        </div>

                    </div>
                @endforeach

            </div>

        </div>
        <div class="bg-gradient-to-r from-pink-500 to-pink-600 rounded-3xl p-12 text-center text-white">

            <h2 class="text-3xl lg:text-5xl font-black">

                Siap Tampil Lebih Elegan?

            </h2>

            <p class="mt-5 text-pink-100">

                Temukan koleksi hijab terbaik hanya di Vast Hijab Store.

            </p>

            <a href="/register"
                class="inline-block mt-8 bg-white text-pink-500 px-8 py-4 rounded-2xl font-bold shadow-lg">

                Daftar Sekarang

            </a>

        </div>

    </section>

    <!-- FOOTER -->
    <footer class="bg-slate-900 text-white">

        <div class="max-w-7xl mx-auto px-6 lg:px-16 py-16">

            <div class="grid md:grid-cols-3 gap-10">

                <div>

                    <h1 class="text-3xl font-black">

                        VAST HIJAB

                    </h1>

                    <p class="text-gray-400 mt-4">

                        Fashion muslim modern dengan kualitas premium untuk wanita Indonesia.

                    </p>

                </div>

                <div>

                    <h3 class="font-bold mb-4">

                        Menu

                    </h3>

                    <div class="space-y-2 text-gray-400">

                        <p>Home</p>
                        <p>Product</p>

                    </div>

                </div>

                <div>

                    <h3 class="font-bold mb-4">

                        Kontak

                    </h3>

                    <div class="space-y-2 text-gray-400">

                        <p>vasthijab@gmail.com</p>
                        <p>+62 812 xxxx xxxx</p>

                    </div>

                </div>

            </div>

            <hr class="my-8 border-slate-700">

            <p class="text-center text-gray-500">

                © 2026 Vast Hijab Store. All Rights Reserved.

            </p>

        </div>

    </footer>


</body>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    new Swiper(".productSwiper", {
        slidesPerView: 4,
        spaceBetween: 30,
        loop: true,

        autoplay: {
            delay: 2500,
        },

        breakpoints: {
            320: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 4,
            },
        },
    });
</script>

</html>
