<?php

namespace App\Http\Controllers;

use App\Exterior;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ExteriorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Exterior::where('idReception', request()->id)->get();
        foreach ($data as $d) {
            $d->file = Storage::disk("public")->url($d->file);
        };
        return response()->json([
            'exteriors'=> $data,
            'msg' => 'ok'
        ]);      }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = New Exterior();

        $data->idReception = $request->idReception;
        $data->title = $request->title;
        $data->description = $request->descriptions;
        $data->file = '/';
        if($request->has("file")){
            $data->file = $request->file("file")->store("exteriores", "public");
        };
        $data->save();

        return response()->json([
            'exterior'=> $data,
            'msg'=> 'ok'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exterior  $exterior
     * @return \Illuminate\Http\Response
     */
    public function show(Exterior $exterior)
    {
        $exterior->reception;
        $exterior->title;

        return response()->json([
            'exterior'=> $exterior,
            'msg' => 'ok'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exterior  $exterior
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exterior $exterior)
    {
        $exterior->idTitle = $request->idTitle;
        $exterior->image = $request->image;
        $exterior->description = $request->description;

        $exterior->update();

        return response()->json([
            'exterior'=> $exterior,
            'msg'=> 'ok'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exterior  $exterior
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exterior $exterior)
    {
        $exterior->delete();
        return $exterior;
    }
}
