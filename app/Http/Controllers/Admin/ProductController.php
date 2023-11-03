<?php

namespace App\Http\Controllers\Admin;

use App\Enum\AttributesTypes;
use App\Http\Actions\CategoryAction;
use App\Http\Actions\ProductAction;
use App\Http\Controllers\Controller;
use App\Http\Traits\UploadImage;
use App\Models\Category;
use App\Models\Color;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductAttributes;
use App\Models\ProductImage;
use App\Models\Size;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    use UploadImage;

    public $folder = 'ProductImages';
    public string $folderPath = 'Admin.products.';
    public array $data = ['name:en', 'description:en', 'name:ar', 'description:ar', 'image', 'price', 'discount','priceAfterDiscount', 'quantity', 'store_id', 'category_id', 'user_id'];
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
                ->addColumn('actions', function ($row) {
                    return
                        '<button id="btnEdit" class="btn btn-warning" data-id=" ' . $row->id . ' "><i class="fa fa-edit"></i> </button>
                         <button id="btnDelete" class="btn btn-danger" data-id=" ' . $row->id . ' "><i class="fa fa-trash"></i></button>
                         <button id="btnView" class="btn btn-success" data-id=" ' . $row->id . ' "><i class="fa fa-eye"></i></button>
                         <button id="btnAttributes" class="btn btn-dark" data-id=" ' . $row->id . ' "><i class="fa fa-paperclip"></i> </button>
                         <button id="btnImages" class="btn btn-info" data-id=" ' . $row->id . ' "><i class="fa fa-image"></i> </button>
                         ';
                })
                ->rawColumns(['actions', 'image'])
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
        if ($request->quantity <= $storeQuantity) {
            $store->update(['storageCapacity' => $storeQuantity - $request->quantity]);
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
                    Size::create([
                        'name' => $size,
                        'type' => AttributesTypes::sizeClothes->value,
                        'product_id' => $product->id
                    ]);
                }
            }
            if ($request->has('sizes_shoes')) {
                foreach ($request->sizes_shoes as $size) {
                    Size::create([
                        'name' => $size,
                        'type' => AttributesTypes::sizeShoes->value,
                        'product_id' => $product->id
                    ]);
                }
            }
            if ($request->has('colors')) {
                foreach ($request->colors as $color) {
                    Color::create([
                        'name' => $color,
                        'product_id' => $product->id
                    ]);
                }
            }
            return response()->json(['success' => 'Product Added Successfully']);
        } else {
            return response()->json([
                'error' => 'Sorry,The Quantity is invalid try again',
            ]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, ProductAction $action)
    {
        if (\request()->ajax()) {
            $product = $action->getProduct($id);
            $returnHtml = view($this->folderPath . 'show')
                ->with([
                    'product' => $product,
                ])->render();
            return response()->json(['html' => $returnHtml]);

        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, ProductAction $action)
    {
        if (\request()->ajax()) {
            $product = $action->getProduct($id);
            $categories = Category::all();
            $stores = Store::all();
            $returnHtml = view($this->folderPath . 'edit')
                ->with([
                    'product' => $product,
                    'categories' => $categories,
                    'stores' => $stores
                ])->render();
            return response()->json(['editForm' => $returnHtml]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, ProductAction $action)
    {
        $product = Product::findorfail($id);
        $store = Store::findorfail($product->store_id);
        if ($request->quantity <= $store->storageCapacity) {
            $store->update(['storageCapacity' => $store->storageCapacity - $request->quantity]);
            $updatedData = $request->only($this->data);
            $action->updateProduct($id, $updatedData);
            return response()->json(['success' => 'Product Added Successfully']);
        } else {
            return response()->json([
                'error' => 'Sorry,The Quantity is invalid try again',
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, ProductAction $action)
    {
        $action->delete($id);
        return response()->json(['success' => 'Product Deleted Successfully']);
    }
}
