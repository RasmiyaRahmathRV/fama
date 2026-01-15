<div class="form-group row">
    <div class="col-md-4">
        <label class="asterisk">Start Date</label>
        <div class="input-group date" id="startdate" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input startdate" name="start_date" id="start_date"
                data-target="#startdate" placeholder="dd-mm-YYYY" readonly
                value="{{ $agreement->start_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $agreement->start_date)->format('d-m-Y') : '' }}" />
            <div class="input-group-append" data-target="#startdate" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <label class="asterisk">Duration in Months</label>
        <input type="number" class="form-control" id="duration_months" name="duration_in_months"
            value="{{ $agreement->duration_in_months ?? '' }}" readonly>
    </div>

    <div class="col-md-4">
        <label class="asterisk">End Dates</label>
        <div class="input-group date" id="enddate" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input enddate" id="end_date" name="end_date"
                placeholder="dd-mm-YYYY" readonly data-target="#enddate"
                value="{{ $agreement->end_date ? \Carbon\Carbon::createFromFormat('Y-m-d', $agreement->end_date)->format('d-m-Y') : '' }}" />
            <div class="input-group-append" data-target="#enddate" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>

    </div>
</div>
