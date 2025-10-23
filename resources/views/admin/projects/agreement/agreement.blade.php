@extends('admin.layout.admin_master')
@section('custom_css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/daterangepicker/daterangepicker.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('assets/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('assets/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatables-responsive/css/responsive.bootstrap4.min.cssss') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bs-stepper/css/bs-stepper.min.css') }}">
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Agreement</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active">Agreement</li>
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
                                <!-- <h3 class="card-title">Agreement Details</h3> -->
                                <span class="float-right">
                                    <a href="{{ route('agreement.create') }}" class="btn btn-info float-right m-1">Add
                                        Agreement</a>
                                    <button class="btn btn-secondary float-right m-1" data-toggle="modal"
                                        data-target="#modal-import">Import</button>
                                </span>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-striped projects ">
                                    <thead>
                                        <tr>
                                            <th style="width: 1%">#</th>
                                            <th>Project</th>
                                            <th>Vendor</th>
                                            <th>Tenant</th>
                                            <th>Bldng</th>
                                            <th>Start</th>
                                            <th>Exp</th>
                                            <!-- <th>Status</th> -->
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
                                            <!-- <td>
                                                                                                                                                                                    <span class="badge badge-warning">Pending</span>
                                                                                                                                                                                </td> -->
                                            <td>
                                                <a href="view_installments.php" class="btn btn-primary btn-sm"
                                                    title="View Installments"><i class="fas fa-eye"></i></a>
                                                <a href="agreement_documents.php" class="btn btn-warning btn-sm"
                                                    title="documents"><i class="fas fa-file"></i></a>
                                                <a href="view_agreement.php?1" class="btn btn-primary btn-sm"
                                                    title="Agreement"><i class="fas fa-handshake"></i></a>
                                                <a class="btn btn-info  btn-sm" data-toggle="modal"
                                                    data-target="#modal-agreement" title="Edit agreement"><i
                                                        class="fas fa-pencil-alt"></i></a>
                                                <a class="btn btn-danger  btn-sm" onclick="deleteConf()" title="delete"><i
                                                        class="fas fa-trash"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm" title="Terminate"
                                                    data-toggle="modal" data-target="#modal-terminate"><i
                                                        class="fas fa-file-signature"></i></a>
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


            <div class="modal fade" id="modal-agreement">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Contract</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="javascript:void(0)" id="ContractForm">
                            <input type="hidden" name="id" id="Contract_id">
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="bs-stepper">
                                        <div class="bs-stepper-header" role="tablist">
                                            <!-- your steps here -->
                                            <div class="step" data-target="#lead-step">
                                                <button type="button" class="step-trigger" role="tab"
                                                    aria-controls="lead-step" id="lead-step-trigger">
                                                    <span class="bs-stepper-circle"><i class="far fa-user"></i></span>
                                                    <span class="bs-stepper-label">Tenant</span>
                                                </button>
                                            </div>
                                            <div class="line"></div>
                                            <div class="step" data-target="#unit-step">
                                                <button type="button" class="step-trigger" role="tab"
                                                    aria-controls="unit-step" id="unit-step-trigger">
                                                    <span class="bs-stepper-circle"><i
                                                            class="fas fa-door-open"></i></span>
                                                    <span class="bs-stepper-label">Unit</span>
                                                </button>
                                            </div>
                                            <div class="line"></div>
                                            <div class="step" data-target="#contract-step">
                                                <button type="button" class="step-trigger" role="tab"
                                                    aria-controls="contract-step" id="contract-step-trigger">
                                                    <span class="bs-stepper-circle"><i
                                                            class="fas fa-file-contract"></i></span>
                                                    <span class="bs-stepper-label">Contract</span>
                                                </button>
                                            </div>
                                            <div class="line"></div>
                                            <div class="step" data-target="#rental-step">
                                                <button type="button" class="step-trigger" role="tab"
                                                    aria-controls="rental-step" id="rental-step-trigger">
                                                    <span class="bs-stepper-circle"><i
                                                            class="fas fa-house-user"></i></span>
                                                    <span class="bs-stepper-label">Rental</span>
                                                </button>
                                            </div>
                                            <!-- <div class="line"></div>
                                                                                                                                                                                <div class="step" data-target="#otc-step">
                                                                                                                                                                                    <button type="button" class="step-trigger" role="tab" aria-controls="otc-step" id="otc-step-trigger">
                                                                                                                                                                                        <span class="bs-stepper-circle"><i class="fas fa-file-invoice-dollar"></i></span>
                                                                                                                                                                                        <span class="bs-stepper-label">OTC</span>
                                                                                                                                                                                    </button>
                                                                                                                                                                                </div> -->
                                            <div class="line"></div>
                                            <div class="step" data-target="#payment-step">
                                                <button type="button" class="step-trigger" role="tab"
                                                    aria-controls="payment-step" id="payment-step-trigger">
                                                    <span class="bs-stepper-circle"><i
                                                            class="fas fa-dollar-sign"></i></span>
                                                    <span class="bs-stepper-label">Payment</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="bs-stepper-content card">
                                            <!-- your steps content here -->
                                            <div id="lead-step" class="content" role="tabpanel"
                                                aria-labelledby="lead-step-trigger">
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Company</label>
                                                        <select class="form-control select2" name="company_id"
                                                            id="company_id">
                                                            <option value="">Select Company</option>
                                                            <option value="1">Fama real estate</option>
                                                            <option value="1">W&B</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Agreement Type</label>
                                                        <select class="form-control select2" name="contract_type"
                                                            id="contract_type">
                                                            <option value="df">DF</option>
                                                            <option value="ff">FF</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Tenant Name</label>
                                                        <input type="text" class="form-control" id="client_name"
                                                            placeholder="Tenant Name">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <label>Contract</label>
                                                        <select class="form-control select2" name="company_id"
                                                            id="company_id">
                                                            <option value="">Select Contract</option>
                                                            <option value="1">Contract 1</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Emirates ID/Passport/Trde
                                                            license</label>
                                                        <input type="text" class="form-control" id="client_phone"
                                                            placeholder="Emirates ID/Passport/Trde license">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Tenant mobile</label>
                                                        <input type="text" class="form-control" id="client_email"
                                                            placeholder="Tenant mobile">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Tenant email</label>
                                                        <input type="text" class="form-control" id="contact_person"
                                                            placeholder="Tenant email">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Agent</label>
                                                        <select class="form-control select2" name="agent"
                                                            id="agent">
                                                            <option value="">Select Agent</option>
                                                            <option value="1">Agent 1</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Nationality</label>
                                                        <select class="form-control select2" name="agent"
                                                            id="agent">
                                                            <option value="">Select Nationality</option>
                                                            <option value="1">Nationality 1</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <label>Tenant Address</label>
                                                        <textarea name="" class="form-control" id="client_address"></textarea>
                                                    </div>
                                                </div>
                                                <button class="btn btn-info" onclick="stepper.next()">Next</button>
                                            </div>
                                            <div id="unit-step" class="content" role="tabpanel"
                                                aria-labelledby="unit-step-trigger">
                                                <div class="form-group row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label">Unit Type</label>
                                                        <select class="form-control select2" name="unit_type[]"
                                                            id="unit_type0">
                                                            <option value="">Unit Type</option>
                                                            <option value="1">1BHK</option>
                                                            <option value="2">2BHK</option>
                                                            <option value="3">3BHK</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label class="control-label">Select Unit No</label>
                                                        <select class="form-control select2" name="unit_type[]"
                                                            id="unit_type0">
                                                            <option value="">Unit No</option>
                                                            <option value="1">unit 1</option>
                                                            <option value="2">unit 2</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3 mt-23">
                                                        <div class="icheck-success d-inline">
                                                            <input type="checkbox" id="partition" class="partcheck"
                                                                value="1">
                                                            <label class="labelpermission" for="partition"> Partition
                                                            </label>
                                                        </div>
                                                        <div class="icheck-success d-inline">
                                                            <input type="checkbox" id="bedspace" class="bedcheck"
                                                                value="1">
                                                            <label class="labelpermission" for="bedspace"> Bedspace
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label class="control-label">Sub Unit</label>
                                                        <input type="number" name="unit_size[]" class="form-control"
                                                            placeholder="Sub Unit">

                                                    </div>
                                                </div>

                                                <button class="btn btn-info"
                                                    onclick="stepper.previous()">Previous</button>
                                                <button class="btn btn-info" onclick="stepper.next()">Next</button>
                                            </div>
                                            <div id="contract-step" class="content" role="tabpanel"
                                                aria-labelledby="contract-step-trigger">
                                                <div class="form-group row">
                                                    <!-- <div class="col-md-4">
                                                                                                                                                                                            <label for="exampleInputEmail1">Contract fee</label>
                                                                                                                                                                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Contract fee">
                                                                                                                                                                                        </div> -->
                                                    <div class="col-md-3">
                                                        <label for="exampleInputEmail1">Start Date</label>
                                                        <div class="input-group date" id="startdate"
                                                            data-target-input="nearest">
                                                            <input type="text"
                                                                class="form-control datetimepicker-input"
                                                                data-target="#startdate" placeholder="dd-mm-YYYY" />
                                                            <div class="input-group-append" data-target="#startdate"
                                                                data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i
                                                                        class="fa fa-calendar"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="exampleInputEmail1">Duration in Months</label>
                                                        <input type="text" class="form-control"
                                                            id="exampleInputEmail1" placeholder="Duration in Months">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="exampleInputEmail1">Duration in Days</label>
                                                        <input type="text" class="form-control"
                                                            id="exampleInputEmail1" placeholder="Duration in Days">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="exampleInputEmail1">End Date</label>
                                                        <div class="input-group date" id="enddate"
                                                            data-target-input="nearest">
                                                            <input type="text"
                                                                class="form-control datetimepicker-input"
                                                                data-target="#enddate" placeholder="dd-mm-YYYY" />
                                                            <div class="input-group-append" data-target="#enddate"
                                                                data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i
                                                                        class="fa fa-calendar"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-info"
                                                    onclick="stepper.previous()">Previous</button>
                                                <button class="btn btn-info" onclick="stepper.next()">Next</button>
                                            </div>
                                            <div id="rental-step" class="content" role="tabpanel"
                                                aria-labelledby="rental-step-trigger">
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Rent per annum</label>
                                                        <input type="text" class="form-control"
                                                            id="exampleInputEmail1" placeholder="Rent per annum">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="exampleInputEmail1">Commission %</label>
                                                        <input type="text" class="form-control"
                                                            id="exampleInputEmail1" placeholder="Commission %">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="exampleInputEmail1">Commission</label>
                                                        <input type="text" class="form-control"
                                                            id="exampleInputEmail1" placeholder="Commission" readonly>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="exampleInputEmail1">Deposit %</label>
                                                        <input type="text" class="form-control"
                                                            id="exampleInputEmail1" placeholder="Deposit %">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label for="exampleInputEmail1">Deposit</label>
                                                        <input type="text" class="form-control"
                                                            id="exampleInputEmail1" placeholder="Deposit" readonly>
                                                    </div>
                                                </div>
                                                <button class="btn btn-info"
                                                    onclick="stepper.previous()">Previous</button>
                                                <button class="btn btn-info" onclick="stepper.next()">Next</button>
                                            </div>
                                            <!-- <div id="otc-step" class="content" role="tabpanel" aria-labelledby="otc-step-trigger">
                                                                                                                                                                                    <div class="form-group row">
                                                                                                                                                                                        <div class="col-md-3">
                                                                                                                                                                                            <label for="exampleInputEmail1">Cost of Development</label>
                                                                                                                                                                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Cost of Development">
                                                                                                                                                                                        </div>
                                                                                                                                                                                        <div class="col-md-3">
                                                                                                                                                                                            <label for="exampleInputEmail1">Cost of Beds</label>
                                                                                                                                                                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Cost of Beds">
                                                                                                                                                                                        </div>
                                                                                                                                                                                        <div class="col-md-3">
                                                                                                                                                                                            <label for="exampleInputEmail1">Cost of Mattress</label>
                                                                                                                                                                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Cost of Mattress">
                                                                                                                                                                                        </div>
                                                                                                                                                                                        <div class="col-md-3">
                                                                                                                                                                                            <label for="exampleInputEmail1">Appliances</label>
                                                                                                                                                                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Appliances">
                                                                                                                                                                                        </div>
                                                                                                                                                                                    </div>
                                                                                                                                                                                    <div class="form-group row">
                                                                                                                                                                                        <div class="col-md-2">
                                                                                                                                                                                            <label for="exampleInputEmail1">Decoration</label>
                                                                                                                                                                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Decoration">
                                                                                                                                                                                        </div>
                                                                                                                                                                                        <div class="col-md-2">
                                                                                                                                                                                            <label for="exampleInputEmail1">Dewa Deposit</label>
                                                                                                                                                                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Dewa Deposit">
                                                                                                                                                                                        </div>
                                                                                                                                                                                        <div class="col-md-2">
                                                                                                                                                                                            <label for="exampleInputEmail1">Ejari</label>
                                                                                                                                                                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Ejari">
                                                                                                                                                                                        </div>
                                                                                                                                                                                    </div>
                                                                                                                                                                                    <button class="btn btn-info" onclick="stepper.previous()">Previous</button>
                                                                                                                                                                                    <button class="btn btn-info" onclick="stepper.next()">Next</button>
                                                                                                                                                                                </div> -->
                                            <div id="payment-step" class="content" role="tabpanel"
                                                aria-labelledby="payment-step-trigger">
                                                <div class="form-group row">
                                                    <div class="col-md-4">
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
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">No. of Instalments</label>
                                                        <select class="form-control select2" name="company_id"
                                                            id="company_id">
                                                            <option value="">Select</option>
                                                            <option value="1">1</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Interval</label>
                                                        <input type="text" class="form-control"
                                                            id="exampleInputEmail1" placeholder="Interval" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">First Payment Date</label>
                                                        <div class="input-group date" id="firstpaymntdate"
                                                            data-target-input="nearest">
                                                            <input type="text"
                                                                class="form-control datetimepicker-input"
                                                                data-target="#firstpaymntdate" placeholder="dd-mm-YYYY" />
                                                            <div class="input-group-append" data-target="#firstpaymntdate"
                                                                data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i
                                                                        class="fa fa-calendar"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Payment Amount</label>
                                                        <input type="text" class="form-control"
                                                            id="exampleInputEmail1" placeholder="Payment Amount">
                                                    </div>


                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Beneficiary</label>
                                                        <input type="text" class="form-control"
                                                            id="exampleInputEmail1" placeholder="Beneficiary">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-4 bank">
                                                        <label for="exampleInputEmail1">Bank Name</label>
                                                        <select class="form-control select2" name="company_id"
                                                            id="company_id">
                                                            <option value="">Select bank</option>
                                                            <option value="1">1</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-3 chq">
                                                        <label for="exampleInputEmail1">Cheque No</label>
                                                        <input type="text" class="form-control"
                                                            id="exampleInputEmail1" placeholder="Cheque No">
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
                                                        <input type="text" class="form-control"
                                                            id="exampleInputEmail1" placeholder="Cheque Issuer Name">
                                                    </div>

                                                    <div class="col-md-3 chqot">
                                                        <label for="exampleInputEmail1">Issuer ID</label>
                                                        <input type="text" class="form-control"
                                                            id="exampleInputEmail1" placeholder="Issuer ID">
                                                    </div>
                                                </div>
                                                <button class="btn btn-info"
                                                    onclick="stepper.previous()">Previous</button>
                                                <button type="submit" class="btn btn-info">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="modal-footer justify-content-between">
                                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                                                                                                    <button type="submit" class="btn btn-info">Save changes</button> -->
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


            <div class="modal fade" id="modal-terminate">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Terminate Agreement</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" id="PropertyForm">
                            <input type="hidden" name="id" id="Property_id">
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="exampleInputEmail1">Date</label>
                                        <div class="input-group date" id="terminationdate" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input"
                                                data-target="#terminationdate" placeholder="dd-mm-YYYY" />
                                            <div class="input-group-append" data-target="#terminationdate"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-form-label">Reason</label>
                                        <textarea name="" id="" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
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
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('custom_js')
    <!-- Select2 -->

    <script src="{{ asset('assets/select2/js/select2.full.min.js') }}"></script>

    <script src="{{ asset('assets/moment/moment.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->

    <script src="{{ asset('assets/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- date-range-picker -->

    <script src="{{ asset('assets/daterangepicker/daterangepicker.js') }}"></script>
    <!-- DataTables  & Plugins -->

    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-responsive/js/dataTables.responsive.min.jss') }}"></script>
    <script src="{{ asset('assets/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- BS-Stepper -->

    <script src="{{ asset('assets/bs-stepper/js/bs-stepper.min.js') }}"></script>

    <script>
        $('#startdate').datetimepicker({
            format: 'DD-MM-YYYY'
        });

        $('#enddate').datetimepicker({
            format: 'DD-MM-YYYY'
        });

        $('#terminationdate').datetimepicker({
            format: 'DD-MM-YYYY'
        });

        // BS-Stepper Init
        document.addEventListener('DOMContentLoaded', function() {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })

        $(document).ready(function() {
            $('.bank').hide();
            $('.chq').hide();
            $('.chqot').hide();
            $('.part0').hide();
            $('.bs0').hide();
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

        $('#cheque_issuer').change(function() {
            var cheque_issuer = $(this).val();
            if (cheque_issuer == 'other') {
                $('.chqot').show();
            } else {
                $('.chqot').hide();
            }
        });
    </script>
@endsection
