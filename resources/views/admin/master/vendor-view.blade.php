@extends('admin.layout.admin_master')

@section('content')
    <div class="content-wrapper">

        {{-- Page Header --}}
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Vendor Detail</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('vendors.index') }}">Vendors</a></li>
                            <li class="breadcrumb-item active">View</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        {{-- Main Content --}}
        <section class="content">
            <div class="card">

                {{-- Card Header --}}
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-user mr-1"></i> {{ $vendor->vendor_name }}
                    </h3>

                    <div class="card-tools">
                        <a href="{{ route('vendors.index') }}" class="btn btn-sm btn-warning">
                            <i class="fa-arrow-alt-circle-left fas"></i> Back
                        </a>
                    </div>
                </div>

                {{-- Card Body --}}
                <div class="card-body">
                    <div class="row">

                        {{-- LEFT SIDE --}}
                        <div class="col-lg-8">

                            {{-- Info Boxes --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content text-center">
                                            <span class="info-box-text text-muted">Vendor Code</span>
                                            <span class="info-box-number">{{ $vendor->vendor_code }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content text-center">
                                            <span class="info-box-text text-muted">Phone</span>
                                            <span class="info-box-number">{{ $vendor->vendor_phone }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="info-box bg-light">
                                        <div class="info-box-content text-center">
                                            <span class="info-box-text text-muted">Status</span>
                                            <span class="badge badge-{{ $vendor->status ? 'success' : 'secondary' }}">
                                                {{ $vendor->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Vendor Details --}}
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h3 class="card-title">Vendor Information</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <tr>
                                            <th width="30%">Email</th>
                                            <td>{{ $vendor->vendor_email ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th width="30%">Phone</th>
                                            <td>{{ $vendor->vendor_phone ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th width="30%">Landline</th>
                                            <td>{{ $vendor->landline_number ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Address</th>
                                            <td>{{ $vendor->vendor_address ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Accountant Name</th>
                                            <td>{{ $vendor->accountant_name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Accountant Phone</th>
                                            <td>{{ $vendor->accountant_phone ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Accountant Email</th>
                                            <td>{{ $vendor->accountant_email ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Contact Person</th>
                                            <td>{{ $vendor->contact_person ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Contact Person Phone</th>
                                            <td>{{ $vendor->contact_person_phone ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Contact Person Email</th>
                                            <td>{{ $vendor->contact_person_email ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Contract Template</th>
                                            <td>{{ $vendor->contractTemplate->template_name ?? '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        {{-- RIGHT SIDE --}}
                        <div class="col-lg-4">
                            <h4 class="text-primary">
                                <i class="fas fa-info-circle"></i> Meta Details
                            </h4>

                            <div class="text-muted">
                                <p class="text-sm">
                                    Added By
                                    <b class="d-block">{{ $vendor->addedBy->first_name ?? '-' }}
                                        {{ $vendor->addedBy->last_name ?? '' }}</b>
                                </p>

                                <p class="text-sm">
                                    Updated By
                                    <b class="d-block">{{ $vendor->updatedBy->first_name ?? '-' }}
                                        {{ $vendor->updatedBy->last_name ?? '' }}</b>
                                </p>

                                <p class="text-sm">
                                    Created On
                                    <b class="d-block">{{ \Carbon\Carbon::parse($vendor->created_at)->format('d M Y') }}
                                    </b>
                                </p>
                                <p class="text-sm">
                                    Updated On
                                    <b class="d-block">{{ \Carbon\Carbon::parse($vendor->updated_at)->format('d M Y') }}
                                    </b>
                                </p>


                                <p class="text-sm">
                                    Remarks
                                    <b class="d-block">{{ $vendor->remarks ?? '-' }}</b>
                                </p>
                                <p class="text-sm">
                                    Location
                                    <a href="{{ $vendor->remarks }}"class="d-block text-blue"
                                        target="_blank">{{ $vendor->location ?? '-' }}</a>
                                </p>
                            </div>

                            {{-- Action Buttons --}}
                            {{-- <div class="text-center mt-4">
                                <a href="{{ route('vendors.index') }}" class="btn btn-sm btn-secondary">Back</a>
                            </div> --}}
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
