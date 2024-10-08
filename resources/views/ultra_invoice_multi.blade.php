<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<head>
    <title>
        Factures
    </title>
    <style>
        #invoice{
            padding: 30px;
        }

        .invoice {
            position: relative;
            background-color: #FFF;
            min-height: 680px;
            padding: 15px
        }

        .invoice header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #3989c6
        }

        .invoice .company-details {
            text-align: right
        }


        .invoice .company-details .name {
            margin-top: 0;
            margin-bottom: 0;
            border: 1px solid black;
            width: fit-content;
            padding:20px;
            float: right;
        }

        .invoice .contacts {
            margin-bottom: 20px
        }

        .invoice .invoice-to {
            text-align: left
        }

        .invoice .invoice-to .to {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .invoice-details {
            text-align: right
        }

        .invoice .invoice-details .invoice-id {
            margin-top: 0;
            color: #3989c6
        }

        .invoice main {
            padding-bottom: 50px
        }

        .invoice main .thanks {
            margin-top: -100px;
            font-size: 2em;
            margin-bottom: 50px
        }

        .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid #3989c6
        }

        .invoice main .notices .notice {
            font-size: 1.2em
        }

        .invoice table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
            border: 1px solid #000000;
        }

        table, th, td {
            border: 1px solid #000000 !important;
        }

        .invoice table td,.invoice table th {
            padding: 7px;
            background: #fff;
            border-bottom: 1px solid #fff
        }

        .invoice table th {
            white-space: nowrap;
            font-weight: 400;
            font-size: 16px
        }

        .invoice table td h3 {
            margin: 0;
            font-weight: 400;
            color: #000000;
            font-size: 1.2em
        }

        .invoice table .qty,.invoice table .total,.invoice table .unit {
            text-align: right;
            font-size: 1.2em
        }

        .invoice table .no {
            color: #000000;
            font-size: 1.2em;
            background: #fff
        }

        .invoice table .unit {
            background: #fff
        }

        .invoice table .total {
            background: #fff;
            color: #000000;
        }

        .invoice table tbody tr:last-child td {
            border: none
        }

        .invoice table tfoot td {
            background: 0 0;
            border-bottom: none;
            white-space: nowrap;
            text-align: right;
            padding: 10px 20px;
            font-size: 1.2em;
            border-top: 1px solid #aaa
        }

        .invoice table tfoot tr:first-child td {
            border-top: none
        }

        .invoice table tfoot tr:last-child td {
            color: #3989c6;
            font-size: 1.4em;
            border-top: 1px solid #3989c6
        }

        .invoice table tfoot tr td:first-child {
            border: none
        }

        .invoice footer {
            width: 100%;
            text-align: center;
            color: #777;
            border-top: 1px solid #aaa;
            padding: 8px 0
        }
        .right-col{
            max-width: 31% !important;
        }

        @media print {
            #invoice_body {

                font-size: 11px!important;
                overflow: hidden!important
            }
            #invoice_print{
                display:none;
            }

            .invoice footer {
                position: absolute;
                bottom: 10px;
                page-break-after: always
            }

            .invoice>div:last-child {
                page-break-before: always
            }

        *{
                color-adjust: exact !important;

                -webkit-print-color-adjust: exact;
            }
        }
        .removeBorder{
            border: 0px !important;
        }
    </style>
</head>
<script>
    $(document).ready(function(){
        console.log("pop");
        $('#printInvoice').click(function(){
            Popup($('.invoice')[0].outerHTML);
            function Popup(data)
            {
                window.print();
                return true;
            }

        });
    });



