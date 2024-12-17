<!-- resources/views/categories/index.blade.php -->

@extends('layouts.admin')

@section('main')
    <div class="container mx-auto p-6">
        <div class="card w-full">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between items-center mb-3">
                <h1 class="text-2xl font-bold">Daftar Kategori</h1>
            </div>

            <div class="mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahmodal">
                    + Tambahkan Kategori
                </button>
            </div>

            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="table table-hover">
                    <thead class="bg-gray-100">
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $category->image_category) }}" alt="Gambar Kategori"
                                        class="img-thumbnail" style="width: 100px; height: auto;">
                                </td>
                                <td>{{ $category->name_category }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <button type="button" class="bg-yellow-500 text-white px-3 py-1 rounded" data-bs-toggle="modal"
                                            data-bs-target="#editmodal{{ $category->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="bg-red-500 text-white px-3 py-1 rounded" data-bs-toggle="modal"
                                            data-bs-target="#hapusmodal{{ $category->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal Edit -->
                            <div class="modal fade" id="editmodal{{ $category->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Kategori</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="edit_name_category" class="form-label">Nama
                                                        Kategori</label>
                                                    <input type="text" name="name_category" class="form-control"
                                                        value="{{ $category->name_category }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit_image_category" class="form-label">Gambar</label>
                                                    <input type="file" name="image_category" class="form-control">
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
                            <div class="modal fade" id="hapusmodal{{ $category->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus kategori
                                                <strong>{{ $category->name_category }}</strong>?
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
                    <h5 class="modal-title" id="formModalLabel">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form inside modal -->
                    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Input Nama Kategori -->
                        <div class="mb-3">
                            <label for="name_category" class="form-label">Nama Kategori</label>
                            <input type="text" name="name_category" class="form-control" id="name_category"
                                value="{{ old('name_category') }}">
                            @error('name_category')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Gambar Kategori -->
                        <div class="mb-3">
                            <label for="image_category" class="form-label">Gambar Kategori</label>
                            <input type="file" name="image_category" class="form-control" id="image_category"
                                accept="image/*">
                            @error('image_category')
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
@endsection
