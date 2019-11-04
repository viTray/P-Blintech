<?php

namespace App\Http\Controllers;

use App\Title;
use Illuminate\Http\Request;

class TitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Title::all();
        return response()->json([
            'titles'=> $data,
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
        $data = new Title();
        $data->description = $request->description;
        $data->save();

        return response()->json([
            'title'=> $data,
            'msg'=> 'ok'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Title  $title
     * @return \Illuminate\Http\Response
     */
    public function show(Title $title)
    {
        return $title;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Title  $title
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Title $title)
    {
        $title->description = $request->description;
        $title->update();
        return response()->json([
            'title'=> $title,
            'msg' => 'ok'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Title  $title
     * @return \Illuminate\Http\Response
     */
    public function destroy(Title $title)
    {
        $title->delete();
        return $title;
    }
}
