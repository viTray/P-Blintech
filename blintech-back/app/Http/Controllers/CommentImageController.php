<?php

namespace App\Http\Controllers;

use App\CommentImage;
use Illuminate\Http\Request;

class CommentImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CommentImage::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new CommentImage();
        $data->idComment = $request->idComment;
        $data->description = $request->description;
        $data->image = $request->file;
        if($request->has("file")){
            $data->image = $request->file("file")->store("comments", "public");
        };
        $data->save();

        return response()->json([
            'commentImage'=> $data,
            'msg'=> 'ok'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CommentImage  $commentImage
     * @return \Illuminate\Http\Response
     */
    public function show(CommentImage $commentImage)
    {
        $commentImage->comment;
        return response()->json([
        'commentImage'=>$commentImage,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CommentImage  $commentImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommentImage $commentImage)
    {
        $commentImage->image = $request->image;
        $commentImage->description = $request->description;
        $commentImage->update();
        return response()->json([
            'commentImage'=> $commentImage,
            'msg' => 'ok'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CommentImage  $commentImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommentImage $commentImage)
    {
        $commentImage->delete();
        return response()->json([
            'commentImage'=> $commentImage,
            'msg' => 'ok'
        ]);
    }
}
