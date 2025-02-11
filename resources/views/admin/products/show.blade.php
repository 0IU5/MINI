    @extends('layouts.admin')

    @section('main')
        <div class="container-fluid">
            <div class="container p-6">
                <div class="w-full">

                    <div class="bg-white p-4 rounded-lg  shadow-sm border relative mb-10">
                        <!-- Judul -->
                        <h1 class="text-2xl font-bold text-center mb-4 ">Detail Produk</h1>

                        <!-- Gambar Produk (Awalnya disembunyikan) -->
                        <div class="relative mb-4 hidden flex justify-center transition-all duration-500 opacity-0 transform scale-75"
                            id="productImageContainer">
                            @if ($product->image_product)
                                <img src="{{ asset('storage/' . $product->image_product) }}" alt="{{ $product->name_product }}"
                                    class="w-[50%] h-[50%] object-cover rounded-lg" id="productImage"
                                    data-height="{{ $product->image_product_height }}">
                            @else
                                <img src="{{ asset('img/laptop.jpg') }}" alt="Default"
                                    class="w-[50%] h-[50%] object-cover rounded-lg" id="productImage">
                            @endif
                        </div>

                        <!-- Tombol Dropdown untuk Menampilkan Gambar (Di tengah bawah card) -->
                        <div class="absolute bottom-[-50px] left-1/2 transform -translate-x-1/2 mb-4  rounded-full ">
                            <button id="dropdownButton"
                                class="bg-gray-800 text-white p-3 rounded-full shadow-lg hover:bg-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                    class="w-5 h-5" id="dropdownIcon">
                                    <!-- Ikow-5 h-5 n dropdown default (panah turun) -->
                                    <path id="dropdownPath" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Gambar dan Detail Produk -->
                    <div class="container mx-auto px-4">
                        <div class="grid grid-cols-1 gap-6">
                            <!-- Kolom Keterangan Produk dengan lebar penuh -->
                            <div class="bg-white p-6 rounded-lg border w-full">

                                <!-- Nama Produk -->
                                <h3 class="text-3xl font-extrabold text-gray-800 mb-4">
                                    {{ $product->name_product ?? '-' }}
                                </h3>

                                <!-- Rating dan Reviews -->
                                <div class="flex items-center space-x-2 mb-4">
                                    <!-- Bintang Rating -->
                                    <div class="flex items-center space-x-1">
                                        @for ($i = 0; $i < 5; $i++)
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="w-6 h-6 {{ $i < round($product->average_rating) ? 'text-yellow-400' : 'text-gray-300' }}"
                                                viewBox="0 0 24 24" stroke="none">
                                                <path
                                                    d="M12 17.75l-6.16 3.24a1 1 0 0 1-1.45-1.05l1.17-7.23L1.31 8.7a1 1 0 0 1 .56-1.72l7.29-.61L12 .25l3.03 6.12 7.29.61a1 1 0 0 1 .56 1.72l-4.74 4.24 1.17 7.23a1 1 0 0 1-1.45 1.05L12 17.75z">
                                                </path>
                                            </svg>
                                        @endfor
                                    </div>
                                    <!-- Total Reviews -->
                                    <span class="text-lg text-slate-600">{{ $product->reviews_count ?? 0 }} reviews</span>
                                </div>

                                <!-- Harga Produk -->
                                <div class="flex items-center space-x-2 mb-2">
                                    <span class="text-xl font-semibold text-gray-800">Harga:</span>
                                    <span class="text-2xl font-bold text-blue-500">Rp
                                        {{ number_format($product->price_product, 0, ',', '.') }}</span>
                                </div>

                                <!-- Informasi Produk: Stok, Kategori, Brand -->
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-2">
                                    <!-- Stok Produk -->
                                    <div>
                                        <div class="text-sm font-semibold text-gray-500 mb-1">Stok</div>
                                        <div class="flex border rounded-md p-3 items-center">
                                            <div
                                                class="w-5 h-5 rounded-full mr-2
                                                {{ $product->stock_product == 0
                                                    ? 'bg-gray-500'
                                                    : ($product->stock_product <= 5
                                                        ? 'bg-red-600'
                                                        : ($product->stock_product <= 10
                                                            ? 'bg-yellow-500'
                                                            : 'bg-green-500')) }}">
                                            </div>
                                            <span class="text-lg font-semibold text-gray-700">
                                                {{ $product->stock_product == 0 ? 'Habis' : $product->stock_product . ' unit' }}
                                            </span>
                                            @if ($product->stock_product > 0 && $product->stock_product < 5)
                                                <span class="text-red-600 font-semibold ml-2">Stok Menipis!</span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Kategori Produk -->
                                    <div>
                                        <div class="text-sm font-semibold text-gray-500 mb-1">Kategori</div>
                                        <div class="border rounded-md p-3 text-center">
                                            <span
                                                class="text-lg font-medium text-gray-700">{{ $product->category->name_category }}</span>
                                        </div>
                                    </div>

                                    <!-- Brand Produk -->
                                    <div>
                                        <div class="text-sm font-semibold text-gray-500 mb-1">Brand</div>
                                        <div class="border rounded-md p-3 text-center">
                                            <span
                                                class="text-lg font-medium text-gray-700">{{ $product->brand->name_brand }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Deskripsi Produk -->
                                <div>
                                    <div class="text-sm font-semibold text-gray-500 mb-1">Deskripsi</div>
                                    <div class="border rounded-md p-4">
                                        <p class="text-lg text-gray-700">{!! nl2br(e($product->description_product)) !!}</p>
                                    </div>
                                </div>
                                <!-- Tombol Kembali -->
                                <div class="mt-4 text-start">
                                    <a href="{{ route('admin.products.index') }}"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow-md">
                                        Kembali
                                    </a>
                                </div>
                            </div>
                            <!-- Ulasan Produk -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-4">
                                @forelse ($reviews as $review)
                                    <article class="p-6 text-base bg-white rounded-lg border border-gray-200 overflow-hidden">
                                        <footer class="flex justify-between items-center mb-2">
                                            <div class="flex items-center">
                                                <div class="flex items-center mr-3 gap-3 text-sm text-gray-900 font-semibold">
                                                    @if ($review->user && $review->user->image)
                                                        <img src="{{ asset('storage/' . $review->user->image) }}"
                                                            alt="Profile Picture" class="mr-2 w-8 h-8 rounded-full">
                                                    @else
                                                        <img src="{{ asset('style/src/assets/images/profile/user-1.jpg') }}"
                                                            alt="Default Profile Picture" class="mr-2 w-8 h-8 rounded-full">
                                                    @endif
                                                    <div>
                                                        {{ $review->user->name ?? 'Pengguna Tidak Diketahui' }}
                                                        <div class="flex items-center space-x-1 mb-2">
                                                            @for ($i = 0; $i < 5; $i++)
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                                    class="w-4 h-4 {{ $i < ($review->rating ?? 0) ? 'text-yellow-400' : 'text-gray-300' }}"
                                                                    viewBox="0 0 24 24" stroke="none">
                                                                    <path
                                                                        d="M12 17.75l-6.16 3.24a1 1 0 0 1-1.45-1.05l1.17-7.23L1.31 8.7a1 1 0 0 1 .56-1.72l7.29-.61L12 .25l3.03 6.12 7.29.61a1 1 0 0 1 .56 1.72l-4.74 4.24 1.17 7.23a1 1 0 0 1-1.45 1.05L12 17.75z">
                                                                    </path>
                                                                </svg>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="text-sm text-gray-600">
                                                    <time datetime="{{ $review->created_at }}">
                                                        {{ $review->created_at->diffForHumans() }}
                                                    </time>
                                                </p>
                                            </div>
                                        </footer>

                                        <!-- Bagian komentar dengan efek "Selengkapnya" -->
                                        <div x-data="{ expanded: false }" class="block">
                                            <p class="text-gray-500">
                                                @if (strlen($review->comment) > 50)
                                                    <span x-show="!expanded" x-cloak>{{ Str::limit($review->comment, 50) }}...</span>
                                                    <span x-show="expanded" x-cloak>{{ $review->comment }}</span>
                                                    <button @click="expanded = !expanded" class="text-blue-500 text-sm">
                                                        <span x-show="!expanded">Selengkapnya</span>
                                                        <span x-show="expanded">Tutup</span>
                                                    </button>
                                                @else
                                                    {{ $review->comment }}
                                                @endif
                                            </p>
                                        </div>
                                    </article>
                                @empty
                                    <p class="text-gray-600">Tidak ada komentar</p>
                                @endforelse
                            </div>

                            <!-- Tambahkan Alpine.js jika belum ada -->
                            <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.2/dist/cdn.min.js" defer></script>

                            <!-- CSS untuk menghindari overflow -->
                            <style>
                                article {
                                    overflow: hidden; /* Mencegah overflow */
                                }

                                .text-gray-500 {
                                    word-wrap: break-word; /* Memastikan kata panjang terputus */
                                }
                            </style>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- JavaScript untuk Menampilkan Gambar dan Mengubah Ikon dengan Transisi -->
        <script>
            // Fungsi untuk toggle visibility gambar dan mengubah ikon dropdown
            document.getElementById('dropdownButton').addEventListener('click', function() {
                const imageContainer = document.getElementById('productImageContainer');
                const dropdownIcon = document.getElementById('dropdownIcon');
                const dropdownPath = document.getElementById('dropdownPath');

                // Tampilkan gambar dengan transisi
                imageContainer.classList.toggle('hidden');
                imageContainer.classList.toggle('opacity-0');
                imageContainer.classList.toggle('opacity-100');
                imageContainer.classList.toggle('scale-75');
                imageContainer.classList.toggle('scale-100');

                // Cek jika gambar sedang ditampilkan
                const isImageVisible = !imageContainer.classList.contains('hidden');

                // Ubah ikon berdasarkan status gambar
                if (isImageVisible) {
                    // Ganti ikon ke dropup (panah ke atas)
                    dropdownPath.setAttribute('d', 'M19 15l-7-7-7 7'); // Panah ke atas
                } else {
                    // Kembalikan ikon ke dropdown (panah ke bawah)
                    dropdownPath.setAttribute('d', 'M19 9l-7 7-7-7'); // Panah ke bawah
                }
            });

            // Menutup dropdown saat klik di luar area dropdown
            document.addEventListener('click', function(event) {
                const dropdownButton = document.getElementById('dropdownButton');
                const imageContainer = document.getElementById('productImageContainer');

                // Cek jika klik bukan di dropdown atau tombol
                if (!dropdownButton.contains(event.target) && !imageContainer.contains(event.target)) {
                    imageContainer.classList.add('hidden');
                    const dropdownPath = document.getElementById('dropdownPath');
                    dropdownPath.setAttribute('d', 'M19 9l-7 7-7-7'); // Kembalikan ikon ke posisi default (dropdown)
                }
            });
        </script>
    @endsection
