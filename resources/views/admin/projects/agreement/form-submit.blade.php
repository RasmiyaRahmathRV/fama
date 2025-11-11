<script>
    $('.agreementFormSubmit').click(function(e) {
        e.preventDefault();
        const contractForm = $(this);
        const stepIndex = window.stepper._currentIndex;
        if (!validateStep(stepIndex)) {
            Swal.fire({
                icon: 'warning',
                title: 'Incomplete Step',
                text: 'Please fill in all required fields before submitting.',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2500
            });
            return;
        }
        const agreementId = $('input[name="agreement_id"]').val();
        let url = "{{ route('agreement.store') }}";
        let method = 'POST';
        var form = document.getElementById('agreementForm');
        var fdata = new FormData(form);
        // Update
        if (agreementId) {
            url = "{{ url('agreement') }}/" + agreementId;
            method = 'POST';
            fdata.append('_method', 'PUT');
        }

        // Add CSRF
        fdata.append('_token', $('meta[name="csrf-token"]').attr('content'));

        $.ajax({
            url: url,
            type: method,
            data: fdata,
            processData: false,
            contentType: false,
            success: function(response) {
                toastr.success(response.message);
                window.location = "{{ route('agreement.index') }}"
            },
            error: function(xhr) {
                const response = xhr.responseJSON;
                if (xhr.status === 422 && response?.errors) {
                    $.each(response.errors, function(key, messages) {
                        toastr.error(messages[0]);
                    });
                } else if (response.message) {
                    toastr.error(response.message);
                }
            }
        });
    });
</script>
