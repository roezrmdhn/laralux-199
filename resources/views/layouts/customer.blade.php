<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion Brand</title>
    <link rel="shortcut icon" href="assets/images/favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/cust.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/6.5.95/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="sweetalert2.min.css">
    <script src="sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <nav class="bg-gray-800">
        <div class="container flex">
            <div class="flex items-center justify-between flex-grow py-5">
                <div class="flex items-center space-x-6 capitalize">
                    <a href="/" class="text-gray-200  hover:text-red ">Home</a>
                    <a href="/shop" class="text-gray-200 hover:text-white transition">Shop</a>
                    <a href="/cart" class="text-gray-200 hover:text-white transition">Keranjang</a>
                    <a href="/riwayat-order" class="text-gray-200 hover:text-white transition">Riwayat Order</a>
                </div>

                @if (Auth::check())
                    <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                        <div class="block px-4 py-4 text-gray-200">
                            @if (Auth::user()->roles == 'Staff')
                                Anda login sebagai : {{ Auth::user()->roles }}
                            @elseif(Auth::user()->roles == 'Customer')
                                Member :
                                @if (Auth::user()->membership != null)
                                    Active
                                @else
                                    Not Active
                                @endif
                                / Point : {{ Auth::user()->point }}
                            @else
                                Anda login sebagai : {{ Auth::user()->roles }}
                            @endif
                        </div>
                        <button @click="isOpen = !isOpen"
                            class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                            <img src="https://source.unsplash.com/uJ8LNVCBjFQ/400x400">
                        </button>
                        <button x-show="isOpen" @click="isOpen = false"
                            class="h-full w-full fixed inset-0 cursor-default"></button>
                        <div x-show="isOpen" class="absolute w-34 bg-white rounded-lg shadow-lg py-2 mt-16">
                            @if (Auth::user()->roles != 'Customer')
                                <a href="/data-room" class="block px-4 py-2 text-blue-600">Lihat Toko</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="block px-4 py-2 account-link">
                                    {{ __('Sign Out') }}
                                </button>
                            </form>

                        </div>
                    </div>
                @else
                    <div class="flex items-center space-x-6 justify-between">
                        <a href="/login" class="text-gray-200 hover:text-white transition">Login</a>
                        <a href="/register" class="text-gray-200 hover:text-white transition">Register</a>
                    </div>
                @endif
            </div>

        </div>
    </nav>
    @yield('content')

    <!-- footer -->
    <footer class="bg-white pt-16 pb-12 border-t border-gray-100">
        <div class="container grid grid-cols-1 ">
            <div class="col-span-1 space-y-4">
                <img src="assets/images/logo.svg" alt="logo" class="w-30">
                <div class="mr-2">
                    <p class="text-gray-500">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia, hic?
                    </p>
                </div>
                <div class="flex space-x-5">
                    <a href="#" class="text-gray-400 hover:text-gray-500"><i
                            class="fa-brands fa-facebook-square"></i></a>
                    <a href="#" class="text-gray-400 hover:text-gray-500"><i
                            class="fa-brands fa-instagram-square"></i></a>
                    <a href="#" class="text-gray-400 hover:text-gray-500"><i
                            class="fa-brands fa-twitter-square"></i></a>
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <i class="fa-brands fa-github-square"></i>
                    </a>
                </div>
            </div>

            <div class="col-span-2 grid grid-cols-2 gap-4">
                <div class="grid grid-cols-2 gap-4 md:gap-8">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Solutions</h3>
                        <div class="mt-4 space-y-4">
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Marketing</a>
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Analitycs</a>
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Commerce</a>
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Insights</a>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Support</h3>
                        <div class="mt-4 space-y-4">
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Pricing</a>
                            <!-- <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Documentation</a> -->
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Guides</a>
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">API Status</a>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Solutions</h3>
                        <div class="mt-4 space-y-4">
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Marketing</a>
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Analitycs</a>
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Commerce</a>
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Insights</a>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Support</h3>
                        <div class="mt-4 space-y-4">
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Pricing</a>
                            <!-- <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Documentation</a> -->
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">Guides</a>
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900 block">API Status</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
        integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <script defer src="https://unpkg.com/alpinejs@3.2.3/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    @yield('script')
</body>

</html>
