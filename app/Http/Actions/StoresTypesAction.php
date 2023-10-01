<?php

namespace App\Http\Actions;

use App\Models\StoreType;

class StoresTypesAction
{
    public function storeType($data)
    {
        return StoreType::create($data);
    }

    public function deletestoreType($id)
    {
        return StoreType::destroy($id);
    }

    public function getStoreType($id)
    {
        return StoreType::findorfail($id);
    }

    public function updateStoreType($id, $data)
    {
        $storeType = $this->getStoreType($id);
        return $storeType->update($data);
    }

}
