<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\PDF;
use Dompdf\Dompdf;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    function imprimir() {
        $pdf = PDF::loadHtml('PdfReception');
        return $pdf->stream();
    }
}
