<?php

namespace App\Http\Controllers\Admin;

use App\Http\Actions\SizeAction;
use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public array $data = ['name'];
    public string $folderPath = 'Admin.products.attributes.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id , SizeAction $action)
    {
        if(\request()->ajax())
        {
            $size = $action->getSize($id);
            $returnHtml = view($this->folderPath.'edit')->with(['size'=>$size])->render();
            return response()->json(['html'=>$returnHtml]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id ,SizeAction $action)
    {
        $updatedData = $request->only($this->data);
        $action->updateSize($id,$updatedData);
        return response()->json(['success'=>'Size Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id ,  SizeAction $action)
    {
        $action->delete($id);
        return response()->json(['success'=>'Size Deleted Successfully']);
    }
}
