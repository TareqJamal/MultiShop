<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CustomerDashboardContoller extends Controller
{
    public string $folderPath = 'Admin.customers.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (\request()->ajax()) {
            $data =Customer::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at',function ($row)
                {
                    return $row->created_at->format('Y-m-d');
                })
                ->editColumn('image',$this->folderPath.'datatable.image')
                ->addColumn('name',function ($row)
                {
                    return $row->firstName . $row->lastName;
                })
                ->rawColumns(['image', 'name'])
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
        //
    }
}
