<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OrderProduct;

class Order extends Model
{
    use HasFactory;

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getOrderProducts()
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }
}
