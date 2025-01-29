<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\OrderNotification;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(Request $request)
{
    // Mengambil parameter filter dari request
    $priceProduct = $request->input('price'); // Filter berdasarkan harga produk
    $statusOrder = $request->input('status_order'); // Filter berdasarkan status order
    $createdAt = $request->input('created_at'); // Filter berdasarkan tanggal
    $search = $request->input('search'); // Filter berdasarkan pencarian
    $paymentStatus = $request->input('payment_status'); // Filter berdasarkan status pembayaran

    // Ambil notifikasi yang belum dibaca
    $unreadNotifications = OrderNotification::with(['order.user', 'order.productOrders.product'])
        ->where('is_read', false)
        ->latest()
        ->get();

    // Mengambil semua pesanan, dengan filter berdasarkan price, status_order, created_at, search, dan payment_status jika ada
    $orders = Order::with('user', 'productOrders.product', 'addresses', 'postage', 'promoCode', 'payment')
        ->when($priceProduct, function ($query) use ($priceProduct) {
            return $query->orderBy('grand_total_amount', $priceProduct); // Filter harga berdasarkan grand_total_amount
        })
        ->when($statusOrder, function ($query) use ($statusOrder) {
            return $query->where('status_order', $statusOrder);
        })
        ->when($createdAt, function ($query) use ($createdAt) {
            return $query->orderBy('created_at', $createdAt);
        })
        ->when($search, function ($query) use ($search) {
            return $query->whereHas('productOrders.product', function ($query) use ($search) {
                $query->where('name_product', 'like', '%' . $search . '%');
            });
        })
        ->when($paymentStatus, function ($query) use ($paymentStatus) {
            return $query->whereHas('payment', function ($query) use ($paymentStatus) {
                $query->where('status', $paymentStatus);
            });
        })
        ->latest() // Mengurutkan berdasarkan yang terbaru
        ->paginate(5);  // Added pagination to limit results per page

    // Mapping status order ke dalam bahasa Indonesia
    $statusMapping = [
        'completed' => 'Selesai',
        'processing' => 'Dikemas',
        'pending' => 'Menunggu',
        'shipping' => 'Dikirim',
    ];

    // Mengakses koleksi dengan menggunakan properti items()
    $orders->getCollection()->transform(function ($order) use ($statusMapping) {
        $order->status_order_label = $statusMapping[$order->status_order] ?? 'Tidak Diketahui';
        return $order;
    });

    // Mengambil semua produk yang tersedia untuk digunakan dalam form filter jika diperlukan
    $products = Product::all();

    // Mengambil semua status pembayaran yang tersedia untuk digunakan dalam filter
    $paymentStatuses = ['failed', 'pending', 'expired', 'success'];

    // Mengembalikan tampilan dengan data orders, products, paymentStatuses, dan unreadNotifications
    return view('admin.orders.index', compact('orders', 'products', 'paymentStatuses', 'unreadNotifications'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Fetch the specific order with related data
        $order = Order::with('user', 'productOrders.product', 'addresses', 'postage', 'promoCode', 'payment',)->findOrFail($id);

        // Mapping status ke dalam bahasa Indonesia
        $statusMapping = [
            'completed' => 'Selesai',
            'processing' => 'Dikemas',
            'pending' => 'Menunggu',
            'shipping' => 'Dikirim',
        ];

        // Tambahkan properti baru untuk status dalam bahasa Indonesia
        $order->status_order_label = $statusMapping[$order->status_order] ?? 'Tidak Diketahui';

        // Fetch all products (this is fine if you want all products to display)
        $products = Product::all();

        // Pass only the necessary variables to the view
        return view('admin.orders.show', compact('order', 'products'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        // Validasi input status_order
        $validated = $request->validate([
            'status_order' => 'required|in:pending,processing,completed',
        ]);

        // Ambil pesanan berdasarkan ID
        $order = Order::findOrFail($id);

        // Update status pesanan
        $order->status_order = $request->status_order;
        $order->save();

        // Redirect ke halaman yang sesuai dengan pesan sukses
        return redirect()->route('admin.orders.index')->with('success', 'Status pesanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        $order->productOrders()->delete();
        $order->payment()->delete(); // Misalnya jika relasi bernama payment

        // Hapus data order
        $order->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.orders.index')->with('success', 'Order berhasil dihapus beserta data yang terhubung.');
    }

    public function updateStatus(Request $request, $orderId)
    {
        $order = Order::find($orderId);

        if ($order) {
            // Pastikan status belum diupdate lebih dari sekali dan sesuai urutannya
            if ($order->status_order == 'pending' && $request->status == 'processing') {
                $order->status_order = 'processing';
                $order->processing_at = now(); // Waktu proses
            } elseif ($order->status_order == 'processing' && $request->status == 'shipping') {
                $order->status_order = 'shipping';
                $order->shipping_at = now(); // Waktu pengiriman
            } elseif ($order->status_order == 'shipping' && $request->status == 'completed') {
                $order->status_order = 'completed';
                $order->completed_at = now(); // Waktu selesai
            } else {
                return redirect()->back()->with('error', 'Status sudah diperbarui atau tidak valid.');
            }

            $order->save();
        }

        return redirect()->route('admin.orders.index');
    }
}
