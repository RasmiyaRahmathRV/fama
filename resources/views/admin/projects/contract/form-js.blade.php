<script>
    $('#closingdate').datetimepicker({
        format: 'DD-MM-YYYY'
    });

    $('#startdate').datetimepicker({
        format: 'DD-MM-YYYY'
    });

    $('#enddate').datetimepicker({
        format: 'DD-MM-YYYY'
    });

    $('#firstpaymntdate').datetimepicker({
        format: 'DD-MM-YYYY'
    });

    $('#receivable_start_date').datetimepicker({
        format: 'DD-MM-YYYY'
    });

    $(document).ready(function() {
        $('.error-text-installment').hide();
    });
</script>

<!-- unit addmore  -->
<script>
    $(document).ready(function() {
        const container = document.getElementById('append-div');
        const addMoreBtn = document.getElementById('add-more');

        $('.fullBuilding').hide();

        const containerFb = document.getElementById('append-div-fullb');
        const addMoreBtnFb = document.getElementById('add-more-fullBuilding');


        // Function to attach events for toggle + remove
        function attachEvents(block, i) {
            $(function() {
                const map = {
                    ['#partition' + i]: '#part' + i,
                    ['#bedspace' + i]: '#bs' + i
                };

                partAndBsChange(map);
            });

            // Remove button
            const removeBtn = block.querySelector('.dlt-div');
            if (removeBtn) {
                removeBtn.addEventListener('click', () => {
                    block.remove();
                });
            }
        }


        $(document).on('input', '#no_of_units', totalUnitValue);


        function totalUnitValue() {
            const unitCount = $('#no_of_units').val();
            const prevBlocks = container.querySelectorAll('.apdi');
            prevBlocks.forEach(block => block.remove());

            const prevFbBlocks = containerFb.querySelectorAll('.add-more-fullBuilding');
            prevFbBlocks.forEach(block => block.remove());

            for (let i = 0; i < unitCount; i++) {
                unitAddmore(i);
                // fullAddMore(i);
            }
        }

        // Add new block dynamically
        // var i = 0;
        // addMoreBtn.addEventListener('click', () => {

        // });

        // property type loop
        let allPropertyTypes = @json($property_types);
        let propertyTypeOptions = '';
        allPropertyTypes.forEach(pt => {
            propertyTypeOptions += `<option value="${pt.id}">${pt.property_type}</option>`;
        });

        // unit type loop
        let allUnitTypes = @json($UnitTypes);
        let UnitTypeOptions = '<option value="">Select</option>';
        allUnitTypes.forEach(pt => {
            UnitTypeOptions += `<option value="${pt.id}">${pt.unit_type}</option>`;
        });

        // unit status loop
        let allUnitStatus = @json($UnitStatus);
        let UnitStatusOptions = '<option value="">Select</option>';
        allUnitStatus.forEach(pt => {
            UnitStatusOptions += `<option value="${pt.id}">${pt.unit_status}</option>`;
        });

        // unit status unit loop
        let allUnitSizeUnit = @json($UnitSizeUnit);
        let UnitSizeUnitOptions = '<option value="">Select</option>';
        allUnitSizeUnit.forEach(pt => {
            UnitSizeUnitOptions += `<option value="${pt.id}">${pt.unit_size_unit}</option>`;
        });



        // unit add more for normal
        function unitAddmore(i) {
            const newBlock = document.createElement('div');
            newBlock.classList.add('apdi');
            newBlock.innerHTML = `<div class="form-group row">
                <div class="col-sm-2 add-morecol2">
                    <label class="control-label"> Unit No </label>
                    <input type="text" name="unit_detail[unit_number][]" class="form-control unit_no" placeholder="Unit No" required>
                </div>
                <div class="col-sm-2 add-morecol2">
                    <label class="control-label"> Unit Type </label>
                    <select class="form-control select2 unit_type" name="unit_detail[unit_type_id][]" id="unit_type` +
                i + `" required>
                        ` + UnitTypeOptions + `
                    </select>
                </div>
                <div class="col-sm-1 add-morecol2">
                    <label class="control-label"> Floor No </label>
                    <input type="text" name="unit_detail[floor_no][]" class="form-control" placeholder="Floor No" required>
                </div>
                <div class="col-sm-2 add-morecol2">
                    <label class="control-label"> Unit Status </label>
                    <select class="form-control select2" name="unit_detail[unit_status_id][]" id="unit_status` + i + `" required>
                        ` + UnitStatusOptions + `
                    </select>
                </div>
                <div class="col-sm-2 add-morecol2">
                    <label class="control-label"> Unit Rent Per Annum </label>
                    <input type="number" name="unit_detail[unit_rent_per_annum][]" class="form-control unit_rent_per_annum" placeholder="Unit Rent Per Annum" required>
                </div>
                <div class="col-sm-3 add-morecol2">
                    <label class="control-label">Unit Size</label>
                        <div class="input-group input-group">
                            <div class="input-group-prepend select2">
                                <select name="unit_detail[unit_size_unit_id][]" id="" required>
                                    ` + UnitSizeUnitOptions + `
                                </select>
                            </div>
                            <input type="number" name="unit_detail[unit_size][]" class="form-control" placeholder="Unit Size" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2 add-morecol2">
                        <label class="control-label"> Property type</label>
                        <select class="form-control select2" name="unit_detail[property_type_id][]" id="" required>
                            ` + propertyTypeOptions + `
                        </select>
                    </div>
                    <div class="col-sm-3 m-4">
                        <div class="form-group clearfix">
                            <div class="icheckbox icheck-success d-inline">
                                <input type="checkbox" name="unit_detail[partition][` + i + `]" id="partition` + i + `" class="partcheck" value="1" required>
                                <label class="labelpermission" for="partition` + i + `"> Partition </label>
                            </div>
                            <div class="icheckbox icheck-success d-inline">
                                <input type="checkbox" name="unit_detail[partition][` + i + `]" id="bedspace` + i + `" class="bedcheck" value="2" required>
                                <label class="labelpermission" for="bedspace` + i + `"> Bedspace </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 part" id="part` + i + `">
                        <label class="control-label">Total Partitions</label>
                        <input type="number" name="unit_detail[total_partition][]" class="form-control total_partitions" placeholder="Total Partitions" required>
                    </div>
                    <div class="col-sm-2 bs" id="bs` + i + `">
                        <label class="control-label">Total Bed Spaces</label>
                        <input type="number" name="unit_detail[total_bedspace][]" class="form-control total_bedspaces" placeholder="Total Bed Spaces" required>
                    </div>
                </div>
                <hr>
            </div>`;

            container.appendChild(newBlock);
            attachEvents(newBlock, i);

            $(container).find('select.select2').select2({
                placeholder: 'Select an option',
                allowClear: true
            });
        }


        // function fullAddMore(i) {
        //     const newBlock = document.createElement('div');
        //     newBlock.classList.add('add-more-fullBuilding');
        //     newBlock.innerHTML = '<div class="form-group row">' +
        //         '<div class="col-sm-2">' +
        //         '<label class="control-label">Unit Type</label>' +
        //         '<select class="form-control select2 unit_type" name="unit_type[]" id="unit_type' + i + '">' +
        //         '<option value="">Unit Type</option>' +
        //         '<option value="1">1BHK</option>' +
        //         '<option value="2">2BHK</option>' +
        //         '<option value="3">3BHK</option>' +
        //         '</select>' +
        //         '</div>' +
        //         // '<div class="col-sm-2">' +
        //         // '<label class="control-label">Unit Count</label>' +
        //         // '<input type="text" name="unit_count[]" class="form-control unit_count" placeholder="Unit Count">' +
        //         // '</div>' +
        //         '<div class="col-sm-2 add-morecol2"><label class="control-label"> Property type</label>' +
        //         '<select class="form-control select2" name="property_type" id="" >' +
        //         propertyTypeOptions +
        //         '</select>' +
        //         '</div>' +
        //         '<div class="col-sm-2 add-morecol2">' +
        //         '<label class="control-label"> Unit Rent Per Annum </label>' +
        //         '<input type="number" name="unit_rent_per_annum[]" class="form-control unit_rent_per_annum" placeholder="Unit Rent Per Annum">' +
        //         '</div>' +
        //         '<div class="col-sm-2 pt-3">' +
        //         '<div class="icheck-success d-inline">' +
        //         '<input type="checkbox" id="partition_fb' + i + '" class="partcheck_fb" value="1">' +
        //         '<label class="labelpermission" for="partition_fb' + i + '"> Partition </label>' +
        //         '</div>' +
        //         '<div class="icheck-success d-inline">' +
        //         '<input type="checkbox" id="bedspace_fb' + i + '" class="bedcheck_fb" value="1">' +
        //         '<label class="labelpermission" for="bedspace_fb' + i + '"> Bedspace </label>' +
        //         '</div>' +
        //         '</div>' +
        //         '<div class="col-sm-2 part_fb" id="part_fb' + i + '">' +
        //         '<label class="control-label">Total Partitions</label>' +
        //         '<input type="text" name="total_partition[]" class="form-control total_partitions_fb" placeholder="Total Partitions">' +
        //         '</div>' +
        //         '<div class="col-sm-2 bs_fb" id="bs_fb' + i + '">' +
        //         '<label class="control-label">Total Bed Spaces</label>' +
        //         '<input type="text" name="total_bedspace[]" class="form-control total_bedspaces_fb" placeholder="Total Bed Spaces">' +
        //         '</div>' +
        //         // '<div class="col-sm-1">' +
        //         // '<button type="button" class=" btn-danger btn-block dlt-div-fullb btndetd fullbdel" title="Delete" data-toggle="tooltip">' +
        //         // '<i class="fa fa-trash fa-1x"></i></button>' +
        //         // '</div>'+
        //         '<hr></div>';
        //     containerFb.appendChild(newBlock);
        //     attachEventsFb(newBlock, i);
        // }


        // Function to attach events for toggle + remove
        function attachEventsFb(block1, j) {
            const map = {
                ['#partition_fb' + j]: '#part_fb' + j,
                ['#bedspace_fb' + j]: '#bs_fb' + j
            };

            partAndBsChange(map);

            // Remove button
            const removeBtn = block1.querySelector('.dlt-div-fullb');
            if (removeBtn) {
                removeBtn.addEventListener('click', () => {
                    block1.remove();
                });
            }
        }

        // var j = 0;
        // // Add new block dynamically
        // addMoreBtnFb.addEventListener('click', () => {
        //     j++;

        // });


        containerFb.querySelectorAll('.add-more-fullBuilding').forEach(attachEventsFb);
        container.querySelectorAll('.apdi').forEach(attachEvents);
    });
