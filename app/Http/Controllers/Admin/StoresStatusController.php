<?php

namespace App\Http\Controllers\Admin;

use App\Http\Actions\StoreAction;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class StoresStatusController extends Controller
{
    public string $folderPath = 'Admin.stores.';
    /**
     * Display a listing of the resource.
     */
    public function index(StoreAction $action)
    {
        $stores = $action->getStrores();
        return view($this->folderPath.'storesStatus')->with(['stores'=>$stores]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $data = Product::where('store_id','=',$id)->get();
       return view($this->folderPath.'products',compact('data'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
