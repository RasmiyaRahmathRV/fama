<div class="modal fade" id="modal-nationality">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nationality</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="NationalityForm">
                @csrf
                <input type="hidden" name="id" id="nationality_id">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group row">
                            {{-- @if (auth()->user()->company_id)
                                <input type="hidden" name="company_id" id="company_id"
                                    value="{{ auth()->user()->company_id }}">
                            @else --}}
                            <label class="col-sm-4 col-form-label">Company</label>
                            <select class="form-control select2 col-sm-8" name="company_id" id="company_id">
                                <option value="">Select Company</option>
                                {{ $company_dropdown }}
                            </select>
                            {{-- @endif --}}
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Nationality Name</label>
                            <input type="text" name="nationality_name" id="nationality_name"
                                class="col-sm-8 form-control" id="inputEmail3" placeholder="Nationality Name">
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Short Code</label>
                            <input type="text" name="nationality_short_code" id="nationality_short_code"
                                class="col-sm-8 form-control" id="inputEmail3" placeholder="Short Code">
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
    $('#NationalityForm').submit(function(e) {
        e.preventDefault();
        $('#company_id').prop('disabled', false);

        var form = document.getElementById('NationalityForm');
        var fdata = new FormData(form);

        $.ajax({
            type: "POST",
            url: "{{ route('nationality.store') }}",
            data: fdata,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function(response) {
                toastr.success(response.message);
                // window.location.reload();
                @if (request()->is('nationality'))
                    window.location.reload();
                @else
                    let newOption = new Option(response.data.nationality_name, response.data
                        .id, true,
                        true);
                    // console.log(newOption);

                    $('#nationality_id').prepend(newOption).val(response.data.id).trigger(
                        'change');

                    if (document.activeElement) {
                        document.activeElement.blur();
                    }

                    $('#modal-nationality').modal('hide');
                @endif
            },
            error: function(errors) {
                toastr.error(errors.responseJSON.message);
                if ($('#nationality_id').val()) {
                    $('#company_id').prop('disabled', true);
                }
            }
        });
    });
</script>
