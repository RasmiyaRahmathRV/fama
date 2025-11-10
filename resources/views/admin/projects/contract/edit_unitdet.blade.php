@foreach ($contract_units_details as $unitkey => $unitDetail)
    <div class="apdi profitDeletecls{{ $unitkey }}">
        <div class="form-group">
            <input type="hidden" name="unit_detail[id][]" value="{{ $unitDetail->id ?? '' }}">
            <div class="form-group row">
                <div class="col-sm-2 add-morecol2">
                    <label class="control-label"> Unit No
                    </label>
                    <input type="text" name="unit_detail[unit_number][]" class="form-control unit_no"
                        placeholder="Unit No" db-value="1" value="{{ $unitDetail->unit_number ?? '' }}" required>
                </div>
                <div class="col-sm-2 add-morecol2">
                    <label class="control-label"> Unit Type
                    </label>
                    <select class="form-control select2 unit_type" name="unit_detail[unit_type_id][]"
                        id="unit_type{{ $unitkey }}" required>
                        <option value="">Select</option>
                        @foreach ($unittypedp as $unit_type)
                            <option value="{{ $unit_type->id }}"
                                {{ $unitDetail->unit_type_id == $unit_type->id ? 'selected' : '' }}>
                                {{ $unit_type->unit_type }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-1 add-morecol2">
                    <label class="control-label"> Floor No
                    </label>
                    <input type="text" name="unit_detail[floor_no][]" class="form-control" placeholder="Floor No"
                        value="{{ $unitDetail->floor_no ?? '' }}" required>
                </div>
                <div class="col-sm-2 add-morecol2">
                    <label class="control-label"> Unit Status
                    </label>
                    <select class="form-control select2" name="unit_detail[unit_status_id][]"
                        id="unit_status{{ $unitkey }}" required>
                        <option value="">Select</option>
                        @foreach ($unitstatusdp as $unit_status)
                            <option value="{{ $unit_status->id }}"
                                {{ $unitDetail->unit_status_id == $unit_status->id ? 'selected' : '' }}>
                                {{ $unit_status->unit_status }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-2 add-morecol2">
                    <label class="control-label"> Unit Rent Per Annum </label>
                    <input type="number" name="unit_detail[unit_rent_per_annum][]"
                        class="form-control unit_rent_per_annum" placeholder="Unit Rent Per Annum"
                        value="{{ toNumeric($unitDetail->unit_rent_per_annum) ?? '' }}" required>
                </div>
                <div class="col-sm-3 add-morecol2">
                    <label class="control-label">Unit Size</label>
                    <div class="input-group input-group">
                        <div class="input-group-prepend">
                            <select name="unit_detail[unit_size_unit_id][]" id="unit_size_id{{ $unitkey }}"
                                required>
                                <option value="">Select</option>
                                @foreach ($unitsizeunitdp as $unit_size_unit)
                                    <option value="{{ $unit_size_unit->id }}"
                                        {{ $unitDetail->unit_size_unit_id == $unit_size_unit->id ? 'selected' : '' }}>
                                        {{ $unit_size_unit->unit_size_unit }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="number" name="unit_detail[unit_size][]" class="form-control"
                            placeholder="Unit Size" value="{{ $unitDetail->unit_size ?? '' }}" required>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2 add-morecol2">
                    <label class="control-label"> Property
                        type</label>

                    <select class="form-control select2" name="unit_detail[property_type_id][]" id="" required>
                        @foreach ($propertytypedp as $PropertyType)
                            <option value="{{ $PropertyType->id }}"
                                {{ $unitDetail->property_type_id == $PropertyType->id ? 'selected' : '' }}>
                                {{ $PropertyType->property_type }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4 m-4">
                    <div class="form-group clearfix">
                        <div class="icheckbox icheck-success d-inline">
                            <input type="checkbox" name="unit_detail[partition][{{ $unitkey }}]"
                                id="partition{{ $unitkey }}" class="partcheck" value="1"
                                {{ old('unit_detail.partition', $unitDetail->partition ?? '') == 1 ? 'checked' : '' }}
                                required>
                            <label class="labelpermission" for="partition{{ $unitkey }}">
                                Partition </label>
                        </div>
                        <div class="icheckbox icheck-success d-inline">
                            <input type="checkbox" name="unit_detail[partition][{{ $unitkey }}]"
                                id="bedspace{{ $unitkey }}" class="bedcheck" value="2"
                                {{ old('unit_detail.bedspace', $unitDetail->bedspace ?? '') == 1 ? 'checked' : '' }}
                                required>
                            <label class="labelpermission" for="bedspace{{ $unitkey }}">
                                Bedspace </label>
                        </div>
                        <div class="icheckbox icheck-success d-inline">
                            <input type="checkbox" name="unit_detail[partition][{{ $unitkey }}]"
                                id="room{{ $unitkey }}" class="roomcheck" value="3"
                                {{ old('unit_detail.room', $unitDetail->room ?? '') == 1 ? 'checked' : '' }} required>
                            <label class="labelpermission" for="room{{ $unitkey }}"> Room </label>
                        </div>
                        <div class="icheckbox icheck-success d-inline">
                            <input type="checkbox" name="unit_detail[maid_room][{{ $unitkey }}]"
                                id="maidroom{{ $unitkey }}" class="maidroomcheck" value="1"
                                {{ old('unit_detail.maid_room', $unitDetail->maid_room ?? '') == 1 ? 'checked' : '' }}
                                required>
                            <label class="labelpermission" for="maidroom{{ $unitkey }}"> Maid Room </label>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2 part" id="part{{ $unitkey }}">
                    <label class="control-label">Total
                        Partitions</label>
                    <input type="number" name="unit_detail[total_partition][]" class="form-control total_partitions"
                        placeholder="Total Partitions"
                        data-original-value="{{ old('unit_detail.total_partition', $unitDetail->total_partition ?? '') }}"
                        value="{{ old('unit_detail.total_partition', $unitDetail->total_partition ?? '') }}" required>
                </div>
                <div class="col-sm-2 bs" id="bs{{ $unitkey }}">
                    <label class="control-label">Total Bed Spaces</label>
                    <input type="number" name="unit_detail[total_bedspace][]" class="form-control total_bedspaces"
                        placeholder="Total Bed Spaces"
                        data-original-value="{{ old('unit_detail.total_bedspace', $unitDetail->total_bedspace ?? '') }}"
                        value="{{ old('unit_detail.total_bedspace', $unitDetail->total_bedspace ?? '') }}" required>
                </div>
                <div class="col-sm-2 rm" id="rm{{ $unitkey }}">
                    <label class="control-label">Total Room</label>
                    <input type="number" name="unit_detail[total_room][]" class="form-control total_room"
                        placeholder="Total Room"
                        value="{{ old('unit_detail.total_room', $unitDetail->total_room ?? '') }}" required>
                </div>
            </div>
            <hr>
        </div>
    </div>
@endforeach
