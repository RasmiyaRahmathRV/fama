<?php include('../layout/header.php'); ?>
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="../assets/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="../assets/select2/css/select2.min.css">
<link rel="stylesheet" href="../assets/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="../assets/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../assets/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="../assets/datatables-buttons/css/buttons.bootstrap4.min.css">

<?php include('../layout/sidebar.php'); ?>

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
                                <button class="btn btn-info float-right m-1" data-toggle="modal"
                                    data-target="#modal-Property">Add Investment</button>
                                <button class="btn btn-secondary float-right m-1" data-toggle="modal"
                                    data-target="#modal-import">Import</button>
                            </span>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
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
                                        <th>Nominee Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td> Mr. Ahmad Atieh Abdul Mohsen Sobuh</td>
                                        <td>150,000</td>
                                        <td>08-09-2025</td>
                                        <td>Monthly</td>
                                        <td>60%</td>
                                        <td>08-09-2026</td>
                                        <td>45 Days</td>
                                        <td>1-10</td>
                                        <td>NIL</td>
                                        <td>
                                            <button class="btn btn-info" data-toggle="modal"
                                                data-target="#modal-Property">Edit</button>
                                            <button class="btn btn-danger" onclick="deleteConf()">Delete</button>
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
                                            <input type="text" class="form-control datetimepicker-input" data-target="#investmentdate" placeholder="dd-mm-YYYY" />
                                            <div class="input-group-append" data-target="#investmentdate" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <div class="col-sm-4">
                                        <label for="inputEmail3" class="col-form-label">Investment Term (Months)</label>
                                        <select class="form-control select2">
                                            <option value="">Select Term</option>
                                            <?php for ($i = 1; $i < 15; $i++) { ?>
                                                <option value="1"><?= $i ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="inputEmail3" class="col-form-label">Profit Interval (Months)</label>
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
                                            <input type="text" class="form-control datetimepicker-input" data-target="#maturityDate" placeholder="dd-mm-YYYY" />
                                            <div class="input-group-append" data-target="#maturityDate" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="inputEmail3" class="col-form-label">Profit %</label>
                                        <input type="text" name="Property_name" id="Property_name" class="form-control"
                                            id="inputEmail3" placeholder="Profit %">
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
                                        <input type="text" name="Property_name" id="Property_name" class="form-control"
                                            id="inputEmail3" placeholder="Nominee Name">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="inputEmail3" class="col-form-label">Nominee Contact</label>
                                        <input type="text" name="Property_name" id="Property_name" class="form-control"
                                            id="inputEmail3" placeholder="Nominee Contact">
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
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include('../layout/footer.php'); ?>
<!-- Select2 -->
<script src="../assets/select2/js/select2.full.min.js"></script>
<script src="../assets/moment/moment.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../assets/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../assets/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../assets/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../assets/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../assets/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../assets/jszip/jszip.min.js"></script>
<script src="../assets/pdfmake/pdfmake.min.js"></script>
<script src="../assets/pdfmake/vfs_fonts.js"></script>
<script src="../assets/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../assets/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../assets/datatables-buttons/js/buttons.colVis.min.js"></script>


<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["excel"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });

    $('#investmentdate').datetimepicker({
        format: 'DD-MM-YYYY'
    });

    $('#maturityDate').datetimepicker({
        format: 'DD-MM-YYYY'
    });
</script>