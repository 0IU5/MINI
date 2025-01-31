<?php

namespace App\Http\Controllers\admin;

use App\Models\Brand;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Mendapatkan semua kategori dan merek untuk dropdown
        $categories = Category::all();
        $brands = Brand::all();

        // Mulai query produk dengan relasi
        $products = Product::with('category', 'brand')
            ->when($request->input('search'), function ($query, $search) {
                // Filter berdasarkan nama produk
                $query->where('name_product', 'like', '%' . $search . '%');
            })
            ->when($request->input('category_id'), function ($query, $category_id) {
                // Filter berdasarkan kategori
                $query->where('category_id', $category_id);
            })
            ->when(isset($request->stock_product), function ($query) use ($request) {
                if ($request->stock_product == '1') {
                    $query->where('stock_product', '>', 0); // Produk dengan stok ada
                } elseif ($request->stock_product == '0') {
                    $query->where('stock_product', '=', 0); // Produk dengan stok habis
                }
            })
            ->when($request->input('price_product'), function ($query, $price_product) {
                // Filter berdasarkan harga (terendah ke tertinggi atau sebaliknya)
                if ($price_product == 'asc') {
                    $query->orderBy('price_product', 'asc');  // Urutkan harga dari yang terendah ke tertinggi
                } elseif ($price_product == 'desc') {
                    $query->orderBy('price_product', 'desc');  // Urutkan harga dari yang tertinggi ke terendah
                }
            })
            ->when($request->input('brand_id'), function ($query, $brand_id) {
                // Filter berdasarkan merek
                $query->where('brand_id', $brand_id);
            })
            ->when($request->input('created_at'), function ($query, $created_at) {
                // Filter berdasarkan tanggal (lama atau terbaru)
                if ($created_at == 'asc') {
                    $query->orderBy('created_at', 'asc');  // Urutkan berdasarkan tanggal pembuatan yang lebih lama
                } elseif ($created_at == 'desc') {
                    $query->orderBy('created_at', 'desc');  // Urutkan berdasarkan tanggal pembuatan yang lebih baru
                }
            })
            ->when($request->input('rating'), function ($query, $rating) {
                $query->whereHas('reviews', function ($q) use ($rating) {
                    $q->selectRaw('AVG(rating) as avg_rating') // Hitung rata-rata rating
                        ->groupBy('product_id')                // Kelompokkan per produk
                        ->havingRaw('AVG(rating) >= ? AND AVG(rating) < ?', [$rating, $rating + 1]);
                });
            })
            // Filter berdasarkan tanggal mulai dan tanggal akhir
            ->when($request->input('start_date'), function ($query, $start_date) {
                $query->whereDate('created_at', '>=', $start_date);
            })
            ->when($request->input('end_date'), function ($query, $end_date) {
                $query->whereDate('created_at', '<=', $end_date);
            })
            ->paginate(5);  // Menampilkan 5 produk per halaman

        // Mengirim data ke view
        return view('admin.products.index', compact('products', 'categories', 'brands'));
    }



    public function create()
    {

        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.products.create', compact('categories', 'brands'));
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_product' => 'required|string|max:255',
            'description_product' => 'required|string',
            'image_product' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'stock_product' => 'required|integer|min:0',
            'price_product' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
        ], [
            'name_product.required' => 'Nama produk wajib diisi.',
            'description_product.required' => 'Deskripsi produk wajib diisi.',
            'image_product.nullable' => 'Gambar produk wajib diisi.',
            'stock_product.required' => 'Stok produk wajib diisi.',
            'stock_product.min' => 'Nilai stok tidak boleh kurang dari 0',
            'price_product.required' => 'Harga produk wajib diisi.',
            'price_product.min' => 'Nilai stok tidak boleh kurang dari 0',
            'category_id.required' => 'Kategori produk wajib diisi.',
            'brand_id.required' => 'Merek produk wajib diisi.',
        ]);

        $imagePath = $request->file('image_product')
            ? $request->file('image_product')->store('products', 'public')
            : null;

        Product::create($request->except('image_product') + ['image_product' => $imagePath]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        // Mengambil produk dengan relasi category dan brand
        $product = Product::with(['category', 'brand'])->where('slug', $slug)->firstOrFail();

        // Menghitung rata-rata rating dan jumlah ulasan untuk produk
        $averageRating = Review::where('product_id', $product->id)->avg('rating');
        $reviewsCount = Review::where('product_id', $product->id)->count();

        // Menyisipkan data tambahan ke dalam objek produk
        $product->average_rating = $averageRating;
        $product->reviews_count = $reviewsCount;

        return view('admin.products.show', compact('product'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Validasi input
        $request->validate([
            'name_product' => 'required|string|max:255',
            'description_product' => 'required|string',
            'image_product' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'stock_product' => 'required|integer|min:0',
            'price_product' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
        ], [
            'name_product.required' => 'Nama produk wajib diisi.',
            'description_product.required' => 'Deskripsi produk wajib diisi.',
            'image_product.nullable' => 'Gambar produk wajib diisi.',
            'stock_product.required' => 'Stok produk wajib diisi.',
            'stock_product.min' => 'Nilai stok tidak boleh kurang dari 0',
            'price_product.required' => 'Harga produk wajib diisi.',
            'price_product.min' => 'Nilai stok tidak boleh kurang dari 0',
            'category_id.required' => 'Kategori produk wajib diisi.',
            'brand_id.required' => 'Merek produk wajib diisi.',
        ]);

        // Jika ada file gambar baru yang diunggah
        if ($request->hasFile('image_product')) {
            // Hapus gambar lama jika ada
            if ($product->image_product && Storage::disk('public')->exists($product->image_product)) {
                Storage::disk('public')->delete($product->image_product);
            }

            // Simpan gambar baru dan perbarui path-nya
            $imagePath = $request->file('image_product')->store('products', 'public');
            $product->image_product = $imagePath;
        }

        // Perbarui data produk lainnya
        $product->update($request->except('image_product'));

        // Simpan gambar baru jika ada
        if (isset($imagePath)) {
            $product->image_product = $imagePath;
            $product->save();
        }

        // Redirect kembali ke halaman produk
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image_product) {
            Storage::disk('public')->delete($product->image_product);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
