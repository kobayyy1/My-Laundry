<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    protected $table = 'orders';

    protected $primaryKey = 'orders_id';

    protected $fillable = [
        'invoice',
        'username',
        'phone',
        'total',
        'price',
        'grand_total',
        'status',
        'weight',
        'user_id',
    ];
    public function items()
    {
        return $this->hasMany(ordersItems::class, 'orders_id', 'orders_id');
    }
}
