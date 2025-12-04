<script>
    function checkTerminatedAgreement(contractId) {
        $.get(`/contracts/${contractId}/terminated-agreement-details`, function(data) {
            if (!data) return;
            alert("test");

            let terminated = data.terminated_agreement;
            console.log(terminated.terminated_date);
            let formattedDate = moment(terminated.terminated_date, "YYYY-MM-DD").format("DD-MM-YYYY");
            console.log('formated date', formattedDate)
            let contractEnd = new Date(data.contract_end_date);
            let today = new Date();

            if (terminated) {
                // let termDate = new Date(terminated.terminate_date);
                let termDate = moment(terminated.terminated_date, "YYYY-MM-DD");
                console.log('termdate', termDate);

                if (termDate < today && contractEnd < today) {
                    // return disableNewAgreement(terminated);
                    return;
                }

                // Enable date field so user can select new date
                $('#start_date').prop('disabled', false).prop('readonly', false);
                // Disable old dates
                $('#startdate').datetimepicker('minDate', termDate);

                // Set date (must be in moment format)
                $('#startdate').datetimepicker('date', termDate);
                $('#end_date').prop('disabled', false).prop('readonly', false);

                let endVal = $('#end_date').val();
                if (endVal) {
                    let enddate = moment(endVal, "YYYY-MM-DD");
                    if (enddate.isValid()) {
                        $('#enddate').datetimepicker('maxDate', enddate);
                        $('#enddate').datetimepicker('date', enddate);
                    }
                }
                console.log("endval", enddate)

                // Optional: prevent typing manually
                $('#end_date').off('keydown paste').on('keydown paste', function(e) {
                    e.preventDefault();
                });

            }
        });
    }

    function disableNewAgreement(terminated) {
        $('#terminated_info').html(`
        <div class="alert alert-danger">
            This contract expired. Last agreement terminated on ${terminated.terminate_date}.
            You cannot create a new agreement.
        </div>
    `);
        $('#submitBtn').prop('disabled', true);
    }
</script>
