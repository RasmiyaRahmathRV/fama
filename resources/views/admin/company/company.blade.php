@extends('admin.layout.admin_master')

@section('custom_css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Company</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active">Company</li>
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
                            @can('company.add')
                                <div class="card-header">
                                    <!-- <h3 class="card-title">Area Details</h3> -->
                                    <span class="float-right">
                                        <button class="btn btn-info float-right m-1" data-toggle="modal"
                                            data-target="#modal-company">Add Company</button>

                                    </span>
                                </div>
                            @endcan
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="companyTable" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Company Name</th>
                                            <th>Industry</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Website</th>
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


            <div class="modal fade" id="modal-company">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Company</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="" id="companyForm">
                            @csrf
                            <input type="hidden" name="id" id="company_id">
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label for="inputEmail3" class="col-form-label">Company Name</label>
                                            <input type="text" name="company_name" id="company_name" class="form-control"
                                                id="inputEmail3" placeholder="Company Name">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="industry_id" class="col-form-label">Industry</label>
                                            <select name="industry_id" id="industry_id" class="form-control select2"
                                                style="width: 100%;">
                                                <option value="">-- Select Industry --</option>
                                                @foreach ($industries as $industry)
                                                    <option value="{{ $industry->id }}">{{ $industry->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label for="inputEmail3" class="col-form-label">Website</label>
                                            <input type="text" name="website" id="website" class="form-control"
                                                id="inputEmail3" placeholder="Website">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="inputEmail3" class="col-form-label">Phone</label>
                                            <input type="number" name="phone" id="phone" class="form-control"
                                                id="inputEmail3" placeholder="Phone">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label for="inputEmail3" class="col-form-label">Email</label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                id="inputEmail3" placeholder="Email">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="inputEmail3" class="col-form-label">Address</label>
                                            <textarea name="address" class="form-control" id="address"></textarea>

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


        </section>
        <!-- /.content -->
    </div>
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
        $('#companyForm').submit(function(e) {
            e.preventDefault();
            $('#company_id').prop('disabled', false);

            var form = document.getElementById('companyForm');
            var fdata = new FormData(form);

            $.ajax({
                type: "POST",
                url: "{{ route('company.store') }}",
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

                }
            });
        });

        $(function() {
            let table = $('#companyTable').DataTable({
                processing: true,
                serverSide: true,

                ajax: {
                    url: "{{ route('company.list') }}",
                    data: function(d) {
                        // d.company_id = $('#companyFilter').val();
                    },
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'companies.id',
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: 'company_name',
                        name: 'companies.company_name',
                    },
                    {
                        data: 'industry_name',
                        name: 'industries.name',
                    },
                    {
                        data: 'address',
                        name: 'companies.address',
                    },
                    {
                        data: 'phone',
                        name: 'companies.phone',
                    },
                    {
                        data: 'email',
                        name: 'companies.email',
                    },
                    {
                        data: 'website',
                        name: 'companies.website',
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
                    title: 'Vendor Data',
                    action: function(e, dt, node, config) {
                        // redirect to your Laravel export route
                        let searchValue = dt.search();
                        let url = "{{ route('company.export') }}" + "?search=" +
                            encodeURIComponent(searchValue);
                        window.location.href = url;
                    }
                }]
            });
        });

        $('#modal-company').on('show.bs.modal', function(event) {
            let rowData = $(event.relatedTarget).data('row');

            if (rowData) {
                $('#company_id').val(rowData.id);
                $.each(rowData, function(key, value) {
                    // If an element with same id exists, set its value/text
                    let $el = $('#' + key);

                    if ($el.is('input, textarea')) {
                        $el.val(value);
                    } else if ($el.is('select')) {
                        $el.val(value).trigger('change');;
                    } else {
                        $el.text(value);
                    }
                });
            } else {
                // Clear all inputs and selects
                $(this).find('select').val('').trigger('change');
                $(this).find('form')[0].reset();
            }
        });

        function deleteConf(id) {
            // alert(id);
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
                        url: '/company/' + id,
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: "json",
                        success: function(response) {
                            toastr.success(response.message);
                            $('#companyTable').DataTable().ajax.reload();
                        }
                    });

                } else {
                    toastr.error(errors.responseJSON.message);
                }
            });
        }
    </script>
@endsection
