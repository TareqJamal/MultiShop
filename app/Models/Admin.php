<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $fillable = ['name','email','password','image','phone'];

    public static function checkEmail($email)
    {
        return static::where('email',$email)->exists();
    }
    public static function checkphone($phone)
    {
        return static::where('phone',$phone)->exists();
    }
    public static function checkpassword($password)
    {
        return static::where('password',$password)->exists();
    }
    public function products()
    {
        return $this->hasMany(Product::class , 'user_id');
    }
}
