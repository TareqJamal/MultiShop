<?php

namespace App\Http\Controllers\Admin;

use App\Http\Actions\StoresTypesAction;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\StoreType;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StoreTypeController extends Controller
{
    public string $folderPath = 'Admin.stores_types.';
    public array $data = ['type:en', 'type:ar'];
    public string $mainRoute = 'stores-types';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (\request()->ajax()) {
            $data = StoreType::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    return
                        '<button id="btnEdit" class="btn btn-warning" data-id=" '.$row->id.' ">Edit</button>
                         <button id="btnDelete" class="btn btn-danger" data-id=" '.$row->id.' ">Delete</button>';
                })
                ->rawColumns(['actions'])
                ->toJson();
        } else {
            return view($this->folderPath . 'index');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (\request()->ajax()) {
            $returnHTml = view($this->folderPath . 'create')->render();
            return response()->json(['createForm' => $returnHTml]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , StoresTypesAction $action)
    {
       $postedData = $request->only($this->data);
       $action->storeType($postedData);
       return response()->json(['success'=>'New Type Added Successfully']);
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
    public function edit(string $id , StoresTypesAction $action)
    {
        if(\request()->ajax()) {
            $data = $action->getStoreType($id);
            $returnHtml = view($this->folderPath . 'edit')->with(['data' => $data])->render();
            return response()->json(['editForm' => $returnHtml]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id , StoresTypesAction $action)
    {
        $updatedData = $request->only($this->data);
        $action->updateStoreType($id , $updatedData);
        return response()->json(['success'=>'Store Type Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id , StoresTypesAction $action)
    {
        $action->deletestoreType($id);
        return response()->json(['success'=>'Store Type Deleted Successfully']);
    }
}
