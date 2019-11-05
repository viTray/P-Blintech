<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Reception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class ReceptionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data =  DB::table('cuarto')->get();
        return response()->json([
            'receptions'=> $data,
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
        $general =  json_decode($request->general);
        $accessories = $request->accessories;
        $exteriors = $request->exteriors;

        $data = new Reception();
        $dt = now();
        $data->date = $dt->format('y-m-d h:i:s');
        $data->state = 'Abierto';
        $data->idCustomer = $request->idCustomer;
        $data->description = $request->description;
        $data->type = $request->type;
        $data->file = $request->file('fileFirm')->store("receptions", "public");
        $data->save();
        $data->general()->create(
            [
                "circulation"=>$general->circulation,
                "authenticatedCirculation"=>$general->authenticatedCirculation,
                "level"=>$general->level,
                "owner"=>$general->owner,
                "idBrand"=>$general->idBrand,
                "idType"=>$general->idType,
                "color"=>$general->color,
                "mileage"=>$general->mileage,
                "licensePlate"=>$general->licensePlate,
                "chassis"=>$general->chassis,
                "person"=>$general->person,
                "phone"=>$general->phone,
                "userId" => Auth::id()
            ]
        );
        foreach ($accessories as $d) {
            if($d['file'] !== '/'){
                $d['file'] = $d['file']->store("accessories", "public");
            }
            $data->accessorys()->create(
                [
                    "state"=>$d['state'],
                    "extra"=>$d['extra'],
                    "description"=>$d['description'],
                    "idTitle"=>$d['idTitle'],
                    "file"=>$d['file']
                ]
            );
        };
        foreach ($exteriors as $d) {
            $d['file'] = $d['file']->store("exteriors", "public");
            if($d['description'] == ''){
                $d['description'] = 'Sin descripción';
            }
            $data->exteriors()->create(
                [
                    "title"=>$d['title'],
                    "description"=>$d['description'],
                    "file"=>$d['file']
                ]
            );
        }
        if($request->existImages == 'si' ){
            $images = $request->clientImages;
            foreach ($images as $d) {
                $d['file'] = $d['file']->store("receptions", "public");
                $data->images()->create(
                    [
                        "description"=>'sdf',
                        "file"=>$d['file']
                    ]
                );
            }
        }
        $customer = Customer::find($request->idCustomer);
        Mail::raw('Estimado(a): '. $customer->name ."\n"."\n".
        'Adjuntamos la contraseña realizada para su vehiculo.'."\n".
        'Agradeceremos no responda a esta cuenta de correo electrónico. Cualquier duda o servicio que'."\n".
        'desee, llame a nuestro Call Center : 2217-8900.'."\n".
        'Agradecemos su lealtad y preferencia.', function ($message) use($customer, $data) {
            $id = $data['id'];
            $reception = Reception::with([
                "customer", "general.type", "general.brand", "exteriors", "images", "accessorys.title"
            ])->find($id);
            $reception->file = 'storage/' . $reception->file;
            $reception = Arr::add($reception, 'count', 0);
            foreach ($reception->accessorys as $d) {
                if($d->file !== '/'){
                    $d->file = 'storage/' . $d->file;
                    $reception = Arr::set($reception, 'count', 1);
                }
            }
            foreach ($reception->exteriors as $d) {
                $d->file = 'storage/' . $d->file;
            }
            foreach ($reception->images as $d) {
                $d->file = 'storage/' . $d->file;
            }

            $pdf = PDF::loadView('PdfReception', ['reception' => $reception]);
            $pdf->save('pdf.pdf');
            Storage::disk('public')->putFileAs('pdfs', new File('pdf.pdf'), 'pdf'. $id . '.pdf');

            $message->to($customer->email, $customer->name);
            $message->subject('Recepción de  su vehículo');
            $message->priority(3);
            $message->attach('storage/pdfs/' . 'pdf'. $id . '.pdf');
        });
        return response()->json([
            'reception'=> $data,
            'msg' => 'ok'
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function show(Reception $reception)
    {
        $reception->file = Storage::disk("public")->url($reception->file);
        $reception->customer;
        $reception->general;
        $reception->accessorys;
        foreach ($reception->accessorys as $d) {
            $d->title;
        }
        return response()->json([
            'reception'=> $reception,
            'msg' => 'ok'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reception $reception)
    {
        $reception->description = $request->description;
        $reception->state = $request->state;
        $reception->update();
        return response()->json([
            'reception'=> $reception,
            'msg' => 'ok'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reception  $reception
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reception $reception)
    {
        $reception->delete();
        return response()->json([
            'reception'=> $reception,
            'msg' => 'ok'
        ]);
    }
}
