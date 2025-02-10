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
        $priceProduct = $request->input('price'); // Filter harga
        $statusOrder = $request->input('status_order'); // Filter status order
        $startDate = $request->input('start_date'); // Tanggal mulai
        $endDate = $request->input('end_date'); // Tanggal akhir
        $search = $request->input('search'); // Filter pencarian
        $paymentStatus = $request->input('payment_status'); // Filter status pembayaran
        $productId = $request->input('product_id'); // Filter berdasarkan produk
        $sortBy = $request->input('sort_by', 'created_at'); // Kolom yang digunakan untuk sorting
        $sortDirection = $request->input('sort_direction', 'desc'); // Arah sorting (asc/desc)
        $createdAtSort = $request->input('created_at_sort'); // Filter sortir berdasarkan tanggal

        // Validasi tanggal: Tanggal akhir tidak boleh kurang dari tanggal awal
        if ($startDate && $endDate && $endDate < $startDate) {
            return redirect()->back()->with('error', 'Tanggal akhir tidak boleh lebih kecil dari tanggal awal.');
        }

        // Ambil notifikasi yang belum dibaca
        $unreadNotifications = OrderNotification::with(['order.user', 'order.productOrders.product'])
            ->where('is_read', false)
            ->latest()
            ->get();

        // Query dasar pesanan
        $ordersQuery = Order::with('user', 'productOrders.product', 'addresses', 'postage', 'promoCode', 'payment');

        // Filter berdasarkan produk
        if ($productId) {
            $ordersQuery->whereHas('productOrders.product', function ($query) use ($productId) {
                $query->where('id', $productId);
            });
        }

        // Pencarian berdasarkan produk, status order, dan status pembayaran
        if ($search) {
            $ordersQuery->where(function ($query) use ($search) {
                $query->whereHas('productOrders.product', function ($q) use ($search) {
                    $q->where('name_product', 'like', '%' . $search . '%'); // Cari nama produk
                })
                    ->orWhere('status_order', 'like', '%' . $search . '%') // Cari status order
                    ->orWhereHas('payment', function ($q) use ($search) {
                        $q->where('status', 'like', '%' . $search . '%'); // Cari status pembayaran
                    });
            });
        }

        // Filter berdasarkan status order
        if ($statusOrder) {
            $ordersQuery->where('status_order', $statusOrder);
        }

        // Filter berdasarkan status pembayaran
        if ($paymentStatus) {
            $ordersQuery->whereHas('payment', function ($query) use ($paymentStatus) {
                $query->where('status', $paymentStatus);
            });
        }

        // Filter berdasarkan rentang tanggal
        if ($startDate && $endDate) {
            $ordersQuery->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"]);
        } elseif ($startDate) {
            $ordersQuery->whereDate('created_at', '>=', $startDate);
        } elseif ($endDate) {
            $ordersQuery->whereDate('created_at', '<=', $endDate);
        }

        // Filter berdasarkan harga (Terendah ke Tertinggi / Tertinggi ke Terendah)
        if ($priceProduct) {
            if ($priceProduct == 'asc') {
                $ordersQuery->orderBy('grand_total_amount', 'asc'); // Terendah ke Tertinggi
            } elseif ($priceProduct == 'desc') {
                $ordersQuery->orderBy('grand_total_amount', 'desc'); // Tertinggi ke Terendah
            }
        }

        // Sortir berdasarkan created_at_sort jika tersedia
        if ($createdAtSort) {
            $ordersQuery->orderBy('created_at', $createdAtSort);
        } else {
            // Default sorting berdasarkan kolom dan arah yang ada
            if ($sortBy && in_array($sortBy, ['created_at', 'grand_total_amount'])) {
                $ordersQuery->orderBy($sortBy, $sortDirection);
            }
        }

        // Mengambil hasil dengan pagination
        $orders = $ordersQuery->paginate(1);

        // Mapping status order ke dalam bahasa Indonesia
        $statusMapping = [
            'completed' => 'Selesai',
            'processing' => 'Dikemas',
            'pending' => 'Menunggu',
            'shipping' => 'Dikirim',
        ];

        $orders->getCollection()->transform(function ($order) use ($statusMapping) {
            $order->status_order_label = $statusMapping[$order->status_order] ?? 'Tidak Diketahui';
            return $order;
        });

        // Mengambil semua produk untuk filter
        $products = Product::all();

        // Status pembayaran yang tersedia
        $paymentStatuses = ['failed', 'pending', 'expired', 'success'];

        // Mengembalikan tampilan
        return view('admin.orders.index', compact('orders', 'products', 'paymentStatuses', 'unreadNotifications', 'sortBy', 'sortDirection'));
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
                $message = 'Pesanan telah dikemas';
            } elseif ($order->status_order == 'processing' && $request->status == 'shipping') {
                $order->status_order = 'shipping';
                $order->shipping_at = now(); // Waktu pengiriman
                $message = 'Pesanan telah dikirim';
            } elseif ($order->status_order == 'shipping' && $request->status == 'completed') {
                $order->status_order = 'completed';
                $order->completed_at = now(); // Waktu selesai
                $message = 'Pesanan telah selesai';
            } else {
                return redirect()->back()->with('error', 'Status sudah diperbarui atau tidak valid.');
            }

            $order->save();
            return redirect()->route('admin.orders.index')->with('success', $message);
        }

        return redirect()->route('admin.orders.index')->with('error', 'Pesanan tidak ditemukan.');
    }
}
