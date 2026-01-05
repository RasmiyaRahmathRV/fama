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
                            <div class="card-header border-0 d-flex justify-content-between">
                                <h3 class="card-title">Online Store Visitors</h3>
                                <a href="javascript:void(0);">View Report</a>
                            </div>
                            <div class="card-body">
                                <div class="d-flex mb-3">
                                    <p class="d-flex flex-column">
                                        <span class="text-bold text-lg">820</span>
                                        <span>Visitors Over Time</span>
                                    </p>
                                    <p class="ml-auto d-flex flex-column text-right">
                                        <span class="text-success">
                                            <i class="fas fa-arrow-up"></i> 12.5%
                                        </span>
                                        <span class="text-muted">Since last week</span>
                                    </p>
                                </div>

                                <div class="position-relative mb-4">
                                    <canvas id="visitors-chart" height="200"></canvas>
                                </div>

                                <div class="d-flex flex-row justify-content-end">
                                    <span class="mr-2">
                                        <i class="fas fa-square text-primary"></i> This Week
                                    </span>
                                    <span>
                                        <i class="fas fa-square text-gray"></i> Last Week
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header border-0">
                                <h3 class="card-title">Products</h3>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-tool btn-sm">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <a href="#" class="btn btn-tool btn-sm">
                                        <i class="fas fa-bars"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-striped table-valign-middle">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Sales</th>
                                            <th>More</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('img/default-150x150.png') }}" alt="Product 1"
                                                    class="img-circle img-size-32 mr-2">
                                                Some Product
                                            </td>
                                            <td>$13 USD</td>
                                            <td>
                                                <small class="text-success mr-1">
                                                    <i class="fas fa-arrow-up"></i>
                                                    12%
                                                </small>
                                                12,000 Sold
                                            </td>
                                            <td>
                                                <a href="#" class="text-muted">
                                                    <i class="fas fa-search"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('img/default-150x150.png') }}" alt="Product 1"
                                                    class="img-circle img-size-32 mr-2">
                                                Another Product
                                            </td>
                                            <td>$29 USD</td>
                                            <td>
                                                <small class="text-warning mr-1">
                                                    <i class="fas fa-arrow-down"></i>
                                                    0.5%
                                                </small>
                                                123,234 Sold
                                            </td>
                                            <td>
                                                <a href="#" class="text-muted">
                                                    <i class="fas fa-search"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('img/default-150x150.png') }}" alt="Product 1"
                                                    class="img-circle img-size-32 mr-2">
                                                Amazing Product
                                            </td>
                                            <td>$1,230 USD</td>
                                            <td>
                                                <small class="text-danger mr-1">
                                                    <i class="fas fa-arrow-down"></i>
                                                    3%
                                                </small>
                                                198 Sold
                                            </td>
                                            <td>
                                                <a href="#" class="text-muted">
                                                    <i class="fas fa-search"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('img/default-150x150.png') }}" alt="Product 1"
                                                    class="img-circle img-size-32 mr-2">
                                                Perfect Item
                                                <span class="badge bg-danger">NEW</span>
                                            </td>
                                            <td>$199 USD</td>
                                            <td>
                                                <small class="text-success mr-1">
                                                    <i class="fas fa-arrow-up"></i>
                                                    63%
                                                </small>
                                                87 Sold
                                            </td>
                                            <td>
                                                <a href="#" class="text-muted">
                                                    <i class="fas fa-search"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
                                    <a href="javascript:void(0);">View Report</a>
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
                                    <canvas id="inventory-chart" height="200"></canvas>
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

                        <div class="card">
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
                        </div>
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
    <script src="{{ asset('js/pages/dashboard3.js') }}"></script>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const canvas = document.getElementById('inventory-chart');
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
                                text: 'Month'
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
