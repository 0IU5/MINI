<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the user's cart.
     */
    public function index()

    {
        // Mengambil semua produk yang ada di dalam keranjang milik pengguna yang sedang login
        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        // Ambil semua pengguna dan produk
        $products = Product::all();

        // Kirim data ke view
        return view('carts.index', compact('carts', 'products'));
    }

    /**
     * Show the form for adding a new product to the cart.
     */
    public function create(Product $product)
    {
        $users = User::all();
        $products = Product::all();
        return view('carts.create', compact('users', 'products'));
    }

    /**
     * Store a newly created product in the cart.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'product_id' => 'required|integer|min:1',
        ]);

        $cart = Cart::where('product_id', $request->product_id)->where('user_id', Auth::id())->first();

        // Menambahkan produk ke dalam keranjang
        if ($cart->exists()) {
            $cart->update([
                'quantity' => $cart->quantity + $request->quantity,
            ]);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('carts.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    /**
     * Show the form for editing the quantity of a product in the cart.
     */
    public function edit(Cart $cart)
    {
        $users = User::all();
        $products = Product::all();
        return view('carts.edit', compact('cart', 'users', 'products'));
    }

    /**
     * Update the specified product quantity in the cart.
     */
    public function update(Request $request, Cart $cart)
    {
        // Validasi input
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Update jumlah produk di dalam keranjang
        $cart->update([
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('carts.index')->with('success', 'Jumlah produk di keranjang berhasil diperbarui.');
    }

    /**
     * Remove the specified product from the cart.
     */
    public function destroy(Cart $cart)
    {
        // Hapus produk dari keranjang
        $cart->delete();

        return redirect()->route('carts.index')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}
