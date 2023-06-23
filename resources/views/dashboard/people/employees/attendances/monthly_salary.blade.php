@extends('layouts.dashboard')

@section('page_meta')
    <title>monthly salary</title>
    <meta name="keywords" content="Rozaric"/>
    <meta name="description" content="Rozaric">
    <meta name="author" content="Rozaric">
@endsection

@section('styles')
    <!-- Page styles -->
    <style>
        .vertical-text {
            writing-mode: vertical-rl; /* Set the writing mode to vertical right-to-left */
            text-orientation: sideways; /* Set the text orientation to sideways */
            transform: rotate(180deg);
            width: 45px !important;

        }
        /* custom scrollbar */
        ::-webkit-scrollbar {
            width: 25px;
        }

        ::-webkit-scrollbar-track {
            background-color: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #d6dee1;
            border-radius: 20px;
            border: 6px solid transparent;
            background-clip: content-box;
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: #a8bbbf;
        }
        .dt-left{
            width: 45px !important;
        }
        table.dataTable tbody tr td {
            word-wrap: break-word;
            word-break: break-all;
        }
    </style>
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
                        console.log(data.monthly_payroll[0]);
                        return data.name +" "+data.surname;
                    }

                },
                {
                    data: null,
                    render: function (data, type, row) {
                        return data.monthly_payroll[0].salary;
                    }
                },
                {
                    data: null,
                    render: function (data, type, row) {
                        return data.monthly_payroll[0].working_days;
                    }
                },
                {
                    data: null,
                    render: function (data, type, row) {
                        return data.monthly_payroll[0].cal_salary;
                    }

                    },
                ],


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

                </div>


            </div>
            <div class="card-body">
                <form id="deleteMultiForm" action="dash/employees/delete-multi" method="post">
                    @csrf
                    <!--begin: Datatable-->
                    <table class="table table-bordered table-checkable" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID</th>
                            <th>FULL NAME</th>
                            <th>SALARY</th>
                            <th>WORKING DAYS</th>
                            <th>CALCULATED SALARY</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <!--end: Datatable-->
                </form>
            </div>
        </div>



    </div>
@endsection
