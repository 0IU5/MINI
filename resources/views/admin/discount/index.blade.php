@extends('layouts.admin')

@section('main')
    <div class="container-fluid">
        <div class="container p-6">
            <div class="flex flex-col md:flex-row mb-4 gap-4">
                <!-- Banner -->
                <div class="w-full md:w-3/4 bg-blue-500 bg-opacity-20 p-4 rounded-lg">
                    <div class="flex justify-between items-center">
                        <!-- Kiri: Judul dan Breadcrumb -->
                        <div>
                            <h1 class="text-3xl font-semibold text-gray-800">Daftar Voucher</h1>
                            <nav class="mt-2">
                                <ol class="flex text-sm text-gray-600">
                                    <li><a href="{{ route('dashboard.index') }}" class="hover:text-blue-500">Dashboard</a>
                                    </li>
                                    <li class="mx-2">/</li>
                                    <li><a href="{{ route('admin.discount.index') }}"
                                            class="hover:text-blue-500">Voucher</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <!-- Kanan: Gambar (Vector) -->
                        <div class="hidden md:block">
                            <img src="{{ asset('img/img-banner/voucher.png') }}" alt="Gambar Banner"
                                class="w-40 h-40 object-contain">
                        </div>
                    </div>
                </div>
                <!-- Card -->
                <div class="w-full md:w-1/4 bg-gradient-to-r from-blue-800 to-blue-400 p-2 rounded-lg shadow-md">
                    <div class="flex flex-col items-center">
                        <!-- Ikon di atas dengan latar belakang putih dan tinggi penuh -->
                        <div class="bg-white p-4 rounded-md h-16 w-16 flex justify-center items-center w-full">

                            <i class="fa-solid fa-ticket text-3xl text-blue-600"></i>
                        </div>
                        <!-- Keterangan di bawah ikon -->
                        <div class="mt-4 text-center">
                            <h2 class="text-xl font-medium text-white">Jumlah Voucher</h2>
                            <p class="text-2xl font-semibold text-white mt-2">{{ $codes->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card w-full">
                <div class="card-body p-4">
                    <div>
                        <form action="{{ route('admin.discount.index') }}" method="GET">
                            <div class="flex justify-between items-center mb-4">
                                <div class="d-flex align-items-center">
                                    <!-- Pencarian -->
                                    <input type="text" name="search" class="form-control me-2 border-lg border-[#5d85fa]" placeholder="Cari"
                                        value="{{ request('search') }}" style="width: 200px;">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </div>
                                <div class="flex items-center gap-4">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahmodal">
                                        + Tambah Vocher
                                    </button>
                                </div>
                            </div>

                            <div class="grid grid-cols-3 gap-3 text-white border-t border-gray-600 pt-4 mb-4">
                                <div>
                                    <select name="price_discount" class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full" onchange="this.form.submit()">
                                        <option value="">Diskon</option>
                                        <option value="asc" {{ request('price_discount') == 'asc' ? 'selected' : '' }}>Terendah ke Tertinggi</option>
                                        <option value="desc" {{ request('price_discount') == 'desc' ? 'selected' : '' }}>Tertinggi ke Terendah</option>
                                    </select>
                                </div>
                                <div>
                                    <select name="kuantitas" class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full" onchange="this.form.submit()">
                                        <option value="">Kuantitas</option>
                                        <option value="asc" {{ request('kuantitas') == 'asc' ? 'selected' : '' }}>Sedikit Ke Terbanyak</option>
                                        <option value="desc" {{ request('kuantitas') == 'desc' ? 'selected' : '' }}>Terbanyak Ke Sedikit</option>
                                    </select>
                                </div>
                                <div>
                                    <select name="minimal_pembelian" class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full" onchange="this.form.submit()">
                                        <option value="">Minimal Pembelian</option>
                                        <option value="asc" {{ request('minimal_pembelian') == 'asc' ? 'selected' : '' }}>Terendah ke Tertinggi</option>
                                        <option value="desc" {{ request('minimal_pembelian') == 'desc' ? 'selected' : '' }}>Tertinggi ke Terendah</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="min-w-full bg-white rounded-lg overflow-hidden">
                            <thead class="bg-[#5D87FF] text-white"> {{-- bg-gray-100 --}}
                                <tr>
                                    <th class="px-4 py-2 text-left" style="width: 5%;">No</th>
                                    <th class="px-4 py-2 text-left" style="width: 20%;">Kode Vocher</th>
                                    <th class="px-4 py-2 text-left" style="width: 15%;">Diskon</th>
                                    <th class="px-4 py-2 text-left" style="width: 10%;">Kuantitas</th>
                                    <th class="px-4 py-2 text-left" style="width: 20%;">Minimal Pembelian</th>
                                    <th class="px-4 py-2 text-left" style="width: 15%;">Pengguna</th>
                                    <th class="px-4 py-2 text-left" style="width: 15%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($codes as $code)
                                    <tr class="hover:bg-gray-100  border-b">
                                        <td class="px-6 py-5">
                                            {{ $loop->iteration ?? '-' }}
                                        </td>
                                        <td class="px-6 py-5">
                                            {{ $code->code }}
                                        </td>
                                        <td class="px-6 py-5">
                                            Rp. {{ number_format($code->discount_amount, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-5">
                                            {{ $code->quantity }}
                                        <td class="px-6 py-5">
                                            Rp. {{ number_format($code->minimum_purchase, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-5">
                                            @if ($code->users->count() > 0)
                                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#usermodal{{ $code->id }}">
                                                    Lihat Pengguna
                                                </button>
                                            @else
                                                Belum digunakan
                                            @endif
                                        </td>
                                        <td class="px-4 py-2">
                                            <div class="flex items-center gap-2">
                                                <!-- Edit Button with Tooltip -->
                                                <div class="relative group">
                                                    <button type="button"
                                                        class=" bg-yellow-500 rounded text-white flex items-center relative px-3 py-2 hover:bg-yellow-600 "
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editmodal{{ $code->id }}">
                                                        <i class="fas fa-pen text-sm"></i>
                                                    </button>
                                                    <span
                                                        class="absolute hidden group-hover:block bg-gray-800 text-white text-sm rounded px-2 py-1 mt-2 left-1/2 transform -translate-x-1/2">
                                                        <span
                                                            class="absolute bg-gray-800 h-2 w-2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rotate-45"></span>
                                                        Edit
                                                    </span>
                                                </div>

                                                <!-- Delete Button with Tooltip -->
                                                <div class="relative group">
                                                    <button type="button"
                                                        class="bg-red-500 rounded text-white flex items-center relative px-3 py-2 hover:bg-red-600 "
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#hapusmodal{{ $code->id }}">
                                                        <i class="fas fa-trash text-sm"></i>
                                                    </button>
                                                    <span
                                                        class="absolute hidden group-hover:block bg-gray-800 text-white text-sm rounded px-2 py-1 mt-2 left-1/2 transform -translate-x-1/2">
                                                        <span
                                                            class="absolute bg-gray-800 h-2 w-2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rotate-45"></span>
                                                        Hapus
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="usermodal{{ $code->id }}" tabindex="-1"
                                        aria-labelledby="userModalLabel{{ $code->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">

                                                <!-- Banner Section -->
                                                <div class="p-4">
                                                    <div class="relative ">
                                                        <!-- Banner Image -->
                                                        <img src="{{ asset('img/voucher.jpg') }}" alt="Voucher Banner"
                                                            class=" w-full h-[150px] rounded-md">
                                                        <!-- Text Overlay -->
                                                        <div
                                                            class="absolute top-0 left-0 right-0 bottom-0 flex flex-col justify-center items-center text-white">
                                                            <!-- Title Text with smaller font size -->
                                                            <p class="text-xl font-bold mb-2 border-b-2 border-white ">Kode
                                                                Voucher</p> <!-- Title size adjusted -->

                                                            <!-- Description Text with underline and dark blue color -->
                                                            <p class="text-3xl font-bold  text-blue-700">
                                                                ({{ $code->code }})
                                                            </p>
                                                        </div>

                                                    </div>
                                                </div>


                                                <!-- Modal Body -->
                                                <div class="modal-body">
                                                    <div class="title w-full flex justify-center items-center">
                                                        <p class="text-xl font-bold mb-2"><span
                                                                class="text-blue-400 ">Pengguna</span> kode voucher</p>
                                                    </div>
                                                    @if ($code->users->count() > 0)
                                                        <div
                                                            class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-3 max-h-96 overflow-y-auto">
                                                            @foreach ($code->users as $user)
                                                                <div
                                                                    class="flex items-center p-3 border rounded-lg shadow-sm bg-gray-50">
                                                                    <!-- User Avatar -->
                                                                    @if ($user->image)
                                                                        <img src="{{ asset('storage/' . $user->image) }}"
                                                                            alt="Profile Picture"
                                                                            class="rounded-full w-16 h-16 mr-4">
                                                                    @else
                                                                        <img src="{{ asset('style/src/assets/images/profile/user-1.jpg') }}"
                                                                            alt="User Avatar"
                                                                            class="rounded-full w-14 h-14 mr-4">
                                                                    @endif
                                                                    <!-- User Details -->
                                                                    <div>
                                                                        <h6 class="font-bold text-lg mb-1">
                                                                            {{ $user->name }}</h6>
                                                                        <p class="text-sm text-gray-600 mb-1">
                                                                            <strong>Email:</strong> {{ $user->email }}
                                                                        </p>
                                                                        <p class="text-sm text-gray-600">
                                                                            <strong>Waktu Klaim:</strong>
                                                                            {{ $user->pivot->created_at->locale('id')->isoFormat('D MMM YYYY, HH:mm') }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <div class="text-center py-5">
                                                            <img src="https://via.placeholder.com/150x100?text=No+Users"
                                                                alt="No Users" class="mx-auto mb-4">
                                                            <p class="text-gray-600">Tidak ada pengguna yang menggunakan
                                                                voucher ini.</p>
                                                        </div>
                                                    @endif
                                                </div>



                                                <!-- Footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <!-- Modal Hapus -->
                                    <div class="modal fade" id="hapusmodal{{ $code->id }}" tabindex="-1"
                                        aria-labelledby="hapusModalLabel{{ $code->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="hapusModalLabel{{ $code->id }}">
                                                        Hapus Vocher</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body" style="color: black;">
                                                    Apakah Anda yakin ingin menghapus voucher
                                                    <strong>{{ $code->code }}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Kembali</button>
                                                    <form action="{{ route('admin.discount.destroy', $code->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="7" class="h-64">
                                            <div
                                                class="bg-white shadow-sm rounded-lg p-4 text-center flex flex-col justify-center items-center">
                                                <img src="{{ asset('img/empty-data.png') }}" alt=" Tidak Ditemukan"
                                                    class="w-64 h-64">
                                                <p class="text-lg text-gray-600 font-medium">Tidak ada voucher</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- Pagination Links -->
                        <div class="mt-4">
                            {{ $codes->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    @foreach ($codes as $code)
        <!-- Modal Edit -->
        <div class="modal fade {{ $errors->any() && old('code_id') == $code->id ? 'show' : '' }}"
            id="editmodal{{ $code->id }}" tabindex="-1" aria-hidden="true"
            style="{{ $errors->any() && old('code_id') == $code->id ? 'display: block;' : '' }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $code->id }}">
                            Edit Vocher</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.discount.update', $code->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="code_id" value="{{ $code->id }}">

                            <!-- Kode Voucher -->
                            <div class="mb-3">
                                <label for="code{{ $code->id }}" class="form-label">Kode Voucher</label>
                                <input type="text" name="code" class="form-control" value="{{ $code->code }}" id="code{{ $code->id }}">
                                @if (old('code_id') == $code->id)
                                    @error('code')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            <!-- Jumlah Diskon -->
                            <div class="mb-3">
                                <label for="discount_amount{{ $code->id }}" class="form-label">Jumlah Diskon</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="discount_amount" class="form-control"
                                        value="{{ $code->discount_amount }}" id="discount_amount{{ $code->id }}">
                                </div>
                                @if (old('code_id') == $code->id)
                                    @error('discount_amount')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            <!-- Kuantitas -->
                            <div class="mb-3">
                                <label for="quantity{{ $code->id }}" class="form-label">Kuantitas</label>
                                <input type="number" name="quantity" class="form-control" value="{{ $code->quantity }}" id="quantity{{ $code->id }}">
                                @if (old('code_id') == $code->id)
                                    @error('quantity')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            <!-- Minimal Pembelian -->
                            <div class="mb-3">
                                <label for="minimum_purchase{{ $code->id }}" class="form-label">Minimal Pembelian</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="minimum_purchase" class="form-control"
                                        value="{{ $code->minimum_purchase }}" id="minimum_purchase{{ $code->id }}">
                                </div>
                                @if (old('code_id') == $code->id)
                                    @error('minimum_purchase')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Tambah -->
    <div class="modal fade {{ $errors->any() && !old('code_id') ? 'show' : '' }}" id="tambahmodal" tabindex="-1"
        aria-hidden="true" style="{{ $errors->any() && !old('code_id') ? 'display: block;' : '' }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Tambah Voucher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.discount.store') }}" method="POST">
                        @csrf

                        <!-- Kode Voucher -->
                        <div class="mb-3">
                            <label for="code" class="form-label">Kode Voucher</label>
                            <input type="text" name="code" class="form-control" id="code"
                                placeholder="Kode Voucher" value="{{ !old('code_id') ? old('code') : '' }}">
                            @if (!old('code_id'))
                                @error('code')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <!-- Jumlah Diskon -->
                        <div class="mb-3">
                            <label for="discount_amount" class="form-label">Jumlah Diskon</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="discount_amount" class="form-control" id="discount_amount"
                                    placeholder="Jumlah Diskon" value="{{ !old('code_id') ? old('discount_amount') : '' }}">
                            </div>
                            @if (!old('code_id'))
                                @error('discount_amount')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <!-- Kuantitas -->
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Kuantitas</label>
                            <input type="number" name="quantity" class="form-control" id="quantity"
                                placeholder="Kuantitas" value="{{ !old('code_id') ? old('quantity') : '' }}">
                            @if (!old('code_id'))
                                @error('quantity')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <!-- Minimal Pembelian -->
                        <div class="mb-3">
                            <label for="minimum_purchase" class="form-label">Minimal Pembelian</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="minimum_purchase" class="form-control" id="minimum_purchase"
                                    placeholder="Minimal Pembelian" value="{{ !old('code_id') ? old('minimum_purchase') : '' }}">
                            </div>
                            @if (!old('code_id'))
                                @error('minimum_purchase')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Script untuk Menampilkan Modal Jika Ada Error -->

    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                @if (old('code_id'))
                    // Jika terdapat error pada modal edit
                    var editModalId = 'editmodal{{ old('code_id') }}';
                    var editModal = new bootstrap.Modal(document.getElementById(editModalId));
                    editModal.show();
                @else
                    // Jika terdapat error pada modal tambah
                    var tambahModal = new bootstrap.Modal(document.getElementById('tambahmodal'));
                    tambahModal.show();
                @endif
            });
        </script>
    @endif
@endsection


{{-- <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900 dark:text-gray-100">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif



        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Vocher</th>
                    <th>Diskon</th>
                    <th>Kuantitas</th>
                    <th>Minimal Pembelian</th>
                    <th>Pengguna</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($codes as $code)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $code->code }}</td>
                        <td>Rp. {{ number_format($code->discount_amount, 0, ',', '.') }}</td>
                        <td>{{ $code->quantity }}</td>
                        <td>Rp. {{ number_format($code->minimum_purchase, 0, ',', '.') }}</td>
                        <td>
                            @if ($code->users->count() > 0)
                                <button type="button" class="btn btn-info btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#usermodal{{ $code->id }}">
                                    Lihat Pengguna
                                </button>
                            @else
                                Belum digunakan
                            @endif
                        </td>
                        <td>
                            <!-- Tombol Edit -->
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editmodal{{ $code->id }}">
                                Edit
                            </button>

                            <!-- Tombol Hapus -->
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#hapusmodal{{ $code->id }}">
                                Hapus
                            </button>
                        </td>
                    </tr>

                    <!-- Modal Lihat Pengguna -->
                    <div class="modal fade" id="usermodal{{ $code->id }}" tabindex="-1"
                        aria-labelledby="userModalLabel{{ $code->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="userModalLabel{{ $code->id }}">
                                        Pengguna Yang Sudah Menggunakan Voucher {{ $code->code }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="color: black;">
                                    @if ($code->users->count() > 0)
                                        <ul>
                                            @foreach ($code->users as $user)
                                                <li><strong>Nama:</strong>{{ $user->name }} <br>
                                                    <strong>Email:</strong> ({{ $user->email }})
                                                    <br> <br>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>Belum ada pengguna yang memakai voucher ini.</p>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Hapus -->
                    <div class="modal fade" id="hapusmodal{{ $code->id }}" tabindex="-1"
                        aria-labelledby="hapusModalLabel{{ $code->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapusModalLabel{{ $code->id }}">
                                        Hapus Vocher</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="color: black;">
                                    Apakah Anda yakin ingin menghapus voucher
                                    <strong>{{ $code->code }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Kembali</button>
                                    <form action="{{ route('admin.discount.destroy', $code->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="editmodal{{ $code->id }}" tabindex="-1"
                        aria-labelledby="editModalLabel{{ $code->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $code->id }}">
                                        Edit Vocher</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.discount.update', $code->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="code{{ $code->id }}"
                                                class="form-label">Kode Vocher</label>
                                            <input type="text" name="code" class="form-control"
                                                value="{{ old('code') ?? $code->code }}"
                                                id="code{{ $code->id }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="discount_amount{{ $code->id }}"
                                                class="form-label">Jumlah Diskon</label>
                                            <input type="number" name="discount_amount"
                                                class="form-control"
                                                value="{{ old('discount_amount') ?? $code->discount_amount }}"
                                                id="discount_amount{{ $code->id }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="quantity{{ $code->id }}"
                                                class="form-label">Kuantitas</label>
                                            <input type="number" name="quantity"
                                                class="form-control"
                                                value="{{ old('quantity') ?? $code->quantity }}"
                                                id="quantity{{ $code->id }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="minimum_purchase{{ $code->id }}"
                                                class="form-label">Minimal Pembelian</label>
                                            <input type="number" name="minimum_purchase"
                                                class="form-control"
                                                value="{{ old('minimum_purchase') ?? $code->minimum_purchase }}"
                                                id="minimum_purchase{{ $code->id }}" required>
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
        </table>
    </div>
</div> --}}