</script>
<!--Author      : @arboshiki-->
<div id="invoice">

    <div class="toolbar hidden-print" id="invoice_print">
        <div class="text-right">
            <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Imprimer</button>
        </div>
        <hr>
    </div>
    @foreach($invoices as $invoice)
    <div class="invoice overflow-auto" id="invoice_body">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class=" row" STYLE="width: 100%">
                        <div   style="width: 20%" >
                           @if($invoice['company']->getFirstMedia('avatars') != null)
                            <img src="{{$invoice['company']->getFirstMedia('avatars')->getURL()}}" data-holder-rendered="true" width="200" height="150"/>
                           @endif
                        </div>
                        <div class="col" style="width:40%;">
                            <h5>{{$invoice['company']->name}}</h5>
                            @if($invoice['company']->profession != "")
                                <br/>
                                <h5>{{$invoice['company']->profession}}</h5>
                            @endif
                            <br/>
                            <h5>{{$invoice['company']->address}}</h5>

                            <br/>
                            <h5>Capital Social: {{$invoice['company']->capital}}</h5>
                            <br/>
                            <h5>Tel/Fax: {{$invoice['company']->phone}}</h5>
                            <br/>
                            <h5>Email: {{$invoice['company']->email}}</h5>
                            <br/>
                        </div>
                        <div class="col right-col"  style="    align-self: center;">
                            <div style="border: 1px solid black; padding: 10px">

                                    <h6>N°AI: {{$invoice['company']->NART}}</h6>


                                    <h6>N°RC: {{$invoice['company']->NRC}}</h6>


                                    <h6>N°IS: {{$invoice['company']->NIS}}</h6>


                                    <h6>N°IF: {{$invoice['company']->NIF}}</h6>

                            </div>




                        </div>
                    </div>


                </div>
            </header>

               <main>
                            <div class="row contacts">
                                <div class="col invoice-to">
                                    <h6><b>Facture :</b> FAJ/{{date('Y', strtotime($invoice['command']->date))}}/{{sprintf("%02d", $invoice['command']->fac_id)}}
                                    </h6>
                                    <h6>
                                        </br>

                                      <!-- <h6><b>Mode de paiement:</b>  versement Banquer</h6>-->
                                        <h6><b>Mode de paiement:</b>  {{$invoice['command']->payment->type}}</h6>

                                    </h6>
                                    <br/>
                                    <h6><b>Patient:</b> {{$invoice['command']->client->name}} {{$invoice['command']->client->surname}}</h6>
                                    <br/>

                                    <h6><b>address:</b> {{$invoice['command']->client->address}}</h6>

                                    @if($invoice['command']->client->profession != "")
                                        <br/>
                                        <h6><b>Activité:</b> {{$invoice['command']->client->profession}}</h6>
                                    @endif
                                        <br/>
                                    <h6><b>Sétif le: </b>{{date("d/m/Y", strtotime($invoice['command']->date))}}</h6>

                                </div>
                                <div class="col right-col" style="    align-self: center;">
                                    <div style="border: 1px solid black; padding: 10px">
                                        @if($invoice['command']->client->NRC)
                                            <h6>N°RC: {{$invoice['command']->client->NRC}}</h6>
                                        @endif
                                        @if($invoice['command']->client->NIF)
                                            <h6>N°IF: {{$invoice['command']->client->NIF}}</h6>
                                        @endif
                                        @if($invoice['command']->client->NART)
                                            <h6>N°ART: {{$invoice['command']->client->NART}}</h6>
                                        @endif
                                        @if($invoice['command']->client->NIS)
                                            <h6>N°IS: {{$invoice['command']->client->NIS}}</h6>
                                        @endif
                                    </div>



                                </div>
                            </div>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Quantité</th>
                                    <th class="text-center">Prix unitaire</th>
                                    <th class="text-center">Prix</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php  $i=1 @endphp
                                @foreach($invoice['commandProducts'] as $commandProduct)
                                    <tr>
                                        <td class="no">{{$i}}</td>
                                        <td class="text-left">
                                            <h3>
                                                {{$commandProduct->product->name}}

                                            </h3>


                                        </td>
                                        <td class="unit text-left">{{$commandProduct->quantity}}</td>
                                        <td class="qty text-left">{{sprintf('%0.2f', $commandProduct->price)}} DA</td>
                                        <td class="total text-left">{{sprintf('%0.2f', $commandProduct->amount)}} DA</td>
                                    </tr>
                                    @php  $i++ @endphp

                                    @endforeach
                                </tbody>


                            </table>


                            <table STYLE="width: 40%;margin-left:60%;">
                                <thead>
                                    <tr style="height: 10px">

                                        <td >Montant HT</td>
                                        <td>{{sprintf('%0.2f',$invoice['command']->amount)}} DA</td>
                                    </tr>
                                    <tr>

                                        <td >TVA 19%</td>
                                        <td>{{sprintf('%0.2f',$invoice['command']->amount*0.19)}} DA</td>
                                    </tr>

                                    @if($invoice['command']->payment_type == 1)
                                      <tr>
                                     <td >Timbre 1%</td>
                                                                <td>{{sprintf('%0.2f',$invoice['command']->amount*1.01)}} DA</td>
                                    </tr>
                                     <tr>
                                     <td >Montant TTC</td>
                                        <td>{{sprintf('%0.2f',$invoice['command']->amount*1.20)}} DA</td>
                                    </tr>
                                    @else
                                    <tr>
                                     <td >Montant TTC</td>
                                                                <td>{{sprintf('%0.2f',$invoice['command']->amount*1.19)}} DA</td>
                                    </tr>
                                    @endif
                                </thead>
                            </table>

                            <div >
                                <span style="font-size: 23px;"><b>Arrêtée la présente facture a la somme de : {{$invoice['amountLetter']}} </b></span>

                            </div>
                            </br>

                            <div CLASS="text-center">
                                </br>   </br>   </br>
                                <span CLASS="text-center" style="font-size: 23px;font-weight: bold;">Cacher et Signature </span>

                            </div>

                        </main>


        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->

    </div>
    @endforeach
</div>
