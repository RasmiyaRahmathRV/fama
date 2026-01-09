@extends('admin.layout.admin_master')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('assets/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <style>
        .contractTable tbody tr {
            background-color: #f6ffff;
        }

        .contractTable thead tr {
            background-color: #D6EEEE;
        }
    </style>
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Contract Documents</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Contract Documents</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">


                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <!-- <h3 class="card-title">Contract Documents list</h3> -->

                                <span class="float-right">
                                    <a href="{{ route('contract.show', $contract->id) }}"
                                        class="btn btn-info float-right m-1" target="_blank">View Contract</a>
                                    <button class="btn btn-info float-right m-1" data-toggle="modal"
                                        data-target="#modal-upload">Upload Files</button>
                                </span>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @php
                                    $occupied = $vacant = $paymentReceived = $payamentPending = 0;
                                @endphp
                                @foreach ($contractUnitdetails as $contractUnitdetail)
                                    @php
                                        $occupied += $contractUnitdetail->subunit_occupied_count;
                                        $vacant += $contractUnitdetail->subunit_vacant_count;
                                        $paymentReceived += $contractUnitdetail->total_payment_received;
                                        $payamentPending += $contractUnitdetail->total_payment_pending;
                                    @endphp
                                @endforeach
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-info"><i class="fas fa-lock"></i></span>

                                            <div class="info-box-content">
                                                <span class="info-box-text">Occupied</span>
                                                <span class="info-box-number">{{ $occupied }}</span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-success"><i class="fas fa-unlock"></i></span>

                                            <div class="info-box-content">
                                                <span class="info-box-text">Vacant</span>
                                                <span class="info-box-number">{{ $vacant }}</span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-warning"><i
                                                    class="fas fa-hand-holding-usd"></i></span>

                                            <div class="info-box-content">
                                                <span class="info-box-text">Payment Received</span>
                                                <span class="info-box-number">{{ $paymentReceived }}</span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-danger"><i
                                                    class="fas fa-funnel-dollar"></i></span>

                                            <div class="info-box-content">
                                                <span class="info-box-text">Payment Pending</span>
                                                <span class="info-box-number">{{ $payamentPending }}</span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                        <!-- /.info-box -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <div class="card-body">
                                    {{-- <h4 class="text-bold">Contract Document List</h4> --}}
                                    <div>
                                        <table class="table contractTable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Document name</th>
                                                    <th>view</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Project Scope</td>
                                                    <td><a href="{{ url('/download-scope', $contract->contract_scope->id) }}"
                                                            class="btn btn-info"><i class="far fa-eye"></i></a></td>
                                                </tr>
                                                @foreach ($contractDocuments as $document)
                                                    <tr>
                                                        <td>{{ $loop->iteration + 1 }}</td>
                                                        <td>{{ $document->document_type->label_name }}</td>
                                                        <td>
                                                            @if ($document->signed_document_path)
                                                                <a href="{{ asset('storage/' . $document->signed_document_path) }}"
                                                                    class="btn btn-info" target="_blank"
                                                                    rel="noopener noreferrer"><i class="far fa-eye"></i></a>
                                                                {{-- <a href="{{ $document->original_document_path }}">View</a> --}}
                                                            @elseif($document->original_document_path)
                                                                <a href="{{ asset('storage/' . $document->original_document_path) }}"
                                                                    class="btn btn-info" target="_blank"><i
                                                                        class="far fa-eye"></i></a></a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                <br>
                                <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->
                                <div id="accordion">
                                    @php
                                        $unitdet = [];
                                    @endphp
                                    @foreach ($contractUnitdetails as $key => $contractUnitdetail)
                                        @if ($contractUnitdetail->contract->contract_type_id != 2)
                                            @include('admin.projects.contract.contract-agreement-view', [
                                                'unitNumbers' => $contractUnitdetail->unit_number,
                                                'agreementUnits' => $contractUnitdetail->agreementUnits,
                                                'unitdetail' => $contractUnitdetail,
                                            ])
                                        @else
                                            @include('admin.projects.contract.contract-agreement-view', [
                                                'unitNumbers' => $contractUnitdetail->unit_number,
                                                'agreementUnits' => $contractUnitdetail->agreementUnits,
                                                'unitdetail' => $contractUnitdetail,
                                            ])
                                            {{-- <div class="card card-secondary">
                                                <div class="card-header">
                                                    <h4 class="card-title w-100 row">
                                                        <a class="d-block w-100" data-toggle="collapse"
                                                            href="#collapse{{ $key }}">
                                                            Unit
                                                            {{ $contractUnitdetail->contract_unit->unit_numbers }}


                                                            <span class="badge badge-light float-lg-right"> Total Agreements
                                                                :
                                                                {{ count($contractUnitdetail->agreementUnits) }}</span>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse{{ $key }}" class="collapse"
                                                    data-parent="#accordion">
                                                    <div class="card-body">
                                                        <div class="col-12 table-responsive card-body">
                                                            <div class="d-flex justify-content-center row">
                                                                @foreach ($contractUnitdetail->agreementUnits as $agreementUnit)
                                                                    <div class="col-6">
                                                                        <div class="card">
                                                                            <div class="card-header bg-gradient-olive">
                                                                                <h4 class="card-title w-100">
                                                                                    {{ $agreementUnit->agreement->agreement_code }}
                                                                                    -
                                                                                    {{ $agreementUnit->agreement->tenant->tenant_name }}
                                                                                </h4>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <table class="table">
                                                                                    <tr>
                                                                                        <th>#</th>
                                                                                        <th>Document name</th>
                                                                                        <th>view</th>
                                                                                    </tr>

                                                                                    @foreach ($agreementUnit->agreement->agreement_documents as $agreement_document)
                                                                                        @php
                                                                                            // dd($agreement_document);
                                                                                        @endphp
                                                                                        <tr>
                                                                                            <td>{{ $loop->iteration }}</td>
                                                                                            <td>{{ $agreement_document->TenantIdentity->identity_type }}
                                                                                            </td>
                                                                                            <td><a href="{{ asset('storage/' . $agreement_document->original_document_path) }}"
                                                                                                    target="_blank"
                                                                                                    class="btn btn-sm btn-outline-info"
                                                                                                    title="Click to View">
                                                                                                    <i
                                                                                                        class="fas fa-eye"></i>
                                                                                                </a></td>
                                                                                        </tr>
                                                                                    @endforeach

                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            {{-- @break --}}
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->

            <div class="modal fade" id="modal-upload">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Upload Documents</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" id="ContractUploadForm" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="contract_id" value="{{ $contract->id }}">
                            <div class="modal-body">
                                <div class="card-body">
                                    @foreach ($documentTypes as $key => $documentType)
                                        <div class="form-group row">
                                            @if ($documentType->id == 1)
                                                <div class="col-9 pr-1">
                                            @endif
                                            <input type="hidden" name="{{ $key }}[document_type]"
                                                value="{{ $documentType->id }}">
                                            <input type="hidden" name="{{ $key }}[status_change]"
                                                value="{{ $documentType->status_change_value }}">
                                            <label for="inputEmail3"
                                                class="col-form-label">{{ $documentType->label_name }}</label>
                                            <input type="{{ $documentType->field_type }}"
                                                name="{{ $key }}[file]" class="form-control"
                                                accept="{{ $documentType->accept_types }}">
                                            @if ($documentType->id == 1)
                                        </div>
                                        <div class="col-3">
                                            <span class="float-right mt-31">
                                                <div class="icheck-success d-inline">
                                                    <input type="checkbox" id="signed"
                                                        name="{{ $key }}[signed_contract]"
                                                        class="signedContract" value="1">
                                                    <label class="labelpermission" for="signed"> Signed </label>
                                                </div>
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>


                            {{-- <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-form-label">Vendor Contract</label>
                                        <input type="file" name="file" class="form-control">
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-form-label">Acknoledgement</label>
                                        <input type="file" name="file" class="form-control">
                                    </div>
                                </div> --}}
                            <!-- /.card-body -->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="importBtn" class="btn btn-info">Upload</button>
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
    <script>
        $('#ContractUploadForm').submit(function(e) {
            e.preventDefault();

            showLoader(); //'Processing upload...', 'Please wait while the documents are being uploaded.'

            var form = document.getElementById('ContractUploadForm');
            var fdata = new FormData(form);

            fdata.append('_token', $('meta[name="csrf-token"]').attr('content'));

            $.ajax({
                type: "POST",
                url: 'contract-document-upload',
                data: fdata,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    toastr.success(response.message);
                    window.location.reload();
                },
                error: function(errors) {
                    hideLoader();
                    // Example: get first file error
                    let message = errors.responseJSON.message;
                    if (message.file) {
                        toastr.error(message.file[0]);
                    } else {
                        toastr.error('Something went wrong.');
                    }
                }
            });
        });
    </script>
@endsection
