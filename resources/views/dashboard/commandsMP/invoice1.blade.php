@extends('layouts.dashboard')

@section('page_meta')
    <title>Commands</title>
    <meta name="keywords" content="Rozaric"/>
    <meta name="description" content="Rozaric">
    <meta name="author" content="Rozaric">
@endsection

@section('styles')
    <!-- Page styles -->
    <style>
        .spacer{
            margin-top: 30px;
        }
        .title-text-color > b{
            color: #0071fd !important;
            font-size: 41px !important;
        }
        @media print{

            .table-striped > tbody > tr:nth-child(2n) > td, .table-striped > tbody > tr:nth-child(2n) > th {
                background-color: #B4C6E7 !important;
                color: #fff !important;
                -webkit-print-color-adjust: exact;
            }
            .table-striped > tbody > tr:nth-child(2n+1) > td, .table-striped > tbody > tr:nth-child(2n+1) > th {

                color: black !important;
            }
            .table-header{
                background-color: #6b7ae0 !important;
                color: #fff !important;

            }

           @page  {

               margin: 0px;

           }
            #print {
                background-color:white;
                height: 100%;
                width: auto;
                border:none;
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                right: 0;
                z-index:1900;
                visibility: visible;
            }


            .card{
                height:100% !important;
                border:none;
            }

            @page{
                margin:0
            }
            .print-section{
                display:none !important;
            }
            .table-striped tbody tr:nth-of-type(odd){
                background-color: blue !important;
            }
            #Generaldata{
                margin-top:50px;
            }
            .footer-style{
                width:120%;
                position: absolute;
                bottom: 0;
                margin-top:15px;
            }
        }
        .header-style{
            width:100%;
            margin-top:-15px
        }
        .footer-style{
            width:100%;

            margin-top:15px
        }
        .table-striped > tbody > tr:nth-child(2n) > td, .table-striped > tbody > tr:nth-child(2n) > th {
            background-color: #B4C6E7 !important;
            color: #fff !important;
        }
        .table-striped > tbody > tr:nth-child(2n+1) > td, .table-striped > tbody > tr:nth-child(2n+1) > th {

            color: grey;
        }
        .table-header{
            background-color: #6b7ae0 !important;
            color: #fff !important;
        }
    </style>
@endsection

@section('scripts')
    <!-- Page scripts -->
    <script src="/assets/plugins/custom/datatables/datatables.bundle.js"></script>

@endsection

