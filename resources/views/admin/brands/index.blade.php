{{-- @extends('layouts.admin')

@section('main')
    <div class="container-fluid">
        <div class="container">
            <div class="card w-100">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Daftar Merek</h5>
                    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#tambahmodal">
                        Tambah Merek
                    </button>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0" style="width: 10%;">No</th>
                                    <th class="border-bottom-0" style="width: 30%;">Gambar</th>
                                    <th class="border-bottom-0" style="width: 30%;">Nama Merek</th>
                                    <th class="border-bottom-0" style="width: 20%;">Dibuat</th>
                                    <th class="border-bottom-0" style="width: 10%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $brand)
                                    <tr>
                                        <td class="border-bottom-0">{{ $loop->iteration }}</td>
                                        <td class="border-bottom-0">
                                            @if ($brand->image_brand)
                                                <img src="{{ asset('storage/' . $brand->image_brand) }}" alt="Gambar Brand"
                                                    class="img-thumbnail" style="width: 100px; height: auto;">
                                            @else
                                                <span class="text-gray-500">Tidak ada gambar</span>
                                            @endif
                                        </td>
                                        <td class="border-bottom-0">{{ $brand->name_brand ?? 'kosong' }}</td>
                                        <td class="border-bottom-0">{{ $brand->created_at->format('d F Y') ?? 'kosong' }}
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editmodal{{ $brand->id }}">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#hapusmodal{{ $brand->id }}">
                                                    Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editmodal{{ $brand->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Merek</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="edit_name_brand" class="form-label">Nama
                                                                Merek</label>
                                                            <input type="text" name="name_brand" class="form-control"
                                                                value="{{ $brand->name_brand }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="edit_image_brand" class="form-label">Gambar</label>
                                                            <input type="file" name="image_brand" class="form-control">
                                                            <small>Biarkan kosong jika tidak ingin mengubah gambar.</small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Hapus -->
                                    <div class="modal fade" id="hapusmodal{{ $brand->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.brands.destroy', $brand->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus merek
                                                        <strong>{{ $brand->name_brand }}</strong>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Tambah -->
        <div class="modal fade" id="tambahmodal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formModalLabel">Tambah Merek</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form inside modal -->
                        <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Input Nama Merek -->
                            <div class="mb-3">
                                <label for="name_brand" class="form-label">Nama Merek</label>
                                <input type="text" name="name_brand" class="form-control" id="name_brand"
                                    value="{{ old('name_brand') }}">
                                @error('name_brand')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Input Gambar Merek -->
                            <div class="mb-3">
                                <label for="image_brand" class="form-label">Gambar Merek</label>
                                <input type="file" name="image_brand" class="form-control" id="image_brand"
                                    accept="image/*">
                                @error('image_brand')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tombol Modal -->
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
                    var tambahModal = new bootstrap.Modal(document.getElementById('tambahmodal'));
                    tambahModal.show();
                });
            </script>
        @endif

    </div>
@endsection --}}


@extends('layouts.admin')

