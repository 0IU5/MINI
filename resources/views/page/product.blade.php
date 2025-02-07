<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('img/logoo.png') }}" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{ asset('desainmini-main/dist/output.css') }}" rel="stylesheet" />

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

        @keyframes scroll-fixed {
            0% {
                transform: translateX(0%);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .animate-scroll-fixed {
            animation: scroll-fixed 15s linear infinite;
        }

        /* Duplicate items for seamless loop */
        .animate-scroll-fixed {
            display: flex;
            flex-wrap: nowrap;
        }

        .animate-scroll-fixed>div {
            flex: 0 0 auto;
        }

        /* Clone elements for continuous scroll */
        .animate-scroll-fixed {
            content: "";
            width: max-content;
        }

        /* Pause animation on hover */
        .animate-scroll-fixed:hover {
            animation-play-state: paused;
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

<body>
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
                            <form action="{{ route('page.product') }}" method="GET" class="flex gap-2 flex-1 w-full">
                                <input type="text" name="search"
                                    class="py-1 px-3 outline-none border border-gray-300 rounded-lg text-sm w-full text-slate-700"
                                    placeholder="Search for products..." value="{{ request()->get('search') }}" />
                                <button type="submit">

                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        class="w-4 h-4">
                                        <path
                                            d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z"
                                            stroke="#000000" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('landing-page') }}" class="text-md text-slate-700 py-2 block">Beranda</a>
                    </li>
                    <li>
                        <a href="{{ route('page.product') }}" class="text-md text-slate-700 py-2 block">Produk</a>
                    </li>
                    <li>
                        <a href="{{ route('about-page') }}" class="text-md text-slate-700 py-2 block">Tentang</a>
                    </li>
                    <li>
                        <a href="{{ route('contact-page') }}" class="text-md text-slate-700 py-2 block">Hubugi</a>
                    </li>

                    @guest
                        <li>
                            <a href="{{ route('login') }}"
                                class="text-sm block px-2 py-2 w-full rounded-lg bg-blue-500 text-white text-center mb-3">
                                Masuk</a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}"
                                class="text-sm block px-2 py-2 w-full rounded-lg text-blue-500 text-center">
                                Daftar</a>
                        </li>
                    @endguest
                    @auth

                        <li>
                            <a href="{{ route('user.profile.profile') }}"
                                class="flex justify-start items-center gap-1 text-md py-2 bg-gray-200 text-slate-800 w-auto  px-2 rounded-md">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
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
                                <span class="font-semibold text-xs"> Akun Saya</span>
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

    <div class="grid md:grid-cols-[0.5fr_2fr] grid-cols-1">
        <div class=" md:block hidden">
            <div id="sidebar-left" class="fixed top-0 z-10 py-5 bg-white border-e-2 h-screen ps-5 pe-16 overflow-y-auto"
                style="overflow-y: scroll; max-height: 100vh;">
                <style>
                    #sidebar-left::-webkit-scrollbar {
                        display: none;
                        /* Menyembunyikan scrollbar */
                    }
                </style>
                <a href="{{ route('landing-page') }}" class="text-center block mb-10 w-full">
                    <img src="{{ asset('img/logo&text.svg') }}" alt="logo" class="w-32 mr-2 mx-auto">
                </a>
                <form action="{{ route('page.product') }}" method="GET">
                    <div class="ps-3">
                        <h1 class="font-semibold text-xl text-blue-700 mb-5">Kategori</h1>

                        <div class="max-h-36 overflow-y-scroll mb-4" style="max-height: 10rem; overflow-y: scroll;">
                            <!-- Menghilangkan scrollbar visual di WebKit-based browsers -->
                            <style>
                                .max-h-36::-webkit-scrollbar {
                                    display: none;
                                }
                            </style>
                            @foreach ($categories as $category)
                                <div class="flex gap-2 items-center mb-2">
                                    <div class="relative w-5 h-5">
                                        <!-- Menggunakan checkbox untuk multiple selection -->
                                        <input type="checkbox" name="categories[]" id="category_{{ $category->id }}"
                                            value="{{ $category->id }}"
                                            class="w-full h-full block peer appearance-none cursor-pointer border-2 border-blue-300 rounded-sm checked:bg-no-repeat checked:bg-center checked:border-blue-500 checked:bg-blue-100"
                                            {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }} />
                                        <svg class="absolute w-3 h-3 hidden peer-checked:block text-blue-500 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"
                                            style="user-select: none;pointer-events: none;"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="4" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                    </div>
                                    <label for="category_{{ $category->id }}" class="pointer"
                                        style="cursor: pointer;">{{ $category->name_category }}</label>
                                </div>
                            @endforeach
                        </div>

                        <h1 class="font-semibold text-xl text-blue-700 mb-5">Merek</h1>

                        <div class="max-h-36 overflow-y-scroll mb-4" style="max-height: 10rem; overflow-y: scroll;">
                            <!-- Menghilangkan scrollbar visual di WebKit-based browsers -->
                            <style>
                                .max-h-36::-webkit-scrollbar {
                                    display: none;
                                }
                            </style>

                            @foreach ($brands as $brand)
                                <div class="flex gap-2 items-center mb-2">
                                    <div class="relative w-5 h-5">
                                        <!-- Menggunakan checkbox untuk multiple selection -->
                                        <input type="checkbox" name="Brands[]" id="brand_{{ $brand->id }}"
                                            value="{{ $brand->id }}"
                                            class="w-full h-full block peer appearance-none cursor-pointer border-2 border-blue-300 rounded-sm checked:bg-no-repeat checked:bg-center checked:border-blue-500 checked:bg-blue-100"
                                            {{ in_array($brand->id, request('Brands', [])) ? 'checked' : '' }} />
                                        <svg class="absolute w-3 h-3 hidden peer-checked:block text-blue-500 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"
                                            style="user-select: none;pointer-events: none;"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="4" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                    </div>
                                    <label for="brand_{{ $brand->id }}" class="pointer"
                                        style="cursor: pointer;">{{ $brand->name_brand }}</label>
                                </div>
                            @endforeach
                        </div>
                        <h1 class="font-semibold text-lg text-blue-700 mb-4">Harga </h1>
                        <div class="flex gap-2 items-center mb-2">

                            <div class="flex flex-col gap-3 w-36">
                                <div class="relative">
                                    <input type="number" name="min_price" id="min_price"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " value="{{ request()->old('min_price', $minPrice ?? 0) }}">
                                    <label for="min_price"
                                        class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                                        Min Harga
                                    </label>
                                </div>
                                <div class="w-36">

                                    @error('min_price')
                                        <div class="text-red-500 text-xs ">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Max Harga -->
                                <div class="relative ">
                                    <input type="number" name="max_price" id="max_price"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " value="{{ request()->old('max_price', $maxPrice ?? 0) }}">
                                    <label for="max_price"
                                        class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                                        Max Harga
                                    </label>


                                </div>
                                <div class="w-36">
                                    @error('max_price')
                                        <div class="text-red-500 text-xs ">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                        </div>

                        <button type="submit"
                            class="bg-blue-500 text-white px-3 text-xs py-2 block w-auto rounded-md w-full my-3">
                            Terapkan
                        </button>
                    </div>

            </div>
        </div>
        <div class="px-5">
            <div class=" flex w-full justify-between gap-5 mb-5 sticky top-0 z-10 bg-white py-3 md:pe-5">
                <div
                    class="py-2 rounded-[20px] hidden gap-4 items-center md:w-auto hidden xl:gap-10 items-center xl:flex">
                    <div class="hidden md:flex gap-10">
                        <a href="{{ route('landing-page') }}"
                            class="text-sm text-gray-800 hover:text-[#5D87FF] hover:font-semibold relative after:content-[''] after:block after:h-[2px] after:w-0 after:bg-[#5D87FF] after:mt-1 after:transition-all after:duration-300 after:ease-in-out hover:after:w-full">
                            Beranda
                        </a>
                        <a href="{{ route('page.product') }}"
                            class="text-sm text-gray-800 hover:text-[#5D87FF] hover:font-semibold relative after:content-[''] after:block after:h-[2px] after:w-0 after:bg-[#5D87FF] after:mt-1 after:transition-all after:duration-300 after:ease-in-out hover:after:w-full">
                            Produk
                        </a>
                        <a href="{{ route('about-page') }}"
                            class="text-sm text-gray-800 hover:text-[#5D87FF] hover:font-semibold relative after:content-[''] after:block after:h-[2px] after:w-0 after:bg-[#5D87FF] after:mt-1 after:transition-all after:duration-300 after:ease-in-out hover:after:w-full">
                            Tentang
                        </a>
                        <a href="{{ route('contact-page') }}"
                            class="text-sm text-gray-800 hover:text-[#5D87FF] hover:font-semibold relative after:content-[''] after:block after:h-[2px] after:w-0 after:bg-[#5D87FF] after:mt-1 after:transition-all after:duration-300 after:ease-in-out hover:after:w-full">
                            Hubungi
                        </a>
                    </div>
                </div>


                <div
                    class=" gap-2 flex-1 md:flex-none hidden gap-1 bg-gray-100 rounded-full items-center xl:flex py-2 px-5">
                    <input type="text" name="search" value="{{ request()->get('search') }}"
                        class=" outline-none text-sm w-full text-slate-800 md:w-80 bg-transparent"
                        placeholder="Search" />
                    <button type="submit">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z"
                                    stroke="#333333" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                </path>
                            </g>
                        </svg>
                    </button>
                </div>
                </form>

                <div class="flex gap-1 items-center cursor-pointer">
                    <div class="flex gap-1" id="carts">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M2 3L2.26491 3.0883C3.58495 3.52832 4.24497 3.74832 4.62248 4.2721C5 4.79587 5 5.49159 5 6.88304V9.5C5 12.3284 5 13.7426 5.87868 14.6213C6.75736 15.5 8.17157 15.5 11 15.5H19"
                                    stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path>
                                <path
                                    d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z"
                                    stroke="#1C274C" stroke-width="1.5"></path>
                                <path
                                    d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z"
                                    stroke="#1C274C" stroke-width="1.5"></path>
                                <path
                                    d="M5 6H16.4504C18.5054 6 19.5328 6 19.9775 6.67426C20.4221 7.34853 20.0173 8.29294 19.2078 10.1818L18.7792 11.1818C18.4013 12.0636 18.2123 12.5045 17.8366 12.7523C17.4609 13 16.9812 13 16.0218 13H5"
                                    stroke="#1C274C" stroke-width="1.5"></path>
                            </g>
                        </svg>
                        <span class="text-sm text-slate-700">Keranjang</span>

                        <span class="relative flex h-4 w-4 -translate-y-2 -translate-x-1">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span
                                class="relative inline-flex rounded-full h-4 w-4 bg-red-500 text-white text-[10px] flex items-center justify-center"
                                id="cartCountItem"> 0</span>
                        </span>
                    </div>

                    <!-- Notifikasi Icon dan Dropdown -->
                    @auth
                        @if (!auth()->user()->hasRole('admin'))
                            <div class="relative gap-1">
                                <button class="flex gap-1 items-center" type="button" id="userNotificationDropdown">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="#1C274C" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                        </path>
                                    </svg>
                                    <span class="text-sm text-slate-700">Notifikasi</span>
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
                                xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" class="w-4 h-4">
                                <g id="SVGRepo_iconCarrier">
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none"
                                        fill-rule="evenodd">
                                        <g id="Dribbble-Light-Preview" transform="translate(-420.000000, -2159.000000)"
                                            fill="#000000">
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
                            <a href="{{ route('login') }}" class="text-sm text-slate-700 hover:text-blue-400">Masuk</a>
                            <span>/</span>
                            <a href="{{ route('register') }}"
                                class="text-sm text-slate-700 hover:text-blue-400">Daftar</a>
                        @endguest
                        @auth
                            <div class="relative">
                                <!-- Profil dropdown -->
                                <button id="profileDropdownButton">
                                    <!-- Tampilkan gambar profil -->
                                    <div class="w-10 h-10 rounded-full overflow-hidden">
                                        <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('style/src/assets/images/profile/user-1.jpg') }}"
                                            alt="Profile Picture" class="w-full h-full object-cover">
                                    </div>
                                </button>
                                <!-- Dropdown content -->
                                <div id="profileDropdownMenu"
                                    class="hidden absolute right-0 bg-white shadow-md rounded-lg mt-2 py-2 w-48">
                                    <a href="{{ route('user.profile.profile') }}"
                                        class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Akun Saya</a>
                                    <a href="{{ route('user.orders.index') }}"
                                        class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Pesanan Saya</a>
                                    <a href="{{ route('logout') }}"
                                        class="block px-4 py-2 text-gray-800 hover:bg-gray-100"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="hidden">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @endauth
                    </div>

                    <script>
                        document.getElementById('profileDropdownButton').addEventListener('click', function() {
                            let dropdownMenu = document.getElementById('profileDropdownMenu');
                            dropdownMenu.classList.toggle('hidden');
                        });
                    </script>



                </div>

                <!-- Hamburger Menu (untuk tampilan mobile) -->
                <div class="xl:hidden flex items-center gap-4">
                    <button id="hamburger" class="text-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>

            </div>

            {{-- <h4 class="font-bold">Kode Vocher</h4>

            <div class="w-full bg-gradient-to-r from-blue-500 to-purple-600 p-1 rounded-lg shadow-lg mb-6">
                @if ($codes->isEmpty())
                    <div class="hidden"></div>
                @else
                    <div class="bg-white rounded-lg">
                        <div class="relative h-20 overflow-hidden">
                            <!-- Container dengan lebar tetap -->
                            <div class="absolute inset-0 flex items-center">
                                <!-- Wrapper untuk animasi -->
                                <div class="animate-scroll-fixed flex space-x-4 px-4">
                                    @foreach ($codes as $code)
                                        <div
                                            class="flex-none w-96 bg-blue-50 rounded-lg border-2 border-blue-200 shadow-sm">
                                            <div class="flex items-center h-16 px-4">
                                                <span class="text-2xl flex-none">🎉</span>
                                                <div class="flex flex-col mx-3 flex-grow min-w-0">
                                                    <span class="font-bold text-blue-800 truncate">
                                                        Hemat Rp
                                                        {{ number_format($code->discount_amount, 0, ',', '.') }}
                                                    </span>
                                                    <span class="text-sm text-gray-600 truncate">
                                                        Min. Rp
                                                        {{ number_format($code->minimum_purchase, 0, ',', '.') }}
                                                    </span>
                                                </div>
                                                <div
                                                    class="flex-none px-3 py-1 bg-blue-600 text-white rounded-md font-mono text-sm">
                                                    {{ $code->code }}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div> --}}

            <div class="flex justify-between items md:pe-5">
                <div class="flex gap-2 items-center">
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                            <li class="flex items-center">
                                <a href="{{ route('landing-page') }}"
                                    class="flex justify-center items-end gap-1 bg-gray-200 text-slate-800 w-auto py-1.5 px-2 rounded-md">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M6.49996 7C7.96131 5.53865 9.5935 4.41899 10.6975 3.74088C11.5021 3.24665 12.4978 3.24665 13.3024 3.74088C14.4064 4.41899 16.0386 5.53865 17.5 7C20.6683 10.1684 20.5 12 20.5 15C20.5 16.4098 20.3895 17.5988 20.2725 18.4632C20.1493 19.3726 19.3561 20 18.4384 20H17C15.8954 20 15 19.1046 15 18V16C15 15.2043 14.6839 14.4413 14.1213 13.8787C13.5587 13.3161 12.7956 13 12 13C11.2043 13 10.4413 13.3161 9.87864 13.8787C9.31603 14.4413 8.99996 15.2043 8.99996 16V18C8.99996 19.1046 8.10453 20 6.99996 20H5.56152C4.64378 20 3.85061 19.3726 3.72745 18.4631C3.61039 17.5988 3.49997 16.4098 3.49997 15C3.49997 12 3.33157 10.1684 6.49996 7Z"
                                                stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </svg>
                                    <span class="font-semibold text-xs"> Beranda</span>
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="mx-2 h-4 w-4 text-gray-400 rtl:rotate-180" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="3" d="m9 5 7 7-7 7" />
                                    </svg>
                                    <a href="{{ route('page.product') }}"
                                        class="flex justify-center items-end gap-1 bg-gray-200 text-slate-800 mx-2 w-auto py-2 px-2 rounded-md">
                                        <span class="font-semibold text-xs">Produk</span>
                                    </a>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>

                <div class=" gap-2 items-center ">
                    <button id="filter"
                        class="flex xl:hidden justify-center items-end gap-1 bg-gray-200 text-slate-800 w-auto py-2 px-2 rounded-md ">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M7.60848 4C6.03761 4 5.07993 5.7279 5.91249 7.06L8.08798 10.5408C8.68397 11.4944 8.99999 12.5963 8.99999 13.7208V16.7639C8.99999 17.5215 9.42799 18.214 10.1056 18.5528L13.5528 20.2764C14.2177 20.6088 15 20.1253 15 19.382V13.7208C15 12.5963 15.316 11.4944 15.912 10.5408L18.0875 7.06C18.9201 5.7279 17.9624 4 16.3915 4H7.60848Z"
                                    stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </g>
                        </svg>
                        <span class="font-semibold text-xs"> Filter</span>
                    </button>
                </div>
            </div>

            <div class="flex justify-start items-center mt-4 ">
                <form method="GET" action="{{ route('page.product') }}"
                    class="flex justify-start items-center gap-4">

                    <div class="">
                        <label for="sort_order" class="block text-sm text-slate-700 mb-1">Urutan Penyortiran</label>
                        <select name="sort_order"
                            class="border border-slate-300
                            text-sm px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-md"
                            onchange="this.form.submit();" id="sort_order">
                            <option value="">Dibuat</option>
                            <option value="terlama" {{ request('sort_order') == 'terlama' ? 'selected' : '' }}>
                                Terlama</option>
                            <option value="terbaru" {{ request('sort_order') == 'terbaru' ? 'selected' : '' }}>
                                Terbaru</option>
                        </select>
                    </div>
                    <div class="">
                        <label for="sort_price" class="block text-sm text-slate-700 mb-1">Urutan Harga</label>
                        <select name="sort_price" id="sort_price"
                            class="border border-slate-300 text-sm px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-md"
                            onchange="this.form.submit();">
                            <option value="">Harga</option>
                            <option value="rendah" {{ request('sort_price') == 'rendah' ? 'selected' : '' }}>Rendah ke
                                Tinggi</option>
                            <option value="tinggi" {{ request('sort_price') == 'tinggi' ? 'selected' : '' }}>Tinggi ke
                                Rendah</option>
                        </select>
                    </div>

                </form>
            </div>

            @if ($products->isEmpty())
                <div class="flex flex-col items-center justify-center gap-4 py-10">
                    <!-- Ganti gambar dengan ilustrasi yang relevan -->
                    <img src="{{ asset('img/empty-search.jpg') }}" alt="Produk Tidak Ditemukan" class="w-64 h-64">
                    <p class="text-lg text-gray-600 font-medium">Produk Tidak Ditemukan</p>
                    <p class="text-sm text-gray-500">Maaf, kami tidak dapat menemukan produk yang Anda cari.</p>
                    <a href="{{ route('page.product') }}"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg text-sm hover:bg-blue-600 transition">
                        Lihat Semua Produk
                    </a>
                </div>
            @else
                <div class="mt-5 grid md:grid-cols-4 grid-cols-2 gap-5 pe-5 md:mb-10">
                    @foreach ($products as $product)
                        <div class="border-2 py-3 px-2 flex flex-col justify-between">
                            <a href="{{ route('page.productshow', $product->slug) }}"
                                class="font-medium text-slate-800 text-sm tracking-tighter hover:text-blue-500 transition">
                                {{ $product->name_product }}
                            </a>
                            <a href="{{ route('page.productshow', $product->slug) }}"
                                class="flex justify-center items-center bg-center bg-contain overflow-hidden mx-auto mb-4">
                                @if ($product->image_product)
                                    <img src="{{ asset('storage/' . $product->image_product) }}"
                                        alt="{{ $product->name_product }}" class="object-cover w-32 h-32">
                                @else
                                    <img src="{{ asset('img/laptop.jpg') }}" alt="Default Image"
                                        class="object-cover w-32 h-32">
                                @endif
                            </a>

                            <!-- Penilaian produk -->
                            <div class="flex items-center space-x-1 mb-2">
                                @for ($i = 0; $i < 5; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        class="w-4 h-4 {{ $i < round($product->average_rating) ? 'text-yellow-400' : 'text-gray-300' }}"
                                        viewBox="0 0 24 24" stroke="none">
                                        <path
                                            d="M12 17.75l-6.16 3.24a1 1 0 0 1-1.45-1.05l1.17-7.23L1.31 8.7a1 1 0 0 1 .56-1.72l7.29-.61L12 .25l3.03 6.12 7.29.61a1 1 0 0 1 .56 1.72l-4.74 4.24 1.17 7.23a1 1 0 0 1-1.45 1.05L12 17.75z">
                                        </path>
                                    </svg>
                                @endfor
                                <span class="text-sm text-slate-600">{{ $reviewsCount[$product->id] ?? 0 }}
                                    reviews</span>
                            </div>

                            <!-- Jumlah Terjual -->
                            <div class="flex items-center gap-1">
                                <span class="text-sm text-slate-600">
                                    Terjual: {{ $product->sold_count }} unit
                                </span>
                            </div>

                            <div class="md:flex justify-between">
                                <!-- Harga produk -->
                                <p class="text-xl text-blue-500 font-medium tracking-tight">
                                    Rp {{ number_format($product->price_product, 0, ',', '.') }}
                                </p>

                                @auth
                                    <!-- Tombol Tambah ke Keranjang -->
                                    <button onclick="addToCart({{ $product->id }}, this)" type="button"
                                        class="w-10 h-10 bg-blue-500 flex justify-center items-center rounded-md hover:bg-blue-600 transition">
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
                                    <!-- Tombol Login -->
                                    <a href="{{ route('login') }}"
                                        class="w-10 h-10 bg-blue-500 flex justify-center items-center rounded-md hover:bg-blue-600 transition">
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
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- start filter view -->
    <div id="filter-view"
        class="hidden w-full h-screen overflow-hidden fixed top-0 right-0 left-0 bottom-0 z-20 flex justify-end p-5">
        <div id="filter-content"
            class="relative bg-white shadow-xl overflow-y-auto h-80 mt-32 w-full rounded-md md:w-1/4">
            <div class="p-5 relative">
                <div class="absolute top-0 right-0 cursor-pointer m-1" id="close-filter">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
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
                <form method="GET" action="{{ route('page.product') }}">
                    <div class="ps-3">
                        <h1 class="font-semibold text-center text-xl text-blue-700 mb-5">Katgeori</h1>

                        <!-- Dropdown Select untuk memilih kategori -->
                        <select name="Category" id="category"
                            class="text-center bg-transparent outline-none text-slate-700 w-full mb-3 border-2 rounded-md">
                            <option value=""> Semua Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('Category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name_category }}
                                </option>
                            @endforeach
                        </select>

                        <h1 class="font-semibold text-center text-xl text-blue-700 mb-5">Merek</h1>

                        <select name="Brand" id="brand"
                            class="text-center bg-transparent outline-none text-slate-700 w-full mb-3 border-2 rounded-md">
                            <option value=""> Semua Merek</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}"
                                    {{ request('Brand') == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name_brand }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit"
                            class="bg-blue-500  text-white px-3 text-xs py-2 block w-auto rounded-md w-full my-3">
                            Terapkan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- end filter view -->

    <x-list-cart-script />

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

    <script>
        const filter = document.getElementById("filter");
        filter.addEventListener("click", () => {
            const closeFilter = document.getElementById("close-filter");
            const filterView = document.getElementById("filter-view");
            filterView.classList.remove("hidden");

            closeFilter.addEventListener("click", () => {
                filterView.classList.add("hidden");
            });

            filterView.addEventListener("click", (e) => {
                if (!e.target.closest("#filter-content")) {
                    filterView.classList.add("hidden");
                }
            });
        });
    </script>
</body>

</html>
