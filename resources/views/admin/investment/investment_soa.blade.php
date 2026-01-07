@extends('admin.layout.admin_master')

@section('custom_css')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('assets/select2/css/select2.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('assets/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Investment SOA</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active">Investment SOA</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="card card-info">
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form class="form-horizontal">
                                        <div class="form-group row m-4">
                                            <div class="col-md-3">
                                                <label for="exampleInputEmail1">From</label>
                                                <div class="input-group date" id="dateFrom" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input"
                                                        data-target="#dateFrom" placeholder="dd-mm-YYYY" />
                                                    <div class="input-group-append" data-target="#dateFrom"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="exampleInputEmail1">To</label>
                                                <div class="input-group date" id="dateTo" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input"
                                                        data-target="#dateTo" placeholder="dd-mm-YYYY" />
                                                    <div class="input-group-append" data-target="#dateTo"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-1 float-right mt-31">
                                                <button type="button" class="btn btn-info searchbtn">Search</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                                <!-- /.card -->
                                <div class="card">
                                    <div class="card-body">
                                        <table id="investmentSoa" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Date</th>
                                                    <th>Account Name</th>
                                                    <th>Investor Name</th>
                                                    <th>Credit</th>
                                                    <th>Debit</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->


    </div>
    <!-- /.modal -->
@endsection

@section('custom_js')
    <script src="{{ asset('assets/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-buttons/js/buttons.colVis.min.js') }}"></script>




    <script>
        let table = '';
        // $(function() {
        //     table = $("#investmentSoa").DataTable({
        //         processing: true,
        //         serverSide: false,
        //         responsive: true,
        //         ajax: {
        //             url: "{{ route('investment-soa.data') }}",
        //             data: function(d) {
        //                 // d.company_id = companyId;
        //                 d.from = $('#dateFrom input').val();
        //                 d.to = $('#dateTo input').val();
        //             }
        //         },
        //         columns: [{
        //                 data: null,
        //                 render: (d, t, r, m) => m.row + 1
        //             },
        //             {
        //                 data: 'date'
        //                 // name: ''
        //             },
        //             {
        //                 data: 'account_name'
        //             },
        //             {
        //                 data: 'investor_name'
        //             },
        //             {
        //                 data: 'credit',
        //                 render: d => parseFloat(d).toFixed(2)
        //             },
        //             {
        //                 data: 'debit',
        //                 render: d => parseFloat(d).toFixed(2)
        //             }
        //         ],
        //         buttons: ["excel"]
        //     });
        // });
        $(function() {
            table = $("#investmentSoa").DataTable({
                processing: true,
                serverSide: false,
                responsive: true,
                ajax: {
                    url: "{{ route('investment-soa.data') }}",
                    data: function(d) {
                        d.from = $('#dateFrom input').val();
                        d.to = $('#dateTo input').val();
                    },
                    dataSrc: function(json) {
                        console.log('Full JSON:', json);
                        console.log('Rows:', json.data.original.data);
                        return json.data.original.data;
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        orderable: false
                    },
                    {
                        data: 'date'
                    },
                    {
                        data: 'account_name',
                        name: 'account_name'
                    },
                    {
                        data: 'investor_name',
                        name: 'investor_name'
                    },
                    {
                        data: 'credit',
                        name: 'investment_amount'
                    },
                    {
                        data: 'debit',
                        name: "amount_paid"
                    }
                ],
                buttons: ['excel'],
                dom: 'Bfrtip'
            });

        });



        $('#dateFrom').datetimepicker({
            format: 'DD-MM-YYYY',
            defaultDate: moment().startOf('month')
        });

        $('#dateTo').datetimepicker({
            format: 'DD-MM-YYYY',
            defaultDate: moment()
        });
        $('.searchbtn').click(function() {
            $('.searchCheque').show();
            table.ajax.reload();
        });

        $(document).ready(function() {
            $('.bank').hide();
            $('.chq').hide();
            $('.chqot').hide();
        });
        $('#payment_mode').change(function() {
            var payment_mode = $(this).val();
            if (payment_mode == 'chq') {
                $('.chq').show();
                $('.bank').hide();
                $('.chqot').hide();
            } else if (payment_mode == 'bank') {
                $('.bank').show();
                $('.chq').hide();
                $('.chqot').hide();
            } else {
                $('.bank').hide();
                $('.chq').hide();
                $('.chqot').hide();
            }
        });

        function toggleAllCheckboxes() {
            document.getElementById('selectAll').addEventListener('change', function() {
                const itemCheckboxes = document.querySelectorAll('.groupCheckbox');
                itemCheckboxes.forEach(checkbox => {
                    checkbox.checked = this
                        .checked;
                });
            });
        }
    </script>
@endsection
