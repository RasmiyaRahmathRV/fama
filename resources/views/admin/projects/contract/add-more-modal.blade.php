<!-- Model components and add more modal js -->
@component('admin.modals.modal-company')
    @slot('industry_dropdown')
        @foreach ($industries as $industry)
            <option value="{{ $industry->id }}">{{ $industry->name }}</option>
        @endforeach
    @endslot
@endcomponent

@component('admin.modals.modal-company')
    @slot('industry_dropdown')
        @foreach ($industries as $industry)
            <option value="{{ $industry->id }}">{{ $industry->name }}</option>
        @endforeach
    @endslot
@endcomponent
<script>
    function setupModal(modalId, selectMappings, showModal = true) {
        const $modal = $(modalId);
        // Only show modal if requested
        if (showModal) {
            $modal.modal('show');
        }


        // Loop through each select mapping
        selectMappings.forEach(map => {
            const $select = $modal.find(`select[name="${map.name}"]`);
            const windowId = map.windowId;
            const windowName = map.windowName;

            // If that window variable exists
            if (window[windowId]) {


                let existingOption = $select.find(`option[value="${window[windowId]}"]`);
                if (existingOption.length > 0) {
                    existingOption.text(window[windowName].trim());
                } else {
                    $select.append(new Option(window[windowName].trim(), window[windowId], true, true));
                }

                $select.val(window[windowId]).trigger('change.select2');

                $select.prop('disabled', true);
                if ($select.data('select2')) {
                    $select.next('.select2-container').addClass('select2-container--disabled');
                }
            }
        });
    }

    $('#addVendorButton').on('click', function() {
        setupModal('#modal-vendor', [{
            name: 'company_id',
            windowId: 'lastAddedCompanyId',
            windowName: 'lastAddedCompanyName'
        }]);
    });

    $('#addAreaButton').on('click', function() {
        setupModal('#modal-area', [{
            name: 'company_id',
            windowId: 'lastAddedCompanyId',
            windowName: 'lastAddedCompanyName'
        }]);
    });

    $('#addLocalityButton').on('click', function() {
        setupModal('#modal-locality', [{
                name: 'company_id',
                windowId: 'lastAddedCompanyId',
                windowName: 'lastAddedCompanyName'
            },
            {
                name: 'area_id',
                windowId: 'lastAddedAreaId',
                windowName: 'lastAddedAreaName'
            }
        ]);
    });

    // $('#addPropertyTypeButton').on('click', function() {
    //     setupModal('#modal-property-type', [{
    //         name: 'company_id',
    //         windowId: 'lastAddedCompanyId',
    //         windowName: 'lastAddedCompanyName'
    //     }]);
    // });

    $(document).on('click', '.addPropertyTypeButton', function(e) {
        e.preventDefault();
        setupModal('#modal-property-type', [{
            name: 'company_id',
            windowId: 'lastAddedCompanyId',
            windowName: 'lastAddedCompanyName'
        }]);
    });

    $('#addPropertyButton').on('click', function() {
        setupModal('#modal-property', [{
                name: 'company_id',
                windowId: 'lastAddedCompanyId',
                windowName: 'lastAddedCompanyName'
            },
            {
                name: 'area_id',
                windowId: 'lastAddedAreaId',
                windowName: 'lastAddedAreaName'
            },
            {
                name: 'locality_id',
                windowId: 'lastAddedLocalityId',
                windowName: 'lastAddedLocalityName'
            },
            {
                name: 'property_type_id',
                windowId: 'lastAddedPropertyTypeId',
                windowName: 'lastAddedPropertyTypeName'
            }
        ]);
    });


    $('#addInstallmentButton').on('click', function() {
        $('#modal-installment').modal('show');
    });
</script>
@component('admin.modals.modal-vendor')
    @slot('company_dropdown')
        @foreach ($companies as $company)
            <option value="{{ $company->id }}">{{ $company->company_name }}
            </option>
        @endforeach
    @endslot
@endcomponent

@component('admin.modals.modal-area')
    @slot('company_dropdown')
        @foreach ($companies as $company)
            <option value="{{ $company->id }}">{{ $company->company_name }}
            </option>
        @endforeach
    @endslot
@endcomponent

@component('admin.modals.modal-locality', ['areas' => $areas])
    @slot('company_dropdown')
        @foreach ($companies as $company)
            <option value="{{ $company->id }}">{{ $company->company_name }}
            </option>
        @endforeach
    @endslot
@endcomponent

@component('admin.modals.modal-property', [
    'areas' => $areas,
    'localities' => $localities,
    'property_types' => $property_types,
])
    @slot('company_dropdown')
        @foreach ($companies as $company)
            <option value="{{ $company->id }}">{{ $company->company_name }}
            </option>
        @endforeach
    @endslot

    @slot('propertySizeUnits_dropdown')
        @foreach ($propertySizeUnits as $unit)
            <option value="{{ $unit->id }}">{{ $unit->unit_name }}
            </option>
        @endforeach
    @endslot
@endcomponent

@component('admin.modals.modal-propertyType')
    @slot('company_dropdown')
        @foreach ($companies as $company)
            <option value="{{ $company->id }}">{{ $company->company_name }}
            </option>
        @endforeach
    @endslot
@endcomponent

@component('admin.modals.modal-nationality')
    @slot('company_dropdown')
        @foreach ($companies as $company)
            <option value="{{ $company->id }}">{{ $company->company_name }}
            </option>
        @endforeach
    @endslot
@endcomponent

@component('admin.modals.modal-installment')
@endcomponent

@component('admin.modals.modal-paymentMode')
    {{-- @slot('company_dropdown')
            @foreach ($companies as $company)
                <option value="{{ $company->id }}">{{ $company->company_name }}
                </option>
            @endforeach
        @endslot --}}
@endcomponent
@component('admin.modals.modal-bank')
    {{-- @slot('company_dropdown')
            @foreach ($companies as $company)
                <option value="{{ $company->id }}">{{ $company->company_name }}
                </option>
            @endforeach
        @endslot --}}
@endcomponent
