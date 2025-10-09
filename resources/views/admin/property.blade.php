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
                        <h1>Property</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Property</li>
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
                            @can('property.add')
                                <div class="card-header">
                                    <!-- <h3 class="card-title">Property Details</h3> -->
                                    <span class="float-right">
                                        <button class="btn btn-info float-right m-1" data-toggle="modal"
                                            data-target="#modal-property">Add Property</button>
                                        <button class="btn btn-secondary float-right m-1" data-toggle="modal"
                                            data-target="#modal-import">Import</button>
                                    </span>
                                </div>
                            @endcan
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="propertyTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Company</th>
                                            <th>Area</th>
                                            <th>Locality</th>
                                            <th>Property Type</th>
                                            <th>Property Name</th>
                                            <th>Property size</th>
                                            <th>Plot no</th>
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


            <div class="modal fade" id="modal-property">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Property</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" id="PropertyForm">
                            @csrf
                            <input type="hidden" name="id" id="property_id">
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="form-group row">

                                        @if (auth()->user()->company_id)
                                            <input type="hidden" name="company_id" id="company_id"
                                                value="{{ auth()->user()->company_id }}">
                                        @else
                                            <div class="col-sm-4">
                                                <label>Company</label>
                                                <select class="form-control select2" name="company_id" id="company_id">
                                                    <option value="">Select Company</option>
                                                    @foreach ($companies as $company)
                                                        <option value="{{ $company->id }}">{{ $company->company_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif
                                        <div class="col-sm-4">
                                            <label>Area</label>
                                            <select class="form-control select2" name="area_id" id="area_id">
                                                <option value="">Select Area</option>

                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Locality</label>
                                            <select class="form-control select2" name="locality_id" id="locality_id">
                                                <option value="">Select Locality</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label for="inputEmail3" class="col-form-label">Property Type</label>
                                            <select class="form-control select2" name="property_type_id"
                                                id="property_type_id">
                                                <option value="">Select Property Type</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="inputEmail3" class="col-form-label">Property Name</label>
                                            <input type="text" name="property_name" id="property_name"
                                                class="form-control" id="inputEmail3" placeholder="Property Name">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label>Property Size</label>
                                            <div class="input-group input-group">
                                                <div class="input-group-prepend">
                                                    <select name="property_size_unit" id="property_size_unit">
                                                        <option value="">Select Unit</option>
                                                        @foreach ($propertySizeUnits as $unit)
                                                            <option value="{{ $unit->id }}">{{ $unit->unit_name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <!-- /btn-group -->
                                                <input type="number" name="property_size" id="property_size"
                                                    class="form-control" placeholder="Property Size">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Plot No</label>
                                            <input type="text" name="plot_no" id="plot_no" class="form-control"
                                                placeholder="Plot No">
                                        </div>
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
                        <form action="" id="PropertyImportForm" method="POST" enctype="multipart/form-data">
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
        // Preload all data into JS
        let allAreas = @json($areas);
        let allLocalities = @json($localities);
        let allpropertytypes = @json($property_types);
    </script>

    <script>
        $('#company_id').on('change', function() {
            let companyId = $(this).val();
            companyChange(companyId, null); // reset areaVal when adding
        });

        function companyChange(companyId, areaVal, propertytypeVal, localityVal) {
            let options = '<option value="">Select Area</option>';
            let options2 = '<option value="">Select Property Type</option>';

            allAreas
                .filter(a => a.company_id == companyId)
                .forEach(a => {
                    options += `<option value="${a.id}" ${(a.id == areaVal) ? 'selected' : ''}>${a.area_name}</option>`;
                });
            $('#area_id').html(options).trigger('change');
            areaChange(areaVal, localityVal);

            allpropertytypes
                .filter(pt => pt.company_id == companyId)
                .forEach(pt => {
                    options2 +=
                        `<option value="${pt.id}" ${(pt.id == propertytypeVal) ? 'selected' : ''}>${pt.property_type}</option>`;
                });
            $('#property_type_id').html(options2).trigger('change');
        }

        $('#area_id').on('change', function() {
            let areaId = $(this).val();
            areaChange(areaId, null); // reset areaVal when adding
        });

        function areaChange(areaId, localityVal) {
            let options = '<option value="">Select Locality</option>';

            allLocalities
                .filter(l => l.area_id == areaId)
                .forEach(l => {
                    options +=
                        `<option value="${l.id}" ${(l.id == localityVal) ? 'selected' : ''}>${l.locality_name}</option>`;
                });
            $('#locality_id').html(options).trigger('change');
        }
    </script>

    <script>
        $('#PropertyForm').submit(function(e) {
            e.preventDefault();
            $('#company_id').prop('disabled', false);

            var form = document.getElementById('PropertyForm');
            var fdata = new FormData(form);

            $.ajax({
                type: "POST",
                url: "{{ route('property.store') }}",
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
                    if ($('#Property_id').val()) {
                        $('#company_id').prop('disabled', true);
                    }

                }
            });
        });



        $(function() {
            let table = $('#propertyTable').DataTable({
                processing: true,
                serverSide: true,

                ajax: {
                    url: "{{ route('property.list') }}",
                    data: function(d) {
                        // d.company_id = $('#companyFilter').val();
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'properties.id',
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
                        data: 'area_name',
                        name: 'areas.area_name',
                    },
                    {
                        data: 'locality_name',
                        name: 'localities.locality_name',
                    },
                    {
                        data: 'property_type',
                        name: 'property_types.property_type',
                    },
                    {
                        data: 'property_name',
                        name: 'properties.property_name'
                    },
                    {
                        data: 'property_size',
                        name: 'properties.property_size'
                    },
                    {
                        data: 'plot_no',
                        name: 'properties.plot_no'
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
                    title: 'Property Data',
                    action: function(e, dt, node, config) {
                        // redirect to your Laravel export route
                        let searchValue = dt.search();
                        let url = "{{ route('property.export') }}" + "?search=" +
                            encodeURIComponent(searchValue);
                        window.location.href = url;
                    }
                }]
            });
        });

        $('#importBtn').on('click', function() {
            let formData = new FormData($('#PropertyImportForm')[0]);
            $.ajax({
                url: "{{ route('import.property') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

                    // $('#propertyTable').DataTable().ajax.reload();

                    // // Close modal
                    // $('#modal-import').modal('hide');

                    // // Reset form
                    // $('#PropertyImportForm')[0].reset();
                    toastr.success(response.message);

                    window.location.reload();
                },
                error: function(err) {
                    toastr.error(err.responseJSON.message);
                }
            });
        });

        $("#modal-property").on('shown.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            var name = $(e.relatedTarget).data('name');
            var company_id = $(e.relatedTarget).data('company');
            var area_id = $(e.relatedTarget).data('area');
            var locality_id = $(e.relatedTarget).data('locality');

            if (!id) {
                $(this).find('form')[0].reset();
                $('#company_id').prop('disabled', false);
                $('#company_id').val('').trigger('change');

                companyChange(null, null);
            } else {
                $('#company_id').val(company_id).trigger('change');
                companyChange(company_id, area_id, $(e.relatedTarget).data(
                    'property_type'), locality_id);

                // areaChange(areaId, locality_id);

                // $('#company_id').prop('disabled', true);
                $('#property_id').val(id);
                $('#property_name').val(name);
                $('#property_size').val($(e.relatedTarget).data('property_size'));
                $('#property_size_unit').val($(e.relatedTarget).data('property_size_unit')).trigger('change');
                $('#plot_no').val($(e.relatedTarget).data('plot_no'));

            }
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
                        url: '/property/' + id,
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: "json",
                        success: function(response) {
                            toastr.success(response.message);
                            $('#propertyTable').DataTable().ajax.reload();
                        }
                    });

                } else {
                    toastr.error(errors.responseJSON.message);
                }
            });
        }
    </script>
@endsection
