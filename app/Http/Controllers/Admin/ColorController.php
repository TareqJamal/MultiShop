<?php

namespace App\Http\Controllers\Admin;

use App\Http\Actions\ColorAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ColorController extends Controller
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
    public function edit(string $id, ColorAction $action)
    {
        if (\request()->ajax()) {
            $color = $action->getColor($id);
            $returnHtml = view($this->folderPath . 'edit')->with(['color' => $color])->render();
            return response()->json(['html' => $returnHtml]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, ColorAction $action)
    {
        $updatedData = $request->only($this->data);
        $action->update($id, $updatedData);
        return response()->json(['success' => 'Color Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, ColorAction $action)
    {
        $action->delete($id);
        return response()->json(['success' => 'Color Deleted Successfully']);
    }
}
