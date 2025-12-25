<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title text-teal text-bold">
            <i class="fas fa-file-invoice-dollar mr-2"></i> Investment Details
        </h3>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-striped ">
                <thead class="bg-light">
                    <tr>
                        {{-- <th>#</th> --}}
                        <th>Investment Code</th>
                        <th>Investment Date</th>
                        <th>Investment Amount</th>
                        <th>Received</th>
                        <th>Pending</th>
                        <th>Profit</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>{{ $investment->investment_code }}</td>
                        <td>{{ getFormattedDate($investment->investment_date) }}</td>
                        <td>{{ number_format($investment->investment_amount, 2) }}</td>
                        <td class="text-success">
                            {{ number_format($investment->total_received_amount, 2) }}
                        </td>
                        <td class="text-danger">
                            {{ number_format($investment->balance_amount, 2) }}
                        </td>
                        <td class="text-info">
                            {{ number_format($investment->profit_amount, 2) }}
                        </td>
                        <td>
                            @if ($investment->investment_status == 1)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-secondary">Closed</span>
                            @endif
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

    </div>

</div>
<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title text-teal text-bold">
            <i class="fas fa-file-invoice-dollar mr-2"></i> Profit Release Details
        </h3>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-striped ">
                <thead class="bg-light">
                    <tr>
                        {{-- <th>#</th> --}}
                        <th>Profit Release Due on</th>
                        <th>Current Month Pending</th>

                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            <span class="badge badge-light text-sm">
                                {{ getFormattedDate($investment->next_profit_release_date) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-light text-sm text-danger">
                                {{ number_format($investment->current_month_pending, 2) }}
                            </span>
                        </td>

                    </tr>

                </tbody>
            </table>
        </div>

    </div>

</div>
<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title text-teal text-bold">
            <i class="fas fa-user mr-2"></i> Nominee Details
        </h3>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="bg-light">
                    <tr>
                        {{-- <th>#</th> --}}
                        <th>Nominee Name</th>
                        <th>Nominee Email</th>
                        <th>Nominee Phone</th>

                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>{{ $investment->nominee_name ?? ' - ' }}</td>
                        <td>{{ $investment->nominee_email ?? ' - ' }}</td>
                        <td>{{ $investment->nominee_phone ?? ' - ' }}</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

</div>

<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title text-teal text-bold">
            <i class="fas fa-file-alt mr-2"></i> Investment Document
        </h3>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="bg-light">
                    <tr>
                        <th>Uploaded On</th>
                        <th>Type</th>
                        <th>File</th>
                    </tr>
                </thead>

                <tbody>
                    @if ($document)
                        <tr>
                            <td>
                                {{ $document->created_at?->format('d M Y') ?? '-' }}
                            </td>
                            <td>Contract File</td>

                            <td>
                                @if (!empty($document->investment_contract_file_path))
                                    <a href="{{ asset('storage/' . $document->investment_contract_file_path) }}"
                                        target="_blank" class="btn btn-xs btn-primary">
                                        <i class="fas fa-eye"></i> view
                                    </a>

                                    <a href="{{ asset('storage/' . $document->investment_contract_file_path) }}"
                                        download class="btn btn-xs btn-success">
                                        <i class="fas fa-download"></i>Download
                                    </a>
                                @endif

                            </td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                <i class="fas fa-exclamation-triangle"></i>
                                No document found for this investment
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
