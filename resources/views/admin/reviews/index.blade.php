@extends('layouts.admin')

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
                    <h5 class="card-title fw-semibold mb-4">Semua Ulasan</h5>
                    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addReviewModal">
                        Tambah Ulasan
                    </button>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">No</th>
                                    <th class="border-bottom-0">User</th>
                                    <th class="border-bottom-0">Product</th>
                                    <th class="border-bottom-0">Rating</th>
                                    <th class="border-bottom-0">Komentar</th>
                                    <th class="border-bottom-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $review)
                                    <tr>
                                        <td class="border-bottom-0">{{ $loop->iteration }}</td>
                                        <td class="border-bottom-0">{{ $review->user->name }}</td>
                                        <td class="border-bottom-0">{{ $review->product->name_product }}</td>
                                        <td class="border-bottom-0">{{ $review->rating }}</td>
                                        <td class="border-bottom-0">{{ $review->comment }}</td>
                                        <td class="border-bottom-0">
                                            <!-- Button untuk membuka modal edit ulasan -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editReviewModal{{ $review->id }}">
                                                Edit
                                            </button>

                                            <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit Ulasan -->
                                    <div class="modal fade" id="editReviewModal{{ $review->id }}" tabindex="-1"
                                        aria-labelledby="editReviewModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editReviewModalLabel">Edit Ulasan untuk
                                                        Produk: {{ $product->name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form
                                                        action="{{ route('admin.reviews.update', ['review' => $review->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')

                                                        <!-- Produk Dropdown -->
                                                        <div class="mb-3">
                                                            <label for="product_id">Produk</label>
                                                            <select name="product_id" id="product_id" class="form-select"
                                                                required>
                                                                <!-- Menandai produk yang sudah dipilih -->

                                                                @foreach ($products as $product)
                                                                    <option value="{{ $product->id }}"
                                                                        @if ($product->id == $review->product->id) selected @endif>
                                                                        {{ $product->name_product }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <!-- Pengguna Dropdown -->
                                                        <div class="mb-3">
                                                            <label for="user_id">Pengguna</label>
                                                            <select name="user_id" id="user_id" class="form-select"
                                                                required>
                                                                <!-- Menandai pengguna yang sudah dipilih -->

                                                                @foreach ($users as $user)
                                                                    <option value="{{ $user->id }}"
                                                                        @if ($user->id == $review->user->id) selected @endif>
                                                                        {{ $user->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <!-- Rating Dropdown -->
                                                        <div class="mb-3">
                                                            <label for="rating" class="form-label">Rating</label>
                                                            <select name="rating" id="rating" class="form-select"
                                                                required>
                                                                <option value="" disabled>Pilih Rating</option>
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <option value="{{ $i }}"
                                                                        @if ($review->rating == $i) selected @endif>
                                                                        {{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>

                                                        <!-- Komentar Textarea -->
                                                        <div class="mb-3">
                                                            <label for="comment" class="form-label">Komentar</label>
                                                            <textarea name="comment" id="comment" class="form-control" rows="5" required>{{ $review->comment }}</textarea>
                                                        </div>

                                                        <!-- Submit dan Close -->
                                                        <button type="submit" class="btn btn-primary">Simpan
                                                            Perubahan</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
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
    <div class="modal fade" id="addReviewModal" tabindex="-1" aria-labelledby="addReviewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addReviewModalLabel">Tambah Ulasan untuk Produk: {{ $product->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.reviews.store', ['product' => $product->id]) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="product_id">Produk</label>
                            <select name="product_id" id="product_id" class="form-select" required>
                                <option value="">Pilih produk</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name_product }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="user_id">Pengguna</label>
                            <select name="user_id" id="user_id" class="form-select" required>
                                <option value="">Pilih pengguna</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <select name="rating" id="rating" class="form-select" required>
                                <option value="" disabled selected>Pilih Rating</option>
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="comment" class="form-label">Komentar</label>
                            <textarea name="comment" id="comment" class="form-control" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- <div class="container-fluid">
    <div class="container">
        <div class="card w-100">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Semua Order</h5>
                <div class="table-responsive">

                </div>
            </div>
        </div>
    </div>
</div> --}}
