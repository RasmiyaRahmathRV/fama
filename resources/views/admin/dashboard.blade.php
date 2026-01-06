@extends('admin.layout.admin_master')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Real Estate CRM Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v3</li>
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
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ number_format($wid_totalContracts) }}</h3>

                                <p>Projects</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('contract.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
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
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ number_format($wid_totalInvestments) }}</h3>

                                <p>Investments</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ route('investment.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>65</h3>

                                <p>Revenue</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
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
                                    <canvas id="inventory-chart" height="200"></canvas>
                                </div>

                                <div class="d-flex flex-row justify-content-end">
                                    <span class="mr-2">
                                        <i class="fas fa-square text-primary"></i> DF Units
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
                                        <span class="text-bold text-lg">${{ number_format($totalInvestment, 2) }}</span>
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
                                <div class="position-relative mb-4">
                                    <canvas id="investment-chart" height="200"></canvas>
                                </div>

                                <div class="d-flex flex-row justify-content-end">
                                    <span class="mr-2">
                                        <i class="fas fa-square text-primary"></i> Investment Amount
                                    </span>
                                    <span>
                                        <i class="fas fa-square text-danger"></i> Number of Investments
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
        document.addEventListener('DOMContentLoaded', function() {
            const canvas = document.getElementById('investment-chart');
            if (!canvas) return;

            const ctx = canvas.getContext('2d');

            if (window.salesChart) {
                window.salesChart.destroy();
            }

            window.salesChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($labels) !!},
                    datasets: [{
                            type: 'bar',
                            label: 'Investment Amount (AED)',
                            data: {!! json_encode($amounts) !!},
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1,
                            yAxisID: 'y',
                            barThickness: 40,
                            borderRadius: 6
                        },
                        {
                            type: 'line',
                            label: 'No. of Investments',
                            data: {!! json_encode($counts) !!},
                            borderColor: 'rgba(255, 99, 132, 1)',
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            fill: false,
                            tension: 0.3,
                            yAxisID: 'y1', // right axis
                            pointBackgroundColor: 'rgba(255, 99, 132, 1)',
                            pointBorderColor: '#fff',
                            pointRadius: 5
                        }
                    ]
                },
                options: {
                    responsive: true,
                    interaction: {
                        mode: 'index',
                        intersect: false
                    },
                    stacked: false,
                    plugins: {
                        legend: {
                            display: true,
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
                            title: {
                                display: true,
                                text: 'Investment Amount (AED)'
                            },
                            // optional: max value a bit above highest amount
                            suggestedMax: Math.max(...{!! json_encode($amounts) !!}) * 1.2
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
                            suggestedMax: Math.max(...{!! json_encode($counts) !!}) * 1.5
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

        });
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('inventory-chart').getContext('2d');

            if (window.inventoryChart) window.inventoryChart.destroy();

            window.inventoryChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($companyNames) !!},

                    datasets: [{
                            label: 'DF Units',
                            data: {!! json_encode($dfUnits) !!},
                            backgroundColor: 'rgba(54, 162, 235, 0.7)',
                            barThickness: 40,
                            borderRadius: 6
                        },
                        {
                            label: 'FF Units',
                            data: {!! json_encode($ffUnits) !!},
                            backgroundColor: 'rgba(255, 99, 132, 0.7)',
                            barThickness: 40,
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
                                    return context.dataset.label + ': ' + context.raw + ' units';
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
        });
    </script>

    {{-- <script>
        const ctx = document.getElementById('visitors-chart').getContext('2d');

        // Destroy old chart if exists
        if (window.visitorsChart) {
            window.visitorsChart.destroy();
        }

        window.visitorsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                        label: 'This Week',
                        data: [120, 200, 150, 170, 220, 210, 180],
                        borderColor: '#007bff',
                        backgroundColor: 'rgba(0,123,255,0.2)',
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Last Week',
                        data: [100, 150, 130, 160, 180, 170, 150],
                        borderColor: '#6c757d',
                        backgroundColor: 'rgba(108,117,125,0.2)',
                        fill: true,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    },
                    x: {}
                }
            }
        });
    </script> --}}
@endsection
