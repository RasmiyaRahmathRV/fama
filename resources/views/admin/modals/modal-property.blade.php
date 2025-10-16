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

                             {{-- @if (auth()->user()->company_id)
                                 <input type="hidden" name="company_id" id="company_id"
                                     value="{{ auth()->user()->company_id }}">
                             @else --}}
                             <div class="col-sm-4">
                                 <label>Company</label>
                                 <select class="form-control select2" name="company_id" id="company_id">
                                     <option value="">Select Company</option>
                                     {{ $company_dropdown }}
                                 </select>
                             </div>
                             {{-- @endif --}}
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
                             {{-- <div class="col-sm-6">
                                 <label for="inputEmail3" class="col-form-label">Property Type</label>
                                 <select class="form-control select2" name="property_type_id" id="property_type_id">
                                     <option value="">Select Property Type</option>
                                 </select>
                             </div> --}}
                             <div class="col-sm-6">
                                 <label for="inputEmail3" class="col-form-label">Property Name</label>
                                 <input type="text" name="property_name" id="property_name" class="form-control"
                                     id="inputEmail3" placeholder="Property Name">
                             </div>
                             <div class="col-sm-6">
                                 <label>Property Size</label>
                                 <div class="input-group input-group">
                                     <div class="input-group-prepend">
                                         <select name="property_size_unit" id="property_size_unit">
                                             <option value="">Select Unit</option>
                                             {{ $propertySizeUnits_dropdown }}

                                         </select>
                                     </div>
                                     <!-- /btn-group -->
                                     <input type="number" name="property_size" id="property_size" class="form-control"
                                         placeholder="Property Size">
                                 </div>
                             </div>
                         </div>

                         <div class="form-group row">

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
 <script>
     let Areas = @json($areas);
     let allLocalities = @json($localities);
     let allpropertytypes = @json($property_types);

     $('#company_id').on('change', function() {
         let companyId = $(this).val();
         companyChange(companyId, null); // reset areaVal when adding
     });

     function companyChange(companyId, areaVal, propertytypeVal, localityVal) {
         let options = '<option value="">Select Area</option>';
         let options2 = '<option value="">Select Property Type</option>';

         Areas
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
         //  $('#company_id').prop('disabled', false);
         const ptform = $(this);
         ptform.find('select[name="company_id"]').prop('disabled', false);
         ptform.find('select[name="area_id"]').prop('disabled', false);
         ptform.find('select[name="locality_id"]').prop('disabled', false);
         ptform.find('select[name="property_type_id"]').prop('disabled', false);



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
                 //  window.location.reload();
                 @if (request()->is('property'))
                     window.location.reload();
                 @else
                     let newOption = new Option(response.data.property_name, response.data.id, true,
                         true);
                     //  console.log(newOption);

                     $('#vc_property_id').prepend(newOption).val(response.data.id).trigger('change');
                     if (document.activeElement) {
                         document.activeElement.blur();
                     }
                     ptform[0].reset();
                     ptform.find('select[name="company_id"]').prop('disabled', true);
                     ptform.find('select[name="area_id"]').prop('disabled', true);
                     ptform.find('select[name="locality_id"]').prop('disabled', true);
                     ptform.find('select[name="property_type_id"]').prop('disabled', true);
                     $('#modal-property').modal('hide');
                 @endif
             },
             error: function(errors) {
                 toastr.error(errors.responseJSON.message);
                 //  if ($('#property_id').val()) {
                 //      $('#company_id').prop('disabled', true);
                 //  }

             }
         });
     });

     $('#modal-property').on('hidden.bs.modal', function() {
         const $modal = $(this);
         const $form = $modal.find('form#PropertyForm');

         $form[0].reset();

         $form.find(
             'select[name="company_id"], select[name="area_id"], select[name="locality_id"]]'
         ).each(function() {
             const $select = $(this);

             $select.empty();

             $select.val(null).trigger('change');

             $select.prop('disabled', false);
         });
     });
 </script>
