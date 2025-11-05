<script>
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
                    window.stepper.previous(); // safe even if current step is first
                }
                if (e.target.matches('.nextBtn')) {
                    const stepIndex = window.stepper._currentIndex;
                    if (validateStep(stepIndex)) {
                        window.stepper.next();

                        if (window.stepper._currentIndex === 6) { // adjust step index
                            rentPerUnitFamaFaateh();
                        }

                    } else {
                        alert('Please fill all required fields in this step.');
                    }
                }

                if (e.target.matches('.contractFormSubmit')) {
                    const stepIndex = window.stepper._currentIndex;
                    if (validateStep(stepIndex)) {
                        // If validation passes, submit the form
                        // const form = document.querySelector('form'); // or a specific form id
                        // if (form) {
                        ContractFormSubmit(e);
                        // }
                    } else {
                        alert('Please fill all required fields before submitting.');
                    }
                }
            });
        }

        updateDisabledFields(0);

    });

    function updateDisabledFields(currentIndex) {
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
        const stepContainer = document.querySelector(`.step-content[data-step="${stepIndex}"]`);
        if (!stepContainer) return false;

        // Validate normal inputs and selects
        stepContainer.querySelectorAll('[required]:not(.select2):not([type="radio"])').forEach(field => {
            if (field.offsetParent === null) return;

            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                field.classList.remove('is-valid');
                console.log(field);
                isValid = false;
            } else {
                field.classList.add('is-valid');
                field.classList.remove('is-invalid');
            }
        });

        // Validate Select2 fields
        $(stepContainer).find('[required]select.select2').each(function() {
            const value = $(this).val();
            const container = $(this).next('.select2-container');

            // Skip validation if hidden (either the select or its container)
            if (!$(this).is(':visible') || container.css('display') === 'none') {
                container.removeClass('is-invalid is-valid');
                return; // skip hidden selects
            }


            if (!value || value.length === 0) {
                container.addClass('is-invalid').removeClass('is-valid');
                isValid = false;
            } else {
                container.addClass('is-valid').removeClass('is-invalid');
            }
        });

        // Validate iCheck radios
        // if (!validateRadios(stepContainer)) isValid = false;

        return isValid;
    }

    function validateRadios(stepContainer) {
        let isValid = true;

        // Collect unique radio group names inside this step
        const radioNames = new Set();
        $(stepContainer).find('input[type="radio"]').each(function() {
            if (!$(this).is(':visible')) return; // skip hidden/template
            radioNames.add($(this).attr('name'));
        });

        // Check each radio group
        radioNames.forEach(name => {
            const $radios = $(stepContainer).find(`input[name="${name}"]`);
            const isChecked = $radios.filter(':checked').length > 0;

            if (!isChecked) {
                // mark wrappers as invalid
                $radios.each(function() {
                    $(this).closest('.icheckbox').addClass('icheck-danger').removeClass(
                        'icheck-success');
                    $(this).closest('.icheckbox').addClass('is-invalid').removeClass('is-valid');
                });
                isValid = false;
            } else {
                // mark wrappers as valid
                $radios.each(function() {
                    $(this).closest('.icheckbox').addClass('icheck-success').removeClass(
                        'icheck-danger');
                    $(this).closest('.icheckbox').removeClass('is-invalid').addClass('is-valid');

                });
            }
        });

        return isValid;
    }

    $(document).on('input', '.unit_no', function() {
        const stepContainer = $(this).closest('.step-content');
        if (hasDuplicateUnitNumbers(stepContainer)) {
            $('.nextBtn').prop('disabled', true);
            alert('Unit numbers must be unique!');
            $(this).val('');
        } else {
            $('.nextBtn').prop('disabled', false);
        }
    });

    $(document).on('input', '.cheque_no', function() {
        const stepContainer = $(this).closest('.step-content');
        if (hasDuplicateChequeNumbers(stepContainer)) {
            $('.nextBtn').prop('disabled', true);
            alert('Cheque numbers must be unique!');
            $(this).val('');
        } else {
            $('.nextBtn').prop('disabled', false);
        }
    });

    function hasDuplicateUnitNumbers(stepContainer) {
        const unitNumbers = [];
        let duplicateFound = false;

        $(stepContainer).find('.unit_no').each(function() {
            const val = $(this).val().trim();
            if (val !== '') {
                if (unitNumbers.includes(val)) {
                    duplicateFound = true;
                    return false; // stop loop early
                } else {
                    unitNumbers.push(val);
                }
            }
        });

        return duplicateFound;
    }

    function hasDuplicateChequeNumbers(stepContainer) {
        const chequeNumbers = [];
        let duplicateFound = false;

        $(stepContainer).find('.cheque_no').each(function() {
            const val = $(this).val().trim();
            if (val !== '') {
                if (chequeNumbers.includes(val)) {
                    duplicateFound = true;
                    return false; // stop loop early
                } else {
                    chequeNumbers.push(val);
                }
            }
        });

        return duplicateFound;
    }
</script>
