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
                         {{-- <th>Added By</th>
                     <th>Updated By</th> --}}
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
                                 <span class="badge badge-light">
                                     {{ getFormattedDate($payment->received_date) }}
                                 </span>
                             </td>

                             {{-- <td>
                             <span class="text-primary">
                                 {{ $payment->addedBy->first_name . ' ' . $payment->addedBy->last_name }}
                             </span>
                         </td>

                         <td>
                             @if ($payment->updatedBy)
                                 <span class="text-warning">
                                     {{ $payment->updatedBy->first_name . ' ' . $payment->updatedBy->last_name }}
                                 </span>
                             @else
                                 <span class="text-muted">—</span>
                             @endif
                         </td> --}}
                             <td class="text-center">
                                 <button type="button" class="btn btn-sm btn-info editPaymentBtn"
                                     data-id="{{ $payment->id }}" data-amount="{{ $payment->received_amount }}"
                                     data-date="{{ $payment->received_date }}">
                                     <i class="fas fa-edit"></i>
                                 </button>
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
