<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reception;
use App\Customer;
use Illuminate\Support\Facades\Mail;
use PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Arr;

class MailB extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $reception = Reception::find(request()->idReception);
        $customer = Customer::find($reception->customer->id);
        Mail::raw('Estimado(a): '. $customer->name ."\n"."\n".
        'Adjuntamos la contraseña realizada para su vehiculo.'."\n".
        'Agradeceremos no responda a esta cuenta de correo electrónico. Cualquier duda o servicio que'."\n".
        'desee, llame a nuestro Call Center : 2217-8900.'."\n".
        'Agradecemos su lealtad y preferencia.', function ($message) {
            $id = request()->idReception;
            $reception = Reception::with([
                "customer", "general.type", "general.brand", "exteriors", "images", "accessorys.title"
            ])->find($id);
            $reception->file = 'storage/' . $reception->file;
            $reception = Arr::add($reception, 'count', 0);
            foreach ($reception->accessorys as $d) {
                if($d->file !== '/'){
                    $d->file = 'storage/' . $d->file;
                    $reception = Arr::add($reception, 'count', 1);
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

            $customer = Customer::find($reception->customer->id);
            $message->to($customer->email, $customer->name);
            $message->subject('Seguimiento a su vehículo');
            $message->priority(3);
            $message->attach('storage/pdfs/' . 'pdf'. $id . '.pdf');
        });
        return 'ok-ok';

    }
}
