 <div class="card card-outline card-info">
     <div class="card-header">
         <h3 class="card-title text-bold text-teal">
             <i class="fas fa-file-invoice-dollar mr-1"></i> Received History
         </h3>
     </div>

     <div class="card-body p-0">
         <div class="table-responsive">
             <table class="table  table-striped table-hover">
                 <thead>
                     <tr>
                         <th>#</th>
                         <th>Received Amount</th>
                         <th>Received Date</th>

                         <th>Action</th>
                     </tr>
                 </thead>

                 <tbody>
                     @forelse ($received as $payment)
                         <tr>
                             <td>{{ $loop->iteration }}</td>

                             <td class="text-success font-weight-bold">
                                 {{ number_format($payment->received_amount, 2) }}
                             </td>

                             <td>
                                 <span class="badge badge-light text-sm">
                                     {{ getFormattedDate($payment->received_date) }}
                                 </span>
                             </td>


                             <td class="text-center">
                                 @if ($loop->last)
                                     <button type="button" class="btn btn-sm btn-info openPendingModal"
                                         data-id="{{ $payment->id }}"
                                         data-amount="{{ $payment->received_amount }}"data-date="{{ $payment->received_date ? \Carbon\Carbon::parse($payment->received_date)->format('d-m-Y') : '' }}"
                                         data-balance="{{ $investment->balance_amount }}"
                                         data-investment-id="{{ $investment->id }}"
                                         data-investor-id="{{ $investment->investor_id }}">
                                         <i class="fas fa-edit"></i>
                                     </button>
                                 @else
                                     —
                                 @endif
                             </td>
                         </tr>
                     @empty
                         <tr>
                             <td colspan="5" class="text-center text-muted">
                                 No Data Found
                             </td>
                         </tr>
                     @endforelse
                 </tbody>
             </table>
         </div>
     </div>


 </div>

 <div class="modal fade" id="pendingInvestmentModal" tabindex="-1">
     <div class="modal-dialog">
         <form id="pendingInvestmentForm">
             @csrf
             <input type="hidden" name="payment_id" id="payment_id">
             <input type="hidden" name="investment_id" id="investment_id">
             <input type="hidden" name="investor_id" id="investor_id">

             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title">Submit Pending Investment</h5>
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                 </div>

                 <div class="modal-body">
                     <div class="form-group">
                         <label>Pending Balance Amount</label>
                         <input type="text" id="pending_balance" class="form-control font-weight-bold text-danger"
                             readonly>
                     </div>
                     <div class="form-group">
                         <label>Received Date</label>
                         {{-- <input type="date" name="received_date" class="form-control" required>
                                    <label class="asterisk">Investment Date</label> --}}
                         <div class="input-group date" id="receiveddate" data-target-input="nearest">
                             <input type="text" class="form-control datetimepicker-input" name="received_date"
                                 id="received_date" data-target="#receiveddate" placeholder="DD-MM-YYYY" required>
                             <div class="input-group-append" data-target="#receiveddate" data-toggle="datetimepicker">
                                 <div class="input-group-text">
                                     <i class="fa fa-calendar"></i>
                                 </div>
                             </div>
                         </div>
                     </div>

                     <div class="form-group">
                         <label>Received Amount</label>
                         <input type="number" name="received_amount" id="received_amount" class="form-control"
                             step="0.01" min="0" required>
                     </div>
                 </div>

                 <div class="modal-footer">
                     <button type="submit" class="btn btn-success">
                         <i class="fas fa-check-circle"></i> Submit
                     </button>
                 </div>
             </div>
         </form>
     </div>
 </div>
