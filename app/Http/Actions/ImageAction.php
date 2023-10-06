<?php

namespace App\Http\Actions;

use App\Http\Traits\UploadImage;
use App\Models\ProductImage;

class ImageAction
{
    use UploadImage;
    public $folderPath = 'ProductImages';
    public function getImages($id)
    {
        return ProductImage::all()->where('product_id', $id);
    }

    public function delete($id)
    {
        return ProductImage::destroy($id);
    }

    public function getImage($id)
    {
        return ProductImage::findorfail($id);
    }

    public function update($id, $data)
    {
        $image = $this->getImage($id);
        if(request()->hasFile('image'))
        {
            $data['image'] = $this->uploadImage($data['image'],$this->folderPath);
        }

        return $image->update($data);
    }

}
