<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Product extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    public $translatedAttributes = ['name', 'description'];
    protected $fillable = ['image', 'price', 'discount', 'quantity', 'store_id', 'category_id', 'user_id'];

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function cateories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function stores()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function admins()
    {
        return $this->belongsTo(Admin::class, 'user_id');
    }
    public function attributes()
    {
        return $this->hasMany(ProductAttributes::class , 'product_id');
    }
}
