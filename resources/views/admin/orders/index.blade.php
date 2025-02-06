<!-- resources/views/orders/index.blade.php -->
@extends('layouts.admin')

@section('main')
    <style>
        * {
            /* border: 1px solid black; */
        }
    </style>
    <div class="container-fluid">
        <div class="container p-6">
            <div class="flex flex-col md:flex-row mb-4 gap-4">
                <!-- Banner -->
                <div class="w-full md:w-3/4 bg-blue-500 bg-opacity-20 p-4 rounded-lg">
                    <div class="flex justify-between items-center">
                        <!-- Kiri: Judul dan Breadcrumb -->
                        <div>
                            <h1 class="text-3xl font-semibold text-gray-800">Daftar Pesanan</h1>
                            <nav class="mt-2">
                                <ol class="flex text-sm text-gray-600">
                                    <li><a href="{{ route('dashboard.index') }}" class="hover:text-blue-500">Dashboard</a>
                                    </li>
                                    <li class="mx-2">/</li>
                                    <li><a href="{{ route('admin.orders.index') }}" class="hover:text-blue-500"> Pesanan</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <!-- Kanan: Gambar (Vector) -->
                        <div class="hidden md:block">
                            <img src="{{ asset('img/img-banner/order.png') }}" alt="Gambar Banner"
                                class="w-32 h-32 object-contain">
                        </div>
                    </div>
                </div>
                <!-- Card -->
                <div class="w-full md:w-1/4 bg-gradient-to-r from-blue-800 to-blue-400 p-2 rounded-lg shadow-md">
                    <div class="flex flex-col items-center">
                        <!-- Ikon di atas dengan latar belakang putih dan tinggi penuh -->
                        <div class="bg-white p-4 rounded-md h-16 w-16 flex justify-center items-center w-full">
                            <i class="fa-solid fa-dolly text-3xl text-blue-600"></i>
                        </div>
                        <!-- Keterangan di bawah ikon -->
                        <div class="mt-4 text-center">
                            <h2 class="text-xl font-medium text-white">Jumlah Pesanan</h2>
                            <p class="text-2xl font-semibold text-white mt-2">{{ $orders->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card w-full">
                <div class="card-body p-4">
                    <div>
                        <form action="{{ route('admin.orders.index') }}" method="GET" id="filterForm">
                            <div class="flex justify-between items-center mb-4">
                                <div class="d-flex align-items-center">
                                    <!-- Pencarian -->
                                    <input type="text" name="search"
                                        class="form-control me-2 border-lg border-[#5d85fa]" placeholder="Cari"
                                        value="{{ request('search') }}" style="width: 200px;">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </div>
                                <div class="d-flex items-center gap-4 w-full md:w-auto">
                                    <button type="button"
                                        class="btn btn-secondary text-white py-2 px-4 rounded-lg w-full md:w-auto"
                                        data-bs-toggle="modal" data-bs-target="#filterModal">
                                        Filter
                                    </button>
                                    <!-- Filter Kategori -->
                                    <select name="product_id"
                                        class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full"
                                        style="width: 200px;" onchange="submitForm()">
                                        <option value="">Semua Produk</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}"
                                                {{ request('product_id') == $product->id ? 'selected' : '' }}>
                                                {{ $product->name_product }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Modal Filter -->
                            <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-[#5d85fa] text-white">
                                            <h5 class="modal-title" id="filterModalLabel">Filter Produk</h5>
                                            <button type="button" class="close text-white" data-bs-dismiss="modal"
                                                aria-label="Close">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            @if (session('error'))
                                                <div class="alert alert-danger">
                                                    {{ session('error') }}
                                                </div>
                                            @endif

                                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">

                                                <!-- Filter Harga -->
                                                <div>
                                                    <label for="price" class="block font-medium">Harga</label>
                                                    <select name="price" class="form-select">
                                                        <option value="">Pilih</option>
                                                        <option value="asc"
                                                            {{ request('price') == 'asc' ? 'selected' : '' }}>Terendah ke
                                                            Tertinggi</option>
                                                        <option value="desc"
                                                            {{ request('price') == 'desc' ? 'selected' : '' }}>Tertinggi ke
                                                            Terendah</option>
                                                    </select>
                                                </div>

                                                <!-- Filter Status Pesanan -->
                                                <div>
                                                    <label for="status_order" class="block font-medium">Status
                                                        Pesanan</label>
                                                    <select name="status_order" class="form-select">
                                                        <option value="">Pilih</option>
                                                        <option value="pending"
                                                            {{ request('status_order') == 'pending' ? 'selected' : '' }}>
                                                            Menunggu</option>
                                                        <option value="processing"
                                                            {{ request('status_order') == 'processing' ? 'selected' : '' }}>
                                                            Dikemas</option>
                                                        <option value="shipping"
                                                            {{ request('status_order') == 'shipping' ? 'selected' : '' }}>
                                                            Dikirim</option>
                                                        <option value="completed"
                                                            {{ request('status_order') == 'completed' ? 'selected' : '' }}>
                                                            Selesai</option>
                                                    </select>
                                                </div>

                                                <!-- Filter Status Pembayaran -->
                                                <div>
                                                    <label for="payment_status" class="block font-medium">Status
                                                        Pembayaran</label>
                                                    <select name="payment_status" class="form-select">
                                                        <option value="">Pilih</option>
                                                        <option value="failed"
                                                            {{ request('payment_status') == 'failed' ? 'selected' : '' }}>
                                                            Gagal</option>
                                                        <option value="pending"
                                                            {{ request('payment_status') == 'pending' ? 'selected' : '' }}>
                                                            Menunggu</option>
                                                        <option value="expired"
                                                            {{ request('payment_status') == 'expired' ? 'selected' : '' }}>
                                                            Kedaluwarsa</option>
                                                        <option value="success"
                                                            {{ request('payment_status') == 'success' ? 'selected' : '' }}>
                                                            Berhasil</option>
                                                    </select>
                                                </div>

                                                <!-- Sortir berdasarkan tanggal -->
                                                <div>
                                                    <label for="created_at_sort" class="block font-medium">Urutkan</label>
                                                    <select name="created_at_sort" class="form-select">
                                                        <option value="">Pilih</option>
                                                        <option value="asc"
                                                            {{ request('created_at_sort') == 'asc' ? 'selected' : '' }}>
                                                            Lama</option>
                                                        <option value="desc"
                                                            {{ request('created_at_sort') == 'desc' ? 'selected' : '' }}>
                                                            Terbaru</option>
                                                    </select>
                                                </div>

                                                <!-- Tanggal Awal -->
                                                <div>
                                                    <label for="start_date" class="block font-medium">Tanggal Awal</label>
                                                    <input type="date" name="start_date"
                                                        value="{{ request('start_date') }}" class="form-control">
                                                </div>

                                                <!-- Tanggal Akhir -->
                                                <div>
                                                    <label for="end_date" class="block font-medium">Tanggal Akhir</label>
                                                    <input type="date" name="end_date"
                                                        value="{{ request('end_date') }}" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Terapkan Filter</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <!-- Reset Filter Button -->
                                            <a href="{{ route('admin.orders.index') }}?reset=true"
                                                class="btn btn-warning">Reset Filter</a>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    // Jika session 'error' ada, modal akan muncul
                                    @if (session('error'))
                                        var filterModal = new bootstrap.Modal(document.getElementById('filterModal'));
                                        filterModal.show();
                                    @endif

                                    // Jika parameter 'reset' ada di URL, modal akan muncul
                                    const urlParams = new URLSearchParams(window.location.search);
                                    if (urlParams.has('reset') && urlParams.get('reset') === 'true') {
                                        var filterModal = new bootstrap.Modal(document.getElementById('filterModal'));
                                        filterModal.show();
                                    }
                                });
                            </script>
                        </form>


                    </div>

                    <script>
                        function submitForm() {
                            document.getElementById('filterForm').submit();
                        }
                    </script>


                    <div class="table-responsive">
                        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                            <thead class="bg-[#5D87FF] text-white"> {{-- bg-gray-100 --}}
                                <tr>
                                    <th style="width: 5%;" class="px-4 py-2 text-left whitespace-nowrap">No</th>
                                    <th style="width: 10%;" class="px-4 py-2 text-left whitespace-nowrap">Pelanggan</th>
                                    <th style="width: 15%;" class="px-4 py-2 text-left ">Produk</th>
                                    <th style="width: 15%;" class="px-4 py-2 text-left whitespace-nowrap">Total</th>
                                    <th style="width: 15%;" class="px-4 py-2 text-left whitespace-nowrap">Status Pesanan
                                    </th>
                                    <th style="width: 15%;" class="px-4 py-2 text-left whitespace-nowrap">Status
                                        Pembayaran</th>
                                    <th style="width: 15%;" class="px-4 py-2 text-left whitespace-nowrap">Dibuat</th>
                                    <th style="width: 10%;" class="px-4 py-2 text-left whitespace-nowrap">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr class="hover:bg-gray-100 border-b ">
                                        <td class="px-4 py-2">
                                            {{ $loop->iteration ?? '-' }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            {{ $order->user->name }}
                                        </td>
                                        <td class="px-4 py-2 ">
                                            @if ($order->productOrders->count() > 2)
                                                <ul class="list-disc">
                                                    @foreach ($order->productOrders->take(2) as $productOrder)
                                                        <li class="flex justify-between items-center">
                                                            <span>{{ $productOrder->product->name_product }}</span>
                                                            <span
                                                                class="text-xs text-slate-700">(x{{ $productOrder->quantity }})</span>
                                                        </li>
                                                    @endforeach
                                                    <span class="flex justify-center text-2xl font-bold">...</span>
                                                </ul>
                                            @else
                                                <ul class="list-disc">
                                                    @foreach ($order->productOrders as $productOrder)
                                                        <li class="flex justify-between items-center">
                                                            <span>{{ $productOrder->product->name_product }}</span>
                                                            <span
                                                                class="text-xs text-slate-700">(x{{ $productOrder->quantity }})</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            Rp.
                                            {{ number_format($order->grand_total_amount, 0, '.', '.') }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            <div class="d-flex align-items-center gap-2">
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

                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            <div class="d-flex align-items-center gap-2">
                                                <span
                                                    class="px-3 py-1 rounded-full text-sm font-semibold
                                                        @if ($order->payment->status === 'failed') bg-yellow-200 text-red-600
                                                        @elseif ($order->payment->status === 'pending')
                                                            bg-blue-200 text-blue-600
                                                        @elseif ($order->payment->status === 'expired')
                                                            bg-gray-200 text-gray-600
                                                        @elseif ($order->payment->status === 'success')
                                                            bg-green-200 text-green-600
                                                        @else
                                                            bg-gray-100 text-gray-600 @endif">
                                                    {{ ucfirst($order->payment->status) }}
                                                </span>
                                            </div>
                                        </td>


                                        <td class="px-4 py-2 whitespace-nowrap">
                                            {{ $order->created_at->format('d F Y') ?? 'kosong' }}
                                        </td>
                                        <td class="px-4 py-2">
                                            <div class="flex gap-2 py-10">
                                                <div class="relative group inline-block">
                                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                                        class="bg-blue-500 text-white px-3 py-2 rounded flex items-center">
                                                        <i class="fas fa-eye text-sm"></i>
                                                    </a>
                                                    <span
                                                        class="absolute hidden group-hover:block bg-gray-800 text-white text-sm rounded px-2 py-1 mt-2 left-1/2 transform -translate-x-1/2">
                                                        <span
                                                            class="absolute bg-gray-800 h-2 w-2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rotate-45 "></span>
                                                        Detail
                                                    </span>
                                                </div>
                                                <!-- Form Hapus Pesanan -->
                                                {{-- <div class="relative group inline-block">
                                                    <!-- Tombol Hapus yang akan membuka modal konfirmasi -->
                                                    <form action="{{ route('admin.orders.destroy', $order->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button"
                                                            class="bg-red-500 text-white px-3 py-2 rounded flex items-center"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#hapusmodal{{ $order->id }}">
                                                            <i class="fas fa-trash text-sm"></i>
                                                        </button>
                                                        <span
                                                            class="absolute hidden group-hover:block bg-gray-800 text-white text-sm rounded px-2 py-1 mt-2 left-1/2 transform -translate-x-1/2">
                                                            <span
                                                                class="absolute bg-gray-800 h-2 w-2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rotate-45"></span>
                                                            Hapus
                                                        </span>
                                                    </form>
                                                </div> --}}
                                                <div class="relative group inline-block">
                                                    @if ($order->payment && $order->payment->status != 'pending')
                                                        <!-- Form Proses -->
                                                        <form style="display: inline;"
                                                            id="form-proses-{{ $order->id }}" method="POST"
                                                            action="{{ route('admin.order.updateStatus', $order->id) }}">
                                                            @csrf
                                                            <input type="hidden" name="status" value="processing">

                                                            @if ($order->status_order == 'pending')
                                                                <button type="button"
                                                                    class="bg-blue-400 rounded text-white flex items-center relative px-3 py-2"
                                                                    aria-label="Proses"
                                                                    onclick="confirmStatusUpdate('form-proses-{{ $order->id }}', 'Dikemas', 'Pesanan akan diproses dan dikemas.')">
                                                                    <i class="fas fa-cogs text-sm"></i>
                                                                </button>
                                                                <!-- Tooltip Kemas -->
                                                                <span
                                                                    class="absolute hidden group-hover:block bg-gray-800 text-white text-sm rounded px-2 py-1 mt-2 left-1/2 transform -translate-x-1/2">
                                                                    <span
                                                                        class="absolute bg-gray-800 h-2 w-2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rotate-45"></span>
                                                                    Kemas
                                                                </span>
                                                            @endif
                                                        </form>

                                                        <!-- Form Kirim -->
                                                        <form id="form-kirim-{{ $order->id }}" method="POST"
                                                            action="{{ route('admin.order.updateStatus', $order->id) }}">
                                                            @csrf
                                                            <input type="hidden" name="status" value="shipping">

                                                            @if ($order->status_order == 'processing')
                                                                <button type="button"
                                                                    class="bg-orange-500 rounded text-white flex items-center relative px-3 py-2"
                                                                    aria-label="Kirim"
                                                                    onclick="confirmStatusUpdate('form-kirim-{{ $order->id }}', 'Dikirim', 'Pesanan akan dikirim ke alamat tujuan.')">
                                                                    <i class="fas fa-truck text-sm"></i>
                                                                </button>
                                                                <!-- Tooltip Kirim -->
                                                                <span
                                                                    class="absolute hidden group-hover:block bg-gray-800 text-white text-sm rounded px-2 py-1 mt-2 left-1/2 transform -translate-x-1/2">
                                                                    <span
                                                                        class="absolute bg-gray-800 h-2 w-2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rotate-45"></span>
                                                                    Kirim
                                                                </span>
                                                            @endif
                                                        </form>

                                                        <!-- Form Selesai -->
                                                        <form id="form-selesai-{{ $order->id }}" method="POST"
                                                            action="{{ route('admin.order.updateStatus', $order->id) }}">
                                                            @csrf
                                                            <input type="hidden" name="status" value="completed">

                                                            @if ($order->status_order == 'shipping' && $order->created_at->diffInDays(now()) >= 14)
                                                                <button type="button"
                                                                    class="bg-green-500 text-white rounded flex items-center relative px-3 py-2"
                                                                    aria-label="Selesai"
                                                                    onclick="confirmStatusUpdate('form-selesai-{{ $order->id }}', 'Selesai', 'Pesanan ini telah selesai dan diterima oleh pelanggan.')">
                                                                    <i class="fas fa-check-circle text-sm"></i>
                                                                </button>
                                                                <!-- Tooltip Selesai -->
                                                                <span
                                                                    class="absolute hidden group-hover:block bg-gray-800 text-white text-sm rounded px-2 py-1 mt-2 left-1/2 transform -translate-x-1/2">
                                                                    <span
                                                                        class="absolute bg-gray-800 h-2 w-2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rotate-45"></span>
                                                                    Selesai
                                                                </span>
                                                            @endif
                                                        </form>
                                                    @else
                                                    @endif
                                                </div>


                                            </div>
                                        </td>
                                    </tr>
                                    {{-- <!-- Modal Hapus -->
                                    <div class="modal fade" id="hapusmodal{{ $order->id }}" tabindex="-1"
                                        aria-labelledby="hapusModalLabel{{ $order->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="hapusModalLabel{{ $order->id }}">Hapus
                                                        Pesanan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body" style="color: black;">
                                                    Apakah Anda yakin ingin menghapus pesanan
                                                    <strong>{{ $order->order }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Kembali</button>
                                                    <!-- Form untuk menghapus voucher -->
                                                    <form action="{{ route('admin.orders.destroy', $order->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                @empty
                                    <tr>
                                        <td colspan="8" class="h-64">
                                            <div
                                                class="bg-white shadow-sm rounded-lg p-4 text-center flex flex-col justify-center items-center">
                                                <img src="{{ asset('img/empty-data.png') }}" alt=" Tidak Ditemukan"
                                                    class="w-64 h-64">
                                                <p class="text-lg text-gray-600 font-medium">Tidak ada pesanan</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        /**
         * Konfirmasi pembaruan status pesanan
         * @param {string} formId - ID form yang akan disubmit
         * @param {string} actionName - Nama aksi untuk ditampilkan di dialog
         * @param {string} confirmationText - Pesan konfirmasi yang akan ditampilkan
         */
        function confirmStatusUpdate(formId, actionName, confirmationText) {
            Swal.fire({
                title: `Konfirmasi ${actionName}`,
                text: confirmationText,
                icon: "warning",
                iconColor: "#334155", // Warna ikon peringatan
                showCancelButton: true,
                confirmButtonColor: "#334155", // Tombol konfirmasi berwarna biru
                cancelButtonColor: "#d33", // Tombol batal berwarna merah
                confirmButtonText: "Ya, Lanjutkan!", // Teks tombol konfirmasi
                cancelButtonText: "Batal", // Teks tombol batal
                customClass: {
                    popup: 'swal-popup-blue', // Tambahkan kelas khusus untuk popup
                },
                background: "#eff6ff", // Warna latar belakang biru terang
                width: 400, // Lebar popup
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form jika konfirmasi berhasil
                    document.getElementById(formId).submit();

                    // Toast notifikasi berhasil
                    Swal.fire({
                        toast: true,
                        position: 'top-end', // Posisi di kanan atas
                        icon: 'success', // Ikon sukses
                        iconColor: '#3b82f6', // Warna ikon sukses
                        title: `${actionName} berhasil!`,
                        showConfirmButton: false, // Tidak ada tombol konfirmasi
                        timer: 1500, // Waktu notifikasi dalam milidetik
                        timerProgressBar: true, // Menampilkan progres waktu
                        background: '#eff6ff', // Warna latar belakang biru terang
                    });
                }
            });
        }
    </script>
@endsection

{{-- <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    No
                                </th>
                                <th class="border-bottom-0">
                                    User
                                </th>
                                <th class="border-bottom-0">
                                    Produk
                                </th>
                                <th class="border-bottom-0">
                                    Total
                                </th>
                                <th class="border-bottom-0">
                                    Status
                                </th>
                                <th class="border-bottom-0">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="border-bottom-0">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="border-bottom-0">
                                        {{ $order->user->name }}
                                    </td>
                                    <td class="border-bottom-0">
                                        <ul class="list-disc">
                                            @foreach ($order->productOrders as $productOrder)
                                                <li class="flex justify-between items-center">
                                                    <span>{{ $productOrder->product->name_product }}</span>
                                                    <span
                                                        class="text-xs text-slate-700">x{{ $productOrder->quantity }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="border-bottom-0">
                                        Rp.
                                        {{ number_format($order->grand_total_amount, 2) }}
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="d-flex align-items-center gap-2">
                                            <span
                                                class="badge bg-secondary rounded-1 fw-semibold">{{ ucfirst($order->status_order) }}</span>
                                        </div>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="flex gap-2">
                                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#detailOrderModal{{ $order->id }}">
                                                Detail
                                            </button>
                                            <!-- Tombol Edit -->
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editOrderModal{{ $order->id }}">
                                                Edit
                                            </button>

                                            <!-- Form Hapus Pesanan -->
                                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin menghapus?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <div class="modal fade" id="detailOrderModal{{ $order->id }}" tabindex="-1"
                                    aria-labelledby="detailOrderModalLabel{{ $order->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="detailOrderModalLabel{{ $order->id }}">
                                                    Detail Pesanan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Form inside modal -->

                                                <!-- Form fields for editing -->
                                                <div class="mb-3">
                                                    <div
                                                        class="grid grid-cols-[1fr_0.1fr_2fr] border-b-2 py-2 border-slate-300 mb-2">
                                                        <span>pelanggan</span>
                                                        <span>:</span>
                                                        <span>{{ $order->user->name }}</span>
                                                    </div>
                                                    <div
                                                        class="grid grid-cols-[1fr_0.1fr_2fr] border-b-2 py-2 border-slate-300 mb-2">
                                                        <span>Produk</span>
                                                        <span>:</span>
                                                        <ul class="list-disc">
                                                            @foreach ($order->productOrders as $productOrder)
                                                                <li class="flex justify-between items-center">
                                                                    <span>{{ $productOrder->product->name_product }}</span>
                                                                    <span
                                                                        class="text-xs text-slate-700">x{{ $productOrder->quantity }}</span>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div class="border-2 p-2 border-slate-300 mb-2">
                                                        <span class="text-sm ">Pembayaran</span>
                                                        <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                                            <span>metode pembayaran</span>
                                                            <span>:</span>
                                                            <span>{{ $order->payment->payment_method }}</span>
                                                            </span>
                                                        </div>
                                                        <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                                            <span>status pembayaran</span>
                                                            <span>:</span>
                                                            <span>{{ $order->payment->status }}</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="border-2 p-2 border-slate-300 mb-2">
                                                        <span class="text-sm ">Total</span>
                                                        <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                                            <span>sub total</span>
                                                            <span>:</span>
                                                            <span>Rp.
                                                                {{ number_format($order->sub_total_amount, 2) }}
                                                            </span>
                                                        </div>
                                                        <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                                            <span>ongkos kirim</span>
                                                            <span>:</span>
                                                            <span>+ Rp.
                                                                {{ $order->postage->ongkir_total_amount }}</span>
                                                        </div>
                                                        <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                                            <span>diskon</span>
                                                            <span>:</span>
                                                            <span>- Rp.
                                                                {{ $order->promoCode->discount_amount ?? '' }}</span>
                                                        </div>
                                                        <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                                            <span>total</span>
                                                            <span>:</span>
                                                            <span>Rp.
                                                                {{ number_format($order->grand_total_amount, 2) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="border-2 p-2 border-slate-300 mb-2">
                                                    <span class="text-sm ">Alamat</span>
                                                    <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                                        <span>alamat</span>
                                                        <span>:</span>
                                                        <span>{{ $order->addresses->address }}</span>
                                                    </div>
                                                    <div class="grid grid-cols-[1fr_0.1fr_2fr] py-1">
                                                        <span>no telp</span>
                                                        <span>:</span>
                                                        <span>{{ $order->addresses->no_telepon }}</span>
                                                    </div>
                                                </div>

                                                <div class="mb-2 text-right">
                                                    <span
                                                        class="text-xs">{{ $order->created_at->translatedFormat('d F Y') }}</span>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Kembali</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="editOrderModal{{ $order->id }}" tabindex="-1"
                                    aria-labelledby="editOrderModalLabel{{ $order->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editOrderModalLabel{{ $order->id }}">
                                                    Edit Pesanan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <!-- Form inside modal -->
                                                <form action="{{ route('admin.orders.update', $order->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <!-- Form fields for editing -->
                                                    <div class="mb-3">
                                                        <label for="edit_status_order" class="form-label">Status
                                                            Order</label>
                                                        <select name="status_order" class="form-select" required>
                                                            <option value="pending"
                                                                {{ $order->status_order == 'pending' ? 'selected' : '' }}>
                                                                Pending</option>
                                                            <option value="processing"
                                                                {{ $order->status_order == 'processing' ? 'selected' : '' }}>
                                                                Processing</option>
                                                            <option value="completed"
                                                                {{ $order->status_order == 'completed' ? 'selected' : '' }}>
                                                                Completed</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Kembali</button>
                                                        <button type="submit" class="btn btn-primary">Simpan
                                                            Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table> --}}
