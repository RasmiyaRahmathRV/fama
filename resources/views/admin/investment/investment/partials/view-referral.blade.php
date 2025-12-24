 {{-- ================= REFERRAL DETAILS ================= --}}
 <div class="card card-outline card-info mb-3">
     <div class="card-header ">
         <h3 class="card-title text-teal text-bold">
             <i class="fas fa-user-friends mr-2"></i> Referral Details
         </h3>
     </div>

     <div class="card-body p-0">
         <div class="table-responsive">
             <table class="table table-bordered table-striped table-hover mb-0">
                 <thead>
                     <tr>
                         <th class="text-center">Commission %</th>
                         <th class="text-center">Commission Amount</th>
                         <th class="text-center">Frequency</th>
                         <th>Referrer Details</th>
                         <th>Status</th>
                     </tr>
                 </thead>
                 <tbody>
                     @if ($referral)
                         <tr>
                             <td class="text-center text-success font-weight-bold">
                                 {{ number_format($referral->referral_commission_perc, 2) }}%
                             </td>
                             <td class="text-end">
                                 <span>
                                     {{ number_format($referral->referral_commission_amount, 2) }}
                                 </span>
                             </td>
                             <td class="text-info">
                                 {{ $referral->commissionFrequency->commission_frequency_name }}
                             </td>
                             <td>
                                 <a href="{{ route('investor.show', $referrer->id) }}"
                                     class="text-decoration-none text-primary font-weight-bold" title="View Referrer">
                                     {{ $referrer->investor_name }} ({{ $referrer->investor_email }})
                                 </a>
                             </td>
                             <td>
                                 @if ($referral->referral_commission_status == 1)
                                     <span class="badge badge-success">Fully Released</span>
                                 @elseif ($referral->referral_commission_status == 2)
                                     <span class="badge badge-info bg-lightblue">Partially Released</span>
                                 @else
                                     <span class="badge badge-warning">Pending</span>
                                 @endif
                             </td>
                         </tr>
                     @else
                         <tr>
                             <td colspan="4" class="text-center text-muted">
                                 <i class="fas fa-exclamation-triangle"></i> No referral data found
                             </td>
                         </tr>
                     @endif
                 </tbody>
             </table>
         </div>
     </div>
 </div>

 {{-- ================= RELEASED DETAILS ================= --}}
 <div class="card card-outline card-info mb-3">
     <div class="card-header  ">
         <h3 class="card-title text-bold text-teal">
             <i class="fas fa-coins mr-2"></i> Released Details
         </h3>
     </div>

     <div class="card-body p-0">
         <div class="table-responsive">
             <table class="table table-bordered table-striped table-hover mb-0">
                 <thead>
                     <tr>
                         <th class="text-end">Total Released</th>
                         <th class="text-end">Total Pending</th>
                         <th class="text-center">Last Released Date</th>
                         <th class="text-end">Current Month Released</th>
                         <th class="text-center">Released %</th>
                     </tr>
                 </thead>
                 <tbody>
                     @if ($referral)
                         <tr>
                             <td class="text-end">
                                 <span>{{ number_format($referral->total_commission_released, 2) }}</span>
                             </td>

                             <td class="text-end">
                                 <span>
                                     {{ number_format($referral->total_commission_pending, 2) }}
                                 </span>
                             </td>

                             <td class="text-center">
                                 {{ getFormattedDate($referral->last_referral_commission_released_date) ?? '-' }}
                             </td>

                             <td class="text-end">
                                 {{ number_format($referral->current_month_released, 2) }}
                             </td>

                             <td>

                                 {{ number_format($referral->commission_released_perc, 2) }}%

                             </td>
                         </tr>
                     @else
                         <tr>
                             <td colspan="5" class="text-center text-muted">
                                 <i class="fas fa-exclamation-triangle"></i> No released data found
                             </td>
                         </tr>
                     @endif
                 </tbody>
             </table>
         </div>
     </div>
 </div>
