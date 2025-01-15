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
        $carts = Cart::where('user_id', Auth::id())->get();

        $categories = Category::paginate(6);
        $allCategories = Category::all();

        $products = Product::withCount('reviews') // Menghitung jumlah review
            ->withAvg('reviews as average_rating', 'rating') // Menghitung rata-rata rating
            ->withSum('productOrders as sold_count', 'quantity') // Menghitung jumlah produk terjual
            ->get();

        // Data untuk produk paling banyak dipesan
        $mostOrderedProducts = Product::withCount(['productOrders', 'reviews']) // Tambahkan reviews count
            ->withAvg('reviews as average_rating', 'rating')
            ->withSum('productOrders as sold_count', 'quantity') // Tambahkan jumlah produk terjual
            ->orderByDesc('product_orders_count')
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
            'products',
            'carts',
            'mostOrderedProducts',
            'mostPopularProduct1',
            'mostPopularProduct2',
            'mostPopularProduct3',
            'produkbaru1',
            'produkbaru2'
        ));
    }
}
