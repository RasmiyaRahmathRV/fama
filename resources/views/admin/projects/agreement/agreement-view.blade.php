@extends('admin.layout.admin_master')
@section('custom_css')
@endsection
@section('content')
    @php
        $business_type = ' - ';
        $type = $agreement->contract->contract_unit->business_type;
        if ($type == 1) {
            $business_type = 'B2B';
        } else {
            $business_type = 'B2C';
        }

    @endphp
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Installment details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Installment details</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            {{-- {{ dd($agreement->contract->contract_type_id) }} --}}
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">


                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                            <span
                                class="{{ 'badge badge-danger ' . ($agreement->contract->contract_type_id == 1 ? 'price-badge-df ' : 'price-badge-ff') }}">
                                {{ $agreement->contract->contract_type->contract_type }} Project
                            </span>

                            <!-- title row -->

                            <!-- info row -->
                            <div class="row invoice-info p-2">
                                <div class="col-sm-6">
                                    <h5 class="font-weight-bold text-primary mb-2">Vendor Details</h5>
                                    <address>
                                        <span class="project_id">P - {{ $agreement->contract->project_number }}</span></br>
                                        <span
                                            class="vendor_name">{{ strtoupper($agreement->contract->vendor->vendor_name) }}</span></br>
                                        <span
                                            class="name">{{ strtoupper($agreement->contract->company->company_name) }}</span></br>
                                        <span
                                            class="mobile">{{ strtoupper($agreement->contract->vendor->vendor_phone) }}</span></br>
                                        <span class="email">{{ $agreement->contract->vendor->vendor_email }}</span></br>
                                        <span class="area">{{ strtoupper($agreement->contract->area->area_name) }}</span>,
                                        <span
                                            class="locality">{{ strtoupper($agreement->contract->locality->locality_name) }}</span>,
                                        <span
                                            class="building">{{ strtoupper($agreement->contract->property->property_name) }}
                                            -
                                            @foreach ($agreement->agreement_units as $unit)
                                                {{ strtoupper($unit->contractUnitDetail->unit_number) }}@if (!$loop->last)
                                                    ,
                                                @endif
                                            @endforeach
                                        </span></br>

                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6 float-xl-right">
                                    <span class="float-xl-right">
                                        <h5 class="font-weight-bold text-success mb-2">Tenant Details -
                                            <span class="text-danger">{{ $business_type }}</span>
                                        </h5>
                                        <address>
                                            <span
                                                class="vendor_name">{{ strtoupper($agreement->tenant->tenant_name) }}</span></br>
                                            <span class="mobile">{{ $agreement->tenant->tenant_mobile }}</span></br>
                                            <span class="email">{{ $agreement->tenant->tenant_email }}</span></br>
                                            <span
                                                class="area">{{ strtoupper($agreement->contract->area->area_name) }}</span>,
                                            <span
                                                class="locality">{{ strtoupper($agreement->contract->locality->locality_name) }}</span>,
                                            <span class="building">
                                                {{ strtoupper($agreement->contract->property->property_name) }}
                                                -
                                                @foreach ($agreement->agreement_units as $unit)
                                                    {{ strtoupper($unit->contractUnitDetail->unit_number) }}@if (!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                            </span></br>
                                            <span
                                                class="start_date">{{ \Carbon\Carbon::parse($agreement->start_date)->format('d/m/Y') }}</span>
                                            - <span
                                                class="end_date">{{ \Carbon\Carbon::parse($agreement->end_date)->format('d/m/Y') }}</span></br>
                                            {{-- <span class="unit_type">
                                                @foreach ($agreement->agreement_units as $unit)
                                                    {{ strtoupper($unit->contractUnitDetail->unit_type->unit_type) }}
                                                    @if (!$loop->last)
                                                        ,
                                                    @endif
                                                @endforeach
                                            </span>
                                            - <span class="inst_mode">12 /
                                                Bank</span></br> --}}
                                        </address>
                                    </span>
                                </div>
                            </div>
                            <!-- /.row -->

                            <div id="unitAccordion">
                                @foreach ($agreement->agreement_units as $unit)
                                    @php
                                        $isFirst = $loop->first; // true for the first unit
                                    @endphp
                                    <div class="card mb-2">
                                        <!-- Accordion Header -->
                                        <div class="card-header agreement-accordion" id="heading{{ $unit->id }}">
                                            <h5 class="mb-0">
                                                <button
                                                    class="btn btn-link text-uppercase font-weight-bold text-blue collapsed d-flex justify-content-between w-100"
                                                    type="button" data-toggle="collapse"
                                                    data-target="#collapse{{ $unit->id }}" aria-expanded="false"
                                                    aria-controls="collapse{{ $unit->id }}">
                                                    <span>
                                                        UNIT: {{ $unit->contractUnitDetail->unit_number }}
                                                        <span class="ml-3 text-green font-weight-bold">
                                                            Type:
                                                            {{ $unit->contractUnitDetail->unit_type->unit_type ?? '-' }}
                                                            @if ($unit->contractSubunitDetail)
                                                                @if ($unit->contractSubunitDetail->subunit_type == 1)
                                                                    | Partition:
                                                                @elseif ($unit->contractSubunitDetail->subunit_type == 2)
                                                                    | Bedspace:
                                                                @elseif ($unit->contractSubunitDetail->subunit_type == 3)
                                                                    | Room:
                                                                @else
                                                                    | Full Flat:
                                                                @endif
                                                                {{ $unit->contractSubunitDetail->subunit_no }}
                                                            @endif
                                                            | Rent/Month: {{ number_format($unit->rent_per_month, 2) }}
                                                            | Rent/Annum:
                                                            {{ number_format($unit->rent_per_annum_agreement, 2) }}
                                                        </span>
                                                    </span>
                                                    <span class="arrow">&#9654;</span>
                                                </button>

                                            </h5>
                                        </div>

                                        <!-- Accordion Body -->
                                        <div id="collapse{{ $unit->id }}"
                                            class="collapse {{ $isFirst ? 'show' : '' }}"
                                            aria-labelledby="heading{{ $unit->id }}" data-parent="#unitAccordion">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table mb-1">
                                                        <thead>
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>Payment Mode</th>
                                                                <th>Amount</th>
                                                                <th>Favouring</th>
                                                                <th>Paid On</th>
                                                                <th>Paid Amount</th>
                                                                <th>Status of Termination</th>
                                                                <th>Composition</th>
                                                                <th>Invoice Upload</th>
                                                                <th>View Invoice</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($agreement->agreement_payment->agreementPaymentDetails->where('agreement_unit_id', $unit->id) as $detail)
                                                                @php
                                                                    $bgColor = match ($detail->is_payment_received) {
                                                                        0 => '#ffcccc',
                                                                        1 => '#dbffdb',
                                                                        2 => '#c5f5ff',
                                                                        3 => '#fff5c5',
                                                                        default => '',
                                                                    };
                                                                @endphp
                                                                <tr>
                                                                    <td
                                                                        style="background-color: {{ $bgColor }} !important;">
                                                                        {{ \Carbon\Carbon::parse($detail->payment_date)->format('d/m/Y') }}
                                                                    </td>
                                                                    <td
                                                                        style="background-color: {{ $bgColor }} !important;">
                                                                        {{ $detail->paymentMode->payment_mode_name }}
                                                                        @if (!empty($detail->bank_id))
                                                                            - {{ ucfirst($detail->bank->bank_name) }}
                                                                        @endif
                                                                        @if (!empty($detail->cheque_number))
                                                                            - {{ ucfirst($detail->cheque_number) }}
                                                                        @endif
                                                                    </td>
                                                                    <td
                                                                        style="background-color: {{ $bgColor }} !important;">
                                                                        {{ number_format($detail->payment_amount, 2) }}
                                                                    </td>
                                                                    <td
                                                                        style="background-color: {{ $bgColor }} !important;">
                                                                        {{ $agreement->agreement_payment->beneficiary }}
                                                                    </td>
                                                                    <td
                                                                        style="background-color: {{ $bgColor }} !important;">
                                                                        {{ $detail->paid_date ?? '-' }}
                                                                    </td>
                                                                    <td
                                                                        style="background-color: {{ $bgColor }} !important;">
                                                                        {{ number_format($detail->paid_amount, 2) ?? '-' }}
                                                                    </td>
                                                                    <td
                                                                        style="background-color: {{ $bgColor }} !important;">
                                                                        @if ($detail->terminate_status == 0)
                                                                            <span class="badge bg-success">Active</span>
                                                                        @else
                                                                            <span class="badge bg-danger">Terminated</span>
                                                                        @endif
                                                                    </td>

                                                                    <td
                                                                        style="background-color: {{ $bgColor }} !important;">
                                                                        RENT
                                                                        {{ $loop->iteration }}/{{ $agreement->agreement_payment->installment->installment_name }}
                                                                    </td>
                                                                    @can('agreement.invoice_upload')
                                                                        <td>
                                                                            <button type="button"
                                                                                class="btn btn-success btn-sm open-invoice-modal"
                                                                                title="Upload Invoice"
                                                                                data-detailId="{{ $detail->id }}"
                                                                                data-agreementId="{{ $agreement->id }}"
                                                                                @if ($detail->invoice) data-invoiceid="{{ $detail->invoice->id }}" @endif
                                                                                {{ $detail->terminate_status != 0 ? 'disabled' : '' }}><i
                                                                                    class="fas fa-file-upload"></i></a>

                                                                        </td>
                                                                    @endcan
                                                                    <td>
                                                                        @if ($detail->invoice)
                                                                            @php
                                                                                $filePath = asset(
                                                                                    'storage/' .
                                                                                        $detail->invoice->invoice_path,
                                                                                );

                                                                            @endphp

                                                                            <a href="{{ $filePath }}" target="_blank"
                                                                                class="btn btn-primary btn-sm"
                                                                                title="View Invoice">
                                                                                <i class="fas fa-file-pdf"></i> View
                                                                            </a>
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </td>

                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>

                                                    @php
                                                        $total_paid = 0;
                                                        $total_to_pay = 0;
                                                        foreach (
                                                            $agreement->agreement_payment->agreementPaymentDetails->where(
                                                                'agreement_unit_id',
                                                                $unit->id,
                                                            )
                                                            as $detail
                                                        ) {
                                                            $total_to_pay += toNumeric($detail->payment_amount);
                                                            $total_paid += toNumeric($detail->paid_amount);
                                                        }
                                                        $remaining_amount = $total_to_pay - $total_paid;
                                                    @endphp
                                                    <div class="float-right">
                                                        <span><strong>Total Received:</strong>
                                                            {{ number_format($total_paid, 2) }}</span><br>
                                                        <span><strong>Remaining:</strong>
                                                            {{ number_format($remaining_amount, 2) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>





                            <!-- /.row -->

                            <!-- this row will not appear when printing -->
                            <div class="row no-print mt-2">
                                <div class="col-12 d-xl-flex justify-content-between">
                                    <a href="{{ route('agreement.index') }}" class="btn btn-info"><i
                                            class="fas mr-2 fa-arrow-left"></i>Back</a>

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
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i>
                                                        </div>
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


    <div class="modal fade" id="modal-invoiceUpload">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Upload Invoice</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="uploadForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-form-label">Upload Invoice File</label>
                                <input type="file" name="invoice_path" id="" class="form-control"
                                    accept=".pdf,.jpg,.jpeg,.png" required>
                                <div class="invalid-feedback"></div>
                            </div>

                        </div>
                    </div>
                    <input type="hidden" name="agreement_id" id="agreement_id">
                    <input type="hidden" name="detail_id" id="detail_id">
                    <input type="hidden" name="invoice_id" id="invoice_id">

                    <!-- /.card-body -->
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info terminate-btn uploadBtn">Save changes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('custom_js')
    <script>
        $(document).on('click', '.open-invoice-modal', function(e) {
            e.preventDefault();
            const agreementId = $(this).data('agreementid');
            const detailId = $(this).data('detailid');
            const invoiceId = $(this).data('invoiceid');
            $('#agreement_id').val(agreementId);
            $('#detail_id').val(detailId);
            $('#invoice_id').val(invoiceId);

            $('#modal-invoiceUpload').modal('show');
        });
    </script>
    <script>
        $('.uploadBtn').click(function(e) {
            e.preventDefault();
            const uploadBtn = $(this);
            var form = document.getElementById('uploadForm');
            var fdata = new FormData(form);

            // Clear previous errors
            $('#uploadForm .form-control').removeClass('is-invalid');
            $('#uploadForm .invalid-feedback').text('');

            // Front-end required validation for file
            const fileInput = $('#uploadForm [name="invoice_path"]');
            if (!fileInput.val()) {
                fileInput.addClass('is-invalid');
                fileInput.siblings('.invalid-feedback').text('Invoice file is required.');
                return;
            }

            uploadBtn.prop('disabled', true);

            $.ajax({
                url: "{{ url('agreement-invoice-upload') }}/",
                type: 'POST',
                data: fdata,
                processData: false,
                contentType: false,
                success: function(response) {
                    toastr.success(response.message);
                    $('#modal-invoiceUpload').modal('hide');
                    window.location.reload();
                },
                error: function(xhr) {
                    uploadBtn.prop('disabled', false);
                    const response = xhr.responseJSON;
                    if (xhr.status === 422 && response?.errors) {
                        $.each(response.errors, function(key, messages) {
                            const input = $('#uploadForm [name="' + key + '"]');
                            input.addClass('is-invalid');
                            input.siblings('.invalid-feedback').text(messages[0]);
                        });
                    } else if (response.message) {
                        toastr.error(response.message);
                    }
                }
            });
        });
    </script>
@endsection
