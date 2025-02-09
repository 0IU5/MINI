<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderNotification;
use App\Models\ProductStockNotification;
use App\Models\UserOrderNotification;
use App\Observers\OrderObserver;
use App\Observers\ProductObserver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        setlocale(LC_TIME, 'id_ID.utf8');
        Carbon::setLocale('id');

        Order::observe(OrderObserver::class);
        Product::observe(ProductObserver::class);

        View::composer('*', function ($view) {
            $user = Auth::user();

            if ($user) {
                if ($user->hasRole('admin')) {
                    // Gabungkan notifikasi order dan stok
                    $orderNotifications = OrderNotification::with(['order.user', 'order.productOrders.product'])
                        ->where('is_read', false)
                        ->get()
                        ->map(function ($notification) {
                            $notification->type = 'order';
                            return $notification;
                        });

                    $stockNotifications = ProductStockNotification::with('product')
                        ->where('is_read', false)
                        ->get()
                        ->map(function ($notification) {
                            $notification->type = 'stock';
                            return $notification;
                        });

                    $allNotifications = $orderNotifications->concat($stockNotifications)
                        ->sortByDesc('created_at');

                    $totalNotifications = $allNotifications->count();

                    $view->with([
                        'allNotifications' => $allNotifications,
                        'totalNotifications' => $totalNotifications
                    ]);
                } else {
                    $userNotifications = UserOrderNotification::with(['order'])
                        ->where('user_id', $user->id)
                        ->where('is_read', false)
                        ->latest()
                        ->get();
                    $view->with('userNotifications', $userNotifications);
                }
            }
        });
    }
}
