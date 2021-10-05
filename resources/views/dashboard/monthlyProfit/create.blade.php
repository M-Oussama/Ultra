@extends('layouts.dashboard')

@section('page_meta')
    <title>Monthly Profit</title>
    <meta name="keywords" content="Rozaric"/>
    <meta name="description" content="Rozaric">
    <meta name="author" content="Rozaric">
@endsection

@section('styles')
    <!-- Page styles -->
@endsection

@section('scripts')
    <!-- Page scripts -->
    <script src="/assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script>
        var table = $('#kt_datatable');
        var products =  JSON.parse('{!!  json_encode($products)!!}');
        // begin table
        table.DataTable({
            responsive: true,

            // DOM Layout settings
            dom: `<'row'<'col-sm-12'tr>>
			<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,

            lengthMenu: [5, 10, 25, 50],

            pageLength: 10,

            language: {
                'lengthMenu': 'Display _MENU_',
            },

            columnDefs: [
                { width: 200, targets: 0 }
            ],

            bAutoWidth: true,
            data: {!! $products !!},

            // Order settings
            order: [[1, 'asc']],

            headerCallback: function (thead, data, start, end, display) {
                thead.getElementsByTagName('th')[0].innerHTML = `
                    <label class="checkbox checkbox-single">
                        <input type="checkbox" value="" class="group-checkable"/>
                        <span></span>
                    </label>`;
            },

            columns: [
                {
                    data: null,
                    width: '30px',
                    className: 'dt-left',
                    orderable: false,
                    render: function (data, type, row) {
                        return `
                        <label class="checkbox checkbox-single">
                            <input type="checkbox" name="ids[]" value="` + row.id + `" class="checkable"/>
                            <span></span>
                        </label>`;
                    },
                },
                {
                    data: "id",
                    width: '30px',
                },
                {
                    data: 'name',
                },
                {
                    data: null,
                    width: '25%',
                    className: 'dt-left',
                    orderable: false,
                    render: function (data, type, row) {
                        console.log(data.id);
                        var _identifier = data.id;
                        return `
                                <label>Quantity* :</label>
                                <input type="text" name="sold"  autocomplete="given-name"
                                       class="form-control form-control-solid" placeholder="Quantity" onkeypress=" _addQuantity(this.value,`+data.id+`)"
                                       required/>

                            `;
                    },

                },
                {
                    data: null,
                    width: '25%',
                    className: 'dt-left',
                    orderable: false,
                    render: function (data, type, row) {
                        return `

                                <label>Profit* :</label>
                                <input type="text" name="sold"  autocomplete="given-name"
                                       class="form-control form-control-solid" placeholder="Profit" onkeypress=" _addProfit(this.value,`+data.id+`)"
                                       required/>

                           `;
                    },

                },

            ],
        });

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
            $(e.currentTarget).find('#exampleModalFormTitle').text('Do you really want to delete this command ' + user_name + ' ?');
            $(e.currentTarget).find('#deleteForm').attr('action', 'dash/commands/' + command_id/+"destroy");
        });

        //delete multi modal
        $('#deleteMultiModal').on('show.bs.modal', function (e) {
            $(e.currentTarget).find('#deleteMultiSubmit').click(function (eclick) {
                eclick.preventDefault();
                $('#deleteMultiForm').submit();
            });
        });
        function _addQuantity(quantity, id) {
            for (let i = 0; i <products.length ; i++) {
                if(products[i].id == id){
                    products[i].monthlyQuantity = quantity;
                }
            }
        }
        function _addProfit(profit, id) {
            for (let i = 0; i <products.length ; i++) {
                if(products[i].id == id){
                    products[i].monthlyProfit = profit;
                }
            }
        }

        $('#saveData').on('click',function () {

            console.log($('#kt_select2_1 :selected').val()+ " "+$('#kt_select2_2 :selected').val()+ " "+$('#kt_select2_3 :selected').val());
            KTApp.blockPage({
                overlayColor: '#000000',
                opacity: 0.1,
                size: 'lg',
                state: 'danger',
                message: 'please wait...'
            });
            var token = $('meta[name="csrf-token"]').attr('content');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "dash/monthlyProfit/"+$('#kt_select2_1 :selected').val()+"/"+$('#kt_select2_2 :selected').val()+"/"+$('#kt_select2_3 :selected').val()+"/store",
                header:{
                    'X-CSRF-TOKEN': token
                },
                data: {
                    products: products,



                },
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    window.location.href = "{{URL('dash/monthlyProfit')}}";
                }
            });

        });

        $('#kt_select2_1').select2();
        $('#kt_select2_2').select2();


    </script>
@endsection

@section('content')
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-label">Monthly Data <span class="d-block text-muted pt-2 font-size-sm">Be careful</span>
                    </h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Dropdown-->

                    <!--end::Button-->
                </div>
            </div>


            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-4 col-md-4">
                        <label>Choose a Client : </label>
                        <select class="form-control " id="kt_select2_1" name="client_id" autocomplete="responsible" aria-hidden="true" tabindex="-1" data-select2-id="responsible_select">
                            @foreach($clients  as $client)
                                <option value="{{$client->id}}">{{$client->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-sm-4 col-md-4">
                        <label>Choose Month : </label>
                        <select class="form-control" id="kt_select2_2" name="type">
                            @for($i=0;$i<12; $i++)
                                <option value="{{$i+1}}">{{$months[$i]}}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="form-group col-sm-4 col-md-4">
                        <label>Choose a year : </label>
                        <select class="form-control" id="kt_select2_3" name="type">
                            @foreach($years as $year)
                                <option value="{{$year}}">{{$year}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <form id="deleteMultiForm" action="dash/commands/delete-multi" method="post">
                @csrf
                <!--begin: Datatable-->
                    <table class="table table-bordered table-checkable" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Profit</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <!--end: Datatable-->
                </form>
                <div class="card-footer">
                    <div class="card-toolbar" style="float:right">
                        <!--begin::Dropdown-->

                    <!--end::Dropdown-->
                        <!--begin::Button-->
                        <button  class="btn btn-secondary font-weight-bolder text-grey" >
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
                            Cancel
                        </button>
                            <button  class="btn btn-primary font-weight-bolder" id="saveData">
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
                               Save
                            </button>



                    <!--end::Button-->
                    </div>
                </div>

            </div>


        </div>
        <!--end::Card-->
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
                            <button type="submit" class="btn btn-danger font-weight-bold">Delete</button>
                        </div>
                    </div>
                </form>
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
