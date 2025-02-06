<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminNotificationController;
use App\Http\Controllers\admin\UserController as AdminUserController;
use App\Http\Controllers\admin\BrandController as AdminBrandController;
use App\Http\Controllers\admin\OrderController as AdminOrderController;
use App\Http\Controllers\admin\ReviewController as AdminReviewController;
use App\Http\Controllers\admin\ProductController as AdminProductController;
use App\Http\Controllers\admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\admin\DiscountController as AdminDiscountController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\CarouselController as AdminCarouselController;

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {

    Route::post('/notifications/mark-as-read/{orderId}', [AdminNotificationController::class, 'markAsRead'])
        ->name('admin.notifications.mark-as-read');

    Route::post('/notifications/mark-all-as-read', [AdminNotificationController::class, 'markAllAsRead'])
        ->name('admin.notifications.mark-all-as-read');

    Route::resource('dashboard', AdminDashboardController::class);

    Route::resource('categories', AdminCategoryController::class)->names([
        'index'   => 'admin.categories.index',
        'store'   => 'admin.categories.store',
        'update'  => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy',
    ]);

    Route::resource('brands', AdminBrandController::class)->names([
        'index'   => 'admin.brands.index',
        'store'   => 'admin.brands.store',
        'update'  => 'admin.brands.update',
        'destroy' => 'admin.brands.destroy',
    ]);

    Route::resource('users', AdminUserController::class)->names([
        'index'   => 'admin.users.index',
        'store'   => 'admin.users.store',
        'update'  => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);
    Route::put('/admin/users/{id}/password', [AdminUserController::class, 'changePassword'])->name('admin.users.changePassword');


    Route::resource('products', AdminProductController::class)->names([
        'index'   => 'admin.products.index',
        'create'  => 'admin.products.create',
        'edit'    => 'admin.products.edit',
        'store'   => 'admin.products.store',
        'show'    => 'admin.products.show',
        'update'  => 'admin.products.update',
        'destroy' => 'admin.products.destroy',
    ]);

    Route::resource('orders', AdminOrderController::class)->names([
        'index'   => 'admin.orders.index',
        'show'    => 'admin.orders.show',
        'store'   => 'admin.orders.store',
        'update'  => 'admin.orders.update',
        'destroy' => 'admin.orders.destroy',
    ]);

    Route::post('/order/update-status/{id}', [AdminOrderController::class, 'updateStatus'])
        ->name('admin.order.updateStatus');

    Route::resource('reviews', AdminReviewController::class)->names([
        'index'   => 'admin.reviews.index',
        'store'   => 'admin.reviews.store',
        'update'  => 'admin.reviews.update',
        'destroy' => 'admin.reviews.destroy',
    ]);

    Route::resource('discount', AdminDiscountController::class)->names([
        'index'   => 'admin.discount.index',
        'store'   => 'admin.discount.store',
        'update'  => 'admin.discount.update',
        'destroy' => 'admin.discount.destroy',
    ]);

    Route::resource('carousel', AdminCarouselController::class)->names([
        'index'   => 'admin.carousel.index',
        'store'   => 'admin.carousel.store',
        'update'  => 'admin.carousel.update',
        'destroy' => 'admin.carousel.destroy',
    ]);
});
