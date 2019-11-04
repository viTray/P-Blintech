<?php

namespace App\Http\Controllers;

use App\Customer;
use Faker\Guesser\Name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->state == 'all'){
            $data = Customer::all();
        }else{
            $data = Customer::where('id', '>', 0)->paginate(10);
        }
        foreach ($data as $d) {
            $d->file = Storage::disk("public")->url($d->file);
        };
        return response()->json([
            'customers'=> $data,
            'msg' => 'ok'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = new Customer();

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:customers|email',
            'nit' => 'required|min:8',
            'phone' => 'required|max:8',
            'file' => 'sometimes|file'
        ]);

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->nit = $request->nit;
        $customer->phone = $request->phone;

        if($request->has("file")){
            $customer->file = $request->file("file")->store("customers", "public");
        };

        $customer->save();

        return $customer;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        $customer->file = Storage::disk("public")->url($customer->file);
        return response()->json([
            'customer'=> $customer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Customer $customer, Request $request)
    {
        echo $request;
        $request->validate([
            'email' => 'email',
            'nit' => 'min:8',
            'phone' => 'max:8'
        ]);
        $data = $request->only([
            'name', 'nit', 'email', 'phone'
        ]);

        $customer->update($data);
        return response()->json([
            'customer'=> $customer,
            'msg' => 'ok'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return $customer;
    }
}
