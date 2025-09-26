@extends('admin.layout.admin_master')

@section('custom_css')
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
                        <h1>Area</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Area</li>
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
                            <div class="card-header">
                                {{-- <h3 class="card-title">Area Details</h3> --}}
                                <span class="float-right">
                                    <button class="btn btn-info float-right m-1" data-toggle="modal"
                                        data-target="#modal-area">Add Area</button>
                                    <button class="btn btn-secondary float-right m-1" data-toggle="modal"
                                        data-target="#modal-import">Import</button>
                                </span>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="areasTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Area Name</th>
                                            <th>Company Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->


            <div class="modal fade" id="modal-area">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Area</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" id="areaForm">
                            @csrf
                            <input type="hidden" name="id" id="area_id">
                            <div class="modal-body">
                                <div class="card-body">
                                    @if (auth()->user()->company_id)
                                        <input type="hidden" name="company_id" id="company_id"
                                            value="{{ auth()->user()->company_id }}">
                                    @else
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Company</label>
                                            <select class="form-control select2 col-sm-8" name="company_id" id="company_id">
                                                <option value="">Select Company</option>
                                                @foreach ($companies as $company)
                                                    <option value="{{ $company->id }}">{{ $company->company_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Area Name</label>
                                        <input type="text" name="area_name" id="area_name" class="col-sm-8 form-control"
                                            id="inputEmail3" placeholder="Area Name">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-info">Save changes</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            <div class="modal fade" id="modal-import">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Import</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" id="areaImportForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Import excel</label>
                                        <input type="file" name="file" class="col-sm-9 form-control">
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
@section('custom_js')
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.5/dist/sweetalert2.all.min.js"></script>

    <script>
        $('#areaForm').submit(function(e) {
            e.preventDefault();
            $('#company_id').prop('disabled', false);

            var form = document.getElementById('areaForm');
            var fdata = new FormData(form);

            $.ajax({
                type: "POST",
                url: "{{ route('areas.store') }}",
                data: fdata,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(response) {
                    toastr.success(response.message);
                    window.location.reload();
                },
                error: function(errors) {
                    toastr.error(errors.responseJSON.message);
                    $('#company_id').prop('disabled', true);
                }
            });
        });


        $("#modal-area").on('shown.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            var name = $(e.relatedTarget).data('name');

            if (!id) {
                $('#areaForm').trigger("reset");
            } else {
                $('#company_id').val($(e.relatedTarget).data('company')).trigger('change');
                $('#company_id').prop('disabled', true);
                $('#area_id').val(id);
                $('#area_name').val(name);
            }
        });


        $('#importBtn').on('click', function() {
            let formData = new FormData($('#areaImportForm')[0]);
            $.ajax({
                url: "{{ route('import.area') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    toastr.success(response.message);
                    window.location.reload();
                },
                error: function(err) {
                    toastr.error(err.responseJSON.message);
                }
            });
        });

        $(function() {
            let table = $('#areasTable').DataTable({
                processing: true,
                serverSide: true,

                ajax: {
                    url: "{{ route('area.list') }}",
                    data: function(d) {
                        // d.company_id = $('#companyFilter').val();
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'areas.id',
                        orderable: true,
                        searchable: false
                    },
                    // {
                    //     data: 'id',
                    //     name: 'areas.id',
                    //     visible: false
                    // },
                    {
                        data: 'area_name',
                        name: 'areas.area_name'
                    },
                    {
                        data: 'company_name',
                        name: 'companies.company_name',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [
                    [0, 'desc']
                ],
                dom: 'Bfrtip', // This is important for buttons
                buttons: [{
                    extend: 'excelHtml5',
                    text: 'Export Excel',
                    title: 'Area Data',
                    action: function(e, dt, node, config) {
                        // redirect to your Laravel export route
                        window.location.href = "{{ route('area.export') }}";
                    }
                }]
            });

            // $('#companyFilter').change(function() {
            //     table.ajax.reload();
            // });


        });

        function deleteConf(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: '/areas/' + id,
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: "json",
                        success: function(response) {
                            toastr.success(response.message);
                            $('#areasTable').DataTable().ajax.reload();
                        }
                    });

                } else {
                    toastr.error(errors.responseJSON.message);
                }
            });
        }
    </script>
@endsection
