@extends('layouts.dashboard')

@section('page_meta')
    <title>New Sale</title>
    <meta name="keywords" content="Rozaric"/>
    <meta name="description" content="Rozaric">
    <meta name="author" content="Rozaric">
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

@section('styles')
    <!-- Page styles -->
    <style>
        .select2-container--default{
            width: 100% !important;
        }
    </style>
@endsection

@section('scripts')
    <!-- Page scripts -->
    <script src="/assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="/assets/js/convertLetter.js"></script>
    <script src=""></script>
    <script>
        var table = $('#kt_datatable');
        var products =  JSON.parse('{!!  json_encode($products)!!}');
        var added_products = [];
        var montant_ht = 0;
        var tva = montant_ht *0.19;
        var timber = 0.01;
        var timber_full = 1.01;
        var timber_amount = 0;
        var timber_1 = (montant_ht + tva)*timber;
        var montant_ttc = montant_ht*1.20;

        var val = 1;

        $('#payment_type').on('change',function(){
         val = $('#payment_type').val();
           if(val== 1){
            // ESPECE SHOW THE INPUT
               $('#amount_container').removeClass('d-none');
               $('#payment_container').removeClass('d-none');
               $('#rest_container').removeClass('d-none');
               // CALCULATE DIFFERENCE AND REST
           }else{

               $('#amount_container').addClass('d-none');
               $('#payment_container').addClass('d-none');
               $('#rest_container').addClass('d-none');
              // A TERME HIDE ESPECE INPUT
           }
           $('#amount').val(0);
            calculateTotal();
            calculateRest();

         });

        $('#amount').on('change keydown paste input', function(){
            calculateRest();
        });
        var money = 0;
        var rest = 0;
        function calculateRest(){
            var value = $('#amount').val();

            money = parseFloat(value);

            if(value){
                if(money !=0)
                    rest = money - montant_ht;
                else
                    rest = 0;
            }else{
                money = 0;
            }
            $('#payment').html(money.toFixed(2)+ " DA");
            $('#rest').html(rest.toFixed(2)+ " DA");
        }

        table.DataTable({
            "createdRow": function (row, data, dataIndex) {
                var rowID = "row_" + data[1];
                $(row).attr('id', rowID);
            },
            columns: [
                {
                    data: null,

                    render:function (row, data, dataIndex) {
                        return    ' <label class="checkbox checkbox-single">' +
                       '                            <input type="checkbox" name="ids[]" value="' + data['id']+ '" class="checkable"/>' +
                       '                            <span></span>' +
                       '                        </label>';

                    }
                },
                {
                    "data": "id"
                },
                {
                    "data": "name",

                },
                {
                    "data": null,
                    render: function (data, row, dataIndex)  {


                        return '<div class="form-outline">\n' +
                            '  <input type="number" id="price_'+data['actions']['id']+'" class="form-control"  onchange="calculateRowAmount('+data['actions']['id']+', '+data['actions']['stock']['quantity']+','+data['actions']['quantity']+')"  value="'+ data['price']+'" />\n' +
                            '</div>'
                    }
                },
                {
                    "data": null,
                    render: function (data, row, dataIndex)  {



                        return '<div class="form-outline">\n' +
                            '  <input type="number" id="quantity_'+data['actions']['id']+'" class="form-control"  onchange="calculateRowAmount('+data['actions']['id']+', '+data['actions']['stock']['quantity']+','+data['actions']['quantity']+')"  value="'+ data['quantity']+'" />\n' +
                            '</div>'
                    }
                },
                {
                    "data": null,
                    render: function (data, row, dataIndex)  {

                        return '<p class="font-weight-bold" id="amount_'+data['actions']['id']+'">'+ data['amount']+' DA</p>'
                    }
                },
                {
                    "data": "actions",
                    render : function (row, data, dataIndex)  {
                        return  '<span onclick="deleteRow('+row.id+','+ data.id+')" class="btn btn-sm btn-clean btn-icon" title="Delete">'+
                            '<span class="svg-icon svg-icon-md">'+
                            '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">'+
                            '<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">'+
                            '<rect x="0" y="0" width="24" height="24"/>'+
                            '<path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>'+
                            '<path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>'+
                            '</g>'+
                            '</svg>'+
                            '</span>'+
                            '</span>';
                    }
                }
            ],
        });
        // begin table
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

        //delete modal
        $('#deleteModal').on('show.bs.modal', function (e) {
            //get data-id attribute of the clicked element
            var user_id = $(e.relatedTarget).data('user_id');
            var user_name = $(e.relatedTarget).data('user_name');

            //populate the textbox
            $(e.currentTarget).find('#exampleModalFormTitle').text('Do you really want to delete the user ' + user_name + ' ?');
            $(e.currentTarget).find('#deleteForm').attr('action', 'dash/sales/' + user_id);
        });

        //delete multi modal
        $('#deleteMultiModal').on('show.bs.modal', function (e) {
            $(e.currentTarget).find('#deleteMultiSubmit').click(function (eclick) {
                eclick.preventDefault();
                $('#deleteMultiForm').submit();
            });
        });

        function calculateRowAmount(id,stock_quantity,old_quantity) {


            //* check if quantity in stock is enough to do the operation *//
            var quantity = parseFloat($('#quantity_'+id).val());

            console.log("old quantity : "+old_quantity+ " new quantity : "+quantity);
              if(quantity <= stock_quantity){
                  // price
                  var price = parseFloat($('#price_'+id).val());

                  var amount = quantity * price;
                  $('#amount_'+id).html(amount.toFixed(2)+ " DA");

                  for (let i = 0; i <added_products.length ; i++) {
                      console.log("ID "+id+ " PRODUCT "+added_products[i]['id']);
                      console.log(added_products);
                      if(added_products[i]['id'] === id){

                          added_products[i]['price'] = price;
                          added_products[i]['quantity'] = quantity;
                          added_products[i]['amount'] = amount;

                          added_products[i]['stock']['quantity']  = added_products[i]['stock']['current_stock'] - quantity;
                          console.log("called "+added_products[i]['stock']['quantity'] );
                      }
                  }
                  calculateTotal();
                  calculateRest();
              }else{
                  $('#quantity_'+id).val(stock_quantity);
                  calculateRowAmount(id,stock_quantity);
                  $('#stockAlert').modal('toggle');

              }




        }

        function productExists(product){
            for (let i = 0; i <Object.keys(added_products).length ; i++) {
                if(added_products[i]['id'] == product['id'])
                    return true;
            }
            return false;
        }

        function calculateTotal(){

            montant_ht = 0;
            tva = 0;
            montant_ttc = 0;
            for (let i = 0; i <added_products.length ; i++) {

                montant_ht += added_products[i]['amount'];
            }





            $('#ht').html(montant_ht.toFixed(2) + " DA");


            $('#amount_letter').html("La présente facture est arrêtée à la somme de : "+calcule(montant_ttc.toFixed(2)));
        }

        $('#addProduct').on('show.bs.modal', function (e) {
            if(products.length > 0){
                findProduct(products[0].id);
                $('#product_price').val(product['price']);
                $('#product_quantity').val(product.stock.quantity);
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
            $('#product_quantity').val(product['stock']['quantity']);

        }
        function getProductID(id) {



            for (let i = 0; i <added_products.length ; i++) {
                if(added_products[i]['id'] === id){

                    return id;
                }

            }
            return  -1;

        }
        function deleteRow(id,rowID){
            table.DataTable().row('#row_'+rowID).remove().draw();
            console.log("==== "+rowID );
            for (let i = 0; i <products.length ; i++) {
                if(products[i]['id'] === id){
                    products[i]['stock']['quantity']  = products[i]['stock']['current_stock'];
                }
            }
            added_products.splice(getProductID(rowID), 1);
            calculateTotal();
            calculateRest();
        }

        function dismissAddProduct(){
            $("#addProduct").modal('toggle');
            @if(sizeof($products)> 0)
            $('#kt_select2_product').val({{$products[0]->id}}).trigger('change');
            @endif
        }
        var id = 1;
        function addProduct(){
            @if(sizeof($products)> 0)
            price = $('#product_price').val();
            quantity = $('#product_quantity').val();
            @if(sizeof($products)> 0)
            if(!productExists(product) && quantity <= product.stock.quantity && quantity >0){
                var montant = price * quantity;

                product['price'] = price;
                product['quantity'] = quantity;
                product['amount']  = montant;
                product['stock']['quantity']  = product['stock']['current_stock'] - quantity;

                added_products.push(product);
                var rowNew = {"id": id ,"name": product['name'], "price": parseFloat(price).toFixed(2), "quantity": parseFloat(quantity).toFixed(2), "amount": parseFloat(montant).toFixed(2), "actions": product};
                $('#kt_datatable').DataTable().row.add(
                  rowNew
                  ).draw();
                id++;
                calculateTotal();
                calculateRest();
                @endif
            }
            $("#addProduct").modal('toggle');
            @if(sizeof($products)> 0)
            $('#kt_select2_product').val({{$products[0]->id}}).trigger('change');
            @endif
            @endif
        }
        var currentDate = new Date().toISOString().slice(0, 10);
        $("#fac_date").val(currentDate);
        function checkInput(){
            var value = $("#amount").val();

            // Validate the input.
            if (!/^[0-9]+$/.test(value)) {
                $("#amount").val("");
            }
        }

        $('#saveCommand').on('click',function () {
            if($('#fac_date').val()){
                KTApp.blockPage({
                    overlayColor: '#000000',
                    opacity: 0.1,
                    size: 'lg',
                    state: 'danger',
                    message: 'please wait...'
                });
                $('#saveModal').modal('toggle');
                var token = $('meta[name="csrf-token"]').attr('content');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "post",
                    url: "dash/sales/store",
                    header:{
                        'X-CSRF-TOKEN': token
                    },
                    data: {
                        client_id : $('#client_id').val(),
                        date : $('#fac_date').val(),
                        payment_type : $('#payment_type').val(),
                        products: added_products,
                        amount : money,
                        rest : rest,
                        total: montant_ht,

                    },
                    dataType: "json",
                    success: function (data) {
                        KTApp.unblockPage();
                        if(data.success){
                            window.location.href = "{{URL('dash/sales')}}";
                        } else {
                            $('#stockAlert').modal('toggle');
                        }


                    }
                });

            }

        });

        $(".datepicker").datepicker({
            onSelect: function(dateText) {
                console.log("Selected date: " + dateText + "; input's current value: " + this.value);
                $(this).change();

            },

        }).on('change',function () {


        });

        function checkStockQuantity(product){

        }

        $('#kt_select2_product').select2();
        $('#payment_type').select2();
        $('#client_id').select2();
        $('#products').select2();

    </script>
