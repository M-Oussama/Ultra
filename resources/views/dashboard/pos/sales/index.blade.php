@extends('layouts.dashboard')

@section('page_meta')
    <title>Sales</title>
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


        function openRealInvoice(){

            // Define the data you want to display in the new window
            var windowName = 'NEW_SALE_' + new Date().getTime();

            // Open a new window with a blank page
            var newWindow = window.open('' ,windowName, 'width=1200,height=1200,scrollbars=yes,resizable=yes');
            // Write the data to the new window
            var iframe = document.createElement('iframe');
            iframe.src = '/assets/real_invoice.html';
            iframe.style.width = '100%';
            iframe.style.height = '100%';
            iframe.style.border = 'none';

            // Add the iframe to the new window's document
            newWindow.document.body.appendChild(iframe);
        }

        function openInvoice(){
            console.log("clicked");
            // Define the data you want to display in the new window
            var windowName = 'NEW_SALE_' + new Date().getTime();

            // Open a new window with a blank page
            var newWindow = window.open('' ,windowName, 'width=1200,height=1200,scrollbars=yes,resizable=yes');
            // Write the data to the new window
            var iframe = document.createElement('iframe');
            iframe.src = '/assets/invoice.html';
            iframe.style.width = '100%';
            iframe.style.height = '100%';
            iframe.style.border = 'none';

            // Add the iframe to the new window's document
            newWindow.document.body.appendChild(iframe);
        }

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

            data: {!! $sales !!},

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
                   data: null,

                    title: 'id',
                   orderable: false,
                   render : function (data, type, row){

                       return  data.id;
                   }
               },

                {
                    data: null,

                  title: 'Client',
                 orderable: false,
                 render : function (data, type, row){

                     return  data.client.name + " "+ data.client.surname;
                 }
                },
                {
                    data: null,

                     title: 'TOTAL',
                    orderable: false,
                    render : function (data, type, row){
                        return data.amount.toFixed(2)+ " DA";
                    }
                },
                {
                    data: null,

                     title: 'PAID',
                    orderable: false,
                    render : function (data, type, row){
                        return data.payment.toFixed(2)+ " DA";
                    }
                },
                {
                    data: null,

                     title: 'REST',
                    orderable: false,
                    render : function (data, type, row){
                        return data.rest.toFixed(2)+ " DA";
                    }
                },
                {
                    data: 'date',
                },
                {
                    data: null,

                    title: 'TOTAL',
                    orderable: false,
                    render : function (data, type, row){
                        if(data.paid ===1 ) return "<span class='text-success'><b>Paid</b></span>";

                         return "<span class='text-danger'> <b>Not Paid</b></span>";
                    }
                },
                {
                    data: null,
                    title: 'Actions',
                    orderable: false,
                    width: '175px',
                    className: 'text-center',
                    render: function (data, type, row) {
                        return '@canany(['edit-sale','delete-sale'])
                            <a  class="btn btn-sm btn-clean btn-icon mr-2" title="facture" onclick="openRealInvoice()">\
                                  <span class="svg-icon svg-icon-lg-xxl">\
                                       <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                                <rect x="0" y="0" width="24" height="24"/>\
                                                <path d="M16,17 L16,21 C16,21.5522847 15.5522847,22 15,22 L9,22 C8.44771525,22 8,21.5522847 8,21 L8,17 L5,17 C3.8954305,17 3,16.1045695 3,15 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,15 C21,16.1045695 20.1045695,17 19,17 L16,17 Z M17.5,11 C18.3284271,11 19,10.3284271 19,9.5 C19,8.67157288 18.3284271,8 17.5,8 C16.6715729,8 16,8.67157288 16,9.5 C16,10.3284271 16.6715729,11 17.5,11 Z M10,14 L10,20 L14,20 L14,14 L10,14 Z" fill="#000000"/>\
                                                <rect fill="#000000" opacity="0.3" x="8" y="2" width="8" height="2" rx="1"/>\
                                                </g>\
                                        </svg><!--end::Svg Icon-->\
                                </span>\
                                </a>\
                                <a  class="btn btn-sm btn-clean btn-icon mr-2" title="bon de livraison" onclick="openInvoice()">\
                                  <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Communication/Clipboard-list.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                            <rect x="0" y="0" width="24" height="24"/>\
                            <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>\
                            <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>\
                            <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"/>\
                            <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/>\
                            <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"/>\
                            <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"/>\
                            <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"/>\
                            <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"/>\
                            </g>\
                    </svg><!--end::Svg Icon--></span>   \
                                          </span>\
                                </a>\
                                @can('edit-sale')
                            <a href="dash/sales/' + row.id + '/edit" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                                    <span class="svg-icon svg-icon-md">\
                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="480" height="480" viewBox="0 0 48 48">\
                                                        <path fill="#E57373" d="M42.583,9.067l-3.651-3.65c-0.555-0.556-1.459-0.556-2.015,0l-1.718,1.72l5.664,5.664l1.72-1.718C43.139,10.526,43.139,9.625,42.583,9.067"></path><path fill="#FF9800" d="M4.465 21.524H40.471999999999994V29.535H4.465z" transform="rotate(134.999 22.469 25.53)"></path><path fill="#B0BEC5" d="M34.61 7.379H38.616V15.392H34.61z" transform="rotate(-45.02 36.61 11.385)"></path><path fill="#FFC107" d="M6.905 35.43L5 43 12.571 41.094z"></path><path fill="#37474F" d="M5.965 39.172L5 43 8.827 42.035z"></path>\
                                         </svg>\
                                    </span>\
                                </a>\
                            @endcan
                            @can('delete-sale')
                                <a href="#" data-toggle="modal"  data-target="#deleteModal" data-sale_id="' + row.id + '"  class="btn btn-sm btn-clean btn-icon" title="Delete">\
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
            var sale_id = $(e.relatedTarget).data('sale_id');


            //populate the textbox
            $(e.currentTarget).find('#exampleModalFormTitle').text('Do you really want to delete this sale ?');
            $(e.currentTarget).find('#deleteForm').attr('action', 'dash/sales/' + sale_id+"/destroy");
        });

          $('#exportMultiModal').on('show.bs.modal', function (e) {

                 $(e.currentTarget).find('#exportMultiSubmit').click(function (eclick) {

                                eclick.preventDefault();
                                          $(e.currentTarget).find('#deleteMultiForm').attr('action', 'dash/sales/invoice/export');

                                $('#deleteMultiForm').submit();
                            });

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
                    <h3 class="card-label">sales <span class="d-block text-muted pt-2 font-size-sm">Be careful</span>
                    </h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Dropdown-->
                    @canany(['delete-sale','list-sale'])
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







                                </ul>
                                <!--end::Navigation-->
                            </div>
                            <!--end::Dropdown Menu-->
                        </div>
                    @endcanany
                    <!--end::Dropdown-->
                    <!--begin::Button-->
                    @can('create-sale')
                        <a href="dash/sales/create" class="btn btn-primary font-weight-bolder">
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
                            New Sale
                        </a>
                    @endcan
                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                <form id="deleteMultiForm" action="dash/sales/delete-multi" method="post">
                @csrf
                <!--begin: Datatable-->
                    <table class="table table-bordered table-checkable" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID</th>
                            <th>Client</th>
                            <th>TOTAL</th>
                            <th>PAID</th>
                            <th>REST</th>
                            <th>Date</th>
                            <th>STATUS</th>
                            <th>Operation</th>

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
        <!-- end::delete multi modal -->


         <div class="modal fade" id="exportMultiModal" tabindex="-1" aria-labelledby="exampleModalFormTitle"
                     aria-hidden="true" style="display: none;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalFormTitle">Do you really want to export these sales
                                    ?</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">
                                    Close
                                </button>
                                <button id="exportMultiSubmit" type="submit" class="btn btn-danger font-weight-bold">yes
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
@endsection
