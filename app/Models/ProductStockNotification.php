<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductStockNotification extends Model
{
    protected $fillable = ['product_id', 'message', 'is_read', 'type'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id'); // Sesuaikan dengan nama foreign key
    }
}
