<?php

namespace App\Http\Actions;

use App\Http\Traits\UploadImage;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAction
{
     use UploadImage;
     public $folderPath = 'AdminImages';

    public function storeAdmin($data)
    {
        if (request()->hasFile('image')) {
            $data['image'] = $this->uploadImage($data['image'], $this->folderPath);
        }
        else
        {
            return response()->json(['message'=>'Please Choose Image']);
        }
        $data['password'] = Hash::make($data['password']);
        Admin::create($data);
    }

    public function getAdmin($id)
    {
        return Admin::findorfail($id);
    }
    public function updateAdmin($id,$data)
    {
        if(\request()->hasFile('image'))
        {
            $data['image'] = $this->uploadImage($data['image'],$this->folderPath);
        }
        $admin = $this->getAdmin($id);
        $admin->update($data);
    }

}
