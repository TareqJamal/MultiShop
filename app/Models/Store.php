<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Store extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;
    public $translatedAttributes = ['name'];
    protected $fillable = ['storageCapacity','stores_types_id','image'];

    public function storeTypes()
    {
        return $this->belongsTo(StoreType::class,'stores_types_id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class,'store_id');
    }
     public function products()
     {
         return $this->hasMany(Product::class , 'store_id');
     }
}
