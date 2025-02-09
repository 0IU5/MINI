<?php
namespace App\Observers;

use App\Models\Product;
use App\Models\ProductStockNotification;

class ProductObserver
{
    public function updated(Product $product)
    {
        // Cek jika stok berubah
        if ($product->isDirty('stock_product')) {
            $this->checkStock($product);
        }
    }

    private function checkStock(Product $product)
    {
        // Cek jika stok habis
        if ($product->stock_product == 0) {
            ProductStockNotification::create([
                'product_id' => $product->id,
                'message' => "Stok produk {$product->name_product} telah habis!",
                'type' => 'out_of_stock'
            ]);
        }
        // Cek jika stok kurang dari 5
        elseif ($product->stock_product < 5) {
            ProductStockNotification::create([
                'product_id' => $product->id,
                'message' => "Stok produk {$product->name_product} tinggal {$product->stock_product} unit!",
                'type' => 'low_stock'
            ]);
        }
    }
}