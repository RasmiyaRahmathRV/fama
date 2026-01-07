@extends('admin.layout.admin_master')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-gradient-projects">

                            <div class="inner">
                                <h3>{{ number_format($wid_totalContracts) }}</h3>

                                <p>Projects</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-folder"></i>
                            </div>
                            <a href="{{ route('contract.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-gradient-investors">

                            <div class="inner">
                                <h3>{{ number_format($wid_totalInvestors) }}<sup style="font-size: 20px"></sup></h3>

                                <p>Investors</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('investor.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-gradient-investments">

                            <div class="inner">
                                <h3>{{ number_format($wid_totalInvestments) }}</h3>

                                <p>Investments</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-briefcase"></i>
                            </div>
                            <a href="{{ route('investment.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-gradient-revenue">

                            <div class="inner">
                                <h3>{{ number_format($wid_revenue, 2) }}</h3>
                                <p>Revenue</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-arrow-graph-up-right"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">Inventory</h3>
                                    {{-- <a href="javascript:void(0);">View Report</a> --}}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    <p class="d-flex flex-column">
                                        <span class="text-bold text-lg">{{ $grandTotal ?? 0 }}</span>
                                        <span>Total Units</span>
                                    </p>
                                    <p class="ml-auto d-flex flex-column text-right">
                                        @if ($trend === 'up')
                                            <span class="text-success">
                                                <i class="fas fa-arrow-up"></i> {{ $percentChange }}%
                                            </span>
                                        @elseif($trend === 'down')
                                            <span class="text-danger">
                                                <i class="fas fa-arrow-down"></i> {{ abs($percentChange) }}%
                                            </span>
                                        @else
                                            <span class="text-warning">No Change</span>
                                        @endif
                                        <span class="text-muted">Compared to last month</span>

                                    </p>

                                </div>
                                <!-- /.d-flex -->

                                <div class="position-relative mb-4">
                                    <canvas id="inventory-chart" height="272"></canvas>
                                </div>

                                <div class="d-flex flex-row justify-content-end">
                                    <span class="mr-2">
                                        <i class="fas fa-square bg-greendf"></i> DF Units
                                    </span>

                                    <span>
                                        <i class="fas fa-square bg-ffred"></i> FF Units
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col-md-6 -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">Investments</h3>
                                    {{-- <a href="javascript:void(0);">View Report</a> --}}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    <p class="d-flex flex-column">
                                        <span class="text-bold text-lg">AED {{ number_format($totalInvestment, 2) }}</span>
                                        <span>Total Investments</span>
                                    </p>
                                    <p class="ml-auto d-flex flex-column text-right">
                                        <span class="text-{{ $arrowUp ? 'success' : 'danger' }}">
                                            <i class="fas fa-arrow-{{ $arrowUp ? 'up' : 'down' }}"></i>
                                            {{ $percentageChange }}%
                                        </span>
                                        <span class="text-muted">Since last month</span>
                                    </p>

                                </div>

                                <!-- Chart -->
                                <div class="position-relative mb-4" style="height: 271px;">
                                    <canvas id="investment-chart"></canvas>
                                </div>

                                <div class="d-flex flex-row justify-content-end">
                                    <span class="mr-2">
                                        <i class="fas fa-square bg-ffred"></i> Investment Amount
                                    </span>
                                    <span>
                                        <i class="fas fa-square bg-greendf"></i> Number of Investments
                                    </span>
                                </div>
                            </div>

                        </div>



                        <!-- /.card -->

                        {{-- <div class="card">
                            <div class="card-header border-0">
                                <h3 class="card-title">Online Store Overview</h3>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-sm btn-tool">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-tool">
                                        <i class="fas fa-bars"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                    <p class="text-success text-xl">
                                        <i class="ion ion-ios-refresh-empty"></i>
                                    </p>
                                    <p class="d-flex flex-column text-right">
                                        <span class="font-weight-bold">
                                            <i class="ion ion-android-arrow-up text-success"></i> 12%
                                        </span>
                                        <span class="text-muted">CONVERSION RATE</span>
                                    </p>
                                </div>
                                <!-- /.d-flex -->
                                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                    <p class="text-warning text-xl">
                                        <i class="ion ion-ios-cart-outline"></i>
                                    </p>
                                    <p class="d-flex flex-column text-right">
                                        <span class="font-weight-bold">
                                            <i class="ion ion-android-arrow-up text-warning"></i> 0.8%
                                        </span>
                                        <span class="text-muted">SALES RATE</span>
                                    </p>
                                </div>
                                <!-- /.d-flex -->
                                <div class="d-flex justify-content-between align-items-center mb-0">
                                    <p class="text-danger text-xl">
                                        <i class="ion ion-ios-people-outline"></i>
                                    </p>
                                    <p class="d-flex flex-column text-right">
                                        <span class="font-weight-bold">
                                            <i class="ion ion-android-arrow-down text-danger"></i> 1%
                                        </span>
                                        <span class="text-muted">REGISTRATION RATE</span>
                                    </p>
                                </div>
                                <!-- /.d-flex -->
                            </div>
                        </div> --}}
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
                {{-- <div class="row">
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-gradient-projects"><i class="far fa-envelope"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Renewals</span>
                                <span class="info-box-number">{{ renewalCount() }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-gradient-investors"><i class="far fa-flag"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Approval Pending</span>
                                <span class="info-box-number">{{ statusCount(4) }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-gradient-investments"><i class="far fa-copy"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Agreemant Expiry</span>
                                <span class="info-box-number">{{ getAgreementExpiringCounts() }} </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- /.col -->
                </div> --}}
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('custom_js')
    <!-- OPTIONAL SCRIPTS -->
    <script src="{{ asset('assets/chart.js/Chart.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{-- <script src="{{ asset('js/pages/dashboard3.js') }}"></script> --}}


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script>
        $(function() {

            var $investmentChart = $('#investment-chart');
            if ($investmentChart.length) {

                if (window.investmentChart) window.investmentChart.destroy();

                window.investmentChart = new Chart($investmentChart, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($labels) !!},
                        datasets: [{
                                type: 'bar',
                                label: 'Investment Amount (AED)',
                                data: {!! json_encode($amounts) !!},
                                backgroundColor: 'rgba(17, 153, 142,0.5)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1,
                                yAxisID: 'y',
                                // barThickness: 40,
                                maxBarThickness: 40,
                                borderRadius: 6
                            },
                            {
                                type: 'line',
                                label: 'No. of Investments',
                                data: {!! json_encode($counts) !!},
                                borderColor: 'rgba(91, 134, 229,1)',
                                backgroundColor: 'rgba(91, 134, 229,1)',
                                fill: false,
                                tension: 0.3,
                                yAxisID: 'y1', // right axis
                                pointBackgroundColor: 'rgba(91, 134, 229,1)',
                                pointBorderColor: 'rgba(91, 134, 229,1)',
                                // pointRadius: 5
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,

                        interaction: {
                            mode: 'index',
                            intersect: false
                        },
                        stacked: false,
                        plugins: {
                            legend: {
                                display: false,
                                position: 'top'
                            },
                            tooltip: {
                                enabled: true
                            }
                        },
                        scales: {
                            y: {
                                type: 'linear',
                                display: true,
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 2000, // desired interval
                                    callback: function(value) {
                                        return value;
                                    }
                                },
                                title: {
                                    display: true,
                                    text: 'Investment Amount (AED)'
                                },
                                suggestedMax: Math.ceil(Math.max(...{!! json_encode($amounts) !!}) / 2000) * 2000
                            },

                            y1: {
                                type: 'linear',
                                display: true,
                                position: 'right',
                                beginAtZero: true,
                                grid: {
                                    drawOnChartArea: false
                                },
                                title: {
                                    display: true,
                                    text: 'No. of Investments'
                                },
                                // optional: max value a bit above highest count
                                suggestedMax: Math.max(...{!! json_encode($counts) !!})
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Month',
                                    font: {
                                        size: 14,
                                        weight: '500'
                                    }
                                },
                                ticks: {
                                    font: {
                                        size: 12
                                    }
                                },
                                grid: {
                                    color: 'rgba(200,200,200,0.1)'
                                }
                            }
                        }
                    }
                });
            }

            var $inventoryChart = $('#inventory-chart');
            if ($inventoryChart.length) {

                if (window.inventoryChart) window.inventoryChart.destroy();

                window.inventoryChart = new Chart($inventoryChart, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($companyNames) !!},

                        datasets: [{
                                label: 'DF Units',
                                data: {!! json_encode($dfUnits) !!},
                                backgroundColor: 'rgba(17, 153, 142,0.5)',
                                // barThickness: 40,
                                borderRadius: 6
                            },
                            {
                                label: 'FF Units',
                                data: {!! json_encode($ffUnits) !!},
                                backgroundColor: 'rgba(91, 134, 229,1)',
                                // barThickness: 40,
                                borderRadius: 6
                            }
                        ]

                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return context.dataset.label + ': ' + context.raw +
                                            ' units';
                                    }
                                }
                            },
                            title: {
                                display: true,
                                text: 'Company-wise Total Units',
                                font: {
                                    size: 16,
                                    weight: '600'
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Number of Units'
                                },
                                grid: {
                                    color: 'rgba(200,200,200,0.2)',
                                    borderDash: [3, 3]
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Companies',
                                    font: {
                                        size: 14,
                                        weight: '500'
                                    }
                                },
                                ticks: {
                                    autoSkip: false,
                                    maxRotation: 45,
                                    minRotation: 0,
                                    font: {
                                        size: 12
                                    }
                                },
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }
        });
        // $(function() {
        //     'use strict'

        //     var ticksStyle = {
        //         fontColor: '#495057',
        //         fontStyle: 'bold'
        //     }

        //     var mode = 'index'
        //     var intersect = false

        //     // Investment Chart
        //     var $investmentChart = $('#investment-chart')
        //     if ($investmentChart.length) {

        //         if (window.investmentChart) window.investmentChart.destroy()

        //         window.investmentChart = new Chart($investmentChart, {
        //             type: 'bar',
        //             data: {
        //                 labels: {!! json_encode($labels) !!},
        //                 datasets: [{
        //                         type: 'bar',
        //                         label: 'Investment Amount (AED)',
        //                         data: {!! json_encode($amounts) !!},
        //                         backgroundColor: '#007bff',
        //                         borderColor: '#007bff',
        //                         borderWidth: 1,
        //                         yAxisID: 'y',
        //                         maxBarThickness: 40,
        //                         borderRadius: 6
        //                     },
        //                     {
        //                         type: 'line',
        //                         label: 'No. of Investments',
        //                         data: {!! json_encode($counts) !!},
        //                         borderColor: '#dc3545',
        //                         backgroundColor: 'rgba(220,53,69,0.2)',
        //                         fill: false,
        //                         tension: 0.3,
        //                         yAxisID: 'y1',
        //                         pointBackgroundColor: '#dc3545',
        //                         pointBorderColor: '#fff',
        //                         pointRadius: 5
        //                     }
        //                 ]
        //             },
        //             options: {
        //                 maintainAspectRatio: false,
        //                 responsive: true,
        //                 tooltips: {
        //                     mode: mode,
        //                     intersect: intersect
        //                 },
        //                 hover: {
        //                     mode: mode,
        //                     intersect: intersect
        //                 },
        //                 legend: {
        //                     display: true,
        //                     position: 'top'
        //                 },
        //                 scales: {
        //                     yAxes: [{
        //                         type: 'linear',
        //                         display: true,
        //                         position: 'left',
        //                         ticks: $.extend({
        //                             beginAtZero: true,
        //                             // stepSize: 1000,
        //                             // suggestedMax: Math.ceil(Math.max(...
        //                             //         {!! json_encode($amounts) !!}) / 2000) *
        //                             //     2000,
        //                             callback: function(value) {
        //                                 return 'AED ' + value;
        //                             }
        //                         }, ticksStyle),
        //                         scaleLabel: {
        //                             display: true,
        //                             labelString: 'Investment Amount (AED)'
        //                         },
        //                         gridLines: {
        //                             display: true,
        //                             lineWidth: 2,
        //                             color: 'rgba(0,0,0,.1)',
        //                             zeroLineColor: 'transparent'
        //                         }
        //                     }],

        //                     yAxesRight: [{
        //                         type: 'linear',
        //                         display: true,
        //                         position: 'right',
        //                         ticks: $.extend({
        //                             beginAtZero: true,
        //                             suggestedMax: Math.max(...{!! json_encode($counts) !!}) *
        //                                 1.5
        //                         }, ticksStyle),
        //                         scaleLabel: {
        //                             display: true,
        //                             labelString: 'No. of Investments'
        //                         },
        //                         gridLines: {
        //                             drawOnChartArea: false
        //                         }
        //                     }],
        //                     xAxes: [{
        //                         display: true,
        //                         ticks: $.extend({
        //                             autoSkip: false,
        //                             maxRotation: 45,
        //                             minRotation: 0
        //                         }, ticksStyle),
        //                         gridLines: {
        //                             display: false
        //                         }
        //                     }]
        //                 }
        //             }
        //         })
        //     }

        //     // Inventory Chart
        //     var $inventoryChart = $('#inventory-chart')
        //     if ($inventoryChart.length) {

        //         if (window.inventoryChart) window.inventoryChart.destroy()

        //         window.inventoryChart = new Chart($inventoryChart, {
        //             type: 'bar',
        //             data: {
        //                 labels: {!! json_encode($companyNames) !!},
        //                 datasets: [{
        //                         label: 'DF Units',
        //                         data: {!! json_encode($dfUnits) !!},
        //                         backgroundColor: '#007bff',
        //                         maxBarThickness: 40,
        //                         borderRadius: 6
        //                     },
        //                     {
        //                         label: 'FF Units',
        //                         data: {!! json_encode($ffUnits) !!},
        //                         backgroundColor: '#dc3545',
        //                         maxBarThickness: 40,
        //                         borderRadius: 6
        //                     }
        //                 ]
        //             },
        //             options: {
        //                 maintainAspectRatio: false,
        //                 responsive: true,
        //                 tooltips: {
        //                     mode: mode,
        //                     intersect: intersect,
        //                     callbacks: {
        //                         label: function(context) {
        //                             return context.dataset.label + ': ' + context.raw + ' units';
        //                         }
        //                     }
        //                 },
        //                 legend: {
        //                     display: true,
        //                     position: 'top'
        //                 },
        //                 scales: {
        //                     yAxes: [{
        //                         beginAtZero: true,
        //                         ticks: $.extend({
        //                             beginAtZero: true
        //                         }, ticksStyle),
        //                         scaleLabel: {
        //                             display: true,
        //                             labelString: 'Number of Units'
        //                         },
        //                         gridLines: {
        //                             color: 'rgba(200,200,200,0.2)',
        //                             borderDash: [3, 3]
        //                         }
        //                     }],
        //                     xAxes: [{
        //                         ticks: $.extend({
        //                             autoSkip: false,
        //                             maxRotation: 45,
        //                             minRotation: 0
        //                         }, ticksStyle),
        //                         scaleLabel: {
        //                             display: true,
        //                             labelString: 'Companies'
        //                         },
        //                         gridLines: {
        //                             display: false
        //                         }
        //                     }]
        //                 }
        //             }
        //         })
        //     }
        // })
    </script>
@endsection
