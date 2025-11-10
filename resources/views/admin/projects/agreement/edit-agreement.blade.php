@if (isset($agreement))
    <script>
        $(document).ready(function() {
            let companyId = "{{ $agreement->company_id }}";
            let contractId = "{{ $agreement->contract_id }}";

            $('#company_id').val(companyId).trigger('change');
            console.log("ids" + companyId, contractId);

            CompanyChange(companyId, contractId, editedContract);
        });
    </script>
@endif
