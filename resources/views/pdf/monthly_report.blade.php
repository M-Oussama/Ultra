<html>
<head>
    <title>POINTAGE MOIS DE </title>
    <meta name="keywords" content="Rozaric"/>
    <meta name="description" content="Rozaric">
    <meta name="author" content="Rozaric">
    <meta charset="utf-8" />
    <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css" />
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="assets/plugins/global/plugins.bundle.rtl.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.rtl.css" rel="stylesheet" type="text/css" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!--end::Global Theme Styles-->
    <style>

        .toolbar{
            margin:30px
        }

        @page {
            size: A4;
        }

        @media print {

            #invoice_print{
                display:none;
            }
        }
        td,.align-center{
            text-align: center;
        }

    </style>





</head>
<script>
    $(document).ready(function(){
        console.log("pop");
        $('#printInvoice').click(function(){
            Popup($('.invoice')[0]);
            function Popup(data)
            {
                window.print();
                return true;
            }

        });
    });



</script>


<body dir="ltr">
<div class="toolbar hidden-print" id="invoice_print">
    <div class="text-right">
        <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> PRINT</button>
        {{--            <button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>--}}
    </div>
    <hr>
</div>
<div class="container">
    <!--begin::Card-->
    <div class="card card-custom gutter-b">
        <div class="card-header flex-wrap py-3">
            <h3 class="align-center"> POINTAGE  MOIS DE {{$month}}/{{$year}}</h3>
        </div>
        <div class="card-body">

            <div class="table-responsive" >
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>NOM</td>
                        <td>PRENOM</td>
                        <td>ENTREES</td>
                        <td>STATUS</td>
                        <td>POINTS MAX 22JRD</td>
                        <td>WEEK</td>
                    </tr>
                    </thead>
                    <tbody>
                    @for($i=0;$i<count($employees);$i++)
                        <tr>
                            <td>{{$employees[$i]->id}}</td>
                            <td>{{$employees[$i]->name}}</td>
                            <td>{{$employees[$i]->surname}}</td>
                            @if(count($employees[$i]->leaveApplications)>0)
                                <td class="reverse-content">{{date('d/m/Y', strtotime($employees[$i]->leaveApplications[0]->start_date))}}</td>
                            @else
                                <td>{{$employees[$i]->leaveApplications}}</td>
                            @endif
                            <td>JOUR</td>

                            <td>{{$employees[$i]->working_days}}</td>
                            <td>0</td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
            </div>



        </div>
    </div>
    <!--end::Card-->
    <!-- start::delete modal -->

    <!-- end::delete multi modal -->
</div>
</body>
</html>
