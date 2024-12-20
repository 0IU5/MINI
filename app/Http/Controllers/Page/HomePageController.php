<?php

namespace App\Http\Controllers\Page;

use App\Models\Cart;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomePageController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil keranjang hanya untuk pengguna yang sedang login
        $carts = Cart::where('user_id', Auth::id())->get();

        // Mengambil kategori tanpa limit, menggunakan paginate
        $categories = Category::paginate(6); // Ganti limit dengan paginate untuk kategori

        // Mengambil produk dengan relasi reviews, menghitung rata-rata rating, jumlah review, dan penjualan
        $products = Product::with('reviews') // Pastikan relasi reviews dimuat
            ->get() // Ambil semua produk
            ->map(function ($product) {
                // Menghitung rata-rata rating produk
                $product->averageRating = $product->reviews->avg('rating') ?? 0; // Menggunakan 0 jika tidak ada rating
                $product->reviewsCount = $product->reviews->count(); // Menghitung jumlah review
                $product->salesCount = $product->sales_count ?? 0; // Ambil jumlah penjualan produk
                return $product;
            })
            ->sortByDesc('averageRating'); // Mengurutkan berdasarkan rating tertinggi

        // Menghitung jumlah review per produk berdasarkan product_id
        $reviewsCount = [];
        foreach ($products as $product) {
            $reviewsCount[$product->id] = Review::where('product_id', $product->id)->count();
        }

        // Mendapatkan produk dengan rating tertinggi dan review terbanyak dari setiap kategori
        $productsByCategory = [];
        foreach ($categories as $category) {
            $product = Product::where('category_id', $category->id)
                ->withCount('reviews') // Menghitung jumlah review untuk setiap produk
                ->withAvg('reviews as average_rating', 'rating') // Menghitung rata-rata rating
                ->orderByDesc('average_rating') // Urutkan berdasarkan rating tertinggi
                ->orderByDesc('reviews_count') // Urutkan berdasarkan jumlah review terbanyak
                ->first();

            if ($product) {
                $productsByCategory[] = $product;
            }
        }

        // Mendapatkan produk yang paling banyak dipesan
        $mostOrderedProducts = Product::withCount('productOrders') // Menghitung jumlah pesanan untuk setiap produk
            ->orderByDesc('product_orders_count') // Urutkan berdasarkan jumlah pesanan terbanyak
            ->withAvg('reviews as average_rating', 'rating') // Menghitung rata-rata rating
            ->take(3) // Ambil 6 produk yang paling banyak dipesan
            ->get();

        // Ambil produk sesuai urutan (1, 2, dan 3)
        $mostPopularProduct1 = $mostOrderedProducts->get(0);
        $mostPopularProduct2 = $mostOrderedProducts->get(1);
        $mostPopularProduct3 = $mostOrderedProducts->get(2);


        return view('landing-page', compact('categories', 'products', 'carts', 'productsByCategory', 'reviewsCount', 'mostOrderedProducts', 'mostPopularProduct1', 'mostPopularProduct2', 'mostPopularProduct3'));
    }
}
