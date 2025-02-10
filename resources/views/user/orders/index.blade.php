@extends('layouts.user')
@section('main')

    <style>
        * {
            /* border: 1px solid black; */
        }
    </style>
    <nav class="flex flex-wrap items-center justify-between mb-4" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="flex items-center">
                <a href="{{ route('landing-page') }}"
                    class="flex items-center gap-1 bg-white shadow-sm text-slate-800 py-1.5 px-3 rounded-md">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                        <path
                            d="M6.5 7C7.96 5.54 9.59 4.42 10.7 3.74C11.5 3.25 12.5 3.25 13.3 3.74C14.4 4.42 16.04 5.54 17.5 7C20.67 10.17 20.5 12 20.5 15C20.5 16.41 20.39 17.6 20.27 18.46C20.15 19.37 19.36 20 18.44 20H17C15.9 20 15 19.1 15 18V16C15 15.2 14.68 14.44 14.12 13.88C13.56 13.32 12.8 13 12 13C11.2 13 10.44 13.32 9.88 13.88C9.32 14.44 9 15.2 9 16V18C9 19.1 8.1 20 7 20H5.56C4.64 20 3.85 19.37 3.73 18.46C3.61 17.6 3.5 16.41 3.5 15C3.5 12 3.33 10.17 6.5 7Z"
                            stroke="#1C274C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <span class="font-semibold text-xs">Beranda</span>
                </a>
            </li>

            <li class="flex items-center">
                <svg class="h-4 w-4 text-gray-400 rtl:rotate-180 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                        d="m9 5 7 7-7 7" />
                </svg>
                <span class="bg-white shadow-sm text-slate-800 py-2 px-3 rounded-md font-semibold text-xs">Akun</span>
            </li>

            <li class="flex items-center">
                <svg class="h-4 w-4 text-gray-400 rtl:rotate-180 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                        d="m9 5 7 7-7 7" />
                </svg>
                <a href="{{ route('user.orders.index') }}"
                    class="bg-white shadow-sm text-slate-800 py-2 px-3 rounded-md font-semibold text-xs">Pesanan</a>
            </li>
        </ol>

        <form method="GET" action="{{ route('user.orders.index') }}" class="flex items-center gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode pesanan..."
                class="px-3 py-2 border rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            <button type="submit"
                class="px-4 py-2 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600 transition">
                Cari
            </button>
        </form>
    </nav>

    <div class="flex flex-col justify-center items-start bg-white py-3 px-4 rounded-lg mb-1 shadow-sm">
        <h2 class=" text-xl font-semibold text-gray-800 ">Pesanan Saya </h2>
        <p class="text-muted small">
            Pantau riwayat pesanan Anda beserta statusnya, seperti Pending, Diproses, Selesai, atau Dibatalkan, untuk
            memastikan semuanya sesuai dengan kebutuhan Anda.
        </p>
    </div>
    <div class="mt-4">
        <div class="flex items-center">
            <div x-data="{ openTab: 1 }" class="w-full">
                <div class="mb-2 bg-white shadow-sm rounded-lg p-2 text-md">
                    <button x-on:click="openTab = 1"
                        :class="{
                            'border-b-2 border-blue-600 text-blue-700': openTab ===
                                1,
                            'border-b-2 border-transparent text-gray-700': openTab !== 1
                        }"
                        class="py-2 px-4 outline-none transition-all duration-300">
                        Semua
                    </button>
                    <button x-on:click="openTab = 2"
                        :class="{
                            'border-b-2 border-blue-600 text-blue-700': openTab ===
                                2,
                            'border-b-2 border-transparent text-gray-700': openTab !== 2
                        }"
                        class="py-2 px-4 outline-none transition-all duration-300">
                        Menunggu
                    </button>
                    <button x-on:click="openTab = 3"
                        :class="{
                            'border-b-2 border-blue-600 text-blue-700': openTab ===
                                3,
                            'border-b-2 border-transparent text-gray-700': openTab !== 3
                        }"
                        class="py-2 px-4 outline-none transition-all duration-300">
                        Dikemas
                    </button>
                    <button x-on:click="openTab = 4"
                        :class="{
                            'border-b-2 border-blue-600 text-blue-700': openTab ===
                                4,
                            'border-b-2 border-transparent text-gray-700': openTab !== 4
                        }"
                        class="py-2 px-4 outline-none transition-all duration-300">
                        Dikirim
                    </button>
                    <button x-on:click="openTab = 5"
                        :class="{
                            'border-b-2 border-blue-600 text-blue-700': openTab ===
                                5,
                            'border-b-2 border-transparent text-gray-700': openTab !== 5
                        }"
                        class="py-2 px-4 outline-none transition-all duration-300">
                        Selesai
                    </button>
                </div>

                <!-- Tab 1 - semua-->
                <div x-show="openTab === 1">
                    <div class="space-y-6">
                        @forelse ($userOrders->sortByDesc('created_at') as $order)
                            <div class="bg-white shadow-sm rounded-lg p-6 flex flex-col">
                                <!-- Baris pertama (tanggal pesanan) -->
                                <div class="flex justify-between text-sm font-medium text-slate-600 px-3">
                                    <span class="block">{{ $order->created_at->translatedFormat('d F Y') }}</span>
                                    <div class="flex">
                                        <span
                                            class="px-3 py-1 rounded-full text-sm font-semibold
                                        @if ($order->status_order === 'completed') bg-green-200 text-green-600
                                        @elseif ($order->status_order === 'processing')
                                            bg-yellow-200 text-yellow-600
                                        @elseif ($order->status_order === 'pending')
                                            bg-blue-200 text-blue-600
                                        @elseif ($order->status_order === 'shipping')
                                            bg-orange-200 text-orange-600
                                        @else
                                            bg-gray-200 text-gray-600 @endif">
                                            {{ ucfirst($order->status_order_label) }}
                                        </span>

                                    </div>
                                </div>

                                <hr class="w-full mx-auto border-2 border-gray-500 my-4">

                                @if ($order->productOrders->count() > 0)
                                    <div class="flex justify-between items-center">
                                        <!-- Produk Pertama -->
                                        <div class="flex gap-2">
                                            <div
                                                class="w-20 h-20 bg-cover bg-center overflow-hidden flex justify-center items-center rounded-md border border-slate-300 shadow-sm">
                                                @if ($order->productOrders->first()->product->image_product)
                                                    <img src="{{ asset('storage/' . $order->productOrders->first()->product->image_product) }}"
                                                        alt="{{ $order->productOrders->first()->product->name_product }}"
                                                        class="object-contain" />
                                                @else
                                                    <img src="{{ asset('img/laptop.jpg') }}" alt="Default"
                                                        class="object-contain" />
                                                @endif
                                            </div>
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-semibold text-slate-800">{{ $order->productOrders->first()->product->name_product }}</span>
                                                <span
                                                    class="text-xs text-slate-500">x{{ $order->productOrders->first()->quantity }}</span>
                                            </div>
                                        </div>

                                        <!-- Perhitungan Harga -->
                                        <div class="text-slate-700 text-sm">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td class=" text-right">Subtotal Produk</td>
                                                        <td class=" px-2 text-center">:</td>
                                                        <td class="text-left">Rp.
                                                            {{ number_format($order->sub_total_amount, 0, ',', '.') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class=" text-right">Pengiriman</td>
                                                        <td class=" px-2 text-center">:</td>
                                                        <td class="text-left">Rp.
                                                            {{ number_format($order->postage->ongkir_total_amount, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class=" text-right">Diskon</td>
                                                        <td class=" px-2 text-center">:</td>
                                                        <td class="text-left">Rp.
                                                            {{ number_format($order->promoCode?->discount_amount, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class=" text-right font-bold">Total</td>
                                                        <td class=" px-2 text-center font-bold">:</td>
                                                        <td class="text-left font-bold">Rp.
                                                            {{ number_format($order->grand_total_amount, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif

                                <hr class="w-full mx-auto border-2 border-gray-500 my-4">

                                <!-- Baris ketiga (total harga, tombol detail, dan produk lainnya) -->
                                <div class="flex justify-between items-center px-3">
                                    <div class="flex justify-center items-center gap-2 text-center">
                                        <!-- Tombol Detail -->
                                        <a href="{{ route('user.orders.show', $order->id) }}"
                                            class="bg-blue-700 text-white rounded-lg px-3 py-2 text-sm">Detail</a>

                                        <!-- Informasi Produk Lainnya -->
                                        @if ($order->productOrders->count() > 1)
                                            <div class="text-sm text-slate-600">
                                                {{ $order->productOrders->count() - 1 }} produk lainnya
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <span class="text-slate-700 text-lg font-semibold">Total:</span>
                                        <span class="text-lg text-[#5D87FF] font-semibold">Rp.
                                            {{ number_format($order->grand_total_amount, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <div
                                class="bg-white shadow-sm rounded-lg p-4 text-center flex flex-col justify-center items-center">
                                <img src="{{ asset('img/empty-data.png') }}" alt="Produk Tidak Ditemukan"
                                    class="w-64 h-64">
                                <p class="text-lg text-gray-600 font-medium">
                                    {{ request('search') ? 'Kode pesanan tidak ditemukan' : 'Tidak ada pesanan' }}
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Tab 2 - semua-->
                <div x-show="openTab === 2">
                    <div class="space-y-6">
                        @forelse ($userOrders->where('status_order', 'pending')->sortByDesc('created_at') as $order)
                            <div class="bg-white shadow-sm rounded-lg p-6 flex flex-col">
                                <!-- Baris pertama (tanggal pesanan) -->
                                <div class="flex justify-between text-sm font-medium text-slate-600 px-3">
                                    <span class="block">{{ $order->created_at->translatedFormat('d F Y') }}</span>
                                    <div class="flex">
                                        <span
                                            class="px-3 py-1 rounded-full text-sm font-semibold
                                        @if ($order->status_order === 'completed') bg-green-200 text-green-600
                                        @elseif ($order->status_order === 'processing')
                                            bg-yellow-200 text-yellow-600
                                        @elseif ($order->status_order === 'pending')
                                            bg-blue-200 text-blue-600
                                        @elseif ($order->status_order === 'shipping')
                                            bg-orange-200 text-orange-600
                                        @else
                                            bg-gray-200 text-gray-600 @endif">
                                            {{ ucfirst($order->status_order_label) }}
                                        </span>

                                    </div>
                                </div>

                                <hr class="w-full mx-auto border-2 border-gray-500 my-4">

                                @if ($order->productOrders->count() > 0)
                                    <div class="flex justify-between items-center">
                                        <!-- Produk Pertama -->
                                        <div class="flex gap-2">
                                            <div
                                                class="w-20 h-20 bg-cover bg-center overflow-hidden flex justify-center items-center rounded-md border border-slate-300 shadow-sm">
                                                @if ($order->productOrders->first()->product->image_product)
                                                    <img src="{{ asset('storage/' . $order->productOrders->first()->product->image_product) }}"
                                                        alt="{{ $order->productOrders->first()->product->name_product }}"
                                                        class="object-contain" />
                                                @else
                                                    <img src="{{ asset('img/laptop.jpg') }}" alt="Default"
                                                        class="object-contain" />
                                                @endif
                                            </div>
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-semibold text-slate-800">{{ $order->productOrders->first()->product->name_product }}</span>
                                                <span
                                                    class="text-xs text-slate-500">x{{ $order->productOrders->first()->quantity }}</span>
                                            </div>
                                        </div>

                                        <!-- Perhitungan Harga -->
                                        <div class="text-slate-700 text-sm">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td class=" text-right">Subtotal Produk</td>
                                                        <td class=" px-2 text-center">:</td>
                                                        <td class="text-left">Rp.
                                                            {{ number_format($order->sub_total_amount, 0, ',', '.') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class=" text-right">Pengiriman</td>
                                                        <td class=" px-2 text-center">:</td>
                                                        <td class="text-left">Rp.
                                                            {{ number_format($order->postage->ongkir_total_amount, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class=" text-right">Diskon</td>
                                                        <td class=" px-2 text-center">:</td>
                                                        <td class="text-left">Rp.
                                                            {{ number_format($order->promoCode?->discount_amount, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class=" text-right font-bold">Total</td>
                                                        <td class=" px-2 text-center font-bold">:</td>
                                                        <td class="text-left font-bold">Rp.
                                                            {{ number_format($order->grand_total_amount, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif

                                <hr class="w-full mx-auto border-2 border-gray-500 my-4">

                                <!-- Baris ketiga (total harga, tombol detail, dan produk lainnya) -->
                                <div class="flex justify-between items-center px-3">
                                    <div class="flex justify-center items-center gap-2 text-center">
                                        <!-- Tombol Detail -->
                                        <a href="{{ route('user.orders.show', $order->id) }}"
                                            class="bg-blue-700 text-white rounded-lg px-3 py-2 text-sm">Detail</a>

                                        <!-- Informasi Produk Lainnya -->
                                        @if ($order->productOrders->count() > 1)
                                            <div class="text-sm text-slate-600">
                                                {{ $order->productOrders->count() - 1 }} produk lainnya
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <span class="text-slate-700 text-lg font-semibold">Total:</span>
                                        <span class="text-lg text-[#5D87FF] font-semibold">Rp.
                                            {{ number_format($order->grand_total_amount, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <div
                                class="bg-white shadow-sm rounded-lg p-4 text-center flex flex-col justify-center items-center">
                                <img src="{{ asset('img/empty-data.png') }}" alt="Produk Tidak Ditemukan"
                                    class="w-64 h-64">
                                <p class="text-lg text-gray-600 font-medium">Tidak ada pesanan yang sedang menunggu</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Tab 3 - Proses -->
                <div x-show="openTab === 3">
                    <div class="space-y-6">
                        @forelse ($userOrders->where('status_order', 'processing')->sortByDesc('created_at') as $order)
                            <div class="bg-white shadow-sm rounded-lg p-6 flex flex-col">
                                <!-- Baris pertama (tanggal pesanan) -->
                                <div class="flex justify-between text-sm font-medium text-slate-600 px-3">
                                    <span class="block">{{ $order->created_at->translatedFormat('d F Y') }}</span>
                                    <div class="flex">
                                        <span
                                            class="px-3 py-1 rounded-full text-sm font-semibold
                                        @if ($order->status_order === 'completed') bg-green-200 text-green-600
                                        @elseif ($order->status_order === 'processing')
                                            bg-yellow-200 text-yellow-600
                                        @elseif ($order->status_order === 'pending')
                                            bg-blue-200 text-blue-600
                                        @elseif ($order->status_order === 'shipping')
                                            bg-orange-200 text-orange-600
                                        @else
                                            bg-gray-200 text-gray-600 @endif">
                                            {{ ucfirst($order->status_order_label) }}
                                        </span>

                                    </div>
                                </div>

                                <hr class="w-full mx-auto border-2 border-gray-500 my-4">

                                @if ($order->productOrders->count() > 0)
                                    <div class="flex justify-between items-center">
                                        <!-- Produk Pertama -->
                                        <div class="flex gap-2">
                                            <div
                                                class="w-20 h-20 bg-cover bg-center overflow-hidden flex justify-center items-center rounded-md border border-slate-300 shadow-sm">
                                                @if ($order->productOrders->first()->product->image_product)
                                                    <img src="{{ asset('storage/' . $order->productOrders->first()->product->image_product) }}"
                                                        alt="{{ $order->productOrders->first()->product->name_product }}"
                                                        class="object-contain" />
                                                @else
                                                    <img src="{{ asset('img/laptop.jpg') }}" alt="Default"
                                                        class="object-contain" />
                                                @endif
                                            </div>
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-semibold text-slate-800">{{ $order->productOrders->first()->product->name_product }}</span>
                                                <span
                                                    class="text-xs text-slate-500">x{{ $order->productOrders->first()->quantity }}</span>
                                            </div>
                                        </div>

                                        <!-- Perhitungan Harga -->
                                        <div class="text-slate-700 text-sm">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td class=" text-right">Subtotal Produk</td>
                                                        <td class=" px-2 text-center">:</td>
                                                        <td class="text-left">Rp.
                                                            {{ number_format($order->sub_total_amount, 0, ',', '.') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class=" text-right">Pengiriman</td>
                                                        <td class=" px-2 text-center">:</td>
                                                        <td class="text-left">Rp.
                                                            {{ number_format($order->postage->ongkir_total_amount, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class=" text-right">Diskon</td>
                                                        <td class=" px-2 text-center">:</td>
                                                        <td class="text-left">Rp.
                                                            {{ number_format($order->promoCode?->discount_amount, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class=" text-right font-bold">Total</td>
                                                        <td class=" px-2 text-center font-bold">:</td>
                                                        <td class="text-left font-bold">Rp.
                                                            {{ number_format($order->grand_total_amount, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif

                                <hr class="w-full mx-auto border-2 border-gray-500 my-4">

                                <!-- Baris ketiga (total harga, tombol detail, dan produk lainnya) -->
                                <div class="flex justify-between items-center px-3">
                                    <div class="flex justify-center items-center gap-2 text-center">
                                        <!-- Tombol Detail -->
                                        <a href="{{ route('user.orders.show', $order->id) }}"
                                            class="bg-blue-700 text-white rounded-lg px-3 py-2 text-sm">Detail</a>

                                        <!-- Informasi Produk Lainnya -->
                                        @if ($order->productOrders->count() > 1)
                                            <div class="text-sm text-slate-600">
                                                {{ $order->productOrders->count() - 1 }} produk lainnya
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <span class="text-slate-700 text-lg font-semibold">Total:</span>
                                        <span class="text-lg text-[#5D87FF] font-semibold">Rp.
                                            {{ number_format($order->grand_total_amount, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div
                                class="bg-white shadow-sm rounded-lg p-4 text-center flex flex-col justify-center items-center">
                                <img src="{{ asset('img/empty-data.png') }}" alt="Produk Tidak Ditemukan"
                                    class="w-64 h-64">
                                <p class="text-lg text-gray-600 font-medium">Tidak ada pesanan yang sedang dikemas</p>
                            </div>
                        @endforelse
                    </div>
                </div>
                <!-- Tab 4 - Dikirim -->
                <div x-show="openTab === 4">
                    <div class="space-y-6">
                        @forelse ($userOrders->where('status_order', 'shipping')->sortByDesc('created_at') as $order)
                            <div class="bg-white shadow-sm rounded-lg p-6 flex flex-col">
                                <!-- Baris pertama (tanggal pesanan) -->
                                <div class="flex justify-between text-sm font-medium text-slate-600 px-3">
                                    <span class="block">{{ $order->created_at->translatedFormat('d F Y') }}</span>
                                    <div class="flex">
                                        <span
                                            class="px-3 py-1 rounded-full text-sm font-semibold
                                        @if ($order->status_order === 'completed') bg-green-200 text-green-600
                                        @elseif ($order->status_order === 'processing')
                                            bg-yellow-200 text-yellow-600
                                        @elseif ($order->status_order === 'pending')
                                            bg-blue-200 text-blue-600
                                        @elseif ($order->status_order === 'shipping')
                                            bg-orange-200 text-orange-600
                                        @else
                                            bg-gray-200 text-gray-600 @endif">
                                            {{ ucfirst($order->status_order_label) }}
                                        </span>

                                    </div>
                                </div>

                                <hr class="w-full mx-auto border-2 border-gray-500 my-4">

                                @if ($order->productOrders->count() > 0)
                                    <div class="flex justify-between items-center">
                                        <!-- Produk Pertama -->
                                        <div class="flex gap-2">
                                            <div
                                                class="w-20 h-20 bg-cover bg-center overflow-hidden flex justify-center items-center rounded-md border border-slate-300 shadow-sm">
                                                @if ($order->productOrders->first()->product->image_product)
                                                    <img src="{{ asset('storage/' . $order->productOrders->first()->product->image_product) }}"
                                                        alt="{{ $order->productOrders->first()->product->name_product }}"
                                                        class="object-contain" />
                                                @else
                                                    <img src="{{ asset('img/laptop.jpg') }}" alt="Default"
                                                        class="object-contain" />
                                                @endif
                                            </div>
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-semibold text-slate-800">{{ $order->productOrders->first()->product->name_product }}</span>
                                                <span
                                                    class="text-xs text-slate-500">x{{ $order->productOrders->first()->quantity }}</span>
                                            </div>
                                        </div>

                                        <!-- Perhitungan Harga -->
                                        <div class="text-slate-700 text-sm">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td class=" text-right">Subtotal Produk</td>
                                                        <td class=" px-2 text-center">:</td>
                                                        <td class="text-left">Rp.
                                                            {{ number_format($order->sub_total_amount, 0, ',', '.') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class=" text-right">Pengiriman</td>
                                                        <td class=" px-2 text-center">:</td>
                                                        <td class="text-left">Rp.
                                                            {{ number_format($order->postage->ongkir_total_amount, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class=" text-right">Diskon</td>
                                                        <td class=" px-2 text-center">:</td>
                                                        <td class="text-left">Rp.
                                                            {{ number_format($order->promoCode?->discount_amount, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class=" text-right font-bold">Total</td>
                                                        <td class=" px-2 text-center font-bold">:</td>
                                                        <td class="text-left font-bold">Rp.
                                                            {{ number_format($order->grand_total_amount, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif

                                <hr class="w-full mx-auto border-2 border-gray-500 my-4">

                                <!-- Baris ketiga (total harga, tombol detail, dan produk lainnya) -->
                                <div class="flex justify-between items-center px-3">
                                    <div class="flex justify-center items-center gap-2 text-center">
                                        <!-- Tombol Detail -->
                                        <a href="{{ route('user.orders.show', $order->id) }}"
                                            class="bg-blue-700 text-white rounded-lg px-3 py-2 text-sm">Detail</a>

                                        <!-- Informasi Produk Lainnya -->
                                        @if ($order->productOrders->count() > 1)
                                            <div class="text-sm text-slate-600">
                                                {{ $order->productOrders->count() - 1 }} produk lainnya
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <span class="text-slate-700 text-lg font-semibold">Total:</span>
                                        <span class="text-lg text-[#5D87FF] font-semibold">Rp.
                                            {{ number_format($order->grand_total_amount, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div
                                class="bg-white shadow-sm rounded-lg p-4 text-center flex flex-col justify-center items-center">
                                <img src="{{ asset('img/empty-data.png') }}" alt="Produk Tidak Ditemukan"
                                    class="w-64 h-64">
                                <p class="text-lg text-gray-600 font-medium">Tidak ada pesanan yang sedang dikirim</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Tab 5 - Selesai -->
                <div x-show="openTab === 5">
                    <div class="space-y-6">
                        @forelse ($userOrders->where('status_order', 'completed')->sortByDesc('created_at') as $order)
                            <div class="bg-white shadow-sm rounded-lg p-6 flex flex-col">
                                <!-- Baris pertama (tanggal pesanan) -->
                                <div class="flex justify-between text-sm font-medium text-slate-600 px-3">
                                    <span class="block">{{ $order->created_at->translatedFormat('d F Y') }}</span>
                                    <div class="flex">
                                        <span
                                            class="px-3 py-1 rounded-full text-sm font-semibold
                                        @if ($order->status_order === 'completed') bg-green-200 text-green-600
                                        @elseif ($order->status_order === 'processing')
                                            bg-yellow-200 text-yellow-600
                                        @elseif ($order->status_order === 'pending')
                                            bg-blue-200 text-blue-600
                                        @elseif ($order->status_order === 'shipping')
                                            bg-orange-200 text-orange-600
                                        @else
                                            bg-gray-200 text-gray-600 @endif">
                                            {{ ucfirst($order->status_order_label) }}
                                        </span>

                                    </div>
                                </div>

                                <hr class="w-full mx-auto border-2 border-gray-500 my-4">

                                @if ($order->productOrders->count() > 0)
                                    <div class="flex justify-between items-center">
                                        <!-- Produk Pertama -->
                                        <div class="flex gap-2">
                                            <div
                                                class="w-20 h-20 bg-cover bg-center overflow-hidden flex justify-center items-center rounded-md border border-slate-300 shadow-sm">
                                                @if ($order->productOrders->first()->product->image_product)
                                                    <img src="{{ asset('storage/' . $order->productOrders->first()->product->image_product) }}"
                                                        alt="{{ $order->productOrders->first()->product->name_product }}"
                                                        class="object-contain" />
                                                @else
                                                    <img src="{{ asset('img/laptop.jpg') }}" alt="Default"
                                                        class="object-contain" />
                                                @endif
                                            </div>
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-semibold text-slate-800">{{ $order->productOrders->first()->product->name_product }}</span>
                                                <span
                                                    class="text-xs text-slate-500">x{{ $order->productOrders->first()->quantity }}</span>
                                            </div>
                                        </div>

                                        <!-- Perhitungan Harga -->
                                        <div class="text-slate-700 text-sm">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td class=" text-right">Subtotal Produk</td>
                                                        <td class=" px-2 text-center">:</td>
                                                        <td class="text-left">Rp.
                                                            {{ number_format($order->sub_total_amount, 0, ',', '.') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class=" text-right">Pengiriman</td>
                                                        <td class=" px-2 text-center">:</td>
                                                        <td class="text-left">Rp.
                                                            {{ number_format($order->postage->ongkir_total_amount, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class=" text-right">Diskon</td>
                                                        <td class=" px-2 text-center">:</td>
                                                        <td class="text-left">Rp.
                                                            {{ number_format($order->promoCode?->discount_amount, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class=" text-right font-bold">Total</td>
                                                        <td class=" px-2 text-center font-bold">:</td>
                                                        <td class="text-left font-bold">Rp.
                                                            {{ number_format($order->grand_total_amount, 0, ',', '.') }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endif

                                <hr class="w-full mx-auto border-2 border-gray-500 my-4">

                                <!-- Baris ketiga (total harga, tombol detail, dan produk lainnya) -->
                                <div class="flex justify-between items-center px-3">
                                    <div class="flex justify-center items-center gap-2 text-center">
                                        <!-- Tombol Detail -->
                                        <a href="{{ route('user.orders.show', $order->id) }}"
                                            class="bg-blue-700 text-white rounded-lg px-3 py-2 text-sm">Detail</a>

                                        <!-- Informasi Produk Lainnya -->
                                        @if ($order->productOrders->count() > 1)
                                            <div class="text-sm text-slate-600">
                                                {{ $order->productOrders->count() - 1 }} produk lainnya
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <span class="text-slate-700 text-lg font-semibold">Total:</span>
                                        <span class="text-lg text-[#5D87FF] font-semibold">Rp.
                                            {{ number_format($order->grand_total_amount, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div
                                class="bg-white shadow-sm rounded-lg p-4 text-center flex flex-col justify-center items-center">
                                <img src="{{ asset('img/empty-data.png') }}" alt="Produk Tidak Ditemukan"
                                    class="w-64 h-64">
                                <p class="text-lg text-gray-600 font-medium">Tidak ada pesanan yang selesai</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- start review-->

    <div id="list-review"
        class="hidden w-full h-screen overflow-hidden fixed top-0 right-0 left-0 bottom-0 z-20 backdrop-brightness-50 flex justify-center p-5">
        <div id="review-content" class="relative bg-white shadow-xl h-full w-full rounded-md md:w-2/5">
            <div class="absolute top-0 right-0 cursor-pointer m-3" id="close-review">
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
                <h1 class="text-xl font-semibold text-slate-800 mb-2" id="product_name"></h1>
                <form action="{{ route('addReview') }}" method="POST">
                    @csrf <!-- Tambahkan CSRF token untuk keamanan -->

                    <!-- Pilih Bintang -->
                    <div class="mb-5 flex gap-1" id="star-rating">
                        @for ($i = 1; $i <= 5; $i++)
                            <label for="star_{{ $i }}">
                                <input type="radio" name="rating" id="star_{{ $i }}"
                                    value="{{ $i }}" class="hidden" required />
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    class="w-5 h-5 star-icon text-gray-300" data-star="{{ $i }}"
                                    viewBox="0 0 24 24" stroke="none">
                                    <path
                                        d="M12 17.75l-6.16 3.24a1 1 0 0 1-1.45-1.05l1.17-7.23L1.31 8.7a1 1 0 0 1 .56-1.72l7.29-.61L12 .25l3.03 6.12 7.29.61a1 1 0 0 1 .56 1.72l-4.74 4.24 1.17 7.23a1 1 0 0 1-1.45 1.05L12 17.75z">
                                    </path>
                                </svg>
                            </label>
                        @endfor
                    </div>

                    <!-- Komentar -->
                    <div class="py-2 px-4 mb-3 bg-white rounded-lg border border-gray-200">
                        <label for="comment" class="sr-only">Your comment</label>
                        <textarea id="comment" name="comment" rows="6" required
                            class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none"
                            placeholder="Write a comment..."></textarea>
                    </div>

                    <!-- ID Produk -->
                    <input type="hidden" name="product_id" id="product_id">

                    <!-- Kirim -->
                    <div class="mb-3">
                        <button type="submit"
                            class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                            Send
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end review-->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <script>
        const radios = document.querySelectorAll('input[name="bintang"]');

        radios.forEach((radio) => {
            radio.addEventListener("change", (e) => {
                const selectedRating = parseInt(e.target.id.split("_")[1]);
                const previousStars = document.querySelectorAll(
                    `label[for^="start_"] svg`
                );
                previousStars.forEach((star, index) => {
                    if (index < selectedRating) {
                        star.classList.add("fill-yellow-500");
                    } else {
                        star.classList.remove("fill-yellow-500");
                    }
                });
            });
        });
    </script>
    <script>
        document.getElementById('star-rating').addEventListener('click', function(event) {
            // Cari elemen SVG yang diklik
            const clickedStar = event.target.closest('svg');

            if (clickedStar) {
                // Ambil nilai bintang yang dipilih
                const selectedStarValue = clickedStar.getAttribute('data-star');

                // Dapatkan semua ikon bintang
                const starIcons = document.querySelectorAll('.star-icon');

                // Reset warna semua bintang ke gray-300
                starIcons.forEach(icon => {
                    icon.classList.remove('text-yellow-500');
                    icon.classList.add('text-gray-300');
                });

                // Warnai bintang dari 1 hingga nilai yang dipilih
                for (let i = 0; i < selectedStarValue; i++) {
                    starIcons[i].classList.remove('text-gray-300');
                    starIcons[i].classList.add('text-yellow-500');
                }
            }
        });

        // Pastikan bintang selalu dimulai dari gray-300
        document.addEventListener('DOMContentLoaded', () => {
            const starIcons = document.querySelectorAll('.star-icon');
            starIcons.forEach(icon => {
                icon.classList.remove('text-yellow-500');
                icon.classList.add('text-gray-300');
            });
        });
    </script>

    <style>
        .star-icon {
            transition: fill 0.2s ease;
            cursor: pointer;
        }
    </style>
    <script>
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

        function openReview(id, product_name) {
            const closeReview = document.getElementById("close-review");
            const listReview = document.getElementById("list-review");
            listReview.classList.remove("hidden");

            closeReview.addEventListener("click", () => {
                listReview.classList.add("hidden");
            });
            document.getElementById('product_id').value = id;
            document.getElementById('product_name').innerHTML = product_name;

            listReview.addEventListener("click", (e) => {
                if (!e.target.closest("#review-content")) {
                    listReview.classList.add("hidden");
                }
            });
        }

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
@endsection
