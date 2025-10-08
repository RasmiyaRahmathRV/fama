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
                        <h1>Property Type</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Property Type</li>
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
                            @can('property_type.add')
                                <div class="card-header">
                                    <!-- <h3 class="card-title">Property Type Details</h3> -->
                                    <span class="float-right">
                                        <button class="btn btn-info float-right m-1" data-toggle="modal"
                                            data-target="#modal-property-type">Add Property Type</button>
                                        <button class="btn btn-secondary float-right m-1" data-toggle="modal"
                                            data-target="#modal-import">Import</button>
                                    </span>
                                </div>
                            @endcan
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="propertyTypeTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Company</th>
                                            <th>Property Type Name</th>
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


            <div class="modal fade" id="modal-property-type">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Property Type</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" id="PropertyTypeForm">
                            @csrf
                            <input type="hidden" name="id" id="property_type_id">
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
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Property Type</label>
                                        <input type="text" name="property_type" id="property_type"
                                            class="col-sm-8 form-control" id="inputEmail3" placeholder="Property Type">
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
                        <form action="" id="PropertyTypeImportForm" method="POST" enctype="multipart/form-data">
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



    <script>
        $('#PropertyTypeForm').submit(function(e) {
            e.preventDefault();
            $('#company_id').prop('disabled', false);

            var form = document.getElementById('PropertyTypeForm');
            var fdata = new FormData(form);

            $.ajax({
                type: "POST",
                url: "{{ route('property_type.store') }}",
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

        $(function() {
            let table = $('#propertyTypeTable').DataTable({
                processing: true,
                serverSide: true,

                ajax: {
                    url: "{{ route('property_type.list') }}",
                    data: function(d) {
                        // d.company_id = $('#companyFilter').val();
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'property_types.id',
                        orderable: true,
                        searchable: false
                    },
                    // {
                    //     data: 'id',
                    //     name: 'areas.id',
                    //     visible: false
                    // },

                    {
                        data: 'company_name',
                        name: 'companies.company_name',
                    },
                    {
                        data: 'property_type',
                        name: 'property_types.property_type'
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
                    title: 'Property Type Data',
                    action: function(e, dt, node, config) {
                        // redirect to your Laravel export route
                        window.location.href = "{{ route('propertyType.export') }}";
                    }
                }]
            });
        });

        $('#importBtn').on('click', function() {
            let formData = new FormData($('#PropertyTypeImportForm')[0]);
            $.ajax({
                url: "{{ route('import.propertytype') }}",
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

        function deleteConf(id) {
            Swal.fire({
                title: "Are you sure?",
                // text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: '/property_type/' + id,
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: "json",
                        success: function(response) {
                            toastr.success(response.message);
                            $('#propertyTypeTable').DataTable().ajax.reload();
                        }
                    });

                } else {
                    toastr.error(errors.responseJSON.message);
                }
            });
        }

        $("#modal-property-type").on('shown.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            var name = $(e.relatedTarget).data('name');
            var company_id = $(e.relatedTarget).data('company');

            if (id) {
                $('#company_id').val(company_id).trigger('change');

                $('#company_id').prop('disabled', true);
                $('#property_type_id').val(id);
                $('#property_type').val(name);

            }
        });

        $('#modal-property-type').on('hidden.bs.modal', function() {
            let form = $(this).find('form');

            form[0].reset(); // reset normal inputs
            form.find('select').val(null).trigger('change'); // reset all select2
            $('#company_id').prop('disabled', false);
        });
    </script>
@endsection
