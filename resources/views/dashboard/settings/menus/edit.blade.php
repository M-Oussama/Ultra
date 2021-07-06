@extends('layouts.dashboard')

@section('page_meta')
    <title>Menu {{$menu->name}}</title>
    <meta name="keywords" content="Rozaric" />
    <meta name="description" content="Rozaric">
    <meta name="author" content="Rozaric">
@endsection

@section('styles')
    <!-- Page styles -->
    <link rel="stylesheet" href="assets/custom/css/menu.css" />
@endsection

@section('scripts')
    <!-- Page scripts -->
    <script src="assets/plugins/custom/camohub/jquery-sortable-lists.js"></script>
    <script>
        var options = {
            placeholderCss: {'background-color': '#ff8'},
            hintCss: {'background-color':'#bbf'},
            onChange: function( cEl )
            {
                console.log( 'onChange' );
            },
            complete: function( cEl )
            {
                console.log( 'complete' );
            },
            isAllowed: function( cEl, hint, target )
            {
                // Be carefull if you test some ul/ol elements here.
                // Sometimes ul/ols are dynamically generated and so they have not some attributes as natural ul/ols.
                // Be careful also if the hint is not visible. It has only display none so it is at the previous place where it was before(excluding first moves before showing).
                if( (cEl.data('section') && !hint.parent().hasClass('sTree2')) || target.data('section'))
                {
                    hint.css('background-color', '#ff9999');
                    return false;
                }
                else
                {
                    hint.css('background-color', '#99ff99');
                    return true;
                }
            },
            opener: {
                active: true,
                as: 'html',  // if as is not set plugin uses background image
                close: '<i class="fa fa-minus c3"></i>',  // or 'fa-minus c3'
                open: '<i class="fa fa-plus"></i>',  // or 'fa-plus'
                openerCss: {
                    'display': 'inline-block',
                    //'width': '18px', 'height': '18px',
                    'float': 'left',
                    'margin-left': '-35px',
                    'margin-right': '5px',
                    //'background-position': 'center center', 'background-repeat': 'no-repeat',
                    'font-size': '1.1em'
                }
            },
            ignoreClass: 'clickable'
        };

        $('#sTree2').sortableLists( options );

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#saveButton').click(function (e) {
            e.preventDefault();

            $.ajax({
                type:'POST',
                url:"dash/menus/menu-items/{{$menu->id}}/update",
                data:{
                    menu_items:$('#sTree2').sortableListsToArray(),
                },
                success:function(data){
                    location.reload();
                }
            });
        })

        //delete modal
        $('#deleteModal').on('show.bs.modal', function(e) {
            //get data-id attribute of the clicked element
            var menu_id = $(e.relatedTarget).data('menu_id');
            var grand_menu_id = $(e.relatedTarget).data('grand_menu_id');
            var menu_name = $(e.relatedTarget).data('menu_name');

            //populate the textbox
            $(e.currentTarget).find('#exampleModalFormTitle').text('Do you really want to delete the menu item : '+menu_name+' ?');
            $(e.currentTarget).find('#deleteForm').attr('action', 'dash/menus/menu-items/'+grand_menu_id+'/delete/'+menu_id);
        });
    </script>
@endsection

@section('content')
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-label">Menu: {{$menu->name}} <span class="d-block text-muted pt-2 font-size-sm">Be careful</span></h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <a href="dash/menus/menu-items/{{$menu->id}}/create" class="btn btn-primary font-weight-bolder">
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
                        New Menu-item
                    </a>
                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                <h1>{{$menu->name}}</h1>
                <div id="menu-container" class="p-2">
                    <ul class="sTree2 listsClass" id="sTree2">
                        @foreach($menu->childrenAll as $sub_menu)
                            @include('dashboard.settings.menus.multilevel',['parent'=>$sub_menu,'grand_parent'=>$menu])
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <a id="saveButton" href="#" class="btn btn-primary font-weight-bold mr-2">save</a>
                <a href="dash/menus" class="btn btn-secondary font-weight-bold">cancel</a>
            </div>
        </div>
        <!--end::Card-->
        <!-- start::delete modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalFormTitle" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" role="document">
                <form id="deleteForm" action="" method="post">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalFormTitle">Do you really want to delete this menu ?</h5>
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
    </div>
@endsection
