@extends('admin.layout.admin_master')

@section('custom_css')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
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
                        <h1>Investment</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active">Investment</li>
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
                            <div class="card-header">
                                <!-- <h3 class="card-title">Property Details</h3> -->
                                <span class="float-right">
                                    <a class="btn btn-info float-right m-1" href="{{ route('investment.create') }}">Add
                                        Investment</a>
                                    <button class="btn btn-secondary float-right m-1" data-toggle="modal"
                                        data-target="#modal-import">Import</button>
                                </span>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                <table id="investmentsTable" class="table table-striped  nowrap"width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Investor Name</th>
                                            <th>Investment Amount</th>
                                            <th>Date</th>
                                            <th>Profit Interval</th>
                                            <th>Profit %</th>
                                            <th>Maturity date</th>
                                            <th>Grace Period </th>
                                            <th>Payout Batch</th>
                                            <th>Nominee Details</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->


            <div class="modal fade" id="modal-Property">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Investment</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" id="PropertyForm">
                            <input type="hidden" name="id" id="Property_id">
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label>Investor</label>
                                            <select class="form-control select2">
                                                <option value="">Select Investor</option>
                                                <option value="1">Inv 1</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Investment Amount</label>
                                            <input type="text" class="form-control" placeholder="Investment Amount">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="inputEmail3" class="col-form-label">Investment Date</label>
                                            <div class="input-group date" id="investmentdate" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#investmentdate" placeholder="dd-mm-YYYY" />
                                                <div class="input-group-append" data-target="#investmentdate"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">

                                        <div class="col-sm-4">
                                            <label for="inputEmail3" class="col-form-label">Investment Term
                                                (Months)</label>
                                            <select class="form-control select2">
                                                <option value="">Select Term</option>
                                                <?php for ($i = 1; $i < 15; $i++) { ?>
                                                <option value="1"><?= $i ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="inputEmail3" class="col-form-label">Profit Interval
                                                (Months)</label>
                                            <select class="form-control select2">
                                                <option value="">Select Term</option>
                                                <option value="1">Monthly</option>
                                                <option value="4">Quarterly</option>
                                                <option value="6">Halfyearly</option>
                                                <option value="6">Yearly</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Grace Period ( Days )</label>
                                            <input type="number" class="form-control" placeholder="Grace Period">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label for="inputEmail3" class="col-form-label">Maturity date</label>
                                            <div class="input-group date" id="maturityDate" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input"
                                                    data-target="#maturityDate" placeholder="dd-mm-YYYY" />
                                                <div class="input-group-append" data-target="#maturityDate"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="inputEmail3" class="col-form-label">Profit %</label>
                                            <input type="text" name="Property_name" id="Property_name"
                                                class="form-control" id="inputEmail3" placeholder="Profit %">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="inputEmail3" class="col-form-label">Company</label>
                                            <select class="form-control select2">
                                                <option value="">Select Company</option>
                                                <option value="1">Fama Real estate</option>
                                                <option value="4">Walls and Bricks</option>
                                                <option value="6">Floors and Doors</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <label for="inputEmail3" class="col-form-label">Nominee Name</label>
                                            <input type="text" name="Property_name" id="Property_name"
                                                class="form-control" id="inputEmail3" placeholder="Nominee Name">
                                        </div>
                                        <div class="col-sm-4">
                                            <label for="inputEmail3" class="col-form-label">Nominee Contact</label>
                                            <input type="text" name="Property_name" id="Property_name"
                                                class="form-control" id="inputEmail3" placeholder="Nominee Contact">
                                        </div>

                                        <div class="col-sm-4">
                                            <label for="inputEmail3" class="col-form-label">Upload Contract</label>
                                            <input type="file" name="file" class="form-control">
                                        </div>

                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-info">Save changes</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            <div class="modal fade" id="modal-import">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Import</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" id="PropertyImportForm" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Import excel</label>
                                        <input type="file" name="file" class="col-sm-9 form-control">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" id="importBtn" class="btn btn-info">Import</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            <div class="modal fade" id="pendingInvestmentModal" tabindex="-1">
                <div class="modal-dialog">
                    <form id="pendingInvestmentForm">
                        @csrf
                        <input type="hidden" name="investment_id" id="investment_id">

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Submit Pending Investment</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Received Date</label>
                                    <input type="date" name="received_date" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Received Amount</label>
                                    <input type="number" name="received_amount" class="form-control" step="0.01"
                                        min="0" required>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-check-circle"></i> Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
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
        $(function() {
            table = $('#investmentsTable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 5,
                ajax: {
                    url: "{{ route('investment.list') }}",
                    data: function(d) {
                        // You can add filters here if needed
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id'
                    },
                    {
                        data: 'investor_name',
                        name: 'investor.investor_name'
                    },
                    {
                        data: 'investment_amount',
                        name: 'investment_amount'
                    },
                    {
                        data: 'investment_date',
                        name: 'investment_date'
                    },
                    {
                        data: 'profit_interval',
                        name: 'profitInterval.profit_interval_name'
                    },
                    {
                        data: 'profit_perc',
                        name: 'profit_perc'
                    },
                    {
                        data: 'maturity_date',
                        name: 'maturity_date'
                    },
                    {
                        data: 'grace_period',
                        name: 'grace_period'
                    },
                    {
                        data: 'batch_name',
                        name: 'payoutBatch.batch_name'
                    },
                    {
                        data: 'nominee_details',
                        name: 'nominee_name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],

                order: [
                    [0, 'desc']
                ],
                dom: 'Bfrtip',
                buttons: [{
                    extend: 'excelHtml5',
                    text: 'Export Excel',
                    title: 'Investments Data',
                    action: function(e, dt, node, config) {
                        let searchValue = dt.search();
                        let form = $('<form>', {
                            action: "{{ route('tanantReceivables.export') }}",
                            method: 'POST'
                        });
                        form.append($('<input>', {
                            type: 'hidden',
                            name: '_token',
                            value: '{{ csrf_token() }}'
                        }));
                        form.append($('<input>', {
                            type: 'hidden',
                            name: 'search',
                            value: searchValue
                        }));
                        form.appendTo('body').submit();
                    }
                }]
            });

        });

        $('#investmentdate').datetimepicker({
            format: 'DD-MM-YYYY'
        });

        $('#maturityDate').datetimepicker({
            format: 'DD-MM-YYYY'
        });
    </script>
    <script>
        $(document).on('click', '.openPendingModal', function() {
            let investmentId = $(this).data('id');

            $('#investment_id').val(investmentId);
            $('#pendingInvestmentModal').modal('show');
        });
        $('#pendingInvestmentForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('investment.submit.pending') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(res) {
                    $('#pendingInvestmentModal').modal('hide');
                    $('#investmentsTable').DataTable().ajax.reload(null, false);

                    Swal.fire({
                        icon: 'success',
                        title: 'Submitted!',
                        text: 'Pending investment submitted successfully',
                        timer: 2000,
                        showConfirmButton: false
                    });
                },
                error: function(err) {
                    Swal.fire('Error', 'Something went wrong', 'error');
                }
            });
        });
    </script>
@endsection
