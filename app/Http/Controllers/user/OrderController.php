<?php

namespace App\Http\Controllers\user;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Order;
use App\Models\Review;
use App\Models\Product;
use App\Models\PromoCode;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil parameter pencarian dari input
        $search = $request->input('search');

        // Ambil data pesanan milik user yang sedang login
        $userOrders = Order::where('user_id', Auth::id())
            ->when($search, function ($query) use ($search) {
                return $query->where('order_code', 'LIKE', "%$search%");
            })
            ->with('productOrders.product.reviews', 'addresses')
            ->get();

        // Mapping status order
        $statusMapping = [
            'completed' => 'Selesai',
            'processing' => 'Dikemas',
            'pending' => 'Menunggu',
            'shipping' => 'Dikirim',
        ];

        // Menambahkan properti status_order_label untuk setiap order
        foreach ($userOrders as $order) {
            $order->status_order_label = $statusMapping[$order->status_order] ?? 'Tidak Diketahui';
        }

        // Kirim data pesanan dan tampilkan view untuk user
        return view('user.orders.index', compact('userOrders', 'search'));
    }




    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        // Mendapatkan semua pengguna untuk dropdown

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
    public function show($id)
    {
        // Ambil order beserta relasi terkait
        $order = Order::with('addresses', 'productOrders.product', 'postage', 'promoCode', 'payment', 'user')
            ->findOrFail($id);
        $clientKey = env('MIDTRANS_CLIENT_KEY');

        // Mapping status ke dalam bahasa Indonesia
        $statusMapping = [
            'completed' => 'Selesai',
            'processing' => 'Dikemas',
            'pending' => 'Menunggu',
            'shipping' => 'Dikirim',
        ];

        // Tambahkan properti baru untuk status dalam bahasa Indonesia
        $order->status_order_label = $statusMapping[$order->status_order] ?? 'Tidak Diketahui';

        return view('user.orders.show', compact('order', 'clientKey'));
    }

    public function addRiview(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|in:1,2,3,4,5',
            'comment' => 'required|string|max:500',
        ], [
            'rating.required' => 'Rating wajib diisi',
            'comment.required' => 'Komentar wajib diisi',
        ]);

        $hasReview = Review::where('order_id', $request->order_id)
            ->where('product_id', $request->product_id)
            ->exists();

        if ($hasReview) {
            return redirect()->back()->withErrors(['error' => 'Anda sudah memberikan ulasan untuk produk ini di order ini.']);
        }

        Review::create([
            'order_id' => $request->order_id,
            'product_id' => $request->product_id,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Ulasan berhasil ditambahkan.');
    }




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
            'sub_total_amount' => 'required|numeric|min:0',
            'grand_total_amount' => 'required|numeric|min:0',
            'status_order' => 'required|in:pending,processing,completed',
        ]);


        // Update data pesanan
        $order->update([
            'user_id' => $request->user_id,
            'promo_code_id' => $request->promo_code_id, // Jika promo_code_id digunakan
            'sub_total_amount' => $request->sub_total_amount,
            'grand_total_amount' => $request->grand_total_amount,
            'status_order' => $request->status_order,
        ]);
        // Memperbarui produk yang dipesan (relasi Many-to-Many dengan Product)
        $order->product()->sync($request->product_id);
        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil diperbarui.');
    }



    /**
     * Remove the specified order from storage.
     */
    public function destroy(Order $order)
    {
        $order->productOrders()->delete();
        $order->delete();

        return redirect()->route('user.orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }
    public function updateStatus(Request $request, $orderId)
    {
        $order = Order::find($orderId);

        if ($order) {
            // Periksa apakah status saat ini adalah 'shipping'
            if ($order->status_order === 'shipping') {
                $order->status_order = 'completed';
                $order->completed_at = now(); // Catat waktu selesai
                $order->save();

                return redirect()->route('user.orders.show', $orderId)->with('success', 'Status berhasil diperbarui menjadi selesai.');
            }

            return redirect()->back()->with('error', 'Hanya pesanan dalam status "shipping" yang dapat diperbarui ke "completed".');
        }

        return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
    }

    public function downloadInvoice(Order $order)
    {
        // Pastikan user hanya bisa mengakses invoice pesanannya sendiri
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke invoice ini');
        }

        // Generate nomor invoice tanpa karakter '/'
        $invoiceNumber = 'INV-' . date('Ymd') . '-' . str_pad($order->id, 4, '0', STR_PAD_LEFT);

        // Format tanggal ke Indonesia
        $tanggal = \Carbon\Carbon::parse($order->created_at)
            ->timezone('Asia/Jakarta')
            ->translatedFormat('d F Y H:i');

        $pdf = PDF::loadView('user.orders.invoice', [
            'order' => $order,
            'invoiceNumber' => $invoiceNumber,
            'tanggal' => $tanggal
        ]);

        // Atur paper size dan orientation
        $pdf->setPaper('a4');

        return $pdf->download("Invoice-{$invoiceNumber}.pdf");
    }
}
