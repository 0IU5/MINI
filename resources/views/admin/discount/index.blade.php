@extends('layouts.admin')

@section('main')
    <div class="container-fluid">
        <div class="container">
            <div class="card w-100">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <h5 class="card-title fw-semibold mb-4">Promo Diskon</h5>

                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#tambahmodal">
                                Tambah Diskon
                            </button>
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

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode Diskon</th>
                                            <th>Diskon</th>
                                            <th>Kuantitas</th>
                                            <th>Minimal Pembelian</th> <!-- Menambahkan kolom minimal pembelian -->
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
                                                <!-- Menampilkan minimal pembelian -->
                                                <td>
                                                    <button type="button" class="btn btn-warning btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editmodal{{ $code->id }}">
                                                        Edit
                                                    </button>

                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#hapusmodal{{ $code->id }}">
                                                        Hapus
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="editmodal{{ $code->id }}" tabindex="-1"
                                                aria-labelledby="editModalLabel{{ $code->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel{{ $code->id }}">
                                                                Edit Diskon</h5>
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
                                                                        class="form-label">Kode Diskon</label>
                                                                    <input type="text" name="code"
                                                                        class="form-control"
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
                                            <!-- Modal Hapus -->
                                            <div class="modal fade" id="hapusmodal{{ $code->id }}" tabindex="-1"
                                                aria-labelledby="hapusModalLabel{{ $code->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="hapusModalLabel{{ $code->id }}">Hapus Diskon</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah Anda yakin ingin menghapus diskon
                                                                <strong>{{ $code->code }}</strong>?
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Kembali</button>
                                                            <form action="{{ route('admin.discount.destroy', $code->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger">Hapus</button>
                                                            </form>
                                                        </div>
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
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="tambahmodal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Tambah Diskon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.discount.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="code" class="form-label">Kode Diskon</label>
                            <input type="text" name="code" class="form-control" id="code" required>
                        </div>
                        <div class="mb-3">
                            <label for="discount_amount" class="form-label">Jumlah Diskon</label>
                            <input type="number" name="discount_amount" class="form-control" id="discount_amount"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Kuantitas</label>
                            <input type="number" name="quantity" class="form-control" id="quantity" required>
                        </div>
                        <div class="mb-3">
                            <label for="minimum_purchase" class="form-label">Minimal Pembelian</label>
                            <input type="number" name="minimum_purchase" class="form-control" id="minimum_purchase"
                                required>
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
@endsection
