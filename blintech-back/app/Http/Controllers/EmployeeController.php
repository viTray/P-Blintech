<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Customer::where('id', '>', 0)->paginate(10);
        foreach ($data as $d) {
            $d->file = Storage::disk("public")->url($d->file);
        };
        return response()->json([
            'employees'=> $data,
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
        $employee = new Employee();

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:customers|email',
            'nit' => 'required|min:8',
            'phone' => 'required|max:8',
            'file' => 'sometimes|file'
        ]);

        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->nit = $request->nit;
        $employee->phone = $request->phone;

        if($request->has("file")){
            $employee->file = $request->file("file")->store("employees", "public");
        };

        $employee->save();

        return $employee;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return response()->json([
            'employee'=> $employee,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $newCustomerInfo = request()->only([
            'name', 'email', 'nit', 'phone'
        ]);

        $employee->update($newCustomerInfo);
        return response()->json([
            'employee'=> $employee,
            'msg' => 'ok'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json([
            'customer'=> $employee,
            'msg' => 'ok'
        ]);
    }
}
