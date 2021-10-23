@extends('layouts.dashboard')

@section('page_meta')
    <title>Edit Command </title>
    <meta name="keywords" content="Rozaric"/>
    <meta name="description" content="Rozaric">
    <meta name="author" content="Rozaric">
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('styles')
    <!-- Page styles -->
@endsection

@section('scripts')
    <!-- Page scripts -->

    <script src="/assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script>
        var row_id = 1;
        var table = $('#kt_datatable');
        var products =  JSON.parse('{!!  json_encode($products)!!}');
        var command_products = JSON.parse('{!!  json_encode($command_products)!!}');
        var added_products = [];
        console.log(command_products);
        var command_id = command_products[0].command_id;
        $('#kt_datatable').DataTable({
            "createdRow": function (row, data, dataIndex) {
                 var rowID = "row_" + data[1];
                 $(row).attr('id', rowID);
            }
        });
        // begin table
        fillTable();

        function fillTable(){
            console.log(command_products);
            $.each(command_products, function(key,value) {
                _addProduct(value);
            });
        }
        table.on('change', '.group-checkable', function () {
            var set = $(this).closest('table').find('td:first-child .checkable');
            var checked = $(this).is(':checked');

            $(set).each(function () {
                if (checked) {
                    $(this).prop('checked', true);
                    $(this).closest('tr').addClass('active');
                } else {
                    $(this).prop('checked', false);
                    $(this).closest('tr').removeClass('active');
                }
            });
        });

        table.on('change', 'tbody tr .checkbox', function () {
            $(this).parents('tr').toggleClass('active');
            var checkable = $('input[class=checkable]');
            var groupcheck = $('input[class=group-checkable]');
            if (checkable.not(':checked').length > 0) {
                groupcheck.prop('checked', false);
            } else {
                groupcheck.prop('checked', true);
            }
        });
        function deleteRow(rowID){


            table.DataTable().row('#row_'+rowID).remove().draw();
            added_products.splice(getProductID(rowID), 1);
            console.log(rowID);
        }

        function getProductID(rowID){
            for (let i = 0; i <added_products.length ; i++) {
                if(rowID == added_products[i].id)
                    return i;
            }
            return null;
        }

        //delete modal
        $('#deleteModal').on('show.bs.modal', function (e) {
            //get data-id attribute of the clicked element
            var command_id = $(e.relatedTarget).data('command_id');
            var rowID = $(e.relatedTarget).data('row_id');
            var product_name = $(e.relatedTarget).data('product_name');

            //populate the textbox
            $(e.currentTarget).find('#exampleModalFormTitle').text('Do you really want to delete this product ' + product_name + ' ?');
            // $(e.currentTarget).find('#deleteForm').attr('action', 'dash/commands/' + user_id);

        });

        //delete multi modal
        $('#deleteMultiModal').on('show.bs.modal', function (e) {
            $(e.currentTarget).find('#deleteMultiSubmit').click(function (eclick) {
                eclick.preventDefault();
                $('#deleteMultiForm').submit();
            });
        });

        function productExists(product){
            for (let i = 0; i <Object.keys(added_products).length ; i++) {
                if(added_products[i]['id'] == product['id'])
                    return true;
            }
            return false;
        }

        $('#addProduct').on('show.bs.modal', function (e) {
            if(products.length > 0){
                findProduct(products[0].id);
                $('#product_price').val(product['price']);
                $('#product_quantity').val(product['quantity']);
            }



        });
        var product ;
        var price = 0;
        var quantity = 0;
        function findProduct(product_id){
            for (let i = 0; i <Object.keys(products).length; i++) {
                if(products[i].id == product_id){
                    product = products[i];
                }
            }
        }
        function onProductSelected(){
            var product_id = $('#kt_select2_product :selected').val();
            findProduct(product_id);
            $('#product_price').val(product['price']);
            $('#product_quantity').val(product['quantity']);




        }
        var id = 1;
        function addProduct(){

            if(!productExists(product)){
                console.log(product);
                price = $('#product_price').val();
                quantity = $('#product_quantity').val();

                var montant = price * quantity;

                product['price'] = price;
                product['quantity'] = quantity;
                product['amount']  = montant;
                added_products.push(product);
                $('#kt_datatable').DataTable().row.add([
                    ' <label class="checkbox checkbox-single">' +
                    '                            <input type="checkbox" name="ids[]" value="' + product.id+ '" class="checkable"/>' +
                    '                            <span></span>' +
                    '                        </label>',
                    product.id,
                    product['name'],
                    price,
                    quantity,
                    montant,

                    '<span onclick="deleteRow('+product.id+')" class="btn btn-sm btn-clean btn-icon" title="Delete">'+
                    '<span class="svg-icon svg-icon-md">'+
                    '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">'+
                    '<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">'+
                    '<rect x="0" y="0" width="24" height="24"/>'+
                    '<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>'+
                    '<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>'+
                    '</g>'+
                    '</svg>'+
                    '</span>'+
                    '</span>'
                    ,

                ]).draw();
                id++;
                calculateAmount(montant);
                updateAmount();
                console.log("clicked");

            }
            $("#addProduct").modal('toggle');

        }

        function _addProduct(command){

            if(!productExists(command.product)){

                console.log(command.product);

                var amount = parseFloat(command.price)* parseFloat(command.quantity);
                command.product.quantity = command.quantity;
                command.product.amount = amount;
                added_products.push(command.product);
                $('#kt_datatable').DataTable().row.add([
                    ' <label class="checkbox checkbox-single">' +
                    '                            <input type="checkbox" name="ids[]" value="' + command.product.id+ '" class="checkable"/>' +
                    '                            <span></span>' +
                    '                        </label>',
                    command.product.id,
                    command.product.name,
                    command.price,
                    command.quantity,
                    amount,
                    '<span onclick="deleteRow('+command.product.id+')" class="btn btn-sm btn-clean btn-icon" title="Delete">'+
                    '<span class="svg-icon svg-icon-md">'+
                    '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">'+
                    '<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">'+
                    '<rect x="0" y="0" width="24" height="24"/>'+
                    '<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>'+
                    '<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>'+
                    '</g>'+
                    '</svg>'+
                    '</span>'+
                    '</span>'
                    ,

                ]).draw();
                id++;

                console.log("clicked");

            }
            //$("#addProduct").modal('toggle');

        }

        $('#saveCommand').on('click',function () {
            $("#saveModal").modal('toggle');
            KTApp.blockPage({
                overlayColor: '#000000',
                opacity: 0.1,
                size: 'lg',
                state: 'danger',
                message: 'please wait...'
            });
            var token =  '{{csrf_token()}}';

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "dash/commands/"+command_id+"/update",
                header:{
                    'X-CSRF-TOKEN': token
                },
                data: {products: added_products},
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    window.location.href = "{{URL('dash/commands')}}";


                },
                error: function(error){
                    console.log(error);
                }
            });

        });

        var montant_ht = 0;
        var tva = 0;
        var montant_ttc = 0;
        $('#ht').text(montant_ht);
        $('#tva').text(tva);
        $('#ttc').text(montant_ttc);

        function calculateAmount(amount){
            montant_ht+= amount;
            tva = montant_ht*0.19;
            montant_ttc = montant_ht*1.19;
        }
        function updateAmount(){
            $('#ht').text(montant_ht);
            $('#tva').text(tva);
            $('#ttc').text(montant_ttc);
        }
    </script>
