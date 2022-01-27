<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\ProductAttributesAssoc;

class Product extends Model
{
    use HasFactory;

    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getProductImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function getProductAttributesAssoc()
    {
        return $this->hasMany(ProductAttributesAssoc::class);
    }
}
