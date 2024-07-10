<?php

namespace Modules\Orders\src\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    protected $fillable = [
        'id',
        'user_id',
        'total',
        'status_id',
    ];

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'status_id', 'id');
    }
}