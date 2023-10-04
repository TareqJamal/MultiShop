<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Category extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    public $translatedAttributes = ['name'];
    protected $fillable = ['store_id', 'image'];

    public function stores()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
     public function products()
     {
         return $this->hasMany(Product::class , 'product_id');
     }
}
