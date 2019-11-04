<?php

namespace App\Http\Controllers;

use App\Delivered;
use App\Reception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;
use PDF;

class DeliveredController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $delivered = Delivered::where('idReception', request()->id)->first();
        $delivered->firm = Storage::disk("public")->url($delivered->firm);
        $delivered->photo = Storage::disk("public")->url($delivered->photo);
        $delivered->firmPersonChecks = Storage::disk("public")->url($delivered->firmPersonChecks);

        return response()->json([
            'delivered'=> $delivered,
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
        $data = New Delivered();
        $dt = now();

        $data->idReception = $request->idReception;
        $data->date= $dt->format('y-m-d h:i:s');
        $data->qualification = $request->qualification;
        $data->commentary = $request->commentary;
        $data->personChecks = $request->personChecks;
        $data->userId =  Auth::id();
        if($request->has("photo")){
            $data->photo = $request->file("photo")->store("delivereds", "public");
        };
        if($request->has("firm")){
            $data->firm = $request->file("firm")->store("delivereds", "public");
        };
        if($request->has("firmPersonChecks")){
            $data->firmPersonChecks = $request->file("firmPersonChecks")->store("delivereds", "public");
        };
        $id = request()->idReception;
        $reception = Reception::find($id);
        $reception->state = 'Cerrado';
        $reception->update();
        $data->save();

        $reception = Reception::with([
            "customer", "general.type", "general.brand", "exteriors", "delivered"
        ])->find($id);
        $reception->file = 'storage/' . $reception->file;
        $reception->delivered[0]->firm = 'storage/'. $reception->delivered[0]->firm;
        $reception->delivered[0]->firmPersonChecks = 'storage/'. $reception->delivered[0]->firmPersonChecks;
        $pdf = PDF::loadView('PdfDelivered', ['reception' => $reception]);
        $pdf->save('pdf.pdf');
        $name = 'pdfDelired'. $id . '.pdf';
        Storage::disk('public')->putFileAs('pdfs', new File('pdf.pdf'), $name);

        Mail::raw('Estimado: Gerente' ."\n"."\n".
            'Se ha finalizado la recepción con id: '.$reception->id ."\n".
            'Con Fecha de creación: '. $reception->date . "\n".
            'Fecha de Finalización: ' . $data->date ."\n"."\n".
            'Buen día.', function ($message) use($name){
            $message->to('edwinsandoval1000@gmail.com', 'Encargado');
            $message->subject('Entrega de vehículo');
            $message->priority(3);
            $message->attach('storage/pdfs/' . $name);
        });
        Mail::raw('Estimado(a): '. $reception->customer->name ."\n"."\n".
        'Adjuntamos la contraseña realizada para la entrega de su vehículo.'."\n".
        'Agradeceremos no responda a esta cuenta de correo electrónico. Cualquier duda o servicio que'."\n".
        'desee, llame a nuestro Call Center : 2217-8900.'."\n".
        'Agradecemos su lealtad y preferencia.'."\n".
        'Buen día.', function ($message) use($name, $reception){
        $message->to($reception->customer->email, $reception->customer->name);
        $message->subject('Entrega de su vehículo');
        $message->priority(3);
        $message->attach('storage/pdfs/' . $name);
        });
        return response()->json([
            'delivered'=> $data,
            'msg'=> 'ok'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Delivered  $delivered
     * @return \Illuminate\Http\Response
     */
    public function show(Delivered $delivered)
    {
        $delivered->firm = Storage::disk("public")->url($delivered->firm);
        $delivered->photo = Storage::disk("public")->url($delivered->photo);
        $delivered->firmPersonChecks = Storage::disk("public")->url($delivered->firmPersonChecks);

        return response()->json([
            'delivered'=> $delivered,
            'msg' => 'ok'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Delivered  $delivered
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Delivered $delivered)
    {
        $delivered->qualification = $request->qualification;
        $delivered->commentary = $request->commentary;
        $delivered->firm = $request->firm;
        $delivered->photo = $request->photo;
        $delivered->idEmployee = $request->idEmployee;
        $delivered->firmPersonChecks = $request->firmPersonChecks;

        $delivered->update();

        return response()->json([
            'delivered'=> $delivered,
            'msg'=> 'ok'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Delivered  $delivered
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delivered $delivered)
    {
        $delivered->delete();
        return $delivered;
    }
}
