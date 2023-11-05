<?php

namespace App\Http\Controllers\Admin;

use App\Enum\OrderTypes;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    public string $folderPath = 'Admin.orders.';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (\request()->ajax()) {
            $data = Order::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('customer_id', function ($row) {
                    return $row->customers->firstName . ' ' . $row->customers->lastName;
                })
                ->editColumn('status', function ($row) {
                    if ($row->status == OrderTypes::Pending->value) {
                        return '<p style="color: orange ; font-weight: bold">' . OrderTypes::Pending->value . '</p>';
                    } elseif ($row->status == OrderTypes::Canceled->value) {
                        return '<p style="color: red ; font-weight: bold">' . OrderTypes::Canceled->value . '</p>';
                    } elseif ($row->status == OrderTypes::Confirmed->value) {
                        return '<p style="color: green ; font-weight: bold">' . OrderTypes::Confirmed->value . '</p>';
                    }
                })
                ->editColumn('is_paid', function ($row) {
                    if ($row->is_paid == 0) {
                        return '<p style="color: red ; font-weight: bold">No</p>';
                    } else {
                        return '<p style="color: green ; font-weight: bold">Yes</p>';
                    }
                })
                ->addColumn('actions', function ($row) {
                    return
                        '<button id="btnView" class="btn btn-success" data-id=" ' . $row->id . ' "><i class="fa fa-eye"></i></button>';
                })
                ->rawColumns(['actions', 'customer_id', 'status', 'is_paid'])
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
        $returnHtml = view($this->folderPath . 'show')
            ->with([
                'order' => Order::findorfail($id),
                'orderDetails' => OrderDetails::where('order_id', $id)->get()
            ])
            ->render();
        return response()->json(['html' => $returnHtml]);
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
