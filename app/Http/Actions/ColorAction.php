<?php

namespace App\Http\Actions;

use App\Models\Color;

class ColorAction
{
    public function getColor($id)
    {
        return Color::findorfail($id);
    }

    public function delete($id)
    {
        return Color::destroy($id);
    }

    public function update($id, $data)
    {
        $color = $this->getColor($id);
        return $color->update($data);
    }

}
