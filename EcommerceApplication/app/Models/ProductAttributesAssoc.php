<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductAttributesAssoc extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_qty_max',

    ];

    public function getProduct()
    {
        return $this->belongsTo(Product::class);
    }
}