@section('main')
    <div class="container-fluid">
        <div class="container p-6">

            <div class="card w-full">

                <div class="card-body p-4">
                    <h5 class="card-title text-2xl font-bold mb-4">Daftar Merek</h5>
                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <!-- Pencarian -->
                                <form action="{{ route('admin.brands.index') }}" method="GET" class="d-inline-block">
                                    <div class="d-flex align-items-center">
                                        <input type="text" name="search"
                                            class="form-control me-2 border-lg border-[#5d85fa]" placeholder="Cari produk"
                                            value="{{ request('search') }}" style="width: 200px;">
                                        <button type="submit" class="btn btn-primary">Cari</button>
                                    </div>
                                </form>
                            </div>
                            <div class="flex items-center gap-4">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#tambahmodal">
                                    + Tambah Merek
                                </button>
                                <!-- Filter Sort By Date -->
                                <form id="filterForm" action="{{ route('admin.brands.index') }}" method="GET"
                                    class="d-inline-block">
                                    <div class="d-flex align-items-center">
                                        <select name="sort_order"
                                            class="bg-[#5d85fa] text-white border border-gray-600 rounded-lg py-2 px-3 w-full"
                                            onchange="this.form.submit();" id="sort_order">
                                            <option value="">Urutkan</option>
                                            <option value="terlama"
                                                {{ request('sort_order') == 'terlama' ? 'selected' : '' }}>
                                                Terlama</option>
                                            <option value="terbaru"
                                                {{ request('sort_order') == 'terbaru' ? 'selected' : '' }}>
                                                Terbaru</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                            <thead class="bg-[#5D87FF] text-white"> {{-- bg-gray-100 --}}
                                <tr>
                                    <th class="px-4 py-2 text-left">No</th>
                                    <th class="px-4 py-2 text-left">Logo Brand</th>
                                    <th class="px-4 py-2 text-left">Nama Brand</th>
                                    <th class="px-4 py-2 text-left">Dibuat</th>
                                    <th class="px-4 py-2 text-left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $brand)
                                    <tr class="hover:bg-gray-100  border-b">
                                        <td class="px-4 py-2">
                                            {{ $loop->iteration ?? '-' }}
                                        </td>
                                        <td class="px-4 py-2 flex items-center">
                                            @if ($brand->image_brand)
                                                <img src="{{ asset('storage/' . $brand->image_brand) }}"
                                                    alt="{{ $brand->name_brand }}" class="w-28 h-28 rounded-full mr-3">
                                            @else
                                                <img src="{{ asset('img/laptop.jpg') }}" alt="default"
                                                    class="w-28 h-28 rounded-full mr-3">
                                            @endif
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $brand->name_brand ?? '-' }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $brand->created_at->format('d F Y') ?? 'kosong' }}
                                        </td>
                                        <td class="px-4 py-2">
                                            <div class="flex items-center gap-2">
                                                <!-- Edit Button with Tooltip -->
                                                <div class="relative group">
                                                    <button type="button"
                                                        class="bg-yellow-500 rounded text-white flex items-center relative px-3 py-2 hover:bg-yellow-600 "
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editmodal{{ $brand->id }}">
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
                                                        class=" bg-red-500 rounded text-white flex items-center relative px-3 py-2 hover:bg-red-600 "
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#hapusmodal{{ $brand->id }}">
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

                                    <!-- Modal Hapus -->
                                    <div class="modal fade" id="hapusmodal{{ $brand->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.brands.destroy', $brand->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus merek
                                                        <strong>{{ $brand->name_brand }}</strong>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        @foreach ($brands as $brand)
            <div class="modal fade {{ $errors->any() && old('brand_id') == $brand->id ? 'show' : '' }}"
                id="editmodal{{ $brand->id }}" tabindex="-1" aria-hidden="true"
                style="{{ $errors->any() && old('brand_id') == $brand->id ? 'display: block;' : '' }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="brand_id" value="{{ $brand->id }}">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Merek</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="edit_name_brand" class="form-label">Nama
                                        Merek</label>
                                    <input type="text" name="name_brand" class="form-control"
                                        value="{{ $brand->name_brand }}">
                                    @if (old('brand_id') == $brand->id)
                                        @error('name_brand')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="edit_image_brand" class="form-label">Gambar</label>
                                    <input type="file" name="image_brand" class="form-control">
                                    <small>Biarkan kosong jika tidak ingin mengubah gambar.</small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Modal Tambah -->
        <div class="modal fade {{ $errors->any() && !old('brand_id') ? 'show' : '' }}" id="tambahmodal" tabindex="-1"
            aria-hidden="true" style="{{ $errors->any() && !old('brand_id') ? 'display: block;' : '' }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formModalLabel">Tambah Merek</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form inside modal -->
                        <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Input Nama Merek -->
                            <div class="mb-3">
                                <label for="name_brand" class="form-label">Nama Merek</label>
                                <input type="text" name="name_brand" class="form-control" id="name_brand">
                                @if (!old('brand_id'))
                                    @error('name_brand')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            <!-- Input Gambar Merek -->
                            <div class="mb-3">
                                <label for="image_brand" class="form-label">Gambar Merek</label>
                                <input type="file" name="image_brand" class="form-control" id="image_brand"
                                    accept="image/*">
                                @error('image_brand')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tombol Modal -->
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
                    @if (old('brand_id'))
                        // Jika terdapat error pada modal edit
                        var editModalId = 'editmodal{{ old('brand_id') }}';
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

    </div>
@endsection
