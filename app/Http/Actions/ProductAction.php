<?php

namespace App\Http\Actions;

use App\Http\Traits\UploadImage;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductAction
{
    use UploadImage;
    public $folderPath = 'ProductImage';

    public function storeProduct($data)
    {
        if(request()->hasFile('image'))
        {
            $data['image'] = $this->uploadImage($data['image'] , $this->folderPath);
        }
         return Product::create($data);

    }

}
