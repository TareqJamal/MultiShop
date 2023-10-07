<?php

namespace App\Http\Controllers\Admin;

use App\Http\Actions\MainAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public string $folderPath = 'Admin.main.';

    /**
     * Display a listing of the resource.
     */
    public function index(MainAction $action)
    {
        $data = $action->counts();
        return view($this->folderPath . 'index')
            ->with([
                'products' => $data['countProducts'],
                'stores' => $data['countStores'],
                'admins' => $data['countAdmin'],
                'coupons' => $data['countCoupon'],
                'categories' => $data['countCategory'],
            ]);

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
