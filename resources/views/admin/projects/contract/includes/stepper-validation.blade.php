<script src="{{ asset('js/stepper-common.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        initStepper({
            formId: 'contractForm',
            onLastStepSubmit: function(e) {
                ContractFormSubmit(e);
            },
            onStepChange: function(stepIndex) {
                if (stepIndex === 6) {
                    rentPerUnitFamaFaateh();
                }
            }
        });
    });
</script>
