@extends('admin.layout.admin_master')

@section('custom_css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
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
                        <h1>Contract</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active">Contract</li>
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
                                <!-- <h3 class="card-title">Contract Details</h3> -->
                                <span class="float-right">
                                    @can('contract.add')
                                        <a href="{{ route('contract.create') }}" class="btn btn-info float-right m-1">
                                            Add Contract
                                        </a>
                                    @endcan
                                    <button class="btn btn-secondary float-right m-1" data-toggle="modal"
                                        data-target="#modal-import">Import</button>
                                </span>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="contractTable" class="table table-striped projects ">
                                    <thead>
                                        <tr>
                                            <th style="width: 1%">#</th>
                                            <th>Project</th>
                                            <th>Vendor</th>
                                            <th>Tenant</th>
                                            <th>Bldng</th>
                                            <th>Start</th>
                                            <th>Exp</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>#</td>
                                            <td>PRJ00001</td>
                                            <td>Vendor</td>
                                            <td>Tenant</td>
                                            <td>Bldng</td>
                                            <td>Start</td>
                                            <td>Exp</td>
                                            <td>
                                                <span class="badge badge-warning">Pending</span>
                                            </td>
                                            <td>
                                                <!-- <a href="#" class="btn btn-success btn-sm" title="Approve"><i class="fas fa-file-signature"></i></a> -->
                                                <a class="btn btn-primary btn-sm" href="" title="view contract"><i
                                                        class="fas fa-eye"></i></a>
                                                <a class="btn btn-info  btn-sm" data-toggle="modal"
                                                    data-target="#modal-Contract" title="edit contract"><i
                                                        class="fas fa-pencil-alt"></i></a>
                                                <a class="btn btn-danger  btn-sm" onclick="deleteConf()" title="delete"><i
                                                        class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#</td>
                                            <td>PRJ00002</td>
                                            <td>Vendor</td>
                                            <td>Tenant</td>
                                            <td>Bldng</td>
                                            <td>Start</td>
                                            <td>Exp</td>
                                            <td>
                                                <span class="badge badge-success">Approved</span>
                                            </td>
                                            <td>
                                                <a href="contract_documents.php" class="btn btn-warning btn-sm"
                                                    title="documents"><i class="fas fa-file"></i></a>
                                                <!-- <a href="#" class="btn btn-danger btn-sm" title="Terminate"><i class="fas fa-user-slash"></i></a> -->
                                                <a class="btn btn-primary btn-sm" href="view_contract.php?2"
                                                    title="view contract"><i class="fas fa-eye"></i></a>
                                                <a class="btn btn-info  btn-sm" data-toggle="modal"
                                                    data-target="#modal-Contract" title="edit contract"><i
                                                        class="fas fa-pencil-alt"></i></a>
                                                <a class="btn btn-danger  btn-sm" onclick="deleteConf()" title="delete"><i
                                                        class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#</td>
                                            <td>PRJ00003</td>
                                            <td>Vendor</td>
                                            <td>Tenant</td>
                                            <td>Bldng</td>
                                            <td>Start</td>
                                            <td>Exp</td>
                                            <td>
                                                <span class="badge badge-info">Processing</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('contract.documents') }}" class="btn btn-warning btn-sm"
                                                    title="documents"><i class="fas fa-file"></i></a>
                                                <!-- <a href="#" class="btn btn-danger btn-sm" title="Terminate"><i class="fas fa-user-slash"></i></a> -->
                                                <a class="btn btn-primary btn-sm" href="view_contract.php?3"
                                                    title="view contract"><i class="fas fa-eye"></i></a>
                                                <a class="btn btn-info  btn-sm" data-toggle="modal"
                                                    data-target="#modal-Contract" title="edit contract"><i
                                                        class="fas fa-pencil-alt"></i></a>
                                                <a class="btn btn-danger  btn-sm" onclick="deleteConf()" title="delete"><i
                                                        class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>#</td>
                                            <td>PRJ00004</td>
                                            <td>Vendor</td>
                                            <td>Tenant</td>
                                            <td>Bldng</td>
                                            <td>Start</td>
                                            <td>Exp</td>
                                            <td>
                                                <span class="badge badge-danger">Terminated</span>
                                            </td>
                                            <td>
                                                <a href="contract_documents.php" class="btn btn-warning btn-sm"
                                                    title="documents"><i class="fas fa-file"></i></a>
                                                <!-- <a href="#" class="btn btn-danger btn-sm" title="Terminate"><i class="fas fa-user-slash"></i></a> -->
                                                <a class="btn btn-primary btn-sm" href="view_contract.php?4"
                                                    title="view contract"><i class="fas fa-eye"></i></a>
                                                <a class="btn btn-info  btn-sm" data-toggle="modal"
                                                    data-target="#modal-Contract" title="edit contract"><i
                                                        class="fas fa-pencil-alt"></i></a>
                                                <a class="btn btn-danger  btn-sm" onclick="deleteConf()"
                                                    title="delete"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
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




            <div class="modal fade" id="modal-import">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Import</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" id="ContractImportForm" method="POST" enctype="multipart/form-data">
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
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
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
    <script src="{{ asset('assets/bs-stepper/js/bs-stepper.min.js') }}"></script>

    <script>
        $(function() {
            let table = $('#contractTable').DataTable({
                processing: true,
                serverSide: true,

                ajax: {
                    url: "{{ route('contract.list') }}",
                    data: function(d) {
                        // d.company_id = $('#companyFilter').val();
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'contracts.id',
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: 'project_code',
                        name: 'contracts.project_code',
                    },
                    {
                        data: 'vendor',
                        name: 'vendors.name',
                    },
                    {
                        data: 'tenant',
                        name: 'contracts.tenant',
                    },
                    {
                        data: 'building',
                        name: 'contracts.building',
                    },
                    {
                        data: 'start_date',
                        name: 'contracts.start_date',
                    },
                    {
                        data: 'expiry_date',
                        name: 'contracts.expiry_date',
                    },
                    {
                        data: 'status',
                        name: 'contracts.status',
                        render: function(data, type, row) {
                            let badgeClass = '';
                            let text = '';

                            switch (data) {
                                case 0:
                                    badgeClass = 'badge badge-warning';
                                    text = 'Pending';
                                    break;
                                case 1:
                                    badgeClass = 'badge badge-success';
                                    text = 'Approved';
                                    break;
                                case 2:
                                    badgeClass = 'badge badge-info';
                                    text = 'Processing';
                                    break;
                                case 3:
                                    badgeClass = 'badge badge-danger';
                                    text = 'Terminated';
                                    break;
                            }

                            return '<span class="' + badgeClass + '">' + text + '</span>';
                        },
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
                dom: 'Bfrtip', // This is important for buttons
                buttons: [{
                    extend: 'excelHtml5',
                    text: 'Export Excel',
                    title: 'Vendor Data',
                    action: function(e, dt, node, config) {
                        // redirect to your Laravel export route
                        let searchValue = dt.search();
                        let url = "{{ route('contract.export') }}" + "?search=" +
                            encodeURIComponent(searchValue);
                        window.location.href = url;
                    }
                }]
            });
        });
    </script>
@endsection
