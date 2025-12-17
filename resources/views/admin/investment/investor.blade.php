<?php include('../layout/header.php'); ?>
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
                    <h1>Investor</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Investor</li>
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
                                    data-target="#modal-Property">Add Investor</button>
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
                                        <th>Nationality</th>
                                        <th>Country of Recidence</th>
                                        <th>Reference</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Emirates ID/ Passport No</th>
                                        <th>Payment Mode</th>
                                        <th>Bank Details</th>
                                        <!-- <th>IBAN</th> -->
                                        <th>Mobile</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td> Mr. Ahmad Atieh Abdul Mohsen Sobuh</td>
                                        <td>Jordan</td>
                                        <td>UAE</td>
                                        <td>Reference 1</td>
                                        <td>asubah@eim.ae</td>
                                        <td>Al Majaz 3, Sharjah, UAE</td>
                                        <td>784-1971-0973742-5</td>
                                        <td>Bank Transfer</td>
                                        <td>Dubai Islamic Bank</td>
                                        <!-- <td>AE860240009580614910301</td> -->
                                        <td>+97150 450 0456</td>
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
                        <h4 class="modal-title">Investor</h4>
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
                                        <label>Investor name</label>
                                        <input type="text" class="form-control" placeholder="Investor name">
                                    </div>

                                    <div class="col-sm-4">
                                        <label for="inputEmail3" class="col-form-label">Mobile</label>
                                        <input type="text" name="Property_name" id="Property_name" class="form-control"
                                            id="inputEmail3" placeholder="Mobile">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="inputEmail3" class="col-form-label">Email</label>
                                        <input type="text" class="form-control" placeholder="Email">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label>Nationality</label>
                                        <select class="form-control select2">
                                            <option value="">Select Nationality</option>
                                            <option value="1">UAE</option>
                                            <option value="2">Jordan</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-4">
                                        <label>Country of Residence</label>
                                        <select class="form-control select2">
                                            <option value="">Select Country</option>
                                            <option value="1">UAE</option>
                                            <option value="2">Jordan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="inputEmail3" class="col-form-label">Mode of Payment</label>
                                        <select class="form-control select2">
                                            <option value="">Select Payment</option>
                                            <option value="1">Bank Transfer</option>
                                            <option value="2">Cash</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="inputEmail3" class="col-form-label">Emirates ID/ Investor ID</label>
                                        <input type="text" name="Property_name" id="Property_name" class="form-control" placeholder="Emirates ID/ Investor ID">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="inputEmail3" class="col-form-label">Passport</label>
                                        <input type="text" name="Property_name" id="Property_name" class="form-control" placeholder="Passport No">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="inputEmail3" class="col-form-label">Reference</label>
                                        <input type="text" class="form-control" placeholder="Reference">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label for="inputEmail3" class="col-form-label">Benenficiary Name</label>
                                        <input type="text" name="Property_name" id="Property_name" class="form-control" placeholder="Benenficiary Name">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="inputEmail3" class="col-form-label">Bank Details</label>
                                        <input type="text" name="Property_name" id="Property_name" class="form-control" placeholder="Bank Details">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="inputEmail3" class="col-form-label">IBAN</label>
                                        <input type="text" name="Property_name" id="Property_name" class="form-control"
                                            id="inputEmail3" placeholder="IBAN">
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-sm-4">
                                        <label for="inputEmail3" class="col-form-label">Address</label>
                                        <textarea class="form-control" name="" id=""></textarea>
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="inputEmail3" class="col-form-label">Payout Batch</label>
                                        <select class="form-control select2">
                                            <option value="">Select Batch</option>
                                            <option value="1">1 - 10</option>
                                            <option value="4">11 - 20</option>
                                            <option value="6">21 - 31</option>
                                        </select>
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
            "responsive": false,
            "lengthChange": false,
            "autoWidth": false,
            "scrollX": true,
            "buttons": ["excel", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });
</script>