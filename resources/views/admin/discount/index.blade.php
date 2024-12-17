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
                <h1 class="text-2xl font-bold">Kode Voucher</h1>
            </div>

            <div class="mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahmodal">
                    + Tambahkan Vocher
                </button>
            </div>

            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="table table-hover">
                    <thead class="bg-gray-100"> 
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
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#usermodal{{ $code->id }}">
                                            Lihat Pengguna
                                        </button>
                                    @else
                                        Belum digunakan
                                    @endif
                                </td>
                                <td>
                                    <!-- Tombol Edit -->
                                    <button type="button" class="bg-yellow-500 text-white px-3 py-1 rounded"
                                        data-bs-toggle="modal" data-bs-target="#editmodal{{ $code->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <!-- Tombol Hapus -->
                                    <button type="button" class="bg-red-500 text-white px-3 py-1 rounded"
                                        data-bs-toggle="modal" data-bs-target="#hapusmodal{{ $code->id }}">
                                        <i class="fas fa-trash"></i>
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
                                                Pengguna Yang Sudah Menggunakan Voucher {{ $code->code }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" style="color: black;">
                                            @if ($code->users->count() > 0)
                                                <ul>
                                                    @foreach ($code->users as $user)
                                                        <li><strong>Nama:</strong>{{ $user->name }} <br>
                                                            <strong>Email:</strong> ({{ $user->email }}) <br> <br>
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
                                            <h5 class="modal-title" id="hapusModalLabel{{ $code->id }}">Hapus
                                                Vocher</h5>
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
                                            <form action="{{ route('admin.discount.destroy', $code->id) }}" method="POST">
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
                                            <form action="{{ route('admin.discount.update', $code->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="code{{ $code->id }}" class="form-label">Kode
                                                        Vocher</label>
                                                    <input type="text" name="code" class="form-control"
                                                        value="{{ old('code') ?? $code->code }}"
                                                        id="code{{ $code->id }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="discount_amount{{ $code->id }}"
                                                        class="form-label">Jumlah Diskon</label>
                                                    <input type="number" name="discount_amount" class="form-control"
                                                        value="{{ old('discount_amount') ?? $code->discount_amount }}"
                                                        id="discount_amount{{ $code->id }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="quantity{{ $code->id }}"
                                                        class="form-label">Kuantitas</label>
                                                    <input type="number" name="quantity" class="form-control"
                                                        value="{{ old('quantity') ?? $code->quantity }}"
                                                        id="quantity{{ $code->id }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="minimum_purchase{{ $code->id }}"
                                                        class="form-label">Minimal Pembelian</label>
                                                    <input type="number" name="minimum_purchase" class="form-control"
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
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="tambahmodal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
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
                                value="{{ old('code') }}">
                            @error('code')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Jumlah Diskon -->
                        <div class="mb-3">
                            <label for="discount_amount" class="form-label">Jumlah Diskon</label>
                            <input type="number" name="discount_amount" class="form-control" id="discount_amount"
                                value="{{ old('discount_amount') }}">
                            @error('discount_amount')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kuantitas -->
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Kuantitas</label>
                            <input type="number" name="quantity" class="form-control" id="quantity"
                                value="{{ old('quantity') }}">
                            @error('quantity')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Minimal Pembelian -->
                        <div class="mb-3">
                            <label for="minimum_purchase" class="form-label">Minimal Pembelian</label>
                            <input type="number" name="minimum_purchase" class="form-control" id="minimum_purchase"
                                value="{{ old('minimum_purchase') }}">
                            @error('minimum_purchase')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
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
                var tambahModal = new bootstrap.Modal(document.getElementById('tambahmodal'));
                tambahModal.show();
            });
        </script>
    @endif
@endsection
