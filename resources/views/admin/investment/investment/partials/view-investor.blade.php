 <!-- Post -->
 <div class="row">
     <div class="col-md-12">
         <div class="card card-info card-outline">

             {{-- <div class="card card-maroon"> --}}
             <div class="card-header d-flex align-items-center">

                 <h3 class="card-title mb-0 text-teal text-bold">
                     <i class="fas fa-user mr-1"></i>
                     {{ $investment->investor->investor_name }} -
                     {{ $investment->investor->investor_code }}

                 </h3>

                 <div class="ml-auto">
                     <a href="{{ route('investor.show', $investment->investor->id) }}" title="View Investor"
                         class="btn btn-sm btn-info bg-teal">
                         <i class="fas fa-eye mr-1"></i> View More
                     </a>
                 </div>

             </div>
             {{-- </div> --}}


             <!-- /.card-header -->
             <div class="card-body">

                 <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                 <p class="text-muted">
                     {{ $investment->investor->investor_email }}
                 </p>

                 <hr>

                 <strong><i class="fas fa-mobile-alt mr-1"></i> Mobile</strong>
                 <p class="text-muted">
                     {{ $investment->investor->investor_mobile }}
                 </p>

                 <hr>

                 <strong><i class="fas fa-flag mr-1"></i> Nationality</strong>
                 <p class="text-muted">
                     {{ $investment->investor->nationality->nationality_name ?? '' }}
                 </p>

                 <hr>

                 <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
                 <p class="text-muted">
                     {{ $investment->investor->investor_address ?? '' }}
                 </p>

                 <hr>



             </div>

             <!-- /.card-body -->
         </div>
     </div>

 </div>