</script>
<!-- unit addmore -->

<!-- checkboxes inside unit -->
<script>
    $(function() {
        const map = {
            '#partition': '#part',
            '#bedspace': '#bs'
        };

        partAndBsChange(map);
    });
</script>
<!-- checkboxes inside unit -->

<!-- full building design change add more -->
<script>
    $(function() {
        const map = {
            '#partition_fb': '#part_fb',
            '#bedspace_fb': '#bs_fb'
        };

        partAndBsChange(map);
    });

    function partAndBsChange(map) {
        // 🔹 Hide all sections on load
        $.each(map, function(_, div) {
            $(div).hide();
        });

        $.each(map, function(check, div) {
            $(check).on('change', function() {
                // Uncheck all others and hide their sections
                $.each(map, function(otherCheck, otherDiv) {
                    if (otherCheck !== check) {
                        $(otherCheck).prop('checked', false); // ✅ wrap in $()
                        $(otherDiv).hide();
                        $(otherDiv).find('input, select').val('');
                    }
                });

                // Show or hide this section
                if ($(this).is(':checked')) {
                    $(div).show();
                } else {
                    $(div).hide();
                    $(div).find('input, select').val('');
                }
            });

            $(check).trigger('change');
        });
    }

    $('.fullBuildCheck').on('change', function() {
        unitNoReq();
    });

    function unitNoReq() {
        let fullb = $('.fullBuildCheck').prop('checked');

        if (fullb) {
            $('.unit_no').attr('required', false);
        } else {
            $('.unit_no').attr('required', true);
        }
    }

    // full building checkbox click
    // $('.fullBuildCheck').click(function() {
    //     if ($(this).prop('checked')) {

    //         $('.fullBuilding').show();
    //         $('.normalBuilding').hide();
    //         $('.normalBuilding').find('input, select').val('');
    //         $('.normalBuilding .partcheck, .normalBuilding .bedcheck').prop('checked', false);
    //     } else {
    //         $('.fullBuilding').hide();
    //         $('.normalBuilding').show();
    //         $('.fullBuilding').find('input, select').val('');
    //         $('.fullBuilding .partcheck_fb, .fullBuilding .bedcheck_fb').prop('checked', false);
    //     }
    // });
