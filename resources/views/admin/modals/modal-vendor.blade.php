 <div class="modal fade" id="modal-vendor">
     <div class="modal-dialog modal-xl">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">Vendor</h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form action="" id="VendorForm">
                 @csrf
                 <input type="hidden" name="id" id="vendor_id">
                 <div class="modal-body">
                     <div class="card-body">
                         <div class="form-group row">

                             <div class="col-sm-5">
                                 <label>Vendor Name</label>
                                 <input type="text" name="vendor_name" id="vendor_name" class="form-control"
                                     id="inputEmail3" placeholder="Vendor Name">
                             </div>
                             <div class="col-sm-3">
                                 <label>Vendor Phone</label>
                                 <input type="number" name="vendor_phone" pattern="[0-9]{9}" id="vendor_phone"
                                     class="form-control" id="inputEmail3" placeholder="0551234567">
                             </div>
                             <div class="col-sm-4">
                                 <label>Vendor Email</label>
                                 <input type="email" name="vendor_email" id="vendor_email" class="form-control"
                                     id="inputEmail3" placeholder="Vendor email">
                             </div>
                         </div>

                         <div class="form-group row">
                             {{-- @if (auth()->user()->company_id)
                                 <input type="hidden" name="company_id" id="company_id"
                                     value="{{ auth()->user()->company_id }}">
                             @else --}}
                             <div class="col-sm-3">
                                 <label>Company</label>
                                 <select class="form-control select2" name="company_id" id="company_id">
                                     <option value="">Select Company</option>
                                     {{ $company_dropdown }}
                                 </select>
                             </div>
                             {{-- @endif --}}

                             <div class="col-sm-3">
                                 <label>Accountant Name</label>
                                 <input type="text" name="accountant_name" id="accountant_name" class="form-control"
                                     id="inputEmail3" placeholder="Accountant name">
                             </div>
                             <div class="col-sm-3">
                                 <label>Accountant Phone</label>
                                 <input type="number" name="accountant_phone" pattern="[0-9]{9}" id="accountant_phone"
                                     class="form-control" id="inputEmail3" placeholder="0551234567">
                             </div>
                             <div class="col-sm-3">
                                 <label>Accountant Email</label>
                                 <input type="email" name="accountant_email" id="accountant_email"
                                     class="form-control" id="inputEmail3" placeholder="Accountant Email">
                             </div>
                         </div>

                         <div class="form-group row">
                             <div class="col-sm-3">
                                 <label>Vendor Address</label>
                                 <textarea name="vendor_address" id="vendor_address" class="form-control"></textarea>
                             </div>
                             <div class="col-sm-3">
                                 <label>Contact person</label>
                                 <input type="text" name="contact_person" id="contact_person" class="form-control"
                                     id="inputEmail3" placeholder="Contact person">
                             </div>
                             <div class="col-sm-3">
                                 <label>Contact phone</label>
                                 <input type="number" name="contact_person_phone" pattern="[0-9]{9}"
                                     id="contact_person_phone" class="form-control" id="inputEmail3"
                                     placeholder="0551234567">
                             </div>
                             <div class="col-sm-3">
                                 <label>Contact email</label>
                                 <input type="email" name="contact_person_email" id="contact_person_email"
                                     class="form-control" id="inputEmail3" placeholder="Contact Email">
                             </div>
                         </div>

                         <div class="form-group row">

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
     $('#VendorForm').submit(function(e) {
         e.preventDefault();

         //  $('#company_id').prop('disabled', false);
         const venform = $(this);
         venform.find('select[name="company_id"]').prop('disabled', false);

         var form = document.getElementById('VendorForm');
         var fdata = new FormData(form);


         $.ajax({
             type: "POST",
             url: "{{ route('vendors.store') }}",
             data: fdata,
             dataType: "json",
             processData: false,
             contentType: false,
             success: function(response) {
                 toastr.success(response.message);
                 //  window.location.reload();
                 @if (request()->is('vendors'))
                     window.location.reload();
                 @else
                     let newOption = new Option(response.data.vendor_name, response.data.id, true,
                         true);
                     //  console.log(newOption);

                     $('#vc_vendor_id').prepend(newOption).val(response.data.id).trigger('change');

                     if (document.activeElement) {
                         document.activeElement.blur();
                     }
                     //  $(this).find('select[name="company_id"]').prop('disabled', true);
                     venform[0].reset();
                     venform.find('select[name="company_id"]').prop('disabled', true);


                     $('#modal-vendor').modal('hide');
                 @endif
             },
             error: function(errors) {
                 toastr.error(errors.responseJSON.message);
                 //  if ($('#vendor_id').val()) {
                 //      $('#company_id').prop('disabled', true);
                 //  }
                 $('#company_id').prop('disabled', true);
                 $(this).find('select[name="company_id"]').prop('disabled', false);


             }
         });
     });
 </script>
