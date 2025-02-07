@extends('layouts.guest')
@section('content')
    <style>
        * {
            /* border : 1px solid black; */
        }
    </style>
    <div class="container-fluid mx-5 my-4">
        <div class="flex justify-between bg-white border rounded-lg py-4 px-10 ">
            <div class="flex">
                <a href="{{ route('user.orders.index') }}">
                    < Kembali </a>
            </div>

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

        <div class="max-w-full mx-auto bg-white border rounded-lg py-4 px-10 ">
            <!-- Desktop Version (hidden on mobile) -->
            <div class="hidden md:flex md:flex-row items-center justify-between relative">
                <!-- Progress Line for Desktop -->
                <div class="hidden md:block absolute left-0 right-0 top-1/2 h-0.5 bg-gray-200 -translate-y-1/2 ">
                    <div
                        class="h-[3px]
                        @if ($order->status_order == 'pending') w-[45%] bg-blue-500
                        @elseif($order->status_order == 'processing')
                            w-[65%] bg-blue-500
                        @elseif($order->status_order == 'shipping')
                            w-[85%] bg-blue-500
                        @elseif($order->status_order == 'completed')
                            w-full bg-blue-500 @endif
                    ">
                    </div>
                </div>

                <!-- Step 1: Pesanan Dibuat -->
                <div class="flex flex-col items-center relative mb-8 md:mb-0">
                    <div class="md:hidden absolute h-full w-0.5 bg-green-500 top-10 left-1/2 -translate-x-1/2"></div>
                    <div
                        class="w-12 h-12 rounded-full flex items-center justify-center z-10 border-[3px]
                        @if (
                            $order->status_order == 'pending' ||
                                $order->status_order == 'processing' ||
                                $order->status_order == 'shipping' ||
                                $order->status_order == 'completed') border-blue-500 text-blue-500
                        @else
                            border-gray-300 text-gray-300 @endif
                        mb-3">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="text-center mt-2">
                        <h4 class="text-sm font-medium">Pesanan Dibuat</h4>
                        <p class="text-xs text-gray-500 mt-1">

                            {{ $order->created_at ? \Carbon\Carbon::parse($order->created_at)->timezone('Asia/Jakarta')->translatedFormat('d-m-Y H:i') : '-' }}
                        </p>
                    </div>
                </div>

                <!-- Step 2: Menunggu Konfirmasi -->
                <div class="flex flex-col items-center relative mb-8 md:mb-0">
                    <div class="md:hidden absolute h-full w-0.5 bg-green-500 top-10 left-1/2 -translate-x-1/2"></div>
                    <div
                        class="w-12 h-12 rounded-full flex items-center justify-center z-10 border-[3px]
                        @if (
                            $order->status_order == 'pending' ||
                                $order->status_order == 'processing' ||
                                $order->status_order == 'shipping' ||
                                $order->status_order == 'completed') border-blue-500 text-blue-500
                        @else
                            border-gray-300 text-gray-300 @endif
                        mb-3">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div class="text-center mt-2">
                        <h4 class="text-sm font-medium">Menunggu Konfirmasi</h4>
                        <p class="text-xs text-gray-500 mt-1">

                            {{ $order->created_at ? \Carbon\Carbon::parse($order->created_at)->timezone('Asia/Jakarta')->translatedFormat('d-m-Y H:i') : '-' }}

                        </p>
                    </div>
                </div>

                <!-- Step 3: Dikemas -->
                <div class="flex flex-col items-center relative mb-8 md:mb-0">
                    <div class="md:hidden absolute h-full w-0.5 bg-green-500 top-10 left-1/2 -translate-x-1/2"></div>
                    <div
                        class="w-12 h-12 rounded-full flex items-center justify-center z-10 border-[3px]
                        @if ($order->status_order == 'processing' || $order->status_order == 'shipping' || $order->status_order == 'completed') border-blue-500 text-blue-500
                        @else
                            border-gray-300 text-gray-300 @endif
                        mb-3">
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="text-center mt-2">
                        <h4 class="text-sm font-medium">Dikemas</h4>
                        <p class="text-xs text-gray-500 mt-1">

                            {{ $order->processing_at ? \Carbon\Carbon::parse($order->processing_at)->timezone('Asia/Jakarta')->translatedFormat('d-m-Y H:i') : '-' }}

                        </p>
                    </div>
                </div>

                <!-- Step 4: Dikirim -->
                <div class="flex flex-col items-center relative mb-8 md:mb-0">
                    <div class="md:hidden absolute h-full w-0.5 bg-green-500 top-10 left-1/2 -translate-x-1/2"></div>
                    <div
                        class="w-12 h-12 rounded-full flex items-center justify-center z-10 border-[3px]
                        @if ($order->status_order == 'shipping' || $order->status_order == 'completed') border-blue-500 text-blue-500
                        @else
                            border-gray-300 text-gray-300 @endif
                        mb-3">
                        <i class="fas fa-truck"></i>
                    </div>
                    <div class="text-center mt-2">
                        <h4 class="text-sm font-medium">Dikirim</h4>
                        <p class="text-xs text-gray-500 mt-1">

                            {{ $order->shipping_at ? \Carbon\Carbon::parse($order->shipping_at)->timezone('Asia/Jakarta')->translatedFormat('d-m-Y H:i') : '-' }}

                        </p>
                    </div>
                </div>

                <!-- Step 5: Pesanan Selesai -->
                <div class="flex flex-col items-center relative mb-8 md:mb-0">
                    <div class="md:hidden absolute h-full w-0.5 bg-green-500 top-10 left-1/2 -translate-x-1/2"></div>
                    <div
                        class="w-12 h-12 rounded-full flex items-center justify-center z-10 border-[3px]
                        @if ($order->status_order == 'completed') border-blue-500 text-blue-500
                        @else
                            border-gray-300 text-gray-300 @endif
                        mb-3">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="text-center mt-2">
                        <h4 class="text-sm font-medium">Pesanan Selesai</h4>
                        <p class="text-xs text-gray-500 mt-1">

                            {{ $order->completed_at ? \Carbon\Carbon::parse($order->completed_at)->timezone('Asia/Jakarta')->translatedFormat('d-m-Y H:i') : '-' }}

                        </p>
                    </div>
                </div>
            </div>

            <!-- Mobile Version (hidden on desktop) -->
            <div class="md:hidden relative">
                <!-- Vertical line -->
                <div class="absolute left-6 top-6 bottom-0 w-[3px] bg-gray-200">
                    <!-- Dynamic progress line -->
                    <div
                        class="w-full bg-blue-500
                        @if ($order->status_order == 'pending') h-[30%]
                        @elseif($order->status_order == 'processing') h-[50%]
                        @elseif($order->status_order == 'shipping') h-[75%]
                        @elseif($order->status_order == 'completed') h-full @endif">
                    </div>
                </div>

                <!-- Timeline items -->
                <div class="space-y-8">
                    <!-- Pesanan Dibuat -->
                    <div class="relative flex items-center gap-4">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full border-[3px] bg-gray-100
                    @if (
                        $order->status_order == 'pending' ||
                            $order->status_order == 'processing' ||
                            $order->status_order == 'shipping' ||
                            $order->status_order == 'completed') border-blue-500 text-blue-500
                    @else
                    border-gray-300 text-gray-300 @endif">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="text-black font-medium">Pesanan Dibuat</h3>
                            <p class="text-slate-400 text-sm">

                                {{ $order->created_at ? \Carbon\Carbon::parse($order->created_at)->timezone('Asia/Jakarta')->translatedFormat('d-m-Y H:i') : '-' }}

                            </p>
                        </div>
                    </div>

                    <!-- Menunggu Konfirmasi -->
                    <div class="relative flex items-center gap-4">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full border-[3px] bg-gray-100
                @if (
                    $order->status_order == 'pending' ||
                        $order->status_order == 'processing' ||
                        $order->status_order == 'shipping' ||
                        $order->status_order == 'completed') border-blue-500 text-blue-500
                @else
                    border-gray-300 text-gray-300 @endif">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="text-black font-medium">Menunggu Konfirmasi</h3>
                            <p class="text-slate-400 text-sm">

                                {{ $order->created_at ? \Carbon\Carbon::parse($order->created_at)->timezone('Asia/Jakarta')->translatedFormat('d-m-Y H:i') : '-' }}

                            </p>
                        </div>
                    </div>

                    <!-- Dikemas -->
                    <div class="relative flex items-center gap-4">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full border-[3px] bg-gray-100
                @if ($order->status_order == 'processing' || $order->status_order == 'shipping' || $order->status_order == 'completed') border-blue-500 text-blue-500
                @else
                    border-gray-300 text-gray-300 @endif">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="text-black font-medium">Dikemas</h3>
                            <p class="text-slate-400 text-sm">

                                {{ $order->processing_at ? \Carbon\Carbon::parse($order->processing_at)->timezone('Asia/Jakarta')->translatedFormat('d-m-Y H:i') : '-' }}

                            </p>
                        </div>
                    </div>

                    <!-- Dikirim -->
                    <div class="relative flex items-center gap-4">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full border-[3px] bg-gray-100
                @if ($order->status_order == 'shipping' || $order->status_order == 'completed') border-blue-500 text-blue-500
                @else
                    border-gray-300 text-gray-300 @endif">
                            <i class="fas fa-truck"></i>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="text-black font-medium">Dikirim</h3>
                            <p class="text-slate-400 text-sm">

                                {{ $order->shipping_at ? \Carbon\Carbon::parse($order->shipping_at)->timezone('Asia/Jakarta')->translatedFormat('d-m-Y H:i') : '-' }}

                            </p>
                        </div>
                    </div>

                    <!-- Pesanan Selesai -->
                    <div class="relative flex items-center gap-4">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full border-[3px] bg-gray-100
                @if ($order->status_order == 'completed') border-blue-500 text-blue-500
                @else
                    border-gray-300 text-gray-300 @endif">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="text-black font-medium">Pesanan Selesai</h3>
                            <p class="text-slate-400 text-sm">

                                {{ $order->completed_at ? \Carbon\Carbon::parse($order->completed_at)->timezone('Asia/Jakarta')->translatedFormat('d-m-Y H:i') : '-' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            <!-- Pembungkus 1 (66% lebar) -->
            <div class="md:col-span-2 grid gap-4">
                <!-- Baris pertama dengan 2 card yang responsif -->
                <div class="grid grid-cols-1 gap-4 md:grid-cols-1 lg:grid-cols-2">
                    <!-- Card 1: Data Alamat -->
                    <div class="bg-white border border-gray-300 rounded-lg p-4 flex flex-col gap-6">
                        <!-- Informasi -->
                        <div class="flex items-center gap-4">
                            <div class="flex items-center justify-center w-12 h-12 border border-blue-500 rounded-md">
                                <i class="fas fa-user text-blue-500 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-gray-800 font-semibold">Informasi</h3>
                                <p class="text-gray-600">
                                    {{ $order->user->name }},
                                    <span>{{ $order->addresses->no_telepon }}</span>
                                </p>
                            </div>
                        </div>
                        <!-- Alamat -->
                        <div class="flex items-center gap-4">
                            <div class="flex items-center justify-center w-12 h-12 border border-blue-500 rounded-md">
                                <i class="fas fa-map-marker-alt text-blue-500 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-gray-800 font-semibold">Alamat</h3>
                                <p class="text-gray-600">
                                    {{ $order->addresses->mark }},
                                    <span>{{ $order->addresses->address }}</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Metode Pembayaran dan Jasa Kurir -->
                    <div class="bg-white border border-gray-300 rounded-lg p-4 flex flex-col gap-6">
                        <!-- Metode Pembayaran -->
                        <div class="flex items-center gap-4">
                            <div class="flex items-center justify-center w-12 h-12 border border-blue-500 rounded-md">
                                <i class="fas fa-credit-card text-blue-500 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-gray-800 font-semibold">Metode Pembayaran</h3>
                                <p class="text-gray-600">
                                    {{ ucwords(str_replace('_', ' ', $order->payment->payment_method)) }},
                                    <span
                                        class="py-1 rounded-full text-sm font-semibold
                                    @if ($order->payment->status === 'success') text-green-600
                                    @elseif ($order->payment->status === 'pending') text-blue-600
                                    @elseif ($order->payment->status === 'failed') text-red-600
                                    @elseif ($order->payment->status === 'expired') text-gray-600
                                    @else text-gray-600 @endif">
                                        {{ ucfirst($order->payment->status) }}
                                    </span>
                                </p>
                            </div>
                        </div>
                        <!-- Jasa Kurir -->
                        <div class="flex items-center gap-4">
                            <div class="flex items-center justify-center w-12 h-12 border border-blue-500 rounded-md">
                                <i class="fas fa-truck text-blue-500 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-gray-800 font-semibold">Jasa Kirim</h3>
                                <p class="text-gray-600">
                                    {{ strtoupper($order->postage->code) }},
                                    <span>{{ ucwords($order->postage->service) }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Baris kedua dengan 1 card 3 : Data Produk -->

                <div class="bg-white border border-gray-300 rounded-lg p-4">
                    <h3 class="font-semibold text-lg mb-4 bg-blue-500 text-white p-3 rounded-md">Produk yang dipesan ({{ $order->order_code ?? 'kosong' }})</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach ($order->productOrders as $productOrder)
                            <div class="flex items-center justify-start gap-1 mx-2">
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
                                    <div class="flex">
                                        <!-- Tombol Ulasan -->
                                        @if ($order->status_order === 'completed')
                                            @php
                                                $hasReview = $productOrder->product
                                                    ->reviews()
                                                    ->where('order_id', $order->id)
                                                    ->exists();
                                            @endphp

                                            @if (!$hasReview)
                                                <button
                                                    class="btn btn-primary mt-2 bg-blue-500 text-white py-1 px-2 rounded-md text-xs"
                                                    onclick="openModal('{{ $order->id }}', '{{ $productOrder->product->id }}')">
                                                    Berikan Ulasan
                                                </button>
                                            @else
                                                <p class="mt-2 text-green-500 text-sm">Ulasan telah ditambahkan.</p>
                                            @endif
                                        @endif
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>



            <!-- Pembungkus 2 (33% lebar) -->
            <div class="grid grid-cols-1 gap-4 ">
                <!-- Card 4: Data Penghitungan Harga -->
                <div class="p-3 border rounded-lg border-gray-300 bg-white">
                    <h3 class="font-semibold text-lg mb-4 bg-blue-500 text-white p-3 rounded-md">Total Harga</h3>
                    <table class="min-w-full table-auto border-collapse">
                        <tbody>
                            <tr class="border-b">
                                <td class="px-3 py-2 text-gray-700">Sub Total</td>
                                <td class="px-3 py-2 text-gray-700">:</td>
                                <td class="px-3 py-2 text-gray-800">Rp.
                                    {{ number_format($order->sub_total_amount, 0, ',', '.') }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-3 py-2 text-gray-700">Ongkos Kirim</td>
                                <td class="px-3 py-2 text-gray-700">:</td>
                                <td class="px-3 py-2 text-gray-800">Rp.
                                    {{ number_format($order->postage->ongkir_total_amount, 0, ',', '.') }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-3 py-2 text-gray-700">Diskon</td>
                                <td class="px-3 py-2 text-gray-700">:</td>
                                <td class="px-3 py-2 text-gray-800">- Rp.
                                    {{ $order->promoCode?->discount_amount ? number_format($order->promoCode->discount_amount, 0, ',', '.') : '0' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="px-3 py-2 text-gray-700 font-semibold">Total</td>
                                <td class="px-3 py-2 text-gray-700 font-semibold">:</td>
                                <td class="px-3 py-2 text-gray-800 font-semibold">Rp.
                                    {{ number_format($order->grand_total_amount, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Button Pesanan Selesai -->
                <div class="flex flex-col justify-between items-center md:flex">
                    @if ($order->status_order === 'shipping')
                        <div class="flex w-full">
                            <form method="POST" action="{{ route('user.order.updateStatus', $order->id) }}"
                                class="w-full">
                                @csrf
                                <input type="hidden" name="status" value="completed">

                                @if ($order->status_order == 'shipping')
                                    <button type="submit"
                                        class="w-full text-center px-6 py-2 border-2 border-blue-500 text-blue-500 rounded-md hover:bg-blue-500 hover:text-white transition duration-300 ease-in-out"
                                        onclick="confirmStatusUpdate(event, 'selesai')">
                                        Pesanan Selesai
                                    </button>
                                @endif
                            </form>
                        </div>
                    @endif
                    <div class="w-full flex items-center justify-center gap-2">
                        @if ($order->status_order === 'completed')
                            <a href="{{ route('user.orders.download-invoice', $order->id) }}"
                                class="w-full text-center px-6 py-2 border-2 border-blue-500 text-blue-500 rounded-md hover:bg-blue-500 hover:text-white transition duration-300 ease-in-out ">
                                <i class="fas fa-download"></i>
                                Unduh Invoice
                            </a>
                        @endif
                    </div>

                    <div class="w-full">
                        @if ($order->payment->status == 'pending')
                            <button id="pay-button"
                                class="w-full text-center px-6 py-2 border-2 border-blue-500 text-blue-500 rounded-md hover:bg-blue-500 hover:text-white transition duration-300 ease-in-out">Bayar
                                Sekarang</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="createReviewModal"
        class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 {{ $errors->any() ? 'flex' : 'hidden' }} z-50">
        <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6">
            <div class="modal-header flex justify-between items-center mb-4">
                <h5 class="text-lg font-semibold">Buat Ulasan</h5>
                <button type="button" class="text-gray-500 text-xl" onclick="closeModal()">&times;</button>
            </div>
            <form id="createReviewForm" method="POST" action="{{ route('user.orders.addRiview') }}">
                @csrf
                <input type="hidden" name="order_id" id="order_id" value="{{ old('order_id') }}">
                <input type="hidden" name="product_id" id="product_id" value="{{ old('product_id') }}">

                <!-- Rating -->
                <div class="mb-5 flex gap-1" id="star-rating">
                    @for ($i = 1; $i <= 5; $i++)
                        <label for="star_{{ $i }}" class="cursor-pointer">
                            <input type="radio" name="rating" id="star_{{ $i }}" value="{{ $i }}"
                                class="hidden" required {{ old('rating') == $i ? 'checked' : '' }} />
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                class="w-5 h-5 star-icon transition-all duration-200 cursor-pointer
                                {{ old('rating') >= $i ? 'text-yellow-500' : 'text-gray-300' }}"
                                data-star="{{ $i }}" viewBox="0 0 24 24" stroke="none">
                                <path d="M12 17.75l-6.16 3.24a1 1 0 0 1-1.45-1.05l1.17-7.23L1.31 8.7a1 1 0 0 1 .56-1.72l7.29-.61L12 .25l3.03 6.12 7.29.61a1 1 0 0 1 .56 1.72l-4.74 4.24 1.17 7.23a1 1 0 0 1-1.45 1.05L12 17.75z"></path>
                            </svg>
                        </label>
                    @endfor
                    @error('rating')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Komentar -->
                <div class="mb-4">
                    <label for="comment" class="block text-sm font-medium text-gray-700">Komentar</label>
                    <textarea name="comment" id="comment" rows="3"
                        class="form-control mt-1 block w-full border border-gray-300 rounded-md p-2">{{ old('comment') }}</textarea>
                    @error('comment')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <div class="modal-footer flex justify-end gap-2">
                    <button type="button" class="bg-gray-300 text-black py-2 px-4 rounded-md"
                        onclick="closeModal()">Batal</button>
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md">Kirim</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Pastikan modal tetap terbuka jika ada error
        window.onload = function() {
            @if ($errors->any())
                document.getElementById('createReviewModal').classList.remove('hidden');
            @endif
        };
    </script>


    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ $clientKey }}"></script>

    <script>
        document.getElementById('pay-button').addEventListener('click', function() {
            snap.pay("{{ $order->snap_token }}", {
                onSuccess: function(result) {
                    // Redirect ke halaman detail order setelah sukses
                    window.location.href = "{{ route('user.orders.show', $order->id) }}";
                },
                onPending: function(result) {
                    alert("Pembayaran sedang diproses!");
                },
                onError: function(result) {
                    alert("Pembayaran gagal! Silakan coba lagi.");
                }
            });
        });
    </script>


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
        // Fungsi untuk membuka modal
        function openModal(orderId, productId) {
            document.getElementById('order_id').value = orderId;
            document.getElementById('product_id').value = productId;
            document.getElementById('createReviewModal').classList.remove('hidden');
        }

        // Fungsi untuk menutup modal
        function closeModal() {
            document.getElementById('createReviewModal').classList.add('hidden');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        // Fungsi konfirmasi untuk update status
        function confirmStatusUpdate(event, status) {
            event.preventDefault(); // Mencegah form untuk langsung dikirim
            const form = event.target.closest('form'); // Ambil form terdekat

            let title, text;
            // Menyesuaikan judul dan teks berdasarkan status
            if (status === 'selesai') {
                title = "Kamu Yakin?";
                text = "Pesanan ini akan menandakan bahwa kamu telah menerima barang yang dipesan";
            }

            Swal.fire({
                title: title,
                text: text,
                icon: "warning",
                iconColor: "#334155",
                width: 400,
                background: "#fff",
                showCancelButton: true,
                confirmButtonColor: "#334155",
                cancelButtonColor: "#b91c1c",
                confirmButtonText: "Ya, Sudah diterima!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Kirimkan form jika konfirmasi ya
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        iconColor: '#3b82f6',
                        title: 'Pesanan berhasil ditandai selesai!',
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true,
                        background: '#eff6ff',
                    });
                }
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Menampilkan SweetAlert jika ada session 'success'
        window.onload = function() {
            @if (session('success'))
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    iconColor: '#3b82f6',
                    title: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    background: '#eff6ff',
                });
            @endif

            // Pastikan modal tetap terbuka jika ada error
            @if ($errors->any())
                document.getElementById('createReviewModal').classList.remove('hidden');
            @endif
        };
    </script>

@endsection


{{-- <div class="grid md:grid-cols-2 grid-cols-1">
    <div class="bg-white min-h-screen">
        <div class="py-10 pt-2 px-20">
            <div class="mb-4">
                <a href="{{ route('user.orders.index') }}"
                    class="bg-blue-400 text-white py-1 px-3 rounded-md text-xs">Kembali</a>
            </div>

            <div class="mb-7">
                <h1 class="text-xl font-bold mb-1 text-slate-800">
                    Informasi Anda
                </h1>

                <div class="mb-3">
                    <input type="text" value="{{ $order->user->name }}" name="name" placeholder="Name"
                        class="w-full py-3 px-3 outline-none bg-gray-100 border border-gray-300 text-slate-700 rounded-lg text-sm"
                        disabled />
                </div>
                <div class="mb-3">
                    <input type="email" name="email" value="{{ $order->user->email }}" placeholder="Email"
                        class="w-full py-3 px-3 outline-none bg-gray-100 border border-gray-300 text-slate-700 rounded-lg text-sm"
                        readonly />
                </div>
                <div class="w-full border border-gray-300 rounded-lg overflow-hidden">
                    <div class="flex gap-5 border-b-2 py-2 px-3">
                        <input type="radio" name="alamat" id="alamat" checked disabled />
                        <label for="alamat" class="w-full">
                            <h6 class="text-lg text-slate-700 font-semibold">{{ $order->addresses->mark }}</h6>
                            <p class="text-sm text-slate-600">
                                {{ $order->addresses->address }}
                            </p>
                            <span class="text-slate-700 text-sm font-medium">{{ $order->addresses->no_telepon }}</span>
                        </label>
                    </div>
                </div>
            </div>



            <div class="mb-7">
                <h1 class="text-xl font-bold mb-1 text-slate-800">
                    Pengiriman</h1>
                <div class="mb-3">
                    <label for="courier" class="text-slate-700 font-medium text-sm">Kurir</label>
                    <input type="text" value="{{ $order->postage->code }}"
                        class="w-full py-3 px-3 outline-none bg-gray-100 border border-gray-300 text-slate-700 rounded-lg text-sm"
                        disabled />
                </div>
                <div class="mb-3">
                    <label for="cost" class="text-slate-700 font-medium text-sm">Service</label>
                    <input type="text" value="{{ $order->postage->service }}"
                        class="w-full py-3 px-3 outline-none bg-gray-100 border border-gray-300 text-slate-700 rounded-lg text-sm"
                        disabled>
                </div>

            </div>

            <div class="mb-7">
                <h1 class="text-xl font-bold mb-1 text-slate-800">Voucher</h1>

                <div class="flex items-center justify-center w-full border rounded-md overflow-hidden">
                    <input type="text" value="{{ $order->promoCode?->code }}"
                        class="w-full py-3 px-3 outline-none bg-gray-100 border border-gray-300 text-slate-700 rounded-lg text-sm"
                        placeholder="Kode Voucher" disabled />
                </div>
            </div>
            <div class="mb-7">
                <h1 class="text-xl font-bold mb-1 text-slate-800">
                    pembayaran</h1>
                <div class="mb-3">
                    <label class="text-slate-700 font-medium text-sm">Metode </label>
                    <input type="text" value="{{ $order->payment->payment_method }}"
                        class="w-full py-3 px-3 outline-none bg-gray-100 border border-gray-300 text-slate-700 rounded-lg text-sm"
                        disabled />
                </div>
                <div class="mb-3">
                    @if ($order->payment->status == 'pending')
                        <span
                            class="inline-flex items-center m-2 px-3 py-1 bg-blue-200  rounded-full text-sm font-semibold text-blue-600">Pending</span>
                    @elseif ($order->payment->status == 'failed')
                        <span
                            class="inline-flex items-center m-2 px-3 py-1 bg-red-200  rounded-full text-sm font-semibold text-red-600">Failed</span>
                    @elseif ($order->payment->status == 'expired')
                        <span
                            class="inline-flex items-center m-2 px-3 py-1 bg-yellow-200  rounded-full text-sm font-semibold text-yellow-600">Expired</span>
                    @else
                        <span
                            class="inline-flex items-center m-2 px-3 py-1 bg-green-200  rounded-full text-sm font-semibold text-green-600">Success</span>
                    @endif
                </div>

            </div>
        </div>
    </div>
    <div>
        <div class="md:fixed static top-0 bg-neutral-100 min-h-screen">
            <h5 class="px-20 text-2xl font-medium text-slate-800 py-5">
                {{ count($order->productOrders) }} items
            </h5>
            <div class="px-10 h-96 overflow-y-auto">
                <table class="table-auto w-full">
                    <tr class="sticky top-0 z-10">
                        <th class="text-slate-700 text-sm font-medium">Gambar</th>
                        <td class="text-slate-700 text-sm font-medium">Produk</td>
                        <td class="text-slate-700 text-sm font-medium">Harga</td>
                    </tr>
                    @foreach ($order->productOrders as $orderProduct)
                        <tr class="border-b-2 border-slate-300">
                            <th>
                                <div
                                    class="w-28 h-28 bg-cover bg-center overflow-hidden flex justify-center items-center p-5">
                                    @if ($orderProduct->product->image_product)
                                        <img src="{{ asset('storage/' . $orderProduct->product->image_product) }}"
                                            alt="">
                                    @else
                                        <img src="{{ asset('img/img-carousel-promo/laptop.jpg') }}" alt="">
                                    @endif
                                </div>
                            </th>
                            <td class="w-full align-bottom">
                                <div class="text-sm text-slate-700 mb-5">
                                    {{ $orderProduct->product->name_product }}
                                    <br>
                                    <span>x {{ $orderProduct->quantity }}</span>
                                </div>
                            </td>
                            <td class="align-center">
                                <p class="text-sm text-slate-500 text-nowrap">
                                    Rp. {{ number_format($orderProduct->product->price_product, 0, ',', '.') }}
                                </p>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <div class="py-4 flex justify-between items-center mt-5 px-20">
                <table class="table-auto w-full">
                    <tr>
                        <td class="text-xs text-slate-600 w-full">Subtotal</td>
                        <td class="text-xs text-slate-600 w-full"></td>
                        <td class="text-xs text-slate-800 text-right text-nowrap flex justify-end">
                            Rp. <div id="subtotal">{{ number_format($order->sub_total_amount, 0, ',', '.') }}</div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-xs text-slate-600">Ongkos kirim</td>
                        <td class="text-xs text-slate-600">+</td>
                        <td class="text-xs text-slate-800 text-right text-nowrap">Rp.
                            {{ number_format($order->postage->ongkir_total_amount, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="text-xs text-slate-600">Diskon</td>
                        <td class="text-xs text-slate-600">-</td>
                        <td class="text-xs text-slate-800 text-right text-nowrap">Rp.
                            {{ number_format($order->promoCode?->discount_amount, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="text-sm text-slate-600">Total</td>
                        <td class="text-sm text-slate-600"></td>
                        <td class="text-sm text-slate-800 text-right text-nowrap flex">
                            Rp. {{ number_format($order->grand_total_amount, 0, ',', '.') }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div> --}}
