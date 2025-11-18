@extends('admin.layout.admin_master')
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
                                        <tr>
                                            <td>2</td>
                                            <td>Vendor Contract</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Acknoledgement</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Cheque Copy</td>
                                            <td></td>
                                        </tr>
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
                            <h4 class="modal-title">Import</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" id="ContractImportForm" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-form-label">Upload Cheque copy</label>
                                        <input type="file" name="file" class="form-control">
                                    </div>
                                </div>

                                <div class="card-body">
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
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" id="importBtn" class="btn btn-info">Import</button>
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
