<?php

namespace App\Http\Controllers\Page;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Carousel;
use App\Models\PromoCode;
use Illuminate\Support\Facades\Auth;

class HomePageController extends Controller
{
    public function index(Request $request)
    {
        $carts = Cart::where('user_id', Auth::id())->get();
        $carousel = Carousel::all();

        // Mengambil hanya 5 voucher yang belum digunakan
        $promoCodes = PromoCode::whereDoesntHave('usedPromoCodes') // Memastikan voucher belum digunakan
            ->take(1)
            ->get();

        // Cek apakah ada promo codes
        $hasPromoCodes = $promoCodes->isNotEmpty();

        $categories = Category::paginate(6);
        $allCategories = Category::all();

        // Produk dengan penjualan terbanyak per kategori
        $products = Product::withCount('reviews')
            ->withAvg('reviews as average_rating', 'rating')
            ->withSum('productOrders as sold_count', 'quantity')
            ->get();

        // Ambil produk terlaris per kategori
        $topProducts = [];
        foreach ($allCategories as $category) {
            $topProduct = Product::where('category_id', $category->id)
                ->withCount('reviews')
                ->withAvg('reviews as average_rating', 'rating')
                ->withSum('productOrders as sold_count', 'quantity')
                ->orderByDesc('sold_count')
                ->first(); // Ambil produk dengan penjualan terbanyak per kategori
            $topProducts[$category->id] = $topProduct;
        }

        // Data untuk produk paling banyak dipesan
        $mostOrderedProducts = Product::withCount(['productOrders', 'reviews']) // Tambahkan reviews count
            ->withAvg('reviews as average_rating', 'rating')
            ->withSum('productOrders as sold_count', 'quantity') // Tambahkan jumlah produk terjual
            ->orderByDesc('sold_count')
            ->take(3)
            ->get();

        $mostPopularProduct1 = $mostOrderedProducts->get(0) ?? null;
        $mostPopularProduct2 = $mostOrderedProducts->get(1) ?? null;
        $mostPopularProduct3 = $mostOrderedProducts->get(2) ?? null;

        // Ambil produk terbaru
        $latestProducts = Product::withCount(['reviews']) // Menghitung jumlah review
            ->withAvg('reviews as average_rating', 'rating') // Menambahkan rata-rata rating
            ->withSum('productOrders as sold_count', 'quantity') // Tambahkan jumlah produk terjual
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();

        $produkbaru1 = $latestProducts->get(0) ?? null;
        $produkbaru2 = $latestProducts->get(1) ?? null;

        return view('landing-page', compact(
            'categories',
            'topProducts',  // Produk terlaris per kategori
            'carts',
            'mostOrderedProducts',
            'mostPopularProduct1',
            'mostPopularProduct2',
            'mostPopularProduct3',
            'produkbaru1',
            'produkbaru2',
            'promoCodes',
            'hasPromoCodes',
            'carousel'  // Pastikan carousel juga diteruskan ke tampilan
        ));
    }
}