</script>
<!-- full building design change add more -->

<!-- b2b b2c checkbox value -->
<script>
    const btob = document.getElementById("btob");
    const btoc = document.getElementById("btoc");

    btob.addEventListener("change", () => {
        if (btob.checked) btoc.checked = false;
    });

    btoc.addEventListener("change", () => {
        if (btoc.checked) btob.checked = false;
    });
</script>
<!-- b2b b2c checkbox value -->

<!-- end date calc from start date -->
<script>
    $('.startdate, #duration_months, #duration_days').on('input change', function() {
        calculateEndDate();
        calculateRoi();
        CalculatePayables();
    });

    function calculateEndDate() {
        var startDateVal = $('#startdate').find("input").val();
        var durationMonths = parseInt($('#duration_months').val()) || 0;
        var durationDays = parseInt($('#duration_days').val()) || 0;

        const startDate = parseDateCustom(startDateVal);
        console.log(startDate);
        if (!startDate || isNaN(startDate.getTime())) {
            $('.enddate').val('');
            return;
        }

        // Add months
        startDate.setMonth(startDate.getMonth() + durationMonths);

        // Add days
        startDate.setDate(startDate.getDate() + durationDays - 1);

        // Format as YYYY-MM-DD
        const year = startDate.getFullYear();
        const month = String(startDate.getMonth() + 1).padStart(2, '0');
        const day = String(startDate.getDate()).padStart(2, '0');

        const formattedDate = `${day}-${month}-${year}`;

        $('.enddate').val(formattedDate);
    }

    // modifying the date format to Y-m-d
    function parseDateCustom(dateStr) {
        if (!dateStr) return null;
        const parts = dateStr.split('-');

        if (parts.length !== 3) return null;
        const day = parseInt(parts[0], 10);
        const month = parseInt(parts[1], 10) - 1;
        const year = parseInt(parts[2], 10);

        formattedDate = `${year}-${month}-${day}`;

        return new Date(year, month, day);
    }
</script>
<!-- end date calc from start date -->

<!-- rent commssion and deposit value -->
<script>
    $('#rent_per_annum').on('input', function() {
        calculateCommissionAndDeposit();
        paymentSplit();
        CalculatePayables();
    });

    $('#commission_perc').on('input', function() {
        calculateCommissionAndDeposit();
    });

    $('#deposit_perc').on('input', function() {
        calculateCommissionAndDeposit();
    });

    function calculateCommissionAndDeposit() {
        var rentPerAnnum = parseFloat($('#rent_per_annum').val()) || 0;
        var commissionPerc = parseFloat($('#commission_perc').val()) || 0;
        var depositPerc = parseFloat($('#deposit_perc').val()) || 0;

        var commission = (rentPerAnnum * commissionPerc) / 100;
        var deposit = (rentPerAnnum * depositPerc) / 100;

        $('#commission').val(commission.toFixed(2));
        $('#deposit').val(deposit.toFixed(2));
    }

    $('#commission').on('input', function() {
        var rentPerAnnum = parseFloat($('#rent_per_annum').val()) || 0;
        var commission = parseFloat($('#commission').val()) || 0;

        if (rentPerAnnum > 0) {
            var commissionPerc = (commission / rentPerAnnum) * 100;
            $('#commission_perc').val(commissionPerc.toFixed(2));
        } else {
            $('#commission_perc').val(0);
        }
    });

    $('#deposit').on('input', function() {
        var rentPerAnnum = parseFloat($('#rent_per_annum').val()) || 0;
        var deposit = parseFloat($('#deposit').val()) || 0;

        if (rentPerAnnum > 0) {
            var depositPerc = (deposit / rentPerAnnum) * 100;
            $('#deposit_perc').val(depositPerc.toFixed(2));
        } else {
            $('#deposit_perc').val(0);
        }
    });
