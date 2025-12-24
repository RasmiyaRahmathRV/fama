@extends('admin.layout.admin_master')

@section('custom_css')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('assets/select2/css/select2.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('assets/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <!-- DataTables -->
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

        <section class="content">
            <div class="container-fluid">
                <h5 class="mb-2">Info Box</h5>
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-money-bill-wave"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Investment Amount</span>
                                <span class="info-box-number">{{ number_format($investment->investment_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-success"><i class="fas fa-check-circle"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Received</span>
                                <span
                                    class="info-box-number">{{ number_format($investment->total_received_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="fas fa-hourglass-half"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Pending Amount</span>
                                <span class="info-box-number">{{ number_format($investment->balance_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger"><i class="fas fa-chart-line"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Profit</span>
                                <span class="info-box-number">{{ number_format($investment->profit_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#investment"
                                            data-toggle="tab">Investment</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link " href="#investor"
                                            data-toggle="tab">Investor</a></li>

                                    <li class="nav-item"><a class="nav-link" href="#received-history"
                                            data-toggle="tab">Received History</a>
                                    </li>
                                    {{-- {{ dd() }} --}}

                                    @if (isset($investment->investmentReferral) && $investment->investmentReferral != null)
                                        <li class="nav-item"><a class="nav-link" href="#referral" data-toggle="tab">Referral
                                                Details</a>
                                        </li>
                                    @endif

                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class=" tab-pane" id="investor">
                                        @include('admin.investment.investment.partials.view-investor', [
                                            'investment' => $investment,
                                        ])
                                    </div>
                                    <!-- /.tab-pane -->

                                    <div class=" active tab-pane" id="investment">
                                        @include('admin.investment.investment.partials.view-investment', [
                                            'investment' => $investment,
                                            'document' => $investment->investmentDocument,
                                        ])
                                    </div>
                                    <!-- /.tab-pane -->

                                    <div class="tab-pane" id="received-history">
                                        @include('admin.investment.investment.partials.view-received', [
                                            'received' => $investment->investmentReceivedPayments,
                                        ])
                                    </div>
                                    <!-- /.tab-pane -->


                                    {{-- <div class="tab-pane" id="document">
                                        @include('admin.investment.investment.partials.view-document', [
                                            'document' => $investment->investmentDocument,
                                        ])
                                    </div> --}}
                                    <!-- /.tab-pane -->
                                    @if (isset($investment->investmentReferral) && $investment->investmentReferral != null)
                                        <div class="tab-pane" id="referral">
                                            @include('admin.investment.investment.partials.view-referral', [
                                                'referral' => $investment->investmentReferral,
                                                'referrer' => $investment->investmentReferral->referrer,
                                            ])
                                        </div>
                                    @endif
                                    <!-- /.tab-pane -->

                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- /.content-wrapper -->
    </div>
@endsection
@section('custom_js')
    <script src="{{ asset('assets/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('assets/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/daterangepicker/daterangepicker.js') }}"></script>
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
@endsection