@endsection

@section('content')
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-label">sales <span class="d-block text-muted pt-2 font-size-sm">Be careful</span>
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
                                            <a href="dash/sales/export" class="navi-link">
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
                <div class="form-group row col-sm-12 col-md-12 row">

                    <div class="form-group col-sm-6 col-md-6">
                        <label>Date: </label>
                        <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" id="fac_date">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                   <div class="form-group col-sm-6 col-md-6">
                                        <label>Payment Type : </label>
                                        <select class="form-control" id="payment_type" name="payment_type" >
                                            @foreach($payment_types as $payment_type)
                                                <option value="{{$payment_type["id"]}}">{{$payment_type['name']}}</option>
                                            @endforeach
                                        </select>
                    </div>
                    <div class="form-group col-sm-6 col-md-6">
                        <label>Choose a client : </label>
                        <select class="form-control" id="client_id" name="param">
                            @foreach($clients as $client)
                                <option value="{{$client->id}}">{{$client->name}} {{$client->surname}}</option>
                            @endforeach
                        </select>
                    </div>

{{--                    <div class="form-group col-sm-6 col-md-6">--}}
{{--                        <label>Choose a product : </label>--}}
{{--                        <select class="form-control" id="products" name="param">--}}
{{--                            @foreach($products as $product)--}}
{{--                                <option value="{{$product->id}}" >{{$product->name}}   <span style="float: right;">({{$product->stock->quantity}})</span></option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
                </div>

                <form id="deleteMultiForm" action="dash/sales/delete-multi" method="post">
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
                            <th>Opreation</th>

                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <!--end: Datatable-->
                </form>
            </div>
            <h4 class="container"
                 id="amount_letter"></h4>
            <div class="container mb-8"></div>
            <div class="container row">
                <div class="form-group col-sm-12 col-md-6 ">

                    <div class="container mb-5" id="amount_container">
                        <h3>Amount : </h3>
                        <div class="form-outline">
                            <input type="text" id="amount" onkeyup="checkInput()" class="form-control" placeholder="Enter amount of money" />
                        </div>
                    </div>



                </div>

                <div class="form-group col-sm-12 col-md-6 ">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>MONTANT HT</th>
                            <th id="ht">0 DA</th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr id="payment_container">
                            <td>PAYMENT</td>
                            <td id="payment">0 DA</td>

                        </tr>



                        <tr id="rest_container">
                            <td>REST</td>
                            <td id="rest">0 DA</td>

                        </tr>
                        </tbody>
                    </table>
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
                <form id="deleteForm" action="dash/sales/{id}" method="post">
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
                            <button type="submit" class="btn btn-danger font-weight-bold">Delete</button>
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
                            <h5 class="modal-title" id="exampleModalFormTitle">Select A product
                                ?</h5>
                        </div>
                        <div class="modal-body">
                            <label for="kt_select2_product">Product* :</label>
                            <div class="form-group col-sm-12 col-md-12">

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
                            <button type="button" class="btn btn-light-primary font-weight-bold" onclick="dismissAddProduct()">
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
                        <h5 class="modal-title" id="exampleModalFormTitle">Do you really want to delete these sales
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

        <div class="modal fade" id="stockAlert" tabindex="-1" aria-labelledby="exampleModalFormTitle"
             aria-hidden="true" style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalFormTitle">Stock quantity is insufficient
                            </h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">
                            Ok
                        </button>

                    </div>
                </div>
            </div>
        </div>

        <!-- end::delete multi modal -->
    </div>
@endsection