@section('content')
    <div class="container">
        <div id="print">
            <div  class="card card-custom overflow-hidden">
                <div class="card-body p-0">
                    <!-- begin: Invoice-->
                    <!-- begin: Invoice header-->
                    <!-- end: Invoice header-->
                    <!-- begin: Invoice body-->

                    <div class="row  ">
                        <img class="header-style" src="{{URL('/assets/media/header.png')}}"  alt="Chemical"/>
                    </div>

                    <div class="row  py-8 px-8 py-md-10 px-md-0">
                        <div class="col-md-8 pl-9">
                            <div class="justify-content-center">
                                <img src="{{URL('/assets/media/logo.png')}}" width="200" height="200" alt="Chemical"/>

                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="justify-content-right">
                                <h4>Capital Social: 1 000 0000 000 DA</h4>
                                <h4>Compte BEA: 002 000058 05856847216</h4>
                                <h4>RC N°:34/01 0722183 B 98</h4>
                                <h4>A.I:34012110587</h4>
                                <h4>N.I.F:99835072218369</h4>
                            </div>

                        </div>
                    </div>
                    <!-- end: Invoice body-->
                    <!-- begin: Invoice footer-->
                    <div class="row justify-content-left py-8 px-8 py-md-10 px-md-0 ml-10">
                        <div class="col-md-9">
                            <div class="table-responsive">
                                <table class="table">

                                    <tbody>
                                    <tr class="font-weight-boldest font-size-lg">
                                        <td class="pl-0 pt-7">Date: {{date('d-m-Y', strtotime($command->date))}}</td>

                                    </tr>
                                    <tr class="font-weight-boldest border-bottom-0 font-size-lg">
                                        <td class="border-top-0 pl-0 py-4">Client: {{$command->client['name']}} {{$command->client['surname']}}</td>

                                    </tr>
                                    <tr class="font-weight-boldest border-bottom-0 font-size-lg">
                                        <td class="border-top-0 pl-0 py-4">Address: {{$command->client['address']}}</td>

                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice footer-->

                    <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0 ml-10 mr-10">
                        <div class="col-md-12">

                            <h1 class="text-center font-weight-bold title-text-color"> <b>BON LIVRAISON <sub>{{date('m-Y', strtotime($command->date))}}/{{$command->id}}</sub></b></h1>
                            <div class="spacer"></div>
                            <div class="table-responsive ">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr >
                                        <th class="text-center font-weight-bold  text-uppercase">#</th>
                                        <th class="text-center font-weight-bold  text-uppercase">Designation</th>
                                        <th class="text-center font-weight-bold  text-uppercase">Quantité</th>
                                        <th class="text-center font-weight-bold  text-uppercase">Montant</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1 @endphp
                                    @foreach($commandProducts as $product)
                                    <tr class="font-weight-boldest font-size-lg">
                                        <td class=" pt-7 text-center">{{$i}}</td>
                                        <td class="pt-7 text-center">{{$product->product['name']}}</td>
                                        <td class="pt-7 text-center">{{$product->quantity}} * {{number_format($product->price, 2, ',', ' ')}} DA</td>
                                        <td class="pt-7 text-center">{{number_format(($product->quantity*$product->price), 2, ',', ' ')}} DA </td>
                                    </tr>
                                    @php $i++ @endphp
                                   @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0">
                        <div class="col-md-9">
                            <div class="d-flex justify-content-right flex-column flex-md-row font-size-lg" style="float:right">

                                <div class="d-flex flex-column text-md-right">
                                    <span class="font-size-lg font-weight-bolder mb-1">MONTANT A PAYER</span>
                                    <span class="font-size-h2 font-weight-boldest text-danger mb-1">{{number_format($command->amount, 2, ',', ' ')}} DA </span>
                                    <span>{{$amountLetter}}</span>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- begin: Invoice action-->
                    <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0 print-section">
                        <div class="col-md-9">
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-light-primary font-weight-bold" onclick="window.print();">Download Invoice</button>
                                <button type="button" class="btn btn-primary font-weight-bold" onclick="window.print();">Print Invoice</button>

                            </div>
                        </div>
                    </div>



                    <div class="row  ">
                        <img class="footer-style" src="{{URL('/assets/media/footer.png')}}"  alt="Chemical"/>
                    </div>
                    <!-- end: Invoice action-->
                    <!-- end: Invoice-->
                </div>
                </div>

            <div class="spacer"></div>
            <div  class="card card-custom overflow-hidden">
                <div class="card-body p-0">
                    <!-- begin: Invoice-->
                    <!-- begin: Invoice header-->
                    <!-- end: Invoice header-->
                    <!-- begin: Invoice body-->
                    <div class="row  py-8 px-8 py-md-10 px-md-0">
                        <div class="col-md-9 pl-9">
                            <div class="justify-content-center">
                                <img src="{{URL('/assets/media/analyse.png')}}"  alt="Analyse"/>

                            </div>

                        </div>
                    </div>
                    <!-- end: Invoice body-->
                    <!-- begin: Invoice footer-->
                    <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0 ml-10">
                        <div class="col-md-9">
                            <div class="table-responsive">
                                <table class="table">

                                    <tbody>
                                    <tr class="font-weight-boldest border-bottom-0 font-size-lg">
                                        <td class="pl-0 pt-7">Date: {{date('d-m-Y', strtotime($command->date))}}</td>

                                    </tr>
                                    <tr class="font-weight-boldest border-bottom-0 font-size-lg">
                                        <td class=" pl-0 py-4">Client: {{$command->client['name']}} {{$command->client['surname']}}</td>
                                    </tr>
                                    <tr class="font-weight-boldest border-bottom-0 font-size-lg">
                                        <td class=" pl-0 py-4">Address: {{$command->client['address']}}</td>
                                    </tr>
                                    <tr class="font-weight-boldest border-bottom-0 border-bottom-0 font-size-lg">
                                        <td class=" pl-0 py-4">Désignation de produit : {{$product->product['name']}}</td>
                                    </tr>
                                    <tr class="font-weight-boldest border-bottom-0 font-size-lg">
                                        <td class="pl-0 pt-7">Date de livraison : {{date('d-m-Y', strtotime($command->date))}}</td>
                                    </tr>
                                    <tr class="font-weight-boldest  font-size-lg">
                                        <td class="pl-0 pt-7">Lot : HS/LI{{$command->id}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice footer-->

                    <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0 ml-10 mr-10">
                        <div class="col-md-12">
                            <div class="table-responsive ">
                                <table class="table table-bordered ">
                                    <thead>
                                    <tr class="table-header">
                                        <th class="text-center font-weight-bold text-uppercase">Paramètres D’analyse</th>
                                        <th class="text-center font-weight-bold text-uppercase">Résultats</th>
                                        <th class="text-center font-weight-bold text-uppercase">Méthodes</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="font-weight-boldest font-size-lg">

                                        <td class="pt-7 text-center">Degré chlorométrique ch°</td>
                                        <td class="pt-7 text-center">51.35</td>
                                        <td class="pt-7 text-center">Titrimétrie</td>

                                    </tr>

                                    <tr class="font-weight-boldest font-size-lg">

                                        <td class="pt-7 text-center">Excès de soude NaOH</td>
                                        <td class="pt-7 text-center">08</td>
                                        <td class="pt-7 text-center">Titrimétrie</td>

                                    </tr>
                                    <tr class="font-weight-boldest font-size-lg">

                                        <td class="pt-7 text-center">Chlore actif</td>
                                        <td class="pt-7 text-center">160.5</td>
                                        <td class="pt-7 text-center">Titrimétrie</td>

                                    </tr>
                                    <tr class="font-weight-boldest font-size-lg">

                                        <td class="pt-7 text-center">Fer (Fe) ppm</td>
                                        <td class="pt-7 text-center"><0.02</td>
                                        <td class="pt-7 text-center">Titrimétrie</td>

                                    </tr>
                                    <tr class="font-weight-boldest font-size-lg">

                                        <td class="pt-7 text-center">Densité</td>
                                        <td class="pt-7 text-center">1.221</td>
                                        <td class="pt-7 text-center">Densimètre </td>

                                    </tr>
                                    <tr class="font-weight-boldest font-size-lg">

                                        <td class="pt-7 text-center">Odeur</td>
                                        <td class="pt-7 text-center">Chlore</td>
                                        <td class="pt-7 text-center"></td>

                                    </tr>
                                    <tr class="font-weight-boldest font-size-lg">

                                        <td class="pt-7 text-center">Aspect</td>
                                        <td class="pt-7 text-center">Jaunâtre</td>
                                        <td class="pt-7 text-center">Inspection visuelle</td>

                                    </tr>





                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <!-- begin: Invoice action-->
                    <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0 print-section">
                        <div class="col-md-9">
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-light-primary font-weight-bold" onclick="window.print();">Download Invoice</button>
                                <button type="button" class="btn btn-primary font-weight-bold" onclick="window.print();">Print Invoice</button>

                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice action-->
                    <!-- end: Invoice-->
                </div>
            </div>
            <div class="spacer"></div>

            <div  class="card card-custom overflow-hidden">
                <div class="card-body p-0">
                    <div class="row  py-8 px-8 py-md-10 px-md-0 m-30">
                        <div id="Generaldata" class="col-md-9 mt-50">
                            <h4>Ticket: {{$command->id}}</h4>
                            <div class="spacer"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Date:&nbsp &nbsp {{date('d-m-Y', strtotime($command->date))}}</h4>
                                </div>
                                <div class="col-md-6">
                                    <h4>Heure:08:00</h4>
                                </div>


                            </div>
                            <div class="spacer"></div>

                            <h4>Matricule: &nbsp &nbsp 1887-585-19</h4>
                            <div class="spacer"></div>
                            <h4>Produit: &nbsp &nbsp {{$commandProducts[0]->product->name}}</h4>
                            <div class="spacer"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Tare :&nbsp &nbsp 14740 KG</h4>
                                </div>
                                <div class="col-md-6">
                                    <h4>Heure: 08:15</h4>
                                </div>


                            </div>
                            <div class="spacer"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Brut :&nbsp &nbsp {{14740 + ($commandProducts[0]->quantity * 1200)}} KG</h4>
                                </div>
                                <div class="col-md-6">
                                    <h4>Heure: 09:23</h4>
                                </div>


                            </div>
                            <div class="spacer"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Net: {{$commandProducts[0]->quantity * 1200}} KG </h4>
                                </div>



                            </div>
                            <div class="spacer"></div>
                            <h4>Chauffeur: &nbsp &nbsp Diab Houcine</h4>
                        </div>

                    </div>
                    <!-- begin: Invoice action-->
                    <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0 print-section">
                        <div class="col-md-9">
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-light-primary font-weight-bold" onclick="window.print();">Download Invoice</button>
                                <button type="button" class="btn btn-primary font-weight-bold" onclick="window.print();">Print Invoice</button>

                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice action-->

                </div>
            </div>
            <div class="spacer"></div>

            <div  class="card card-custom overflow-hidden">
                <div class="card-body p-0">
                    <!-- begin: Invoice-->
                    <!-- begin: Invoice header-->
                    <!-- end: Invoice header-->
                    <!-- begin: Invoice body-->
                    <div class="row  py-8 px-8 py-md-10 px-md-0">
                        <div class="col-md-3 pl-9">
                            <div class="justify-content-center">
                                <img src="{{URL('/assets/media/logo2.PNG')}}" width="200" height="200" alt="Chemical"/>

                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="justify-content-right">
                                <h2>ROUMILI ALI DAYAAEDDINE</h2>
                                <h3>ADDRESSE: CITE EL DJABS GUELLAL</h3>
                                <h3>CITE: Sétif 19000</h3>
                                <h3>PAYS: Algérie</h3>
                                <h3>
                                    Email : ALI.DAYAEDDINE@gmail.com

                                </h3>
                                <h3>Description: Spécialisé dans la revente de la
                                    matiere premiere: chlore de désinfection et
                                    dérivés</h3>
                                <h3>Fax: 036.84.46.84
                                </h3>
                                <h3>Portable: 07.83.91.69.24
                                </h3>


                            </div>

                        </div>

                        <div class="col-md-3">
                            <div class="justify-content-right">
                                <h6>N.I.F:19519010173314500000</h6>
                                <h6>N° RC: 20-A-5368191-19/00</h6>
                                <h6>N.ART: 19481171020</h6>
                            </div>

                        </div>
                    </div>
                    <!-- end: Invoice body-->
                    <!-- begin: Invoice footer-->
                    <div class="row justify-content-left py-8 px-8 py-md-10 px-md-0 ml-10">
                        <div class="col-md-9">
                            <div class="table-responsive">
                                <table class="table">

                                    <tbody>
                                    <tr class="font-weight-boldest border-bottom-0 font-size-lg">
                                        <td class="pl-0 pt-7">Facture Profoma</td>

                                    </tr>
                                    <tr class="font-weight-boldest border-bottom-0 font-size-lg">
                                        <td class="pl-0 pt-7">Mode de paiement: à terme </td>

                                    </tr>
                                    <tr class="font-weight-boldest font-size-lg">
                                        <td class="pl-0 pt-7">Date: {{date('d-m-Y', strtotime($command->date))}}</td>

                                    </tr>
                                    <tr class="font-weight-boldest border-bottom-0 font-size-lg">
                                        <td class="border-top-0 pl-0 py-4">Client: {{$command->client['name']}} {{$command->client['surname']}}</td>

                                    </tr>
                                    <tr class="font-weight-boldest border-bottom-0 font-size-lg">
                                        <td class="border-top-0 pl-0 py-4">Address: {{$command->client['address']}}</td>

                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center overflow-hidden mr-2 border pt-2">
                                @if($command->client['NRC'] != "")
                                <h6>N°RC:{{$command->client['NRC']}}</h6>
                                @endif
                                @if($command->client['NART'] != "")
                                <h6>A.I:{{$command->client['NART']}}</h6>
                                @endif
                                @if($command->client['NIF'] != "")
                                <h6>N.I.F:{{$command->client['NIF']}}</h6>
                                @endif
                                @if($command->client['NIS'] != "")
                                <h6>N.I.S:{{$command->client['NIS']}}</h6>
                                @endif


                            </div>

                        </div>
                    </div>
                    <!-- end: Invoice footer-->

                    <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0 ml-10 mr-10">
                        <div class="col-md-12">

                            <div class="spacer"></div>
                            <div class="table-responsive ">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="text-center font-weight-bold  text-uppercase">#</th>
                                        <th class="text-center font-weight-bold  text-uppercase">Designation</th>
                                        <th class="text-center font-weight-bold  text-uppercase">Quantité</th>
                                        <th class="text-center font-weight-bold  text-uppercase">Montant</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1 @endphp
                                    @foreach($commandProducts as $product)
                                        <tr class="font-weight-boldest font-size-lg">
                                            <td class=" pt-7 text-center">{{$i}}</td>
                                            <td class="pt-7 text-center">{{$product->product['name']}}</td>
                                            <td class="pt-7 text-center">{{$product->quantity}} * {{number_format($product->price, 2, ',', ' ')}} DA</td>
                                            <td class="pt-7 text-center">{{number_format(($product->quantity*$product->price), 2, ',', ' ')}} DA </td>
                                        </tr>
                                        @php $i++ @endphp
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center  py-8 px-8 py-md-10 px-md-0">
                        <div class="col-md-9">
                            <div class="d-flex justify-content-right flex-column flex-md-row font-size-lg" style="float:right">

                                <div class="table-responsive ">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td class="text-center font-weight-bold  text-uppercase">MONTANT HT</td>
                                            <td class="text-center font-weight-bold  text-uppercase">{{number_format($command->amount, 2, ',', ' ')}} DA </td>


                                        </tr>
                                        <tr>
                                            <td class="text-center font-weight-bold  text-uppercase">TVA 19%</td>
                                            <td class="text-center font-weight-bold  text-uppercase">{{number_format($command->amount*0.19, 2, ',', ' ')}} DA </td>


                                        </tr>
                                        <tr>
                                            <td class="text-center font-weight-bold  text-uppercase">MONTANT TTC</td>
                                            <td class="text-center font-weight-bold  text-uppercase">{{number_format($command->amount*1.19, 2, ',', ' ')}} DA </td>


                                        </tr>
                                        </tbody>

                                    </table>
                                    <span class="text-center">La Facture est arrêté à : {{$amountLetterTTC}}</span>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- begin: Invoice action-->
                    <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0 print-section">
                        <div class="col-md-9">
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-light-primary font-weight-bold" onclick="window.print();">Download Invoice</button>
                                <button type="button" class="btn btn-primary font-weight-bold" onclick="window.print();">Print Invoice</button>

                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice action-->
                    <!-- end: Invoice-->
                </div>
            </div>
        </div>
        <!-- begin::Card-->

        <!-- end::Card-->
    </div>
@endsection
