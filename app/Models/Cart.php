<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id','product_id','productName','productImage','productSize','productColor','productPrice','productQuantity','total'];
    public function customers()
    {
        return $this->belongsTo(Customer::class , 'customer_id');
    }

}
