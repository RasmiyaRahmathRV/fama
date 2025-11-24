<div class="card card-secondary">
    <div class="card-header">
        <h4 class="card-title w-100 row">
            <a class="d-block w-100" data-toggle="collapse" href="#collapse{{ $key }}">
                Unit
                {{ $unitNumbers }}


                <span class="badge badge-light float-lg-right"> Total Agreements
                    :
                    {{ count($agreementUnits) }}</span>
            </a>
        </h4>
    </div>
    <div id="collapse{{ $key }}" class="collapse" data-parent="#accordion">
        <div class="card-body">
            <div class="col-12 table-responsive card-body">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="bg-gradient-pink info-box-icon"><i class="fas fa-lock"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Occupied</span>
                                <span class="info-box-number">{{ $unitdetail->subunit_occupied_count }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="bg-gradient-pink info-box-icon"><i class="fas fa-unlock"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Vacant</span>
                                <span class="info-box-number">{{ $unitdetail->subunit_vacant_count }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="bg-gradient-pink info-box-icon"><i class="fas fa-hand-holding-usd"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Payment Received</span>
                                <span class="info-box-number">{{ $unitdetail->total_payment_received }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box">
                            <span class="bg-gradient-pink info-box-icon"><i class="fas fa-funnel-dollar"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Payment Pending</span>
                                <span class="info-box-number">{{ $unitdetail->total_payment_pending }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <div class="d-flex justify-content-center row">
                    @foreach ($agreementUnits as $agreementUnit)
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header bg-gradient-olive">
                                    <h4 class="card-title w-100">
                                        {{ $agreementUnit->agreement->agreement_code }}
                                        -
                                        {{ $agreementUnit->agreement->tenant->tenant_name . '(' . $agreementUnit->agreement->tenant->nationality->nationality_name . ')' }}
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <tr>
                                            <th>#</th>
                                            <th>Document name</th>
                                            <th>view</th>
                                        </tr>
                                        @if ($agreementUnit->agreement->agreement_documents->isNotEmpty())
                                            @foreach ($agreementUnit->agreement->agreement_documents as $agreement_document)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $agreement_document->TenantIdentity->identity_type }}
                                                    </td>
                                                    <td><a href="{{ asset('storage/' . $agreement_document->original_document_path) }}"
                                                            target="_blank" class="btn btn-sm btn-outline-info"
                                                            title="Click to View">
                                                            <i class="fas fa-eye"></i>
                                                        </a></td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3">No documents uploaded...</td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- <table class="table">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Document name</th>
                                                            <th>view</th>
                                                        </tr>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Emirates ID</td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>Passport</td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
                                                            <td>Visa</td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>4</td>
                                                            <td>Agreement</td>
                                                            <td></td>
                                                        </tr>

                                                    </table> --}}
        </div>
    </div>
</div>
