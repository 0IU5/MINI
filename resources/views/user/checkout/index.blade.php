<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Checkout</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- font poopins -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <style>
        * {
            font-family: "Poppins", sans-serif;
        }
    </style>
    <style>
        * {
            /* border: 1px solid black; */
        }

        ::-webkit-scrollbar {
            width: 0px;
            background: transparent;
        }

        .scrollbar-hidden {
            -ms-overflow-style: none;
            /* Untuk Internet Explorer */
            scrollbar-width: none;
            /* Untuk Firefox */
        }
    </style>


    {{-- midtrans --}}
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    </script>
</head>

<body class="bg-gray-200">
    <section class="w-full min-h-screen py-1 px-7">
        <div class="my-2 mx-10 ">
            <header class="py-2 bg-white mb-[2px]">
                <div class="w-full h-auto py-5 px-16 ">
                    <div class="flex justify-between items-center">
                        <a href="" class=" flex justify-center items-center logo-img">
                            <img src="{{ asset('img/logo&text.svg') }}" width="170" alt="" />
                        </a>

                        <h1 class="text-2xl font-semibold text-gray-700">
                            Checkout
                        </h1>
                    </div>
                </div>
            </header>

            <form action="{{ route('user.checkout.store') }}" method="post">
                @csrf
                <input type="hidden" name="addresses_id" id="addresses_id">
                <input type="hidden" name="id_discount" id="id_discount" value="" />
                <input type="hidden" name="service" id="service" value="" />
                <div class="flex gap-[2px]">

                    {{-- left side --}}
                    <div
                        class="w-1/2 flex-col justify-center items-center py-3 px-14 bg-white max-h-[700px] overflow-y-auto">
                        <div class="flec-col justify-center items-center">
                            <div class="flex items-center gap-4 mt-2 mb-2 py-2">
                                <div class="w-14 h-14 flex items-center justify-center">
                                    <i class="fas fa-user text-4xl text-gray-600"></i>
                                </div>

                                <div>
                                    <h1 class="text-xl font-semibold text-gray-700">Informasi Profil</h1>
                                    <p class="text-gray-600 text-sm">Berikut adalah informasi terkait dengan nama dan
                                        email
                                        anda.</p>
                                </div>
                            </div>
                            <div class="flex justify-between items-center  gap-3">
                                <div class="relative w-1/2">
                                    <input type="text" name="name" id="name"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-700 bg-transparent rounded-lg border border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " value="{{ auth()->user()->name }}" readonly>
                                    <label for="name"
                                        class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                                        Nama
                                    </label>
                                </div>
                                <div class="relative w-1/2">
                                    <input type="text" name="email" id="email"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-700 bg-transparent rounded-lg border border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " value="{{ auth()->user()->email }}" readonly>
                                    <label for="email"
                                        class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                                        Email
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="flec-col justify-center items-center">
                            <div class="flex items-center gap-4 my-4 ">
                                <div>
                                    <h1 class="text-xl font-semibold text-gray-700">Informasi Alamat</h1>
                                    <p class="text-gray-600 text-sm">Berikut adalah informasi terkait alamat anda.</p>
                                </div>
                            </div>
                            <div class="w-full  overflow-hidden my-3">
                                <div class="flex gap-5 border-2  border-gray-300 rounded-t-lg py-2 px-3 w-full">
                                    <button type="button" onclick="ShowAddAddress(this)" id="tambah_alamat"
                                        class="text-xs text-gray-700 block w-full text-center hover:text-blue-600 ">+
                                        Tambahkan
                                        Alamat</button>
                                </div>
                                <div
                                    class="border-2  border-gray-300 rounded-b-lg p-2  max-h-[146px] overflow-y-auto scrollbar-hidden ">
                                    @forelse($addresses as $address)
                                        <div class="flex justify-between gap-5 p-2 border-b-2 border-gray-300">
                                            <div class="flex gap-5 w-full">
                                                <input type="radio" onchange="setAddress(event)" name="alamat"
                                                    id="alamat_{{ $address->id }}" value="{{ $address->city_id }}"
                                                    {{ $loop->first ? 'checked' : '' }}
                                                    data-addresses_id="{{ $address->id }}" />

                                                <label for="alamat_{{ $address->id }}" class="w-full">
                                                    <h6 class="text-lg text-gray-700 font-semibold">
                                                        {{ $address->mark }}
                                                        <span class="text-gray-500 font-normal">|</span>
                                                        <span
                                                            class="text-gray-700 text-sm font-medium">{{ $address->no_telepon }}</span>
                                                    </h6>
                                                    <p class="text-sm text-gray-600">
                                                        {{ $address->address }} , {{ $address->city['city_name'] }}
                                                    </p>
                                                </label>
                                            </div>

                                            <div class="icon-container">
                                                <div class="w-14 h-14 flex items-center justify-center">
                                                    <i class="fa-solid fa-map-location-dot text-3xl text-gray-600 icon-map"
                                                        data-icon-id="{{ $address->id }}"></i>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-sm text-red-500 px-3">
                                            Anda tidak memiliki alamat , mohon tamabahkan alamat anda terlebih dahulu.
                                        </p>
                                    @endforelse
                                </div>
                            </div>
                            @error('alamat')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flec-col justify-center items-center">
                            <div class="flex items-center gap-4 my-4 ">
                                <div>
                                    <h1 class="text-xl font-semibold text-gray-700">Informasi Pengiriman</h1>
                                    <p class="text-gray-600 text-sm">Berikut adalah daftar jasa kirim yang bisa anda
                                        pilih.
                                    </p>
                                </div>
                            </div>
                            <div class="my-3">
                                <label for="courier" class="text-slate-700 font-medium text-sm">Jasa Kirim</label>
                                <select onchange="setCourier(this.value)" name="courier" id="courier"
                                    class="w-full py-3 px-3 outline-none border border-gray-300 text-slate-700 rounded-lg text-sm">
                                    <option value="" selected disabled>pilih kurir</option>
                                    <option value="jne">Jalur Nugraha Ekakurir (JNE)</option>
                                    <option value="pos">POS Indonesia (POS)</option>
                                    <option value="tiki">Citra Van Titipan Kilat (TIKI)</option>
                                </select>
                            </div>
                            @error('courier')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror
                            <div id="costs" class="mb-3"></div>
                            @error('cost')
                                <p class="text-red-500 text-xs">{{ $message }}</p>
                            @enderror

                        </div>
                    </div>

                    {{-- right side --}}
                    <div class="w-1/2 flex-col justify-center items-center py-3 px-14 bg-white">
                        @php
                            $total = 0;
                        @endphp
                        @if ($carts && count($carts) > 0)
                            <div class="flec-col justify-center items-center ">
                                <div class="flex items-center gap-4 mt-2 mb-2 ">
                                    <div class="w-14 h-14 flex items-center justify-center">
                                        <i class="fa-solid fa-cart-shopping text-4xl text-gray-600"></i>

                                    </div>
                                    <div>
                                        <h1 class="text-xl font-semibold text-gray-700">Produk yang dipesan <span
                                                class="text-lg font-normal  text-gray-500"> ( {{ count($carts) }}
                                                produk)
                                            </span></h1>
                                        <p class="text-gray-600 text-sm">Berikut adalah beberapa produk yang ingin anda
                                            pesan.
                                        </p>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-4 max-h-56 overflow-y-auto scrollbar-hidden py-1">
                                    @foreach ($carts as $cart)
                                        @php
                                            $total += $cart->product->price_product * $cart->quantity;
                                        @endphp
                                        <input type="hidden" name="product_id_quantity[{{ $cart->product->id }}]"
                                            id="product_id_quantity_{{ $cart->id }}"
                                            value="{{ $cart->quantity }}">
                                        <div class="flex gap-3">
                                            <div
                                                class="w-24 h-24 border border-gray-300 bg-cover bg-center overflow-hidden flex justify-center items-center p-1 rounded-md">
                                                @if ($cart->product->image_product)
                                                    <img src="{{ asset('storage/' . $cart->product->image_product) }}"
                                                        alt="" class="object-fit">
                                                @else
                                                    <img src="{{ asset('img/laptop.jpg') }}" alt=""
                                                        class="object-fit">
                                                @endif

                                            </div>
                                            <div class="flex flex-col justify-between">
                                                <div>
                                                    <h1 class="text-md font-medium text-gray-600">
                                                        {{ $cart->product->name_product }}
                                                    </h1>
                                                    <div
                                                        class="w-24 bg-white flex border-2 border-blue-200 rounded-md mb-4">
                                                        <button type="button" class="px-2 py-1 text-slate-800"
                                                            onclick="minus('quantity_{{ $cart->id }}', '{{ $cart->product->price_product }}', 'product_id_quantity_{{ $cart->id }}')">
                                                            -
                                                        </button>
                                                        <input type="text"
                                                            class="w-10 outline-none px-2 py-1 text-center text-slate-800"
                                                            value="{{ $cart->quantity }}"
                                                            id="quantity_{{ $cart->id }}" readonly />
                                                        <button type="button" class="px-2 py-1 text-slate-800"
                                                            onclick="plus('quantity_{{ $cart->id }}', {{ $cart->product->stock_product }}, '{{ $cart->product->price_product }}', 'product_id_quantity_{{ $cart->id }}')">
                                                            +
                                                        </button>
                                                    </div>
                                                </div>
                                                <p class="text-lg font-semibold text-gray-600">
                                                    Rp. {{ number_format($cart->product->price_product, 0, ',', '.') }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="flex flex-col my-3">
                                <div class="flex items-center w-full border border-gray-300 rounded-lg p-2 ">
                                    <span
                                        class="bg-gray-300 px-2 py-1 rounded-md text-gray-700 text-sm flex items-center gap-2 ">
                                        <i class="fa-solid fa-ticket text-gray-600 text-lg text-center"></i>
                                        Kode Voucher
                                    </span>
                                    <input type="text" id="vocher"
                                        class="flex-grow px-2 py-1 text-sm outline-none bg-transparent"
                                        placeholder="Masukkan Kode (Optional)">
                                    <button class="text-blue-500 font-medium text-sm " type="button"
                                        id="checkVoucherButton" onclick="checkVoucher(this)">Pakai</button>
                                </div>
                                <p id="voucher-status" class="mt-1 "></p>
                            </div>


                            <div class=" flex justify-between items-center my-3 p-2  bg-gray-50 rounded-lg">
                                <table class="table-auto w-full ">
                                    <tr>
                                        <td class="text-sm font-medium text-gray-500 w-full">Subtotal</td>
                                        <td
                                            class="text-sm font-medium text-gray-500 text-right text-nowrap flex justify-end">
                                            Rp. <div id="subtotal"> {{ number_format($total, 0, ',', '.') }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-sm font-medium text-gray-500">Ongkos kirim</td>
                                        <td class="text-sm font-medium text-gray-500 text-right text-nowrap">
                                            <div id="ongkir-cek">+</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-sm font-medium text-gray-500">Diskon</td>
                                        <td class="text-sm font-medium text-gray-500 text-right text-nowrap">
                                            <div id="discount">-</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-base font-bold text-gray-800">Total</td>
                                        <td class="text-base font-bold text-gray-800 text-right text-nowrap flex">
                                            Rp.
                                            <div id="total">{{ number_format($total, 0, ',', '.') }}</div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <input type="hidden" name="subtotal" id="subtotal_input"
                                value="{{ $total }}" />
                            <input type="hidden" name="discount" id="discount_input" value="0" />
                            <input type="hidden" name="total" id="total_input" value="{{ $total }}" />
                            <input type="hidden" name="weight" id="weight_input" value="{{ $weight ?? 100 }}" />
                            <input type="hidden" name="order_form" id="order_form" value="cart">
                        @else
                            @php
                                $total += $product->price_product;
                            @endphp
                            <div class="flec-col justify-center items-center ">
                                <div class="flex items-center gap-4 my-6 ">
                                    <div class="w-14 h-14 flex items-center justify-center">
                                        <i class="fa-solid fa-cart-shopping text-4xl text-gray-600"></i>

                                    </div>
                                    <div>
                                        <h1 class="text-xl font-semibold text-gray-700">Produk yang dipesan <span
                                                class="text-lg font-normal  text-gray-500"> ( 1 produk )
                                            </span></h1>
                                        <p class="text-gray-600 text-sm">Berikut adalah beberapa produk yang ingin anda
                                            pesan.
                                        </p>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-4 max-h-56 overflow-y-auto scrollbar-hidden py-1">
                                    <div class="flex gap-3">
                                        <div
                                            class="w-24 h-24 border border-gray-300 bg-cover bg-center overflow-hidden flex justify-center items-center p-1 rounded-md">
                                            @if ($product->image_product)
                                                <img src="{{ asset('storage/' . $product->image_product) }}"
                                                    alt="" class="object-fit">
                                            @else
                                                <img src="{{ asset('img/laptop.jpg') }}" alt=""
                                                    class="object-fit">
                                            @endif

                                        </div>
                                        <div class="flex flex-col justify-between">
                                            <div>
                                                <h1 class="text-md font-medium text-gray-600">
                                                    {{ $product->name_product }}
                                                </h1>
                                                <div
                                                    class="w-24 bg-white flex border-2 border-blue-200 rounded-md mb-4">
                                                    <button type="button" class="px-2 py-1 text-slate-800"
                                                        onclick="minus('quantity_checkout', '{{ $product->price_product }}', 'input_quantity_checkout')">
                                                        -
                                                    </button>
                                                    <input type="text"
                                                        class="w-10 outline-none px-2 py-1 text-center text-slate-800"
                                                        value="1" id="quantity_checkout" readonly />
                                                    <button type="button" class="px-2 py-1 text-slate-800"
                                                        onclick="plus('quantity_checkout', {{ $product->stock_product }}, '{{ $product->price_product }}', 'input_quantity_checkout')">
                                                        +
                                                    </button>
                                                </div>
                                            </div>
                                            <p class="text-lg font-semibold text-gray-600">
                                                Rp. {{ number_format($product->price_product, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col my-3">
                                <div class="flex items-center w-full border border-gray-300 rounded-lg p-2 ">
                                    <span
                                        class="bg-gray-300 px-2 py-1 rounded-md text-gray-700 text-sm flex items-center gap-2 ">
                                        <i class="fa-solid fa-ticket text-gray-600 text-lg text-center"></i>
                                        Kode Voucher
                                    </span>
                                    <input type="text" id="vocher"
                                        class="flex-grow px-2 py-1 text-sm outline-none bg-transparent"
                                        placeholder="Masukkan Kode (Optional)">
                                    <button class="text-blue-500 font-medium text-sm " type="button"
                                        id="checkVoucherButton" onclick="checkVoucher(this)">Pakai</button>
                                </div>
                                <p id="voucher-status" class="mt-1 "></p>
                            </div>

                            <div class=" flex justify-between items-center my-3 p-2  bg-gray-50 rounded-lg">
                                <table class="table-auto w-full ">
                                    <tr>
                                        <td class="text-sm font-medium text-gray-500 w-full">Subtotal</td>
                                        <td
                                            class="text-sm font-medium text-gray-500 text-right text-nowrap flex justify-end">
                                            Rp. <div id="subtotal"> {{ number_format($total, 0, ',', '.') }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-sm font-medium text-gray-500">Ongkos kirim</td>
                                        <td class="text-sm font-medium text-gray-500 text-right text-nowrap">
                                            <div id="ongkir-cek">+</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-sm font-medium text-gray-500">Diskon</td>
                                        <td class="text-sm font-medium text-gray-500 text-right text-nowrap">
                                            <div id="discount">-</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-base font-bold text-gray-800">Total</td>
                                        <td class="text-base font-bold text-gray-800 text-right text-nowrap flex">
                                            Rp.
                                            <div id="total">{{ number_format($total, 0, ',', '.') }}</div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <input type="hidden" name="subtotal" id="subtotal_input"
                                value="{{ $total }}" />
                            <input type="hidden" name="discount" id="discount_input" value="0" />
                            <input type="hidden" name="total" id="total_input" value="{{ $total }}" />
                            <input type="hidden" name="weight" id="weight_input" value="{{ $weight ?? 100 }}" />
                            <input type="hidden" name="order_form" id="order_form" value="product">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity_checkout" id="input_quantity_checkout"
                                value="1">
                        @endif
                        <button type="submit" onclick="checkoutButton(event, this)"
                            class=" py-2 px-5 w-full bg-blue-600 text-white rounded-md my-2">
                            Bayar Sekarang
                        </button>

                        <div
                            class="flex items-center space-x-2 p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 rounded-md my-3">
                            <!-- Alert Icon (Font Awesome) -->
                            <i class="fas fa-exclamation-triangle w-5 h-5"></i>
                            <!-- Alert Message -->
                            <span class="text-sm font-medium">
                                Pastikan semua data terisi dengan benar. Jika ada kesalahan pengisian data, bukan
                                tanggung
                                jawab toko.
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <div id="show_add_address"
        class="hidden w-full h-screen overflow-hidden fixed top-0 right-0 left-0 bottom-0 z-20 backdrop-brightness-50 flex items-center justify-center p-5">
        <div id="address-content"
            class="relative bg-white shadow-xl w-full max-h-screen overflow-y-auto rounded-md md:w-2/5">
            <!-- Judul Modal dan Tombol Close -->
            <div class="bg-blue-600 text-white text-center py-3 rounded-t-md flex justify-center items-center">
                <h3 class="text-lg font-medium">Tambah Alamat</h3>
            </div>

            <div class="p-5 ">
                <form id="address-form" action="{{ route('user.addresses.store') }}" method="post">
                    @csrf
                    <!-- Form Inputs -->
                    <div class="flex item justify-center gap-3 my-4">
                        <div class="relative w-1/2">
                            <input type="text" name="mark" id="mark"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-700 bg-transparent rounded-lg border border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" ">
                            <label for="mark"
                                class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                                Sebagai
                            </label>
                        </div>
                        <div class="relative w-1/2">
                            <input type="number" name="no_telepon" id="no_telepon"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-700 bg-transparent rounded-lg border border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" ">
                            <label for="no_telepon"
                                class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                                Nomor Telepon
                            </label>
                        </div>
                    </div>
                    <div class="flex item justify-center gap-3 my-2">
                        <div class="relative w-1/2">
                            <label for="province_id"
                                class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                                Provinsi
                            </label>
                            <select name="province_id" id="province_id"
                                onchange="setCityProvince(this.value, 'city_area')"
                                class="w-full py-3 px-3 outline-none border border-gray-300 text-gray-700 rounded-lg text-sm focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                <option value="" selected disabled>Pilih Provinsi</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province['province_id'] }}">{{ $province['province'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div id="city_area" class="relative w-1/2">
                            <label for="city_id"
                                class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Kota</label>
                            <select name="city_id" id="city_id"
                                class="w-full py-3 px-3 outline-none border border-gray-300 text-gray-700 rounded-lg text-sm focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                disabled>
                                <option value="" selected disabled>Pilih Kota</option>
                            </select>
                            <p id="loading-message" class="text-gray-700 text-sm my-3 hidden">Loading...</p>
                        </div>
                    </div>
                    <div class="flex my-4">
                        <div class="relative w-full">
                            <label for="address"
                                class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                                Alamat
                            </label>
                            <textarea name="address" id="address" rows="5"
                                class="w-full py-3 px-3 outline-none border border-gray-300 text-gray-700 rounded-lg text-sm  focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder="Jalan 123, Kota ..., ...."></textarea>
                        </div>
                    </div>
                    <button id="submit-button" type="submit"
                        class="bg-blue-600 text-white px-5 py-2 text-sm rounded-md w-full opacity-50 cursor-not-allowed"
                        disabled>
                        Simpan Alamat
                    </button>
                </form>

            </div>
        </div>
    </div>
    @if (session('success'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                iconColor: '#3b82f6',
                title: '{{ session('success') }}', // Menampilkan pesan dari session
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                background: '#eff6ff',
            });
        </script>
    @endif
    @if (session('errors'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error', // Tetap error karena ini menampilkan kesalahan
                iconColor: '#dc2626', // Warna merah yang lebih mencolok untuk error
                title: '{{ session('errors') }}', // Menampilkan pesan dari session
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                background: '#fee2e2', // Latar belakang merah muda yang lebih soft
            });
        </script>
    @endif


    <script>
        document.getElementById("show_add_address").addEventListener("click", function(event) {
            // Jika klik di luar modal, tutup modal
            if (event.target === this) {
                document.getElementById("show_add_address").classList.add("hidden");
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('address-form');
            const submitButton = document.getElementById('submit-button');

            form.addEventListener('input', function() {
                let isFormValid = true;

                // Periksa semua input dalam form
                form.querySelectorAll('input, select, textarea').forEach(function(input) {
                    if (input.value === '' || input.disabled) {
                        isFormValid = false;
                    }
                });

                // Jika form valid, aktifkan tombol
                if (isFormValid) {
                    submitButton.disabled = false;
                    submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
                    submitButton.classList.add('bg-blue-600', 'text-white');
                } else {
                    submitButton.disabled = true;
                    submitButton.classList.remove('bg-blue-600', 'text-white');
                    submitButton.classList.add('opacity-50', 'cursor-not-allowed');
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const radios = document.querySelectorAll('input[name="alamat"]');

            function updateIcons() {
                // Reset semua ikon ke warna abu-abu
                document.querySelectorAll(".icon-map").forEach(icon => {
                    icon.classList.remove("text-blue-500");
                    icon.classList.add("text-gray-600");
                });

                // Ambil radio yang terpilih
                const checkedRadio = document.querySelector('input[name="alamat"]:checked');
                if (checkedRadio) {
                    const iconId = checkedRadio.getAttribute("data-addresses_id");
                    const icon = document.querySelector(`.icon-map[data-icon-id="${iconId}"]`);
                    if (icon) {
                        icon.classList.remove("text-gray-600");
                        icon.classList.add("text-blue-500"); // Ubah warna ikon menjadi biru
                    }
                }
            }

            // Tambahkan event listener ke setiap radio button
            radios.forEach(radio => {
                radio.addEventListener("change", updateIcons);
            });

            // Set ikon default saat halaman dimuat
            updateIcons();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showAlert(icon, message) {
            Swal.fire({
                title: "Pesan",
                text: message,
                icon: icon,
                width: 400,
                confirmButtonColor: "#334155",
                confirmButtonText: "tutup"
            });
        }
    </script>
    <script>
        let snap_token = "";
        const name_input = document.querySelector("input[name='name']");
        const email_input = document.querySelector("input[name='email']");
        const subtotal_input = document.getElementById("subtotal_input");
        const discount_input = document.getElementById("discount_input");
        const total_input = document.getElementById("total_input");
        const weight_input = document.getElementById("weight_input");
        const order_form_input = document.getElementById("order_form");
        const dropzone_file_input = document.getElementById("dropzone-file");
        const vocher_input = document.getElementById("vocher");
        const courier_input = document.getElementById("courier");
        const id_discount_input = document.getElementById('id_discount');
        const discount = document.getElementById("discount");
        const ongkir = document.getElementById("ongkir-cek");
        const sub_total = document.getElementById("subtotal");
        const total = document.getElementById("total");
        const addresses_id = document.getElementById("addresses_id");

        let courier = false
        let city_id = false
        let weight = 0;

        function ShowAddAddress() {
            const show_add_address = document.getElementById('show_add_address')
            const close_address = document.getElementById('close-address')

            show_add_address.classList.remove('hidden');
            close_address.addEventListener('click', function() {
                show_add_address.classList.add('hidden');
            })


            show_add_address.addEventListener("click", (e) => {
                if (!e.target.closest("#address-content")) {
                    show_add_address.classList.add("hidden");
                }
            });
        }



        function preview(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function() {
                const img = document.getElementById("bukti_area");
                img.src = reader.result;
                const preview = document.getElementById("bukti_area_preview");
                preview.classList.remove("hidden");
                const text_area = document.getElementById("text_area");
                text_area.classList.add("hidden");
            };

        }

        async function checkVoucher(el) {
            if (!snap_token) {
                el.disabled = true;
                const vocher = vocher_input.value;
                const total = total_input.value;
                let message = document.getElementById("voucher-status");
                message.innerHTML = `<span class="text-xs text-gray-700 font-medium">Mengecek kode voucher...</span>`;

                if (vocher.trim() === '') {
                    setTimeout(() => {
                        message.innerHTML =
                            `<span class="text-xs text-yellow-700 font-medium">Kode voucher tidak ada</span>`;
                        el.disabled = false;
                    }, 1000);
                    return;

                };

                const response = await fetch('/api/validate-promo', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        code: vocher,
                        total: total
                    })
                });
                const data = await response.json();
                if (data.status === 'success') {
                    message.innerHTML = `<span class="text-xs text-green-500 font-medium">Kode voucher tersedia</span>`;
                    id_discount_input.value = data.id;
                    discount_input.value = data.discount;
                    discount.textContent = `-Rp. ${parseInt(data.discount).toLocaleString("id-ID")}`;
                    setTotal();
                    el.disabled = false;

                } else if (data.status === 'error') {
                    message.innerHTML = `<span class="text-xs text-red-500 font-medium">${data.message}</span>`;
                    id_discount_input.value = "";
                    discount_input.value = 0;
                    discount.textContent = 0;
                    setTotal('clear');
                    el.disabled = false;

                } else {
                    message.innerHTML = `<span class="text-xs text-green-500 font-medium">Error</span>`;
                    id_discount_input.value = "";
                    discount_input.value = 0;
                    discount.textContent = 0;
                    setTotal('clear');
                    el.disabled = false;

                }
            } else {
                return false;
            }
        }


        window.addEventListener("DOMContentLoaded", function() {
            city_id = document.querySelector("input[name='alamat']:checked").value
            addresses_id.value = document.querySelector("input[name='alamat']:checked").getAttribute(
                "data-addresses_id")

            weight = weight_input.value
            setTotal();
        })


        function setTotal(clear) {
            let totalAmount = 0;
            if (clear == "clear") {
                ongkir.innerHTML = totalAmount;
            }

            // subtotal
            totalAmount += parseInt(subtotal_input.value);

            // ongkir
            const input_courier = document.querySelector("input[name='cost']:checked")
            let cek_courier = 0;
            if (input_courier) {
                cek_courier = parseInt(input_courier.value);
            }

            ongkir.innerHTML = `+ Rp. ${parseInt(cek_courier).toLocaleString("id-ID")}`;

            totalAmount += parseInt(cek_courier);

            // discount
            totalAmount -= parseInt(discount_input.value);

            // total
            total.innerHTML = totalAmount.toLocaleString("id-ID");

            // set total
            document.getElementById("total_input").value = totalAmount;
        }


        function minus(id, price, product_id_quantity = false) {
            if (!snap_token) {
                const input = document.getElementById(id);
                if (input.value > 1) {
                    const quantity = input.value = parseInt(input.value) - 1;
                    if (product_id_quantity) {
                        document.getElementById(product_id_quantity).value = quantity;
                    }

                    const sti = parseInt(subtotal_input.value) - parseInt(price);
                    subtotal_input.value = sti;
                    sub_total.textContent = sti.toLocaleString('id-ID');

                    const ti = parseInt(total_input.value) - parseInt(price);
                    total_input.value = ti;
                    total.textContent = ti.toLocaleString('id-ID');
                }
            } else {
                return false;
            }

        }

        function plus(id, max, price, product_id_quantity = false) {
            if (!snap_token) {
                const input = document.getElementById(id);
                if (input.value < max) {
                    const quantity = input.value = parseInt(input.value) + 1;
                    if (product_id_quantity) {
                        document.getElementById(product_id_quantity).value = quantity;
                    }

                    const sti = parseInt(subtotal_input.value) + parseInt(price);
                    subtotal_input.value = sti;
                    sub_total.textContent = sti.toLocaleString('id-ID');

                    const ti = parseInt(total_input.value) + parseInt(price);
                    total_input.value = ti;
                    total.textContent = ti.toLocaleString('id-ID');
                }
            } else {
                return false;
            }
        }

        function setAddress(event) {
            if (!snap_token) {
                city_id = document.querySelector("input[name='alamat']:checked").value
                addresses_id.value = document.querySelector("input[name='alamat']:checked").getAttribute(
                    "data-addresses_id")

                if (!courier) return false;
                setCity()
            } else {
                return false;
            }
        }

        function setCourier(value) {
            if (!snap_token) {
                courier = value
                setCity()
            } else {
                return false;
            }
        }

        async function setCity() {
            ongkir.innerHTML = `+ Rp. 0`;

            const costs_document = document.getElementById('costs');
            costs_document.innerHTML = `<p class="text-gray-700 font-medium text-md">Loading...</p>`;

            // Cek apakah city_id dan courier sudah ada
            if (!city_id || !courier) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian!',
                    text: 'Pastikan anda sudah memilih kota tujuan dan kurir!',
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#334155',
                    background: '#fff',
                    iconColor: '#d32f2f',
                });
                costs_document.innerHTML =
                    `<p class="text-red-600 font-medium text-md">Gagal memuat ongkir. Pastikan alamat sudah diisi.</p>`;
                return;
            }

            try {
                const response = await fetch('/api/raja-ongkir/cost', {
                    method: "POST", // Tambahkan metode POST
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        destination: city_id,
                        weight: 97,
                        courier: courier
                    })
                });

                if (!response.ok) {
                    throw new Error(`HTTP Error! Status: ${response.status}`);
                }

                const data = await response.json();

                // Cek apakah data valid
                if (!data || !data.rajaongkir || !data.rajaongkir.results.length) {
                    throw new Error("Data ongkir tidak ditemukan");
                }

                const rajaongkir = data.rajaongkir;
                const costs = rajaongkir.results[0].costs;

                let elementChild =
                    '<label for="courier" class="text-gray-700 font-medium text-sm">Layanan Jasa Kirim</label><div class="w-full border border-gray-300 rounded-lg overflow-hidden">';

                costs.forEach(cost => {
                    elementChild += `<div class="flex gap-5 border-b-2 py-2 px-3 items-center">
                <input onchange="setService('${cost.service}')" type="radio" name="cost" id="courier_${cost.service}" value="${cost.cost[0].value}" data-service="${cost.service}" />
                <label for="courier_${cost.service}" class="w-full flex items-center gap-3">
                    <i class="fa-solid fa-truck text-3xl text-gray-600 icon-service" data-icon-id="${cost.service}"></i>
                    <div>
                        <h6 class="text-md text-gray-700 font-semibold">${cost.service}</h6>
                        <p class="text-sm text-gray-600 mb-3">${cost.description}</p>
                        <p class="text-lg font-medium text-gray-800">Rp. ${(cost.cost[0].value).toLocaleString("id-ID")}</p>
                    </div>
                </label>
            </div>`;
                });

                elementChild += '</div>';
                costs_document.innerHTML = elementChild;

                // Tambahkan event listener setelah elemen di-render
                document.querySelectorAll('input[name="cost"]').forEach(radio => {
                    radio.addEventListener("change", updateServiceIcons);
                });

                updateServiceIcons(); // Set ikon default

            } catch (error) {
                console.error("Error saat mengambil data ongkir:", error);
                costs_document.innerHTML =
                    `<p class="text-red-600 font-medium text-md">Gagal memuat ongkir. Coba lagi nanti.</p>`;
            }
        }


        // Fungsi untuk mengubah warna ikon saat radio button dipilih
        function updateServiceIcons() {
            document.querySelectorAll(".icon-service").forEach(icon => {
                icon.classList.remove("text-blue-500");
                icon.classList.add("text-gray-600");
            });

            const checkedRadio = document.querySelector('input[name="cost"]:checked');
            if (checkedRadio) {
                const iconId = checkedRadio.getAttribute("data-service");
                const icon = document.querySelector(`.icon-service[data-icon-id="${iconId}"]`);
                if (icon) {
                    icon.classList.remove("text-gray-600");
                    icon.classList.add("text-blue-500"); // Ubah warna ikon menjadi biru
                }
            }
        }

        function setService(value) {
            if (snap_token) return false;
            document.getElementById('service').value = value
            setTotal()
        }


        async function setCityProvince(province_id, area) {
            // Get reference to the existing city select element
            const citySelect = document.getElementById('city_id');

            // Show loading state in options
            citySelect.innerHTML = '<option value="" disabled selected>Loading...</option>';
            citySelect.disabled = true;

            try {
                // Fetch cities data
                const response = await fetch('/api/raja-ongkir/city?province_id=' + province_id, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });

                const data = await response.json();

                if (data) {
                    // Reset select with placeholder
                    citySelect.innerHTML = '<option value="" disabled selected>Pilih Kota</option>';

                    // Add new city options
                    Object.values(data).forEach(city => {
                        const option = new Option(city.city_name, city.city_id);
                        citySelect.add(option);
                    });

                    // Enable the select element
                    citySelect.disabled = false;
                } else {
                    citySelect.innerHTML = '<option value="" disabled selected>Error: Gagal memuat data</option>';
                }
            } catch (error) {
                console.error('Error fetching cities:', error);
                citySelect.innerHTML = '<option value="" disabled selected>Error: Gagal memuat data</option>';
            }
        }
    </script>


    <script type="text/javascript">
        async function checkoutButton(event, el) {
            event.preventDefault();
            const form = event.target.closest('form');
            // form.submit();
            const alamat = document.querySelector("input[name='alamat']:checked");
            const cost = document.querySelector("input[name='cost']:checked"); // Sesuaikan jika berbeda
            const name = document.querySelector("input[name='name']");
            const email = document.querySelector("input[name='email']");
            const total = document.querySelector("input[name='total']");
            const subtotal = document.querySelector("input[name='subtotal']");
            const addresses_id = document.querySelector("input[name='addresses_id']");
            const courier = document.getElementById('courier');
            // const dropzone_file = document.getElementById('dropzone-file');

            el.disabled = true;
            el.textContent = 'Loading...';


            if (
                (!alamat || !alamat.value) ||
                (!cost || !cost.value) ||
                (!name || !name.value) ||
                (!email || !email.value) ||
                (!courier || !courier.value) ||
                (!total || !total.value) ||
                (!subtotal || !subtotal.value) ||
                (!addresses_id || !addresses_id.value)
            ) {
                console.log('error');
                form.submit();
                return false;
            }

            // console.log('tes')

            if (!snap_token) {

                const formData = new FormData(form);
                // Ubah FormData langsung menjadi objekconst formData = new FormData(form);
                const dataInputan = {};
                @if ($carts && count($carts) > 0)

                    const productIdQuantity = {};
                    formData.forEach((value, key) => {
                        if (key.startsWith('product_id_quantity[')) {
                            // Ambil ID produk dari nama input seperti 'product_id_quantity[1]'
                            const productId = key.match(/\[([^\]]+)]/)[1];
                            productIdQuantity[productId] = value;
                        } else {
                            dataInputan[key] = value; // Tambahkan key lain selain product_id_quantity
                        }
                    });

                    dataInputan.product_id_quantity = productIdQuantity;
                @else
                    formData.forEach((value, key) => {
                        if (key.endsWith('[]')) {
                            const normalizedKey = key.slice(0, -2); // Hapus '[]'
                            if (!dataInputan[normalizedKey]) {
                                dataInputan[normalizedKey] = [];
                            }
                            dataInputan[normalizedKey].push(value);
                        } else {
                            dataInputan[key] = value;
                        }
                    });
                @endif


                try {
                    const response = await fetch('/checkout', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify(dataInputan)
                    });
                    const data = await response.json();
                    console.log(data)
                    if (data.status == 'success') {
                        snap_token = data.snap_token;

                        snap.pay(snap_token, {
                            onSuccess: function(result) {
                                // Tangani jika pembayaran success
                                showAlert('success', 'Pembayaran berhasil!')
                                // console.log(result)
                                const order_id = result.order_id
                                @if (config('app.debug'))
                                    window.location.href = "{{ route('user.orders.index') }}";
                                @else
                                    if (order_id) {
                                        window.location.href = "{{ route('user.orders.show', '') }}/" +
                                            order_id;
                                    } else {
                                        window.location.href = "{{ route('user.orders.index') }}";
                                    }
                                @endif
                            },
                            onPending: function(result) {
                                // Tangani jika pembayaran pending
                                showAlert('warning', 'Pembayaran sedang dalam proses!')
                                // console.log(result)
                                const order_id = result.order_id
                                @if (config('app.debug'))
                                    window.location.href = "{{ route('user.orders.index') }}";
                                @else
                                    if (order_id) {
                                        window.location.href = "{{ route('user.orders.show', '') }}/" +
                                            order_id;
                                    } else {
                                        window.location.href = "{{ route('user.orders.index') }}";
                                    }
                                @endif
                            },
                            onError: function(result) {
                                // Tangani jika pembayaran gagal
                                showAlert('error', 'Pembayaran gagal!')
                                // console.log(result)
                                const order_id = result.order_id
                                @if (config('app.debug'))
                                    window.location.href = "{{ route('user.orders.index') }}";
                                @else
                                    if (order_id) {
                                        window.location.href = "{{ route('user.orders.show', '') }}/" +
                                            order_id;
                                    } else {
                                        window.location.href = "{{ route('user.orders.index') }}";
                                    }
                                @endif
                            }
                        });
                    } else {
                        return false;
                    }
                } catch (e) {
                    console.log(e)

                }
            } else {
                snap.pay(snap_token)
                name.disabled = true;
                email.disabled = true;
                courier.disabled = true;
                vocher_input.disabled = true;
                document.querySelectorAll("input[name='alamat']").forEach(input => {
                    input.disabled = true;
                });
                document.querySelectorAll("input[name='cost']").forEach(input => {
                    input.disabled = true;
                });
                document.getElementById("tambah_alamat").disabled = true;
                document.getElementById("checkVoucherButton").disabled = true;
                cost.disabled = true
            }


            el.disabled = false;
            el.textContent = "Pay Now";

        }
    </script>

</body>

</html>
