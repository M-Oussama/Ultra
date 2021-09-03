<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<head>
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
            margin-bottom: 20px
        }

        .invoice table td,.invoice table th {
            padding: 15px;
            background: #eee;
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
            color: #3989c6;
            font-size: 1.2em
        }

        .invoice table .qty,.invoice table .total,.invoice table .unit {
            text-align: right;
            font-size: 1.2em
        }

        .invoice table .no {
            color: #fff;
            font-size: 1.6em;
            background: #3989c6
        }

        .invoice table .unit {
            background: #ddd
        }

        .invoice table .total {
            background: #3989c6;
            color: #fff
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
{{--            <button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>--}}
        </div>
        <hr>
    </div>
    <div class="invoice overflow-auto" id="invoice_body">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col">
                        <a  >
                            <img src="{{asset('assets/media/logo.png')}}" data-holder-rendered="true" />
                        </a>
                        <div>SARL MULTI GLOBALE LOGISTIQUE</div>
                        <div>Villa N 32 Cooperatif Djable Falaoucen BMR</div>
                        <div>ALGER-ALGERIE</div>
                        <div>Tel/Fax: +213(0) 23 53 89 87</div>
                    </div>
                    <div class="col company-details">

                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">Doit:</div>
                        <h2 class="to">John Doe</h2>
                        <div class="address">03 RUE MOHAMED DRARENI HYDRA</div>
                        <div class="address">ALGER-ALGERIE</div>
                        <div class="address">NIF: 054512151214512</div>
                        <div class="address">RC: 01/4545151451B19</div>

                    </div>
                    <div class="col invoice-details">
                        <h1 class="invoice-id">Facture N° {{$command->id}}/{{date('Y')}}
                        </h1>
                        <div class="date">ALGER LE: {{$command->date}}</div>
                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                    <tr>
                        <th>Reference</th>
                        <th class="text-left">Description</th>
                        <th class="text-right">Qte</th>
                        <th class="text-right">PU</th>
                        <th class="text-right">Montant HT</th>
                        <th class="text-right">TVA 19%</th>
                        <th class="text-right">Montant TTC</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php  $i=1 @endphp
                    @foreach($commandProducts as $commandProduct)
                        <tr>
                            <td class="no">{{$i}}</td>
                            <td class="text-left">
                                <h3>
                                    {{$commandProduct->product->name}}

                                </h3>


                            </td>
                            <td class="unit">{{$commandProduct->quantity}}</td>
                            <td class="qty">{{$commandProduct->price}}</td>
                            <td class="total">{{$commandProduct->amount}}</td>
                            <td class="total">{{$commandProduct->amount*0.19}}</td>
                            <td class="total">{{$commandProduct->amount*1.19}}</td>
                        </tr>
                        @php  $i++ @endphp
                    @endforeach
                    </tbody>

                    <tfoot>
                    <tr>
                        <td colspan="4"></td>
                        <td colspan="2">Montant HT</td>
                        <td>{{$command->amount}}</td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td colspan="2">TVA 19%</td>
                        <td>{{$command->amount*0.19}}</td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td colspan="2">Montant TTC</td>
                        <td>{{$command->amount*1.19}}</td>
                    </tr>
                    </tfoot>
                </table>
                <div class="thanks">Merci Pour votre Visite Monsieur!</div>
                <div >
                    <span>Arrêtée la présente facture a la somme de : {{$amountLetter}} </span>

                </div>
                </br>

                <div>
                    <span><b>Condition de réglement:</b> 30 jous a date reception </span>

                    </br>
                    <span><b>Mode de paiement:</b>  Cheque ou versement Banquer</span>
                    </br>
                    <span><b>Compte Bancaire:</b> 55445125424554</span>
                </div>

            </main>
            <footer>
                Sarl au capital 500.000,00 DA; Siere Social: Villa N 32 Cooperatif Djabel Falaoucen BMR ALGER
                </br>
                R.C: 16/00-15512552 B19 - A.I: 54512151544521 - NIF: 545145451545554
            </footer>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>