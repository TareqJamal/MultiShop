<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CartController extends Controller
{
    public string $folderPath = 'Admin.carts.';
    public string $mainRoute = 'carts';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (\request()->ajax()) {
            $data = Cart::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('customer_id',function ($row)
                {
                    return $row->customers->firstName .' '.$row->customers->lastName ;
                })
                ->editColumn('productImage',$this->folderPath.'datatable.image')
                ->addColumn('email',function ($row)
                {
                    return $row->customers->email;
                })
                ->rawColumns(['customer_id', 'email','productImage'])
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
