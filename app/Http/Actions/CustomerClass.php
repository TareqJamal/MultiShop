<?php

namespace App\Http\Actions;

use App\Http\Traits\UploadImage;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class CustomerClass
{
    use UploadImage;
    public $folderPAth = 'CustomerImages';
    public function storeCustomer($data)
    {
        if(request()->hasFile('image'))
        {
            $data['image'] = $this->uploadImage($data['image'],$this->folderPAth);
        }
        $data['password'] = Hash::make($data['password']);
      return  Customer::create($data);
    }

}
