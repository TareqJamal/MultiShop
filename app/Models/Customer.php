<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory;
    protected $fillable = ['firstName','lastName','phone','address','image','email','password'];
    protected $table = 'customers';
    public static function checkEmail($email)
    {
        return Customer::where('email',$email)->exists();
    }

}
