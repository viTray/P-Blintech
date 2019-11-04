<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reception;
use PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;


class Gpdf extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generate()
    {
        $reception = Reception::with([
            "customer", "general.type", "general.brand", "exteriors", "delivered"
        ])->find(2);
        $reception->file = 'storage/' . $reception->file;
        $reception->delivered[0]->firm = 'storage/'. $reception->delivered[0]->firm;
        $reception->delivered[0]->firmPersonChecks = 'storage/'. $reception->delivered[0]->firmPersonChecks;
        $pdf = PDF::loadView('PdfDelivered', ['reception' => $reception]);
        return $pdf->stream();
    }
}
