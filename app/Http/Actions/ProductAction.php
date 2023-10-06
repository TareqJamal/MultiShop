<?php

namespace App\Http\Actions;

use App\Enum\AttributesTypes;
use App\Http\Traits\UploadImage;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttributes;
use App\Models\ProductImage;
use App\Models\Store;
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
    public function updateProduct($id,$data)
    {
        if(request()->hasFile('image'))
        {
            $data['image'] = $this->uploadImage($data['image'],$this->folderPath);
        }
        $product = $this->getProduct($id);
        return $product->update($data);
    }
    public function delete($id)
    {
        return Product::destroy($id);
    }
    public function getProduct($id)
    {
        return Product::findorfail($id);
    }
    public function getProductImages($id)
    {
        return ProductImage::all()->where('product_id',$id);
    }
    public function getCategory($id)
    {
        return Category::findorfail($id);
    }
    public function getStore($id)
    {
        return Store::findorfail($id);
    }

}
