@extends('layouts.dashboard')

@section('page_meta')
    <title>Monthly Product Profit</title>
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
            <form class="form" method="post" action="dash/profit" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-12 col-md-12">
                            <label>Choose a Month : </label>
                            <select class="form-control" id="kt_select2_1" name="month">
                                @for($i=0;$i<count($months);$i++)
                                    <option value="{{$i+1}}">{{$months[$i+1]}}</option>
                                @endfor
                            </select>
                        </div>

                        @if(count($products)>0)
                            <div class="form-group col-sm-12 col-md-12 " style="margin-bottom: 5%;">
                                <h1 class="text-center">Dépositeur* :</h1>

                            </div>
                        @endif
                        <div class="col-sm-12 col-md-12 row">

                            @foreach($products as $product)
                                <div class="form-group col-sm-12 col-md-6">
                                    <label>Name* :</label>
                                    <input type="text" name="product_id_{{$product->id}}" value="{{$product->name}}" autocomplete="family-name"
                                           class="form-control form-control-solid" placeholder="Enter product's name" required disabled/>
                                    <span class="form-text text-muted">Please enter the product's name</span>
                                </div>
                                <div class="form-group col-sm-12 col-md-6">
                                    <label>Profit* :</label>
                                    <input type="text" name="profit_depo_{{$product->id}}" value="{{old('profit')}}" autocomplete="given-name"
                                           class="form-control form-control-solid" placeholder="Enter Profit"
                                           required/>
                                    <span class="form-text text-muted">Please enter the Profit of the product</span>
                                </div>

                            @endforeach

                            @if(count($products)>0)
                                <div class="form-group col-sm-12 col-md-12 " style="margin-bottom: 5%;">
                                    <h1 class="text-center">Camion* :</h1>

                                </div>
                            @endif
                            @foreach($products as $product)
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label>Name* :</label>
                                        <input type="text" name="product_id_{{$product->id}}" value="{{$product->name}}" autocomplete="family-name"
                                               class="form-control form-control-solid" placeholder="Enter product's name" required disabled/>
                                        <span class="form-text text-muted">Please enter the product's name</span>
                                    </div>
                                    <div class="form-group col-sm-12 col-md-6">
                                        <label>Profit* :</label>
                                        <input type="text" name="profit_camion_{{$product->id}}" value="{{old('profit')}}" autocomplete="given-name"
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