</script>
<!-- rent commssion and deposit value -->


<!-- rent anum from unit rent -->
<script>
    function calculateTotalRent() {
        let total = 0;
        $('.unit_rent_per_annum').each(function() {
            total += parseFloat($(this).val()) || 0;
        });
        $('#rent_per_annum').val(total.toFixed(2));
        calculateCommissionAndDeposit();
        calculateRoi();
        paymentSplit();
        CalculatePayables();
    }

    // Run whenever any unit rent changes
    $(document).on('input', '.unit_rent_per_annum', calculateTotalRent);
</script>
<!-- rent anum from unit rent -->


<!-- otc cost calculations -->
<script>
    function calculateOtc() {
        console.log('otc');
        let totalPartition = 0;
        let totalBedSpace = 0;
        let totalPartitionFb = 0;
        let totalBedSpaceFb = 0;
        let totSubValue = 0;
        let cod = 0;
        let totRoom = 0;

        if ($('#contract_type').val() == '1') {
            // Count filled inputs
            const countOfHouses = $('.unit_no').filter((_, el) => $(el).val()).length;
            const totalUnitCount = $('.unit_count').filter((_, el) => $(el).val()).length;

            // Sum values
            const sumValues = selector => $('.' + selector).toArray().reduce((sum, el) => sum + (parseFloat($(el)
                .val()) || 0), 0);



            // Conditional calculation
            if (countOfHouses > 0) {
                totalPartition = sumValues('total_partitions');
                totalBedSpace = sumValues('total_bedspaces');
            }

            if (totalUnitCount > 0) {
                totalPartitionFb = sumValues('total_partitions_fb');
                totalBedSpaceFb = sumValues('total_bedspaces_fb');
            }
            // Calculate totSubValue and cod

            console.log(countOfHouses);
            if (totalPartition > 0) cod = totSubValue = totalPartition;
            if (totalBedSpace > 0) totSubValue += totalBedSpace;

            if (totSubValue === 0) totSubValue = totalUnitCount || countOfHouses;

            totRoom = totalUnitCount || countOfHouses;

            if (totalPartitionFb > 0) cod = totSubValue = totalPartitionFb;
            if (totalBedSpaceFb > 0) totSubValue += totalBedSpaceFb;
        }


        // Set output values
        $('#cost_of_development').val(1200 * cod);
        $('#cost_of_beds').val(240 * totSubValue);
        $('#cost_of_mattress').val(55 * totSubValue);
        $('#cost_of_cabinets').val(100 * totSubValue);
        $('#appliances').val(2500 * totRoom);
        $('#decoration').val(0);
        $('#dewa_deposit').val(2130 * totRoom);
        $('#ejari').val(0);

        CalculatePayables();
    }

    // Trigger on input/change
    $(document).on('input change',
        '.unit_no, .unit_type, .total_partitions, .total_bedspaces, .total_partitions_fb, .total_bedspaces_fb',
        calculateOtc);
</script>


