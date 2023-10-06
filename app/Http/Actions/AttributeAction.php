<?php

namespace App\Http\Actions;

use App\Enum\AttributesTypes;
use App\Models\Color;
use App\Models\ProductAttributes;
use App\Models\Size;

class AttributeAction
{
    public function getColors($id)
    {
        return ProductAttributes::all()->where('product_id',$id)->where('type',AttributesTypes::color->value);
    }
    public function getSizes($id)
    {
        return ProductAttributes::all()->where('product_id',$id)->where('type','!=',AttributesTypes::color->value);
    }
    public function delete($id)
    {
        return ProductAttributes::destroy($id);
    }
    public function getAttributes($id)
    {
        $sizes = Size::all()->where('product_id',$id);
        $colors = Color::all()->where('product_id',$id);
        return [
            'sizes'=>$sizes,
            'colors'=>$colors
        ];
    }
    public function update($id,$data)
    {
        $attribute = $this->getAttribute($id);
        return $attribute->update($data);
    }


}
