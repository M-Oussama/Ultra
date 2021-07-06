@extends('layouts.dashboard')

@section('page_meta')
    <title>Permissions</title>
    <meta name="keywords" content="Rozaric" />
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

            data: {!! $permissions !!},

            // Order settings
            order: [[1, 'asc']],

            headerCallback: function(thead, data, start, end, display) {
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
                    render: function(data, type, row) {
                        return `
                        <label class="checkbox checkbox-single">
                            <input type="checkbox" name="ids[]" value="`+row.id+`" class="checkable"/>
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
                    title: 'Actions',
                    orderable: false,
                    width: '175px',
                    className: 'text-center',
                    render: function(data, type, row) {
                        return '\
                        @if(Auth::user()->can('edit-permission') || Auth::user()->can('delete-permission'))
                            @can('edit-permission')
                                <a href="#" data-toggle="modal"  data-target="#editFormModal" data-permission_id="'+row.id+'" data-permission_name="'+row.name+'" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">\
                                    <span class="svg-icon svg-icon-md">\
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                                <rect x="0" y="0" width="24" height="24"/>\
                                                <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>\
                                                <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>\
                                            </g>\
                                        </svg>\
                                    </span>\
                                </a>\
                            @endcan
                            @can('delete-permission')
                                <a href="#" data-toggle="modal"  data-target="#deleteModal" data-permission_id="'+row.id+'" data-permission_name="'+row.name+'" class="btn btn-sm btn-clean btn-icon" title="Delete">\
                                    <span class="svg-icon svg-icon-md">\
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                                <rect x="0" y="0" width="24" height="24"/>\
                                                <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>\
                                                <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>\
                                            </g>\
                                        </svg>\
                                    </span>\
                                </a>\
                            @endcan
                        @else
                                <i>No Actions Available </i>\
                        @endif
	                    ';
                    },
                },
            ],
        });

        table.on('change', '.group-checkable', function() {
            var set = $(this).closest('table').find('td:first-child .checkable');
            var checked = $(this).is(':checked');

            $(set).each(function() {
                if (checked) {
                    $(this).prop('checked', true);
                    $(this).closest('tr').addClass('active');
                }
                else {
                    $(this).prop('checked', false);
                    $(this).closest('tr').removeClass('active');
                }
            });
        });

        table.on('change', 'tbody tr .checkbox', function() {
            $(this).parents('tr').toggleClass('active');
            var checkable = $('input[class=checkable]');
            var groupcheck = $('input[class=group-checkable]');
            if(checkable.not(':checked').length > 0){
                groupcheck.prop('checked', false);
            }else {
                groupcheck.prop('checked', true);
            }
        });

        //edit form modal
        $('#editFormModal').on('show.bs.modal', function(e) {
            //get data-id attribute of the clicked element
            var permission_id = $(e.relatedTarget).data('permission_id');
            var permission_name = $(e.relatedTarget).data('permission_name');

            //populate the textbox
            $(e.currentTarget).find('#exampleModalFormTitle').text('Edit permission permission '+permission_name);
            $(e.currentTarget).find('input[name="name"]').val(permission_name);
            $(e.currentTarget).find('#editForm').attr('action', 'dash/permissions/'+permission_id);
        });

        //delete modal
        $('#deleteModal').on('show.bs.modal', function(e) {
            //get data-id attribute of the clicked element
            var permission_id = $(e.relatedTarget).data('permission_id');
            var permission_name = $(e.relatedTarget).data('permission_name');

            //populate the textbox
            $(e.currentTarget).find('#exampleModalFormTitle').text('Do you really want to delete the permission '+permission_name+' ?');
            $(e.currentTarget).find('#deleteForm').attr('action', 'dash/permissions/'+permission_id);
        });

        //delete multi modal
        $('#deleteMultiModal').on('show.bs.modal', function(e) {
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
                    <h3 class="card-label">Permissions <span class="d-block text-muted pt-2 font-size-sm">Be careful</span></h3>
                </div>
                <div class="card-toolbar">

                    <!--begin::Dropdown-->
                    @can('delete-permission')
                        <div class="dropdown dropdown-inline mr-2">
                            <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
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
                                    <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an action:</li>
                                    <li class="navi-item">
                                        <a href="#" data-toggle="modal" data-target="#deleteMultiModal" class="navi-link">
                                        <span class="navi-icon">
                                            <i class="la la-trash"></i>
                                        </span>
                                            <span class="navi-text">Delete</span>
                                        </a>
                                    </li>
                                </ul>
                                <!--end::Navigation-->
                            </div>
                            <!--end::Dropdown Menu-->
                        </div>
                    @endcan
                    <!--end::Dropdown-->
                    <!--begin::Button-->
                    @can('create-permission')
                        <a href="dash/Permissions/create" data-toggle="modal" data-target="#addFormModal" class="btn btn-primary font-weight-bolder">
                            <span class="svg-icon svg-icon-md">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
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
                            New Permission
                        </a>
                    @endcan
                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                <form id="deleteMultiForm" action="dash/permissions/delete-multi" method="post">
                @csrf
                    <!--begin: Datatable-->
                    <table class="table table-bordered table-checkable" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID</th>
                            <th>Name</th>
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
        <!-- start::add modal -->
        <div class="modal fade" id="addFormModal" tabindex="-1" aria-labelledby="exampleModalFormTitle" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" role="document">
                <form action="dash/permissions" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalFormTitle">Add a new permission</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="permission_name">permission name</label>
                                <input type="text" class="form-control" name="name" aria-describedby="permissionHelp" placeholder="Enter permission name">
                                <small id="permissionHelp" class="form-text text-muted">Please enter a permission name.</small>
                            </div>
                            <div class="checkbox-inline">
                                <label class="checkbox">
                                    <input type="hidden" name="basePermission" value="false">
                                    <input type="checkbox" name="basePermission" value="true">
                                    <span></span> Base permission
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary font-weight-bold">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end::add modal -->
        <!-- start::edit form modal -->
        <div class="modal fade" id="editFormModal" tabindex="-1" aria-labelledby="exampleModalFormTitle" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" role="document">
                <form id="editForm" action="dash/permissions/{id}" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalFormTitle">Edit permission</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="permission_name">Permission name</label>
                                <input type="text" class="form-control" name="name" aria-describedby="roleHelp" placeholder="Enter permission name">
                                <small id="permissionHelp" class="form-text text-muted">Please enter a permission name.</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                            <button id="deleteMultiSubmit" type="submit" class="btn btn-primary font-weight-bold">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end::edit form modal -->
        <!-- start::delete modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalFormTitle" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" role="document">
                <form id="deleteForm" action="dash/permissions/{id}" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalFormTitle">Do you really want to delete this permission ?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger font-weight-bold">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end::delete modal -->
        <!-- start::delete multi modal -->
        <div class="modal fade" id="deleteMultiModal" tabindex="-1" aria-labelledby="exampleModalFormTitle" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalFormTitle">Do you really want to delete these permissions ?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                        <button id="deleteMultiSubmit" type="submit" class="btn btn-danger font-weight-bold">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end::delete multi modal -->
    </div>
@endsection
