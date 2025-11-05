<script>
    $('.agreementFormSubmit').click(function(e) {
        e.preventDefault();
        // $('#company_id').prop('disabled', false);
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


        var form = document.getElementById('agreementForm');
        var fdata = new FormData(form);

        $.ajax({
            url: "{{ route('agreement.store') }}",
            type: 'POST',
            data: fdata,
            processData: false,
            contentType: false,
            success: function(response) {
                toastr.success(response.message);
                location.reload();
                // Swal.fire({
                //     title: 'Success!',
                //     text: 'Form submitted successfully',
                //     icon: 'success',
                //     confirmButtonText: 'OK'
                // }).then(() => {
                //     location.reload();
                // });
            },
            error: function(xhr) {
                // console.log('Error:', xhr.responseText);
                // toastr.error(errors.responseJSON.message);
                const response = xhr.responseJSON;

                // Laravel validation errors (422)
                if (xhr.status === 422 && response?.errors) {
                    $.each(response.errors, function(key, messages) {
                        toastr.error(messages[0]);
                    });
                }
                // Custom JSON error messages
                else if (response.message) {
                    toastr.error(response.message);
                }
            }
        });
    });
</script>
