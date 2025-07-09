<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'title',
        'slug',
        'price',
        'status',
        'discount',
        'dateDiscountStart',
        'dateDiscountEnd',
        'dateProduct',
        'description',
        'price_other',
        'images',
    ];

    protected $casts = [
        'descriptionList' => 'array',
    ];
    public function orderItems()
    {
        return $this->hasMany(ordersItems::class, 'product_id', 'product_id');
    }
}
