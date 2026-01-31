{{-- <script src="{{ asset('js/stepper-common.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        initStepper({
            formId: 'UserForm'
        });
    });
</script> --}}

<script>
    // const isEditUser = {{ isset($user) ? 'true' : 'false' }};
    document.addEventListener('DOMContentLoaded', function() {
        const stepperElement = document.querySelector('.bs-stepper');

        if (stepperElement) {
            window.stepper = new Stepper(stepperElement);

            // Initialize all Select2 fields
            $('.select2').select2({
                placeholder: 'Select an option',
                allowClear: true
            });


            document.addEventListener('click', function(e) {
                if (e.target.matches('.prevBtn')) {
                    window.stepper.previous();
                }
                if (e.target.matches('.nextBtn')) {
                    const stepIndex = window.stepper._currentIndex;
                    if (validateStep(stepIndex)) {
                        window.stepper.next();

                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Incomplete Step',
                            text: 'Please complete all required inputs.',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2500,
                        });



                    }
                }
            });
        }

        updateDisabledFields(0);

    });

    function updateDisabledFields(currentIndex) {
        // alert('hi');
        const steps = document.querySelectorAll('.step-content');

        steps.forEach((step, index) => {
            const isVisible = step.offsetParent !== null;

            step.querySelectorAll('input, select, textarea').forEach(el => {
                // ✅ disable only past steps, not future ones
                if (index < currentIndex) {
                    el.disabled = true;
                } else {
                    el.disabled = false; // enable for current and future steps
                }
            });
        });
    }

    function validateStep(stepIndex) {
        let isValid = true;
        const stepContainer = document.querySelectorAll('.step-content')[stepIndex]; // <-- fix

        if (!stepContainer) return false;

        // Validate inputs, selects, and textareas
        stepContainer.querySelectorAll('[required]:not([type="radio"]):not(#phone)').forEach(field => {
            if (field.offsetParent === null) return; // skip hidden
            // Skip password and file inputs
            // if (isEditUser) {
            //     if (field.name === 'password' || field.type === 'file') return;
            // }

            if (!field.checkValidity()) {
                field.classList.add('is-invalid');
                field.classList.remove('is-valid');
                isValid = false;
            } else {
                field.classList.add('is-valid');
                field.classList.remove('is-invalid');
            }
        });

        // ✅ Contact number validation (manual trigger)
        var contactInput = stepContainer.querySelector('#phone');

        if (contactInput) {
            const value = contactInput.value.trim();

            if (!value) {
                contactInput.classList.add('is-invalid');
                contactInput.classList.remove('is-valid');
                isValid = false;
                message = 'Contact number is required.';

            } else {
                // 🔑 Use return value ONLY
                const phoneIsValid = phoneValidation(contactInput, 'phone', 1);

                if (!phoneIsValid) {
                    contactInput.classList.add('is-invalid');
                    contactInput.classList.remove('is-valid');
                    isValid = false;
                    message = 'Please enter a valid phone number.';
                } else {
                    contactInput.classList.add('is-valid');
                    contactInput.classList.remove('is-invalid');
                    isValid = true;
                    message = '';
                }
            }
        }

        // Validate Select2 fields separately
        $(stepContainer).find('select.select2[required]').each(function() {
            const value = $(this).val();
            const container = $(this).next('.select2-container');

            if (!$(this).is(':visible')) return;

            if (!value || value.length === 0) {
                container.addClass('is-invalid').removeClass('is-valid');
                isValid = false;
            } else {
                container.addClass('is-valid').removeClass('is-invalid');
            }
        });

        // ✅ Custom conditional validation for documents

        return isValid;
    }
</script>
