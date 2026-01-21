@php
    // Ensure $contract is defined, even on create page
    $contract = $contract ?? null;
@endphp

<script>
    document.getElementById('contractForm').addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            return false;
        }
    });
</script>

<script>
    // Add a custom :focusable selector
    $.extend($.expr[':'], {
        focusable: function(el) {
            var nodeName = el.nodeName.toLowerCase();
            var tabIndex = $(el).attr('tabindex');
            if (tabIndex !== undefined && tabIndex < 0) return false;
            return (nodeName === 'input' || nodeName === 'select' || nodeName === 'textarea' || nodeName ===
                'button' || $(el).is('a[href]')) && !$(el).is(':disabled');
        }
    });


    // $('.contractFormSubmit').click(function(e) {
    function ContractFormSubmit(e) {
        e.preventDefault();
        // $('#company_id').prop('disabled', false);
        // const contractForm = $(this);
        // $(':input').not(':focusable').prop('disabled', true);
        var form = document.getElementById('contractForm');
        var fdata = new FormData(form);

        fdata.append('_token', $('meta[name="csrf-token"]').attr('content'));

        // If you're updating (PUT/PATCH/DELETE)

        // let isEdit = @json($contract && $contract->exists);

        let url =
            "{{ $edit ? route('contract.update', $contract->id) : route('contract.store') }}";
        fdata.append('_method', "{{ $edit ? 'PUT' : 'POST' }}");


        $.ajax({
            type: "POST",
            url: url,
            data: fdata,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function(response) {
                // console.log(response);
                toastr.success(response.message);
                window.location.href = "{{ route('contract.index') }}";
            },
            error: function(errors) {
                toastr.error(errors.responseJSON.message);
            }
        });
    }
</script>
