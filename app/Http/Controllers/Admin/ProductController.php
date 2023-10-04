<?php

namespace App\Http\Controllers\Admin;

use App\Enum\AttributesTypes;
use App\Http\Actions\ProductAction;
use App\Http\Controllers\Controller;
use App\Http\Traits\UploadImage;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductAttributes;
use App\Models\ProductImage;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    use UploadImage;

    public $folder = 'ProductImages';
    public string $folderPath = 'Admin.products.';
    public array $data = ['name:en', 'description:en', 'name:ar', 'description:ar', 'image', 'price', 'discount', 'quantity', 'store_id', 'category_id', 'user_id'];
    public string $mainRoute = 'products';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (\request()->ajax()) {
            $data = Product::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('image', 'Admin.products.datatable.image')
                ->editColumn('discount', function ($row) {
                    return $row->discount . '%';
                })
                ->editColumn('category_id', function ($row) {
                    return $row->cateories?->name;
                })
                ->editColumn('story_id', function ($row) {
                    return $row->stores?->name;
                })
                ->editColumn('user_id', function ($row) {
                    return '<p style="font-weight: bold ; color: green">'.$row->admins?->name.'</p>';
                })
                ->addColumn('actions', function ($row) {
                    return
                        '<button id="btnEdit" class="btn btn-warning" data-id=" ' . $row->id . ' ">Edit</button>
                         <button id="btnDelete" class="btn btn-danger" data-id=" ' . $row->id . ' ">Delete</button>';
                })
                ->rawColumns(['actions', 'discount', 'category_id', 'story_id', 'user_id' , 'image'])
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
            $categories = Category::all();
            $stores = Store::all();
            $returnHtml = view($this->folderPath . 'create')
                ->with([
                    'categories' => $categories,
                    'stores' => $stores
                ])->render();
            return response()->json(['createForm' => $returnHtml]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, ProductAction $action)
    {
        $store = Store::findorfail($request->store_id);
        $storeQuantity = $store->storageCapacity;
        if($request->quantity <= $storeQuantity ) {
            $store->update(['storageCapacity'=>$storeQuantity - $request->quantity ]);
            $postedData = $request->only($this->data);
            $product = $action->storeProduct($postedData);
            if ($request->hasFile('images')) {
                $images = $request->images;
                foreach ($images as $image) {
                    ProductImage::create([
                        'image' => $this->uploadImage($image, $this->folder),
                        'product_id' => $product->id
                    ]);
                }
            }
            if ($request->has('sizes_clothes')) {
                foreach ($request->sizes_clothes as $size) {
                    ProductAttributes::create([
                        'type' => AttributesTypes::sizeClothes->value,
                        'name' => $size,
                        'product_id' => $product->id
                    ]);
                }
            }
            if ($request->has('sizes_shoes')) {
                foreach ($request->sizes_shoes as $size) {
                    ProductAttributes::create([
                        'type' => AttributesTypes::sizeShoes->value,
                        'name' => $size,
                        'product_id' => $product->id
                    ]);
                }
            }
            if ($request->has('colors')) {
                foreach ($request->colors as $size) {
                    ProductAttributes::create([
                        'type' => AttributesTypes::color->value,
                        'name' => $size,
                        'product_id' => $product->id
                    ]);
                }
            }
            return response()->json(['success' => 'Product Added Successfully']);
        }
        else{
            return response()->json([
                'error' => 'Sorry,The Quantity is invalid try again' ,
            ]);
        }

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
