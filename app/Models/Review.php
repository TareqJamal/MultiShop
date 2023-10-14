<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['name','email','message','customer_id','product_id'];
    public function customers()
    {
        return $this->belongsTo(Customer::class ,'customer_id');
    }
    public function products()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
