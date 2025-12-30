  <div class="modal fade" id="modal-installment">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Instalment</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <form action="" id="installmentForm">
                  @csrf
                  <input type="hidden" name="id" id="installment_id">
                  <div class="modal-body">
                      <div class="card-body">
                          {{-- <div class="form-group row">
                              @if (auth()->user()->company_id)
                                  <input type="hidden" name="company_id" id="company_id"
                                      value="{{ auth()->user()->company_id }}">
                              @else
                              <label class="col-sm-3 col-form-label">Company</label>
                              <select class="form-control select2 col-sm-9" style="width: 75%;" name="company_id"
                                  id="company_id">
                                  <option value="">Select Company</option>
                                  {{ $company_dropdown }}
                              </select>
                              @endif
                          </div> --}}


                          <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label asterisk">Installment</label>
                              <input type="number" name="installment_name" id="installment_name"
                                  class="col-sm-9 form-control" id="inputEmail3" placeholder="Installment" required>
                          </div>
                          <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-3 col-form-label asterisk">Interval</label>
                              <input type="number" name="interval" id="interval" min="1" step="1"
                                  class="col-sm-9 form-control" id="inputEmail3" placeholder="Interval" required>
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
  <script>
      $('#installmentForm').submit(function(e) {
          e.preventDefault();
          //   $('#company_id').prop('disabled', false);
          //   const instform = $(this);
          //   instform.find('select[name="company_id"]').prop('disabled', false);

          var form = document.getElementById('installmentForm');
          var fdata = new FormData(form);

          $.ajax({
              type: "POST",
              url: "{{ route('installment.store') }}",
              data: fdata,
              dataType: "json",
              processData: false,
              contentType: false,
              success: function(response) {
                  toastr.success(response.message);
                  console.log(response);
                  //   window.location.reload();
                  @if (request()->is('installment'))
                      window.location.reload();
                  @else
                      let newOption = new Option(response.data.installment_name, response.data.id,
                          true,
                          true);
                      //   console.log(newOption);

                      $('#no_of_installments').prepend(newOption).val(response.data.id).trigger(
                          'change');
                      $('#interval').val(response.data.interval);

                      //   instform[0].reset();
                      //   instform.find('select[name="company_id"]').prop('disabled', true);


                      $('#modal-installment').modal('hide');
                  @endif
              },
              error: function(errors) {
                  toastr.error(errors.responseJSON.message);
                  //   if ($('#installment_id').val()) {
                  //       $('#company_id').prop('disabled', true);
                  //   }

              }
          });
      });
  </script>
