@extends('layouts.dashboard')

@section('page_meta')
    <title>Monthly Product Profit For Client</title>
    <meta name="keywords" content="Rozaric"/>
    <meta name="description" content="Rozaric">
    <meta name="author" content="Rozaric">
@endsection

@section('styles')
    <!-- Page styles -->
@endsection

@section('scripts')
    <!-- Page scripts -->
    <script>
        //Password check


        //Image uploader
        var avatar = new KTImageInput('kt_avatar');

        //Select2
        $('#kt_select2_1').select2();
        $('#kt_select2_2').select2();


        function calculateProfit(profit,quantity,depositor,camion){

            let client = JSON.parse($('#kt_select2_2').val());


            if(client.depositor === 0){
                $('#'+profit).val($('#'+quantity).val()*parseFloat(camion));
            }else{
                $('#'+profit).val($('#'+quantity).val()*parseFloat(depositor));
            }


        }

        function resetAll(productJSON){

            var products = JSON.parse(productJSON);

            var client = JSON.parse($('#kt_select2_2').val());
            for (let i = 0; i <products.length ; i++) {

                var quantity =  $('#quantity_'+products[i].product_id).val();
                if(client.depositor === 0){
                    $('#profit_'+products[i].product_id).val(quantity*parseFloat(products[i].camion));
                }else{
                    $('#profit_'+products[i].product_id).val(quantity*parseFloat(products[i].depositor));
                }
            }
        }

        function changeMonth(){
            let month = $('#kt_select2_1').val();

            var link = '/dash/profit/client/month/'+month+'/create';
            console.log(document.domain+link);
            window.location.replace(link);
        }
    </script>
@endsection

@section('content')
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom gutter-b example example-compact">
            <div class="card-header">
                <h3 class="card-title">Product</h3>
            </div>
            <!--begin::Form-->
            <form class="form" method="post" action="dash/profit/monthly/create" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-12 col-md-6">
                            <label>Choose a Month : </label>
                            <select class="form-control" id="kt_select2_1" name="month" onchange="changeMonth()">
                                @for($i=0;$i<count($months);$i++)
                                    <option value="{{$i+1}}" {{$i+1 == $month? 'selected':''}}>{{$months[$i+1]}}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="form-group col-sm-12 col-md-6">
                            <label>Choose a Client : </label>
                            <select class="form-control" id="kt_select2_2" name="client" onchange="resetAll('{{$products}}')">
                               @foreach($clients as $client)
                                    <option value="{{$client}}">{{$client->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-12 row">

                            @foreach($products as $product)
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>Name* :</label>
                                    <input type="text" name="product_id_{{$product->product_id}}" value="{{$product->product->name}}" autocomplete="family-name"
                                           class="form-control form-control-solid" placeholder="Enter product's name" required disabled/>
                                    <span class="form-text text-muted">Please enter the product's name</span>
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>Quantity* :</label>
                                    <input type="text" id="quantity_{{$product->product_id}}" name="quantity_{{$product->product_id}}" value="{{old('profit')}}" autocomplete="given-name"
                                           class="form-control form-control-solid" placeholder="Enter Quantity"
                                           required onkeyup="calculateProfit('profit_{{$product->id}}','quantity_{{$product->id}}','{{$product->depositor}})','{{$product->camion}}')"/>
                                    <span class="form-text text-muted">Please enter the Quantity of the product</span>
                                </div>
                                <div class="form-group col-sm-12 col-md-4">
                                    <label>Profit* :</label>
                                    <input type="text" id="profit_{{$product->product_id}}" name="profit_{{$product->product_id}}" value="{{old('profit')}}" autocomplete="given-name"
                                           class="form-control form-control-solid" placeholder="Enter Profit"
                                           required/>
                                    <span class="form-text text-muted">Please enter the Profit of the product</span>
                                </div>

                            @endforeach


{{--                            <div class="form-group col-sm-12 col-md-12">--}}
{{--                                <label>Choose a Type : </label>--}}
{{--                                <select class="form-control" id="kt_select2_1" name="type">--}}
{{--                                    @foreach($types as $type)--}}
{{--                                        <option value="{{$type->id}}">{{$type->name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
                        </div>

                    </div>



                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="dash/profits" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
@endsection
