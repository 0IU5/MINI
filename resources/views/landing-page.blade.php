<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Zen Tech</title>
    <link href="{{ asset('desainmini-main/dist/output.css') }}" rel="stylesheet" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Tambahkan ini di head -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>

    <!-- font poopins -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <style>
        * {
            font-family: "Poppins", sans-serif;
            /* border: 1px solid black; */
        }

        @keyframes bounceIn {
            0% {
                transform: scale(0.3);
                opacity: 0;
            }

            50% {
                transform: scale(1.05);
                opacity: 0.8;
            }

            70% {
                transform: scale(0.9);
                opacity: 0.9;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .animated {
            animation-duration: 0.5s;
            animation-fill-mode: both;
        }

        .bounceIn {
            animation-name: bounceIn;
        }

        .notification-dropdown {
            position: relative;
        }

        #notificationDropdownMenu {
            transform-origin: top right;
            transition: all 0.2s ease-out;
        }

        #notificationDropdownMenu.show {
            display: block;
            animation: dropdownFadeIn 0.2s ease-out;
        }

        @keyframes dropdownFadeIn {
            from {
                opacity: 0;
                transform: scale(0.95) translateY(-10px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        /* Custom scrollbar untuk daftar notifikasi */
        .overflow-y-auto::-webkit-scrollbar {
            width: 4px;
        }

        .overflow-y-auto::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>

</head>

<body class="overflow-x-hidden">

    <!-- start header -->
    <header id="header" class="w-full py-4 px-10 xl:px-14 flex justify-between items-center absolute top-0 z-10">
        <a href="{{ route('landing-page') }}" class="font-semibold text-xl text-white hidden xl:flex">
            <img src="{{ asset('img/logo.svg') }}" alt="logo" class="w-8 mr-2">
            Zentech</a>

        <div
            class="py-2 px-5 xl:ps-10 rounded-[20px] hidden gap-4 items-center md:w-auto hidden gap-1 items-center xl:flex">
            <div class="hidden md:flex gap-4">
                <a href="{{ route('landing-page') }}" class="text-sm text-white">Beranda</a>
                <a href="{{ route('page.product') }}" class="text-sm text-white">Produk</a>
                <a href="{{ route('about-page') }}" class="text-sm text-white">Tentang</a>
                <a href="{{ route('contact-page') }}" class="text-sm text-white">Hubungi</a>
            </div>

            <form action="{{ route('page.product') }}" method="GET"
                class=" gap-2 flex-1 md:flex-none hidden gap-1 bg-white rounded-full items-center xl:flex py-2 px-5">
                <input type="text" class=" outline-none text-sm w-full text-slate-800 md:w-80 bg-transparent"
                    placeholder="Search" name="search" value="{{ request()->get('search') }}" />
                <button type="submit">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z"
                                stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </g>
                    </svg>
                </button>
            </form>
        </div>

        <div class="flex gap-3 items-center cursor-pointer">
            <div class="flex gap-1" id="carts">
                <!-- Keranjang Icon -->
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M2 3L2.26491 3.0883C3.58495 3.52832 4.24497 3.74832 4.62248 4.2721C5 4.79587 5 5.49159 5 6.88304V9.5C5 12.3284 5 13.7426 5.87868 14.6213C6.75736 15.5 8.17157 15.5 11 15.5H19"
                            stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path>
                        <path
                            d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z"
                            stroke="#ffffff" stroke-width="1.5"></path>
                        <path
                            d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z"
                            stroke="#ffffff" stroke-width="1.5"></path>
                        <path
                            d="M5 6H16.4504C18.5054 6 19.5328 6 19.9775 6.67426C20.4221 7.34853 20.0173 8.29294 19.2078 10.1818L18.7792 11.1818C18.4013 12.0636 18.2123 12.5045 17.8366 12.7523C17.4609 13 16.9812 13 16.0218 13H5"
                            stroke="#ffffff" stroke-width="1.5"></path>
                    </g>
                </svg>
                <span class="text-sm text-white">Keranjang</span>
                <span class="relative flex h-4 w-4 -translate-y-2 -translate-x-1">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                    <span
                        class="relative inline-flex rounded-full h-4 w-4 bg-red-500 text-white text-[10px] flex items-center justify-center"
                        id="cartCountItem"> 0 </span>
                </span>
            </div>

            <!-- Notifikasi Icon dan Dropdown -->
            @auth
                @if (!auth()->user()->hasRole('admin'))
                    <div class="relative gap-1">
                        <button class="flex gap-1 items-center" type="button" id="userNotificationDropdown">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                class="w-6 h-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                </path>
                            </svg>
                            <span class="text-sm text-white">Notifikasi</span>
                            @if ($userNotifications->count() > 0)
                                <span class="relative flex h-4 w-4 -translate-y-2 -translate-x-1">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                    <span
                                        class="relative inline-flex rounded-full h-4 w-4 bg-red-500 text-white text-[10px] flex items-center justify-center">
                                        {{ $userNotifications->count() }}
                                    </span>
                                </span>
                            @endif
                        </button>
                        <div id="notificationDropdownMenu"
                            class="hidden absolute right-0 w-80 max-h-[400px] bg-white rounded-lg shadow-lg mt-2 z-50 overflow-hidden flex-col">
                            <!-- Header Dropdown -->
                            <div class="px-4 py-3 border-b border-gray-100 bg-gray-50">
                                <h3 class="text-sm font-semibold text-gray-800">Notifikasi</h3>
                            </div>

                            <!-- Daftar Notifikasi -->
                            <div class="overflow-y-auto flex-1 max-h-[210px]">
                                @forelse($userNotifications as $notification)
                                    <a href="{{ route('notifications.mark-as-read', $notification->id) }}"
                                        class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100 transition duration-150">
                                        <div class="d-flex align-items-center gap-2 py-2">
                                            <div>
                                                <p class="mb-0 text-muted">
                                                    @if ($notification->order->productOrders->count() > 1)
                                                        {{ $notification->order->productOrders->first()->product->name_product }}
                                                        <span class="text-secondary text-gray-600"
                                                            style="font-size: 0.85em;">dan lainnya</span>
                                                    @else
                                                        {{ $notification->order->productOrders->first()->product->name_product }}
                                                    @endif
                                                </p>
                                                <small class="text-muted">
                                                    <i>Status: {{ $notification->message }}</i>
                                                </small>
                                                <p class="text-xs text-gray-500">
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="px-4 py-3 text-center">
                                        <p class="text-sm text-gray-500">Tidak ada notifikasi baru</p>
                                    </div>
                                @endforelse
                            </div>

                            <!-- Link "Tandai Semua Sudah Dibaca" -->
                            <div class="px-4 py-3 border-t border-gray-100 bg-gray-50 text-center">
                                <a href="{{ route('notifications.mark-all-as-read') }}"
                                    class="text-xs text-blue-500 hover:text-blue-700">Tandai Semua Sudah Dibaca</a>
                            </div>
                        </div>
                    </div>
                @endif
            @endauth


            <div class="hidden gap-1 items-center xl:flex">
                @guest
                    <svg viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" fill="#ffffff" class="w-4 h-4">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <defs></defs>
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Dribbble-Light-Preview" transform="translate(-420.000000, -2159.000000)"
                                    fill="#ffffff">
                                    <g id="icons" transform="translate(56.000000, 160.000000)">
                                        <path
                                            d="M374,2009 C371.794,2009 370,2007.206 370,2005 C370,2002.794 371.794,2001 374,2001 C376.206,2001 378,2002.794 378,2005 C378,2007.206 376.206,2009 374,2009 M377.758,2009.673 C379.124,2008.574 380,2006.89 380,2005 C380,2001.686 377.314,1999 374,1999 C370.686,1999 368,2001.686 368,2005 C368,2006.89 368.876,2008.574 370.242,2009.673 C366.583,2011.048 364,2014.445 364,2019 L366,2019 C366,2014 369.589,2011 374,2011 C378.411,2011 382,2014 382,2019 L384,2019 C384,2014.445 381.417,2011.048 377.758,2009.673"
                                            id="profile-[#1335]"></path>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <!-- Jika pengguna belum login -->
                    <a href="{{ route('login') }}" class="text-sm text-white hover:text-blue-400">Masuk</a>
                    <span class="text-white">/</span>
                    <a href="{{ route('register') }}" class="text-sm text-white hover:text-blue-400">Daftar</a>
                @endguest

                @auth
                    @if (auth()->user()->hasRole('user'))
                        <!-- Dropdown untuk user -->
                        <div class="relative">
                            <!-- Tombol dropdown profil -->
                            <button id="profileDropdownButton">
                                <!-- Tampilkan gambar profil -->
                                <div class="w-10 h-10 rounded-full overflow-hidden">
                                    <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('style/src/assets/images/profile/user-1.jpg') }}"
                                        alt="Profile Picture" class="w-full h-full object-cover">
                                </div>
                            </button>
                            <!-- Menu dropdown -->
                            <div id="profileDropdownMenu"
                                class="hidden absolute right-0 mt-2 bg-white shadow-md rounded-lg py-2 w-48 z-10">
                                <a href="{{ route('user.profile.profile') }}"
                                    class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Akun Saya</a>
                                <a href="{{ route('user.orders.index') }}"
                                    class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Pesanan Saya</a>
                                <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @elseif(auth()->user()->hasRole('admin'))
                        <!-- Link ke dashboard untuk admin -->
                        <div class="tooltip">
                            <a href="{{ route('dashboard.index') }}"
                                class="flex justify-start items-center gap-2 p-2 bg-gray-200 text-slate-800 rounded-full">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5">
                                    <circle cx="12" cy="8" r="4" stroke="#1C274C" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></circle>
                                    <path d="M4 20C4 16 8 14 12 14C16 14 20 16 20 20" stroke="#1C274C" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <span>Dashboard</span>
                            </a>
                        </div>
                    @endif
                @endauth
            </div>
        </div>

        <script>
            document.getElementById('profileDropdownButton').addEventListener('click', function() {
                let dropdownMenu = document.getElementById('profileDropdownMenu');
                dropdownMenu.classList.toggle('hidden');
            });
        </script>




        <!-- Hamburger Menu (untuk tampilan mobile) -->
        <div class="xl:hidden flex items-center gap-4">
            <button id="hamburger" class="text-xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </div>


    </header>
    <!-- end header -->

    <!-- start menu-->

    <div id="list-menu"
        class="hidden w-full h-screen overflow-hidden fixed top-0 right-0 left-0 bottom-0 z-20 backdrop-brightness-50 flex justify-center p-5">
        <div id="menu-content" class="relative bg-white shadow-xl h-full w-full rounded-md md:w-2/5">
            <div class="absolute top-0 right-0 cursor-pointer m-3" id="close-menu">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-7 h-7">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M10.0303 8.96965C9.73741 8.67676 9.26253 8.67676 8.96964 8.96965C8.67675 9.26255 8.67675 9.73742 8.96964 10.0303L10.9393 12L8.96966 13.9697C8.67677 14.2625 8.67677 14.7374 8.96966 15.0303C9.26255 15.3232 9.73743 15.3232 10.0303 15.0303L12 13.0607L13.9696 15.0303C14.2625 15.3232 14.7374 15.3232 15.0303 15.0303C15.3232 14.7374 15.3232 14.2625 15.0303 13.9696L13.0606 12L15.0303 10.0303C15.3232 9.73744 15.3232 9.26257 15.0303 8.96968C14.7374 8.67678 14.2625 8.67678 13.9696 8.96968L12 10.9393L10.0303 8.96965Z"
                            fill="#1C274C"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M12 1.25C6.06294 1.25 1.25 6.06294 1.25 12C1.25 17.9371 6.06294 22.75 12 22.75C17.9371 22.75 22.75 17.9371 22.75 12C22.75 6.06294 17.9371 1.25 12 1.25ZM2.75 12C2.75 6.89137 6.89137 2.75 12 2.75C17.1086 2.75 21.25 6.89137 21.25 12C21.25 17.1086 17.1086 21.25 12 21.25C6.89137 21.25 2.75 17.1086 2.75 12Z"
                            fill="#1C274C"></path>
                    </g>
                </svg>
            </div>
            <div class="p-5">
                <ul>
                    <li>
                        <div class="pt-10 pb-5 border-b-2">
                            <form action="" class="flex gap-2 flex-1 w-full">
                                <input type="text"
                                    class="py-1 px-3 outline-none border border-gray-300 rounded-lg text-sm w-full text-slate-700"
                                    placeholder="Search" name="search" value="{{ request()->get('search') }}" />
                                <button type="submit">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        class="w-4 h-4">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z"
                                                stroke="#000000" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('landing-page') }}" class="text-md text-slate-700 py-2 block px-2">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('page.product') }}"
                            class="text-md text-slate-700 py-2 block px-2">Product</a>
                    </li>
                    <li>
                        <a href="{{ route('about-page') }}" class="text-md text-slate-700 py-2 block px-2">About</a>
                    </li>
                    <li>
                        <a href="{{ route('contact-page') }}"
                            class="text-md text-slate-700 py-2 block px-2">Contact</a>
                    </li>
                    @guest
                        <li>
                            <a href="{{ route('login') }}"
                                class="text-sm block px-2 py-2 w-full rounded-lg bg-blue-500 text-white text-center mb-3">Sign
                                in</a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}"
                                class="text-sm block px-2 py-2 w-full rounded-lg text-blue-500 text-center">Sign
                                up</a>
                        </li>
                    @endguest
                    @auth

                        <li>
                            <a href="{{ route('user.profile.profile') }}"
                                class="flex justify-start items-center gap-1 text-md py-2 bg-gray-200 text-slate-800 w-auto  px-2 rounded-md">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <!-- Lingkaran untuk kepala -->
                                        <circle cx="12" cy="8" r="4" stroke="#1C274C" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round"></circle>
                                        <!-- Kurva untuk tubuh -->
                                        <path d="M4 20C4 16 8 14 12 14C16 14 20 16 20 20" stroke="#1C274C"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g>
                                </svg>
                                <span class="font-semibold text-xs"> My Account</span>
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
    <!-- end menu-->

    <!-- start list cart -->
    <x-list-cart-modal />
    <!-- end list cart -->

    <section style="padding-top: 80px;background: linear-gradient(104.58deg, #2E01B8 2.1%, #05F2F2 100.64%);"
        class="px-10 min-h-screen md:h-screen grid grid-cols-1 md:grid-cols-[1fr_1.5fr] w-ful md:ps-28 relative">
        <div class="md:order-0 order-1 md:py-0 py-10 flex flex-col justify-center ">
            <h1 class="text-4xl font-bold mb-5 text-white">
                Teknologi adalah milik <span style="color: #2da5f3">semua orang</span>
            </h1>
            <p class="text-justify mb-10 text-white">
                Rasakan performa terbaik dengan laptop/smartphone terbaru. Cepat, bergaya, dan dilengkapi dengan
                fitur-fitur canggih yang sesuai dengan gaya hidup Anda.
            </p>

            <div>
                <a href="{{ route('page.product') }}" class="bg-white rounded-lg px-10 py-3 text-sm ">
                    <span
                        style="background: linear-gradient(90deg, #2535C5 0%, #1597DC 100%); background-clip: text; -webkit-background-clip: text; color: transparent;"
                        class="font-medium">
                        Belanja Sekarang</span>
                </a>
            </div>

        </div>
        <div class="md:order-1 order-0  overflow-hidden relative">
            <img src="{{ asset('desainmini-main/image/433808944f8d3c3eb8e8267829a874d4.png') }}" alt="banner"
                class="md:w-5/6 ms-auto" />
            {{-- <div class="absolute bg-white p-4 px-5 backdrop-filter backdrop-opacity-50 z-9 bottom-20 left-20 rounded-lg overflow-hidden"
                style="background-color: rgba(255, 255, 255, 0.5);width: 240px;height:auto">
                <h6 class="text-sm text-slate-900 font-bold mb-2">Dapatkan Diskon Hingga 30%.</h6>
                <p class="text-xs text-slate-900">Anda bisa mendapatkan diskon 30% untuk produk ini jika Anda membeli
                    sekarang</p>
            </div> --}}
        </div>
    </section>

    <section class="px-5 py-10 bg-white relative md:px-28">
        <div class="relative w-full overflow-hidden">
            <!-- Slides -->
            <div id="carouselSlides" class="flex transition-transform duration-700">
                <!-- Cek jika ada voucher yang belum digunakan -->
                @if ($promoCodes->isNotEmpty() && $promoCodes->where('used', false)->count() > 0)
                    <div class="w-full flex-shrink-0 relative">
                        <div
                            class="relative w-full h-full bg-gradient-to-r from-blue-50 to-blue-100 p-6 md:p-8 rounded-lg shadow-md">
                            <div class="absolute inset-0 flex justify-between items-center px-4 md:px-10">
                                <span class="text-blue-200 text-2xl md:text-4xl">❄</span>
                                <span class="text-blue-200 text-2xl md:text-3xl">⛄</span>
                                <span class="text-blue-200 text-2xl md:text-4xl">🎿</span>
                                <span class="text-blue-200 text-2xl md:text-4xl">🧊</span>
                            </div>

                            <div class="relative z-10 max-w-3xl mx-auto text-center">
                                <h2 class="text-lg md:text-xl font-semibold text-gray-800">Voucher Promo Tersedia</h2>
                                <div class="space-y-4 mt-4 lg:mt-6">
                                    @foreach ($promoCodes as $voucher)
                                        @if (!$voucher->used)
                                            <!-- Memastikan voucher belum digunakan -->
                                            <div
                                                class="bg-white rounded-lg p-3 md:p-4 shadow-md hover:shadow-lg flex items-center justify-between">
                                                <div class="flex items-center space-x-3 flex-grow">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-5 w-5 text-blue-500" viewBox="0 0 20 20"
                                                        fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <span
                                                        class="font-mono text-sm md:text-lg font-semibold text-gray-700 w-full">
                                                        Kode: {{ $voucher->code }}
                                                    </span>
                                                </div>
                                                <button
                                                    class="px-3 py-1 md:px-4 md:py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors text-xs md:text-sm whitespace-nowrap"
                                                    onclick="copyToClipboard('{{ $voucher->code }}')">
                                                    Salin
                                                </button>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                <div class="text-center mt-6">
                                    <p class="text-md md:text-lg font-semibold text-gray-700">Jangan lewatkan
                                        kesempatan emas!</p>
                                    <p class="text-gray-600 text-sm md:text-base">Klaim voucher spesialmu sekarang
                                        sebelum habis.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Second Slide - Carousel Images -->
            @if ($carousel->isNotEmpty())
                <div class="w-full flex-shrink-0 relative">
                    <picture>
                        <source srcset="{{ asset('storage/' . $carousel[0]->mobile_image) }}"
                            media="(max-width: 768px)">
                        <source srcset="{{ asset('storage/' . $carousel[0]->tablet_image) }}"
                            media="(max-width: 1024px)">
                        <img src="{{ asset('storage/' . $carousel[0]->desktop_image) }}"
                            class="w-full h-auto object-cover" alt="Promo 1">
                    </picture>
                </div>
            @endif

            <!-- Third Slide - Carousel Images -->
            @if (isset($carousel[1]))
                <div class="w-full flex-shrink-0 relative">
                    <picture>
                        <source srcset="{{ asset('storage/' . $carousel[1]->mobile_image) }}"
                            media="(max-width: 768px)">
                        <source srcset="{{ asset('storage/' . $carousel[1]->tablet_image) }}"
                            media="(max-width: 1024px)">
                        <img src="{{ asset('storage/' . $carousel[1]->desktop_image) }}"
                            class="w-full h-auto object-cover" alt="Promo 2">
                    </picture>
                </div>
            @endif
        </div>

        <!-- Controls -->
        <button id="prevSlide"
            class="absolute top-1/2 left-3 md:left-5 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full hover:bg-gray-600">
            &#10094;
        </button>
        <button id="nextSlide"
            class="absolute top-1/2 right-3 md:right-5 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full hover:bg-gray-600">
            &#10095;
        </button>
        </div>
    </section>




    {{-- <section class="md:px-28 px-5 py-10 bg-white">
        <div class="grid md:grid-cols-3 grid-cols-1 gap-4 ">
            <div class="rounded-md px-5 py-5 overflow-hidden grid grid-cols-[2fr_1fr] overflow-hidden"
                style="background: linear-gradient(261.16deg, #1A75D4 30.14%, #0AD6EB 90.71%);">
                <div class="flex flex-col gap-3">
                    <p class="text-xs text-white mb-2">
                        M6 Wireless Gaming Headset Gaming Headphones with Mic for Mobile Device
                    </p>
                    <div>
                        <a href="{{ route('page.product') }}" class="bg-white rounded-lg px-5 py-1">
                            <span
                                style="background: linear-gradient(90deg, #2535C5 0%, #1597DC 100%); background-clip: text; -webkit-background-clip: text; color: transparent;"
                                class="font-medium text-xs text-nowrap">
                                Shop Now</span>
                        </a>
                    </div>
                </div>
                <div class=" bg-center bg-cover ">
                    <img src="{{ asset('desainmini-main/image/headset-2.png') }}" alt="Hp"
                        class=" object-contain" />
                </div>
            </div>
            <div class="rounded-md px-5 py-5 overflow-hidden grid grid-cols-[2fr_1fr] overflow-hidden"
                style="background: linear-gradient(270.55deg, #0AD3EB -31.53%, #1A78D5 49.53%);">
                <div class="flex flex-col gap-3">
                    <p class="text-xs text-white mb-2">
                        M6 Wireless Gaming Headset Gaming Headphones with Mic for Mobile Device
                    </p>
                    <div>
                        <a href="{{ route('page.product') }}" class="bg-white rounded-lg px-5 py-1">
                            <span
                                style="background: linear-gradient(90deg, #2535C5 0%, #1597DC 100%); background-clip: text; -webkit-background-clip: text; color: transparent;"
                                class="font-medium text-xs text-nowrap">
                                Shop Now</span>
                        </a>
                    </div>
                </div>
                <div class=" bg-center bg-cover ">
                    <img src="{{ asset('desainmini-main/image/headset-2.png') }}" alt="Hp"
                        class=" object-contain" />
                </div>
            </div>
            <div class="rounded-md px-5 py-5 overflow-hidden grid grid-cols-[2fr_1fr] overflow-hidden"
                style="background: linear-gradient(261.16deg, #1A75D4 30.14%, #0AD6EB 90.71%);">
                <div class="flex flex-col gap-3">
                    <p class="text-xs text-white mb-2">
                        M6 Wireless Gaming Headset Gaming Headphones with Mic for Mobile Device
                    </p>
                    <div>
                        <a href="{{ route('page.product') }}" class="bg-white rounded-lg px-5 py-1">
                            <span
                                style="background: linear-gradient(90deg, #2535C5 0%, #1597DC 100%); background-clip: text; -webkit-background-clip: text; color: transparent;"
                                class="font-medium text-xs text-nowrap">
                                Shop Now</span>
                        </a>
                    </div>
                </div>
                <div class=" bg-center bg-cover ">
                    <img src="{{ asset('desainmini-main/image/headset-2.png') }}" alt="Hp"
                        class=" object-contain" />
                </div>
            </div>
        </div>
    </section> --}}

    <section class="md:px-28 px-5 py-5 mb-10">
        <h1 class="text-2xl font-semibold text-slate-700 mb-10">
            Produk <span class="text-blue-500">Terlaris</span>
        </h1>

        <div class="grid md:grid-cols-[2fr_1fr_1fr] grid-cols-1 gap-4">
            <div class="border-2 py-3 px-5 relative">
                <div class="absolute top-0 left-0 bg-red-600 py-1 px-3 rounded-sm text-white text-sm ms-5 mt-3">
                    Hot
                </div>
                <div class="flex gap-5 justify-center mt-8 pt-6">
                    @if ($mostPopularProduct1)
                        <a href="{{ route('page.productshow', $mostPopularProduct1->slug) }}"
                            class="w-32 h-32 flex justify-center items-center bg-center bg-cover overflow-hidden mx-auto">
                            <!-- Memeriksa apakah ada gambar produk -->
                            @if ($mostPopularProduct1->image_product)
                                <img src="{{ asset('storage/' . $mostPopularProduct1->image_product) }}"
                                    alt="Hp" />
                            @else
                                <!-- Jika tidak ada gambar, tampilkan gambar default -->
                                <img src="{{ asset('img/laptop.jpg') }}" alt="Default Image" />
                            @endif
                        </a>

                        <div class="flex flex-col justify-between">
                            {{-- <span class="text-red-500 font-semibold">Flas sale</span> --}}

                            <a href="{{ route('page.productshow', $mostPopularProduct1->slug) }}"
                                class="text-md text-slate-700 font-semibold">
                                {{ $mostPopularProduct1->name_product }}
                            </a>
                            <div>
                                <div class="flex items-center space-x-1 mb-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= floor($mostPopularProduct1->average_rating ?? 0))
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="w-4 h-4 text-yellow-400" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 17.75l-6.16 3.24a1 1 0 0 1-1.45-1.05l1.17-7.23L1.31 8.7a1 1 0 0 1 .56-1.72l7.29-.61L12 .25l3.03 6.12 7.29.61a1 1 0 0 1 .56 1.72l-4.74 4.24 1.17 7.23a1 1 0 0 1-1.45 1.05L12 17.75z">
                                                </path>
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="w-4 h-4 text-gray-300" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 17.75l-6.16 3.24a1 1 0 0 1-1.45-1.05l1.17-7.23L1.31 8.7a1 1 0 0 1 .56-1.72l7.29-.61L12 .25l3.03 6.12 7.29.61a1 1 0 0 1 .56 1.72l-4.74 4.24 1.17 7.23a1 1 0 0 1-1.45 1.05L12 17.75z">
                                                </path>
                                            </svg>
                                        @endif
                                    @endfor
                                    <div class="flex space-x-2 text-sm text-slate-600">
                                        <span>{{ $mostPopularProduct1->reviews_count ?? 0 }} reviews</span>
                                    </div>
                                </div>
                                <div>
                                    <span
                                        class="space-x-2 text-sm text-slate-600">{{ $mostPopularProduct1->sold_count ?? 0 }}
                                        terjual</span>
                                </div>

                                <div class="flex justify-between">
                                    <p class="text-xl text-blue-500 font-medium tracking-tight">
                                        {{ number_format($mostPopularProduct1->price_product, 0, ',', '.') }}
                                    </p>
                                    @auth
                                        <button onclick="addToCart({{ $mostPopularProduct1->id }}, this)" type="button"
                                            class="w-10 h-10 bg-blue-500 flex justify-center items-center rounded-md ">
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                                class="w-5 h-5">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path
                                                        d="M2 3L2.26491 3.0883C3.58495 3.52832 4.24497 3.74832 4.62248 4.2721C5 4.79587 5 5.49159 5 6.88304V9.5C5 12.3284 5 13.7426 5.87868 14.6213C6.75736 15.5 8.17157 15.5 11 15.5H19"
                                                        stroke="#ffffff" stroke-width="1.5" stroke-linecap="round">
                                                    </path>
                                                    <path
                                                        d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z"
                                                        stroke="#ffffff" stroke-width="1.5"></path>
                                                    <path
                                                        d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z"
                                                        stroke="#ffffff" stroke-width="1.5"></path>
                                                    <path
                                                        d="M5 6H16.4504C18.5054 6 19.5328 6 19.9775 6.67426C20.4221 7.34853 20.0173 8.29294 19.2078 10.1818L18.7792 11.1818C18.4013 12.0636 18.2123 12.5045 17.8366 12.7523C17.4609 13 16.9812 13 16.0218 13H5"
                                                        stroke="#ffffff" stroke-width="1.5"></path>
                                                </g>
                                            </svg>
                                        </button>
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="w-10 h-10 bg-blue-500 flex justify-center items-center rounded-md">
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                                class="w-5 h-5">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path
                                                        d="M2 3L2.26491 3.0883C3.58495 3.52832 4.24497 3.74832 4.62248 4.2721C5 4.79587 5 5.49159 5 6.88304V9.5C5 12.3284 5 13.7426 5.87868 14.6213C6.75736 15.5 8.17157 15.5 11 15.5H19"
                                                        stroke="#ffffff" stroke-width="1.5" stroke-linecap="round">
                                                    </path>
                                                    <path
                                                        d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z"
                                                        stroke="#ffffff" stroke-width="1.5"></path>
                                                    <path
                                                        d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z"
                                                        stroke="#ffffff" stroke-width="1.5"></path>
                                                    <path
                                                        d="M5 6H16.4504C18.5054 6 19.5328 6 19.9775 6.67426C20.4221 7.34853 20.0173 8.29294 19.2078 10.1818L18.7792 11.1818C18.4013 12.0636 18.2123 12.5045 17.8366 12.7523C17.4609 13 16.9812 13 16.0218 13H5"
                                                        stroke="#ffffff" stroke-width="1.5"></path>
                                                </g>
                                            </svg>
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="border-2 py-3 px-5 relative">
                @if ($mostPopularProduct2)
                    <a href="{{ route('page.productshow', $mostPopularProduct2->slug) }}"
                        class="w-32 h-32 flex justify-center items-center bg-center bg-cover overflow-hidden mx-auto">
                        <!-- Memeriksa apakah ada gambar produk -->
                        @if ($mostPopularProduct2->image_product)
                            <img src="{{ asset('storage/' . $mostPopularProduct2->image_product) }}"
                                alt="Hp" />
                        @else
                            <!-- Jika tidak ada gambar, tampilkan gambar default -->
                            <img src="{{ asset('img/laptop.jpg') }}" alt="Default Image" />
                        @endif
                    </a>

                    <a href="{{ route('page.productshow', $mostPopularProduct2->slug) }}"
                        class="text-sm text-slate-700 mb-4">
                        {{ $mostPopularProduct2->name_product }}
                    </a>

                    <div class="flex items-center space-x-1 mb-2">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= floor($mostPopularProduct2->average_rating ?? 0))
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    class="w-4 h-4 text-yellow-400" viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.75l-6.16 3.24a1 1 0 0 1-1.45-1.05l1.17-7.23L1.31 8.7a1 1 0 0 1 .56-1.72l7.29-.61L12 .25l3.03 6.12 7.29.61a1 1 0 0 1 .56 1.72l-4.74 4.24 1.17 7.23a1 1 0 0 1-1.45 1.05L12 17.75z">
                                    </path>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    class="w-4 h-4 text-gray-300" viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.75l-6.16 3.24a1 1 0 0 1-1.45-1.05l1.17-7.23L1.31 8.7a1 1 0 0 1 .56-1.72l7.29-.61L12 .25l3.03 6.12 7.29.61a1 1 0 0 1 .56 1.72l-4.74 4.24 1.17 7.23a1 1 0 0 1-1.45 1.05L12 17.75z">
                                    </path>
                                </svg>
                            @endif
                        @endfor
                        <span class="text-sm text-slate-600">
                            {{ $mostPopularProduct2->reviews_count ?? 0 }} reviews
                        </span>
                    </div>
                    <div>
                        <span class="space-x-2 text-sm text-slate-600">{{ $mostPopularProduct2->sold_count ?? 0 }}
                            terjual</span>
                    </div>

                    <div class="flex justify-between">
                        <p class="text-xl text-blue-500 font-medium tracking-tight">
                            Rp.{{ number_format($mostPopularProduct2->price_product, 0, ',', '.') }}
                        </p>
                        @auth
                            <button onclick="addToCart({{ $mostPopularProduct2->id }}, this)" type="button"
                                class="w-10 h-10 bg-blue-500 flex justify-center items-center rounded-md">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M2 3L2.26491 3.0883C3.58495 3.52832 4.24497 3.74832 4.62248 4.2721C5 4.79587 5 5.49159 5 6.88304V9.5C5 12.3284 5 13.7426 5.87868 14.6213C6.75736 15.5 8.17157 15.5 11 15.5H19"
                                            stroke="#ffffff" stroke-width="1.5" stroke-linecap="round">
                                        </path>
                                        <path
                                            d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z"
                                            stroke="#ffffff" stroke-width="1.5"></path>
                                        <path
                                            d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z"
                                            stroke="#ffffff" stroke-width="1.5"></path>
                                        <path
                                            d="M5 6H16.4504C18.5054 6 19.5328 6 19.9775 6.67426C20.4221 7.34853 20.0173 8.29294 19.2078 10.1818L18.7792 11.1818C18.4013 12.0636 18.2123 12.5045 17.8366 12.7523C17.4609 13 16.9812 13 16.0218 13H5"
                                            stroke="#ffffff" stroke-width="1.5"></path>
                                    </g>
                                </svg>
                            </button>
                        @else
                            <a href="{{ route('login') }}"
                                class="w-10 h-10 bg-blue-500 flex justify-center items-center rounded-md">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M2 3L2.26491 3.0883C3.58495 3.52832 4.24497 3.74832 4.62248 4.2721C5 4.79587 5 5.49159 5 6.88304V9.5C5 12.3284 5 13.7426 5.87868 14.6213C6.75736 15.5 8.17157 15.5 11 15.5H19"
                                            stroke="#ffffff" stroke-width="1.5" stroke-linecap="round">
                                        </path>
                                        <path
                                            d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z"
                                            stroke="#ffffff" stroke-width="1.5"></path>
                                        <path
                                            d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z"
                                            stroke="#ffffff" stroke-width="1.5"></path>
                                        <path
                                            d="M5 6H16.4504C18.5054 6 19.5328 6 19.9775 6.67426C20.4221 7.34853 20.0173 8.29294 19.2078 10.1818L18.7792 11.1818C18.4013 12.0636 18.2123 12.5045 17.8366 12.7523C17.4609 13 16.9812 13 16.0218 13H5"
                                            stroke="#ffffff" stroke-width="1.5"></path>
                                    </g>
                                </svg>
                            </a>
                        @endauth
                    </div>

                @endif
            </div>
            <div class="border-2 py-3 px-5 relative">
                @if ($mostPopularProduct3)
                    <a href="{{ route('page.productshow', $mostPopularProduct3->slug) }}"
                        class="w-32 h-32 flex justify-center items-center bg-center bg-cover overflow-hidden mx-auto">
                        <!-- Memeriksa apakah ada gambar produk -->
                        @if ($mostPopularProduct3->image_product)
                            <img src="{{ asset('storage/' . $mostPopularProduct3->image_product) }}"
                                alt="Hp" />
                        @else
                            <!-- Jika tidak ada gambar, tampilkan gambar default -->
                            <img src="{{ asset('img/laptop.jpg') }}" alt="Default Image" />
                        @endif
                    </a>

                    <a href="{{ route('page.productshow', $mostPopularProduct3->slug) }}"
                        class="text-sm text-slate-700 mb-4">
                        {{ $mostPopularProduct3->name_product }}
                    </a>

                    <div class="flex items-center space-x-1 mb-2">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= floor($mostPopularProduct3->average_rating ?? 0))
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    class="w-4 h-4 text-yellow-400" viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.75l-6.16 3.24a1 1 0 0 1-1.45-1.05l1.17-7.23L1.31 8.7a1 1 0 0 1 .56-1.72l7.29-.61L12 .25l3.03 6.12 7.29.61a1 1 0 0 1 .56 1.72l-4.74 4.24 1.17 7.23a1 1 0 0 1-1.45 1.05L12 17.75z">
                                    </path>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    class="w-4 h-4 text-gray-300" viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.75l-6.16 3.24a1 1 0 0 1-1.45-1.05l1.17-7.23L1.31 8.7a1 1 0 0 1 .56-1.72l7.29-.61L12 .25l3.03 6.12 7.29.61a1 1 0 0 1 .56 1.72l-4.74 4.24 1.17 7.23a1 1 0 0 1-1.45 1.05L12 17.75z">
                                    </path>
                                </svg>
                            @endif
                        @endfor
                        <span class="text-sm text-slate-600">
                            {{ $mostPopularProduct3->reviews_count ?? 0 }} reviews
                        </span>
                    </div>
                    <div>
                        <span class="space-x-2 text-sm text-slate-600">{{ $mostPopularProduct3->sold_count ?? 0 }}
                            terjual</span>
                    </div>

                    <div class="flex justify-between">
                        <p class="text-xl text-blue-500 font-medium tracking-tight">
                            Rp.{{ number_format($mostPopularProduct3->price_product, 0, ',', '.') }}
                        </p>
                        @auth
                            <button onclick="addToCart({{ $mostPopularProduct3->id }}, this)" type="button"
                                class="w-10 h-10 bg-blue-500 flex justify-center items-center rounded-md ml-auto">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M2 3L2.26491 3.0883C3.58495 3.52832 4.24497 3.74832 4.62248 4.2721C5 4.79587 5 5.49159 5 6.88304V9.5C5 12.3284 5 13.7426 5.87868 14.6213C6.75736 15.5 8.17157 15.5 11 15.5H19"
                                            stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path>
                                        <path
                                            d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z"
                                            stroke="#ffffff" stroke-width="1.5"></path>
                                        <path
                                            d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z"
                                            stroke="#ffffff" stroke-width="1.5"></path>
                                        <path
                                            d="M5 6H16.4504C18.5054 6 19.5328 6 19.9775 6.67426C20.4221 7.34853 20.0173 8.29294 19.2078 10.1818L18.7792 11.1818C18.4013 12.0636 18.2123 12.5045 17.8366 12.7523C17.4609 13 16.9812 13 16.0218 13H5"
                                            stroke="#ffffff" stroke-width="1.5"></path>
                                    </g>
                                </svg>
                            </button>
                        @else
                            <a href="{{ route('login') }}"
                                class="w-10 h-10 bg-blue-500 flex justify-center items-center rounded-md">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M2 3L2.26491 3.0883C3.58495 3.52832 4.24497 3.74832 4.62248 4.2721C5 4.79587 5 5.49159 5 6.88304V9.5C5 12.3284 5 13.7426 5.87868 14.6213C6.75736 15.5 8.17157 15.5 11 15.5H19"
                                            stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path>
                                        <path
                                            d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z"
                                            stroke="#ffffff" stroke-width="1.5"></path>
                                        <path
                                            d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z"
                                            stroke="#ffffff" stroke-width="1.5"></path>
                                        <path
                                            d="M5 6H16.4504C18.5054 6 19.5328 6 19.9775 6.67426C20.4221 7.34853 20.0173 8.29294 19.2078 10.1818L18.7792 11.1818C18.4013 12.0636 18.2123 12.5045 17.8366 12.7523C17.4609 13 16.9812 13 16.0218 13H5"
                                            stroke="#ffffff" stroke-width="1.5"></path>
                                    </g>
                                </svg>
                            </a>
                        @endauth
                    </div>

                @endif
            </div>

        </div>
    </section>

    <section class="md:px-28 px-5 py-5 mb-10">
        <h1 class="text-2xl font-semibold text-blue-500 mb-10">
            Kategori <span class=" text-slate-700">Teratas</span>
        </h1>
        <div class="grid md:grid-cols-6 grid-cols-3 gap-4">
            @foreach ($categories as $category)
                <div class="border-2 py-3 px-1 flex flex-col justify-between">
                    <div class="flex justify-center items-center bg-center bg-contain overflow-hidden mx-auto mb-4">
                        @if ($category->image_category)
                            <img src="{{ asset('storage/' . $category->image_category) }}" alt="Gambar Brand"
                                class="img-thumbnail" style="width: 100px; height: auto;">
                        @else
                            <img src="{{ asset('img/laptop.jpg') }}" alt="Default Image" />
                        @endif
                    </div>

                    <a href="#"
                        class="font-medium text-slate-700 text-md text-center block">{{ $category->name_category }}</a>
                </div>
            @endforeach
        </div>
    </section>

    <section class="md:px-28 px-5 py-5 mb-10">
        <h1 class="text-2xl font-semibold text-blue-500 mb-10">
            Produk Teratas <span class=" text-slate-700">berdasarkan Kategori</span>
        </h1>
        <div class="grid md:grid-cols-4 grid-cols-2 gap-4">
            @foreach ($topProducts as $product)
                @if ($product)
                    <!-- Pastikan produk ada -->
                    <div class="border-2 py-3 px-2 flex flex-col justify-between">
                        <a href="{{ route('page.productshow', $product->slug) }}"
                            class="font-medium text-slate-800 text-sm tracking-tighter">
                            {{ $product->name_product }}
                        </a>
                        <a href="{{ route('page.productshow', $product->slug) }}"
                            class="flex justify-center items-center bg-center bg-contain overflow-hidden mx-auto mb-4">
                            @if ($product->image_product)
                                <img src="{{ asset('storage/' . $product->image_product) }}" alt="Product Image"
                                    class="object-cover w-32 h-32" />
                            @else
                                <img src="{{ asset('img/laptop.jpg') }}" alt="Default Image" />
                            @endif
                        </a>
                        <div class="flex items-center space-x-1 mb-2">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= floor($product->average_rating ?? 0))
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        class="w-4 h-4 text-yellow-400" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.75l-6.16 3.24a1 1 0 0 1-1.45-1.05l1.17-7.23L1.31 8.7a1 1 0 0 1 .56-1.72l7.29-.61L12 .25l3.03 6.12 7.29.61a1 1 0 0 1 .56 1.72l-4.74 4.24 1.17 7.23a1 1 0 0 1-1.45 1.05L12 17.75z">
                                        </path>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        class="w-4 h-4 text-gray-300" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.75l-6.16 3.24a1 1 0 0 1-1.45-1.05l1.17-7.23L1.31 8.7a1 1 0 0 1 .56-1.72l7.29-.61L12 .25l3.03 6.12 7.29.61a1 1 0 0 1 .56 1.72l-4.74 4.24 1.17 7.23a1 1 0 0 1-1.45 1.05L12 17.75z">
                                        </path>
                                    </svg>
                                @endif
                            @endfor
                            <span class="text-sm text-slate-600">
                                {{ $product->reviews_count ?? 0 }} reviews
                            </span>
                        </div>
                        <div>
                            <span class="space-x-2 text-sm text-slate-600">{{ $product->sold_count ?? 0 }}
                                terjual</span>
                        </div>

                        <div class="flex justify-between">
                            <p class="text-xl text-blue-500 font-medium tracking-tight">
                                Rp.{{ number_format($product->price_product, 0, ',', '.') }}
                            </p>
                            @auth
                                <button onclick="addToCart({{ $product->id }}, this)" type="button"
                                    class="w-10 h-10 bg-blue-500 flex justify-center items-center rounded-md">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M2 3L2.26491 3.0883C3.58495 3.52832 4.24497 3.74832 4.62248 4.2721C5 4.79587 5 5.49159 5 6.88304V9.5C5 12.3284 5 13.7426 5.87868 14.6213C6.75736 15.5 8.17157 15.5 11 15.5H19"
                                                stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path>
                                            <path
                                                d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z"
                                                stroke="#ffffff" stroke-width="1.5"></path>
                                            <path
                                                d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z"
                                                stroke="#ffffff" stroke-width="1.5"></path>
                                            <path
                                                d="M5 6H16.4504C18.5054 6 19.5328 6 19.9775 6.67426C20.4221 7.34853 20.0173 8.29294 19.2078 10.1818L18.7792 11.1818C18.4013 12.0636 18.2123 12.5045 17.8366 12.7523C17.4609 13 16.9812 13 16.0218 13H5"
                                                stroke="#ffffff" stroke-width="1.5"></path>
                                        </g>
                                    </svg>
                                </button>
                            @else
                                <a href="{{ route('login') }}"
                                    class="w-10 h-10 bg-blue-500 flex justify-center items-center rounded-md">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M2 3L2.26491 3.0883C3.58495 3.52832 4.24497 3.74832 4.62248 4.2721C5 4.79587 5 5.49159 5 6.88304V9.5C5 12.3284 5 13.7426 5.87868 14.6213C6.75736 15.5 8.17157 15.5 11 15.5H19"
                                                stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path>
                                            <path
                                                d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z"
                                                stroke="#ffffff" stroke-width="1.5"></path>
                                            <path
                                                d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z"
                                                stroke="#ffffff" stroke-width="1.5"></path>
                                            <path
                                                d="M5 6H16.4504C18.5054 6 19.5328 6 19.9775 6.67426C20.4221 7.34853 20.0173 8.29294 19.2078 10.1818L18.7792 11.1818C18.4013 12.0636 18.2123 12.5045 17.8366 12.7523C17.4609 13 16.9812 13 16.0218 13H5"
                                                stroke="#ffffff" stroke-width="1.5"></path>
                                        </g>
                                    </svg>
                                </a>
                            @endauth
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>

    <section class="md:px-28 px-5 py-5 mb-10">
        <h1 class="text-2xl font-semibold text-slate-700 mb-10">
            Produk <span class="text-blue-500">Terbaru</span>
        </h1>

        <div class="grid md:grid-cols-[2fr_1fr_1fr] grid-cols-1 gap-4">
            <div class="rounded-lg flex justify-between items-center px-5 py-10 overflow-hidden"
                style="
                        background: linear-gradient(
                            303.63deg,
                            #2da5f3 3.87%,
                            rgba(211, 236, 248, 0.54) 72.91%
                        );
                    ">
                <div>
                    <h5 class="text-2xl font-bold mb-2 text-blue-600">
                        Spesial Produk Terbaru
                    </h5>
                    <div class="grid grid-cols-2">
                        <div>
                            <p class="text-sm text-slate-700 mb-2">
                                Lorem ipsum dolor, sit amet consectetur
                                adipisicing elit. Voluptatem, voluptatum!
                            </p>
                            <a href="{{ route('page.product') }}">
                                <button class="bg-white rounded-lg px-5 py-2 text-sm text-slate-700">
                                    Buy now
                                </button>
                            </a>
                        </div>
                        <img src="{{ asset('desainmini-main/image/hp-2.png') }}" alt="Hp"
                            class="block w-[90rem]" />
                    </div>
                </div>
            </div>
            <div class="border-2 py-3 px-2 flex flex-col justify-between">
                @if ($produkbaru1)
                    <!-- Gambar dibungkus dengan tag <a> untuk mengarah ke halaman produk -->
                    <a href="{{ route('page.productshow', $produkbaru1->slug) }}"
                        class="w-32 h-32 flex justify-center items-center bg-center bg-cover overflow-hidden mx-auto">
                        <!-- Memeriksa apakah ada gambar produk -->
                        @if ($produkbaru1->image_product)
                            <img src="{{ asset('storage/' . $produkbaru1->image_product) }}" alt="Hp" />
                        @else
                            <!-- Jika tidak ada gambar, tampilkan gambar default -->
                            <img src="{{ asset('img/laptop.jpg') }}" alt="Default Image" />
                        @endif
                    </a>


                    <a href="{{ route('page.productshow', $produkbaru1->slug) }}"
                        class="text-sm text-slate-700 mb-4">
                        {{ $produkbaru1->name_product }}
                    </a>

                    <div class="flex items-center space-x-1 mb-2">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= floor($produkbaru1->average_rating ?? 0))
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    class="w-4 h-4 text-yellow-400" viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.75l-6.16 3.24a1 1 0 0 1-1.45-1.05l1.17-7.23L1.31 8.7a1 1 0 0 1 .56-1.72l7.29-.61L12 .25l3.03 6.12 7.29.61a1 1 0 0 1 .56 1.72l-4.74 4.24 1.17 7.23a1 1 0 0 1-1.45 1.05L12 17.75z">
                                    </path>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    class="w-4 h-4 text-gray-300" viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.75l-6.16 3.24a1 1 0 0 1-1.45-1.05l1.17-7.23L1.31 8.7a1 1 0 0 1 .56-1.72l7.29-.61L12 .25l3.03 6.12 7.29.61a1 1 0 0 1 .56 1.72l-4.74 4.24 1.17 7.23a1 1 0 0 1-1.45 1.05L12 17.75z">
                                    </path>
                                </svg>
                            @endif
                        @endfor
                        <span class="text-sm text-slate-600">
                            {{ $produkbaru1->reviews_count ?? 0 }} reviews
                        </span>
                    </div>
                    <div>
                        <span class="space-x-2 text-sm text-slate-600">{{ $produkbaru1->sold_count ?? 0 }}
                            terjual</span>
                    </div>


                    <div class="flex justify-between">
                        <p class="text-xl text-blue-500 font-medium tracking-tight">
                            Rp.{{ number_format($produkbaru1->price_product, 0, ',', '.') }}
                        </p>
                        @auth
                            <button onclick="addToCart({{ $produkbaru1->id }}, this)" type="button"
                                class="w-10 h-10 bg-blue-500 flex justify-center items-center rounded-md">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5">
                                    <path
                                        d="M2 3L2.26491 3.0883C3.58495 3.52832 4.24497 3.74832 4.62248 4.2721C5 4.79587 5 5.49159 5 6.88304V9.5C5 12.3284 5 13.7426 5.87868 14.6213C6.75736 15.5 8.17157 15.5 11 15.5H19"
                                        stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path>
                                    <path
                                        d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z"
                                        stroke="#ffffff" stroke-width="1.5"></path>
                                    <path
                                        d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z"
                                        stroke="#ffffff" stroke-width="1.5"></path>
                                    <path
                                        d="M5 6H16.4504C18.5054 6 19.5328 6 19.9775 6.67426C20.4221 7.34853 20.0173 8.29294 19.2078 10.1818L18.7792 11.1818C18.4013 12.0636 18.2123 12.5045 17.8366 12.7523C17.4609 13 16.9812 13 16.0218 13H5"
                                        stroke="#ffffff" stroke-width="1.5"></path>
                                </svg>
                            </button>
                        @else
                            <a href="{{ route('login') }}"
                                class="w-10 h-10 bg-blue-500 flex justify-center items-center rounded-md">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5">
                                    <path
                                        d="M2 3L2.26491 3.0883C3.58495 3.52832 4.24497 3.74832 4.62248 4.2721C5 4.79587 5 5.49159 5 6.88304V9.5C5 12.3284 5 13.7426 5.87868 14.6213C6.75736 15.5 8.17157 15.5 11 15.5H19"
                                        stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"></path>
                                    <path
                                        d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z"
                                        stroke="#ffffff" stroke-width="1.5"></path>
                                    <path
                                        d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z"
                                        stroke="#ffffff" stroke-width="1.5"></path>
                                    <path
                                        d="M5 6H16.4504C18.5054 6 19.5328 6 19.9775 6.67426C20.4221 7.34853 20.0173 8.29294 19.2078 10.1818L18.7792 11.1818C18.4013 12.0636 18.2123 12.5045 17.8366 12.7523C17.4609 13 16.9812 13 16.0218 13H5"
                                        stroke="#ffffff" stroke-width="1.5"></path>
                                </svg>
                            </a>
                        @endauth
                    </div>

                @endif
            </div>

            <div class="border-2 py-3 px-2 flex flex-col justify-between">
                @if ($produkbaru2)
                    <a href="{{ route('page.productshow', $produkbaru2->slug) }}"
                        class="w-32 h-32 flex justify-center items-center bg-center bg-cover overflow-hidden mx-auto">
                        <!-- Memeriksa apakah ada gambar produk -->
                        @if ($produkbaru2->image_product)
                            <img src="{{ asset('storage/' . $produkbaru2->image_product) }}"
                                alt="Hp" />
                        @else
                            <!-- Jika tidak ada gambar, tampilkan gambar default -->
                            <img src="{{ asset('img/laptop.jpg') }}" alt="Default Image" />
                        @endif
                    </a>


                    <a href="{{ route('page.productshow', $produkbaru2->slug) }}"
                        class="text-sm text-slate-700 mb-4">
                        {{ $produkbaru2->name_product }}
                    </a>

                    <div class="flex items-center space-x-1 mb-2">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= floor($produkbaru2->average_rating ?? 0))
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    class="w-4 h-4 text-yellow-400" viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.75l-6.16 3.24a1 1 0 0 1-1.45-1.05l1.17-7.23L1.31 8.7a1 1 0 0 1 .56-1.72l7.29-.61L12 .25l3.03 6.12 7.29.61a1 1 0 0 1 .56 1.72l-4.74 4.24 1.17 7.23a1 1 0 0 1-1.45 1.05L12 17.75z">
                                    </path>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    class="w-4 h-4 text-gray-300" viewBox="0 0 24 24">
                                    <path
                                        d="M12 17.75l-6.16 3.24a1 1 0 0 1-1.45-1.05l1.17-7.23L1.31 8.7a1 1 0 0 1 .56-1.72l7.29-.61L12 .25l3.03 6.12 7.29.61a1 1 0 0 1 .56 1.72l-4.74 4.24 1.17 7.23a1 1 0 0 1-1.45 1.05L12 17.75z">
                                    </path>
                                </svg>
                            @endif
                        @endfor
                        <span class="text-sm text-slate-600">
                            {{ $produkbaru2->reviews_count ?? 0 }} reviews
                        </span>
                    </div>
                    <div>
                        <span class="space-x-2 text-sm text-slate-600">{{ $produkbaru2->sold_count ?? 0 }}
                            terjual</span>
                    </div>

                    <div class="flex justify-between">
                        <p class="text-xl text-blue-500 font-medium tracking-tight">
                            Rp.{{ number_format($produkbaru2->price_product, 0, ',', '.') }}
                        </p>
                        @auth
                            <button onclick="addToCart({{ $produkbaru2->id }}, this)" type="button"
                                class="w-10 h-10 bg-blue-500 flex justify-center items-center rounded-md">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M2 3L2.26491 3.0883C3.58495 3.52832 4.24497 3.74832 4.62248 4.2721C5 4.79587 5 5.49159 5 6.88304V9.5C5 12.3284 5 13.7426 5.87868 14.6213C6.75736 15.5 8.17157 15.5 11 15.5H19"
                                            stroke="#ffffff" stroke-width="1.5" stroke-linecap="round">
                                        </path>
                                        <path
                                            d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z"
                                            stroke="#ffffff" stroke-width="1.5"></path>
                                        <path
                                            d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z"
                                            stroke="#ffffff" stroke-width="1.5"></path>
                                        <path
                                            d="M5 6H16.4504C18.5054 6 19.5328 6 19.9775 6.67426C20.4221 7.34853 20.0173 8.29294 19.2078 10.1818L18.7792 11.1818C18.4013 12.0636 18.2123 12.5045 17.8366 12.7523C17.4609 13 16.9812 13 16.0218 13H5"
                                            stroke="#ffffff" stroke-width="1.5"></path>
                                    </g>
                                </svg>
                            </button>
                        @else
                            <a href="{{ route('login') }}"
                                class="w-10 h-10 bg-blue-500 flex justify-center items-center rounded-md">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M2 3L2.26491 3.0883C3.58495 3.52832 4.24497 3.74832 4.62248 4.2721C5 4.79587 5 5.49159 5 6.88304V9.5C5 12.3284 5 13.7426 5.87868 14.6213C6.75736 15.5 8.17157 15.5 11 15.5H19"
                                            stroke="#ffffff" stroke-width="1.5" stroke-linecap="round">
                                        </path>
                                        <path
                                            d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z"
                                            stroke="#ffffff" stroke-width="1.5"></path>
                                        <path
                                            d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z"
                                            stroke="#ffffff" stroke-width="1.5"></path>
                                        <path
                                            d="M5 6H16.4504C18.5054 6 19.5328 6 19.9775 6.67426C20.4221 7.34853 20.0173 8.29294 19.2078 10.1818L18.7792 11.1818C18.4013 12.0636 18.2123 12.5045 17.8366 12.7523C17.4609 13 16.9812 13 16.0218 13H5"
                                            stroke="#ffffff" stroke-width="1.5"></path>
                                    </g>
                                </svg>
                            </a>
                        @endauth
                    </div>

                @endif
            </div>
        </div>
    </section>

    <section class="px-5 sm:px-10 md:px-20 lg:px-28 py-10 bg-[#EAF6FE]">
        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Customer Support Section -->
            <div>
                <h6 class="text-sm text-slate-800 font-semibold mb-4">Customer Support:</h6>
                <h4 class="text-lg font-semibold text-slate-700 mb-3">(629) 555-0129</h4>
                <p class="text-sm text-slate-600 mb-4">
                    4517 Washington Ave. <br />
                    Manchester, Kentucky 39495
                </p>
                <p class="text-sm text-slate-700">info@zentech.com</p>
            </div>

            <!-- Top Category Section -->
            <div>
                <h6 class="text-sm text-slate-800 font-semibold mb-4">Kategori Teratas</h6>
                <ul class="space-y-2">
                    @foreach ($categories as $category)
                        <li>
                            <p class="text-sm text-slate-600">{{ $category->name_category }}</p>
                        </li>
                    @endforeach
                    <li>
                        <a href="{{ route('page.product') }}" class="text-sm text-blue-500 hover:underline">
                            Cari semua produk →
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Quick Links Section -->
            <div>
                <h6 class="text-sm text-slate-800 font-semibold mb-4">Menu Cepat</h6>
                <ul class="space-y-2">
                    <li><a href="{{ route('page.product') }}"
                            class="text-sm text-slate-600 hover:text-slate-800">Semua Produk</a></li>
                    <li><a href="{{ route('about-page') }}"
                            class="text-sm text-slate-600 hover:text-slate-800">Tentang Kami</a></li>
                    <li><a href="{{ route('contact-page') }}"
                            class="text-sm text-slate-600 hover:text-slate-800">Hubungi Kami</a></li>
                    <li><a href="{{ route('user.orders.index') }}"
                            class="text-sm text-slate-600 hover:text-slate-800">Pesanan</a></li>
                    <li><a href="{{ route('user.carts.index') }}"
                            class="text-sm text-slate-600 hover:text-slate-800">Keranjang</a></li>
                </ul>
            </div>

            <!-- Download App Section -->
            <div>
                <h6 class="text-sm text-slate-800 font-semibold mb-4">Download App</h6>
                <div class="flex flex-col sm:flex-row md:flex-col gap-3">
                    <a href="#" class="block w-28 sm:w-36 md:w-32">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg"
                            alt="Google Play" class="w-full" />
                    </a>
                    <a href="#" class="block w-28 sm:w-36 md:w-32">
                        <img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg"
                            alt="App Store" class="w-full" />
                    </a>
                </div>
            </div>
        </div>
    </section>


    <x-list-cart-script />

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const carousel = document.getElementById("carouselSlides");
            const slides = carousel.children;
            const prevButton = document.getElementById("prevSlide");
            const nextButton = document.getElementById("nextSlide");

            // Mengecek jika hanya ada 1 slide
            if (slides.length === 1) {
                prevButton.style.display = "none"; // Sembunyikan tombol prev
                nextButton.style.display = "none"; // Sembunyikan tombol next
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const notifButton = document.getElementById('userNotificationDropdown');
            const notifMenu = document.getElementById('notificationDropdownMenu');

            if (notifButton && notifMenu) {
                // Toggle dropdown saat tombol diklik
                notifButton.addEventListener('click', function(e) {
                    e.stopPropagation();
                    notifMenu.classList.toggle('hidden');
                    notifMenu.classList.toggle('show');
                });

                // Tutup dropdown saat klik di luar
                document.addEventListener('click', function(e) {
                    if (!notifButton.contains(e.target) && !notifMenu.contains(e.target)) {
                        notifMenu.classList.add('hidden');
                        notifMenu.classList.remove('show');
                    }
                });

                // Mencegah dropdown tertutup saat klik di dalam menu
                notifMenu.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            }
        });
    </script>

    <script>
        function copyToClipboard(text) {
            // Membuat element textarea sementara
            const textarea = document.createElement('textarea');
            textarea.value = text;
            document.body.appendChild(textarea);

            // Select dan copy teksnya
            textarea.select();
            try {
                document.execCommand('copy');
                // Tampilkan SweetAlert untuk sukses
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Kode voucher berhasil disalin',
                    showConfirmButton: false,
                    timer: 1500,
                    customClass: {
                        popup: 'animated bounceIn'
                    }
                });
            } catch (err) {
                console.error('Gagal menyalin teks: ', err);
                // Tampilkan SweetAlert untuk error
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Gagal menyalin kode voucher',
                    confirmButtonColor: '#3085d6'
                });
            }

            // Hapus element textarea sementara
            document.body.removeChild(textarea);
        }
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const slides = document.querySelectorAll("#carouselSlides > div");
            const indicators = document.querySelectorAll("[data-index]");
            const prevSlide = document.getElementById("prevSlide");
            const nextSlide = document.getElementById("nextSlide");
            let currentIndex = 0;

            const showSlide = (index) => {
                const totalSlides = slides.length;
                const carousel = document.getElementById("carouselSlides");

                if (index < 0) index = totalSlides - 1;
                if (index >= totalSlides) index = 0;

                carousel.style.transform = `translateX(-${index * 100}%)`;
                currentIndex = index;

                // Update indicators
                indicators.forEach((indicator, idx) => {
                    indicator.classList.toggle("bg-gray-800", idx === currentIndex);
                    indicator.classList.toggle("bg-gray-300", idx !== currentIndex);
                });
            };

            prevSlide.addEventListener("click", () => showSlide(currentIndex - 1));
            nextSlide.addEventListener("click", () => showSlide(currentIndex + 1));

            indicators.forEach((indicator) => {
                indicator.addEventListener("click", () => {
                    showSlide(Number(indicator.dataset.index));
                });
            });

            // Auto-slide every 5 seconds
            setInterval(() => showSlide(currentIndex + 1), 5000);

            // Show the first slide
            showSlide(currentIndex);
        });
    </script>

    <script>
        window.addEventListener("scroll", () => {
            const header = document.getElementById("header");
            if (window.scrollY >= 10) {
                header.classList.add("backdrop-blur-xl", "sticky");
            } else {
                header.classList.remove("backdrop-blur-xl", "sticky");
            }
            if (window.scrollY >= 750) {
                header.classList.add("bg-blue-700");
            } else {
                header.classList.remove("bg-blue-700");
            }
        });

        const carts = document.getElementById("carts");
        carts.addEventListener("click", () => {
            const closeCart = document.getElementById("close-cart");
            const listCart = document.getElementById("list-cart");
            listCart.classList.remove("hidden");

            closeCart.addEventListener("click", () => {
                listCart.classList.add("hidden");
            });

            listCart.addEventListener("click", (e) => {
                // Periksa apakah target bukan bagian dari 'cart-content' atau tombol 'close-cart'
                if (!e.target.closest("#cart-content")) {
                    listCart.classList.add("hidden");
                }
            });
        });

        const hamburger = document.getElementById("hamburger");
        hamburger.addEventListener("click", () => {
            const closeMenu = document.getElementById("close-menu");
            const listMenu = document.getElementById("list-menu");
            listMenu.classList.remove("hidden");

            closeMenu.addEventListener("click", () => {
                listMenu.classList.add("hidden");
            });

            listMenu.addEventListener("click", (e) => {
                if (!e.target.closest("#menu-content")) {
                    listMenu.classList.add("hidden");
                }
            });
        });

        function minus(id) {
            const input = document.getElementById(id);
            if (input.value > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }

        function plus(id, max) {
            const input = document.getElementById(id);
            if (input.value < max) {
                input.value = parseInt(input.value) + 1;
            }
        }
    </script>
</body>

</html>
