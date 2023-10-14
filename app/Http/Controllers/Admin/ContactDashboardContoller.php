<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ContactDashboardContoller extends Controller
{
    public string $folderPath = 'Admin.contacts.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (\request()->ajax()) {
            $data =Contact::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at',function ($row)
                {
                    return $row->created_at->format('Y-m-d');
                })
                ->addColumn('actions', function ($row) {
                    return
                        '
                         <button id="btnDelete" class="btn btn-danger" data-id=" ' . $row->id . ' ">Delete</button>';
                })
                ->rawColumns(['actions', 'status'])
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
        Contact::destroy($id);
        return response()->json(['success'=>'Message Deleted Successfully']);
    }
}
