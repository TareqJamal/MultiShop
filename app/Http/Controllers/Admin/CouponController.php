<?php

namespace App\Http\Controllers\Admin;

use App\Http\Actions\CouponAction;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Store;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CouponController extends Controller
{
    public string $folderPath = 'Admin.coupons.';
    public array $data = ['code', 'percentage'];
    public string $mainRoute = 'coupons';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (\request()->ajax()) {
            $data = Coupon::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('percentage', function ($row) {
                    return $row->percentage . '%';
                })
                ->editColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return '<button id="btnStatus" class="btn btn-danger" data-id=" ' . $row->id . ' ">Not Active</button>';
                    } else {
                        return '<button id="btnStatus" class="btn btn-success" data-id=" ' . $row->id . ' ">Active</button>';
                    }
                })
                ->addColumn('actions', function ($row) {
                    return
                        '<button id="btnEdit" class="btn btn-warning" data-id=" ' . $row->id . ' ">Edit</button>
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
        if (\request()->ajax()) {
            $returnHTml = view($this->folderPath . 'create')->render();
            return response()->json(['createForm' => $returnHTml]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CouponAction $action)
    {
        $postedData = $request->only($this->data);
        $action->storeCoupon($postedData);
        return response()->json(['success' => 'New Coupon Added Successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id , CouponAction $action)
    {
        $coupon = $action->getCoupon($id);
        $action->statusCoupon($id);
        return response()->json(['success'=>'Coupon Status Change Successfully']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id ,CouponAction $action)
    {
        if (\request()->ajax()) {
            $data = $action->getCoupon($id);
            $returnHtml = view($this->folderPath . 'edit')->with(['data' => $data])->render();
            return response()->json(['editForm' => $returnHtml]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id , CouponAction $action)
    {
        $updatedData = $request->only($this->data);
        $action->updateCoupon($id,$updatedData);
        return response()->json(['success' => 'Coupon Updated Successfully']);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id , CouponAction $action)
    {
        $action->delete($id);
        return response()->json(['success'=>'Coupon Deleted Successfully']);

    }
}
