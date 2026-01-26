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
                    <div class="col-lg-3 ">
                        <!-- small box -->
                        <div class="small-box bg-gradient-projects">

                            <div class="inner">
                                <h3>{{ format_k($wid_totalContracts) }}</h3>

                                <p>Projects</p>
                            </div>

                            <div class="icon">
                                <i class="ion ion-folder"></i>
                            </div>
                            {{-- <a href="{{ route('contract.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 ">
                        <!-- small box -->
                        <div class="small-box bg-gradient-investors">

                            <div class="inner">
                                <h3>{{ format_k($wid_totalInvestors) }}<sup style="font-size: 20px"></sup></h3>

                                <p>Investors</p>
                            </div>

                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            {{-- <a href="{{ route('investor.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 ">
                        <!-- small box -->
                        <div class="small-box bg-gradient-investments">

                            <div class="inner">
                                <h3>{{ format_k($wid_totalInvestments) }}</h3>


                                <p>Investments</p>
                            </div>

                            <div class="icon">
                                <i class="ion ion-briefcase"></i>
                            </div>
                            {{-- <a href="{{ route('investment.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 ">
                        <div class="small-box bg-gradient-revenue">

                            {{-- <div class="inner">
                                <h3>{{ number_format($wid_revenue, 2) }}</h3>
                                <p>Revenue</p>
                            </div> --}}
                            <div class="inner">
                                <h3>{{ format_k($wid_tenants) }}</h3>
                                <p>Tenants</p>
                            </div>

                            <div class="icon">
                                <i class="ion ion-person-stalker"></i>
                            </div>
                            {{-- <a href="#" class="small-box-footer">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a> --}}
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
                                    {{-- <p class="ml-auto d-flex flex-column text-right">
                                        @if ($arrow === 'up')
                                            <span class="text-success">
                                                <i class="fas fa-arrow-up"></i> {{ $percentChange }}%
                                            </span>
                                        @elseif($arrow === 'down')
                                            <span class="text-danger">
                                                <i class="fas fa-arrow-down"></i> {{ abs($percentChange) }}%
                                            </span>
                                        @else
                                            <span class="text-warning">No Change</span>
                                        @endif
                                        <span class="text-muted">Compared to last month</span>

                                    </p> --}}

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
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">Investors</h3>
                                    {{-- <a href="javascript:void(0);">View Report</a> --}}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    <p class="d-flex flex-column">
                                        <span class="text-bold text-lg">{{ $maxCount }}</span>
                                        <span>Top Investor:
                                            @if ($topInvestorsMax->isNotEmpty())
                                                {{ $topInvestorsMax->first()->investor_name }}
                                                @if ($topInvestorsMax->count() > 1)
                                                    +
                                                    <span data-toggle="tooltip" class="text-primary text-bold"
                                                        title="{{ $topInvestorsMax->pluck('investor_name')->slice(1)->join(', ') }}"
                                                        style=" cursor: pointer;">
                                                        {{ $topInvestorsMax->count() - 1 }}
                                                    </span>others
                                                @endif
                                            @else
                                                N/A
                                            @endif
                                        </span>
                                    </p>


                                </div>
                                <!-- /.d-flex -->

                                <div class="position-relative mb-4">
                                    {{-- <canvas id="inventory-chart" height="272"></canvas> --}}
                                    <canvas id="investorChart" height="272"></canvas>
                                </div>

                                <div class="d-flex flex-row justify-content-end">
                                    <span class="mr-2">
                                        <i class="fas fa-square bg-yellowIn"></i> Total Investments
                                    </span>


                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col-md-6 -->
                    @if (auth()->user()->user_type_id !== 8)
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header border-0">

                                    <div class="card-header border-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h3 class="card-title mb-0">Investments</h3>

                                            <select id="yearFilter" class="form-control form-control-sm"
                                                style="width: 160px;">
                                                <option value="last_12_months">Last 12 Months</option>
                                                @for ($y = date('Y'); $y >= date('Y') - 5; $y--)
                                                    <option value="{{ $y }}">{{ $y }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">
                                        <p class="d-flex flex-column">
                                            <span class="text-bold text-lg">AED
                                                {{ format_k($totalInvestment) }}</span>
                                            <span>Total Investments</span>
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
                        </div>
                    @endif

                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
                <div class="row">
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
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            {{-- <div class="card-header bg-gradient-info">
                                <h3 class="card-title text-white">Property Locations</h3>
                            </div> --}}
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="ion ion-ios-location text-muted mr-1"></i>
                                    Property Locations
                                </h3>
                            </div>
                            <div class="card-body p-4">
                                <div id="map" style="width: 100%; height: 500px;"></div>
                            </div>
                        </div>
                    </div>
                </div>

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
        const investmentMonthlyRaw = @json($investmentMonthlyRaw);
        console.log(investmentMonthlyRaw);
        let investmentChart = null;

        function renderInvestmentChart(chartData) {
            console.log(chartData);

            const ctx = document.getElementById('investment-chart');

            // Update existing chart
            if (investmentChart) {
                investmentChart.data.labels = chartData.labels;
                investmentChart.data.datasets[0].data = chartData.amounts;
                investmentChart.data.datasets[1].data = chartData.counts;
                investmentChart.update();
                return;
            }

            // Create chart first time
            investmentChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                            type: 'bar',
                            label: 'Investment Amount (AED)',
                            data: chartData.amounts,
                            backgroundColor: 'rgba(17, 153, 142, 0.5)',
                            borderColor: 'rgba(17, 153, 142, 1)',
                            borderWidth: 1,
                            maxBarThickness: 40,
                            borderRadius: 6,
                            yAxisID: 'y'
                        },
                        {
                            type: 'line',
                            label: 'No. of Investments',
                            data: chartData.counts,
                            borderColor: 'rgba(91, 134, 229, 1)',
                            backgroundColor: 'rgba(91, 134, 229, 1)',
                            tension: 0.3,
                            pointRadius: 4,
                            fill: false,
                            yAxisID: 'y1'
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
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            enabled: true
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Investment Amount (AED)'
                            }
                        },
                        y1: {
                            beginAtZero: true,
                            position: 'right',
                            grid: {
                                drawOnChartArea: false
                            },
                            title: {
                                display: true,
                                text: 'No. of Investments'
                            }
                        },
                        x: {
                            ticks: {
                                font: {
                                    size: 12
                                }
                            },
                            grid: {
                                color: 'rgba(200,200,200,0.1)',
                                borderDash: [3, 3]
                            }
                        }
                    }
                }
            });
        }
    </script>
    <script>
        $(function() {

            $('#yearFilter').on('change', function() {
                const value = $(this).val();

                const filtered = value === 'last_12_months' ?
                    last12Months(investmentMonthlyRaw) :
                    filterByYear(investmentMonthlyRaw, value);

                renderInvestmentChart(buildChartData(filtered));
            });
            renderInvestmentChart(
                buildChartData(last12Months(investmentMonthlyRaw))
            );





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

            var $investorChart = $('#investorChart');
            if ($investorChart.length) {

                if (window.investorChart instanceof Chart) {
                    window.investorChart.destroy();
                }

                window.investorChart = new Chart($investorChart, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($investorNames) !!},

                        datasets: [{
                            label: 'Total Investments',
                            data: {!! json_encode($investorCounts) !!},
                            backgroundColor: 'rgba(255, 193, 7, 0.75)',
                            borderRadius: 6,
                            // barThickness: 20,
                            maxBarThickness: 40
                        }]
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
                                        return context.dataset.label + ': ' + context.raw;
                                    }
                                }
                            },
                            title: {
                                display: true,
                                text: 'Top 10 Investors by Total Investments',
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
                                    text: 'Total Investments'
                                },
                                grid: {
                                    color: 'rgba(200,200,200,0.2)',
                                    borderDash: [3, 3]
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Investors',
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
    </script>

    <script>
        function initMap() {

            const properties = [
                @foreach ($properties as $prop)
                    @if ($prop->latitude && $prop->longitude)
                        {
                            name: "{{ addslashes($prop->property_name) }}",
                            address: "{{ addslashes($prop->address ?? '') }}",
                            lat: {{ $prop->latitude }},
                            lng: {{ $prop->longitude }}
                        },
                    @endif
                @endforeach
            ];

            // Default center
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 10,
                center: properties.length ? {
                    lat: properties[0].lat,
                    lng: properties[0].lng
                } : {
                    lat: 25.2048,
                    lng: 55.2708
                } // fallback Dubai
            });

            const bounds = new google.maps.LatLngBounds();

            properties.forEach(p => {
                const position = {
                    lat: p.lat,
                    lng: p.lng
                };

                const marker = new google.maps.Marker({
                    position,
                    map,
                    title: p.name
                });

                bounds.extend(position);

                const infoWindow = new google.maps.InfoWindow({
                    content: `<b>${p.name}</b>`
                });
                marker.addListener('click', () => {
                    infoWindow.open(map, marker);

                    google.maps.event.addListenerOnce(infoWindow, 'domready', function() {
                        const iw = document.querySelector('.gm-style-iw');
                        if (iw) {
                            const btn = iw.querySelector('button[aria-label="Close"]');
                            if (btn) btn.style.display = 'none';
                        }
                    });
                });

                marker.addListener('mouseover', () => {
                    infoWindow.open(map, marker);
                    google.maps.event.addListenerOnce(infoWindow, 'domready', function() {
                        const iw = document.querySelector('.gm-style-iw');
                        if (iw) {
                            const btn = iw.querySelector('button[aria-label="Close"]');
                            if (btn) btn.style.display = 'none';
                        }
                    });
                });

                marker.addListener('mouseout', () => {
                    infoWindow.close();
                });

            });

            // Auto-fit map to all markers
            if (properties.length) {
                map.fitBounds(bounds);
            }
        }
    </script>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <script>
        function formatMonth(year, month) {
            return new Date(year, month - 1).toLocaleString('en', {
                month: 'short',
                year: 'numeric'
            });
        }

        function last12Months(data) {
            return data.slice(-12);
        }

        function filterByYear(data, year) {
            return data.filter(d => d.year == year);
        }

        function buildChartData(data) {
            return {
                labels: data.map(d => formatMonth(d.year, d.month)),
                amounts: data.map(d => d.total_amount),
                counts: data.map(d => d.total_count)
            };
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD46-CF9pTGIQpnKNkvc1eeZwBH2pQ70qQ&callback=initMap" async
        defer></script>
@endsection
