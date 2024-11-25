<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\PromoCode;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index()
    {
        // Mendapatkan semua pesanan
        $orders = Order::with('user', 'productOrders.product')->get();
        // dd($orders->toArray());
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        // Mendapatkan semua pengguna untuk dropdown
        $carts = Cart::where('user_id', Auth::id())->with(['product'])->get();
        $users = User::all();
        return view('orders.create', compact('users', 'carts'));
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Validasi input
        $request->validate([
            'diskon' => 'nullable|exists:promo_codes,code',
        ]);
        $diskon = PromoCode::where('code', $request->diskon)->first();

        // Simpan data pesanan
        $order =  Order::create([
            'user_id' => Auth::id(),
            'promo_code_id' => $diskon->id ?? null,
            'sub_total_amount' => $request->total_amount,
            'grand_total_amount' => $request->grand_total_amount,
        ]);

        foreach ($request->product_id_quantity as $product_id => $quantity) {
            $product = Product::findOrFail($product_id);
            ProductOrder::create([
                'product_id' => $product->id,
                'order_id' => $order->id,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(Order $order)
    {
        // Mendapatkan semua pengguna untuk dropdown
        $users = User::all();
        $products = Product::all();
        return view('orders.edit', compact('order', 'users', 'products'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, Order $order)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_order' => 'required|numeric|min:0',
            'status_order' => 'required|in:pending,processing,completed',
        ]);

        // Update data pesanan
        $order->update([
            'user_id' => $request->user_id,
            'total_order' => $request->total_order,
            'status_order' => $request->status_order,
        ]);

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil diperbarui.');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(Order $order)
    {
        // Hapus pesanan
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
