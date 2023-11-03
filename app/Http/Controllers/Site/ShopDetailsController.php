<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Review;
use App\Models\Size;
use Illuminate\Http\Request;

class ShopDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Site.pages.shopDetails.index');
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
        $product = Product::findorfail($id);
        $sizes = Size::all()->where('product_id', $id);
        $colors = Color::all()->where('product_id', $id);
        $images = ProductImage::all()->where('product_id', $id);
        $reviews = Review::all()->where('product_id', $id);
        $anotherProducts = Product::where('category_id',$product->category_id)->get();
        return view('Site.pages.shopDetails.index')
            ->with([
                'product' => $product,
                'sizes' => $sizes,
                'colors' => $colors,
                'images' => $images,
                'reviews' => $reviews,
                'anotherProducts'=>$anotherProducts
            ]);

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
