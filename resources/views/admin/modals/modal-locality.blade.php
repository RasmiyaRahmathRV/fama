 <div class="modal fade" id="modal-locality">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">Locality</h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form action="" id="localityForm">
                 @csrf
                 <input type="hidden" name="id" id="locality_id" value="0">
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
                             <label for="inputEmail3" class="col-sm-4 col-form-label asterisk">Area</label>
                             <select class="form-control select2 col-sm-8" name="area_id" id="area_select" required>
                                 <option value="">Select Area</option>
                                 {{ $area_dropdown }}
                             </select>
                         </div>

                         <div class="form-group row">
                             <label for="inputEmail3" class="col-sm-4 col-form-label asterisk">Locality Name</label>
                             <input type="text" name="locality_name" id="locality_name" class="col-sm-8 form-control"
                                 id="inputEmail3" placeholder="Locality Name" required>
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
     let allAreas = @json($areas);

     //  $('#company_id').on('change', function() {
     //      let companyId = $(this).val();
     //      companyChange(companyId, null);
     //  });

     //  function companyChange(companyId, areaVal) {
     //      let options = '<option value="">Select Area</option>';

     //      allAreas
     //          .filter(a => a.company_id == companyId)
     //          .forEach(a => {
     //              options += `<option value="${a.id}" ${(a.id == areaVal) ? 'selected' : ''}>${a.area_name}</option>`;
     //          });
     //      $('#area_select').html(options).trigger('change');
     //  }


     $('#localityForm').submit(function(e) {
         e.preventDefault();
         //  $('#company_id').prop('disabled', false);
         const locform = $(this);
         //  locform.find('select[name="company_id"]').prop('disabled', false);
         locform.find('select[name="area_id"]').prop('disabled', false);


         var form = document.getElementById('localityForm');
         var fdata = new FormData(form);

         $.ajax({
             type: "POST",
             url: "{{ route('locality.store') }}",
             data: fdata,
             dataType: "json",
             processData: false,
             contentType: false,
             success: function(response) {
                 toastr.success(response.message);
                 @if (request()->is('locality'))
                     window.location.reload();
                 @else
                     //  let newOption = new Option(response.data.locality_name, response.data.id, true,
                     //      true);
                     //  //  console.log(newOption);

                     //  $('#vc_locality_id').prepend(newOption).val(response.data.id).trigger('change');

                     let newLocality = {
                         id: response.data.id,
                         name: response.data.locality_name
                     };

                     // 1️⃣ Create and prepend new option
                     let newOption = new Option(newLocality.name, newLocality.id, true, true);
                     $('#vc_locality_id')
                         .prepend(newOption) // adds at top
                         .val(newLocality.id) // select it
                         .trigger('change'); // refresh select2

                     // 2️⃣ Store globally for use elsewhere (like vendor modal)
                     window.lastAddedLocalityId = newLocality.id;
                     window.lastAddedLocalityName = newLocality.name;

                     window.lastAddedLocalityIdCopy = newLocality.id;
                     window.lastAddedLocalityNameCopy = newLocality.name;

                     if (document.activeElement) {
                         document.activeElement.blur();
                     }
                     locform[0].reset();
                     locform.find('select[name="company_id"]').prop('disabled', true);
                     locform.find('select[name="area_id"]').prop('disabled', true);

                     $('#modal-locality').modal('hide');
                 @endif
             },
             error: function(errors) {
                 toastr.error(errors.responseJSON.message);
             }
         });
     });
     $('#modal-locality').on('hidden.bs.modal', function() {
         const $modal = $(this);
         const $form = $modal.find('form#localityForm');

         $form[0].reset();
         // Set status default value to 1
         //  $form.find('select[name="status"]').val('1').trigger('change');

         //  $form.find(
         //      'select[name="company_id"], select[name="area_id"]]'
         //  ).each(function() {
         //      const $select = $(this);

         //      $select.empty();

         //      $select.val(null).trigger('change');

         //      $select.prop('disabled', false);
         //  });

     });
 </script>