<!-- payment multiple -->
<script>
    $(document).ready(function() {
        $('.payment_details').hide();

        $('#no_of_installments').change(function() {
            $('.payment_details').show();
            let interval = $(this).find(':selected').data('interval');
            let noofinstallments = $(this).find(':selected').text();

            $('#interval').val(interval);
            const containerPayment = document.getElementsByClassName('payment_details')[0];
            const prevFbBlocks = containerPayment.querySelectorAll('.payment_mode_div');
            prevFbBlocks.forEach(block => block.remove());

            for (let i = 0; i < noofinstallments; i++) {

                const paymentBlock = document.createElement('div');
                paymentBlock.classList.add('payment_mode_div');

                paymentBlock.innerHTML = `
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label>Payment Mode</label>
                                <select class="form-control select2 payment_mode"
                                    name="payment_detail[payment_mode_id][]" id="payment_mode${i}" required>
                                    <option value="">Select</option>
                                    @foreach ($paymentmodes as $paymentmode)
                                        <option value="{{ $paymentmode->id }}">
                                            {{ $paymentmode->payment_mode_name }} </option>
                                    @endforeach


                                </select>
                              
                        </div>
                         
                        <div class="col-md-4">
                            <label>Payment Date</label>
                            <div class="input-group date" id="otherPaymentDate${i}" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input otherPaymentDate" 
                                    name="payment_detail[payment_date][]" id="payment_date${i}" 
                                    data-target="#otherPaymentDate${i}" placeholder="dd-mm-YYYY" required/>
                                <div class="input-group-append" data-target="#otherPaymentDate${i}" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Payment Amount</label>
                            <input type="text" class="form-control" id="payment_amount${i}" name="payment_detail[payment_amount][]" placeholder="Payment Amount" required>
                        </div>
                    </div>
                    <div class="form-group row">
                            <div class="col-md-4 bank" id="bank${i}">
                                <label for="exampleInputEmail1">Bank Name</label>
                               
                                <select class="form-control select2 bank_name" name="payment_detail[bank_id][]" id="bank_name${i}" required>
                                    <option value="">Select Bank</option>
                                    @foreach ($banks as $bank)
                                        <option value="{{ $bank->id }}">
                                            {{ $bank->bank_name }} </option>
                                    @endforeach


                                </select>
                                
                            </div>

                            <div class="col-md-3 chq" id="chq${i}">
                                <label for="exampleInputEmail1">Cheque No</label>
                                <input type="text" class="form-control cheque_no" id="cheque_no${i}" name="payment_detail[cheque_no][]" placeholder="Cheque No" required>
                            </div>

                           
                        </div>
                    <hr>
                `;

                //  <div class="col-md-3 chq" id="chqiss${i}">
                //                 <label for="exampleInputEmail1">Cheque Issuer</label>
                //                 <select class="form-control select2" name="payment_detail[cheque_issuer][]" id="cheque_issuer${i}" required>
                //                     <option value="">Select</option>
                //                     <option value="self">Self</option>
                //                     <option value="other">Other</option>
                //                 </select>
                //             </div>

                //             <div class="col-md-3 chqot" id="chqotiss${i}">
                //                 <label for="exampleInputEmail1">Cheque Issuer Name</label>
                //                 <input type="text" class="form-control" id="cheque_issuer_name${i}" name="payment_detail[cheque_issuer_name][]" placeholder="Cheque Issuer Name" required>
                //             </div>

                //             <div class="col-md-3 chqot" id="chqot${i}">
                //                 <label for="exampleInputEmail1">Issuer ID</label>
                //                 <input type="text" class="form-control" id="issuer_id${i}" name="payment_detail[cheque_issuer_id][]" placeholder="Issuer ID" required>
                //             </div>

                // Append first
                containerPayment.appendChild(paymentBlock);

                $(containerPayment).find('select.select2').select2({
                    placeholder: 'Select an option',
                    allowClear: true
                });

                // Now initialize the datetimepicker AFTER it's added
                $('#otherPaymentDate' + i).datetimepicker({
                    format: 'DD-MM-YYYY'
                });

                // Then attach any events or hide functions
                attachEventsPayment(paymentBlock, i);
                hidePayments(i);

                $('#payment_mode' + i).change(function() {
                    paymentModeChange(i);
                });

                $('#cheque_issuer' + i).change(function() {
                    checkIssView(i);
                });

                $('#otherPaymentDate1').on('input change', function() {
                    calculatePaymentDates();
                });

                $('#otherPaymentDate0').datetimepicker('date', moment($('#closingdate').find('input')
                    .val(), 'DD-MM-YYYY'));


                paymentSplit();

            }

            function attachEventsPayment() {

            }

            if ($('#contract_type').val() == '2') {
                rentPerUnitFamaFaateh();
            }


            // containerPayment.querySelectorAll('.payment_mode_div').forEach(attachEventsPayment);
        });


    });

    let currentSelectModeId = null;

    $(document).on('click', '.addPaymentModeBtn', function() {
        currentSelectModeId = $(this).data('select-id');
        $('#modal-payment-mode').modal('show');
    });
    let currentSelectBankId = null;

    $(document).on('click', '.addBankBtn', function() {
        currentSelectBankId = $(this).data('select-id');
        $('#modal-bank').modal('show');
    });
</script>

<!-- payment mode scripts -->
<script>
    $(document).ready(function() {
        hidePayments();
        // $('.subrnt0').hide();
    });

    function hidePayments() {
        $('.bank').hide();
        $('.chq').hide();
        $('.chqot').hide();
        $('.part0').hide();
        $('.bs0').hide();
        $('.chqiss').hide();
        $('.chqotiss').hide();
    }

    $('#no_of_installments, #interval').on('input change', function() {
        calculatePaymentDates();
    });

    function calculatePaymentDates() {
        var startDateVal = $('#otherPaymentDate1').find("input").val();
        var noOfInstallments = parseInt($('#no_of_installments').find(':selected').text()) || 0;
        var interval = parseInt($('#interval').val()) || 0;


        const startDate = parseDateCustom(startDateVal);

        for (let i = 2; i < noOfInstallments; i++) {

            if (!startDate || isNaN(startDate.getTime())) {
                $('#payment_date' + i).val('');
                return;
            }

            // Add months
            startDate.setMonth(startDate.getMonth() + interval);


            // Add days
            // startDate.setDate(startDate.getDate() + durationDays - 1);

            // Format as YYYY-MM-DD
            const year = startDate.getFullYear();
            const month = String(startDate.getMonth() + 1).padStart(2, '0');
            const day = String(startDate.getDate()).padStart(2, '0');

            const formattedDate = `${day}-${month}-${year}`;

            $('#otherPaymentDate' + i).datetimepicker('date', moment(formattedDate, 'DD-MM-YYYY'));

        }
    }


    function paymentSplit() {
        var installment = parseInt($('#no_of_installments').find(':selected').text()) || 0;
        var rentAnnum = parseFloat($('#rent_per_annum').val()) || 0;
        var commission = parseFloat($('#commission').val()) || 0;
        var deposit = parseFloat($('#deposit').val()) || 0;
        $('#payment_amount0').val((rentAnnum / installment) + commission + deposit);

        for (let i = 1; i < installment; i++) {
            $('#payment_amount' + i).val((rentAnnum / installment));
        }
    }


    // $('#payment_mode0').change(function() {
    //     paymentModeChange(0);
    // });


    function paymentModeChange(i) {
        var payment_mode = $('#payment_mode' + i).val();
        if (payment_mode == '3') {
            $('#chq' + i).show();
            $('#bank' + i).show();
            $('#chqot' + i).hide();
            // $('#chqiss' + i).show();
            // $('#chqotiss' + i).hide();
        } else if (payment_mode == '2') {
            $('#bank' + i).show();
            $('#chq' + i).hide();
            $('#chqot' + i).hide();
            // $('#chqiss' + i).hide();
            // $('#chqotiss' + i).hide();
        } else {
            $('#bank' + i).hide();
            $('#chq' + i).hide();
            $('#chqot' + i).hide();
            // $('#chqiss' + i).hide();
            // $('#chqotiss' + i).hide();
        }
    }

    // function checkIssView(i) {
    //     var cheque_issuer = $('#cheque_issuer' + i).val();
    //     if (cheque_issuer == 'other') {
    //         $('#chqot' + i).show();
    //         $('#chqotiss' + i).show();
    //     } else {
    //         $('#chqot' + i).hide();
    //         $('#chqotiss' + i).hide();
    //     }
    // }

    // $('#cheque_issuer0').change(function() {
    //     checkIssView(0);
    // });

    $('#contract_type').change(function() {
        calculateOtc();
        var contract_type = $(this).val();
        if (contract_type == '2') {
            $('#duration_months').val('12');
            $('#btob').prop('checked', true);
            $('#btoc').prop('checked', false);
            rentPerUnitFamaFaateh();
            //         $('#client_name').val('Faateh');
            //         $('#client_phone').val('0568856995');
            //         $('#client_email').val('adil@faateh.ae');
            //         $('#contact_person').val('Adil');

        } else {
            $('#duration_months').val('13');
            $('#btob').prop('checked', false);
            $('#btoc').prop('checked', true);
            $('.rentPerUnitFF').hide();
            //         $('#client_name').val('Faateh');
            //         $('#client_phone').val('0568856995');
            //         $('#client_email').val('adil@faateh.ae');
            //         $('#contact_person').val('Adil');
        }
    });
