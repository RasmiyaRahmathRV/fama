<script>
    $('.contractFormSubmit').click(function(e) {
        e.preventDefault();
        // $('#company_id').prop('disabled', false);
        const contractForm = $(this);

        var form = document.getElementById('contractForm');
        var fdata = new FormData(form);

        $.ajax({
            type: "POST",
            url: "{{ route('contract.store') }}",
            data: fdata,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function(response) {
                // console.log(response);
                toastr.success(response.message);
                // window.location.href = "{{ route('contract.index') }}";
            },
            error: function(errors) {
                toastr.error(errors.responseJSON.message);
            }
        });
    });
</script>
