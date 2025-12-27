@extends('admin.layout.admin_master')

@section('custom_css')
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('assets/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('assets/icheck-bootstrap/icheck-bootstrap.min.css') }}">
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
                        <h1>Investor Payout</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active">Investor Payout</li>
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

                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="card card-info">
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form class="form-horizontal">
                                        <div class="form-group row m-4">
                                            <div class="col-md-3">
                                                <label for="inputPassword3">Month</label>
                                                <select class="form-control select2" name="area_id">
                                                    <option value="">Select Month</option>
                                                    <?php for ($m = 1; $m <= 12; ++$m) { ?>
                                                    <option value="1"><?= date('F', mktime(0, 0, 0, $m, 1)) ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="inputPassword3">Batch</label>
                                                <select class="form-control select2" name="area_id">
                                                    <option value="">Select Batch</option>
                                                    @foreach ($payoutbatches as $payoutbatch)
                                                        <option value="{{ $payoutbatch->id }}">
                                                            {{ $payoutbatch->batch_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="inputPassword3">Investor</label>
                                                <select class="form-control select2" name="area_id">
                                                    <option value="">Select Investor</option>
                                                    @foreach ($investors as $investor)
                                                        <option value="{{ $investor->id }}">{{ $investor->investor_name }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <!-- </div>
                                                                                                                                                                                                                                                                                                                                                                                                            <div class="form-group"> -->
                                            <div class="col-md-1 float-right mt-31">
                                                <button type="button" class="btn btn-info">Search</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                                <!-- /.card -->
                                <div class="card">
                                    <div class="card-header">
                                        <!-- <h3 class="card-title">Property Details</h3> -->
                                        <span class="float-right">
                                            <!-- <button class="btn btn-info float-right m-1" data-toggle="modal"
                                                                                                                                                                                                                                                                                                                                                                                                            data-target="#modal-Property">Add Investor Payout</button> -->
                                            <button class="btn btn-info float-right m-1 bulktriggerbtn" data-toggle="modal"
                                                data-target="#modal-payout" data-clear-type="bulk">Payout All</button>
                                        </span>
                                    </div>
                                    <div class="card-body">
                                        <table id="payoutPendingTable" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <div class="icheck-primary d-inline">
                                                            <input type="checkbox" name="selectall" id="selectAll"
                                                                value="1" onclick="toggleAllCheckboxes()">
                                                            <label for="selectAll">Select All
                                                            </label>
                                                        </div>
                                                    </th>
                                                    <th>Investor Name</th>
                                                    {{-- <th style="width: 5%">Investment Amount</th> --}}
                                                    <th>Payout Date</th>
                                                    <th>Payout Type</th>
                                                    <th>payout Amount</th>
                                                    <th>Payment Mode</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- <tr>
                                                    <td>
                                                        <div class="icheck-primary d-inline">
                                                            <input type="checkbox" id="ichek1" class="groupCheckbox"
                                                                name="installment_id[]">
                                                            <label for="ichek1">
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>Investor</td>
                                                    <td>AED 1000</td>
                                                    <td>08/08/2024</td>
                                                    <td>AED 1000</td>
                                                    <td>AED 200</td>
                                                    <td>AED 1200</td>
                                                    <td>Bank Transfer</td>
                                                    <td>Fama</td>
                                                    <td>
                                                        <button class="btn btn-info float-right m-1 singleClear"
                                                            data-toggle="modal" data-target="#modal-payout"
                                                            data-clear-type="single">Payout</button> </td>
                                                </tr> --}}
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
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


            <div class="modal fade" id="modal-payout">
                <<div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h4 class="modal-title">Payable Payments</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" id="PaymentSubmitForm" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="method" id="method">
                            <input type="hidden" name="detId" id="detId">
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="exampleInputEmail1">Clearing Date</label>
                                        <div class="input-group date" id="clearingdate" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input"
                                                name="paid_date" data-target="#clearingdate" placeholder="dd-mm-YYYY"
                                                required />
                                            <div class="input-group-append" data-target="#clearingdate"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row clrngamnt">
                                        <label for="exampleInputEmail1">Payout Amount</label>
                                        <input type="number" class="form-control" name="paid_amount" id="paid_amount"
                                            placeholder="Clearing Amount" required min="0" step="1">
                                        <span id="amountPending" class="text-danger text-sm"></span>
                                    </div>
                                    <div class="form-group row">
                                        @foreach ($paymentmodes as $paymentmode)
                                            @php
                                                $class = '';
                                                if ($paymentmode->id == 2) {
                                                    $class = 'bank';
                                                } elseif ($paymentmode->id == 3) {
                                                    $class = 'chq';
                                                }
                                            @endphp
                                            <div class="icheck-primary {{ $class }} mr-1">
                                                <input type="checkbox" id="{{ $paymentmode->payment_mode_code }}"
                                                    class="singleClear"
                                                    value="{{ $paymentmodes->where('id', 2)->first()->id ?? '' }}"
                                                    name="paid_mode">
                                                <label
                                                    for="{{ $paymentmode->payment_mode_code }}">{{ $paymentmode->payment_mode_name ?? '' }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group banksingle">
                                        <label for="exampleInputEmail1">Bank Name</label>
                                        <select class="form-control select2 bank_name" name="paid_bank" id="bank_name"
                                            required>
                                            <option value="">Select Bank</option>
                                            @foreach ($banks as $bank)
                                                <option value="{{ $bank->id }}">{{ $bank->bank_name }} </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group row modechange">
                                        <label for="exampleInputEmail1">Remarks</label>
                                        <textarea name="payment_remarks" id="" cols="10" rows="5" class="form-control"></textarea>
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
    <!-- /.modal-dialog -->
    </div>
@endsection


@section('custom_js')
    <!-- Select2 -->
    <script src="{{ asset('assets/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/moment/moment.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('assets/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-buttons/js/buttons.colVis.min.js') }}"></script>


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


        function toggleAllCheckboxes() {
            document.getElementById('selectAll').addEventListener('change', function() {
                const itemCheckboxes = document.querySelectorAll('.groupCheckbox');
                itemCheckboxes.forEach(checkbox => {
                    checkbox.checked = this
                        .checked; // Set checked status based on the "Select All" checkbox
                });
            });
        }

        $(document).ready(function() {
            // $('#PayableList').DataTable();
            hidelemnetsonload();
        });

        function hidelemnetsonload() {
            $('.banksingle, .cheque, .modechange').hide();
        }

        $('.singleClear').on('change', function() {
            $('.singleClear').not(this).prop('checked', false);

            if ($(this).prop('checked')) {
                $('.banksingle').show();
                $('.modechange').show();
                if ($(this).val() == 2) {
                    $('.cheque').hide();
                } else {
                    $('.cheque').show();
                }
            } else {
                $('.banksingle').hide();
                $('.cheque').hide();
                $('.modechange').hide();
            }
        });

        $('#bankBulk').click(function() {
            if ($(this).prop('checked')) {
                $('.banksingle').show();
            } else {
                $('.banksingle').hide();
            }
        });

        $('.bulktriggerbtn').click(function(e) {
            e.preventDefault();
            if ($('.groupCheckbox:checked').length === 0) {
                toastr.error('Please select one or more items to continue.');
                return false;
            } else {
                $('#modal-clear-payable').show();
            }
        });



        $('#modal-payout').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var clearType = button.data('clear-type'); // Extract info from data-* attributes
            $('#PaymentSubmitForm')[0].reset();
            hidelemnetsonload();

            $(this).find('input, select, textarea').removeClass('is-invalid is-valid');

            $('#method').val(clearType);

            // $('.modechange').hide();
            if (clearType === 'bulk') {

                $('.clrngamnt').hide();
                $('.chq').hide().css('display', 'none', 'important');
            } else {
                $('#detId').val(button.data('det-id'));

                let totalAmount = button.data('amount');
                document.getElementById('paid_amount').addEventListener('input', function() {
                    let paid = parseFloat(this.value) || 0;
                    // Prevent entering more than total amount
                    if (paid > totalAmount) {
                        paid = totalAmount;
                        this.value = totalAmount;
                    }

                    let remaining = totalAmount - paid;

                    document.getElementById('amountPending').innerText =
                        'Remaining Amount: ' + remaining;
                });

                $('#amountPending').text('Remaining Amount: ' + button.data('amount'));
                $('.clrngamnt').show();
                $('.chq').show();
            }
        });
    </script>

    <script>
        $(function() {
            let table = $('#payoutPendingTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,

                ajax: {
                    url: "{{ route('payout.pending.list') }}",
                    data: function(d) {
                        d.date_from = $('#date_From').val();
                        d.date_to = $('#date_To').val();
                        d.vendor_id = $('#vendor_id').val();
                        d.property_id = $('#property_id').val();
                        d.payment_mode = $('#payment_mode').val();
                    }
                },
                columns: [{
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'investor_name',
                        name: 'investor_name',
                    },
                    // {
                    //     data: 'contract_type',
                    //     name: 'contract_types.contract_type',
                    // },
                    {
                        data: 'payout_date',
                        name: 'payout_date',
                    },
                    {
                        data: 'payout_type',
                        name: 'payout_type',
                    },
                    // {
                    //     data: 'property_name',
                    //     name: 'contract.property.property_name',
                    // },
                    {
                        data: 'payout_amount',
                        name: 'payout_amount',
                    },
                    {
                        data: 'payment_mode',
                        name: 'payment_mode',
                    },
                    // {
                    //     data: 'cheque_no',
                    //     name: 'contract_payment_details.cheque_no',
                    // },
                    // {
                    //     data: 'payment_amount',
                    //     name: 'payment_amount',
                    // },
                    // {
                    //     data: 'composition',
                    //     name: 'composition',
                    // },
                    // {
                    //     data: 'has_returned',
                    //     name: 'has_returned',
                    //     render: function(data, type, row) {
                    //         if (data == 1) {
                    //             return '<span class="badge bg-danger text-white">Returned</span><i class="far fa-comments loadReason pl-1" onclick="loadReason(this)" data-reason="' +
                    //                 row.returned_reason + '"></i>';



                    //         }
                    //         return '-';

                    //     },
                    // },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                rowCallback: function(row, data, index) {
                    // Example: Highlight pending payments
                    console.log(data.has_returned);
                    if (data.has_returned === 1) {
                        console.log(data.has_returned);
                        $(row).css('background-color', '#ffe1e1'); // light red
                    }

                },
                order: [
                    [0, 'desc']
                ],
                dom: 'Bfrtip', // This is important for buttons
                buttons: [{
                    extend: 'excelHtml5',
                    text: 'Export Excel',
                    title: 'Contract Data',
                    action: function(e, dt, node, config) {
                        // redirect to your Laravel export route
                        let searchValue = dt.search();
                        let url = "{{ route('payables.pending.export') }}" + "?search=" +
                            encodeURIComponent(searchValue);
                        window.location.href = url;
                    }
                }]
            });

            // Filter buttons
            $('.filter-btn').on('click', function() {
                let filterValue = $(this).data('filter');

                // Reset ALL buttons
                $('.filter-btn').each(function() {
                    let solidClass = $(this).attr('add-class'); // btn-warning
                    let outlineClass = solidClass ? 'btn-outline-' + solidClass.replace('btn-',
                        '') : '';

                    if (solidClass) {
                        $(this).removeClass(solidClass).addClass(outlineClass);
                    }
                });

                // Apply ACTIVE state to clicked button
                let solidClass = $(this).attr('add-class'); // e.g. btn-warning
                let outlineClass = solidClass ? 'btn-outline-' + solidClass.replace('btn-', '') : '';


                if (solidClass) {
                    $(this).removeClass(outlineClass).addClass(solidClass);
                }

                // Apply DataTable search column filter (status = column index 1)
                table.column(2).search(filterValue).draw();
            });

            $('.searchbtnchq').on('click', function(e) {
                e.preventDefault();
                table.ajax.reload();
            });

        });
    </script>
@endsection
