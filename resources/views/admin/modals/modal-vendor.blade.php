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

                         {{-- Vendor Basic Info --}}
                         <div class="form-group row">
                             <div class="col-sm-4">
                                 <label class="asterisk">Vendor Name</label>
                                 <input type="text" name="vendor_name" id="vendor_name" class="form-control"
                                     placeholder="Vendor Name" required>
                             </div>
                             <div class="col-sm-4">
                                 <label class="asterisk">Vendor Phone</label>
                                 <input type="number" name="vendor_phone" pattern="[0-9]{9}" id="vendor_phone"
                                     class="form-control" placeholder="0551234567" required>
                             </div>
                             <div class="col-sm-4">
                                 <label class="asterisk">Vendor Email</label>
                                 <input type="email" name="vendor_email" id="vendor_email" class="form-control"
                                     placeholder="Vendor Email" required>
                             </div>
                         </div>

                         {{-- Company / Landline / Accountant --}}
                         <div class="form-group row">
                             {{-- Uncomment if company selection needed --}}
                             {{-- <div class="col-sm-3">
                    <label>Company</label>
                    <select class="form-control select2" name="company_id" id="company_id">
                        <option value="">Select Company</option>
                        {{ $company_dropdown }}
                    </select>
                </div> --}}
                             <div class="col-sm-3">
                                 <label>Landline Number</label>
                                 <input type="number" name="landline_number" pattern="[0-9]{9}" id="landline_number"
                                     class="form-control" placeholder="04-1234567">
                             </div>
                             <div class="col-sm-3">
                                 <label>Accountant Name</label>
                                 <input type="text" name="accountant_name" id="accountant_name" class="form-control"
                                     placeholder="Accountant Name">
                             </div>
                             <div class="col-sm-3">
                                 <label>Accountant Phone</label>
                                 <input type="number" name="accountant_phone" pattern="[0-9]{9}" id="accountant_phone"
                                     class="form-control" placeholder="0551234567">
                             </div>
                             <div class="col-sm-3">
                                 <label>Accountant Email</label>
                                 <input type="email" name="accountant_email" id="accountant_email"
                                     class="form-control" placeholder="Accountant Email">
                             </div>
                         </div>

                         {{-- Vendor Address & Contact Person --}}
                         <div class="form-group row">
                             <div class="col-sm-6">
                                 <label class="asterisk">Vendor Address</label>
                                 <textarea name="vendor_address" id="vendor_address" class="form-control" rows="2" placeholder="Vendor Address"
                                     required></textarea>
                             </div>
                             <div class="col-sm-6">
                                 <div class="row">
                                     <div class="col-sm-4">
                                         <label class="asterisk">Contact Person</label>
                                         <input type="text" name="contact_person" id="contact_person"
                                             class="form-control" placeholder="Contact Person" required>
                                     </div>
                                     <div class="col-sm-4">
                                         <label class="asterisk">Contact Phone</label>
                                         <input type="number" name="contact_person_phone" pattern="[0-9]{9}"
                                             id="contact_person_phone" class="form-control" placeholder="0551234567"
                                             required>
                                     </div>
                                     <div class="col-sm-4">
                                         <label class="asterisk">Contact Email</label>
                                         <input type="email" name="contact_person_email" id="contact_person_email"
                                             class="form-control" placeholder="Contact Email" required>
                                     </div>
                                 </div>
                             </div>
                         </div>

                         {{-- Contract Template / Location / Remarks / Status --}}
                         <div class="form-group row">
                             <div class="col-sm-3">
                                 <label class="asterisk">Contract Template</label>
                                 <select class="form-control select2" name="contract_template_id"
                                     id="contract_template_id" required>
                                     <option value="">Select Template</option>
                                     {{ $contract_templates_dropdown }}
                                 </select>
                             </div>
                             <div class="col-sm-3">
                                 <label>Location</label>
                                 <textarea name="location" id="location" class="form-control" rows="2" placeholder="Enter location details"></textarea>
                             </div>
                             <div class="col-sm-4">
                                 <label>Remarks</label>
                                 <textarea name="remarks" id="remarks" class="form-control" rows="2"
                                     placeholder="Any additional notes or remarks"></textarea>
                             </div>
                             <div class="col-sm-2">
                                 <label class="asterisk">Status</label>
                                 <select name="status" id="status" class="form-control" required>
                                     <option value="1" default>Active</option>
                                     <option value="0">Inactive
                                     </option>
                                 </select>
                             </div>
                         </div>

                     </div>
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
                 // $('#company_id').prop('disabled', true);
                 //  $(this).find('select[name="company_id"]').prop('disabled', false);


             }
         });
     });
 </script>
