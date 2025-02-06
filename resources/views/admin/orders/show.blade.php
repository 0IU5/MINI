@extends('layouts.admin')

@section('main')
    {{-- <style>
        * {
            border: 1px solid black;
        }
    </style> --}}
    <div class="container-fluid">
        <div class="container p-6">
            <div class="w-full">

                <div class="bg-white p-4 rounded-lg shadow-sm border mb-3">
                    <!-- Judul -->
                    <div class=" flex justify-between items-center p-2 ">
                        <div class="flex items-center justify-center gap-2">
                            <h1 class="text-2xl font-bold text-center">Detail Pesanan</h1>
                            <span class="text-lg font-normal text-gray-500 text-center">({{ $order->order_code ?? 'kosong' }})</span>
                        </div>

                        <div class="flex items-center justify-center text-center gap-2 ">
                            <span class="text-md font-semibold">{{ $order->created_at->translatedFormat('d F Y') }}</span>
                            <div class="h-[25px] w-[2px] bg-gray-300"></div> <!-- Garis Vertikal -->
                            <span
                                class="px-3 py-1 rounded-full text-sm font-semibold
                                    @if ($order->status_order === 'completed') bg-green-200 text-green-600
                                    @elseif ($order->status_order === 'processing')
                                        bg-yellow-200 text-yellow-600
                                    @elseif ($order->status_order === 'pending')
                                        bg-blue-200 text-blue-600
                                    @else
                                        bg-gray-200 text-gray-600 @endif">
                                {{ ucfirst($order->status_order_label) }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                    <!-- Baris Pertama: 3 Card -->
                    <div class="col-span-1 md:col-span-4 flex flex-col gap-4">
                        <!-- Card Alamat Pengiriman -->
                        <div class="card p-6 border rounded-lg shadow-md bg-blue-100 flex-1">
                            <div class="flex items-center mb-4">
                                <!-- Ikon Font Awesome dengan latar belakang putih -->
                                <div
                                    class="bg-white border flex items-center justify-center rounded-lg w-10 h-10 shadow-md">
                                    <i class="fas fa-map-marker-alt text-blue-500 text-lg"></i>
                                </div>
                                <h3 class="font-semibold text-xl text-blue-700 ml-3">Alamat Pengiriman</h3>
                            </div>
                            <div class="flex gap-2 ml-3 text-lg">
                                <span class="font-medium">{{ $order->user->name }}</span>
                                <div class="h-[25px] w-[2px] bg-gray-300"></div>
                                <span>{{ $order->addresses->no_telepon }}</span>
                            </div>
                            <div class="mb-2 ml-3 text-base">
                                <span>{{ ucwords($order->addresses->address) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-1 md:col-span-4 flex flex-col gap-4">
                        <!-- Card Jasa Pengiriman -->
                        <div class="card p-6 border rounded-lg shadow-md bg-blue-100 flex-1">
                            <div class="flex items-center mb-4">
                                <!-- Ikon Font Awesome dengan latar belakang putih -->
                                <div
                                    class="bg-white border flex items-center justify-center rounded-lg w-10 h-10 shadow-md">
                                    <i class="fas fa-shipping-fast text-blue-500 text-lg"></i>
                                </div>
                                <h3 class="font-semibold text-xl text-blue-700 ml-3">Jasa Pengiriman</h3>
                            </div>
                            <div class="mb-2 ml-3 text-lg font-medium">
                                <span>{{ strtoupper($order->postage->code) }}</span> <!-- Nama jasa pengiriman -->
                            </div>
                            <div class="mb-2 ml-3 text-base">
                                <span>{{ ucwords($order->postage->service) }}</span> <!-- Paket layanan -->
                            </div>
                        </div>
                    </div>

                    <div class="col-span-1 md:col-span-4 flex flex-col gap-4">
                        <!-- Card Metode Pembayaran -->
                        <div class="card p-6 border rounded-lg shadow-md bg-blue-100 flex-1">
                            <div class="flex items-center mb-4">
                                <!-- Wrapper untuk icon -->
                                <div
                                    class="bg-white border flex items-center justify-center rounded-lg w-10 h-10 shadow-md">
                                    <!-- Icon menggunakan Font Awesome -->
                                    <i class="fas fa-credit-card text-blue-500 text-lg"></i>
                                </div>
                                <h3 class="font-semibold text-xl text-blue-700 ml-3">Metode Pembayaran</h3>
                            </div>
                            <div class="mb-2 ml-3 text-lg font-medium">
                                <span>{{ ucwords(str_replace('_', ' ', $order->payment->payment_method)) }}</span>
                            </div>
                            <div class="mb-2 ml-3">
                                <span
                                    class="px-3 py-1 rounded-full text-sm font-semibold
                                        @if ($order->payment->status === 'success') bg-green-200 text-green-600
                                        @elseif ($order->payment->status === 'pending')
                                            bg-blue-200 text-blue-600
                                        @elseif ($order->payment->status === 'failed')
                                            bg-red-200 text-red-600
                                        @elseif ($order->payment->status === 'expired')
                                            bg-gray-200 text-gray-600
                                        @else
                                            bg-gray-200 text-gray-600 @endif">
                                    {{ ucfirst($order->payment->status) }}
                                </span>
                            </div>
                        </div>
                    </div>


                    <!-- Baris Kedua: Produk yang Dipesan dan Total Harga -->
                    <div class="col-span-1 md:col-span-8 flex flex-col gap-6">
                        <!-- Produk yang Dipesan -->
                        <div class="card p-6 border rounded-lg shadow-md bg-white">
                            <h3 class="font-semibold text-lg mb-3 bg-blue-500 text-white p-2 rounded-md">Produk yang dipesan</h3>

                            <!-- Grid untuk menampilkan produk per dua kolom -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach ($order->productOrders as $productOrder)
                                    <div class="flex items-center justify-start gap-1 mx-2">
                                        <!-- Cek jika ada gambar produk -->
                                        @if ($productOrder->product->image_product)
                                            <img class="w-12 h-12 object-cover mr-4"
                                                src="{{ asset('storage/' . $productOrder->product->image_product) }}"
                                                alt="{{ $productOrder->product->name_product }}">
                                        @else
                                            <img class="w-12 h-12 object-cover mr-4" src="{{ asset('img/laptop.jpg') }}"
                                                alt="Gambar Default">
                                        @endif
                                        <div class="flex flex-col">
                                            <span>{{ $productOrder->product->name_product }}</span>
                                            <span class="text-xs text-slate-700">x{{ $productOrder->quantity }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


                    <div class="col-span-1 md:col-span-4 flex flex-col gap-6">
                        <!-- Total Harga -->
                        <div class="card p-6 border rounded-lg shadow-md bg-white">
                            <h3 class="font-semibold text-lg mb-3 bg-blue-500 text-white p-2 rounded-md">Total Harga</h3>
                            <table class="min-w-full table-auto">
                                <tbody>
                                    <tr class="py-1">
                                        <td class="px-1 py-2">Sub Total</td>
                                        <td class="px-1 py-2">:</td>
                                        <td class="px-1 py-2">Rp. {{ number_format($order->sub_total_amount, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr class="py-1">
                                        <td class="px-1 py-2">Ongkos Kirim </td>
                                        <td class="px-1 py-2">:</td>
                                        <td class="px-1 py-2">Rp. {{ number_format($order->postage->ongkir_total_amount, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr class="py-1">
                                        <td class="px-1 py-2">Diskon</td>
                                        <td class="px-1 py-2">:</td>
                                        <td class="px-1 py-2">- Rp.
                                            {{ $order->promoCode?->discount_amount ? number_format($order->promoCode->discount_amount, 0, ',', '.') : '' }}
                                        </td>
                                    </tr>
                                    <tr class="py-1">
                                        <td class="px-1 py-2">Total</td>
                                        <td class="px-1 py-2">:</td>
                                        <td class="px-1 py-2">Rp. {{ number_format($order->grand_total_amount, 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
