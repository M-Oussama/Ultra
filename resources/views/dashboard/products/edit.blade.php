@extends('layouts.dashboard')

@section('page_meta')
    <title>Edit product</title>
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
            <form class="form" method="post" action="dash/products/{{$product->id}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="image-input image-input-empty image-input-outline d-contents" id="kt_avatar"
                                 style="background-image: url({{ !empty($product->getFirstMedia('avatars')) ? $product->getFirstMedia('avatars')->getUrl() : 'assets/media/users/blank.png' }});margin-left: 36%;">
                                <div class="image-input-wrapper"></div>

                                <label
                                    class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                    data-action="change" data-toggle="tooltip" title=""
                                    data-original-title="Change avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="avatar" accept=".png, .jpg, .jpeg" autocomplete="photo"/>
                                    <input type="hidden" name="avatar_remove"/>
                                </label>

                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                      data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>

                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                                      data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                            <span class="form-text text-muted" style="margin-left: 27%;">Allowed file types: png, jpg, jpeg.</span>
                        </div>

                        <div class="col-sm-12 col-md-6 row">
                            <div class="form-group col-sm-12 col-md-12">
                                <label>Name* :</label>
                                <input type="text" name="name" value="{{old('name',$product->name)}}" autocomplete="family-name"
                                       class="form-control form-control-solid" placeholder="Enter product's name" required/>
                                <span class="form-text text-muted">Please enter the product's name</span>
                            </div>
                            <div class="form-group col-sm-12 col-md-12">
                                <label>Barcode* :</label>
                                <input type="text" name="barcode" value="{{old('barcode',$product->barcode)}}" autocomplete="given-name"
                                       class="form-control form-control-solid" placeholder="Enter Barcode"
                                       required/>
                                <span class="form-text text-muted">Please enter the Barcode of the product</span>
                            </div>

                            <div class="form-group col-sm-12 col-md-12">
                                <label>price :</label>
                                <input type="text" name="price" value="{{old('price',$product->price)}}" autocomplete="price"
                                       class="form-control form-control-solid" placeholder="Enter the price"/>
                                <span class="form-text text-muted">Please enter the price</span>
                            </div>
                            <div class="form-group col-sm-12 col-md-12">
                                <label>Quantity :</label>
                                <input type="text" name="quantity" value="{{old('quantity',$product->quantity)}}" autocomplete="Quantity"
                                       class="form-control form-control-solid" placeholder="Enter the Quantity"/>
                                <span class="form-text text-muted">Please enter the Quantity</span>
                            </div>
                            <label class="col-3 col-form-label">Stackable:</label>
                            <div class="col-3">
                                    <span class="switch switch-lg switch-icon">
                                        <label>
                                            <input type="checkbox" {{$product->stackable== 1 ? "checked":""}} name="stackable"/>
                                            <span></span>
                                        </label>
                                    </span>
                            </div>

                        </div>

                    </div>



                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="dash/products" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
@endsection
