<?php

namespace App\Http\Actions;

use App\Models\Size;

class SizeAction
{
    public function getSize($id)
    {
        return Size::findorfail($id);
    }
    public function updateSize($id , $data)
    {
        $size = $this->getSize($id);
        return $size->update($data);
    }
    public function getSizesProduct($id)
    {
        return Size::all()->where('product_id',$id);
    }
    public function delete($id)
    {
        return Size::destroy($id);
    }

}
