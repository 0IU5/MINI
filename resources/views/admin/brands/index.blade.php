@extends('layouts.admin')

@section('main')
    <div class="container mx-auto p-6">
        <div class="card w-full">
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

            <div class="flex justify-between items-center mb-3">
                <h1 class="text-2xl font-bold">Daftar Merk</h1>
            </div>
           
            <div class="mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahmodal">
                   + Tambahkan Merek
                </button>
            </div>

            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="table table-hover">
                    <thead class="bg-gray-100">
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Merek</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $brand)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($brand->image_brand)
                                        <img src="{{ asset('storage/' . $brand->image_brand) }}" alt="Gambar Brand"
                                            class="img-thumbnail" style="width: 100px; height: auto;">
                                    @else
                                        <span class="text-gray-500">Tidak ada gambar</span>
                                    @endif
                                </td>
                                <td>{{ $brand->name_brand }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <button type="button" class="bg-yellow-500 text-white px-3 py-1 rounded" data-bs-toggle="modal"
                                            data-bs-target="#editmodal{{ $brand->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="bg-red-500 text-white px-3 py-1 rounded" data-bs-toggle="modal"
                                            data-bs-target="#hapusmodal{{ $brand->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal Edit -->
                            <div class="modal fade" id="editmodal{{ $brand->id }}" tabindex="-1" aria-hidden="true">
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
                                                    <label for="edit_name_brand" class="form-label">Nama Merek</label>
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
                            <div class="modal fade" id="hapusmodal{{ $brand->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST">
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
@endsection
