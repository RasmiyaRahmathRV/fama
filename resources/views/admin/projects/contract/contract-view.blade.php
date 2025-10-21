@extends('admin.layout.admin_master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Contract details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Contract details</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <!-- <div class="row">
                                                        <div class="col-12">
                                                            <h4>
                                                                <i class="fas fa-globe"></i> Fama Real Estate
                                                                <small class="float-right">Date: 2/10/2014</small>
                                                            </h4>
                                                        </div>
                                                    </div> -->
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-6">
                                    <strong>Vendor Details</strong>
                                    <address>
                                        <span class="project_id">P-11231</span></br>
                                        <span class="vendor_name">ABDULLA MOHAMMED ALMARRI</span></br>
                                        <span class="name">FAMA REAL ESTATE</span></br>
                                        <span class="mobile">056-8856995</span></br>
                                        <span class="email">ADIL@FAATEH.AE</span></br>
                                        <span class="locality">AL BARSHA</span>, <span class="building">ADIYAT BUILDING -
                                            1001</span></br>
                                        <span class="start_date">01/08/2025</span> - <span
                                            class="end_date">31/07/2026</span></br>
                                        <span class="unit_type">1BR</span> - <span class="inst_mode">4 / CHEQUE</span></br>
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6 float-right">
                                    <span class="float-right"><strong>Recievable Details</strong>
                                        <address>
                                            Rent PA - 120,000.00<br>
                                            Commission - 5,000.00<br>
                                            Refundable Deposit - 5,000.00<br>
                                            Total Receivable - 130,000.00<br>
                                            <b>Payment Due:</b> 2/22/2014
                                        </address>
                                    </span>
                                </div>
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Chq No. / Bank</th>
                                                <th>Amount</th>
                                                <th>Favouring</th>
                                                <th>Composition</th>
                                                <!-- <th>Edit</th>
                                                                        <th>Delete</th>
                                                                        <th>Bifurcate</th>
                                                                        <th>Bifurcate Edit</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr style="background-color: #dbffdb">
                                                <td>01/08/2025</td>
                                                <td>1234</td>
                                                <td>40000.00</td>
                                                <td>ABDULLA MOHAMMED ALMARRI</td>
                                                <td>RENT 1/4</td>
                                                <!-- <td><a class="btn btn-info  btn-sm" href="#" data-toggle="modal" data-target="#installment-edit"><i class="fas fa-pencil-alt"></i></a></td>
                                                                        <td><a class="btn btn-danger  btn-sm" onclick="deleteConf()"><i class="fas fa-trash"></i></a></td>
                                                                        <td><a class="btn btn-warning  btn-sm"><i class="far fa-clone"></i></a></td> -->
                                                <!-- <td></td> -->
                                            </tr>
                                            <tr style="background-color: #dbffdb">
                                                <td>01/08/2025</td>
                                                <td>1235</td>
                                                <td>40000.00</td>
                                                <td>ABDULLA MOHAMMED ALMARRI</td>
                                                <td>RENT 2/4</td>
                                                <!-- <td><a class="btn btn-info  btn-sm" href="#" data-toggle="modal" data-target="#installment-edit"><i class="fas fa-pencil-alt"></i></a></td>
                                                                        <td><a class="btn btn-danger  btn-sm" onclick="deleteConf()"><i class="fas fa-trash"></i></a></td>
                                                                        <td><a class="btn btn-warning  btn-sm"><i class="far fa-clone"></i></a></td> -->
                                                <!-- <td></td> -->
                                            </tr>
                                            <tr style="background-color: #ffd8d8">
                                                <td>01/08/2025</td>
                                                <td>1236</td>
                                                <td>40000.00</td>
                                                <td>ABDULLA MOHAMMED ALMARRI</td>
                                                <td>RENT 3/4</td>
                                                <!-- <td><a class="btn btn-info  btn-sm" href="#" data-toggle="modal" data-target="#installment-edit"><i class="fas fa-pencil-alt"></i></a></td>
                                                                        <td><a class="btn btn-danger  btn-sm" onclick="deleteConf()"><i class="fas fa-trash"></i></a></td>
                                                                        <td><a class="btn btn-warning  btn-sm"><i class="far fa-clone"></i></a></td> -->
                                                <!-- <td></td> -->
                                            </tr>
                                            <tr style="background-color: #ffd8d8">
                                                <td>01/08/2025</td>
                                                <td>1237</td>
                                                <td>40000.00</td>
                                                <td>ABDULLA MOHAMMED ALMARRI</td>
                                                <td>RENT 4/4</td>
                                                <!-- <td><a class="btn btn-info  btn-sm" href="#"><i class="fas fa-pencil-alt"></i></a></td>
                                                                        <td><a class="btn btn-danger  btn-sm" onclick="deleteConf()"><i class="fas fa-trash"></i></a></td>
                                                                        <td><a class="btn btn-warning  btn-sm"><i class="far fa-clone"></i></a></td> -->
                                                <!-- <td></td> -->
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <div class="col-6">
                                    <p class="lead text-danger"><strong>Amount Due 2/22/2014</strong></p>
                                    <div class="table-responsive">
                                        <span> <strong>Total Received:</strong>250.30</span><br>
                                        <span> <strong>Remaining:</strong>10.34</span>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                                <div class="col-12">
                                    <a href="contract.php" class="btn btn-default">Back</a>
                                    <!-- <a href="Contract details-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a> -->
                                    <?php if (isset($_GET['1'])) { ?>

                                    <button type="button" class="btn btn-success float-right"><i class="fas fa-upload"></i>
                                        Upload Contract </button>
                                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                        <i class="fas fa-envelope-open-text"></i> Generate Scope

                                        <?php } else if (isset($_GET['2'])) { ?>
                                        <button type="button" class="btn btn-success float-right"><i
                                                class="far fa-eye"></i> View Contract </button>
                                        <button type="button" class="btn btn-primary float-right"
                                            style="margin-right: 5px;">
                                            <i class="fas fa-download"></i> download Scope
                                        </button>
                                        <button type="button" class="btn btn-info float-right"
                                            style="margin-right: 5px;">
                                            <i class="fas fa-envelope-open-text"></i> Generate Acknoledgement
                                        </button>
                                        <?php } else if (isset($_GET['3'])) { ?>
                                        <!-- <button type="button" class="btn btn-danger float-right" style="margin-right: 5px;">
                                                                        <i class="fas fa-window-close"></i> Reject
                                                                    </button>

                                                                    <button type="button" class="btn btn-info float-right" style="margin-right: 5px;">
                                                                        <i class="fas fa-thumbs-up"></i> Approve
                                                                    </button> -->

                                        <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.Contract details -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->

            <div class="modal fade" id="installment-edit">
                <div class="modal-dialog modal-lg">
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
                                    <div id="payment-step" class="content" role="tabpanel"
                                        aria-labelledby="payment-step-trigger">
                                        <div class="form-group row">
                                            <div class="col md-4">
                                                <label for="exampleInputEmail1">Payment Mode</label>
                                                <select class="form-control select2" name="payment_mode"
                                                    id="payment_mode">
                                                    <option value="">Select</option>
                                                    <option value="1">Cash</option>
                                                    <option value="bank">Bank Transfer</option>
                                                    <option value="chq">Cheque</option>
                                                    <option value="cc">Credit card</option>
                                                </select>
                                            </div>
                                            <div class="col md-4">
                                                <label for="exampleInputEmail1">No. of Instalments</label>
                                                <select class="form-control select2" name="company_id" id="company_id">
                                                    <option value="">Select</option>
                                                    <option value="1">1</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="exampleInputEmail1">Interval</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Interval" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <label for="exampleInputEmail1">First Payment Date</label>
                                                <div class="input-group date" id="firstpaymntdate"
                                                    data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input"
                                                        data-target="#firstpaymntdate" placeholder="dd-mm-YYYY" />
                                                    <div class="input-group-append" data-target="#firstpaymntdate"
                                                        data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="exampleInputEmail1">Payment Amount</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Payment Amount">
                                            </div>


                                            <div class="col-md-4">
                                                <label for="exampleInputEmail1">Beneficiary</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Beneficiary">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-4 bank">
                                                <label for="exampleInputEmail1">Bank Name</label>
                                                <select class="form-control select2" name="company_id" id="company_id">
                                                    <option value="">Select bank</option>
                                                    <option value="1">1</option>
                                                </select>
                                            </div>

                                            <div class="col-md-3 chq">
                                                <label for="exampleInputEmail1">Cheque No</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Cheque No">
                                            </div>

                                            <div class="col-md-3 chq">
                                                <label for="exampleInputEmail1">Cheque Issuer</label>
                                                <select class="form-control select2" name="cheque_issuer"
                                                    id="cheque_issuer">
                                                    <option value="">Select</option>
                                                    <option value="self">Self</option>
                                                    <option value="other">Other</option>
                                                </select>
                                            </div>

                                            <div class="col-md-3 chqot">
                                                <label for="exampleInputEmail1">Cheque Issuer Name</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Cheque Issuer Name">
                                            </div>

                                            <div class="col-md-3 chqot">
                                                <label for="exampleInputEmail1">Issuer ID</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Issuer ID">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" id="submitBtn" class="btn btn-info">submit</button>
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
@endsection
