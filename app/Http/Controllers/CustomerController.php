<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use File;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $customers = Customer::all();
        return view('index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('create-customer');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {

        $customer = new Customer();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = $image->store('/', 'public');
            $customer->image = $fileName;
        }

        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->bank_acc = $request->bank_acc;
        $customer->about = $request->about;
        $customer->save();

        return redirect()->route('customers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
        return view('customer-details', ['customer' => $customer]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('edit-customer', ['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            $oldImagePath = public_path('uploads/' . $customer->image);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
            // Store the new image
            $image = $request->file('image');
            $fileName = $image->store('/', 'public');
            $customer->image = $fileName;
        }

        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->bank_acc = $request->bank_acc;
        $customer->about = $request->about;
        $customer->save();

        return redirect()->route('customers.index');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
