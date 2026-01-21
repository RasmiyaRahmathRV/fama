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
                              <label for="inputEmail3" class="col-sm-4 col-form-label">Property Type</label>
                              <input type="text" name="property_type" id="property_type"
                                  class="col-sm-8 form-control" id="inputEmail3" placeholder="Property Type">
                          </div>
                      </div>
                      <!-- /.card-body -->
                  </div>
                  <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default closebtn" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-info savebtninfo">Save changes</button>
                  </div>
              </form>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <script>
      $('#PropertyTypeForm').submit(function(e) {
          e.preventDefault();
          //   $('#company_id').prop('disabled', false);
          const ptyform = $(this);
          ptyform.find('select[name="company_id"]').prop('disabled', false);


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

                  @if (request()->is('property_type'))
                      window.location.reload();
                  @else
                      //   let newOption = new Option(response.data.property_type, response.data.id, true,
                      //       true);
                      //   //   console.log(newOption);

                      //   $('#property_type').prepend(newOption).val(response.data.id).trigger('change');
                      let newPropertyType = {
                          id: response.data.id,
                          name: response.data.property_type
                      };

                      // 1️⃣ Create and prepend new option
                      let newOption = new Option(newPropertyType.name, newPropertyType.id, true,
                          true);
                      $('#vc_property_type_id')
                          .prepend(newOption) // adds at top
                          .val(newPropertyType.id) // select it
                          .trigger('change'); // refresh select2

                      // 2️⃣ Store globally for use elsewhere (like vendor modal)
                      window.lastAddedPropertyTypeId = newPropertyType.id;
                      window.lastAddedPropertyTypeName = newPropertyType.name;

                      if (document.activeElement) {
                          document.activeElement.blur();
                      }

                      ptyform[0].reset();
                      ptyform.find('select[name="company_id"]').prop('disabled', true);


                      $('#modal-property-type').modal('hide');
                  @endif

              },
              error: function(errors) {
                  toastr.error(errors.responseJSON.message);
                  //   $('#company_id').prop('disabled', true);
              }
          });
      });
  </script>
