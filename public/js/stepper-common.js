(function (window, $) {

    function initStepper(options) {
        const {
            stepperSelector = '.bs-stepper',
            formId,
            onLastStepSubmit = null,
            onStepChange = null
        } = options;

        const stepperElement = document.querySelector(stepperSelector);
        if (!stepperElement) return;

        window.stepper = new Stepper(stepperElement);

        // Select2 init
        $('.select2').select2({
            placeholder: 'Select an option',
            allowClear: true
        });

        const form = document.getElementById(formId);
        if (!form) return;

        form.addEventListener('keydown', function (e) {
            if (e.key !== 'Enter') return;

            const target = e.target;

            if (target.tagName === 'TEXTAREA') return;

            if ($(target).closest('.select2-container').length) {
                e.stopPropagation();
                return;
            }

            if (target.tagName === 'SELECT') {
                e.preventDefault();
                return;
            }

            if (target.type === 'checkbox') {
                e.preventDefault();
                target.checked = !target.checked;
                target.dispatchEvent(new Event('change', { bubbles: true }));
                return;
            }

            if (target.tagName === 'BUTTON') {
                e.preventDefault();
                target.click();
                return;
            }

            e.preventDefault();
            e.stopPropagation();

            const stepIndex = window.stepper._currentIndex;
            const lastIndex = window.stepper._steps.length - 1;

            if (stepIndex === lastIndex && typeof onLastStepSubmit === 'function') {
                if (validateStep(stepIndex)) {
                    onLastStepSubmit(e);
                }
                return;
            }

            if (validateStep(stepIndex)) {
                window.stepper.next();
                if (typeof onStepChange === 'function') {
                    onStepChange(window.stepper._currentIndex);
                }
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
        });

        document.addEventListener('click', function (e) {
            if (e.target.matches('.prevBtn')) {
                window.stepper.previous();
            }

            if (e.target.matches('.nextBtn')) {
                const stepIndex = window.stepper._currentIndex;
                if (validateStep(stepIndex)) {
                    window.stepper.next();
                    if (typeof onStepChange === 'function') {
                        onStepChange(window.stepper._currentIndex);
                    }
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

        updateDisabledFields(0);
    }

    // expose globally
    window.initStepper = initStepper;

})(window, jQuery);



function updateDisabledFields(currentIndex) {
    document.querySelectorAll('.step-content').forEach((step, index) => {
        step.querySelectorAll('input, select, textarea').forEach(el => {
            el.disabled = index < currentIndex;
        });
    });
}

function validateStep(stepIndex) {
    let isValid = true;
    const stepContainer = document.querySelectorAll('.step-content')[stepIndex];
    if (!stepContainer) return false;

    stepContainer.querySelectorAll('[required]:not([type="radio"])').forEach(field => {
        if (field.offsetParent === null) return;

        if (!field.checkValidity()) {
            field.classList.add('is-invalid');
            field.classList.remove('is-valid');
            isValid = false;
        } else {
            field.classList.add('is-valid');
            field.classList.remove('is-invalid');
        }
    });

    $(stepContainer).find('select.select2[required]').each(function () {
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

    return isValid;
}
