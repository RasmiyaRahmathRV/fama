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
                         <div class="form-group row">
                             <label for="inputEmail3" class="col-sm-4 col-form-label">Company</label>
                             <select class="form-control select2 col-sm-8" name="company_id" id="company_id">
                                 <option value="">Select Company</option>
                                 {{ $company_dropdown }}
                             </select>
                         </div>
                         {{-- @endif --}}
                         <div class="form-group row">
                             <label for="inputEmail3" class="col-sm-4 col-form-label">Area</label>
                             <select class="form-control select2 col-sm-8" name="area_id" id="area_select">
                                 <option value="">Select Area</option>
                             </select>
                         </div>

                         <div class="form-group row">
                             <label for="inputEmail3" class="col-sm-4 col-form-label">Locality Name</label>
                             <input type="text" name="locality_name" id="locality_name" class="col-sm-8 form-control"
                                 id="inputEmail3" placeholder="Locality Name">
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
     console.log()

     $('#company_id').on('change', function() {
         let companyId = $(this).val();
         companyChange(companyId, null);
     });

     function companyChange(companyId, areaVal) {
         let options = '<option value="">Select Area</option>';

         allAreas
             .filter(a => a.company_id == companyId)
             .forEach(a => {
                 options += `<option value="${a.id}" ${(a.id == areaVal) ? 'selected' : ''}>${a.area_name}</option>`;
             });
         $('#area_select').html(options).trigger('change');
     }


     $('#localityForm').submit(function(e) {
         e.preventDefault();
         $('#company_id').prop('disabled', false);

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
                     let newOption = new Option(response.data.locality_name, response.data.id, true,
                         true);
                     console.log(newOption);

                     $('#locality_id').prepend(newOption).val(response.data.id).trigger('change');

                     $('#modal-locality').modal('hide');
                 @endif
             },
             error: function(errors) {
                 toastr.error(errors.responseJSON.message);
             }
         });
     });
 </script>
