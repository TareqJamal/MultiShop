<?php

namespace App\Http\Actions;

use App\Http\Traits\UploadImage;
use App\Models\Category;

class CategoryAction
{
    use UploadImage;

    public $folderPath = 'CategoriesImages';

    public function storeCategory($data)
    {
        if(request()->hasFile('image'))
        {
            $data['image'] = $this->uploadImage($data['image'],$this->folderPath);
        }
        return Category::create($data);
    }

    public function getCategory($id)
    {
        return Category::findorfail($id);
    }

    public function updateCategory($id, $data)
    {
        if(request()->hasFile('image'))
        {
            $data['image'] = $this->uploadImage($data['image'],$this->folderPath);
        }
        $category = $this->getCategory($id);
        return $category->update($data);
    }

    public function delete($id)
    {
        return Category::destroy($id);
    }

}
