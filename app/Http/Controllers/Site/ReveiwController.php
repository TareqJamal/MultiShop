<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReveiwController extends Controller
{
    public $data = ['name', 'email', 'message', 'customer_id', 'product_id'];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $postedData = $request->only($this->data);
        $product = Product::findorfail($request->product_id);
        Review::create($postedData);
        $reviews = Review::all()->where('product_id', $request->product_id)->where('customer_id', $request->customer_id);
        $numberReviews = count($product->reviews);
        $returnHtml = view('Site.pages.shopDetails.review')
            ->with(['reviews'=> $reviews , 'product'=>$product])->render();
        return response()->json([
            'success' => 'Thanks For You Review',
            'numberReviews' => $numberReviews,
            'html' => $returnHtml,

        ]);

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
