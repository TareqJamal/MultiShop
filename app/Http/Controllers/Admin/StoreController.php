<?php

namespace App\Http\Controllers\Admin;

use App\Http\Actions\StoreAction;
use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\StoreType;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StoreController extends Controller
{
    public string $folderPath = 'Admin.stores.';
    public array $data = ['name:en', 'name:ar' ,'image','storageCapacity','stores_types_id'];
    public string $mainRoute = 'stores';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (\request()->ajax()) {
            $data = Store::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('image','Admin.stores.datatable.image')
                ->editColumn('stores_types_id',function ($row)
                {
                    return $row->storeTypes->type;
                })
                ->editColumn('name',function ($row)
                {
                    if($row->storageCapacity == 0)
                    {
                        return '<p style="font-weight: bold; color: #d33636">' .$row->name.'</p>';
                    }
                    {
                        return '<p style="font-weight: bold; color: green">' .$row->name.'</p>';
                    }

                })
                ->addColumn('actions', function ($row) {
                    return
                        '<button id="btnEdit" class="btn btn-warning" data-id=" '.$row->id.' ">Edit</button>
                         <button id="btnDelete" class="btn btn-danger" data-id=" '.$row->id.' ">Delete</button>';
                })
                ->rawColumns(['actions','image','name'])
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
            $storesTypes = StoreType::all();
            $returnHTml = view($this->folderPath . 'create')->with(['data'=>$storesTypes])->render();
            return response()->json(['createForm' => $returnHTml]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , StoreAction $action)
    {
        $postedData = $request->only($this->data);
        $action->store($postedData);
        return response()->json(['success'=>'New Store Added Successfully']);

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
    public function edit(string $id , StoreAction $action)
    {
        if(\request()->ajax()) {
            $data = $action->getStore($id);
            $storesTypes = StoreType::all();
            $returnHtml = view($this->folderPath . 'edit')->with(['data' => $data , 'storesTypes'=>$storesTypes])->render();
            return response()->json(['editForm' => $returnHtml]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id , StoreAction $action)
    {
        $updatedData = $request->only($this->data);
        $action->update($id,$updatedData);
        return response()->json(['success'=>"Store Updated Successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,StoreAction $action)
    {
        $action->delete($id);
        return response()->json(['success'=>"Store Deleted Successfully"]);

    }
}
