@extends('admin.layout.admin_master')
@section('custom_css')
@endsection
@section('content')
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
            {{-- {{ dd($agreement->agreement_units) }} --}}
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">


                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">

                            <div class="text-uppercase text-bold text-info">
                                {{ $agreement->contract->contract_type->contract_type }} Project
                            </div>
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
                                <div class="col-sm-6 float-right">
                                    <span class="float-right">
                                        <h5 class="font-weight-bold text-success mb-2">Tenant Details</h5>
                                        <address>
                                            <span
                                                class="vendor_name">{{ strtoupper($agreement->tenant->tenant_name) }}</span></br>
                                            <span class="mobile">{{ $agreement->tenant->tenant_mobile }}</span></br>
                                            <span class="email">{{ $agreement->tenant->tenant_email }}</span></br>
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

                            <!-- Table row -->
                            @foreach ($agreement->agreement_units as $unit)
                                <div class="card">
                                    <div class="row mt-4">
                                        <div class="col-12 pl-4">
                                            <h5 class="mb-2 font-weight-bold text-uppercase text-blue">
                                                UNIT: {{ $unit->contractUnitDetail->unit_number }}
                                            </h5>

                                            <p class="mb-1 text-muted font-weight-bold">
                                                Type: {{ $unit->contractUnitDetail->unit_type->unit_type ?? '-' }} |
                                                @if ($unit->contractSubunitDetail)
                                                    @if ($unit->contractSubunitDetail->subunit_type == 1)
                                                        Partition:
                                                    @elseif ($unit->contractSubunitDetail->subunit_type == 2)
                                                        Bedspace:
                                                    @elseif ($unit->contractSubunitDetail->subunit_type == 3)
                                                        Room:
                                                    @else
                                                        Full Flat:
                                                    @endif
                                                    {{ $unit->contractSubunitDetail->subunit_no }} |
                                                @endif
                                                Rent per Month: {{ number_format($unit->rent_per_month, 2) }} |
                                                Rent per Annum: {{ number_format($unit->rent_per_annum_agreement, 2) }}
                                            </p>
                                            <hr style="margin-top: 8px; margin-bottom: 8px;">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 table-responsive">

                                            <table class="table table-striped mb-1">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Payment Mode</th>
                                                        <th>Amount</th>
                                                        <th>Favouring</th>
                                                        <th>Paid On</th>
                                                        <th>Paid Amount</th>
                                                        <th>Composition</th>
                                                        <!-- <th>Edit</th>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <th>Delete</th>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <th>Bifurcate</th> -->
                                                        <!-- <th>Bifurcate Edit</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($agreement->agreement_payment->agreementPaymentDetails->where('agreement_unit_id', $unit->id) as $index => $detail)
                                                        @php
                                                            $bgColor = '';
                                                            if ($detail->is_payment_received == 0) {
                                                                $bgColor = '#ffcccc';
                                                            } elseif ($detail->is_payment_received == 1) {
                                                                $bgColor = '#dbffdb';
                                                            } elseif ($detail->is_payment_received == 2) {
                                                                $bgColor = '#c5f5ff';
                                                            } elseif ($detail->is_payment_received == 3) {
                                                                $bgColor = '#fff5c5';
                                                            }
                                                        @endphp
                                                        <tr style="background-color: {{ $bgColor }}">
                                                            <td>{{ \Carbon\Carbon::parse($detail->payment_date)->format('d/m/Y') }}
                                                            </td>
                                                            <td>{{ $detail->paymentMode->payment_mode_name }}
                                                                @if (!empty($detail->bank_id))
                                                                    - {!! ucfirst($detail->bank->bank_name) !!}
                                                                @endif
                                                                @if (!empty($detail->cheque_number))
                                                                    - {!! ucfirst($detail->cheque_number) !!}
                                                                @endif
                                                            </td>
                                                            <td>{{ number_format($detail->payment_amount, 2) }}</td>
                                                            <td>{{ $agreement->agreement_payment->beneficiary }}</td>
                                                            <td>{{ $detail->paid_date ?? ' - ' }}</td>
                                                            <td>{{ number_format($detail->paid_amount, 2) ?? ' - ' }}</td>
                                                            <td>RENT {{ $loop->iteration }}
                                                                /
                                                                {{ $agreement->agreement_payment->installment->installment_name }}
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
                                                    as $index => $detail
                                                ) {
                                                    $payment_amount = toNumeric($detail->payment_amount);
                                                    $paid_amount = toNumeric($detail->paid_amount);
                                                    $total_to_pay += $payment_amount;
                                                    $total_paid += $paid_amount;
                                                }

                                                $remaining_amount = $total_to_pay - $total_paid;
                                            @endphp
                                            <div class="float-xl-right mb-1 mr-3">
                                                <span> <strong>Total
                                                        Received:</strong>{{ number_format($total_paid, 2) }}</span><br>
                                                <span>
                                                    <strong>Remaining:</strong>{{ number_format($remaining_amount, 2) }}</span>
                                            </div>

                                        </div>
                                        <!-- /.col -->
                                    </div>

                                </div>
                            @endforeach
                            <!-- /.row -->


                            <!-- /.row -->

                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
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
                                                <select class="form-control select2" name="payment_mode" id="payment_mode">
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