@endsection

@section('content')
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-label">Commands <span class="d-block text-muted pt-2 font-size-sm">Be careful</span>
                    </h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Dropdown-->
                    @canany(['delete-command','list-command'])
                        <div class="dropdown dropdown-inline mr-2">
                            <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="svg-icon svg-icon-md">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path
                                                d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z"
                                                fill="#000000"
                                                opacity="0.3"
                                            ></path>
                                            <path
                                                d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z"
                                                fill="#000000"
                                            ></path>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                Actions
                            </button>
                            <!--begin::Dropdown Menu-->
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <!--begin::Navigation-->
                                <ul class="navi flex-column navi-hover py-2">
                                    <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">
                                        Choose an action:
                                    </li>
                                    @can('delete-user')
                                        <li class="navi-item">
                                            <a href="#" data-toggle="modal" data-target="#deleteMultiModal"
                                               class="navi-link">
                                                <span class="navi-icon">
                                                    <i class="la la-trash"></i>
                                                </span>
                                                <span class="navi-text">Delete</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('list-user')
                                        <li class="navi-item">
                                            <a href="dash/commands/export" class="navi-link">
                                                <span class="navi-icon">
                                                    <i class="la la-file-excel"></i>
                                                </span>
                                                <span class="navi-text">Export</span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                                <!--end::Navigation-->
                            </div>
                            <!--end::Dropdown Menu-->
                        </div>
                    @endcanany
                    <!--end::Dropdown-->
                    <!--begin::Button-->
                    @can('create-command')
                        <button id="new_product" data-toggle="modal"  data-target="#addProduct" class="btn btn-primary font-weight-bolder">
                            <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <circle fill="#000000" cx="9" cy="15" r="6"></circle>
                                        <path
                                            d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                            fill="#000000"
                                            opacity="0.3"
                                        ></path>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                            New Product
                        </button>
                    @endcan
                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                <form id="deleteMultiForm" action="dash/commands/delete-multi" method="post">
                @csrf
                <!--begin: Datatable-->
                    <table class="table table-bordered table-checkable" id="kt_datatable">
                        <thead>
                        <tr>

                            <th>ID</th>
                            <th>ID</th>
                            <th>Produit</th>
                            <th>Prix Unitaire</th>
                            <th>Quantité</th>
                            <th>Montant</th>
                            <th>Return Quantity</th>

                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <!--end: Datatable-->
                </form>
            </div>

            <div class="row justify-content-center  py-8 px-8 py-md-10 px-md-0">
                <div class="col-md-9">
                    <div class="d-flex justify-content-right flex-column flex-md-row font-size-lg" style="float:right">

                        <div class="table-responsive ">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td class="text-center font-weight-bold  text-uppercase">MONTANT HT</td>
                                    <td id="ht" class="text-center font-weight-bold  text-uppercase">{{number_format($command->amount, 2, ',', ' ')}} DA </td>


                                </tr>
                                <tr>
                                    <td class="text-center font-weight-bold  text-uppercase">TVA 19%</td>
                                    <td id="tva" class="text-center font-weight-bold  text-uppercase">{{number_format($command->amount*0.19, 2, ',', ' ')}} DA </td>


                                </tr>
                                <tr>
                                    <td class="text-center font-weight-bold  text-uppercase">MONTANT TTC</td>
                                    <td id="ttc" class="text-center font-weight-bold  text-uppercase">{{number_format($command->amount*1.19, 2, ',', ' ')}} DA </td>


                                </tr>
                                </tbody>

                            </table>
                            <span class="text-center">La Facture est arrêté à : {{$amountLetterTTC}}</span>

                        </div>
                    </div>
                </div>
            </div>

            <div class="container mb-5" style="margin-right: -8%;">

                <div class="col-lg-2 col-md-2 col-xs-2 float-right" >
                    <button id="cancel_command" data-toggle="modal"  data-target="#cancel_command" class="btn btn-light-primary font-weight-bolder ">

                        Cancel
                    </button>
                </div>

                <div class="col-lg-1 col-md-1 col-xs-1 float-right" >
                    <button id="save_command" data-toggle="modal"  data-target="#saveModal" class="btn btn-primary font-weight-bolder ">

                        Save
                    </button>
                </div>
            </div>

        </div>
        <!--end::Card-->
        <div class="modal fade" id="saveModal" tabindex="-1" aria-labelledby="exampleModalFormTitle"
             aria-hidden="true" style="display: none;">
            <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalFormTitle">Are you sure you want to save this command
                                ?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">
                                Close
                            </button>
                            <button id="saveCommand" class="btn btn-primary font-weight-bold">Save</button>
                        </div>
                    </div>
            </div>
        </div>

        <!-- start::delete modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalFormTitle"
             aria-hidden="true" style="display: none;">
            <div class="modal-dialog" role="document">
                <form id="deleteForm" action="dash/commands/{id}" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalFormTitle">Do you really want to delete this user
                                ?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-danger font-weight-bold">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="exampleModalFormTitle"
             aria-hidden="true" style="display: none;">
            <div class="modal-dialog" role="document">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalFormTitle">Do you really want to delete this user
                                ?</h5>
                        </div>
                        <div class="modal-body">
                            <div class="form-group col-sm-12 col-md-12">
                                <label>Product* :</label>
                                <select class="form-control" id="kt_select2_product" name="product" onchange="onProductSelected()">
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}" >{{$product->name}}</option>
                                    @endforeach
                                </select>
                                <span class="form-text text-muted">Please enter the Product</span>
                            </div>
                            <div class="form-group col-sm-12 col-md-12">
                                <label>Price* :</label>
                                <input type="text" id="product_price" name="price" value="{{old('price')}}" autocomplete="given-name"
                                       class="form-control form-control-solid" placeholder="Enter the Price"
                                />
                                <span class="form-text text-muted">Please enter the Price</span>
                            </div>

                            <div class="form-group col-sm-12 col-md-12">
                                <label>Quantity* :</label>
                                <input type="text" id="product_quantity" name="quantity" value="{{old('quantity')}}" autocomplete="given-name"
                                       class="form-control form-control-solid" placeholder="Enter the Quantity"
                                />
                                <span class="form-text text-muted">Please enter the Quantity</span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">
                                Close
                            </button>
                            <button class="btn btn-bg-primary font-weight-bolder text-white " onclick="addProduct()">Add</button>
                        </div>
                    </div>

            </div>
        </div>
        <!-- end::delete modal -->
        <!-- start::delete multi modal -->
        <div class="modal fade" id="deleteMultiModal" tabindex="-1" aria-labelledby="exampleModalFormTitle"
             aria-hidden="true" style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalFormTitle">Do you really want to delete these commands
                            ?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">
                            Close
                        </button>
                        <button id="deleteMultiSubmit" type="submit" class="btn btn-danger font-weight-bold">Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end::delete multi modal -->
    </div>
@endsection
