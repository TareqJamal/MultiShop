<?php

namespace App\Http\Controllers\Admin;

use App\Http\Actions\AttributeAction;
use App\Http\Controllers\Controller;
use App\Models\ProductAttributes;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public string $folderPath = 'Admin.products.attributes.';
    public array $data = ['name'];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
    public function show(string $id, AttributeAction $action)
    {
        if (\request()->ajax()) {
            $attributes = $action->getAttributes($id);
            $returnHtml = view($this->folderPath . 'index')->with(['sizes' => $attributes['sizes'] , 'colors'=>$attributes['colors'] ])->render();
            return response()->json(['html' => $returnHtml]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, AttributeAction $action)
    {
        if (\request()->ajax()) {
            $size = $action->getAttribute($id);
            $returnHtml = view($this->folderPath . 'edit')->with(['size' => $size])->render();
            return response()->json(['html' => $returnHtml]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, AttributeAction $action)
    {
        $updatedData = $request->only($this->data);
        $action->update($id, $updatedData);
        return response()->json(['success' => 'This Attribute Updated Successfully']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, AttributeAction $action)
    {

        $action->delete($id);
        return response()->json(['success' => 'This Attribute Deleted Successfully']);
    }
}
