<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <!-- /.card-header -->
                    <div class="card-body">
                        <input type="hidden" id="pending_investment_id" value="{{ $investment_id }}">
                        {{-- <div class="card card-info">
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="form-horizontal">
                                <div class="form-group row m-4">
                                    <div class="col-md-3">
                                        <label for="inputPassword3">Month</label>
                                        <select class="form-control select2" name="month" id="month">
                                            <option value="">Select Month</option>
                                            <?php for ($m = 1; $m <= 12; ++$m) { ?>
                                            <option value="{{ $m }}">
                                                <?= date('F', mktime(0, 0, 0, $m, 1)) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="inputPassword3">Batch</label>
                                        <select class="form-control select2" name="batch_id" id="batch_id">
                                            <option value="">Select Batch</option>
                                            @foreach ($payoutbatches as $payoutbatch)
                                                <option value="{{ $payoutbatch->id }}">
                                                    {{ $payoutbatch->batch_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="inputPassword3">Investor</label>
                                        <select class="form-control select2" name="investor_id" id="investor_id">
                                            <option value="">Select Investor</option>
                                            @foreach ($investors as $investor)
                                                <option value="{{ $investor->id }}">{{ $investor->investor_name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <!-- </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    <div class="form-group"> -->
                                    <div class="col-md-1 float-right">
                                        <button type="button" class="btn btn-info searchbtnchq">Search</button>
                                    </div>
                                </div>

                            </form>
                        </div> --}}
                        <!-- /.card -->

                        <div class="card">

                            <div class="card-body">
                                <table id="payoutPendingTable" class="table table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Payout Date</th>
                                            <th>Payout Type</th>
                                            <th>payout Amount</th>
                                            <th>Payment Mode</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

</section>
