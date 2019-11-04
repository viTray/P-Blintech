<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PDF</title>
        <style>
            @page {
                margin: 0cm 0cm;
                margin-top: 1cm;
            }
            .page-margin {
                margin: 0cm 1.5cm;
            }
            html {
                font-family: Arial, Helvetica, sans-serif;
                padding: 20px;
                font-size: 10px;
                width: 100%;
            }
            body {
                width: 100%;
                height: 100%;;
            }
            .width-1-1{
                width: 100%;
            }
            .width-1-2{
                width: 50%;
            }
            .center {
                text-align: center;
                align-items: center;
            }
            .title{
                color: #3f4458;
                padding-top: 10px;
            }
            .title-white{
                text-align: left;
            }
            .text-right {
                text-align: right;
            }
            .text-left {
                text-align: left;
            }.
            .text-center {
                text-align: center;
            }
            .text-primary {
                color: #3f4458;
            }
            .float-left {
                float: left;
            }
            .padding {
                padding: 10px;
                padding-bottom: 5px;
            }
            .padding-left {
                padding-left: 40px;
            }
            .margin-top{
                margin-top: 20px;
            }
            .general {
                width: 100%;
                height: 115px;
            }
            .border-bottom{
                border-bottom: 1px solid darkgrey;
            }
            .bloque{
                height: 120px;
            }
            .bloque-firma{
                height: 150px;
            }
            header{
            }
            header table{
                width: 100%;
                text-align: left;
            }
            header table tr td{
                width: 33%;
                text-align: center;
                align-content: center;
                align-items: center;
            }
            footer table tr td{
                width: 33%;
                text-align: center;
                align-content: center;
                align-items: center;
                color: white;
            }
            footer table{
                width: 100%;
            }
            footer {
                position: fixed;
                bottom: 0cm;
                left: 0cm;
                right: 0cm;
                height: 3cm;
                padding-left: 1cm;
                /** Extra personal styles **/
                background-color: #242D64;
                color: white;
            }
        </style>
    </head>
    <body>
        <header class="width-1-1 center">
            <table>
                <tr>
                    <td>
                        <h3 class="title" style="margin-top: -20px;">Tel: (502) 2217-8900</h3>
                    </td>
                    <td>
                        <img src="assets/logox.png" width="160px" alt="">
                    </td>
                    <td>
                        <a href="https://www.facebook.com/blintechsagt/"><img src="assets/facebook.png" width="30px" alt=""></a>
                        <a href="https://www.youtube.com/channel/UC0iliAZDhBimny6YjaJw3_A"><img src="assets/youtube.png" width="30px" alt=""></a>
                    </td>
                </tr>
            </table>
        </header>
        <div class="page-margin">
                <div class="width-1-1">
                        <p>
                            {{ $reception->date }} <br>
                            {{ $reception->id }}
                        </p>
                    </div>
                    <div class="general">
                        <h3 class="title"> General- Descripción de Vehículo </h3>
                        <table class="border-bottom width-1-1">
                            <tbody>
                                <tr>
                                    <td>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>Propietario:</td>
                                                    <td class="text-left">{{ $reception->general[0]->owner }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tarjeta de Circulación:</td>
                                                    <td class="text-left">{{ $reception->general[0]->circulation }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tarjeta de Circulación Autenticada:</td>
                                                <td class="text-left">{{ $reception->general[0]->authenticatedCirculation }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Kilometraje:</td>
                                                    <td class="text-left">{{ $reception->general[0]->mileage }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Nivel de Gasolina:</td>
                                                    <td class="text-left">{{ $reception->general[0]->level }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td class="padding-left">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>Marca de Vehículo:</td>
                                                    <td class="text-left">{{ $reception->general[0]->brand->description }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tipo de Vehículo:</td>
                                                    <td class="text-left">{{ $reception->general[0]->type->description }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Placa del vehiculo:</td>
                                                    <td class="text-left">{{ $reception->general[0]->licensePlate }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Color del Vehículo:</td>
                                                    <td class="text-left">{{ $reception->general[0]->color }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Chasis:</td>
                                                    <td class="text-left">{{ $reception->general[0]->chassis }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="accessorios">
                        <h3 class="title"> Accessorios del Vehículo </h3>
                        <table class="border-bottom width-1-1">
                            <tr>
                                <td>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Descripcion</th>
                                                <th class="text-right">Tiene</th>
                                                <th class="text-right">Extra</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @foreach($reception->accessorys as $d)
                                                @if($loop->index < ($reception->accessorys->count()/2))
                                                <tr>
                                                    <td>{{ $d->title->description}}</td>
                                                    <td class="text-right">{{$d->state}}</td>
                                                    <td class="text-right">{{$d->extra}}</td>
                                                </tr>
                                                @endif
                                                @endforeach
                                        </tbody>
                                    </table>
                                </td>
                                <td class="padding-left">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Descripcion</th>
                                                <th class="text-right">Tiene</th>
                                                <th class="text-right">Extra</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($reception->accessorys as $d)
                                            @if($loop->index > ($reception->accessorys->count()/2))
                                            <tr>
                                                <td>{{ $d->title->description}}</td>
                                                <td class="text-right">{{$d->state}}</td>
                                                <td class="text-right">{{$d->extra}}</td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="width-1-1">
                        <h3 class="title">Exteriores del Vehículo</h3>
                        <table class="border-bottom width-1-1">
                            <tr>
                                @foreach($reception->exteriors as $d)
                                @if($loop->index < 2)
                                <td>
                                    <div class="padding">
                                            <p>{{ $d->title }}: <br> {{ $d->description }} </p> <img src="{{ $d->file }}" width="300px" alt="">
                                    </div>
                                </td>
                                @endif
                                @endforeach
                            </tr>
                            <tr>
                                @foreach($reception->exteriors as $d)
                                @if($loop->index > 1)
                                <td>
                                    <div class="padding">
                                            <p>{{ $d->title }}: <br> {{ $d->description }} </p>   <img src="{{ $d->file }}" width="300px" alt="">
                                    </div>
                                </td>
                                @endif
                                @endforeach
                            </tr>
                        </table>
                    </div>
                    <div class="width-1-1">
                        @if($reception->count > 0)
                        <h3 class="title">Galeria de accessorios y herramientas</h3> <br>
                        <table class="border-bottom width-1-1">
                            <tr>
                                @foreach($reception->accessorys as $d)
                                @if($d->file !== '/')
                                <td>
                                    <div class="padding">
                                        <img src="{{ $d->file}}" width="120px" alt=""> <p>{{ $d->title->description}}: <br> {{ $d->description}}</p>
                                    </div>
                                </td>
                                @endif
                                @endforeach
                            <tr>
                        </table>
                        @endif
                        <div class="width-1-1 margin-top">
                            <h3>Asesor de servicio: {{ $reception->general[0]->person }}</h3>
                            </div>
                            <div class="width-1-1 text-center">
                                <h3>Firma del Cliente:</h3>
                                <img src="{{ $reception->file }}" width="150px" alt="">
                            </div>
                    </div>
        </div>
        <footer>
            <table>
                <tr>
                    <td>
                        <h3 class="title-white">Tel: (502) 2217-8900</h3>
                        <h3 class="title-white">Av. Petapa 43-31 Bodega A zona 12 Guatemala C.A.</h3>
                        <h3 class="title-white">info@blintechsa.com</h3>

                    </td>
                    <td>
                        <img src="assets/logow.png" width="160px" alt="">
                    </td>
                    <td>
                        <a href="https://www.facebook.com/blintechsagt/" target="_blank"><img src="assets/facebookw.png" width="30px" alt=""></a>
                        <a href="https://www.youtube.com/channel/UC0iliAZDhBimny6YjaJw3_A" target="_blank"><img src="assets/youtubew.png" width="30px" alt=""></a>
                    </td>
                </tr>
            </table>
        </footer>
    </body>
</html>
