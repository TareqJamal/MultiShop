<?php

namespace App\Http\Actions;

use App\Http\Traits\UploadImage;
use App\Models\Store;

class StoreAction
{
    use UploadImage;

    public $folderPath = 'StoreImages';
    public function store($data)
    {
        if(request()->hasFile('image'))
        {
            $data['image'] = $this->uploadImage($data['image'],$this->folderPath);
        }
         return Store::create($data);
    }
    public function getStrores()
    {
        return Store::all();
    }
    public function getStore($id)
    {
        return Store::findorfail($id);
    }
    public function update($id,$data)
    {
        $store = $this->getStore($id);
        if(request()->hasFile('image'))
        {
            $data['image'] = $this->uploadImage($data['image'],$this->folderPath);
        }
        return $store->update($data);
    }
    public function delete($id)
    {
        return Store::destroy($id);
    }

}
