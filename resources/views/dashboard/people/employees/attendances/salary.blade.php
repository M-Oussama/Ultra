@extends('layouts.dashboard')

@section('page_meta')
    <title>Salary</title>
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

            pageLength: {{count($employees)}},

            language: {
                'lengthMenu': 'Display _MENU_',
            },

            data: {!! $employees !!},



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
                    data: null,
                    render: function (data, type, row) {
                        return data.name +" "+data.surname;
                    }

                },
                {
                    data: null,
                    render: function (data, type, row) {
                        if(data.monthly_payroll[0].salary === null)
                            return `<input type='number' value="0" name="salary`+data.id+`"\
                            class='form-control form-control-solid'\
                             required/>`;
                        return `<input type='number' value="`+data.monthly_payroll[0].salary+`" name="salary`+data.id+`"\
                        class='form-control form-control-solid'\
                         required/>`;
                    }
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
            var employee_id = $(e.relatedTarget).data('employee_id');
            var employee_name = $(e.relatedTarget).data('employee_name');

            //populate the textbox
            $(e.currentTarget).find('#exampleModalFormTitle').text('Do you really want to delete the employee ' + employee_name + ' ?');
            $(e.currentTarget).find('#deleteForm').attr('action', 'dash/employees/' + employee_id);
        });
        $('#leaveModal').on('show.bs.modal', function (e) {
            //get data-id attribute of the clicked element
            var employee_id = $(e.relatedTarget).data('employee_id');
            var start_date = $(e.relatedTarget).data('start_date');

            console.log(start_date);
            $('#leave_employee_id').val(employee_id);
            $('#end_date').attr('min' , start_date);

            //populate the textbox

        });
        $('#returnModal').on('show.bs.modal', function (e) {
            //get data-id attribute of the clicked element
            var employee_id = $(e.relatedTarget).data('employee_id');
            var start_date = $(e.relatedTarget).data('end_date');



            var date = new Date(start_date);

// Add one day to the date
            date.setDate(date.getDate() + 1);

// Convert the modified date back to a string in the desired format
            var modifiedDateString = date.toISOString().split('T')[0];




           // var end_date = $(e.relatedTarget).data('end_date');
            $('#return_employee_id').val(employee_id);
           $('#start_date').attr('min' , modifiedDateString);
            //populate the textbox

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
                    <h3 class="card-label">employees <span class="d-block text-muted pt-2 font-size-sm">Be careful</span>
                    </h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Dropdown-->

                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                <form id="deleteMultiForm" action="dash/monthly/salary" method="post">
                @csrf
                @method('put')
                    <input name="attendance_id" hidden value="{{$attendance->id}}">
                <!--begin: Datatable-->
                    <table class="table table-bordered table-checkable" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID</th>
                            <th>FULL NAME</th>
                            <th>SALARY</th>

                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <!--end: Datatable-->
                    <div class="form-group col-sm-12 col-md-6">
                        <label>CNAS* :</label>
                        <input type="number" id="cnas" name="cnas_contributions"
                               class="form-control form-control-solid" value="{{old('cnas_contributions',$attendance->cnas_contributions)}}"
                               placeholder="Please enter CNAS " />
                        <span class="form-text text-muted">Please enter CNAS </span>
                    </div>
                    <button type="submit" class="btn btn-success float-right font-weight-bold">Submit</button>
                </form>
            </div>
        </div>
        <!--end::Card-->




    </div>
@endsection
