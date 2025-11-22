@extends('admin.layout.admin_master')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('assets/icheck-bootstrap/icheck-bootstrap.min.css') }}">
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
                                    <button class="btn btn-info float-right m-1" data-toggle="modal"
                                        data-target="#modal-upload">Upload Files</button>
                                </span>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table">
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
                                                    @if ($document->original_document_path)
                                                        <a href="{{ asset('storage/' . $document->original_document_path) }}"
                                                            class="btn btn-info" target="_blank"
                                                            rel="noopener noreferrer"><i class="far fa-eye"></i></a>
                                                        {{-- <a href="{{ $document->original_document_path }}">View</a> --}}
                                                    @elseif($document->signed_document_path)
                                                        <a href="{{ asset('storage/' . $document->signed_document_path) }}"
                                                            class="btn btn-info" target="_blank"><i
                                                                class="far fa-eye"></i></a></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <br>
                                <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->
                                <div id="accordion">
                                    <div class="card card-secondary">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                                                    Unit 1
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                <table class="table">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Document name</th>
                                                        <th>view</th>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Emirates ID</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Passport</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Visa</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Agreement</td>
                                                        <td></td>
                                                    </tr>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-secondary">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                                                    Unit 2
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                <table class="table">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Document name</th>
                                                        <th>view</th>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Emirates ID</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Passport</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Visa</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Agreement</td>
                                                        <td></td>
                                                    </tr>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-secondary">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                                                    Unit 3
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseThree" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                <table class="table">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Document name</th>
                                                        <th>view</th>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Emirates ID</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Passport</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Visa</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Agreement</td>
                                                        <td></td>
                                                    </tr>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
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
