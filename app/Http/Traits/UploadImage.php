<?php

namespace App\Http\Traits;

trait UploadImage
{
    public function uploadImage($image , $folderName)
    {
        $imageName = $image->getClientOriginalName() . uniqid();
        $imageLocation = $image->move($folderName,$imageName);
        return $imageLocation;
    }
}
