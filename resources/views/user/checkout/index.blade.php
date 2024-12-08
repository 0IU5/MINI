@extends('layouts.user')

@section('main')
    <style>
        .w-100 {
            overflow-y: scroll;
            /* Memungkinkan scroll jika konten melebihi 100px */
        }

        /* Menyembunyikan scrollbar */
        .w-100::-webkit-scrollbar {
            display: none;
        }
    </style>
    <div class="container-fluid">
        <!-- Menampilkan pesan sukses jika ada -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Card with Tabs -->
        <div class="card">
            <div class="card-header">
                <h5>Checkout</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('user.checkout.store') }}" method="POST">
                    @csrf

                    @php
                        $total = 0;
                    @endphp
                    @foreach ($carts as $cart)
                        @php
                            $total += $cart->product->price_product * $cart->quantity;
                        @endphp
                        <input type="hidden" name="product_id_quantity[{{ $cart->product->id }}]"
                            id="product_id_quantity_{{ $cart->id }}" value="{{ $cart->quantity }}">
                        <div class="border border-2 rounded-md p-4 mb-4">
                            <div class="mb-3">
                                <label for="nama_product_{{ $cart->id }}" class="form-label">Produk</label>
                                <input type="text" value="{{ $cart->product->name_product }}" id="product_id"
                                    class="form-control" readonly disabled>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah_{{ $cart->id }}" class="form-label">Jumlah</label>
                                <div class="flex gap-2 w-25 justify-content-between align-items-center">
                                    <button type="button"
                                        onclick="kurang('{{ $cart->id }}', {{ $cart->product->price_product }}, 'product_id_quantity_{{ $cart->id }}')"
                                        class="btn btn-sm btn-danger">-</button>
                                    <input type="number" class="form-control"id="jumlah_{{ $cart->id }}" required
                                        value="{{ $cart->quantity }}" onchange="updatePrice()">
                                    <button type="button"
                                        onclick="tambah({{ $cart->product->stock_product }}, '{{ $cart->id }}', {{ $cart->product->price_product }}, 'product_id_quantity_{{ $cart->id }}')"
                                        class="btn btn-sm btn-success">+</button>
                                </div>
                            </div>

                            <div class="mb-3">
                                <p>Harga Produk : Rp. {{ number_format($cart->product->price_product, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach

                    @if ($addresses->isEmpty())
                        <!-- Tampilkan form untuk menambah alamat jika belum ada data alamat -->
                        <div class="border border-2 rounded-md p-4 mb-4">
                            <h5>Tambah Alamat Pengiriman</h5>
                            <form action="{{ route('user.addresses.store') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="mark">Tanda Alamat</label>
                                    <input type="text" class="form-control" name="mark" id="mark" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="address">Alamat Lengkap</label>
                                    <input type="text" class="form-control" name="address" id="address" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="no_telepon">Nomor Telepon</label>
                                    <input type="text" class="form-control" name="no_telepon" id="no_telepon" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah Alamat</button>
                            </form>
                        </div>
                    @else
                        <!-- Jika ada alamat, tampilkan pilihan alamat pengiriman -->
                        <div class="border border-2 rounded-md p-4 mb-4">
                            <p class="h5">Pilih Alamat Pengiriman</p>
                            <div class="d-flex justify-content-start align-items-center gap-3 py-3">
                                <div class="info mx-3">
                                    <p class="h4 font-bold">{{ Auth::user()->name }}</p>
                                </div>

                                <!-- Garis Sumbu Y -->
                                <div class="border-start" style="min-height: 100px;"></div>

                                <div class="w-100" style="max-height: 150px; overflow-y: scroll;">
                                    @foreach ($addresses as $addr)
                                        <div
                                            class="d-flex justify-content-between align-items-center  my-2 p-3 border-2 rounded-lg">
                                            <!-- Info alamat -->
                                            <div class="flex-grow-1">
                                                <label class="form-check-label fs-3 fs-sm-6 fs-md-7 fs-lg-8"
                                                    for="addresses_{{ $addr->id }}" name="addresses_id">
                                                     <span class="border border-primary p-1 rounded-md ">{{ $addr->mark }}</span> - {{ $addr->address }} | {{ $addr->no_telepon }}
                                                </label>
                                            </div>

                                            <!-- Radio button di sebelah kanan -->
                                            <div>
                                                <input type="radio" class="form-check-input" name="addresses_id"
                                                    id="addresses_{{ $addr->id }}" value="{{ $addr->id }}"
                                                    required>
                                            </div>
                                        </div>
                                    @endforeach

                                    @error('addresses_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @endif




                    <div class="border">

                    </div>
                    <div class="border border-2 rounded-md p-4 mb-4">
                        <div class="mb-3">
                            <label for="diskon" class="form-label">Kode Diskon</label>
                            <div class="flex gap-2">
                                <input type="text" id="diskon" name="diskon" class="form-control">
                                <button type="button" onclick="updatePrice()"
                                    class="btn btn-sm btn-secondary">Pakai</button>
                            </div>
                            <div id="error_diskon" class="text-danger"></div>
                            <div id="success_diskon" class="text-success"></div>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="total_amount" id="total_amount" value="{{ $total }}">
                            <input type="hidden" name="grand_total_amount" id="grand_total_amount"
                                value="{{ $total }}">
                            <p>Total : Rp. <span id='total'>{{ number_format($total, 0, ',', '.') }}</span></p>
                            <p>Diskon : Rp. <span id="diskon_value">0</span></p>
                            <p>Harga Total : Rp. <span id="harga_total">{{ number_format($total, 0, ',', '.') }}</span>
                            </p>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('landing-page') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Fungsi untuk mengurangi jumlah produk
        function kurang(id, price, id_quantity) {
            const jumlah = document.getElementById("jumlah_" + id);
            if (jumlah.value > 1) {
                jumlah.value = parseInt(jumlah.value) - 1;
                document.getElementById(id_quantity).value = parseInt(document.getElementById(id_quantity).value) - 1;
                updatePrice();
            }
        }

        // Fungsi untuk menambah jumlah produk
        function tambah(max, id, price, id_quantity) {
            const jumlah = document.getElementById("jumlah_" + id);
            if (jumlah.value < max) {
                jumlah.value = parseInt(jumlah.value) + 1;
                document.getElementById(id_quantity).value = parseInt(document.getElementById(id_quantity).value) + 1;
                updatePrice();
            }
        }

        // Fungsi untuk memperbarui harga total dan diskon
        // Fungsi untuk memperbarui harga total dan diskon
async function updatePrice() {
    let total = 0;

    // Update harga total berdasarkan jumlah produk
    const carts = @json($carts); // Mengambil data carts dari Blade
    carts.forEach(cart => {
        const quantity = document.getElementById('jumlah_' + cart.id).value;
        const price = cart.product.price_product;
        total += price * quantity;
    });

    // Ambil kode diskon
    const discountCode = document.getElementById('diskon').value;
    const errorDiscount = document.getElementById('error_diskon');
    const successDiscount = document.getElementById('success_diskon');
    let discount = 0;

    if (discountCode) {
        // Lakukan request untuk validasi kode promo
        const response = await fetch('/api/validate-promo', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                code: discountCode
            })
        });

        const data = await response.json();

        if (data.status === 'success') {
            discount = parseInt(data.discount); // Set diskon berdasarkan response dari server
            successDiscount.textContent = 'Kode diskon berhasil digunakan!';
            errorDiscount.textContent = '';
        } else if (data.status === 'used') {
            successDiscount.textContent = '';
            errorDiscount.textContent = 'Kode promo sudah digunakan.';
        } else if (data.status === 'expired') {
            successDiscount.textContent = '';
            errorDiscount.textContent = 'Kode promo sudah habis.';
        } else {
            document.getElementById('diskon').value = ''; // Hapus kode diskon jika tidak valid
            successDiscount.textContent = '';
            errorDiscount.textContent = 'Kode promo tidak valid.';
        }
    }

    // Update harga total dan diskon
    const discountedTotal = total - discount < 0 ? 0 : total - discount;
    document.getElementById('diskon_value').textContent = discount.toLocaleString();
    document.getElementById('harga_total').textContent = discountedTotal.toLocaleString();
    document.getElementById('grand_total_amount').value = discountedTotal;
    document.getElementById('total_amount ').value = discountedTotal;
    document.getElementById('total').textContent = total;
}

    </script>
@endsection
