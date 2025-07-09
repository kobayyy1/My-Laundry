<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ordersItems extends Model
{
    protected $table = 'orders_items';

    protected $primaryKey = 'orders_items_id';

    protected $fillable = [
        'title',
        'price',
        'price_other',
        'qty',
        'orders_id',
        'product_id'
    ];
    public function order()
    {
        return $this->belongsTo(orders::class, 'orders_id', 'orders_id');
    }

    public function product()
    {
        return $this->belongsTo(product::class, 'product_id', 'product_id');
    }
}
