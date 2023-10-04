<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributes extends Model
{
    use HasFactory;
    protected $fillable = ['type' , 'name' ,'product_id'];
    public function products()
    {
        return $this->belongsTo(Product::class , 'product_id');
    }
}
