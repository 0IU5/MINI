<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderNotification;
use App\Models\ProductStockNotification;

class AdminNotificationController extends Controller
{
    public function markAsRead($id)
    {
        $notification = OrderNotification::find($id);
        if ($notification) {
            $notification->update(['is_read' => true]);
        }

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }
        return back();
    }

    public function markStockAsRead($id)
    {
        $notification = ProductStockNotification::find($id);
        if ($notification) {
            $notification->update(['is_read' => true]);
        }

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }
        return back();
    }

    public function markAllAsRead()
    {
        // Menandai semua notifikasi order yang belum dibaca
        OrderNotification::where('is_read', false)->update(['is_read' => true]);

        // Menandai semua notifikasi stok yang belum dibaca
        ProductStockNotification::where('is_read', false)->update(['is_read' => true]);

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back()->with('success', 'Semua notifikasi telah ditandai sebagai dibaca');
    }
}
