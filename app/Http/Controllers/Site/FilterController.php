<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

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
        $value = $request->value;
        if (Color::where('name', $value)->exists()) {
            $productsID = Color::where('name', $value)->get()->pluck('product_id')->toArray();
        } else {
            $productsID = Size::where('name', $value)->get()->pluck('product_id')->toArray();
        }
        $filterProducts = Product::whereIn('id', $productsID)->get();
        $returnHtml = view('Site.pages.shop.filter',compact('filterProducts'))->render();
        return response()->json(['html'=>$returnHtml]);


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
