@extends('admin.layout.admin_master')
@section('custom_css')
    <!-- daterange picker -->

    <link rel="stylesheet" href="{{ asset('assets/daterangepicker/daterangepicker.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('assets/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('assets/icheck-bootstrap/icheck-bootstrap.min.css') }}">
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
                                        <div class="step" data-target="#contract-step">
                                            <button type="button" class="step-trigger" role="tab"
                                                aria-controls="contract-step" id="contract-step-trigger">
                                                <span class="bs-stepper-circle"><i class="fas fa-file-contract"></i></span>
                                                <span class="bs-stepper-label">Agreement</span>
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
                                        <!-- <div class="step" data-target="#rental-step">
                                                                                                                                    <button type="button" class="step-trigger" role="tab" aria-controls="rental-step" id="rental-step-trigger">
                                                                                                                                        <span class="bs-stepper-circle"><i class="fas fa-house-user"></i></span>
                                                                                                                                        <span class="bs-stepper-label">Rental</span>
                                                                                                                                    </button>
                                                                                                                                </div> -->
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
                                                <span class="bs-stepper-circle"><i class="fas fa-dollar-sign"></i></span>
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
                                                <!-- <div class="col-md-4">
                                                                                                                                            <label for="exampleInputEmail1">Agreement Type</label>
                                                                                                                                            <select class="form-control select2" name="contract_type" id="contract_type">
                                                                                                                                                <option value="df">DF</option>
                                                                                                                                                <option value="ff">FF</option>
                                                                                                                                            </select>
                                                                                                                                        </div> -->
                                                <div class="col-md-4">
                                                    <label>Contract</label>
                                                    <select class="form-control select2" name="company_id"
                                                        id="company_id">
                                                        <option value="">Select Project</option>
                                                        <option value="1">Project 1</option>
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
                                                <div class="col-md-4">
                                                    <label for="exampleInputEmail1">Tenant email</label>
                                                    <input type="text" class="form-control" id="contact_person"
                                                        placeholder="Tenant email">
                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <!-- <div class="col-md-4">
                                                                                                                                            <label for="exampleInputEmail1">Agent</label>
                                                                                                                                            <select class="form-control select2" name="agent" id="agent">
                                                                                                                                                <option value="">Select Agent</option>
                                                                                                                                                <option value="1">Agent 1</option>
                                                                                                                                            </select>
                                                                                                                                        </div> -->
                                                <div class="col-md-4">
                                                    <label for="exampleInputEmail1">Nationality</label>
                                                    <select class="form-control select2" name="agent" id="agent">
                                                        <option value="">Select Nationality</option>
                                                        <option value="1">Nationality 1</option>
                                                    </select>

                                                </div>
                                                <div class="col-md-4">
                                                    <label>Tenant Address</label>
                                                    <textarea name="" class="form-control" id="client_address"></textarea>
                                                </div>
                                            </div>

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
                                                            class="form-control datetimepicker-input startdate"
                                                            data-target="#startdate" placeholder="dd-mm-YYYY" />
                                                        <div class="input-group-append" data-target="#startdate"
                                                            data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="exampleInputEmail1">Duration in Months</label>
                                                    <input type="number" class="form-control" id="duration_months"
                                                        placeholder="Duration in Months" value="12">
                                                </div>
                                                <div class="col-md-3">
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
                                                        <option value="1">201</option>
                                                        <option value="2">202</option>
                                                    </select>
                                                </div>
                                                <!-- <div class="col-sm-3 mt-23">
                                                                                                                                            <div class="icheck-success d-inline">
                                                                                                                                                <input type="checkbox" id="partition" class="partcheck" value="1">
                                                                                                                                                <label class="labelpermission" for="partition"> Partition </label>
                                                                                                                                            </div>
                                                                                                                                            <div class="icheck-success d-inline">
                                                                                                                                                <input type="checkbox" id="bedspace" class="bedcheck" value="1">
                                                                                                                                                <label class="labelpermission" for="bedspace"> Bedspace </label>
                                                                                                                                            </div>
                                                                                                                                        </div> -->
                                                <div class="col-sm-3">
                                                    <label class="control-label">Sub Unit</label>
                                                    <select class="form-control select2" name="unit_type[]"
                                                        id="unit_type0">
                                                        <option value="">Select Sub Unit</option>
                                                        <option value="1">P1</option>
                                                        <option value="2">P2</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="exampleInputEmail1">Rent per annum</label>
                                                    <input type="text" class="form-control" id="rent_per_annum"
                                                        placeholder="Rent per annum">
                                                </div>
                                            </div>

                                            <button class="btn btn-info" onclick="stepper.previous()">Previous</button>
                                            <button class="btn btn-info" onclick="stepper.next()">Next</button>
                                        </div>

                                        <!-- <div id="rental-step" class="content" role="tabpanel" aria-labelledby="rental-step-trigger">
                                                                                                                                    <div class="form-group row">
                                                                                                                                        <div class="col-md-4">
                                                                                                                                            <label for="exampleInputEmail1">Rent per annum</label>
                                                                                                                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Rent per annum">
                                                                                                                                        </div>
                                                                                                                                        <div class="col-md-2">
                                                                                                                                            <label for="exampleInputEmail1">Commission %</label>
                                                                                                                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Commission %">
                                                                                                                                        </div>
                                                                                                                                        <div class="col-md-2">
                                                                                                                                            <label for="exampleInputEmail1">Commission</label>
                                                                                                                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Commission" readonly>
                                                                                                                                        </div>
                                                                                                                                        <div class="col-md-2">
                                                                                                                                            <label for="exampleInputEmail1">Deposit %</label>
                                                                                                                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Deposit %">
                                                                                                                                        </div>
                                                                                                                                        <div class="col-md-2">
                                                                                                                                            <label for="exampleInputEmail1">Deposit</label>
                                                                                                                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Deposit" readonly>
                                                                                                                                        </div>
                                                                                                                                    </div>
                                                                                                                                    <button class="btn btn-info" onclick="stepper.previous()">Previous</button>
                                                                                                                                    <button class="btn btn-info" onclick="stepper.next()">Next</button>
                                                                                                                                </div> -->
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
                                                    <label for="exampleInputEmail1">No. of Installments</label>
                                                    <select class="form-control select2" name="no_of_installments"
                                                        id="no_of_installments">
                                                        <option value="">Select</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="exampleInputEmail1">Interval</label>
                                                    <input type="text" class="form-control" id="interval"
                                                        placeholder="Interval">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="exampleInputEmail1">Beneficiary</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                                        placeholder="Beneficiary">
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="payment_details">

                                            </div>
                                            <button class="btn btn-info" onclick="stepper.previous()">Previous</button>
                                            <button type="submit" class="btn btn-info">Submit</button>
                                        </div>
                                    </div>
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
    </script>

    <!-- end date calc from start date -->
    <script>
        $('.startdate, #duration_months, #duration_days').on('input change', function() {
            calculateEndDate();
        });

        function calculateEndDate() {
            var startDateVal = $('#startdate').find("input").val();
            var durationMonths = parseInt($('#duration_months').val()) || 0;
            var durationDays = parseInt($('#duration_days').val()) || 0;

            const startDate = parseDateCustom(startDateVal);

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

                for (let i = 0; i < installments; i++) {

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

                    $('#otherPaymentDate0').on('input change', function() {
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
        $('#rent_per_annum').on('input, change', function() {
            paymentSplit();
        });


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
            var startDateVal = $('#otherPaymentDate0').find("input").val();
            var noOfInstallments = parseInt($('#no_of_installments').val()) || 0;
            var interval = parseInt($('#interval').val()) || 0;

            const startDate = parseDateCustom(startDateVal);

            for (let i = 1; i < noOfInstallments; i++) {

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
            let firstDate = null;
            let firstPaymentVal = 0;
            var noOfInstallments = parseInt($('#no_of_installments').val()) || 0;
            var rentAnnum = parseFloat($('#rent_per_annum').val()) || 0;

            for (let i = 0; i < noOfInstallments; i++) {
                // if (i == 0 && noOfInstallments == 14) {
                //     firstDate = $('#otherPaymentDate0').val();
                //     firstPaymentVal =
                // }
                $('#payment_amount' + i).val((rentAnnum / 12).toFixed(2));
            }
        }

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
    </script>
    <!-- payment mode scripts -->
@endsection
