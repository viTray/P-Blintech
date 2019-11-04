<?php

namespace App\Http\Controllers;

use App\ReceptionImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReceptionImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ReceptionImage::where('idReception', request()->id)->get();
        foreach ($data as $d) {
            $d->file = Storage::disk("public")->url($d->file);
        };
        return response()->json([
            'receptionImages'=> $data,
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
        $data = new ReceptionImage();
        $data->idReception = $request->idReception;
        $data->description = $request->description;
        if($request->has("file")){
            $data->file = $request->file("file")->store("receptions", "public");
        };
        $data->save();

        return response()->json([
            'receptionImage'=> $data,
            'msg'=> 'ok'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReceptionImage  $receptionImage
     * @return \Illuminate\Http\Response
     */
    public function show(ReceptionImage $receptionImage)
    {
        $receptionImage->file = Storage::disk("public")->url($receptionImage->file);
        $receptionImage->reception;
        return response()->json([
            'receptionImage'=> $receptionImage,
            'msg' => 'ok'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReceptionImage  $receptionImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReceptionImage $receptionImage)
    {
        $receptionImage->image = $request->image;
        $receptionImage->description = $request->description;
        $receptionImage->update();
        return response()->json([
            'receptionImage'=> $receptionImage,
            'msg' => 'ok'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReceptionImage  $receptionImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReceptionImage $receptionImage)
    {
        $receptionImage->delete();
        return response()->json([
            'receptionImage'=> $receptionImage,
            'msg' => 'ok'
        ]);
    }
}
