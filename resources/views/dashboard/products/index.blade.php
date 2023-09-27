@extends('layouts.dashboard')

@section('page_meta')
    <title>Products</title>
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
                    render: function (data,type,row){
                        return parseFloat(data.price).toFixed(2) + " DA";
                    }
                },
                {
                    data: null,
                    render: function (data,type,row){
                        return data.quantity+ " Kg";
                    }
                },
                {
                    data: null,
                    render: function (data, type, row){
                        if(data.stackable === 1)
                            return "<span class='text-success'><b>YES</b></span>";
                        return "<span class='text-danger'><b>NON</b></span>";
                    }
                },
                {
                    data: null,
                    title: 'Actions',
                    orderable: false,
                    width: '175px',
                    className: 'text-center',
                    render: function (data, type, row) {
                        return '\
                        @canany(['edit-product','delete-product'])
                            @can('edit-product')
                            <a href="dash/products/' + row.id + '/edit" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                                  <span class="svg-icon svg-icon-lg-xxl">\
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="480" height="480" viewBox="0 0 48 48">\
                                            <path fill="#E57373" d="M42.583,9.067l-3.651-3.65c-0.555-0.556-1.459-0.556-2.015,0l-1.718,1.72l5.664,5.664l1.72-1.718C43.139,10.526,43.139,9.625,42.583,9.067"></path><path fill="#FF9800" d="M4.465 21.524H40.471999999999994V29.535H4.465z" transform="rotate(134.999 22.469 25.53)"></path><path fill="#B0BEC5" d="M34.61 7.379H38.616V15.392H34.61z" transform="rotate(-45.02 36.61 11.385)"></path><path fill="#FFC107" d="M6.905 35.43L5 43 12.571 41.094z"></path><path fill="#37474F" d="M5.965 39.172L5 43 8.827 42.035z"></path>\
                                    </svg>\
                                    </span>\
                                </a>\
                            @endcan
                            @can('delete-product')
                                <a href="#" data-toggle="modal"  data-target="#deleteModal" data-user_id="' + row.id + '" data-user_name="' + row.name + '" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                                     <span class="svg-icon svg-icon-lg-xxl">\
                                                 <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="480" height="480" viewBox="0 0 48 48">\
                                              <path fill="#9575CD" d="M34,12l-6-6h-8l-6,6h-3v28c0,2.2,1.8,4,4,4h18c2.2,0,4-1.8,4-4V12H34z"></path><path fill="#7454B3" d="M24.5 39h-1c-.8 0-1.5-.7-1.5-1.5v-19c0-.8.7-1.5 1.5-1.5h1c.8 0 1.5.7 1.5 1.5v19C26 38.3 25.3 39 24.5 39zM31.5 39L31.5 39c-.8 0-1.5-.7-1.5-1.5v-19c0-.8.7-1.5 1.5-1.5l0 0c.8 0 1.5.7 1.5 1.5v19C33 38.3 32.3 39 31.5 39zM16.5 39L16.5 39c-.8 0-1.5-.7-1.5-1.5v-19c0-.8.7-1.5 1.5-1.5l0 0c.8 0 1.5.7 1.5 1.5v19C18 38.3 17.3 39 16.5 39z"></path><path fill="#B39DDB" d="M11,8h26c1.1,0,2,0.9,2,2v2H9v-2C9,8.9,9.9,8,11,8z"></path>\
                                        </svg>\
                                        <!--end::Svg Icon-->\
                                    </span>\
                                </a>\
                            @endcan
                        @else
                                <i>No Actions Available </i>\
                        @endcanany
                        ';
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
            $(e.currentTarget).find('#exampleModalFormTitle').text('Do you really want to delete the user ' + user_name + ' ?');
            $(e.currentTarget).find('#deleteForm').attr('action', 'dash/products/' + user_id);
        });

        //delete multi modal
        $('#deleteMultiModal').on('show.bs.modal', function (e) {
            $(e.currentTarget).find('#deleteMultiSubmit').click(function (eclick) {
                eclick.preventDefault();
                $('#deleteMultiForm').submit();
            });
        });
    </script>
@endsection

@section('content')
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-label">Products <span class="d-block text-muted pt-2 font-size-sm">Be careful</span>
                    </h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    @can('create-user')
                        <a href="dash/products/create" class="btn btn-primary font-weight-bolder">
                            <span class="svg-icon svg-icon-">
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
                        </a>
                    @endcan
                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                <form id="deleteMultiForm" action="dash/products/delete-multi" method="post">
                @csrf
                <!--begin: Datatable-->
                    <table class="table table-bordered table-checkable" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>price</th>
                            <th>Quantity</th>
                            <th>stackable</th>
                            <th>Actions</th>


                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <!--end: Datatable-->
                </form>
            </div>
        </div>
        <!--end::Card-->
        <!-- start::delete modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalFormTitle"
             aria-hidden="true" style="display: none;">
            <div class="modal-dialog" role="document">
                <form id="deleteForm" action="dash/products/{id}" method="post">
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
                        <h5 class="modal-title" id="exampleModalFormTitle">Do you really want to delete these products
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
