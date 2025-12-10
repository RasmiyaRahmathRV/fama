@extends('admin.layout.admin_master')

@section('custom_css')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/daterangepicker/daterangepicker.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('assets/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('assets/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Cheque Clearing</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active">Cheque Clearing</li>
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
                                            <div class="col-md-1 ml-4">
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="radioPrimary1" class="radioType"
                                                        value="1" name="r1" checked>
                                                    <label for="radioPrimary1">Vendor
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="icheck-primary d-inline">
                                                    <input type="radio" id="radioPrimary2" class="radioType"
                                                        value="2" name="r1">
                                                    <label for="radioPrimary2">Tenant
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
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
                                            <div class="col-md-2">
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
                                            <div class="col-md-2 vendorselect">
                                                <label for="inputPassword3">Vendor</label>
                                                <select class="form-control select2" name="area_id">
                                                    <option value="">Select Vendor</option>
                                                    <option value="1">Vendor 1</option>
                                                </select>
                                            </div>

                                            <div class="col-md-2 propertyselect">
                                                <label for="inputPassword3">Property</label>
                                                <select class="form-control select2" name="area_id">
                                                    <option value="">Select Property</option>
                                                    <option value="1">Property 1</option>
                                                </select>
                                            </div>

                                            <div class="col-md-2 unitselect">
                                                <label for="inputPassword3">Unit</label>
                                                <select class="form-control select2" name="area_id">
                                                    <option value="">Select Unit</option>
                                                    <option value="1">Unit 1</option>
                                                </select>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="btn btn-info searchbtnchq">Search</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card -->

                                <div class="card searchCheque">
                                    <!-- /.card-header -->
                                    <div class="card-header">
                                        <button type="button" class="btn btn-success float-right" data-toggle="modal"
                                            data-target="#modal-success-clear-all">Clear All</button>
                                    </div>
                                    <div class="card-body">


                                        <div class="card card-info">
                                            <table id="example1" class="table table-striped projects ">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <div class="icheck-primary d-inline">
                                                                <input type="checkbox" name="selectall" id="selectAll"
                                                                    value="1" onclick="toggleAllCheckboxes()">
                                                                <label for="selectAll">Select All
                                                                </label>
                                                            </div>
                                                        </th>
                                                        <th>Project</th>
                                                        <th>Vendor</th>
                                                        <th>Building</th>
                                                        <th>Unit</th>
                                                        <th>Due Date</th>
                                                        <th>Ch.No</th>
                                                        <th>Amount</th>
                                                        <th>Composition</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="icheck-primary d-inline">
                                                                <input type="checkbox" id="ichek1"
                                                                    class="groupCheckbox" name="installment_id[]">
                                                                <label for="ichek1">
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>PRJ00001</td>
                                                        <td>Vendor 1</td>
                                                        <td>Building name</td>
                                                        <td>Unit 1</td>
                                                        <td>01/08/2025</td>
                                                        <td>1234</td>
                                                        <td>100000.00</td>
                                                        <td>RENT 1/4</td>
                                                        <td>
                                                            <a class="btn btn-success  btn-sm" title="Clear cheque"
                                                                data-toggle="modal" data-target="#modal-success">Clear</a>
                                                            <a class="btn btn-danger btn-sm" title="return"
                                                                data-toggle="modal"
                                                                data-target="#modal-return-cheque">Return</a>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>

            <div class="modal fade" id="modal-success-clear-all">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">You Are Going To Pass This Cheque!</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" id="ContractImportForm" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="exampleInputEmail1">Clearing Date</label>
                                        <div class="input-group date" id="clearingdate" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input"
                                                data-target="#clearingdate" placeholder="dd-mm-YYYY" />
                                            <div class="input-group-append" data-target="#clearingdate"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" id="clearBtn" class="btn btn-info">Clear</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="modal fade" id="modal-success">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">You Are Going To Pass This Cheque!</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" id="ContractImportForm" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="exampleInputEmail1">Clearing Date</label>
                                        <div class="input-group date" id="clearingdate" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input"
                                                data-target="#clearingdate" placeholder="dd-mm-YYYY" />
                                            <div class="input-group-append" data-target="#clearingdate"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputEmail1">Clearing Amount</label>
                                        <input type="text" class="form-control" placeholder="Clearing Amount">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" id="clearBtn" class="btn btn-info">Clear</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="modal fade" id="modal-return-cheque">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">You Are Going To Return This Cheque!</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" id="ContractImportForm" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="exampleInputEmail1">Returning Date</label>
                                        <div class="input-group date" id="returndate" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input"
                                                data-target="#returndate" placeholder="dd-mm-YYYY" />
                                            <div class="input-group-append" data-target="#returndate"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="exampleInputEmail1">BCC Amount</label>
                                        <input type="text" class="form-control">
                                    </div>

                                    <div class="form-group row">
                                        <label for="exampleInputEmail1">Select Reason</label>
                                        <select class="form-control select2" name="company_id" id="company_id">
                                            <option value="">Select Reason</option>
                                            <option value="CA">Closed Account</option>
                                            <option value="IF">Insufficient Funds</option>
                                            <option value="SI">Signature Irregular</option>
                                            <option value="SC">Stale Cheque</option>
                                            <option value="US">Unauthorized Signatory</option>
                                            <option value="SP">Stop Payment</option>
                                            <option value="FA">Frozen Account</option>
                                            <option value="EC">Effects Not Cleared, Present Again</option>
                                            <option value="SD">Drawer's Signature Differs</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" id="clearBtn" class="btn btn-info">Clear</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </section>
    </div>
@endsection


@section('custom_js')
    <script src="{{ asset('assets/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('assets/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script>
        $('#dateFrom').datetimepicker({
            format: 'DD-MM-YYYY'
        });

        $('#dateTo').datetimepicker({
            format: 'DD-MM-YYYY'
        });

        $(document).ready(function() {
            $('.searchCheque').hide();

            $('.propertyselect').hide();
            $('.unitselect').hide();
        });

        $('.searchbtnchq').click(function() {
            $('.searchCheque').show();
        });

        $('.radioType').click(function() {
            var value = $(this).val();
            if (value == "1") {
                $('.vendorselect').show();
                $('.propertyselect').hide();
                $('.unitselect').hide();
            } else {
                $('.vendorselect').hide();
                $('.propertyselect').show();
                $('.unitselect').show();
            }
        });

        function toggleAllCheckboxes() {
            document.getElementById('selectAll').addEventListener('change', function() {
                const itemCheckboxes = document.querySelectorAll('.groupCheckbox');
                itemCheckboxes.forEach(checkbox => {
                    checkbox.checked = this
                        .checked; // Set checked status based on the "Select All" checkbox
                });
            });
        }

        $('#clearingdate').datetimepicker({
            format: 'DD-MM-YYYY'
        });

        $('#returndate').datetimepicker({
            format: 'DD-MM-YYYY'
        });
    </script>
@endsection
