<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <input type="hidden" id="report_investment_id" value="{{ $investment_id }}">
                        <div class="card card-info">
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="form-horizontal">
                                <div class="form-group row m-4">
                                    <div class="col-md-2">
                                        <label for="exampleInputEmail1">From</label>
                                        <div class="input-group date" id="dateFrom" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input"
                                                data-target="#dateFrom" id="date_From" placeholder="dd-mm-YYYY"
                                                value="{{ request('from_date', date('01-m-Y')) }}" />
                                            <div class="input-group-append" data-target="#dateFrom"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="exampleInputEmail1">To</label>
                                        <div class="input-group date" id="dateTo" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input"
                                                data-target="#dateTo" id="date_To" placeholder="dd-mm-YYYY"
                                                value="{{ request('from_date', date('d-m-Y')) }}" />
                                            <div class="input-group-append" data-target="#dateTo"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-info searchbtnchq">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->

                        <div class="card">
                            <div class="card-body">
                                <table id="payoutPendingTable" class="table table-bordered table-hover" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Investor Name</th>
                                            {{-- <th style="width: 5%">Investment Amount</th> --}}
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
