<div class="modal fade" id="modal-bank">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Bank</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="BankForm">
                @csrf
                <input type="hidden" name="id" id="bank_id">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group row">
                            @if (auth()->user()->company_id)
                                <input type="hidden" name="company_id" id="company_id"
                                    value="{{ auth()->user()->company_id }}">
                            @else
                                <label class="col-sm-3 col-form-label">Company</label>
                                <select class="form-control select2 col-sm-9" name="company_id" id="company_id">
                                    <option value="">Select Company</option>
                                    {{ $company_dropdown }}
                                </select>
                            @endif
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Bank Name</label>
                            <input type="text" name="bank_name" id="bank_name" class="col-sm-9 form-control"
                                id="inputEmail3" placeholder="Bank Name">
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Short Code</label>
                            <input type="text" name="bank_short_code" id="bank_short_code"
                                class="col-sm-9 form-control" id="inputEmail3" placeholder="Bank Short Code">
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
    $('#BankForm').submit(function(e) {
        e.preventDefault();
        $('#company_id').prop('disabled', false);

        var form = document.getElementById('BankForm');
        var fdata = new FormData(form);

        $.ajax({
            type: "POST",
            url: "{{ route('bank.store') }}",
            data: fdata,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function(response) {

                toastr.success(response.message);

                @if (request()->is('bank'))
                    window.location.reload();
                @else
                    let newOption = new Option(response.data.bank_name, response.data.id, true,
                        true);
                    //  console.log(newOption);

                    $('#bank_id').prepend(newOption).val(response.data.id).trigger('change');

                    if (document.activeElement) {
                        document.activeElement.blur();
                    }

                    $('#modal-bank').modal('hide');
                @endif
            },
            error: function(errors) {
                toastr.error(errors.responseJSON.message);
                if ($('#bank_id').val()) {
                    $('#company_id').prop('disabled', true);
                }

            }
        });
    });
</script>
