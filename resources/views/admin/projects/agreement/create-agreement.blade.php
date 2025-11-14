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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('agreement.index') }}">Agreement</a></li>
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
                                        <div class="step" data-target="#tenant-step">
                                            <button type="button" class="step-trigger" role="tab"
                                                aria-controls="tenant-step" id="tenant-step-trigger">
                                                <span class="bs-stepper-circle"><i class="far fa-user"></i></span>
                                                <span class="bs-stepper-label">Tenant</span>
                                            </button>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step" data-target="#document-step">
                                            <button type="button" class="step-trigger" role="tab"
                                                aria-controls="document-step" id="documemnt-step-trigger">
                                                <span class="bs-stepper-circle"><i class="fas fa-file-upload"></i></span>
                                                <span class="bs-stepper-label">Documents</span>
                                            </button>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step" data-target="#agreement-step">
                                            <button type="button" class="step-trigger" role="tab"
                                                aria-controls="agreement-step" id="agreement-step-trigger">
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
                                        <div class="step" data-target="#payment-step">
                                            <button type="button" class="step-trigger" role="tab"
                                                aria-controls="payment-step" id="payment-step-trigger">
                                                <span class="bs-stepper-circle"><i class="fas fa-dollar-sign"></i></span>
                                                <span class="bs-stepper-label">Payment</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="bs-stepper-content card p-3">

                                        <form action="{{ route('agreement.store') }}" method="post" id="agreementForm"
                                            enctype="multipart/form-data">
                                            @csrf
                                            {{-- {{ dd($agreement) }} --}}

                                            {{-- Edit case --}}
                                            @isset($agreement)
                                                <input type="hidden" name="agreement_id" value={{ $agreement->id }}>
                                                <input type="hidden" name="tenant_id" value={{ $agreement->tenant->id }}>
                                                <input type="hidden" name="payment_id"
                                                    value={{ $agreement->agreement_payment->id }}>
                                            @endisset
                                            {{-- Edit case --}}
                                            <!-- your steps content here -->
                                            <div id="tenant-step" class="content step-content" role="tabpanel"
                                                aria-labelledby="tenant-step-trigger" data-ste="0">
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Company</label>
                                                        <select class="form-control select2" name="company_id"
                                                            id="company_id" required>
                                                            <option value="">Select Company</option>
                                                            {{-- @foreach ($companies as $company)
                                                                <option value="{{ $company->id }}">
                                                                    {{ $company->company_name }}
                                                                </option>
                                                            @endforeach --}}
                                                            @foreach ($companies as $company)
                                                                <option value="{{ $company->id }}"
                                                                    {{ isset($agreement) && $agreement->company_id == $company->id ? 'selected' : '' }}>
                                                                    {{ $company->company_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        {{-- Edit case --}}
                                                        @isset($agreememnt)
                                                            <input type="hidden" name="company_id" id="edited_company"
                                                                value={{ $agreement->company_id }}>
                                                        @endisset
                                                        {{-- Edit case --}}

                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Contract</label>
                                                        <select class="form-control select2" name="contract_id"
                                                            id="contract_id" required>
                                                            {{-- <option value="">Select Project</option>
                                                        <option value="1">Project 1</option> --}}
                                                        </select>
                                                    </div>
                                                    {{--  Edit case --}}
                                                    @isset($agreememnt)
                                                        <input type="hidden" name="contract_id" id="edited_contract"
                                                            value="">
                                                    @endisset
                                                    {{-- Edit case --}}
                                                    <input type="hidden" name="contract_type" id="selctedcontractType">


                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Tenant Name</label>
                                                        <input type="text" class="form-control" id="tenant_name"
                                                            name="tenant_name" placeholder="Tenant Name"
                                                            value="{{ old('tenant_name', $agreement->tenant->tenant_name ?? '') }}"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">


                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Tenant mobile</label>
                                                        <input type="number" class="form-control" id="tenant_mobile"
                                                            name="tenant_mobile" placeholder="Tenant mobile"
                                                            value="{{ old('tenant_mobile', $agreement->tenant->tenant_mobile ?? '') }}"
                                                            required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Tenant email</label>
                                                        <input type="email" class="form-control" id="tenant_email"
                                                            name="tenant_email" placeholder="Tenant email"
                                                            value="{{ old('tenant_email', $agreement->tenant->tenant_email ?? '') }}"
                                                            required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Nationality</label>
                                                        <select class="form-control select2" name="nationality_id"
                                                            id="nationality_id" required>
                                                            <option value="">Select Nationality</option>
                                                            @foreach ($nationalities as $nationality)
                                                                <option
                                                                    value="{{ $nationality->id }}"{{ isset($agreement) && $agreement->tenant->nationality_id == $nationality->id ? 'selected' : '' }}>
                                                                    {{ $nationality->nationality_name }} </option>
                                                            @endforeach

                                                        </select>

                                                    </div>

                                                </div>
                                                <div class="form-group row">


                                                    <div class="col-md-4">
                                                        <label>Tenant Address</label>
                                                        <textarea name="tenant_address" class="form-control" id="tenant_address" required>{{ old('tenant_address', $agreement->tenant->tenant_address ?? '') }}</textarea>
                                                    </div>
                                                </div>

                                                <button type="button" class="btn btn-info nextBtn">Next</button>
                                            </div>
                                            <div id="document-step" class="content step-content" role="tabpanel"
                                                aria-labelledby="document-step-trigger" data-step="1">
                                                <div class="form-group p-3">
                                                    @foreach ($tenantIdentities as $index => $identity)
                                                        <h6 class="font-weight-bold text-cyan mb-3">
                                                            {{ $identity->identity_type }}
                                                        </h6>

                                                        @php
                                                            // Find matching document (if exists)
                                                            $document = isset($agreement)
                                                                ? $agreement->agreement_documents->firstWhere(
                                                                    'document_type',
                                                                    $identity->id,
                                                                )
                                                                : null;
                                                        @endphp
                                                        {{-- {{ dd($document) }} --}}

                                                        <div class="form-row">
                                                            {{-- First Field --}}
                                                            <div class="form-group col-md-6">
                                                                <label for="document_number_{{ $index }}">
                                                                    {{ $identity->first_field_label }}
                                                                </label>
                                                                <input type="{{ $identity->first_field_type }}"
                                                                    name="documents[{{ $index }}][document_number]"
                                                                    id="document_number_{{ $index }}"
                                                                    value="{{ $document ? $document->document_number : '' }}"
                                                                    class="form-control"
                                                                    placeholder="{{ $identity->first_field_label }}">
                                                                <input type="hidden"
                                                                    name="documents[{{ $index }}][document_type]"
                                                                    value="{{ $identity->id }}">
                                                            </div>

                                                            {{-- Second Field --}}
                                                            <div class="form-group col-md-6">
                                                                <label for="document_path_{{ $index }}">
                                                                    {{ $identity->second_field_label }}
                                                                </label>
                                                                <input type="{{ $identity->second_field_type }}"
                                                                    name="documents[{{ $index }}][document_path]"
                                                                    id="document_path_{{ $index }}"
                                                                    class="form-control"
                                                                    @if ($identity->second_field_type == 'file') accept="image/*,.pdf" @endif
                                                                    placeholder="{{ $identity->second_field_label }}">
                                                                @if ($document && $document->original_document_path)
                                                                    <input type="hidden"
                                                                        name="documents[{{ $index }}][id]"
                                                                        value="{{ $document->id }}">
                                                                    <div class="mt-2">
                                                                        @php
                                                                            $filePath = asset(
                                                                                'storage/' .
                                                                                    $document->original_document_path,
                                                                            );
                                                                            $isPdf = \Illuminate\Support\Str::endsWith(
                                                                                strtolower(
                                                                                    $document->original_document_path,
                                                                                ),
                                                                                '.pdf',
                                                                            );
                                                                        @endphp

                                                                        @if ($isPdf)
                                                                            <a href="{{ $filePath }}" target="_blank"
                                                                                class="btn btn-outline-primary btn-sm">
                                                                                <i class="fas fa-file-pdf"></i> View PDF
                                                                            </a>
                                                                        @else
                                                                            <a href="{{ $filePath }}"
                                                                                target="_blank">
                                                                                <img src="{{ $filePath }}"
                                                                                    class="documentpreview"
                                                                                    alt="Document">
                                                                            </a>
                                                                        @endif
                                                                        <p class="small text-muted mt-1">
                                                                            {{ $document->original_document_name }}</p>


                                                                    </div>
                                                                @endif
                                                            </div>
                                                            {{-- Existing File Preview --}}

                                                        </div>
                                                    @endforeach
                                                </div>

                                                <button class="btn btn-info prevBtn" type="button">Previous</button>
                                                <button type="button" class="btn btn-info nextBtn">Next</button>
                                            </div>
                                            <div id="agreement-step" class="content step-content" role="tabpanel"
                                                aria-labelledby="agreement-step-trigger" data-step="2">
                                                <div class="form-group row">
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Start Date</label>
                                                        <div class="input-group date" id="startdate"
                                                            data-target-input="nearest">
                                                            <input type="text"
                                                                class="form-control datetimepicker-input startdate"
                                                                name="start_date" id="start_date"
                                                                data-target="#startdate" placeholder="dd-mm-YYYY" />
                                                            <div class="input-group-append" data-target="#startdate"
                                                                data-toggle="datetimepicker">
                                                                <div class="input-group-text">
                                                                    <i class="fa fa-calendar"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">Duration in Months</label>
                                                        <input type="number" class="form-control" id="duration_months"
                                                            name="duration_in_months" placeholder="Duration in Months"
                                                            value="">
                                                    </div>
                                                    {{-- <div class="col-md-3">
                                                    <label for="exampleInputEmail1">Duration in Days</label>
                                                    <input type="number" class="form-control" id="duration_days"
                                                        placeholder="Duration in Days" value="0">
                                                    </div> --}}
                                                    <div class="col-md-4">
                                                        <label for="exampleInputEmail1">End Date</label>
                                                        <div class="input-group date" id="enddate"
                                                            data-target-input="nearest">
                                                            <input type="text"
                                                                class="form-control datetimepicker-input enddate"
                                                                id="end_date" name="end_date" placeholder="dd-mm-YYYY"
                                                                readonly onfocus="this.blur()" />
                                                            <div class="input-group-append" data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i
                                                                        class="fa fa-calendar"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-info prevBtn" type="button">Previous</button>
                                                <button class="btn btn-info nextBtn" type="button">Next</button>
                                            </div>
                                            <div id="unit-step" class="content step-content" role="tabpanel"
                                                aria-labelledby="unit-step-trigger" data-step="3">
                                                <div class="form-group row" id="unit_details_div_df">
                                                    <div class="col-sm-3">
                                                        <label class="control-label">Unit Type</label>
                                                        <input type="hidden" name="unit_id" id="unit_id"
                                                            value="">
                                                        <select class="form-control select2" name="unit_type_id"
                                                            id="unit_type_id" required>

                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label class="control-label">Select Unit No</label>
                                                        <select class="form-control select2"
                                                            name="contract_unit_details_id" id="unit_type0" required>
                                                        </select>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <label class="control-label">Sub Unit</label>
                                                        <select class="form-control select2"
                                                            name="contract_subunit_details_id" id="sub_unit_type">
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="exampleInputEmail1">Rent per Month</label>
                                                        <input type="text" class="form-control" id="rent_per_month"
                                                            name="rent_per_month" placeholder="Rent per month">
                                                    </div>
                                                </div>
                                                <div class="form-group  d-none" id="unit_details_div_ff">
                                                    <div class="card mt-3" id="unit_summary_div">
                                                        <div class="card-body">
                                                            <h5 class="mb-3"><i class="fas fa-door-open text-info"></i>
                                                                Unit Details</h5>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <strong>Unit Type:</strong>
                                                                    <p id="unit_type_display" class="text-muted mb-0">-
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <strong>Unit Number:</strong>
                                                                    <p id="unit_number_display" class="text-muted mb-0">-
                                                                    </p>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <strong>Total Subunits:</strong>
                                                                    <p id="total_subunits_display"
                                                                        class="text-muted mb-0">-</p>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <strong>Rent per Annum:</strong>
                                                                    <p id="rent_per_annum_display"
                                                                        class="text-muted mb-0">-</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <button class="btn btn-info prevBtn" type="button">Previous</button>
                                                <button class="btn btn-info nextBtn" type="button">Next</button>
                                            </div>
                                            <div id="payment-step" class="content step-content" role="tabpanel"
                                                aria-labelledby="payment-step-trigger" data-step='4'>
                                                <div class="form-group row">
                                                    <div class="col-md-3">
                                                        <label for="exampleInputEmail1">No. of Installments</label>
                                                        <select class="form-control select2" name="installment_id"
                                                            id="no_of_installments">
                                                            <option value="">Select</option>
                                                            @foreach ($installments as $installment)
                                                                <option value="{{ $installment->id }}"
                                                                    data-interval="{{ $installment->interval }}">
                                                                    {{ $installment->installment_name }}</option>
                                                            @endforeach

                                                        </select>
                                                        {{-- <input type="text" name="installment_id" class="form-control"
                                                            id="no_of_installments"> --}}
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="exampleInputEmail1">Interval</label>
                                                        <input type="text" class="form-control" id="interval"
                                                            name="interval" placeholder="Interval">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="exampleInputEmail1">Beneficiary</label>
                                                        <input type="text" class="form-control" id="beneficiary"
                                                            name="beneficiary" placeholder="Beneficiary">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="exampleInputEmail1">Total Rent Per Annum</label>
                                                        <input type="text" class="form-control" id="total_rent_annum"
                                                            name="total_rent_per_annum" placeholder="" readonly>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="payment_details">
                                                    <div
                                                        class="form-group row font-weight-bold text-secondary mb-2 justify-content-end header-row d-none">
                                                        <div class="col-auto text-end">
                                                            <label class="me-2">Total Rent per Annum:</label>
                                                            <span id="total_rent_per_annum"
                                                                class="text-info font-weight-bold">0</span>
                                                        </div>
                                                    </div>
                                                    <div id="paymentError"
                                                        class="text-danger font-weight-bold mb-2 d-none"></div>
                                                </div>

                                                <button class="btn btn-info prevBtn" type="button">Previous</button>
                                                <button type="submit" class="btn btn-info agreementFormSubmit"
                                                    id="submitBtn">Submit</button>
                                            </div>
                                        </form>
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

    @include('admin.projects.agreement.stepper-validation-js')
    @include('admin.projects.agreement.form-submit')
    @include('admin.projects.agreement.edit-agreement')


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
        // $('.startdate, #duration_months, #duration_days').on('input change', function() {
        //     calculateEndDate();
        // });

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
            // $('.payment_details').hide();


        });
    </script>

    <!-- payment mode scripts -->
    <script>
        $(document).ready(function() {
            hidePayments();
            // $('.subrnt0').hide();
        });

        function hidePayments() {
            // alert("paymenthidecalled");
            $('.bank').hide();
            $('.chq').hide();
            $('.chqot').hide();
            $('.part0').hide();
            $('.bs0').hide();
            $('.chqiss').hide();
            $('.chqotiss').hide();
        }

        $('#no_of_installments, #interval').on('input change', function() {
            // alert("secondcall");
            calculatePaymentDates();
        });


        let updatingDates = false;

        function calculatePaymentDates() {
            if (updatingDates) return; // prevent recursive calls
            updatingDates = true;

            var startDateVal = $('#otherPaymentDate0').find("input").val();
            var noOfInstallments = parseInt($('#no_of_installments').find('option:selected').text().trim()) || 0;
            var interval = parseInt($('#interval').val()) || 0;

            const startDate = parseDateCustom(startDateVal);

            for (let i = 1; i < noOfInstallments; i++) {

                if (!startDate || isNaN(startDate.getTime())) {
                    $('#payment_date' + i).val('');
                    continue;
                }

                startDate.setMonth(startDate.getMonth() + interval);

                const year = startDate.getFullYear();
                const month = String(startDate.getMonth() + 1).padStart(2, '0');
                const day = String(startDate.getDate()).padStart(2, '0');

                const formattedDate = `${day}-${month}-${year}`;

                $('#otherPaymentDate' + i).datetimepicker('date', moment(formattedDate, 'DD-MM-YYYY'));
            }

            updatingDates = false;
        }


        function calculatepaymentamount(rent_per_month = 0, payment_count = 0) {
            // alert(rent_per_month);
            //console.log("count ;", payment_count);
            var rentmonth = rent_per_month || 0;
            for (let i = 0; i < payment_count; i++) {
                $('#payment_amount' + i).val((rentmonth));
            }
            let total_rent_per_annum = rentmonth * payment_count;
            // alert(total_rent_per_annum);
            $('#total_rent_per_annum').text(total_rent_per_annum);
            $('#total_rent_annum').val(total_rent_per_annum);
        }

        function paymentModeChange(i) {
            // alert("modechange");

            var payment_mode = $('#payment_mode' + i).val();

            if (payment_mode == '3') { // Cheque
                alert('hicheque');
                $('#chq' + i).show().find('input, select').prop('disabled', false);
                $('#bank' + i).show().find('input, select').prop('disabled', false);
                $('#chqot' + i).hide().find('input, select').prop('disabled', true);
                $('#chqot' + i + ', #chqotiss' + i + ', #chqiss' + i)
                    .hide()
                    .find('input, select')
                    .prop('disabled', true);
            } else if (payment_mode == '2') { // Bank Transfer
                $('#bank' + i).show().find('input, select').prop('disabled', false);
                $('#chq' + i).hide().find('input, select').prop('disabled', true);
                $('#chqot' + i).hide().find('input, select').prop('disabled', true);
                $('#chqot' + i + ', #chqotiss' + i + ', #chqiss' + i)
                    .hide()
                    .find('input, select')
                    .prop('disabled', true);
            } else { // Cash or others
                $('#bank' + i).hide().find('input, select').prop('disabled', true);
                $('#chq' + i).hide().find('input, select').prop('disabled', true);
                $('#chqot' + i).hide().find('input, select').prop('disabled', true);
                $('#chqot' + i + ', #chqotiss' + i + ', #chqiss' + i)
                    .hide()
                    .find('input, select')
                    .prop('disabled', true);
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

    {{-- companywise contractwise units and subunits --}}

    <script>
        let allContracts = @json($contracts);
        let allunittypes = @json($unitTypes);
        let editedContract = @json($agreement->contract ?? null);
        let editedUnit = @json($agreement->agreement_units ?? null);

        let fullContracts = @json($fullContracts ?? []);
        //console.log(fullContracts);

        // let editedUnit = window.editedUnit || [];
        //console.log("edited Unit :" + JSON.stringify(editedUnit))

        $(document).on('change', '#company_id', function() {
            if (editedUnit) {
                // $(this).prop('readonly', true);
                $(this).on('select2:opening', function(e) {
                    e.preventDefault();
                });

            }
            const companyId = $(this).val();

            CompanyChange(companyId, null, editedContract);

        });

        function CompanyChange(companyId, contractId = null, editedContract = null) {
            //console.log("ids3" + companyId, contractId);
            let beneficiary = $('#company_id option:selected').text().trim();
            $('#beneficiary').val(beneficiary).prop('readonly', true);
            let options = '<option value="">Select Contract</option>';
            //console.log("Edited Contract:", JSON.stringify(editedContract));


            // Edit
            if (editedContract && editedContract.company_id == companyId) {
                options += `
            <option value="${editedContract.id}" selected>
                ${editedContract.project_code} - ${editedContract.project_number}
            </option>`;
                $('#edited_contract').val(editedContract.id);
            }
            // Edit

            allContracts
                .filter(c => c.company_id == companyId)
                .forEach(c => {
                    options +=
                        `<option value="${c.id}" ${(c.id == contractId) ? 'selected' : ''}>${c.project_code} - ${c.project_number}</option>`;
                    // options += `<option value="${a.id}" ${(a.id == areaVal) ? 'selected' : ''}>${a.area_name}</option>`;
                });
            // if (editedUnit) {
            //     $('#contract_id').html(options).prop('readonly', true);
            //     // $('#contract_id').on('select2:opening', function(e) {
            //     //     e.preventDefault();
            //     // });
            //     contractChange(contractId, editedUnit);

            // } else {
            $('#contract_id').html(options).trigger('change');

            // }
            // contractChange(contractId);

        }

        $(document).on('change', '#contract_id', function() {
            if (editedUnit) {
                // $(this).prop('readonly', true);
                $(this).on('select2:opening', function(e) {
                    e.preventDefault();
                });

            }
            const contractId = $(this).val();
            contractChange(contractId, editedUnit);

        });

        function contractChange(contractId, editedUnit = null) {
            //console.log("full Contracts :", fullContracts);
            let options = '<option value="">Select Unit Type</option>';
            let contract = null;
            if (editedUnit) {
                contract = fullContracts.find(c => c.id == contractId);
                //console.log(contract);

            }
            if (!contract) {
                contract = allContracts.find(c => c.id == contractId);

            }
            selectedContract = contract;

            $('#selctedcontractType').val(contract?.contract_type_id || 0);
            let receivable_sum = contract?.contract_payment_receivables_sum_receivable_amount || 0;
            let payment_count = contract?.contract_payment_receivables_count || 0;
            let number_of_units = contract?.contract_unit?.no_of_units;
            let monthrent = parseFloat(receivable_sum) / (payment_count * number_of_units);

            //console.log('CONTRACT :', selectedContract)

            if (!contract || !contract.contract_unit || !contract.contract_unit.contract_unit_details) {
                // alert('hi');
                $('#unit_type_id').html(options).trigger('change');
                return;
            }
            // if (contract) {
            let unitTypeIds = contract.contract_unit.contract_unit_details.map(d => d.unit_type_id);

            unitTypeIds = [...new Set(unitTypeIds)];
            // }

            let selectedUnitIds = [];

            if (editedUnit && Array.isArray(editedUnit) && editedUnit.length > 0) {
                // alert('hoi');
                //console.log('Edited Units:', editedUnit);
                selectedUnitIds = editedUnit.map(u => u.unit_type_id);
            }
            //console.log('selectedids :' + JSON.stringify(editedUnit));


            allunittypes
                .filter(ut => unitTypeIds.includes(ut.id))
                .forEach(ut => {
                    const isSelected = selectedUnitIds.includes(ut.id) ? 'selected' : '';
                    options += `<option value="${ut.id}" ${isSelected}>${ut.unit_type}</option>`;
                });


            $('#unit_type_id').html(options);
            const selectedUnitTypeId = selectedUnitIds.length ? selectedUnitIds[0] : '';
            $('#unit_type_id')
                .val(selectedUnitIds.length ? selectedUnitIds[0] : '')
                .trigger('change.select2');
            // unitTypeChange(selectedUnitTypeId, editedUnit);
            let agreement = @json($agreement ?? null);


            let contractTypes = @json($contractTypes);
            let selectedContractType = contractTypes.find(ct => ct.id === contract.contract_type_id);
            if ((selectedContractType && selectedContractType.contract_type === 'Direct Fama' && contract?.contract_unit
                    ?.business_type == 2)) {
                unitTypeChange(selectedUnitTypeId, editedUnit);
            }
            if (
                (selectedContractType && selectedContractType.contract_type === 'Fama Faateh') ||
                (selectedContractType && selectedContractType.contract_type === 'Direct Fama' && contract?.contract_unit
                    ?.business_type == 1)
            ) {
                // alert("ff");
                let uniDetails = [];
                console.log('Agreemant :', agreement);
                if (editedUnit && Array.isArray(editedUnit) && editedUnit.length > 0) {
                    unitDetails = editedUnit
                        .filter(u => u.contract_unit_detail)
                        .map(u => u.contract_unit_detail);

                    //console.log('Unit Details (from editedUnit):', unitDetails);
                } else {
                    unitDetails = contract?.contract_unit?.contract_unit_details || [];
                    //console.log("CONTRACT UNITS CHOOSEN :", unitDetails)

                    //console.log('Unit Details (from contract):', unitDetails);
                }
                unit_details = unitDetails;

                // const unitDetails = contract?.contract_unit?.contract_unit_details || [];
                // unit_details = unitDetails;



                let html = `
                            <div class="card-body">
                                <h5 class="mb-3">
                                    <i class="fas fa-door-open text-info"></i> Unit Details - ${selectedContractType.contract_type}
                                </h5>
                        `;

                unitDetails.forEach((u, index) => {
                    const type = allunittypes?.find(t => t.id == u.unit_type_id)?.unit_type || 'Unknown';
                    const subunitCount = u.contract_sub_unit_details?.length || 0;
                    const rent = monthrent;
                    //console.log("uuuuu :", u);

                    html += `
                            <div class=" mb-3  border-info">
                                        <div class="row">


                                            <div class="col-md-3">
                                                <label class="form-label">Unit Number</label>
                                                <select class="form-control select2" name="" id="unit_number_${index}" disabled>
                                                    <option value="${u.id}">${u.unit_number || ''}</option>
                                                </select>
                                                <input type="hidden" name="unit_detail[${index}][contract_unit_details_id]" value="${u.id}">
                                            </div>

                                            <!-- Unit Type -->
                                            <div class="col-md-3">
                                                <label class="form-label">Unit Type</label>
                                                <select class="form-control select2" name="unit_detail[${index}][unit_type_id]" id="unit_type_${index}" disabled>
                                                    <option value="${u.unit_type_id}">${type}</option>
                                                </select>
                                                <input type="hidden" name="unit_detail[${index}][unit_type_id]" value="${u.unit_type_id}">

                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label">Total Subunits</label>
                                                <input type="text" class="form-control" name="total_subunits_${index}"
                                                    value="${subunitCount}" readonly>
                                            </div>

                                            <div class="col-md-3">
                                                <label class="form-label">Rent per month</label>
                                                <input type="text" class="form-control" name="unit_detail[${index}][rent_per_month]"
                                                    value="${rent.toFixed(2)}" readonly>
                                            </div>
                                        </div>
                                    </div>
                        `;
                });

                html += `</div>`;
                $('#unit_details_div_ff')
                    .removeClass('d-none')
                    .html(html);

                $('#unit_details_div_df').addClass('d-none');



            } else if (selectedContractType && selectedContractType.contract_type === 'Direct Fama') {
                if (agreement && agreement.agreement_units && agreement.agreement_units.length > 0) {
                    console.log('Agreemant :', agreement);

                    const agreementUnitId = agreement.agreement_units[0].id;

                    $('#unit_id').val(agreementUnitId);
                }
                $('#unit_details_div_ff').addClass('d-none');
                $('#unit_details_div_df').removeClass('d-none');

            }


            const contract_start = contract?.contract_detail?.start_date ?? '';
            //console.log('Contract Start Date:', contract_start + contract);
            const contract_end = contract?.contract_detail?.end_date ?? '';
            const ct_duration_months = contract?.contract_detail?.duration_in_months ?? 0;
            if (contract_start) {
                const startDateObj = parseDateCustom(contract_start);
                const formattedStart =
                    `${String(startDateObj.getDate()).padStart(2, '0')}-${String(startDateObj.getMonth() + 1).padStart(2, '0')}-${startDateObj.getFullYear()}`;
                $('#start_date').val(formattedStart).prop('readonly', true);
            } else {
                $('#start_date').val('');
            }
            if (contract_end) {
                const endDateObj = parseDateCustom(contract_end);
                const formattedEnd =
                    `${String(endDateObj.getDate()).padStart(2, '0')}-${String(endDateObj.getMonth() + 1).padStart(2, '0')}-${endDateObj.getFullYear()}`;
                $('#end_date').val(formattedEnd).prop('readonly', true);
            } else {
                $('#end_date').val('');
            }
            $('#duration_months').val(ct_duration_months).prop('readonly', true);


            payment_count = contract?.contract_payment_receivables_count ?? 0;
            // $('#no_of_installments option').each(function() {
            //     if ($(this).text().trim() === payment_count.toString().trim()) {
            //         $(this).prop('selected', true);
            //     }
            // });
            // $('#no_of_installments').val(payment_count).trigger('change');
            if (agreement && agreement.agreement_payment) {
                const installmentId = agreement.agreement_payment.installment_id;

                // Loop through options and select the matching one
                $('#no_of_installments option').each(function() {
                    const optionValue = $(this).val();
                    if (parseInt(optionValue) === parseInt(installmentId)) {
                        $(this).prop('selected', true);
                        $('#no_of_installments').trigger('change');
                    }
                });
            } else {
                $('#no_of_installments option').each(function() {
                    const optionText = $(this).text().trim();
                    const countText = payment_count.toString().trim();
                    //console.log(`Comparing option: '${optionText}' with count: '${countText}'`);
                    if (optionText === countText) {
                        $(this).prop('selected', true);
                        // trigger change if needed
                        $('#no_of_installments').trigger('change');
                    }
                });
            }



            // $('#no_of_installments')
            //     .trigger('change');
            // for (let i = 0; i < payment_count; i++) {
            //     $('#payment_amount' + i).val((monthrent).toFixed(2));
            // }

        }
        $(document).on('change', '#unit_type_id', function() {
            const unitTypeId = $(this).val();
            //console.log("gvdgcvgvcvhsd :" + editedUnit)
            unitTypeChange(unitTypeId, editedUnit);
        });

        function unitTypeChange(unitTypeId, editedUnit) {
            let options = '<option value="">Select Unit No</option>';
            let selectedUnitnumbers = [];
            let contractId = $('#contract_id').val();
            let contract = allContracts.find(c => c.id == contractId);
            //console.log('fileteredunitcontract :', contract);

            if (editedUnit && Array.isArray(editedUnit) && editedUnit.length > 0) {
                //console.log("acrualcontracts :", contract)
                // EDIT MODE: contract may not be in allContracts
                selectedUnitnumbers = editedUnit.map(u => u.contract_unit_details_id);

                editedUnit.forEach(u => {
                    if (!unitTypeId || u.unit_type_id == unitTypeId) {
                        const unitNumber = u.contract_unit_detail?.unit_number || '';
                        options += `<option value="${u.contract_unit_details_id}" selected>${unitNumber}</option>`;
                    }
                });
                let filteredUnits = contract.contract_unit.contract_unit_details;
                if (unitTypeId) {
                    filteredUnits = filteredUnits.filter(d => d.unit_type_id == unitTypeId);
                }

                filteredUnits.forEach(ut => {
                    if (!selectedUnitnumbers.includes(ut.id)) {
                        options += `<option value="${ut.id}">${ut.unit_number}</option>`;
                    }
                });
                $('#unit_type0').html(options)
                    .val(selectedUnitnumbers.length ? selectedUnitnumbers[0] : '')
                    .trigger('change.select2');

                unitNumberChange(selectedUnitnumbers, editedUnit);
            } else {
                // NEW MODE: use allContracts for available units


                if (!contract || !contract.contract_unit || !contract.contract_unit.contract_unit_details) {
                    $('#unit_type0').html(options).trigger('change.select2');
                    return;
                }

                let filteredUnits = contract.contract_unit.contract_unit_details;
                if (unitTypeId) {
                    filteredUnits = filteredUnits.filter(d => d.unit_type_id == unitTypeId);
                }

                // filteredUnits.forEach(ut => {
                //     options += `<option value="${ut.id}">${ut.unit_number}</option>`;
                // });
                filteredUnits.forEach(ut => {
                    options += `<option value="${ut.id}">${ut.unit_number}</option>`;
                });

                $('#unit_type0').html(options).trigger('change');
                unitNumberChange();
            }

            // $('#unit_type0').html(options)
            //     .val(selectedUnitnumbers.length ? selectedUnitnumbers[0] : '')
            //     .trigger('change.select2');

            // unitNumberChange(selectedUnitnumbers, editedUnit);
        }

        $(document).on('change', '#unit_type0', function() {
            const unitId = $(this).val();
            // //console.log("unitid", unitId);
            unitNumberChange(unitId, editedUnit);
        });

        // function unitNumberChange(unitId, editedUnit) {
        //     alert("unitnum");
        //     //console.log('unitNumberChange called with ID:', unitId);
        //     let options = '<option value="">Select SubUnit</option>';
        //     let contractId = $('#contract_id').val();
        //     let contract = allContracts.find(c => c.id == contractId);
        //     //console.log("contra", contract);
        //     //console.log("unitid", unitId);
        //     let count = contract?.contract_payment_receivables_count || 0;
        //     let selectedUnit = contract?.contract_unit?.contract_unit_details?.find(u => u.id == unitId);
        //     //console.log('Selected Unit Detail:', selectedUnit);
        //     let selectedSubunit = [];
        //     let subunitId = 0;
        //     //console.log("test", editedUnit);
        //     if (editedUnit && Array.isArray(editedUnit) && editedUnit.length > 0) {
        //         // alert("edit");
        //         if (!editedUnit[0].contract_subunit_detail) {
        //             alert("alertnotsub");
        //             // alert(editedUnit.rent_per_room);
        //             $('#sub_unit_type').html('<option value="">No Subunits Available</option>').trigger('change');
        //             $('#sub_unit_type').prop('required', false);
        //             $('#rent_per_month')
        //                 .val(editedUnit.rent_per_room ?? '')
        //                 .prop('required', true)
        //                 .prop('disabled', true);
        //             calculatepaymentamount(editedUnit.rent_per_room, count);

        //         } else {
        //             alert("sub");
        //             // alert("edit");
        //             editedUnit.forEach(u => {
        //                 subunitId = u.contract_subunit_details_id;
        //                 const subunitNo = u.contract_subunit_detail?.subunit_no || '';
        //                 const unitDetailId = u.contract_subunit_detail?.contract_unit_detail_id;
        //                 //console.log('Details', u.contract_subunit_detail.contract_unit_detail_id, unitId);
        //                 if (unitDetailId == unitId) {
        //                     // alert(subunitNo);
        //                     options += `<option value="${subunitId}" selected>${subunitNo}</option>`;
        //                     selectedSubunit.push(subunitId);
        //                 }
        //             });
        //         }
        //     } else {
        //         alert("edit");

        //         if (!contract || !contract.contract_unit || !contract.contract_unit.contract_unit_details) {
        //             options += `<option value="">No Subunits Available</option>`;
        //             $('#sub_unit_type').html(options).trigger('change');
        //             return;
        //         }
        //         if (!selectedUnit) {
        //             //console.log('No unit found for ID:', unitId);
        //             $('#sub_unit_type').html('<option value="">No Unit Selected</option>').trigger('change');
        //             $('#sub_unit_type').prop('required', false);
        //             $('#rent_per_month').val('').prop('required', false);
        //             return;
        //         }
        //         //console.log("SUBUNIT :", selectedUnit);
        //         alert("select");
        //         // 🔹 If selected unit exists but has no subunits
        //         if (!selectedUnit.contract_sub_unit_details || selectedUnit.contract_sub_unit_details.length === 0) {
        //             //console.log('No subunits found for unit ID:', unitId);
        //             $('#sub_unit_type').html('<option value="">No Subunits Available</option>').trigger('change');
        //             $('#sub_unit_type').prop('required', false);

        //             // ✅ Set rent value when there are no subunits
        //             //console.log("room", selectedUnit.rent_per_room);
        //             $('#rent_per_month')
        //                 .val(selectedUnit.rent_per_room ?? '')
        //                 .prop('required', true)
        //                 .prop('readonly', true);
        //             calculatepaymentamount(selectedUnit.rent_per_room, count);

        //             return;
        //         }

        //     }
        //     // 🔹 Populate subunit options
        //     if (selectedUnit && Array.isArray(selectedUnit.contract_sub_unit_details)) {
        //         selectedUnit.contract_sub_unit_details.forEach(sub => {
        //             // Skip already selected subunits (avoid duplicates)
        //             if (!selectedSubunit.includes(sub.id)) {
        //                 options += `<option value="${sub.id}">${sub.subunit_no}</option>`;
        //             }
        //         });
        //         // return;
        //     }
        //     $('#sub_unit_type').html(options).trigger('change');
        //     $('#sub_unit_type').prop('required', true);
        //     subUnitChange(subunitId, editedUnit);
        // }

        function unitNumberChange(unitId, editedUnit) {
            //console.log('unitNumberChange called with ID:', unitId);
            let options = '<option value="">Select SubUnit</option>';
            let contractId = $('#contract_id').val();
            let contract = allContracts.find(c => c.id == contractId);
            let count = contract?.contract_payment_receivables_count || 0;
            let selectedUnit = contract?.contract_unit?.contract_unit_details?.find(u => u.id == unitId);
            //console.log('Selected Unit Detail:', selectedUnit);
            let selectedSubunit = [];
            let subunitId = 0;
            //console.log("test", contract);
            //console.log("editedUNITunitchage", editedUnit);
            if (editedUnit && Array.isArray(editedUnit) && editedUnit.length > 0) {
                if (!editedUnit[0].contract_subunit_detail) {
                    $('#sub_unit_type').html('<option value="">No Subunits Available</option>').trigger('change');
                    $('#sub_unit_type').prop('required', false);
                    $('#rent_per_month')
                        .val(editedUnit[0].rent_per_month ?? '')
                        .prop('required', true)
                        .prop('readonly', true);
                    calculatepaymentamount(editedUnit[0].rent_per_month, count);
                    return;

                } else {
                    editedUnit.forEach(u => {
                        subunitId = u.contract_subunit_details_id;
                        const subunitNo = u.contract_subunit_detail?.subunit_no || '';
                        // alert(subunitNo);
                        const unitDetailId = u.contract_subunit_detail?.contract_unit_detail_id;
                        //console.log('Details', u.contract_subunit_detail.contract_unit_detail_id, unitId);
                        if (unitDetailId == unitId) {
                            // alert(subunitNo);
                            options += `<option value="${subunitId}" selected>${subunitNo}</option>`;
                            selectedSubunit.push(subunitId);
                        }
                        calculatepaymentamount(editedUnit[0].rent_per_room, count);
                    });
                    // return;
                }
            } else {

                // alert("rent_per_month");

                if (!contract || !contract.contract_unit || !contract.contract_unit.contract_unit_details) {
                    options += `<option value="">No Subunits Available</option>`;
                    $('#sub_unit_type').html(options).trigger('change');
                    return;
                }
                if (!selectedUnit) {
                    //console.log('No unit found for ID:', unitId);
                    $('#sub_unit_type').html('<option value="">No Unit Selected</option>').trigger('change');
                    $('#sub_unit_type').prop('required', false);
                    $('#rent_per_month').val('').prop('required', false);
                    return;
                }
                // 🔹 If selected unit exists but has no subunits
                if (!selectedUnit.contract_sub_unit_details || selectedUnit.contract_sub_unit_details.length === 0) {
                    //console.log('No subunits found for unit ID:', unitId);
                    $('#sub_unit_type').html('<option value="">No Subunits Available</option>').trigger('change');
                    $('#sub_unit_type').prop('required', false);

                    // ✅ Set rent value when there are no subunits
                    $('#rent_per_month')
                        .val(selectedUnit.rent_per_room ?? '')
                        .prop('required', true)
                        .prop('readonly', true);
                    calculatepaymentamount(selectedUnit.rent_per_room, count);

                    return;
                }

            }
            // 🔹 Populate subunit options
            if (selectedUnit && Array.isArray(selectedUnit.contract_sub_unit_details)) {
                selectedUnit.contract_sub_unit_details.forEach(sub => {
                    // Skip already selected subunits (avoid duplicates)
                    if (!selectedSubunit.includes(sub.id)) {
                        options += `<option value="${sub.id}">${sub.subunit_no}</option>`;
                    }
                });
                // return;
            }
            $('#sub_unit_type').html(options).trigger('change');
            $('#sub_unit_type').prop('required', true);
            subUnitChange(subunitId, editedUnit);
        }


        $(document).on('change', '#sub_unit_type', function() {
            const subunitId = $(this).val();
            subUnitChange(subunitId, editedUnit);
        });

        function subUnitChange(subunitId, editedUnit) {
            //console.log("subunitchangeinside:", JSON.stringify(editedUnit));
            let contractId = $('#contract_id').val();
            let contract = allContracts.find(c => c.id == contractId);
            let count = contract?.contract_payment_receivables_count || 0;
            if (editedUnit && editedUnit.length > 0) {
                //console.log("sschanhe", editedUnit);
                const eu = editedUnit[0];
                // alert(eu.rent_per_month);
                // alert(count);
                $('#rent_per_month')
                    .val(eu.rent_per_month)
                    .prop('required', true)
                    .prop('readonly', true);
                // calculatepaymentamount(eu.rent_per_month, count);
                $('#total_rent_per_annum').text(editedUnit[0]['rent_per_annum_agreement']);
                $('#total_rent_annum').val(editedUnit[0]['rent_per_annum_agreement']);
                return;


            }





            if (!contract || !contract.contract_unit || !contract.contract_unit.contract_unit_details) {
                $('#rent_per_month').val('').prop('required', false).prop('disabled', false);
                return;
            }

            // Get selected unit first
            let unitId = $('#unit_type0').val();
            let selectedUnit = contract.contract_unit.contract_unit_details.find(u => u.id == unitId);
            //console.log('Selected Unit Detail for Rent Calculation:', selectedUnit);

            if (!selectedUnit) {
                $('#rent_per_month').val('').prop('required', false).prop('disabled', false);
                return;
            }

            // If no subunit is selected, clear rent
            if (!subunitId) {
                $('#rent_per_month').val('').prop('required', false).prop('disabled', false);
                return;
            }

            // 🔹 Find the selected subunit inside the selected unit
            let selectedSubUnit = selectedUnit.contract_sub_unit_details.find(su => su.id == subunitId);
            //console.log('Selected SubUnit Detail:', selectedSubUnit);

            if (!selectedSubUnit) {
                $('#rent_per_month').val('').prop('required', false).prop('disabled', false);
                return;
            }
            if (selectedSubUnit.subunit_type == 1) {
                $('#rent_per_month')
                    .val(selectedUnit.rent_per_partition ?? '')
                    .prop('required', true)
                    .prop('readonly', true);
                // alert(selectedUnit.rent_per_partition);
                calculatepaymentamount(selectedUnit.rent_per_partition, count)

            }
            if (selectedSubUnit.subunit_type == 2) {
                $('#rent_per_month')
                    .val(selectedUnit.rent_per_bedspace ?? '')
                    .prop('required', true)
                    .prop('readonly', true);
                calculatepaymentamount(selectedUnit.rent_per_bedspace, count)

            }
            if (selectedSubUnit.subunit_type == 3) {
                $('#rent_per_month')
                    .val(selectedUnit.rent_per_room ?? '')
                    .prop('required', true)
                    .prop('readonly', true);
                calculatepaymentamount(selectedUnit.rent_per_room, count)

            }


        }
    </script>
    {{-- end  --}}


    <script>
        $('#no_of_installments').on('change', function() {
            // alert("called");
            let editedPayment = @json($agreement->agreement_payment ?? null);
            if (editedPayment) {
                //console.log('editedpayment', editedPayment);
            }
            $('.payment_details').show();
            $('.payment_details').removeClass('d-none');
            const installments = $(this).find('option:selected').text().trim();
            let interval = $(this).find(':selected').data('interval');


            $('#interval').val(interval);
            const containerPayment = document.getElementsByClassName('payment_details')[0];
            //console.log(containerPayment);
            const oldValues = [];
            containerPayment.querySelectorAll('.payment_mode_div').forEach((block, i) => {
                const amountInput = block.querySelector(`#payment_amount${i}`);
                oldValues[i] = amountInput ? amountInput.value : '';
            });
            const prevFbBlocks = containerPayment.querySelectorAll('.payment_mode_div');
            prevFbBlocks.forEach(block => block.remove());
            //console.log(selectedContract);
            if (window.selectedContract && (selectedContract.contract_type_id == 2 || (
                    selectedContract.contract_type_id === 1 && selectedContract?.contract_unit
                    ?.business_type == 1))) {
                // alert("ff inst");
                const containerPayment = document.querySelector('.payment_details');

                $(containerPayment).find('.fama-table, #accordion').remove();
                $('.header-row').removeClass('d-none').addClass('d-flex');
                $('#total_rent_per_annum').text(selectedContract.contract_rentals
                    .rent_receivable_per_annum);
                $('#total_rent_annum').val(selectedContract.contract_rentals
                    .rent_receivable_per_annum);
                // alert(selectedContract.contract_rentals
                //     .rent_receivable_per_annum);

                const total_units = selectedContract.contract_unit.no_of_units;
                // alert(total_units);
                const famaTable = document.createElement('div');
                famaTable.classList.add('fama-table', 'mt-3', 'd-flex', 'justify-content-center', 'mt-3',
                    'row');

                let tableHTML = `
                        <table class="table table-bordered table-sm table-info col-md-6">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Due Date</th>
                                    <th>Amount</th>
                                    <th>Adjusted Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                    `;

                if (selectedContract.contract_payment_receivables && selectedContract
                    .contract_payment_receivables
                    .length > 0) {
                    console.log("selected contract receivables", selectedContract);
                    selectedContract.contract_payment_receivables.forEach((r, index) => {
                        tableHTML += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${r.receivable_date ?? '-'}</td>
                        <td class="receivable_amount${index}">${r.receivable_amount ?? 0}</td>
                        <td class="amountchange" data-installment="${index}">${r.receivable_amount ?? 0}</td>
                    </tr>
                `;
                    });
                } else {
                    tableHTML += `
                <tr>
                    <td colspan="4" class="text-center text-muted">No receivables found for this contract.</td>
                </tr>
                `;
                }

                tableHTML += `
                            </tbody>
                        </table>
                    `;

                famaTable.innerHTML = tableHTML;
                containerPayment.appendChild(famaTable);
                //console.log(unit_details)

                // ====== Unit-wise Accordion Section ======
                if (editedPayment && editedUnit) {
                    // alert("hiffagreemanet   ");
                    //console.log("edited payment: ", editedPayment);
                    //console.log("edited unit: ", editedUnit);

                    const containerPayment = document.querySelector('.payment_details');
                    const accordion = document.createElement('div');
                    accordion.id = 'accordion';

                    // Extract payment details
                    const paymentDetails = editedPayment.agreement_payment_details || [];
                    //console.log(paymentDetails);
                    // const installmentCount = editedPayment
                    //     .installment_id;

                    // Loop through units
                    editedUnit.forEach((unitObj, unitIndex) => {
                        const unit = unitObj;
                        //console.log("unit :", unit);

                        const collapseId = `collapse_${unit.id}`;
                        const unitName = unit.contract_unit_detail.unit_number || `Unit ${unitIndex + 1}`;


                        //console.log("unit :", unit);

                        // Get payments for this specific unit
                        const unitPayments = paymentDetails.filter(
                            pay => pay.agreement_unit_id === unit.id
                        );
                        //console.log("Payment Details :", unitPayments);

                        let installmentBlocks = `
                            <div class="row font-weight-bold mb-2">
                                <div class="col-md-4">Payment Mode</div>
                                <div class="col-md-4">Payment Date</div>
                                <div class="col-md-4">Payment Amount</div>
                            </div>
                        `;

                        // Loop through payments
                        unitPayments.forEach((pay, payIndex) => {
                            const uniqueId = `${unit.id}_${payIndex}`;
                            //console.log("unitpay", unitPayments);

                            const formattedDate = pay.payment_date ?
                                moment(pay.payment_date, 'YYYY-MM-DD').format('DD-MM-YYYY') :
                                '';
                            //console.log(pay.payment_date);

                            //console.log(formattedDate);


                            installmentBlocks += `
                                    <div class="form-group row mb-2">
                                        <input type="hidden" name="payment_detail[${unit.id}][${payIndex}][detail_id]" value="${pay.id}">
                                        <div class="col-md-4">
                                            <select class="form-control select2" name="payment_detail[${unit.id}][${payIndex}][payment_mode_id]" id="payment_mode${uniqueId}">
                                                <option value="">Select</option>
                                                @foreach ($paymentmodes as $paymentmode)
                                                    <option value="{{ $paymentmode->id }}" ${pay.payment_mode_id == {{ $paymentmode->id }} ? 'selected' : ''}>
                                                        {{ $paymentmode->payment_mode_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="input-group date" id="otherPaymentDate_${uniqueId}" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input otherPaymentDate"
                                                    name="payment_detail[${unit.id}][${payIndex}][payment_date]"
                                                    id="payment_date_${uniqueId}"
                                                    value="${formattedDate}"
                                                    data-target="#otherPaymentDate_${uniqueId}" placeholder="dd-mm-YYYY"  />
                                                <div class="input-group-append" data-target="#otherPaymentDate_${uniqueId}" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="text" class="form-control"
                                                id="payment_amount_${uniqueId}"
                                                name="payment_detail[${unit.id}][${payIndex}][payment_amount]"
                                                value="${pay.payment_amount ?? ''}"
                                                placeholder="Payment Amount" />
                                        </div>
                                    </div>

                                    <div class="form-group row extra-fields" id="extra_fields_${uniqueId}">
                                        <div class="col-md-4 bank" id="bank_${uniqueId}">
                                            <label>Bank Name</label>
                                            <select class="form-control select2" name="payment_detail[${unit.id}][${payIndex}][bank_id]" id="bank_name_${uniqueId}">
                                                <option value="">Select bank</option>
                                                @foreach ($banks as $bank)
                                                    <option value="{{ $bank->id }}" ${pay.bank_id == {{ $bank->id }} ? 'selected' : ''}>
                                                        {{ $bank->bank_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3 chq" id="chq_${uniqueId}">
                                            <label>Cheque No</label>
                                            <input type="text" class="form-control" id="cheque_no_${uniqueId}"
                                                name="payment_detail[${unit.id}][${payIndex}][cheque_number]"
                                                value="${pay.cheque_number ?? ''}"
                                                placeholder="Cheque No">
                                        </div>
                                    </div>
                                `;
                        });

                        accordion.innerHTML += `
                                <div class="card card-info">
                                    <div class="card-header d-flex justify-content-between">
                                        <div class="card-title">
                                            <a class="w-100 text-white" data-toggle="collapse" href="#${collapseId}" aria-expanded="true">
                                                Unit No : ${unitName}
                                            </a>
                                        </div>
                                    </div>
                                    <div id="${collapseId}" class="collapse show" data-parent="#accordion">
                                        <div class="card-body bg-light">
                                            ${installmentBlocks}
                                        </div>
                                    </div>
                                </div>
                            `;
                    });

                    containerPayment.appendChild(accordion);
                    $(accordion).find('.select2').select2();

                    // Initialize dates and hide/show extras
                    setTimeout(() => {
                        editedUnit.forEach(unitObj => {
                            const unit = unitObj;
                            const unitPayments = paymentDetails.filter(p => p.agreement_unit_id ===
                                unit.id);
                            unitPayments.forEach((_, payIndex) => {
                                const uniqueId = `${unit.id}_${payIndex}`;
                                $(`#otherPaymentDate_${uniqueId}`).datetimepicker({
                                    format: 'DD-MM-YYYY'
                                });
                                paymentModeChangeFF(unit.id, payIndex);
                            });
                        });
                    }, 200);

                    editedUnit.forEach((unit) => {
                        for (let i = 0; i < installments; i++) {
                            const uniqueId = `${unit.id}_${i}`;

                            $(`#otherPaymentDate_${uniqueId}`).datetimepicker({
                                format: 'DD-MM-YYYY'
                            });

                            $(`#otherPaymentDate_${uniqueId} input`).attr('readonly', true).off(
                                'focus');
                            $(`#otherPaymentDate_${uniqueId} .input-group-append`).removeAttr(
                                'data-toggle');
                            hidePayments(i);

                            $('#payment_mode' + uniqueId).change(function() {
                                paymentModeChangeFF(unit.id, i);
                            });

                            $('#otherPaymentDate_' + uniqueId).on('input change', function() {
                                calculatePaymentDatesFF(unit.id, i);
                            });

                            paymentModeChangeFF(unit.id, i);
                        }
                    });
                    //console.log("selectedcontract :", selectedContract);

                    initPaymentValidation(selectedContract.contract_type_id, selectedContract.contract_unit
                        .business_type);
                    $('input[name^="payment_detail"][name$="[payment_amount]"]').each(function() {
                        $(this).trigger('input.paymentValidation');
                    });
                } else {
                    if (window.unit_details && window.unit_details.length > 0) {
                        const containerPayment = document.querySelector('.payment_details');
                        const accordion = document.createElement('div');
                        accordion.id = 'accordion';
                        //console.log('rent receivable per annum:' + selectedContract);
                        const installmentCount = $(this).find('option:selected').text().trim();
                        window.unit_details.forEach((unit, unitIndex) => {

                            //console.log('unit', unit);

                            const collapseId = `collapse_${unit.id}`;
                            const unitName = unit.unit_number || `Unit ${unitIndex + 1}`;

                            // const unitRev = parseFloat(selectedContract.contract_rentals
                            //     .rent_receivable_per_annum);
                            // const amount_per_month = (unitRev / (installmentCount * total_units)).toFixed(2);
                            const rev = parseFloat(unit.unit_revenue);

                            // alert(rev);
                            let monthlyrent = 0;
                            if (selectedContract.contract_type_id == 2) {

                                monthlyrent = (rev / installmentCount).toFixed(2);
                                // alert(monthlyrent);

                            } else if (selectedContract.contract_type_id === 1 && selectedContract
                                ?.contract_unit
                                ?.business_type == 1) {
                                // alert("dfb2b");
                                if (unit.partition) {
                                    monthlyrent = parseFloat(unit.total_partition * unit.rent_per_partition)
                                        .toFixed(2);
                                } else if (unit.bedspace) {
                                    monthlyrent = parseFloat(unit.total_bedspace * unit.rent_per_bedspace)
                                        .toFixed(2);
                                } else if (unit.room) {
                                    monthlyrent = parseFloat(unit.total_room * unit.rent_per_room)
                                } else {
                                    monthlyrent = parseFloat(unit.rent_per_flat)
                                }


                            }



                            let installmentBlocks = `
                                        <div class="row font-weight-bold mb-2">
                                            <div class="col-md-4">Payment Mode</div>
                                            <div class="col-md-4">Payment Date</div>
                                            <div class="col-md-4">Payment Amount</div>
                                        </div>
                                    `;

                            // Loop installments for each unit


                            for (let i = 0; i < installmentCount; i++) {
                                const uniqueId = `${unit.id}_${i}`;


                                // 🗓️ Get the receivable date safely
                                const rawDate = selectedContract.contract_payment_receivables?.[i]
                                    ?.receivable_date;
                                const receivableDate = rawDate ? moment(rawDate, 'DD-MM-YYYY').format(
                                    'DD-MM-YYYY') : '';
                                installmentBlocks += `
                                <div class="form-group row mb-2">
                                    <div class="col-md-4">
                                        <select class="form-control select2" name="payment_detail[${unit.id}][${i}][payment_mode_id]" id="payment_mode${uniqueId}" required>
                                            <option value="">Select</option>
                                            @foreach ($paymentmodes as $paymentmode)
                                                 <option value="{{ $paymentmode->id }}"
                                                    {{ $paymentmode->id == 2 ? 'selected' : '' }}>
                                                    {{ $paymentmode->payment_mode_name }}
                                                </option>

                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="input-group date" id="otherPaymentDate_${uniqueId}" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input otherPaymentDate"
                                                name="payment_detail[${unit.id}][${i}][payment_date]" id="payment_date_${uniqueId}" value="${receivableDate}"
                                                data-target="#otherPaymentDate_${uniqueId}" placeholder="dd-mm-YYYY"  />
                                            <div class="input-group-append" data-target="#otherPaymentDate_${uniqueId}" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <input type="text" class="form-control"
                                            id="payment_amount_${uniqueId}"
                                            name="payment_detail[${unit.id}][${i}][payment_amount]"
                                            value="${monthlyrent}"
                                            placeholder="Payment Amount" />
                                    </div>
                                </div>

                                <div class="form-group row extra-fields" id="extra_fields_${uniqueId}">
                                    <div class="col-md-4 bank" id="bank_${uniqueId}">
                                        <label>Bank Name</label>
                                        <select class="form-control select2" name="payment_detail[${unit.id}][${i}][bank_id]" id="bank_name_${uniqueId}">
                                            <option value="">Select bank</option>
                                            @foreach ($banks as $bank)
                                                <option value="{{ $bank->id }}">{{ $bank->bank_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3 chq" id="chq_${uniqueId}">
                                        <label>Cheque No</label>
                                        <input type="text" class="form-control" id="cheque_no_${uniqueId}" name="payment_detail[${unit.id}][${i}][cheque_number]" placeholder="Cheque No">
                                    </div>
                                </div>
                            `;
                            }

                            let revenueHtml = '';
                            if (selectedContract.contract_type_id == 2) {
                                revenueHtml = `<div class="px-3">Revenue: AED ${rev ?? 0}</div>`;
                            }


                            // Accordion block
                            accordion.innerHTML += `
                            <div class="card card-info">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="card-title">
                                        <a class="w-100 text-white" data-toggle="collapse" href="#${collapseId}" aria-expanded="true">
                                            Unit No : ${unitName}
                                        </a>
                                    </div>
                                    ${revenueHtml}
                                </div>
                                <div id="${collapseId}" class="collapse show" data-parent="#accordion">
                                    <div class="card-body bg-light">
                                        ${installmentBlocks}
                                    </div>
                                </div>
                            </div>
                        `;
                        });

                        containerPayment.appendChild(accordion);
                        $(accordion).find('.select2').select2();

                        setTimeout(() => {
                            window.unit_details.forEach((unit) => {
                                for (let i = 0; i < installmentCount; i++) {
                                    const uniqueId = `${unit.id}_${i}`;

                                    paymentModeChangeFF(unit.id, i);
                                }
                            });
                        }, 300);
                        // Initialize dynamic elements
                        window.unit_details.forEach((unit) => {
                            for (let i = 0; i < installmentCount; i++) {
                                const uniqueId = `${unit.id}_${i}`;

                                $(`#otherPaymentDate_${uniqueId}`).datetimepicker({
                                    format: 'DD-MM-YYYY'
                                });

                                $(`#otherPaymentDate_${uniqueId} input`).attr('readonly', true).off(
                                    'focus');
                                $(`#otherPaymentDate_${uniqueId} .input-group-append`).removeAttr(
                                    'data-toggle');
                                hidePayments(i);

                                $('#payment_mode' + uniqueId).change(function() {
                                    paymentModeChangeFF(unit.id, i);
                                });

                                $('#otherPaymentDate_' + uniqueId).on('input change', function() {
                                    calculatePaymentDatesFF(unit.id, i);
                                });

                                paymentModeChangeFF(unit.id, i);
                            }
                        });

                        initPaymentValidation(selectedContract.contract_type_id, selectedContract.contract_unit
                            .business_type);
                        // After populating amounts dynamically, trigger validation for all inputs
                        $('input[name^="payment_detail"][name$="[payment_amount]"]').each(function() {
                            $(this).trigger('input.paymentValidation');
                        });



                    }
                }


                // $('#submitBtn').prop('disabled', false);
                return;
            } else {

                //console.log('agree', editedPayment);
                const containerPayment = document.querySelector('.payment_details');

                $(containerPayment).find('.fama-table, #accordion').remove();
                $('.header-row').removeClass('d-none').addClass('d-flex');

                // if (editedPayment && Array.isArray(editedPayment.agreement_payment_details)) {
                //     editedPayment.agreement_payment_details.forEach((pay, i) => {

                //         const formattedDate = pay.payment_date ? moment(pay.payment_date, 'YYYY-MM-DD')
                //             .format('DD-MM-YYYY') : '';

                //         const paymentBlock = document.createElement('div');
                //         paymentBlock.classList.add('payment_mode_div');

                //         paymentBlock.innerHTML = `
            //     <input type="hidden" name="payment_detail[${i}][id]" value="${pay.id}">

            //     <div class="form-group row">
            //         <div class="col-md-4">
            //             <label>Payment Mode</label>
            //             <select class="form-control select2" name="payment_detail[${i}][payment_mode_id]" id="payment_mode${i}" required>
            //                 <option value="">Select</option>
            //                 @foreach ($paymentmodes as $paymentmode)
            //                     <option value="{{ $paymentmode->id }}" ${pay.payment_mode_id == {{ $paymentmode->id }} ? 'selected' : ''}>
            //                         {{ $paymentmode->payment_mode_name }}
            //                     </option>
            //                 @endforeach
            //             </select>
            //         </div>

            //         <div class="col-md-4">
            //             <label>Payment Date</label>
            //             <div class="input-group date" id="otherPaymentDate${i}" data-target-input="nearest">
            //                 <input type="text" class="form-control datetimepicker-input otherPaymentDate"
            //                     name="payment_detail[${i}][payment_date]" id="payment_date${i}"
            //                     value="${formattedDate}" data-target="#otherPaymentDate${i}" placeholder="dd-mm-YYYY" />
            //                 <div class="input-group-append" data-target="#otherPaymentDate${i}" data-toggle="datetimepicker">
            //                     <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            //                 </div>
            //             </div>
            //         </div>

            //         <div class="col-md-4">
            //             <label>Payment Amount</label>
            //             <input type="text" class="form-control" name="payment_detail[${i}][payment_amount]" value="${pay.payment_amount}">
            //         </div>
            //     </div>

            //     <div class="form-group row">
            //         <div class="col-md-4 bank" id="bank${i}">
            //             <label>Bank Name</label>
            //             <select class="form-control select2" name="payment_detail[${i}][bank_id]" id="bank_name${i}">
            //                 <option value="">Select Bank Name</option>
            //                 @foreach ($banks as $bank)
            //                     <option value="{{ $bank->id }}" ${pay.bank_id == {{ $bank->id }} ? 'selected' : ''}>{{ $bank->bank_name }}</option>
            //                 @endforeach
            //             </select>
            //         </div>

            //         <div class="col-md-3 chq" id="chq${i}">
            //             <label>Cheque No</label>
            //             <input type="text" class="form-control" value="${pay.cheque_number || ''}" name="payment_detail[${i}][cheque_number]" id="cheque_no${i}" placeholder="Cheque No">
            //         </div>


            //     </div>
            // `;

                //         // Append block
                //         containerPayment.appendChild(paymentBlock);

                //         // Initialize select2 / datepicker / validation
                //         initPaymentValidation(selectedContract.contract_type_id, selectedContract
                //             .contract_unit.business_type);

                //         $('#otherPaymentDate' + i).datetimepicker({
                //             format: 'DD-MM-YYYY'
                //         });

                //         hidePayments(i);


                //         // Then apply the right visibility logic
                //         setTimeout(() => {
                //             paymentModeChange(i);
                //         }, 50);

                //         // Attach change event for user interaction
                //         $('#payment_mode' + i).change(function() {
                //             paymentModeChange(i);
                //         });

                //         // Recalculate dates
                //         $('#otherPaymentDate' + i).on('input change', function() {
                //             calculatePaymentDates();
                //         });


                //     });
                // }
                const newInstallments = $(this).find('option:selected').text().trim();
                if (editedPayment && Array.isArray(editedPayment.agreement_payment_details)) {
                    // Grab existing payment details if any
                    let existingPayments = [];
                    if (editedPayment && Array.isArray(editedPayment.agreement_payment_details)) {
                        existingPayments = editedPayment.agreement_payment_details;
                    }

                    const oldInstallments = existingPayments.length;

                    // Remove extra blocks if newInstallments < oldInstallments
                    if (newInstallments < oldInstallments) {
                        const blocks = containerPayment.querySelectorAll('.payment_mode_div');
                        for (let i = blocks.length - 1; i >= newInstallments; i--) {
                            blocks[i].remove();
                        }
                    }

                    // Loop through installments and create/update payment blocks
                    for (let i = 0; i < newInstallments; i++) {
                        const pay = existingPayments[i] || {};
                        const formattedDate = pay.payment_date ? moment(pay.payment_date, 'YYYY-MM-DD').format(
                            'DD-MM-YYYY') : '';

                        let paymentBlock = containerPayment.querySelector(`#payment_block_${i}`);
                        if (!paymentBlock) {
                            paymentBlock = document.createElement('div');
                            paymentBlock.classList.add('payment_mode_div');
                            paymentBlock.id = `payment_block_${i}`;
                            containerPayment.appendChild(paymentBlock);
                        }

                        paymentBlock.innerHTML = `
                    <input type="hidden" name="payment_detail[${i}][id]" value="${pay.id || ''}">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label>Payment Mode ${i + 1}</label>
                            <select class="form-control select2" name="payment_detail[${i}][payment_mode_id]" id="payment_mode${i}" required>
                                <option value="">Select</option>
                                @foreach ($paymentmodes as $paymentmode)
                                    <option value="{{ $paymentmode->id }}" ${pay.payment_mode_id == {{ $paymentmode->id }} ? 'selected' : ''}>
                                        {{ $paymentmode->payment_mode_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>Payment Date</label>
                            <div class="input-group date" id="otherPaymentDate${i}" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input otherPaymentDate"
                                    name="payment_detail[${i}][payment_date]" id="payment_date${i}"
                                    value="${formattedDate}" data-target="#otherPaymentDate${i}" placeholder="dd-mm-YYYY" />
                                <div class="input-group-append" data-target="#otherPaymentDate${i}" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label>Payment Amount</label>
                            <input type="text" class="form-control" id="payment_amount_${i}" name="payment_detail[${i}][payment_amount]" value="${pay.payment_amount || ''}" placeholder="Payment Amount" />
                        </div>
                    </div>
                     <div class="form-group row">
                        <div class="col-md-4 bank" id="bank${i}">
                        <label>Bank Name</label>
                        <select class="form-control select2" name="payment_detail[${i}][bank_id]" id="bank_name${i}">
                            <option value="">Select Bank Name</option>
                            @foreach ($banks as $bank)
                                <option value="{{ $bank->id }}" ${pay.bank_id == {{ $bank->id }} ? 'selected' : ''}>{{ $bank->bank_name }}</option>
                            @endforeach
                        </select>
                        </div>

                        <div class="col-md-3 chq" id="chq${i}">
                            <label>Cheque No</label>
                            <input type="text" class="form-control" value="${pay.cheque_number || ''}" name="payment_detail[${i}][cheque_number]" id="cheque_no${i}" placeholder="Cheque No">
                        </div>


                    </div>
                `;

                        // Initialize Select2 and Datepicker AFTER appending to DOM
                        $(paymentBlock).find('.select2').select2();
                        initPaymentValidation(selectedContract.contract_type_id, selectedContract.contract_unit
                            .business_type);

                        // Trigger validation immediately for loaded amounts
                        $('input[name^="payment_detail"][name$="[payment_amount]"]').each(function() {
                            $(this).trigger('input');
                        });

                        $(`#otherPaymentDate${i}`).datetimepicker({
                            format: 'DD-MM-YYYY'
                        });

                        // // Bind change event to payment mode
                        // $(paymentBlock).find(`#payment_mode${i}`).off('change').on('change', function() {
                        //     paymentModeChange(i);
                        // });

                        // // Initial visibility setup
                        // paymentModeChange(i);

                        hidePayments(i);


                        // Then apply the right visibility logic
                        setTimeout(() => {
                            paymentModeChange(i);
                        }, 50);

                        // Attach change event for user interaction
                        $('#payment_mode' + i).change(function() {
                            paymentModeChange(i);
                        });
                    }



                } else {
                    // alert("DFFFFFF");
                    for (let i = 0; i < installments; i++) {

                        const paymentBlock = document.createElement('div');
                        paymentBlock.classList.add('payment_mode_div');
                        const rawDate = selectedContract.contract_payment_receivables?.[i]
                            ?.receivable_date;
                        const receivableDate = rawDate ? moment(rawDate, 'DD-MM-YYYY').format(
                            'DD-MM-YYYY') : '';
                        const existingValue = oldValues[i] || '';

                        paymentBlock.innerHTML = `

                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label>Payment Mode</label>
                                        <select class="form-control select2" name="payment_detail[${i}][payment_mode_id]" id="payment_mode${i}" required>
                                            <option value="">Select</option>
                                            @foreach ($paymentmodes as $paymentmode)
                                            <option value="{{ $paymentmode->id }}">
                                            {{ $paymentmode->payment_mode_name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Payment Date</label>
                                        <div class="input-group date" id="otherPaymentDate${i}" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input otherPaymentDate"
                                                name="payment_detail[${i}][payment_date]" id="payment_date${i}" value="${receivableDate}"
                                                data-target="#otherPaymentDate${i}" placeholder="dd-mm-YYYY" />
                                            <div class="input-group-append" data-target="#otherPaymentDate${i}" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Payment Amount</label>
                                        <input type="text" class="form-control" id="payment_amount${i}" name="payment_detail[${i}][payment_amount]" value="${existingValue}" placeholder="Payment Amount">
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <div class="col-md-4 bank" id="bank${i}">
                                            <label for="exampleInputEmail1">Bank Name</label>
                                            <select class="form-control select2" name="payment_detail[${i}][bank_id]" id="bank_name${i}">
                                                <option value="">Select Bank Name</option>
                                                @foreach ($banks as $bank)
                                            <option value="{{ $bank->id }}">
                                                    {{ $bank->bank_name }} </option>
                                        @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3 chq" id="chq${i}">
                                            <label for="exampleInputEmail1">Cheque No</label>
                                            <input type="text" class="form-control" id="cheque_no${i}" name="payment_detail[${i}][cheque_number]" placeholder="Cheque No">
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
                            `;

                        // Append first
                        containerPayment.appendChild(paymentBlock);
                        initPaymentValidation(selectedContract.contract_type_id, selectedContract.contract_unit
                            .business_type);


                        $('#otherPaymentDate' + i).datetimepicker({
                            format: 'DD-MM-YYYY'
                        });

                        // attachEventsPayment(paymentBlock, i);
                        hidePayments(i);

                        $('#payment_mode' + i).change(function() {
                            paymentModeChange(i);
                        });



                        $('#otherPaymentDate0').on('input change', function() {
                            calculatePaymentDates();
                        });


                    }

                }

            }



        });
    </script>
    <script>
        function initPaymentValidation(type, business_type) {
            //console.log(type, business_type);
            $(document).off('input.paymentValidation');

            $(document).on('input.paymentValidation', 'input[name^="payment_detail"][name$="[payment_amount]"]',
                function() {
                    if (type === 2 || (type === 1 && business_type === 1)) {
                        const name = $(this).attr('name');
                        const match = name.match(/payment_detail\[\d+\]\[(\d+)\]\[payment_amount\]/);
                        if (!match) return;
                        const changedIndex = parseInt(match[1]);
                        validateTotalPaymentFF(changedIndex);
                    } else if (type === 1) {
                        validateTotalPayment();
                    }

                });
        }


        function validateTotalPayment() {
            let totalRent = parseFloat($('#total_rent_per_annum').text()) || 0;
            let totalPayment = 0;

            // Sum all payment amounts
            $('input[name^="payment_detail"][name$="[payment_amount]"]').each(function() {
                let val = parseFloat($(this).val()) || 0;
                totalPayment += val;
            });

            // // Enable or disable submit button
            // if (totalPayment === totalRent && totalRent > 0) {
            //     $('#submitBtn').prop('disabled', false);
            // } else {
            //     $('#submitBtn').prop('disabled', true);
            //     toastr.error(` Total payment amount ${totalPayment} does not match total rent per annum ${totalRent}.`,
            //         `Check Payments`);
            // }
            const errorDiv = $('#paymentError');
            errorDiv.attr('tabindex', '-1');

            // Enable or disable submit button
            if (totalPayment === totalRent && totalRent > 0) {
                $('#submitBtn').prop('disabled', false);
                errorDiv.addClass('d-none').removeClass('d-flex'); // hide error
            } else {
                $('#submitBtn').prop('disabled', true);
                errorDiv.html(
                    `Total payment amount <span class="mx-1 text-dark">${totalPayment}</span> does not match total rent per annum <span class="mx-1 text-dark">${totalRent}</span>.`
                );
                errorDiv.removeClass('d-none').addClass('d-flex'); // show error
                // errorDiv.focus();
                errorDiv[0].scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        }


        // function validateTotalPaymentFF(changedIndex = null) {
        //     // alert(changedIndex);
        //     const totalsByInstallment = {};

        //     // Sum all
        //     $('input[name^="payment_detail"][name$="[payment_amount]"]').each(function() {
        //         const name = $(this).attr('name');
        //         const match = name.match(/payment_detail\[\d+\]\[(\d+)\]/);
        //         if (!match) return;

        //         const installmentIndex = parseInt(match[1]);
        //         const val = parseFloat($(this).val()) || 0;

        //         if (!totalsByInstallment[installmentIndex]) {
        //             totalsByInstallment[installmentIndex] = 0;
        //         }
        //         totalsByInstallment[installmentIndex] += val;
        //     });
        //     // //console.log(totalsByInstallment);

        //     // Validate only changed installment (if specified)
        //     const keysToCheck = changedIndex !== null ? [changedIndex] : Object.keys(totalsByInstallment);
        //     //console.log(keysToCheck);

        //     keysToCheck.forEach(index => {
        //         const total = totalsByInstallment[index]?.toFixed(2) || 0;
        //         // //console.log('index' + index);
        //         const $amountCell = $(`.amountchange[data-installment="${index}"]`);
        //         const receivable = parseFloat($(`.receivable_amount${index}`).text()) || 0;
        //         // //console.log('receivable' + receivable)

        //         // Update cell
        //         $amountCell.text(total);
        //         // //console.log("gy" + receivable + total);
        //         const errorDiv = $('#paymentError');
        //         errorDiv.attr('tabindex', '-1');

        //         if (receivable == total) {
        //             $amountCell.css({
        //                 backgroundColor: '#d4edda',
        //                 color: '#155724'
        //             });
        //             $('#submitBtn').prop('disabled', false);
        //             errorDiv.addClass('d-none').removeClass('d-flex');
        //         } else {
        //             $amountCell.css({
        //                 backgroundColor: '#f8d7da',
        //                 color: '#721c24'
        //             });
        //             $('#submitBtn').prop('disabled', true);
        //             // errorDiv.html(
        //             //     // `Total payment amount <span class="mx-1 text-dark">${totalPayment}</span> does not match total rent per annum <span class="mx-1 text-dark">${totalRent}</span>.`
        //             //     `Installment <span class="mx-1 text-dark">${parseInt(index) + 1}</span>: Total <span class="mx-1 text-dark">(${total})</span> is not equal to Receivable <span class="mx-1 text-dark">(${receivable})</span>`
        //             // );
        //             // errorDiv.removeClass('d-none').addClass('d-flex'); // show error
        //             // // errorDiv.focus();
        //             // errorDiv[0].scrollIntoView({
        //             //     behavior: 'smooth',
        //             //     block: 'center'
        //             // });
        //             toastr.options = {
        //                 "closeButton": true,
        //                 "progressBar": true,
        //                 timeOut: 5000,
        //                 extendedTimeOut: 2000
        //             };
        //             toastr.error(
        //                 `Installment ${parseInt(index) + 1}: Total (${total}) is not equal to Receivable (${receivable})`
        //             );
        //             console.warn(`Installment ${index}: mismatch → total=${total}, receivable=${receivable}`);


        //         }
        //     });
        // }
        function validateTotalPaymentFF(changedIndex = null) {
            const totalsByInstallment = {};
            const errorDiv = $('#paymentError');
            let errorMessages = []; // collect all errors

            $('input[name^="payment_detail"][name$="[payment_amount]"]').each(function() {
                const name = $(this).attr('name');
                const match = name.match(/payment_detail\[\d+\]\[(\d+)\]/);
                if (!match) return;

                const installmentIndex = parseInt(match[1]);
                const val = parseFloat($(this).val()) || 0;

                if (!totalsByInstallment[installmentIndex]) {
                    totalsByInstallment[installmentIndex] = 0;
                }
                totalsByInstallment[installmentIndex] += val;
            });

            // const keysToCheck = changedIndex !== null ? [changedIndex] : Object.keys(totalsByInstallment);
            const keysToCheck = Object.keys(totalsByInstallment);

            keysToCheck.forEach(index => {
                const total = totalsByInstallment[index]?.toFixed(2) || 0;
                const $amountCell = $(`.amountchange[data-installment="${index}"]`);
                const receivable = parseFloat($(`.receivable_amount${index}`).text()) || 0;

                $amountCell.text(total);

                if (receivable == total) {
                    $amountCell.css({
                        backgroundColor: '#d4edda',
                        color: '#155724'
                    });
                } else {
                    $amountCell.css({
                        backgroundColor: '#f8d7da',
                        color: '#721c24'
                    });

                    // Add to error list
                    // errorMessages.push(
                    //     `Installment ${parseInt(index) + 1}: Total (${total}) is not equal to Receivable (${receivable})`
                    // );
                    errorMessages.push(
                        `Installment <span class="text-dark">${parseInt(index) + 1}</span>: Total <span class="text-dark">(${total})</span> is not equal to Receivable <span class="text-dark">(${receivable})</span>`
                    );
                }
            });

            if (errorMessages.length > 0) {
                $('#submitBtn').prop('disabled', true);
                errorDiv.html(errorMessages.join('<br>')) // show all errors
                    .removeClass('d-none')
                    .addClass('d-block');
            } else {
                $('#submitBtn').prop('disabled', false);
                errorDiv.addClass('d-none').removeClass('d-block').empty();
            }
        }

        // function validateTotalPaymentFF() {
        //     const totalsByInstallment = {};

        //     // Loop through all inputs
        //     $('input[name^="payment_detail"][name$="[payment_amount]"]').each(function() {
        //         const name = $(this).attr('name');
        //         const match = name.match(/payment_detail\[\d+\]\[(\d+)\]\[payment_amount\]/);
        //         if (!match) return;

        //         const installmentIndex = parseInt(match[1]);
        //         const val = parseFloat($(this).val()) || 0;

        //         if (!totalsByInstallment[installmentIndex]) {
        //             totalsByInstallment[installmentIndex] = 0;
        //         }
        //         totalsByInstallment[installmentIndex] += val;
        //     });

        //     // Validate all installments
        //     Object.keys(totalsByInstallment).forEach(index => {
        //         const total = totalsByInstallment[index].toFixed(2);

        //         // Select all cells for this installment
        //         const $amountCell = $(`.amountchange[data-installment="${index}"]`);
        //         const receivable = parseFloat($(`.receivable_amount${index}`).text()) || 0;

        //         if (Math.abs(receivable - total) < 0.01) { // small tolerance for float
        //             $amountCell.css({
        //                 backgroundColor: '#d4edda',
        //                 color: '#155724'
        //             });
        //         } else {
        //             $amountCell.css({
        //                 backgroundColor: '#f8d7da',
        //                 color: '#721c24'
        //             });
        //         }
        //     });

        //     // Update error div separately for summary
        //     const errors = Object.keys(totalsByInstallment).filter(index => {
        //         const total = totalsByInstallment[index].toFixed(2);
        //         const receivable = parseFloat($(`.receivable_amount${index}`).text()) || 0;
        //         return Math.abs(receivable - total) >= 0.01;
        //     });

        //     if (errors.length) {
        //         $('#submitBtn').prop('disabled', true);
        //         $('#paymentError').html(`Mismatch in Installments: ${errors.map(i => parseInt(i)+1).join(', ')}`)
        //             .removeClass('d-none').addClass('d-flex');
        //     } else {
        //         $('#submitBtn').prop('disabled', false);
        //         $('#paymentError').addClass('d-none').removeClass('d-flex');
        //     }

        // }


        function paymentModeChangeFF(unitId, i) {
            const uniqueId = `${unitId}_${i}`;
            const payment_mode = $(`#payment_mode${uniqueId}`).val();

            if (payment_mode == '3') { // Cheque
                $(`#chq_${uniqueId}`).show().find('input, select').prop('disabled', false).prop('required', true);
                $(`#bank_${uniqueId}`).show().find('input, select').prop('disabled', false).prop('required', true);
            } else if (payment_mode == '2') { // Bank Transfer
                $(`#bank_${uniqueId}`).show().find('input, select').prop('disabled', false).prop('required', true);
                $(`#chq_${uniqueId}`).hide().find('input, select').prop('disabled', true);
            } else { // Cash or others
                $(`#bank_${uniqueId}`).hide().find('input, select').prop('disabled', true);
                $(`#chq_${uniqueId}`).hide().find('input, select').prop('disabled', true);
            }
        }

        function calculatePaymentDatesFF(unitId, startIndex) {
            const uniqueIdStart = `${unitId}_${startIndex}`;
            const startDateVal = $(`#otherPaymentDate_${uniqueIdStart}`).find("input").val();

            const noOfInstallments = parseInt($('#no_of_installments').find('option:selected').text().trim()) || 0;
            const interval = parseInt($('#interval').val()) || 1;

            const startDate = parseDateCustom(startDateVal);
            if (!startDate || isNaN(startDate.getTime())) return;

            $(document).off('change.datetimepicker.autoCalc');

            for (let i = startIndex + 1; i < noOfInstallments; i++) {
                const nextId = `${unitId}_${i}`;
                const nextPicker = $(`#otherPaymentDate_${nextId}`);

                if (nextPicker.length === 0) continue;

                const nextDate = new Date(startDate);
                nextDate.setMonth(startDate.getMonth() + (interval * (i - startIndex)));

                const year = nextDate.getFullYear();
                const month = String(nextDate.getMonth() + 1).padStart(2, '0');
                const day = String(nextDate.getDate()).padStart(2, '0');
                const formattedDate = `${day}-${month}-${year}`;

                nextPicker.datetimepicker('date', moment(formattedDate, 'DD-MM-YYYY'));
            }

            // rebind after done
            $(document).on('change.datetimepicker.autoCalc', '.otherPaymentDate', function() {
                const idParts = this.id.split('_');
                const unitId = idParts[1];
                const index = parseInt(idParts[2]);
                calculatePaymentDatesFF(unitId, index);
            });
        }
    </script>
@endsection
