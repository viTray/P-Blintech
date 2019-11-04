<?php

namespace App\Http\Controllers;

use App\General;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = General::where('idReception', request()->id)->first();
        $data->type;
        $data->brand;
        return response()->json([
            'general'=> $data,
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
        $data = New General();
        $request->validate([
            'circulation' => 'required',
            'authenticatedCirculation' => 'required',
            'level' => 'required',
            'phone' => 'required|max:8',
            'owner' => 'required',
            'color' => 'required',
            'mileage' => 'required',
            'person' => 'required',
            'licensePlate' => 'required',
            'chassis' => 'required'
        ]);
        $data->idReception = $request->idReception;
        $data->circulation = $request->circulation;
        $data->authenticatedCirculation = $request->authenticatedCirculation;
        $data->level = $request->level;
        $data->owner = $request->owner;
        $data->idBrand = $request->idBrand;
        $data->idType = $request->idType;
        $data->color = $request->color;
        $data->mileage = $request->mileage;
        $data->person = $request->person;
        $data->phone = $request->phone;
        $data->licensePlate = $request->licensePlate;
        $data->chassis = $request->chassis;
        $data->save();

        return response()->json([
            'general'=> $data,
            'msg'=> 'ok'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\General  $general
     * @return \Illuminate\Http\Response
     */
    public function show(General $general)
    {
        $general->type;
        $general->brand;
        return response()->json([
            'general'=> $general,
            'msg' => 'ok'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\General  $general
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, General $general)
    {
        $general->circulation = $request->circulation;
        $general->authenticatedCirculation = $request->authenticatedCirculation;
        $general->level = $request->level;
        $general->owner = $request->owner;
        $general->idBrand = $request->idBrand;
        $general->idType = $request->idType;
        $general->color = $request->color;
        $general->mileage = $request->mileage;
        $general->idEmployee = $request->idEmployee;
        $general->licensePlate = $request->licensePlate;
        $general->chassis = $request->chassis;

        $general->update();

        return response()->json([
            'general'=> $general,
            'msg'=> 'ok'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\General  $general
     * @return \Illuminate\Http\Response
     */
    public function destroy(General $general)
    {
        $general->delete();
        return $general;
    }
}
