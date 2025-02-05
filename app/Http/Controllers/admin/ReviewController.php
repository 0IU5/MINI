<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil parameter pencarian dan filter produk
        $search = $request->input('search');
        $productId = $request->input('product_id');
        $rating = $request->input('rating');
        $createdAt = $request->input('created_at');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Validasi jika tanggal akhir kurang dari tanggal awal
        if ($request->filled('start_date') && $request->filled('end_date')) {
            if ($request->start_date > $request->end_date) {
                return redirect()->back()->withInput()->with('error', 'Tanggal akhir tidak boleh kurang dari tanggal awal.');
            }
        }

        // Mengambil semua ulasan dengan filter pencarian, produk, rating, dan tanggal
        $reviews = Review::with(['product', 'user'])
            ->when($search, function ($query, $search) {
                $query->whereHas('product', function ($query) use ($search) {
                    $query->where('name_product', 'like', '%' . $search . '%');
                })
                    ->orWhere('comment', 'like', '%' . $search . '%'); // Mencari di kolom komentar
            })
            ->when($productId, function ($query, $productId) {
                $query->where('product_id', $productId);
            })
            ->when($rating, function ($query, $rating) {
                $query->where('rating', $rating);
            })
            ->when($createdAt, function ($query, $createdAt) {
                $direction = $createdAt === 'desc' ? 'desc' : 'asc';
                $query->orderBy('created_at', $direction);
            })
            ->when($startDate, function ($query, $startDate) {
                $query->whereDate('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query, $endDate) {
                $query->whereDate('created_at', '<=', $endDate);
            })
            ->latest()
            ->paginate(25); // Pagination

        // Mengambil semua produk untuk dropdown
        $products = Product::all();

        // Mengembalikan view dengan data
        return view('admin.reviews.index', compact('reviews', 'products'));
    }







    /**
     * Show the form for creating a new review.
     */
    public function create(Product $product)
    {
        // $users = User::all();
        // $products = Product::all();

        // return view('admin.reviews.create', compact('product', 'products', 'users'));
    }

    /**
     * Store a newly created review in the database.
     */
    public function store(Request $request)
    {
        // // Validasi input
        // $request->validate([
        //     'user_id' => 'required|exists:users,id',
        //     'product_id' => 'required|exists:products,id',
        //     'rating' => 'required|in:1,2,3,4,5',
        //     'comment' => 'nullable|string',
        // ]);

        // Review::create([
        //     'user_id' => Auth::id(),
        //     'product_id' => $request->product_id,
        //     'rating' => $request->rating,
        //     'comment' => $request->comment,
        // ]);

        // return redirect()->route('admin.reviews.index', ['product' => $request->product_id])->with('success', 'Ulasan berhasil ditambahkan.');
    }



    /**
     * Show the form for editing the specified review.
     */
    public function edit(Review $review)
    {
        // $users = User::all();
        // $products = Product::all();
        // return view('admin.reviews.edit', compact('review', 'products', 'users'));
    }

    /**
     * Update the specified review in the database.
     */
    public function update(Request $request, Review $review)
    {
        // // Validasi input
        // $request->validate([
        //     'user_id' => 'required|exists:users,id',
        //     'product_id' => 'required|exists:products,id',
        //     'rating' => 'required|in:1,2,3,4,5',
        //     'comment' => 'nullable|string',
        // ]);

        // // Memperbarui ulasan
        // $review->user_id = Auth::id();
        // $review->product_id = $review->product_id;
        // $review->rating = $request->rating;
        // $review->comment = $request->comment;
        // $review->save();

        // return redirect()->route('admin.reviews.index', $review->product_id)->with('success', 'Ulasan berhasil diperbarui.');
    }

    /**
     * Remove the specified review from the database.
     */
    public function destroy(Review $review)
    {
        // $productId = $review->product_id;
        // $review->delete();

        // return redirect()->route('admin.reviews.index', $productId)->with('success', 'Ulasan berhasil dihapus.');
    }
}
