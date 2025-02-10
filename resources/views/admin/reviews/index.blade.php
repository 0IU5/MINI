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
                            <h1 class="text-3xl font-semibold text-gray-800">Daftar Ulasan</h1>
                            <nav class="mt-2">
                                <ol class="flex text-sm text-gray-600">
                                    <li><a href="{{ route('dashboard.index') }}" class="hover:text-blue-500">Dashboard</a>
                                    </li>
                                    <li class="mx-2">/</li>
                                    <li><a href="{{ route('admin.reviews.index') }}" class="hover:text-blue-500"> Ulasan</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <!-- Kanan: Gambar (Vector) -->
                        <div class="hidden md:block">
                            <img src="{{ asset('img/img-banner/ulasan.png') }}" alt="Gambar Banner"
                                class="w-44 h-44 object-contain">
                        </div>
                    </div>
                </div>
                <!-- Card -->
                <div class="w-full md:w-1/4 bg-gradient-to-r from-blue-800 to-blue-400 p-2 rounded-lg shadow-md">
                    <div class="flex flex-col items-center">
                        <!-- Ikon di atas dengan latar belakang putih dan tinggi penuh -->
                        <div class="bg-white p-4 rounded-md h-16 w-16 flex justify-center items-center w-full">
                            <i class="fa-solid fa-comments text-3xl text-blue-600"></i>
                        </div>
                        <!-- Keterangan di bawah ikon -->
                        <div class="mt-4 text-center">
                            <h2 class="text-xl font-medium text-white">Jumlah Ulasan</h2>
                            <p class="text-2xl font-semibold text-white mt-2">{{ $reviews->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card w-full">

                <div class="card-body p-4">
                    <div>
                        <form action="{{ route('admin.reviews.index') }}" method="GET" id="filterForm">
                            <div class="flex justify-between items-center mb-4">
                                <div class="d-flex align-items-center">
                                    <!-- Pencarian -->
                                    <input type="text" name="search"
                                        class="form-control me-2 border-lg border-[#5d85fa]"
                                        placeholder="Cari" value="{{ request('search') }}"
                                        style="width: 200px;">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </div>
                                <!-- Trigger Modal Filter -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#filterModal">Filter</button>
                            </div>

                            <!-- Modal Filter -->
                            <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-[#5d85fa] text-white">
                                            <h5 class="modal-title" id="filterModalLabel">Filter Review</h5>
                                            <button type="button" class="close text-white" data-bs-dismiss="modal"
                                                aria-label="Close">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            @if (session('error'))
                                                <div class="alert alert-danger">
                                                    {{ session('error') }}
                                                </div>
                                            @endif

                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <!-- Filter Produk -->
                                                <div>
                                                    <label for="product_id" class="block">Produk</label>
                                                    <select name="product_id" class="form-select">
                                                        <option value="">Pilih</option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->id }}"
                                                                {{ request('product_id') == $product->id ? 'selected' : '' }}>
                                                                {{ $product->name_product }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Filter Rating -->
                                                <div>
                                                    <label for="rating" class="block">Rating</label>
                                                    <select name="rating" class="form-select">
                                                        <option value="">Pilih</option>
                                                        <option value="5"
                                                            {{ request('rating') == '5' ? 'selected' : '' }}>5 Bintang
                                                        </option>
                                                        <option value="4"
                                                            {{ request('rating') == '4' ? 'selected' : '' }}>4 Bintang
                                                        </option>
                                                        <option value="3"
                                                            {{ request('rating') == '3' ? 'selected' : '' }}>3 Bintang
                                                        </option>
                                                        <option value="2"
                                                            {{ request('rating') == '2' ? 'selected' : '' }}>2 Bintang
                                                        </option>
                                                        <option value="1"
                                                            {{ request('rating') == '1' ? 'selected' : '' }}>1 Bintang
                                                        </option>
                                                    </select>
                                                </div>

                                                <!-- Filter Urutkan -->
                                                <div>
                                                    <label for="created_at" class="block">Urutkan</label>
                                                    <select name="created_at" class="form-select">
                                                        <option value="">Pilih</option>
                                                        <option value="asc"
                                                            {{ request('created_at') == 'asc' ? 'selected' : '' }}>Lama
                                                        </option>
                                                        <option value="desc"
                                                            {{ request('created_at') == 'desc' ? 'selected' : '' }}>Terbaru
                                                        </option>
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
                                                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Terapkan Filter</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <a href="{{ route('admin.reviews.index') }}?reset=true"
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




                    <div class="table-responsive">
                        <table class="min-w-full bg-white rounded-lg overflow-hidden">
                            <thead class="bg-[#5D87FF] text-white">
                                <tr>
                                    <th class="px-4 py-2 text-left">No</th>
                                    <th class="px-4 py-2 text-left">Pengguna</th>
                                    <th class="px-4 py-2 text-left">Produk</th>
                                    <th class="px-4 py-2 text-left">Rating</th>
                                    <th class="px-4 py-2 text-left">Komentar</th>
                                    <th class="px-4 py-2 text-left">Dibuat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reviews as $review)
                                    <tr class="hover:bg-gray-100 border-b">
                                        <td class="px-4 py-2">{{ $loop->iteration ?? '-' }}</td>
                                        <td class="px-4 py-2 flex items-center">{{ $review->user->name }}</td>
                                        <td class="px-4 py-2">{{ $review->product->name_product }}</td>
                                        <td class="px-4 py-2">{{ $review->rating }}</td>
                                        <td class="px-4 py-2">
                                            @if (strlen($review->comment) > 50)
                                                <span>{{ substr($review->comment, 0, 50) }}...</span>
                                                <button class="text-blue-500 hover:underline" onclick="showCommentModal('{{ $review->comment }}')">Lihat</button>
                                            @else
                                                {{ $review->comment }}
                                            @endif
                                        </td>
                                        <td class="px-4 py-2">{{ $review->created_at->format('d F Y') ?? 'kosong' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="h-64">
                                            <div class="bg-white shadow-sm rounded-lg p-4 text-center flex flex-col justify-center items-center">
                                                <img src="{{ asset('img/empty-data.png') }}" alt=" Tidak Ditemukan" class="w-64 h-64">
                                                <p class="text-lg text-gray-600 font-medium">Tidak ada ulasan</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $reviews->appends(request()->query())->links() }}
                        </div>

                    </div>

                    <!-- Modal -->
                    <div id="commentModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                            <h2 class="text-xl font-bold mb-4">Komentar Lengkap</h2>
                            <p id="fullComment" class="text-gray-700"></p>
                            <div class="mt-4 flex justify-end">
                                <button onclick="closeModal()" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Tutup</button>
                            </div>
                        </div>
                    </div>

                    <script>
                        function showCommentModal(comment) {
                            document.getElementById("fullComment").innerText = comment;
                            document.getElementById("commentModal").classList.remove("hidden");
                        }

                        function closeModal() {
                            document.getElementById("commentModal").classList.add("hidden");
                        }
                    </script>



                </div>

            </div>
        </div>
    </div>
@endsection


{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addReviewModal">
        + Tambah Ulasan
    </button>
    <div class="table-responsive">
        <table class="table text-nowrap mb-0 align-middle">
            <thead class="text-dark fs-4">
                <tr>
                    <th class="border-bottom-0">No</th>
                    <th class="border-bottom-0">Pengguna</th>
                    <th class="border-bottom-0">Produk</th>
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
    </div> --}}