</script>
<!-- payment mode scripts -->


<!-- roi and profit calculations -->
<script>
    $('#rent_per_part, #rent_per_bs, #rent_per_room').on('input change', function() {
        calculateRoi();
        CalculatePayables();
    });

    function CalculatePayables() {
        let totRent = parseFloat($('#rent_per_annum').val()) || 0;
        let totcomm = parseFloat($('#commission').val()) || 0;
        let totdepo = parseFloat($('#deposit').val()) || 0;
        let totcontractfee = parseFloat($('#contract_fee').val()) || 0;

        let totalotc = (parseFloat($('#cost_of_development').val()) || 0) +
            (parseFloat($('#cost_of_beds').val()) || 0) +
            (parseFloat($('#cost_of_mattress').val()) || 0) +
            (parseFloat($('#cost_of_cabinets').val()) || 0) +
            (parseFloat($('#appliances').val()) || 0) +
            (parseFloat($('#decoration').val()) || 0) +
            (parseFloat($('#dewa_deposit').val()) || 0) +
            (parseFloat($('#ejari').val()) || 0);

        let paymenttovendor = parseFloat(totRent + totcomm + totdepo).toFixed(2);
        let finalCost = (parseFloat(paymenttovendor) + parseFloat(totcontractfee) + parseFloat(totalotc)).toFixed(2);
        let initialInv = parseFloat((totRent / 4) + totcomm + totdepo + totcontractfee + totalotc).toFixed(2);

        $('.total_contract_amount').val(totRent);
        $('.commssion_final').val(totcomm);
        $('.deposit_final').val(totdepo);
        $('.contract_final').val(totcontractfee);
        $('.payment_to_vendor').val(paymenttovendor);
        $('.total_otc_payable').val(totalotc);
        $('.final_cost').val(finalCost);
        $('.initial_inv').val(initialInv);
    }


    $('.rentPartition, .rentBedspace, .rentRoom').hide();
    let totalroomcount = 0;

    $(document).on('change', '.unit_type, .partcheck, .bedcheck, .partcheck_fb, .bedcheck_fb, .fullBuildCheck',
        function() {
            // hide all first
            $('.rentPartition, .rentBedspace, .rentRoom').hide().find('input, select').val('');

            $('.total_rent_receivable').val('0.00');
            $('.no_of_months_final').val('0');
            $('.total_rental').val('0.00');

            let hasMissingPartitionOrBedspace = false;
            let roomcount = 0;

            // if ($('.fullBuildCheck:checked').length > 0) {

            //     if (($('.partcheck_fb:checked').length) > 0) {
            //         $('.rentPartition').show();
            //     }

            //     if ($('.bedcheck_fb:checked').length > 0) {
            //         $('.rentBedspace').show();
            //     }

            //     $('.fullBuilding .add-more-fullBuilding').each(function() {
            //         // Get current row context
            //         let unitType = $(this).find('.unit_type').val();
            //         let partitionChecked = $(this).find('.partcheck_fb').is(':checked');
            //         let bedspaceChecked = $(this).find('.bedcheck_fb').is(':checked');


            //         // If unit type is selected but neither checkbox is checked
            //         if (unitType && !partitionChecked && !bedspaceChecked) {
            //             hasMissingPartitionOrBedspace = true;
            //             roomcount++;
            //             totalroomcount = roomcount;
            //             return false; // break loop early
            //         }
            //     });
            // } else {

            if (($('.partcheck:checked').length) > 0) {
                $('.rentPartition').show();
            }

            if ($('.bedcheck:checked').length > 0) {
                $('.rentBedspace').show();
            }

            $('.normalBuilding .apdi').each(function() {
                // Get current row context
                let unitType = $(this).find('.unit_type').val();
                let partitionChecked = $(this).find('.partcheck').is(':checked');
                let bedspaceChecked = $(this).find('.bedcheck').is(':checked');


                // If unit type is selected but neither checkbox is checked
                if (unitType && !partitionChecked && !bedspaceChecked) {
                    hasMissingPartitionOrBedspace = true;
                    roomcount++;
                    totalroomcount = roomcount;
                    return false; // break loop early
                }
            });
            // }

            if (hasMissingPartitionOrBedspace) {
                $('.rentRoom').show();
            } else {
                $('.rentRoom').hide();
            }

            calculateOtc();
        });



    function calculateRoi() {
        let rentPerPartition = parseFloat($('#rent_per_part').val()) || 0;
        let rentPerBedspace = parseFloat($('#rent_per_bs').val()) || 0;
        let rentPerRoom = parseFloat($('#rent_per_room').val()) || 0;

        if (rentPerPartition > 0 || rentPerBedspace > 0 || rentPerRoom > 0) {
            let total_part = totalPartition() * rentPerPartition;
            let total_bs = totalBedspace() * rentPerBedspace;
            let total_room = totalroomcount * rentPerRoom;

            let total_rent_rec = total_part + total_bs + total_room;
            let duration = $('#duration_months').val();

            // if($('#'))
            let total_rental = total_rent_rec * duration;


            let expProfit = total_rental - parseFloat($('.final_cost').val());
            let roi = expProfit / parseFloat($('.initial_inv').val());
            let profit = expProfit / parseFloat($('.final_cost').val());
            // parseFloat($('.').val());



            $('.total_rent_receivable').val(total_rent_rec);
            $('.no_of_months_final').val(duration);
            $('.total_rental').val(total_rental);


            $('#roi').val(Math.round(roi * 100));
            $('#expected_profit').val(Math.round(expProfit));
            $('#profit').val(customRound(profit * 100));
        }
    }

    function customRound($value) {
        $decimalPart = $value - Math.floor($value);

        if ($decimalPart >= 0.5) {
            // Round to 1 decimal first, then format 2 decimals
            return $value.toFixed(2);
        } else {
            // Round to nearest integer
            return Math.round($value);
        }
    }

    function totalPartition() {
        let total_partitions = 0;
        $('.total_partitions').each(function() {
            total_partitions += parseFloat($(this).val()) || 0;
        });

        return total_partitions;
    }

    function totalBedspace() {
        let total_bedspaces = 0;
        $('.total_bedspaces').each(function() {
            total_bedspaces += parseFloat($(this).val()) || 0;
        });

        return total_bedspaces;
    }
