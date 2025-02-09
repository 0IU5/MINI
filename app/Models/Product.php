<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Sluggable;

    protected $table = 'products';
    protected $fillable = [
        'name_product',
        'slug',
        'description_product',
        'stock_product',
        'price_product',
        'category_id',
        'brand_id',
        'image_product',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name_product'
            ]
        ];
    }


    /**
     * Relasi ke model Category (Many-to-One).
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Relasi dengan Review
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function order()
    {
        return $this->belongsToMany(Order::class, 'product_orders', 'product_id', 'order_id');
    }

    public function productOrders()
    {
        return $this->hasMany(ProductOrder::class);
    }

}
