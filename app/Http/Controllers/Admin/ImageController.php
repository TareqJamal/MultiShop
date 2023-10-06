<?php

namespace App\Http\Controllers\Admin;

use App\Http\Actions\ImageAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageController extends Controller
{

    public string $folderPath = 'Admin.products.images.';
    public array $data = ['image'];
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
    public function show(string $id , ImageAction $action)
    {
        if(\request()->ajax())
        {
            $images = $action->getImages($id);
            $returnHtml = view($this->folderPath.'index')->with(['images'=>$images])->render();
            return response()->json(['html'=>$returnHtml]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id , ImageAction $action)
    {
        if(\request()->ajax())
        {
            $image = $action->getImage($id);
            $returnHtml = view($this->folderPath.'edit')->with(['image'=>$image])->render();
            return response()->json(['html'=>$returnHtml]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id , ImageAction $action)
    {
        $updatedData = $request->only($this->data);
        $action->update($id,$updatedData);
        return response()->json(['success' => 'Image Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id , ImageAction $action)
    {
        $action->delete($id);
        return response()->json(['success' => 'Image Deleted Successfully']);
    }
}
