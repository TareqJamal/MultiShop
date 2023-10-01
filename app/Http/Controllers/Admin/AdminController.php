<?php

namespace App\Http\Controllers\Admin;

use App\Http\Actions\AdminAction;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public string $folderPath = 'Admin.admins.';
    public array $data = ['name', 'email', 'password', 'image', 'phone'];
    public string $mainRoute = 'admins';


    public function index()
    {
        if (\request()->ajax()) {
            $admins = Admin::all();
            return DataTables::of($admins)
                ->addIndexColumn()
                ->editColumn('image', 'Admin.admins.datatable.image')
                ->addColumn('actions', function ($row) {
                    return
                        '<button id="btnEdit" class="btn btn-warning" data-id=" '.$row->id.' ">Edit</button>
                         <button id="btnDelete" class="btn btn-danger" data-id=" '.$row->id.' ">Delete</button>';
                })
                ->rawColumns(['image', 'actions'])
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
    public function store(Request $request, AdminAction $adminAction)
    {
        if ($request->hasFile('image')) {
            if ($request->password == $request->confirmPassword) {
                if (Admin::checkEmail($request->email)) {
                    return response()->json(['message' => 'This Email is Used']);
                } else {
                    $postedData = $request->only($this->data);
                    $adminAction->storeAdmin($postedData);
                    return response()->json(['success' => 'New Admin Added Successfully']);
                }
            } else {
                return response()->json(['message' => 'Password Not Match']);
            }
        } else {
            return response()->json(['message' => 'Please Choose Image']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        Admin::destroy($id);
        return response()->json();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminAction $adminAction ,$id)
    {
        if(\request()->ajax())
        {
            $admin = $adminAction->getAdmin($id);
            $returnHTMl = view($this->folderPath.'edit')->with(['data'=>$admin])->render();
            return response()->json(['editForm'=>$returnHTMl]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id , AdminAction $adminAction)
    {
        $updatedData = $request->only($this->data);
        $adminAction->updateAdmin($id , $updatedData);
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    }
}
