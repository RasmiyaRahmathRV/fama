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
                                    {{ $industry_dropdown }}
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
                @if (request()->is('company'))
                    window.location.reload();
                @else
                    let newOption = new Option(response.data.company_name, response.data
                        .id, true,
                        true);
                    // console.log(newOption);

                    $('#company_id').prepend(newOption).val(response.data.id).trigger(
                        'change');

                    if (document.activeElement) {
                        document.activeElement.blur();
                    }

                    $('#modal-company').modal('hide');
                @endif
            },
            error: function(errors) {
                toastr.error(errors.responseJSON.message);

            }
        });
    });
</script>
