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
                        {{-- @if (auth()->user()->company_id)
                            <input type="hidden" name="company_id" id="company_id"
                                value="{{ auth()->user()->company_id }}">
                        @else --}}
                        {{-- <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Company</label>
                            <select class="form-control select2 col-sm-8" name="company_id" id="company_id">
                                <option value="">Select Company</option>

                                {{ $company_dropdown }}
                            </select>
                        </div> --}}
                        {{-- @endif --}}

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label asterisk">Area Name</label>
                            <input type="text" name="area_name" id="area_name" class="col-sm-8 form-control"
                                id="inputEmail3" placeholder="Area Name" required>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label asterisk">Status</label>
                            <select name="status" id="status" class="col-sm-8 form-control" required>
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive
                                </option>
                            </select>
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
    $('#areaForm').submit(function(e) {
        e.preventDefault();
        // $('#company_id').prop('disabled', false);
        const areaform = $(this);
        // areaform.find('select[name="company_id"]').prop('disabled', false);

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
                // console.log(response);
                toastr.success(response.message);

                @if (request()->is('areas'))
                    window.location.reload();
                @else
                    // let newOption = new Option(response.data.area_name, response.data.id, true,
                    //     true);
                    // // console.log(newOption);

                    // $('#vc_area_id').prepend(newOption).val(response.data.id).trigger('change');

                    let newArea = {
                        id: response.data.id,
                        name: response.data.area_name
                    };

                    // 1️⃣ Create and prepend new option
                    let newOption = new Option(newArea.name, newArea.id, true, true);
                    $('#vc_area_id')
                        .prepend(newOption) // adds at top
                        .val(newArea.id) // select it
                        .trigger('change'); // refresh select2

                    // 2️⃣ Store globally for use elsewhere (like vendor modal)
                    window.lastAddedAreaId = newArea.id;
                    window.lastAddedAreaName = newArea.name;

                    window.lastAddedAreaIdCopy = newArea.id;
                    window.lastAddedAreaNameCopy = newArea.name;

                    areaform[0].reset();
                    // areaform.find('select[name="company_id"]').prop('disabled', true);
                    $('#modal-area').modal('hide');
                @endif

            },
            error: function(errors) {
                toastr.error(errors.responseJSON.message);
                // $('#company_id').prop('disabled', true);
            }
        });
    });
</script>
