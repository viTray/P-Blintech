<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Comment::where('idReception', request()->id)->get();
        foreach ($data as $d) {
            $d->images;
            foreach ($d->images as $dd) {
                $dd->image = Storage::disk("public")->url($dd->image);
            }
        };
        return response()->json([
            'comments'=> $data,
            'msg'=> 'ok'
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
        $data = new Comment();
        $dt = now();
        $data->date = $dt->format('y-m-d h:i:s');
        $data->commentary = $request->commentary;
        $data->idReception = $request->idReception;

        $data->save();
        $imagesForEmail = [];
        $existeImagesMail = $request->existImages;
        if($request->existImages == 'si' ){
            $images = $request->filesComment;
            $x = 0;
            foreach ($images as $d) {
                $d['file'] = $d['file']->store("comments", "public");
                $imagesForEmail = Arr::add($imagesForEmail, 'file' . $x, $d['file']);
                $data->images()->create(
                    [
                        "description"=>'sdf',
                        "image"=>$d['file']
                    ]
                );
                $x += 1;
            }
        }
        $customer = Customer::find($request->idCustomer);
        Mail::raw('Estimado(a): '. $customer->name ."\n"."\n".$request->commentary, function ($message) use($customer, $existeImagesMail, $imagesForEmail){
            $message->to($customer->email, $customer->name);
            $message->subject('Seguimiento a su vehículo');
            $message->priority(3);
            if($existeImagesMail == 'si' ){
                foreach ($imagesForEmail as $d) {
                    $message->attach('storage/' . $d);
                }
            }
        });
        return 'ok';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        $comment->reception;
        $comment->images;
        return response()->json([
            'comment'=> $comment,
            'msg' => 'ok'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $comment->commentary = $request->commentary;
        $comment->update();
        return response()->json([
            'comment'=> $comment,
            'msg' => 'ok'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return $comment;
    }
}
