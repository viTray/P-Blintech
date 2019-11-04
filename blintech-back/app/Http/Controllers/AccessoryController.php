<?php

namespace App\Http\Controllers;

use App\Accessory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AccessoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Accessory::where('idReception', request()->id)->get();
        foreach ($data as $d) {
            $d->title;
            $d->file = Storage::disk("public")->url($d->file);
        };
        return response()->json([
            'accesories'=> $data,
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
        // $data = New Accessory();

        // $data->idReception = $request->idReception;
        // $data->idTitle = $request->idTitle;
        // $data->state = $request->state;
        // $data->extra = $request->extra;
        // $data->description = $request->description;
        // $data->file = '/';
        // if($request->has("file")){
        //     $data->file = $request->file("file")->store("accesories", "public");
        // };
        // $data->save();

        // return response()->json([
        //     'accesory'=> $data,
        //     'msg'=> 'ok'
        // ]);
        return $request->ne;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Accessory  $accessory
     * @return \Illuminate\Http\Response
     */
    public function show(Accessory $accessory)
    {
        $accessory->reception;
        $accessory->title;

        return response()->json([
            'accessory'=> $accessory,
            'msg' => 'ok'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Accessory  $accessory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Accessory $accessory)
    {
        $accessory->idTitle = $request->idTitle;
        $accessory->state = $request->state;
        $accessory->extra = $request->extra;
        $accessory->image = $request->image;
        $accessory->description = $request->description;

        $accessory->update();

        return response()->json([
            'accesory'=> $accessory,
            'msg'=> 'ok'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Accessory  $accessory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Accessory $accessory)
    {
        $accessory->delete();
        return $accessory;
    }
}