</script>
<!-- roi and profit calculations -->


<!-- rent per unit FF -->
<script>
    function rentPerUnitFamaFaateh() {
        let i = 0;
        $('.rentPerUnitFF').show();
        $('.receivable_details').hide();
        $('.rentPartition, .rentBedspace, .rentRoom').hide();

        const containerPayment = document.getElementsByClassName('rentPerUnitFF')[0];
        const prevffBlocks = containerPayment.querySelectorAll('.rentPerUnitFFaddmore');
        prevffBlocks.forEach(block => block.remove());

        $('.unit_no').each(function() {

            let unit_rent = $(this).parent().siblings().find('.unit_rent_per_annum').val();
            let unit_type = $(this).parent().siblings().find('.unit_type').find(':selected').text();
            let unit_comm = unit_rent * ($('#commission_perc').val() / 100);
            let unit_depo = unit_rent * ($('#deposit_perc').val() / 100);
            let unit_payable = parseFloat(unit_rent) + parseFloat(unit_comm) + parseFloat(unit_depo);

            const ffblock = document.createElement('div');
            ffblock.classList.add('form-group', 'row', 'rentPerUnitFFaddmore');

            ffblock.innerHTML = `
                            <div class="col-md-2">
                                <label for="exampleInputEmail1">Unit No</label>
                                <input type="number" class="form-control" id="unit_noFF${i}"
                                    readonly value="` + $(this).val() + `">
                                <input type="hidden" id="unit_amount_payable${i}"
                                    value="` + unit_payable + `" name="unit_detail[unit_amount_payable][]">
                                <input type="hidden" value="` + unit_comm + `" id="unit_commission${i}"
                                    name="unit_detail[unit_commission][]">
                                <input type="hidden" value="` + unit_depo + `" id="unit_deposit${i}"
                                    name="unit_detail[unit_deposit][]">
                            </div>
                            <div class="col-md-2">
                                <label for="exampleInputEmail1">Unit Type</label>
                                <input type="text" class="form-control" id="unit_typeFF${i}"
                                    readonly value="` + unit_type + `">
                            </div>
                            <div class="col-md-2">
                                <label for="exampleInputEmail1">Profit %</label>
                                <input type="number" class="form-control unit_profit_perc"
                                    name="unit_detail[unit_profit_perc][]"
                                    id="unit_profit_perc${i}" placeholder="Profit %" required>
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1">Profit</label>
                                <input type="number" class="form-control unit_profit"
                                    name="unit_detail[unit_profit][]" id="unit_profit${i}"
                                    placeholder="Profit" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1">Revenue</label>
                                <input type="number" class="form-control unit_revenue"
                                    name="unit_detail[unit_revenue][]" id="unit_revenue${i}"
                                    placeholder="Revenue" readonly>
                            </div>`;
            containerPayment.appendChild(ffblock);



            $('#unit_profit_perc' + i).on('input change', function() {

                let profit = (unit_payable * ($(this).val() / 100)).toFixed(2);


                $(this).parent().siblings().find('input[name="unit_detail[unit_profit][]"]').val(
                    profit);
                $(this).parent().siblings().find('input[name="unit_detail[unit_revenue][]"]').val(
                    (parseFloat(profit) + parseFloat(unit_payable)).toFixed(2));

                calculateRoiFF();
            });
            i++;
        });

    }


    $('#rent_installments').on('input change', function() {
        $('.receivable_details').show();

        const containerPayment = document.getElementsByClassName('receivable_details')[0];
        const prevffBlocks = containerPayment.querySelectorAll('.receivableaddmore');
        prevffBlocks.forEach(block => block.remove());

        let rec_inst = $(this).val();

        for (let inst = 0; inst < rec_inst; inst++) {
            const recpayblock = document.createElement('div');
            recpayblock.classList.add('form-group', 'row', 'receivableaddmore');

            recpayblock.innerHTML = `<div class="col-md-4">
                                            <div class="input-group date" id="receivable_date${inst}"
                                                data-target-input="nearest">
                                                <input type="text"
                                                    class="form-control datetimepicker-input receivable_date"
                                                    name="receivables[payment_date][]"
                                                    id="rec_payment_date${inst}"
                                                    data-target="#receivable_date${inst}"
                                                    placeholder="dd-mm-YYYY" required />
                                                <div class="input-group-append"
                                                    data-target="#receivable_date${inst}"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i
                                                            class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            
                                            <input type="number" class="form-control rec_payment_amount"
                                                id="rec_payment_amount${inst}"
                                                name="receivables[payment_amount][]"
                                                placeholder="Payment Amount" required>
                                        </div>`;
            containerPayment.appendChild(recpayblock);


            $('#receivable_date' + inst).datetimepicker({
                format: 'DD-MM-YYYY'
            });

            $('#receivable_date0').on('input change', function() {
                calculatePaymentDatesRec();
            });

            $('.rec_payment_amount').on('input change', function() {
                finalRecCal();
            });

        }
    });

    function calculateRoiFF() {
        console.log('roiff');
        let totalrev = 0;
        $('.unit_revenue').each(function() {
            totalrev += parseFloat($(this).val()) || 0;
        });

        let totalprof = 0;
        $('.unit_profit').each(function() {
            totalprof += parseFloat($(this).val()) || 0;
        });


        if (totalprof > 0 || totalrev > 0) {
            var count = $('.unit_profit').length;

            let tot_rent_per_month = totalrev / 12;
            $('.rentRoom').show();
            $('#rent_per_room').val(tot_rent_per_month.toFixed(2)).attr('readonly', 'true');

            let total_rent_rec = tot_rent_per_month;

            let total_rental = totalrev;

            let expProfit = total_rental - parseFloat($('.final_cost').val());
            let roi = expProfit / parseFloat($('.initial_inv').val());
            let profit = expProfit / parseFloat($('.final_cost').val());
            // parseFloat($('.').val());


            $('.total_rent_receivable').val(total_rent_rec.toFixed(2));
            $('.no_of_months_final').val($('#duration_months').val());
            $('.total_rental').val(total_rental);


            $('#roi').val(Math.round(roi * 100));
            $('#expected_profit').val(Math.round(expProfit));
            $('#profit').val(customRound(profit * 100));
        }

    }

    function calculatePaymentDatesRec() {
        let startDateVal = $('#receivable_date0').find("input").val();
        let noOfInstallments = parseInt($('#rent_installments').val()) || 0;

        let interval = 1;
        console.log(noOfInstallments);

        const startDate = parseDateCustom(startDateVal);

        for (let i = 1; i < noOfInstallments; i++) {

            if (!startDate || isNaN(startDate.getTime())) {
                $('#rec_payment_date' + i).val('');
                return;
            }

            // Add months
            startDate.setMonth(startDate.getMonth() + interval);


            // Add days
            // startDate.setDate(startDate.getDate() + durationDays - 1);

            // Format as YYYY-MM-DD
            const year = startDate.getFullYear();
            const month = String(startDate.getMonth() + 1).padStart(2, '0');
            const day = String(startDate.getDate()).padStart(2, '0');

            const formattedDate = `${day}-${month}-${year}`;

            $('#receivable_date' + i).datetimepicker('date', moment(formattedDate, 'DD-MM-YYYY'));

            valueTorentRec();
            finalRecCal();



        }
    }

    $('#rent_installments, #rent_per_part, #rent_per_bs, #rent_per_room').on('input change',
        function() {
            finalRecCal();
            valueTorentRec();
        });


    function valueTorentRec() {
        let rent_per_room = parseFloat($('#rent_per_room').val()) || 0;

        let totRentperroom = 0;
        if ($('#contract_type').val() == '2') {
            totRentperroom = rent_per_room;
        } else {
            totRentperroom = $('.total_rent_receivable').val();
        }
        console.log('valueTorentRec');
        $('.rec_payment_amount').each(function() {
            $(this).val(totRentperroom);
        });
    }

    function finalRecCal() {
        console.log('finalreccal');



        let totPaymentRec = 0;

        $('.rec_payment_amount').each(function() {
            totPaymentRec += parseFloat($(this).val()) || 0;
        });



        if ((totPaymentRec.toFixed(2) - $('.total_rental').val()) != 0) {
            $('.total_rental_inst').val(totPaymentRec.toFixed(2));
            $('.error-text-installment').show();
            $('.contractFormSubmit').attr('disabled', 'true');
        } else {
            $('.error-text-installment').hide();
            $('.contractFormSubmit').removeAttr('disabled');
        }
    }

    function validateMax(el) {
        if (el.value > 14) {
            el.value = el.value.slice(0, -1); // remove last typed digit
        }
    }
</script>
<!-- rent per unit FF -->
