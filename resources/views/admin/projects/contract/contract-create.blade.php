@extends('admin.layout.admin_master')

@section('custom_css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/daterangepicker/daterangepicker.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('assets/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->

    <link rel="stylesheet" href="{{ asset('assets/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bs-stepper/css/bs-stepper.min.css') }}">
    <style>
        .enddate {
            background-color: #e9ecef;
        }
    </style>
@endsection

@section('content')
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
                                    <button class="btn btn-info float-right m-1" data-toggle="modal"
                                        data-target="#modal-Contract">Add Contract</button>
                                    <button class="btn btn-secondary float-right m-1" data-toggle="modal"
                                        data-target="#modal-import">Import</button>
                                </span>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="bs-stepper">
                                    <div class="bs-stepper-header" role="tablist">
                                        <!-- your steps here -->
                                        <div class="step" data-target="#lead-step">
                                            <button type="button" class="step-trigger" role="tab"
                                                aria-controls="lead-step" id="lead-step-trigger">
                                                <span class="bs-stepper-circle"><i class="far fa-user"></i></span>
                                                <span class="bs-stepper-label">Lead</span>
                                            </button>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step" data-target="#property-step">
                                            <button type="button" class="step-trigger" role="tab"
                                                aria-controls="property-step" id="property-step-trigger">
                                                <span class="bs-stepper-circle"><i class="far fa-building"></i></span>
                                                <span class="bs-stepper-label">Property</span>
                                            </button>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step" data-target="#unit-step">
                                            <button type="button" class="step-trigger" role="tab"
                                                aria-controls="unit-step" id="unit-step-trigger">
                                                <span class="bs-stepper-circle"><i class="fas fa-door-open"></i></span>
                                                <span class="bs-stepper-label">Unit</span>
                                            </button>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step" data-target="#contract-step">
                                            <button type="button" class="step-trigger" role="tab"
                                                aria-controls="contract-step" id="contract-step-trigger">
                                                <span class="bs-stepper-circle"><i class="fas fa-file-contract"></i></span>
                                                <span class="bs-stepper-label">Contract</span>
                                            </button>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step" data-target="#rental-step">
                                            <button type="button" class="step-trigger" role="tab"
                                                aria-controls="rental-step" id="rental-step-trigger">
                                                <span class="bs-stepper-circle"><i class="fas fa-house-user"></i></span>
                                                <span class="bs-stepper-label">Rental Payment</span>
                                            </button>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step" data-target="#otc-step">
                                            <button type="button" class="step-trigger" role="tab"
                                                aria-controls="otc-step" id="otc-step-trigger">
                                                <span class="bs-stepper-circle"><i
                                                        class="fas fa-file-invoice-dollar"></i></span>
                                                <span class="bs-stepper-label">OTC</span>
                                            </button>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step" data-target="#payment-step">
                                            <button type="button" class="step-trigger" role="tab"
                                                aria-controls="payment-step" id="payment-step-trigger">
                                                <span class="bs-stepper-circle"><i class="fas fa-dollar-sign"></i></span>
                                                <span class="bs-stepper-label">Payment</span>
                                            </button>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step" data-target="#rentalreceivable-step">
                                            <button type="button" class="step-trigger" role="tab"
                                                aria-controls="rentalreceivable-step" id="rentalreceivable-step-trigger">
                                                <span class="bs-stepper-circle"><i class="fas fa-dollar-sign"></i></span>
                                                <span class="bs-stepper-label">Rental Receivable</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="bs-stepper-content card">
                                        <!-- your steps content here -->
                                        <div id="lead-step" class="content" role="tabpanel"
                                            aria-labelledby="lead-step-trigger">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <label for="exampleInputEmail1">Project No</label>
                                                    <input type="text" class="form-control" value=""
                                                        id="project_no" placeholder="Project No">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="exampleInputEmail1">Company</label>
                                                    <div class="input-group ">
                                                        <select class="form-control select2" name="company_id"
                                                            id="vc_company_id">
                                                            <option value="">Select Company</option>
                                                            @foreach ($companies as $company)
                                                                <option value="{{ $company->id }}">
                                                                    {{ $company->company_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <span class="input-group-append">
                                                            <button type="button" class="btn btn-info btn-flat"
                                                                data-toggle="modal" data-target="#modal-company"><i
                                                                    class="fa fa-plus"></i></button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Vendor</label>
                                                    <div class="input-group">
                                                        <select class="form-control select2" name="vendor_id"
                                                            id="vc_vendor_id">

                                                        </select>
                                                        <span class="input-group-append">
                                                            <button type="button" class="btn btn-info btn-flat"
                                                                id="addVendorButton"><i class="fa fa-plus"></i></button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <label for="exampleInputEmail1">Contract Type</label>
                                                    <select class="form-control select2" name="contract_type"
                                                        id="contract_type">
                                                        <option value="df">DF</option>
                                                        <option value="ff">FF</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="exampleInputEmail1">Contact Person</label>
                                                    <input type="text" class="form-control" value="Adil"
                                                        id="contact_person" placeholder="Contact Person">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="exampleInputEmail1">Contact No</label>
                                                    <input type="text" class="form-control" value="+971 50 123 4567"
                                                        id="contact_no" placeholder="Contact No">
                                                </div>
                                                <!-- <div class="col-md-4">
                                                                                                                            <label for="exampleInputEmail1">Agent</label>
                                                                                                                            <select class="form-control select2" name="agent" id="agent">
                                                                                                                                <option value="">Select Agent</option>
                                                                                                                                <option value="1">Agent 1</option>
                                                                                                                            </select>
                                                                                                                        </div> -->

                                            </div>
                                            <button class="btn btn-info" onclick="stepper.next()">Next</button>
                                        </div>
                                        <div id="property-step" class="content" role="tabpanel"
                                            aria-labelledby="property-step-trigger">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <label for="exampleInputEmail1">Area</label>
                                                    {{-- <select class="form-control select2" name="area_id" id="vc_area_id">
                                                    </select> --}}

                                                    <div class="input-group">
                                                        <select class="form-control select2" name="area_id"
                                                            id="vc_area_id">

                                                        </select>
                                                        <span class="input-group-append">
                                                            <button type="button" class="btn btn-info btn-flat"
                                                                id="addAreaButton"><i class="fa fa-plus"></i></button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="exampleInputEmail1">Locality</label>
                                                    {{-- <select class="form-control select2" name="vc_locality_id"
                                                        id="vc_locality_id">

                                                    </select> --}}
                                                    <div class="input-group">
                                                        <select class="form-control select2" name="locality_id"
                                                            id="vc_locality_id">

                                                        </select>
                                                        <span class="input-group-append">
                                                            <button type="button" class="btn btn-info btn-flat"
                                                                id="addVendorButton"><i class="fa fa-plus"></i></button>
                                                        </span>
                                                    </div>

                                                </div>
                                                <div class="col-md-4">
                                                    <label for="exampleInputEmail1">Property</label>
                                                    <select class="form-control select2" name="property_id"
                                                        id="property_id">

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <label for="exampleInputEmail1">No. of Units</label>
                                                    <input type="text" class="form-control" id="no_of_units"
                                                        placeholder="No. of Units">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="exampleInputEmail1">Property type</label>
                                                    <select class="form-control select2" name="property_type"
                                                        id="vc_property_type_id">

                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="exampleInputEmail1">Grace period (in months)</label>
                                                    <input type="number" class="form-control" id="exampleInputEmail1"
                                                        placeholder="Grace period" value="1">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <label for="exampleInputEmail1">Closing Date</label>
                                                    <div class="input-group date" id="closingdate"
                                                        data-target-input="nearest">
                                                        <input type="text" class="form-control datetimepicker-input"
                                                            data-target="#closingdate" placeholder="dd-mm-YYYY" />
                                                        <div class="input-group-append" data-target="#closingdate"
                                                            data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <button class="btn btn-info" onclick="stepper.previous()">Previous</button>
                                            <button class="btn btn-info" onclick="stepper.next()">Next</button>
                                        </div>
                                        <div id="unit-step" class="content" role="tabpanel"
                                            aria-labelledby="unit-step-trigger">
                                            <div class="form-group">
                                                <div class="col-md-4 mt-4">
                                                    <div class="icheck-success d-inline">
                                                        <input type="checkbox" id="fullBuilding" class="fullBuildCheck"
                                                            value="1">
                                                        <label class="labelpermission" for="fullBuilding"> Full Building
                                                        </label>
                                                    </div>

                                                    <div class="icheck-success d-inline">
                                                        <input type="checkbox" id="btob" class="btobcheck"
                                                            value="1">
                                                        <label class="labelpermission" for="btob"> B2B </label>
                                                    </div>

                                                    <div class="icheck-success d-inline">
                                                        <input type="checkbox" id="btoc" class="btoccheck"
                                                            value="1">
                                                        <label class="labelpermission" for="btoc"> B2C </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="normalBuilding">
                                                <div id="append-div">

                                                </div>

                                                <!-- <div class="form-group">
                                                                                                                            <div class="col-sm-6">
                                                                                                                                <button type="button" class=" btn btn-success" title="Add more" id="add-more"> Add more <i class="fa fa-plus"></i></button>
                                                                                                                            </div>
                                                                                                                        </div> -->
                                            </div>
                                            <div class="fullBuilding">
                                                <div id="append-div-fullb">

                                                </div>
                                                <!-- <div class="form-group">
                                                                                                                            <div class="col-sm-6">
                                                                                                                                <button type="button" class=" btn btn-success" title="Add more" id="add-more-fullBuilding"> Add more <i class="fa fa-plus"></i></button>
                                                                                                                            </div>
                                                                                                                        </div> -->
                                            </div>

                                            <button class="btn btn-info" onclick="stepper.previous()">Previous</button>
                                            <button class="btn btn-info" onclick="stepper.next()">Next</button>
                                        </div>
                                        <div id="contract-step" class="content" role="tabpanel"
                                            aria-labelledby="contract-step-trigger">
                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <label for="exampleInputEmail1">Contract fee</label>
                                                    <input type="text" class="form-control" id="contract_fee"
                                                        placeholder="Contract fee">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="exampleInputEmail1">Start Date</label>
                                                    <div class="input-group date" id="startdate"
                                                        data-target-input="nearest">
                                                        <input type="text"
                                                            class="form-control datetimepicker-input startdate"
                                                            data-target="#startdate" placeholder="dd-mm-YYYY" />
                                                        <div class="input-group-append" data-target="#startdate"
                                                            data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="exampleInputEmail1">Duration in Months</label>
                                                    <input type="number" class="form-control" id="duration_months"
                                                        placeholder="Duration in Months" value="13">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="exampleInputEmail1">Duration in Days</label>
                                                    <input type="number" class="form-control" id="duration_days"
                                                        placeholder="Duration in Days" value="0">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="exampleInputEmail1">End Date</label>
                                                    <div class="input-group date" id="enddate"
                                                        data-target-input="nearest">
                                                        <input type="text"
                                                            class="form-control datetimepicker-input enddate"
                                                            placeholder="dd-mm-YYYY" readonly onfocus="this.blur()" />
                                                        <div class="input-group-append" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-info" onclick="stepper.previous()">Previous</button>
                                            <button class="btn btn-info" onclick="stepper.next()">Next</button>
                                        </div>
                                        <div id="rental-step" class="content" role="tabpanel"
                                            aria-labelledby="rental-step-trigger">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <label for="exampleInputEmail1">Rent per annum</label>
                                                    <input type="number" class="form-control" id="rent_per_annum"
                                                        placeholder="Rent per annum" value="">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="exampleInputEmail1">Commission %</label>
                                                    <input type="number" class="form-control" id="commission_perc"
                                                        placeholder="Commission %" value="5">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="exampleInputEmail1">Commission</label>
                                                    <input type="number" class="form-control" id="commission"
                                                        placeholder="Commission">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="exampleInputEmail1">Deposit %</label>
                                                    <input type="number" class="form-control" id="deposit_perc"
                                                        placeholder="Deposit %" value="5">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="exampleInputEmail1">Deposit</label>
                                                    <input type="number" class="form-control" id="deposit"
                                                        placeholder="Deposit">
                                                </div>
                                            </div>
                                            <button class="btn btn-info" onclick="stepper.previous()">Previous</button>
                                            <button class="btn btn-info" onclick="stepper.next()">Next</button>
                                        </div>
                                        <div id="otc-step" class="content" role="tabpanel"
                                            aria-labelledby="otc-step-trigger">
                                            <div class="form-group row">
                                                <div class="col-md-3">
                                                    <label for="exampleInputEmail1">Cost of Development</label>
                                                    <input type="text" class="form-control" id="cost_of_development"
                                                        placeholder="Cost of Development">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="exampleInputEmail1">Cost of Beds</label>
                                                    <input type="text" class="form-control" id="cost_of_beds"
                                                        placeholder="Cost of Beds">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="exampleInputEmail1">Cost of Mattress</label>
                                                    <input type="text" class="form-control" id="cost_of_mattress"
                                                        placeholder="Cost of Mattress">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="exampleInputEmail1">Appliances</label>
                                                    <input type="text" class="form-control" id="appliances"
                                                        placeholder="Appliances">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-3">
                                                    <label for="exampleInputEmail1">Decoration</label>
                                                    <input type="text" class="form-control" id="decoration"
                                                        placeholder="Decoration">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="exampleInputEmail1">Dewa Deposit</label>
                                                    <input type="text" class="form-control" id="dewa_deposit"
                                                        placeholder="Dewa Deposit">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="exampleInputEmail1">Ejari</label>
                                                    <input type="text" class="form-control" id="ejari"
                                                        placeholder="Ejari">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="exampleInputEmail1">Cost of Cabinets</label>
                                                    <input type="text" class="form-control" id="cost_of_cabinets"
                                                        placeholder="Cost of Cabinets">
                                                </div>
                                            </div>
                                            <button class="btn btn-info" onclick="stepper.previous()">Previous</button>
                                            <button class="btn btn-info" onclick="stepper.next()">Next</button>
                                        </div>
                                        <div id="payment-step" class="content" role="tabpanel"
                                            aria-labelledby="payment-step-trigger">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <label for="exampleInputEmail1">No. of Installments</label>
                                                    <select class="form-control select2" name="no_of_installments"
                                                        id="no_of_installments">
                                                        <option value="">Select</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="exampleInputEmail1">Interval</label>
                                                    <input type="text" class="form-control" id="interval"
                                                        placeholder="Interval" readonly>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="exampleInputEmail1">Beneficiary</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                                        placeholder="Beneficiary">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="payment_details">
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Payment Mode</label>
                                                        <select class="form-control select2" name="payment_mode[]"
                                                            id="payment_mode0">
                                                            <option value="">Select</option>
                                                            <option value="1">Cash</option>
                                                            <option value="bank">Bank Transfer</option>
                                                            <option value="chq">Cheque</option>
                                                            <option value="cc">Credit card</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Payment Date</label>
                                                        <div class="input-group date" id="firstpaymntdate"
                                                            data-target-input="nearest">
                                                            <input type="text"
                                                                class="form-control datetimepicker-input"
                                                                name="payment_date[]" data-target="#firstpaymntdate"
                                                                placeholder="dd-mm-YYYY" />
                                                            <div class="input-group-append" data-target="#firstpaymntdate"
                                                                data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i
                                                                        class="fa fa-calendar"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Payment Amount</label>
                                                        <input type="text" class="form-control" id="payment_amount0"
                                                            name="payment_amount[]" placeholder="Payment Amount">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-4 bank" id="bank0">
                                                        <label for="exampleInputEmail1">Bank Name</label>
                                                        <select class="form-control select2" name="bank_name[]"
                                                            id="bank_name0">
                                                            <option value="">Select bank</option>
                                                            <option value="1">1</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-3 chq" id="chq0">
                                                        <label for="exampleInputEmail1">Cheque No</label>
                                                        <input type="text" class="form-control" id="cheque_no0"
                                                            name="cheque_no[]" placeholder="Cheque No">
                                                    </div>

                                                    <div class="col-md-3 chq" id="chqiss0">
                                                        <label for="exampleInputEmail1">Cheque Issuer</label>
                                                        <select class="form-control select2" name="cheque_issuer[]"
                                                            id="cheque_issuer0">
                                                            <option value="">Select</option>
                                                            <option value="self">Self</option>
                                                            <option value="other">Other</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-3 chqot" id="chqotiss0">
                                                        <label for="exampleInputEmail1">Cheque Issuer Name</label>
                                                        <input type="text" class="form-control"
                                                            id="cheque_issuer_name0" name="cheque_issuer_name[]"
                                                            placeholder="Cheque Issuer Name">
                                                    </div>

                                                    <div class="col-md-3 chqot" id="chqot0">
                                                        <label for="exampleInputEmail1">Issuer ID</label>
                                                        <input type="text" class="form-control" id="issuer_id0"
                                                            name="issuer_id[]" placeholder="Issuer ID">
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                            <hr>
                                            <button class="btn btn-info" onclick="stepper.previous()">Previous</button>
                                            <button class="btn btn-info" onclick="stepper.next()">Next</button>
                                        </div>
                                        <div id="rentalreceivable-step" class="content" role="tabpanel"
                                            aria-labelledby="rentalreceivable-step-trigger">
                                            <div class=" p-3 mb-3">
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
                                                    <div class="col-sm-6 float-left">
                                                        <strong>Payable Details</strong>
                                                        <address>
                                                            Total Contract Amt - <span
                                                                class="total_contract_amount">0.00</span><br>
                                                            Commission - <span class="commssion_final">0.00</span><br>
                                                            Refundable Deposit - <span
                                                                class="deposit_final">0.00</span><br>
                                                            Contract Fee - <span class="contract_final">500</span><br>
                                                            Total Payment to Vendor - <span
                                                                class="payment_to_vendor">0.00</span><br>
                                                            Total OTC - <span class="total_otc_payable">0.00</span><br>
                                                            Final Cost - <span class="final_cost">0.00</span><br>
                                                            Initial Investment - <span class="initial_inv">0.00</span><br>
                                                        </address>
                                                    </div>

                                                    <div class="col-sm-6 float-right">
                                                        <span class="float-right"><strong>Receivable Details</strong>
                                                            <address>
                                                                Expected Rental PM - <span
                                                                    class="total_rent_receivable">0.00</span> <br>
                                                                No. Of Months - <span class="no_of_months_final">0</span>
                                                                <br>
                                                                Total Rental - <span class="total_rental">0.00</span> <br>
                                                            </address>
                                                            <!-- <address>
                                                                                                                                        <span class="project_id">P-11231</span></br>
                                                                                                                                    </address> -->
                                                        </span>
                                                    </div>
                                                    <!-- /.col -->

                                                </div>
                                            </div>
                                            <!-- /.row -->
                                            <div class="form-group row">
                                                <div class="col-md-3 rentPartition">
                                                    <label for="exampleInputEmail1">Rent per Partition</label>
                                                    <input type="text" class="form-control" id="rent_per_part"
                                                        placeholder="Rent per Partition">
                                                </div>
                                                <div class="col-md-3 rentBedspace">
                                                    <label for="exampleInputEmail1">Rent per Bedspace</label>
                                                    <input type="text" class="form-control" id="rent_per_bs"
                                                        placeholder="Rent per Bedspace">
                                                </div>
                                                <div class="col-md-3 rentRoom">
                                                    <label for="exampleInputEmail1">Rent per Room</label>
                                                    <input type="text" class="form-control" id="rent_per_room"
                                                        placeholder="Rent per Room">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="exampleInputEmail1">Receivable Start Date</label>
                                                    <div class="input-group date" id="receivable_start_date"
                                                        data-target-input="nearest">
                                                        <input type="text"
                                                            class="form-control datetimepicker-input receivable_start_date"
                                                            data-target="#receivable_start_date"
                                                            placeholder="dd-mm-YYYY" />
                                                        <div class="input-group-append"
                                                            data-target="#receivable_start_date"
                                                            data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-3">
                                                    <label for="exampleInputEmail1">ROI%</label>
                                                    <input type="text" class="form-control" id="roi"
                                                        placeholder="ROI" readonly>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="exampleInputEmail1">Expected Profit</label>
                                                    <input type="text" class="form-control" id="expected_profit"
                                                        placeholder="Expected Profit" readonly>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="exampleInputEmail1">Profit%</label>
                                                    <input type="text" class="form-control" id="profit"
                                                        placeholder="Profit" readonly>
                                                </div>
                                                <!-- <div class="col-md-3">
                                                                                                                            <label for="exampleInputEmail1">Rent per Room</label>
                                                                                                                            <input type="text" class="form-control" id="rent_per_room" placeholder="Rent per Room">
                                                                                                                        </div> -->
                                            </div>

                                            <button class="btn btn-info" onclick="stepper.previous()">Previous</button>
                                            <button type="submit" class="btn btn-info">Submit</button>
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
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('custom_js')
    <script src="{{ asset('assets/moment/moment.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('assets/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('assets/daterangepicker/daterangepicker.js') }}"></script>
    <!-- BS-Stepper -->
    <script src="{{ asset('assets/bs-stepper/js/bs-stepper.min.js') }}"></script>


    <script>
        $('#closingdate').datetimepicker({
            format: 'DD-MM-YYYY'
        });

        $('#startdate').datetimepicker({
            format: 'DD-MM-YYYY'
        });

        $('#enddate').datetimepicker({
            format: 'DD-MM-YYYY'
        });

        $('#firstpaymntdate').datetimepicker({
            format: 'DD-MM-YYYY'
        });

        $('#receivable_start_date').datetimepicker({
            format: 'DD-MM-YYYY'
        });

        // BS-Stepper Init
        document.addEventListener('DOMContentLoaded', function() {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })
    </script>

    <!-- unit addmore  -->
    <script>
        $(document).ready(function() {
            const container = document.getElementById('append-div');
            const addMoreBtn = document.getElementById('add-more');

            $('.fullBuilding').hide();

            const containerFb = document.getElementById('append-div-fullb');
            const addMoreBtnFb = document.getElementById('add-more-fullBuilding');


            // Function to attach events for toggle + remove
            function attachEvents(block, i) {
                $(function() {
                    const map = {
                        ['#partition' + i]: '#part' + i,
                        ['#bedspace' + i]: '#bs' + i
                    };

                    partAndBsChange(map);
                });

                // Remove button
                const removeBtn = block.querySelector('.dlt-div');
                if (removeBtn) {
                    removeBtn.addEventListener('click', () => {
                        block.remove();
                    });
                }
            }


            $(document).on('input', '#no_of_units', totalUnitValue);


            function totalUnitValue() {
                const unitCount = $('#no_of_units').val();
                const prevBlocks = container.querySelectorAll('.apdi');
                prevBlocks.forEach(block => block.remove());

                const prevFbBlocks = containerFb.querySelectorAll('.add-more-fullBuilding');
                prevFbBlocks.forEach(block => block.remove());

                for (let i = 0; i < unitCount; i++) {
                    unitAddmore(i);
                    fullAddMore(i);
                }
            }

            // Add new block dynamically
            // var i = 0;
            // addMoreBtn.addEventListener('click', () => {

            // });


            // unit add more for normal
            function unitAddmore(i) {
                const newBlock = document.createElement('div');
                newBlock.classList.add('apdi');
                newBlock.innerHTML = '<div class="form-group row">' +
                    '<div class="col-sm-2 add-morecol2"><label class="control-label"> Unit No </label>' +
                    '<input type="text" name="l_name[]" class="form-control unit_no" placeholder="Unit No"></div>' +
                    '<div class="col-sm-2 add-morecol2"><label class="control-label"> Unit Type </label>' +
                    '<select class="form-control select2 unit_type" name="unit_type[]" id="unit_type' + i + '">' +
                    '<option value="">Select</option>' +
                    '<option value="1">1BHK</option>' +
                    '<option value="2">2BHK</option>' +
                    '<option value="3">3BHK</option>' +
                    '</select></div>' +
                    '<div class="col-sm-1 add-morecol2">' +
                    '<label class="control-label"> Floor No </label>' +
                    '<input type="text" name="l_name[]" class="form-control" placeholder="Floor No">' +
                    '</div>' +
                    '<div class="col-sm-2 add-morecol2">' +
                    '<label class="control-label"> Unit Status </label>' +
                    '<select class="form-control select2" name="unit_status[]" id="unit_status' + i + '">' +
                    '<option value="">Unit Status</option>' +
                    '<option value="1">Company 1</option>' +
                    '</select>' +
                    '</div>' +
                    '<div class="col-sm-2 add-morecol2">' +
                    '<label class="control-label"> Unit Rent Per Annum </label>' +
                    '<input type="number" name="unit_rent_per_annum[]" class="form-control unit_rent_per_annum" placeholder="Unit Rent Per Annum">' +
                    '</div>' +
                    '<div class="col-sm-3 add-morecol2">' +
                    '<label class="control-label">Unit Size</label>' +
                    '<div class="input-group input-group">' +
                    '<div class="input-group-prepend select2">' +
                    '<select name="" id="">' +
                    '<option value="">Sq.ft</option>' +
                    '<option value="">Sq.m</option>' +
                    '</select>' +
                    '</div>' +
                    '<input type="number" name="unit_size[]" class="form-control" placeholder="Unit Size">' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="form-group row">' +
                    '<div class="col-sm-3">' +
                    '<div class="icheck-success d-inline">' +
                    '<input type="checkbox" id="partition' + i + '" class="partcheck" value="1">' +
                    '<label class="labelpermission" for="partition' + i + '"> Partition </label>' +
                    '</div>' +
                    '<div class="icheck-success d-inline">' +
                    '<input type="checkbox" id="bedspace' + i + '" class="bedcheck" value="1">' +
                    '<label class="labelpermission" for="bedspace' + i + '"> Bedspace </label>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-sm-2 part" id="part' + i + '">' +
                    '<label class="control-label">Total Partitions</label>' +
                    '<input type="text" name="total_partition[]" class="form-control total_partitions" placeholder="Total Partitions">' +
                    '</div>' +
                    '<div class="col-sm-2 bs" id="bs' + i + '">' +
                    '<label class="control-label">Total Bed Spaces</label>' +
                    '<input type="text" name="total_bedspace[]" class="form-control total_bedspaces" placeholder="Total Bed Spaces">' +
                    '</div>' +
                    // '<div class="col-sm-2 subrnt">' +
                    // '<label class="control-label">Rent per P/BS</label>' +
                    // '<input type="text" name="rent_per_subunit[]" class="form-control" placeholder="Rent per subunit">' +
                    // '</div>' +
                    '</div>' +
                    // '<div class="col-sm-1">' +
                    // '<button type="button" class=" btn-danger btn-block dlt-div btndetd pdd" title="Delete" data-toggle="tooltip">' +
                    // '<i class="fa fa-trash fa-1x"></i></button>' +
                    // '</div>'+
                    '<hr></div>';
                container.appendChild(newBlock);
                attachEvents(newBlock, i);
            }


            function fullAddMore(i) {
                const newBlock = document.createElement('div');
                newBlock.classList.add('add-more-fullBuilding');
                newBlock.innerHTML = '<div class="form-group row">' +
                    '<div class="col-sm-2">' +
                    '<label class="control-label">Unit Type</label>' +
                    '<select class="form-control select2 unit_type" name="unit_type[]" id="unit_type' + i + '">' +
                    '<option value="">Unit Type</option>' +
                    '<option value="1">1BHK</option>' +
                    '<option value="2">2BHK</option>' +
                    '<option value="3">3BHK</option>' +
                    '</select>' +
                    '</div>' +
                    '<div class="col-sm-2">' +
                    '<label class="control-label">Unit Count</label>' +
                    '<input type="text" name="unit_count[]" class="form-control unit_count" placeholder="Unit Count">' +
                    '</div>' +
                    '<div class="col-sm-2">' +
                    '<div class="icheck-success d-inline">' +
                    '<input type="checkbox" id="partition_fb' + i + '" class="partcheck_fb" value="1">' +
                    '<label class="labelpermission" for="partition_fb' + i + '"> Partition </label>' +
                    '</div>' +
                    '<div class="icheck-success d-inline">' +
                    '<input type="checkbox" id="bedspace_fb' + i + '" class="bedcheck_fb" value="1">' +
                    '<label class="labelpermission" for="bedspace_fb' + i + '"> Bedspace </label>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-sm-2 part_fb" id="part_fb' + i + '">' +
                    '<label class="control-label">Total Partitions</label>' +
                    '<input type="text" name="total_partition[]" class="form-control total_partitions_fb" placeholder="Total Partitions">' +
                    '</div>' +
                    '<div class="col-sm-2 bs_fb" id="bs_fb' + i + '">' +
                    '<label class="control-label">Total Bed Spaces</label>' +
                    '<input type="text" name="total_bedspace[]" class="form-control total_bedspaces_fb" placeholder="Total Bed Spaces">' +
                    '</div>' +
                    // '<div class="col-sm-1">' +
                    // '<button type="button" class=" btn-danger btn-block dlt-div-fullb btndetd fullbdel" title="Delete" data-toggle="tooltip">' +
                    // '<i class="fa fa-trash fa-1x"></i></button>' +
                    // '</div>'+
                    '<hr></div>';
                containerFb.appendChild(newBlock);
                attachEventsFb(newBlock, i);
            }


            // Function to attach events for toggle + remove
            function attachEventsFb(block1, j) {
                const map = {
                    ['#partition_fb' + j]: '#part_fb' + j,
                    ['#bedspace_fb' + j]: '#bs_fb' + j
                };

                partAndBsChange(map);

                // Remove button
                const removeBtn = block1.querySelector('.dlt-div-fullb');
                if (removeBtn) {
                    removeBtn.addEventListener('click', () => {
                        block1.remove();
                    });
                }
            }

            // var j = 0;
            // // Add new block dynamically
            // addMoreBtnFb.addEventListener('click', () => {
            //     j++;

            // });


            containerFb.querySelectorAll('.add-more-fullBuilding').forEach(attachEventsFb);
            container.querySelectorAll('.apdi').forEach(attachEvents);
        });
    </script>
    <!-- unit addmore  -->

    <!-- checkboxes inside unit -->
    <script>
        $(function() {
            const map = {
                '#partition': '#part',
                '#bedspace': '#bs'
            };

            partAndBsChange(map);
        });
    </script>
    <!-- checkboxes inside unit -->

    <!-- full building design change add more -->
    <script>
        $(function() {
            const map = {
                '#partition_fb': '#part_fb',
                '#bedspace_fb': '#bs_fb'
            };

            partAndBsChange(map);
        });

        function partAndBsChange(map) {
            // 🔹 Hide all sections on load
            $.each(map, function(_, div) {
                $(div).hide();
            });

            $.each(map, function(check, div) {
                $(check).on('change', function() {
                    // Uncheck all others and hide their sections
                    $.each(map, function(otherCheck, otherDiv) {
                        if (otherCheck !== check) {
                            $(otherCheck).prop('checked', false); // ✅ wrap in $()
                            $(otherDiv).hide();
                            $(otherDiv).find('input, select').val('');
                        }
                    });

                    // Show or hide this section
                    if ($(this).is(':checked')) {
                        $(div).show();
                    } else {
                        $(div).hide();
                        $(div).find('input, select').val('');
                    }
                });

                $(check).trigger('change');
            });
        }

        $('.fullBuildCheck').click(function() {
            if ($(this).prop('checked')) {

                $('.fullBuilding').show();
                $('.normalBuilding').hide();
                $('.normalBuilding').find('input, select').val('');
                $('.normalBuilding .partcheck, .normalBuilding .bedcheck').prop('checked', false);
            } else {
                $('.fullBuilding').hide();
                $('.normalBuilding').show();
                $('.fullBuilding').find('input, select').val('');
                $('.fullBuilding .partcheck_fb, .fullBuilding .bedcheck_fb').prop('checked', false);
            }
        });
    </script>
    <!-- full building design change add more -->

    <!-- b2b b2c checkbox value -->
    <script>
        const btob = document.getElementById("btob");
        const btoc = document.getElementById("btoc");

        btob.addEventListener("change", () => {
            if (btob.checked) btoc.checked = false;
        });

        btoc.addEventListener("change", () => {
            if (btoc.checked) btob.checked = false;
        });
    </script>
    <!-- b2b b2c checkbox value -->

    <!-- end date calc from start date -->
    <script>
        $('.startdate, #duration_months, #duration_days').on('input change', function() {
            calculateEndDate();
            calculateRoi();
            CalculatePayables();
        });

        function calculateEndDate() {
            var startDateVal = $('#startdate').find("input").val();
            var durationMonths = parseInt($('#duration_months').val()) || 0;
            var durationDays = parseInt($('#duration_days').val()) || 0;

            const startDate = parseDateCustom(startDateVal);
            console.log(startDate);
            if (!startDate || isNaN(startDate.getTime())) {
                $('.enddate').val('');
                return;
            }

            // Add months
            startDate.setMonth(startDate.getMonth() + durationMonths);

            // Add days
            startDate.setDate(startDate.getDate() + durationDays - 1);

            // Format as YYYY-MM-DD
            const year = startDate.getFullYear();
            const month = String(startDate.getMonth() + 1).padStart(2, '0');
            const day = String(startDate.getDate()).padStart(2, '0');

            const formattedDate = `${day}-${month}-${year}`;

            $('.enddate').val(formattedDate);
        }

        // modifying the date format to Y-m-d
        function parseDateCustom(dateStr) {
            if (!dateStr) return null;
            const parts = dateStr.split('-');

            if (parts.length !== 3) return null;
            const day = parseInt(parts[0], 10);
            const month = parseInt(parts[1], 10) - 1;
            const year = parseInt(parts[2], 10);

            formattedDate = `${year}-${month}-${day}`;

            return new Date(year, month, day);
        }
    </script>
    <!-- end date calc from start date -->

    <!-- rent commssion and deposit value -->
    <script>
        $('#rent_per_annum').on('input', function() {
            calculateCommissionAndDeposit();
            paymentSplit();
            CalculatePayables();
        });

        $('#commission_perc').on('input', function() {
            calculateCommissionAndDeposit();
        });

        $('#deposit_perc').on('input', function() {
            calculateCommissionAndDeposit();
        });

        function calculateCommissionAndDeposit() {
            var rentPerAnnum = parseFloat($('#rent_per_annum').val()) || 0;
            var commissionPerc = parseFloat($('#commission_perc').val()) || 0;
            var depositPerc = parseFloat($('#deposit_perc').val()) || 0;

            var commission = (rentPerAnnum * commissionPerc) / 100;
            var deposit = (rentPerAnnum * depositPerc) / 100;

            $('#commission').val(commission.toFixed(2));
            $('#deposit').val(deposit.toFixed(2));
        }

        $('#commission').on('input', function() {
            var rentPerAnnum = parseFloat($('#rent_per_annum').val()) || 0;
            var commission = parseFloat($('#commission').val()) || 0;

            if (rentPerAnnum > 0) {
                var commissionPerc = (commission / rentPerAnnum) * 100;
                $('#commission_perc').val(commissionPerc.toFixed(2));
            } else {
                $('#commission_perc').val(0);
            }
        });

        $('#deposit').on('input', function() {
            var rentPerAnnum = parseFloat($('#rent_per_annum').val()) || 0;
            var deposit = parseFloat($('#deposit').val()) || 0;

            if (rentPerAnnum > 0) {
                var depositPerc = (deposit / rentPerAnnum) * 100;
                $('#deposit_perc').val(depositPerc.toFixed(2));
            } else {
                $('#deposit_perc').val(0);
            }
        });
    </script>
    <!-- rent commssion and deposit value -->


    <!-- rent anum from unit rent -->
    <script>
        function calculateTotalRent() {
            let total = 0;
            $('.unit_rent_per_annum').each(function() {
                total += parseFloat($(this).val()) || 0;
            });
            $('#rent_per_annum').val(total.toFixed(2));
            calculateCommissionAndDeposit();
            calculateRoi();
            paymentSplit();
            CalculatePayables();
        }

        // Run whenever any unit rent changes
        $(document).on('input', '.unit_rent_per_annum', calculateTotalRent);
    </script>
    <!-- rent anum from unit rent -->


    <!-- otc cost calculations -->
    <script>
        function calculateOtc() {
            let totalPartition = 0;
            let totalBedSpace = 0;
            let totalPartitionFb = 0;
            let totalBedSpaceFb = 0;
            let totSubValue = 0;
            let cod = 0;
            let totRoom = 0;


            if ($('#contract_type').val() == 'df') {
                // Count filled inputs
                const countOfHouses = $('.unit_no').filter((_, el) => $(el).val()).length;
                const totalUnitCount = $('.unit_count').filter((_, el) => $(el).val()).length;

                // Sum values
                const sumValues = selector => $('.' + selector).toArray().reduce((sum, el) => sum + (parseFloat($(el)
                    .val()) || 0), 0);



                // Conditional calculation
                if (countOfHouses > 0) {
                    totalPartition = sumValues('total_partitions');
                    totalBedSpace = sumValues('total_bedspaces');
                }

                if (totalUnitCount > 0) {
                    totalPartitionFb = sumValues('total_partitions_fb');
                    totalBedSpaceFb = sumValues('total_bedspaces_fb');
                }
                // Calculate totSubValue and cod


                if (totalPartition > 0) cod = totSubValue = totalPartition;
                if (totalBedSpace > 0) totSubValue += totalBedSpace;

                if (totSubValue === 0) totSubValue = totalUnitCount || countOfHouses;

                totRoom = totalUnitCount || countOfHouses;

                if (totalPartitionFb > 0) cod = totSubValue = totalPartitionFb;
                if (totalBedSpaceFb > 0) totSubValue += totalBedSpaceFb;
            }


            // Set output values
            $('#cost_of_development').val(1200 * cod);
            $('#cost_of_beds').val(240 * totSubValue);
            $('#cost_of_mattress').val(55 * totSubValue);
            $('#cost_of_cabinets').val(100 * totSubValue);
            $('#appliances').val(2500 * totRoom);
            $('#decoration').val(0);
            $('#dewa_deposit').val(2130 * totRoom);
            $('#ejari').val(0);

            CalculatePayables();
        }

        // Trigger on input/change
        $(document).on('input change',
            '.unit_no, .unit_type, .total_partitions, .total_bedspaces, .total_partitions_fb, .total_bedspaces_fb',
            calculateOtc);
    </script>


    <!-- payment multiple -->
    <script>
        $(document).ready(function() {
            $('.payment_details').hide();

            $('#no_of_installments').change(function() {
                $('.payment_details').show();
                const installments = $(this).val();

                $('#interval').val(installments);
                const containerPayment = document.getElementsByClassName('payment_details')[0];
                const prevFbBlocks = containerPayment.querySelectorAll('.payment_mode_div');
                prevFbBlocks.forEach(block => block.remove());

                for (let i = 1; i < installments; i++) {

                    const paymentBlock = document.createElement('div');
                    paymentBlock.classList.add('payment_mode_div');

                    paymentBlock.innerHTML = `
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label>Payment Mode</label>
                            <select class="form-control select2" name="payment_mode[]" id="payment_mode${i}">
                                <option value="">Select</option>
                                <option value="1">Cash</option>
                                <option value="bank">Bank Transfer</option>
                                <option value="chq">Cheque</option>
                                <option value="cc">Credit card</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Payment Date</label>
                            <div class="input-group date" id="otherPaymentDate${i}" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input otherPaymentDate" 
                                    name="payment_date[]" id="payment_date${i}" 
                                    data-target="#otherPaymentDate${i}" placeholder="dd-mm-YYYY" />
                                <div class="input-group-append" data-target="#otherPaymentDate${i}" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Payment Amount</label>
                            <input type="text" class="form-control" id="payment_amount${i}" name="payment_amount[]" placeholder="Payment Amount">
                        </div>
                    </div>
                    <div class="form-group row">
                            <div class="col-md-4 bank" id="bank${i}">
                                <label for="exampleInputEmail1">Bank Name</label>
                                <select class="form-control select2" name="bank_name[]" id="bank_name${i}">
                                    <option value="">Select bank</option>
                                    <option value="1">1</option>
                                </select>
                            </div>

                            <div class="col-md-3 chq" id="chq${i}">
                                <label for="exampleInputEmail1">Cheque No</label>
                                <input type="text" class="form-control" id="cheque_no${i}" name="cheque_no[]" placeholder="Cheque No">
                            </div>

                            <div class="col-md-3 chq" id="chqiss${i}">
                                <label for="exampleInputEmail1">Cheque Issuer</label>
                                <select class="form-control select2" name="cheque_issuer[]" id="cheque_issuer${i}">
                                    <option value="">Select</option>
                                    <option value="self">Self</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <div class="col-md-3 chqot" id="chqotiss${i}">
                                <label for="exampleInputEmail1">Cheque Issuer Name</label>
                                <input type="text" class="form-control" id="cheque_issuer_name${i}" name="cheque_issuer_name[]" placeholder="Cheque Issuer Name">
                            </div>

                            <div class="col-md-3 chqot" id="chqot${i}">
                                <label for="exampleInputEmail1">Issuer ID</label>
                                <input type="text" class="form-control" id="issuer_id${i}" name="issuer_id[]" placeholder="Issuer ID">
                            </div>
                        </div>
                    <hr>
                `;

                    // Append first
                    containerPayment.appendChild(paymentBlock);

                    // Now initialize the datetimepicker AFTER it's added
                    $('#otherPaymentDate' + i).datetimepicker({
                        format: 'DD-MM-YYYY'
                    });

                    // Then attach any events or hide functions
                    attachEventsPayment(paymentBlock, i);
                    hidePayments(i);

                    $('#payment_mode' + i).change(function() {
                        paymentModeChange(i);
                    });

                    $('#cheque_issuer' + i).change(function() {
                        checkIssView(i);
                    });

                    $('#otherPaymentDate1').on('input change', function() {
                        calculatePaymentDates();
                    });

                    paymentSplit();

                }

                function attachEventsPayment() {

                }

                // containerPayment.querySelectorAll('.payment_mode_div').forEach(attachEventsPayment);
            });


        });
    </script>

    <!-- payment mode scripts -->
    <script>
        $(document).ready(function() {
            hidePayments();
            // $('.subrnt0').hide();
        });

        function hidePayments() {
            $('.bank').hide();
            $('.chq').hide();
            $('.chqot').hide();
            $('.part0').hide();
            $('.bs0').hide();
            $('.chqiss').hide();
            $('.chqotiss').hide();
        }

        $('#no_of_installments, #interval').on('input change', function() {
            calculatePaymentDates();
        });

        function calculatePaymentDates() {
            var startDateVal = $('#otherPaymentDate1').find("input").val();
            var noOfInstallments = parseInt($('#no_of_installments').val()) || 0;
            var interval = parseInt($('#interval').val()) || 0;


            const startDate = parseDateCustom(startDateVal);



            for (let i = 2; i < noOfInstallments; i++) {

                if (!startDate || isNaN(startDate.getTime())) {
                    $('#payment_date' + i).val('');
                    return;
                }

                // Add months
                startDate.setMonth(startDate.getMonth() + interval);

                // Add days
                // startDate.setDate(startDate.getDate() + durationDays - 1);

                // Format as YYYY-MM-DD
                const year = startDate.getFullYear();
                const month = String(startDate.getMonth() + 1).padStart(2, '0');
                const day = String(startDate.getDate()).padStart(2, '0');

                const formattedDate = `${day}-${month}-${year}`;

                $('#otherPaymentDate' + i).datetimepicker('date', moment(formattedDate, 'DD-MM-YYYY'));

            }
        }


        function paymentSplit() {
            var noOfInstallments = parseInt($('#no_of_installments').val()) || 0;
            var rentAnnum = parseFloat($('#rent_per_annum').val()) || 0;
            var commission = parseFloat($('#commission').val()) || 0;
            var deposit = parseFloat($('#deposit').val()) || 0;
            $('#payment_amount0').val((rentAnnum / noOfInstallments) + commission + deposit);

            for (let i = 1; i < noOfInstallments; i++) {
                $('#payment_amount' + i).val((rentAnnum / noOfInstallments));
            }
        }


        $('#payment_mode0').change(function() {
            paymentModeChange(0);
        });


        function paymentModeChange(i) {
            var payment_mode = $('#payment_mode' + i).val();
            if (payment_mode == 'chq') {
                $('#chq' + i).show();
                $('#bank' + i).hide();
                $('#chqot' + i).hide();
                $('#chqiss' + i).show();
                $('#chqotiss' + i).hide();
            } else if (payment_mode == 'bank') {
                $('#bank' + i).show();
                $('#chq' + i).hide();
                $('#chqot' + i).hide();
                $('#chqiss' + i).hide();
                $('#chqotiss' + i).hide();
            } else {
                $('#bank' + i).hide();
                $('#chq' + i).hide();
                $('#chqot' + i).hide();
                $('#chqiss' + i).hide();
                $('#chqotiss' + i).hide();
            }
        }

        function checkIssView(i) {
            var cheque_issuer = $('#cheque_issuer' + i).val();
            if (cheque_issuer == 'other') {
                $('#chqot' + i).show();
                $('#chqotiss' + i).show();
            } else {
                $('#chqot' + i).hide();
                $('#chqotiss' + i).hide();
            }
        }

        $('#cheque_issuer0').change(function() {
            checkIssView(0);
        });

        $('#contract_type').change(function() {
            calculateOtc();
            //     var contract_type = $(this).val();
            //     if (contract_type == 'ff') {
            //         $('#client_name').val('Faateh');
            //         $('#client_phone').val('0568856995');
            //         $('#client_email').val('adil@faateh.ae');
            //         $('#contact_person').val('Adil');

            //     } else {
            //         $('#client_name').val('Faateh');
            //         $('#client_phone').val('0568856995');
            //         $('#client_email').val('adil@faateh.ae');
            //         $('#contact_person').val('Adil');
            //     }
        });
    </script>
    <!-- payment mode scripts -->


    <!-- roi and profit calculations -->
    <script>
        $('#rent_per_part, #rent_per_bs, #rent_per_room').on('input change', function() {
            calculateRoi();
            CalculatePayables();
        });

        function CalculatePayables() {
            let totRent = parseFloat($('#rent_per_annum').val()) || 0;
            let totcomm = parseFloat($('#commission').val()) || 0;
            let totdepo = parseFloat($('#deposit').val()) || 0;
            let totcontractfee = parseFloat($('#contract_fee').val()) || 0;

            let totalotc = (parseFloat($('#cost_of_development').val()) || 0) +
                (parseFloat($('#cost_of_beds').val()) || 0) +
                (parseFloat($('#cost_of_mattress').val()) || 0) +
                (parseFloat($('#cost_of_cabinets').val()) || 0) +
                (parseFloat($('#appliances').val()) || 0) +
                (parseFloat($('#decoration').val()) || 0) +
                (parseFloat($('#dewa_deposit').val()) || 0) +
                (parseFloat($('#ejari').val()) || 0);

            let paymenttovendor = totRent + totcomm + totdepo;
            let finalCost = paymenttovendor + totcontractfee + totalotc;
            let initialInv = (totRent / 4) + totcomm + totdepo + totcontractfee + totalotc;

            $('.total_contract_amount').text(totRent);
            $('.commssion_final').text(totcomm);
            $('.deposit_final').text(totdepo);
            $('.contract_final').text(totcontractfee);
            $('.payment_to_vendor').text(paymenttovendor);
            $('.total_otc_payable').text(totalotc);
            $('.final_cost').text(finalCost);
            $('.initial_inv').text(initialInv);
        }


        $('.rentPartition, .rentBedspace, .rentRoom').hide();
        let totalroomcount = 0;

        $(document).on('change', '.unit_type, .partcheck, .bedcheck, .partcheck_fb, .bedcheck_fb, .fullBuildCheck',
            function() {
                // hide all first
                $('.rentPartition, .rentBedspace, .rentRoom').hide().find('input, select').val('');

                $('.total_rent_receivable').text('0.00');
                $('.no_of_months_final').text('0');
                $('.total_rental').text('0.00');

                let hasMissingPartitionOrBedspace = false;
                let roomcount = 0;

                if ($('.fullBuildCheck:checked').length > 0) {

                    if (($('.partcheck_fb:checked').length) > 0) {
                        $('.rentPartition').show();
                    }

                    if ($('.bedcheck_fb:checked').length > 0) {
                        $('.rentBedspace').show();
                    }

                    $('.fullBuilding .add-more-fullBuilding').each(function() {
                        // Get current row context
                        let unitType = $(this).find('.unit_type').val();
                        let partitionChecked = $(this).find('.partcheck_fb').is(':checked');
                        let bedspaceChecked = $(this).find('.bedcheck_fb').is(':checked');


                        // If unit type is selected but neither checkbox is checked
                        if (unitType && !partitionChecked && !bedspaceChecked) {
                            hasMissingPartitionOrBedspace = true;
                            roomcount++;
                            totalroomcount = roomcount;
                            return false; // break loop early
                        }
                    });
                } else {

                    if (($('.partcheck:checked').length) > 0) {
                        $('.rentPartition').show();
                    }

                    if ($('.bedcheck:checked').length > 0) {
                        $('.rentBedspace').show();
                    }

                    $('.normalBuilding .apdi').each(function() {
                        // Get current row context
                        let unitType = $(this).find('.unit_type').val();
                        let partitionChecked = $(this).find('.partcheck').is(':checked');
                        let bedspaceChecked = $(this).find('.bedcheck').is(':checked');


                        // If unit type is selected but neither checkbox is checked
                        if (unitType && !partitionChecked && !bedspaceChecked) {
                            hasMissingPartitionOrBedspace = true;
                            roomcount++;
                            totalroomcount = roomcount;
                            return false; // break loop early
                        }
                    });
                }

                if (hasMissingPartitionOrBedspace) {
                    $('.rentRoom').show();
                } else {
                    $('.rentRoom').hide();
                }

            });



        function calculateRoi() {
            let rentPerPartition = parseFloat($('#rent_per_part').val()) || 0;
            let rentPerBedspace = parseFloat($('#rent_per_bs').val()) || 0;
            let rentPerRoom = parseFloat($('#rent_per_room').val()) || 0;


            let total_part = totalPartition() * rentPerPartition;
            let total_bs = totalBedspace() * rentPerBedspace;
            let total_room = totalroomcount * rentPerRoom;

            let total_rent_rec = total_part + total_bs + total_room;
            let duration = $('#duration_months').val();
            let total_rental = total_rent_rec * duration;


            let expProfit = total_rental - parseFloat($('.final_cost').text());
            let roi = expProfit / parseFloat($('.initial_inv').text());
            let profit = expProfit / parseFloat($('.final_cost').text());
            // parseFloat($('.').text());



            $('.total_rent_receivable').text(total_rent_rec);
            $('.no_of_months_final').text(duration);
            $('.total_rental').text(total_rental);


            $('#roi').val(Math.round(roi * 100));
            $('#expected_profit').val(expProfit);
            $('#profit').val(Math.round(profit * 100));
        }

        function totalPartition() {
            let total_partitions = 0;
            $('.total_partitions').each(function() {
                total_partitions += parseFloat($(this).val()) || 0;
            });

            return total_partitions;
        }

        function totalBedspace() {
            let total_bedspaces = 0;
            $('.total_bedspaces').each(function() {
                total_bedspaces += parseFloat($(this).val()) || 0;
            });

            return total_bedspaces;
        }
    </script>
    <!-- roi and profit calculations -->


    @component('admin.modals.modal-company')
        @slot('industry_dropdown')
            @foreach ($industries as $industry)
                <option value="{{ $industry->id }}">{{ $industry->name }}</option>
            @endforeach
        @endslot
    @endcomponent
    <script>
        $('#addVendorButton').on('click', function() {
            $('#modal-vendor').modal('show');
            let $modal = $('#modal-vendor');
            let $vendorCompanySelect = $modal.find('select[name="company_id"]');


            if (window.lastAddedCompanyId) {
                // alert(window.lastAddedCompanyId);
                // alert("hi");


                // Add the option if it doesn't exist already
                if ($vendorCompanySelect.find('option[value="' + window.lastAddedCompanyId + '"]').length === 0) {
                    let newOption = new Option(window.lastAddedCompanyName, window.lastAddedCompanyId, true, true);
                    $vendorCompanySelect.append(newOption);
                }

                // Select it and refresh Select2
                $vendorCompanySelect.val(window.lastAddedCompanyId).trigger('change.select2');

            }
        });
    </script>
    @component('admin.modals.modal-vendor')
        @slot('company_dropdown')
            @foreach ($companies as $company)
                <option value="{{ $company->id }}">{{ $company->company_name }}
                </option>
            @endforeach
        @endslot
    @endcomponent

    <script>
        let allVendors = @json($vendors);
        let allAreas = @json($areas);
        let allLocalities = @json($localities);
        let allpropertytypes = @json($property_types);



        $(document).on('change', '#vc_company_id', function() {
            // alert("hi");
            let companyId = $(this).val();
            // alert(companyId);
            contractCompanyChange(companyId, null);
        });

        function contractCompanyChange(companyId, vendorVal, areaVal, propertytypeVal, localityVal) {
            // alert('test');
            let options = '<option value="">Select Vendor</option>';
            let option1 = '<option value="">Select Area</option>';
            let option2 = '<option value="">Select PropertyType</option>';


            // dd($options);

            allVendors
                .filter(v => v.company_id == companyId)
                .forEach(v => {
                    options +=
                        `<option value="${v.id}" ${(v.id == vendorVal) ? 'selected' : ''}>${v.vendor_name}</option>`;
                });
            $('#vc_vendor_id').html(options).trigger('change');

            allAreas
                .filter(a => a.company_id == companyId)
                .forEach(a => {
                    option1 += `<option value="${a.id}" ${(a.id == areaVal) ? 'selected' : ''}>${a.area_name}</option>`;
                });
            $('#vc_area_id').html(option1).trigger('change');
            contractAreaChange(areaVal, localityVal);

            allpropertytypes
                .filter(pt => pt.company_id == companyId)
                .forEach(pt => {
                    option2 +=
                        `<option value="${pt.id}" ${(pt.id == propertytypeVal) ? 'selected' : ''}>${pt.property_type}</option>`;
                });
            $('#vc_property_type_id').html(option2).trigger('change');


        }
        $('#vc_area_id').on('change', function() {
            let areaId = $(this).val();
            contractAreaChange(areaId, null); // reset areaVal when adding
        });

        function contractAreaChange(areaId, localityVal) {
            let options = '<option value="">Select Locality</option>';

            allLocalities
                .filter(l => l.area_id == areaId)
                .forEach(l => {
                    options +=
                        `<option value="${l.id}" ${(l.id == localityVal) ? 'selected' : ''}>${l.locality_name}</option>`;
                });
            $('#vc_locality_id').html(options).trigger('change');
        }
    </script>


@endsection
