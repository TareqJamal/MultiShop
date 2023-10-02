<?php

namespace App\Http\Controllers\Admin;

use App\Http\Actions\CategoryAction;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Store;
use App\Models\StoreType;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public string $folderPath = 'Admin.categories.';
    public array $data = ['name:en', 'name:ar', 'image', 'store_id'];
    public string $mainRoute = 'categories';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (\request()->ajax()) {
            $data = Category::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('image', 'Admin.categories.datatable.image')
                ->editColumn('store_id', function ($row) {
                    return $row->stores->name;
                })
                ->addColumn('actions', function ($row) {
                    return
                        '<button id="btnEdit" class="btn btn-warning" data-id=" ' . $row->id . ' ">Edit</button>
                         <button id="btnDelete" class="btn btn-danger" data-id=" ' . $row->id . ' ">Delete</button>';
                })
                ->rawColumns(['actions', 'image'])
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
            $stores = Store::all();
            $returnHTml = view($this->folderPath . 'create')->with(['data' => $stores])->render();
            return response()->json(['createForm' => $returnHTml]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CategoryAction $action)
    {
        $postedData = $request->only($this->data);
        $action->storeCategory($postedData);
        return response()->json(['success' => 'New Category Added Successfully']);
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
    public function edit(string $id, CategoryAction $action)
    {
        if (\request()->ajax()) {
            $data = $action->getCategory($id);
            $stores = Store::all();
            $returnHtml = view($this->folderPath . 'edit')->with(['data' => $data, 'stores' => $stores])->render();
            return response()->json(['editForm' => $returnHtml]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, CategoryAction $action)
    {
        $updatedData = $request->only($this->data);
        $action->updateCategory($id, $updatedData);
        return response()->json(['success' => "Category Updated Successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, CategoryAction $action)
    {
        $action->delete($id);
        return response()->json(['success' => "Store Deleted Successfully"]);
    }
}
