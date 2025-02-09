<?php

namespace App\Http\Controllers;

use App\Models\ProductStockNotification;

class ProductStockNotificationController extends Controller
{
    public function markAllAsRead()
    {
        ProductStockNotification::where('is_read', false)
            ->update(['is_read' => true]);

        return back()->with('success', 'Semua notifikasi stok telah ditandai sebagai dibaca');
    }
    
}
