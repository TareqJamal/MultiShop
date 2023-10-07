<?php

namespace App\Http\Controllers\Site;

use App\Http\Actions\CustomerClass;
use App\Http\Controllers\Controller;
use App\Http\Traits\UploadImage;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    use UploadImage;

    public $data = ['firstName', 'lastName', 'phone', 'address', 'image', 'email', 'password'];

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
    public function store(Request $request, CustomerClass $action)
    {
        if ($request->image !=null) {
            if (!Customer::checkEmail($request->email)) {
                if ($request->password == $request->confirmPassword) {
                    $postedData = $request->only($this->data);
                    $action->storeCustomer($postedData);
                    return response()->json([
                        'success' => 'Your registration has been completed successfully and you can now log in',
                        'redirect' => route('WebsiteLoginPage')
                    ]);
                } else {
                    return response()->json([
                        'error' => 'Sorry, Password Not Match',
                    ]);
                }
            } else {
                return response()->json([
                    'error' => 'Sorry,This Email is Used',
                ]);
            }
        }
        else
        {
            return response()->json([
                'error' => 'Please Choose Image',
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
