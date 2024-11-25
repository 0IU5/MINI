@extends('layouts.app')

@section('main')
    <div class="card">
        <div class="container p-3">

            <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#tambahmodal">
                tambah produk
            </button>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->name_product }}</td>
                                <td>{{ Str::limit($product->description_product, 50) }}</td>
                                <td>Rp {{ number_format($product->price_product, 0, ',', '.') }}</td>
                                <td>{{ $product->category->name_category }}</td>
                                <td>{{ $product->stock_product }}</td>
                                <td>
                                    @if ($product->image_product)
                                        <img src="{{ asset('storage/' . $product->image_product) }}" alt="Gambar Produk"
                                            class="img-thumbnail mt-2" style="max-width: 100px;">
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editmodal" onclick="openEditModal('{{ $product->id }}')">
                                        Edit
                                    </button>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            <div class="modal fade" id="editmodal" tabindex="-1"
                                aria-labelledby="editModalLabel{{ $product->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content" style="padding: 20px;">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $product->id }}">Edit Produk</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" style="max-height: 80vh; overflow-y: auto; padding: 20px;">
                                            <!-- Form inside modal -->
                                            <form action="{{ route('products.update', $product->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <!-- Baris Pertama: Nama Produk dan Kategori -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="name_product" class="form-label">Nama Produk</label>
                                                            <input type="text" name="name_product"
                                                                class="form-control rounded-lg" id="name_product"
                                                                value="{{ old('name_product') ?? $product->name_product }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="category_id" class="form-label">Kategori</label>
                                                            <select name="category_id" class="form-control rounded-lg"
                                                                id="category_id" required>
                                                                <option value="">Pilih Kategori</option>
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}"
                                                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                                        {{ $category->name_category }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Baris Kedua: Stok dan Harga -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="stock_product" class="form-label">Stok
                                                                Produk</label>
                                                            <input type="number" name="stock_product"
                                                                class="form-control rounded-lg" id="stock_product"
                                                                value="{{ old('stock_product') ?? $product->stock_product }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="price_product" class="form-label">Harga
                                                                Produk</label>
                                                            <input type="number" name="price_product"
                                                                class="form-control rounded-lg" id="price_product"
                                                                value="{{ old('price_product') ?? $product->price_product }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Baris Ketiga: Deskripsi Produk -->
                                                <div class="mb-3">
                                                    <label for="description_product" class="form-label">Deskripsi
                                                        Produk</label>
                                                    <textarea name="description_product" class="form-control rounded-lg" id="description_product" rows="5" required>{{ old('description_product') ?? $product->description_product }}</textarea>
                                                </div>

                                                <!-- Baris Keempat: Gambar Produk -->
                                                <div class="mb-3">
                                                    <label for="image_product" class="form-label">Gambar Produk</label>
                                                    <input type="file" name="image_product"
                                                        class="form-control rounded-lg" id="image_product">
                                                    @if ($product->image_product)
                                                        <img src="{{ asset('storage/' . $product->image_product) }}"
                                                            alt="Gambar Produk" class="img-thumbnail mt-2"
                                                            style="max-width: 200px;">
                                                    @endif
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Produk</button>
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

    <div class="modal fade" id="tambahmodal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="padding: 20px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Edit Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="max-height: 80vh; overflow-y: auto; padding: 10px;">
                    <!-- Form inside modal -->
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf


                        <!-- Baris Pertama: Nama Produk dan Kategori -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name_product" class="form-label">Nama Produk</label>
                                    <input type="text" name="name_product" class="form-control rounded-lg"
                                        id="name_product" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Kategori</label>
                                    <select name="category_id" class="form-control rounded-lg" id="category_id" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name_category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Baris Kedua: Stok dan Harga -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="stock_product" class="form-label">Stok Produk</label>
                                    <input type="number" name="stock_product" class="form-control rounded-lg"
                                        id="stock_product" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="price_product" class="form-label">Harga Produk</label>
                                    <input type="number" name="price_product" class="form-control rounded-lg"
                                        id="price_product" required>
                                </div>
                            </div>
                        </div>

                        <!-- Baris Ketiga: Deskripsi Produk -->
                        <div class="mb-3">
                            <label for="description_product" class="form-label">Deskripsi Produk</label>
                            <textarea name="description_product" class="form-control rounded-lg" id="description_product" rows="5"
                                required></textarea>
                        </div>

                        <!-- Baris Keempat: Gambar Produk -->
                        <div class="mb-3">
                            <label for="image_product" class="form-label">Gambar Produk</label>
                            <input type="file" name="image_product" class="form-control " id="image_product">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan Produk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
