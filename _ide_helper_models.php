<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property int|null $user_id
 * @property string $module
 * @property int|null $record_id
 * @property string $action
 * @property string $description
 * @property array|null $changes
 * @property string $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLog whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLog whereChanges($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLog whereModule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLog whereRecordId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLog whereUserId($value)
 */
	class ActivityLog extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $company_id
 * @property string $area_code
 * @property string $area_name
 * @property int $added_by
 * @property int|null $updated_by
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Company|null $company
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Locality> $localities
 * @property-read int|null $localities_count
 * @method static \Illuminate\Database\Eloquent\Builder|Area newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Area newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Area onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Area query()
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereAddedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereAreaCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereAreaName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Area withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Area withoutTrashed()
 * @method static \Database\Factories\AreaFactory factory($count = null, $state = [])
 * @mixin \Eloquent
 * @property int|null $deleted_by
 * @property-read \App\Models\User|null $deletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|Area whereDeletedBy($value)
 */
	class Area extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int|null $company_id
 * @property string $bank_code
 * @property string $bank_name
 * @property string $bank_short_code
 * @property int|null $added_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Company|null $company
 * @property-read \App\Models\User|null $deletedBy
 * @method static \Database\Factories\BankFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Bank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bank newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bank onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Bank query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereAddedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereBankCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereBankName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereBankShortCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Bank withoutTrashed()
 */
	class Bank extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $company_code
 * @property string $company_name
 * @property string|null $industry
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $website
 * @property int $added_by
 * @property int|null $updated_by
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Area> $areas
 * @property-read int|null $areas_count
 * @property-write mixed $added_date
 * @property-write mixed $updated_date
 * @method static \Illuminate\Database\Eloquent\Builder|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Company query()
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereAddedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCompanyCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereIndustry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Company withoutTrashed()
 * @method static \Database\Factories\CompanyFactory factory($count = null, $state = [])
 * @mixin \Eloquent
 * @property int $industry_id
 * @property string $company_short_code
 * @property int|null $deleted_by
 * @property-read \App\Models\User|null $deletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereCompanyShortCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereIndustryId($value)
 */
	class Company extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $project_code
 * @property int $project_number
 * @property int $company_id
 * @property int $vendor_id
 * @property int $contract_type_id
 * @property string|null $contact_person
 * @property string|null $contact_number
 * @property int $area_id
 * @property int $locality_id
 * @property int $property_id
 * @property int $is_vendor_contract_uploaded
 * @property int $is_scope_generated
 * @property int $contract_status 0-Pending, 1-Processing, 2-Approved, 3-Rejected
 * @property int $is_aknowledgement_uploaded
 * @property int $is_cheque_copy_uploaded
 * @property int|null $parent_contract_id
 * @property int $contract_renewal_status 0-new, 1-renewed
 * @property int|null $renewal_count
 * @property string|null $renewal_date
 * @property int|null $renewed_by
 * @property int $added_by
 * @property int|null $updated_by
 * @property int|null $approved_by
 * @property int|null $deleted_by
 * @property int|null $scope_generated_by
 * @property string|null $rejected_reason
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Area|null $area
 * @property-read \App\Models\Company|null $company
 * @property-read \App\Models\ContractDetail|null $contract_detail
 * @property-read \App\Models\ContractDocument|null $contract_documents
 * @property-read \App\Models\ContractOtc|null $contract_otc
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContractPaymentDetail> $contract_payment_details
 * @property-read int|null $contract_payment_details_count
 * @property-read \App\Models\ContractPayment|null $contract_payments
 * @property-read \App\Models\ContractRental|null $contract_rentals
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContractSubunitDetail> $contract_subunit_details
 * @property-read int|null $contract_subunit_details_count
 * @property-read \App\Models\ContractType|null $contract_type
 * @property-read \App\Models\ContractUnit|null $contract_unit
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContractUnitDetail> $contract_unit_details
 * @property-read int|null $contract_unit_details_count
 * @property-read \App\Models\User|null $deletedBy
 * @property-read \App\Models\Locality|null $locality
 * @property-read \App\Models\Property|null $property
 * @property-read \App\Models\Vendor|null $vendor
 * @method static \Illuminate\Database\Eloquent\Builder|Contract newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contract newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contract onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Contract query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereAddedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereContactNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereContactPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereContractRenewalStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereContractStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereContractTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereIsAknowledgementUploaded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereIsChequeCopyUploaded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereIsScopeGenerated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereIsVendorContractUploaded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereLocalityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereParentContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereProjectCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereProjectNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract wherePropertyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereRejectedReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereRenewalCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereRenewalDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereRenewedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereScopeGeneratedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract whereVendorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contract withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Contract withoutTrashed()
 */
	class Contract extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $contract_id
 * @property string|null $contract_fee
 * @property string $start_date
 * @property string $end_date
 * @property int $duration_in_months
 * @property int|null $duration_in_days
 * @property string $closing_date
 * @property int $grace_period
 * @property int $added_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Contract $contract
 * @property-read \App\Models\User|null $deletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDetail onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDetail whereAddedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDetail whereClosingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDetail whereContractFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDetail whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDetail whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDetail whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDetail whereDurationInDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDetail whereDurationInMonths($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDetail whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDetail whereGracePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDetail whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDetail whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDetail withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDetail withoutTrashed()
 */
	class ContractDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $contract_id
 * @property string $original_document_path
 * @property string $original_documant_name
 * @property string $signed_document_path
 * @property string $signed_document_name
 * @property int $signed_status 0-unsinged, 1-mr.muneer signed,2- mr.muneer and vendor signed
 * @property int $added_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Contract $contract
 * @property-read \App\Models\User|null $deletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocument newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocument newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocument onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocument query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocument whereAddedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocument whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocument whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocument whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocument whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocument whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocument whereOriginalDocumantName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocument whereOriginalDocumentPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocument whereSignedDocumentName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocument whereSignedDocumentPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocument whereSignedStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocument whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocument whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocument withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractDocument withoutTrashed()
 */
	class ContractDocument extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $contract_id
 * @property string $cost_of_development
 * @property string $cost_of_bed
 * @property string $cost_of_matress
 * @property string $appliances
 * @property string $decoration
 * @property string $dewa_deposit
 * @property string $ejari
 * @property string $cost_of_cabinets
 * @property string $added_by
 * @property string $updated_by
 * @property string $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Contract $contract
 * @property-read \App\Models\User|null $deletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|ContractOtc newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractOtc newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractOtc onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractOtc query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractOtc whereAddedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractOtc whereAppliances($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractOtc whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractOtc whereCostOfBed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractOtc whereCostOfCabinets($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractOtc whereCostOfDevelopment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractOtc whereCostOfMatress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractOtc whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractOtc whereDecoration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractOtc whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractOtc whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractOtc whereDewaDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractOtc whereEjari($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractOtc whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractOtc whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractOtc whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractOtc withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractOtc withoutTrashed()
 */
	class ContractOtc extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $contract_id
 * @property int $installment_id
 * @property int $interval
 * @property string|null $beneficiary
 * @property int $added_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Contract $contract
 * @property-read \App\Models\User|null $deletedBy
 * @property-read \App\Models\Installment|null $installment
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPayment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPayment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPayment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPayment query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPayment whereAddedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPayment whereBeneficiary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPayment whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPayment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPayment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPayment whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPayment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPayment whereInstallmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPayment whereInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPayment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPayment whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPayment withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPayment withoutTrashed()
 */
	class ContractPayment extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $contract_id
 * @property int $contract_payment_id
 * @property int $payment_mode_id
 * @property string $payment_date
 * @property string $payment_amount
 * @property int|null $bank_id
 * @property string|null $cheque_no
 * @property string|null $cheque_issuer
 * @property string|null $cheque_issuer_name
 * @property string|null $cheque_issuer_id
 * @property int $added_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Bank|null $bank
 * @property-read \App\Models\Contract $contract
 * @property-read \App\Models\ContractPayment $contract_payment
 * @property-read \App\Models\User|null $deletedBy
 * @property-read \App\Models\PaymentMode|null $payment_mode
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentDetail onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentDetail whereAddedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentDetail whereBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentDetail whereChequeIssuer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentDetail whereChequeIssuerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentDetail whereChequeIssuerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentDetail whereChequeNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentDetail whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentDetail whereContractPaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentDetail whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentDetail whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentDetail wherePaymentAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentDetail wherePaymentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentDetail wherePaymentModeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentDetail whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentDetail withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentDetail withoutTrashed()
 */
	class ContractPaymentDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $contract_id
 * @property string $receivable_date
 * @property string $receivable_amount
 * @property int $added_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Contract $contract
 * @property-read \App\Models\User|null $deletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentReceivable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentReceivable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentReceivable onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentReceivable query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentReceivable whereAddedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentReceivable whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentReceivable whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentReceivable whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentReceivable whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentReceivable whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentReceivable whereReceivableAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentReceivable whereReceivableDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentReceivable whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentReceivable whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentReceivable withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractPaymentReceivable withoutTrashed()
 */
	class ContractPaymentReceivable extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $contract_rental_code
 * @property int $contract_id
 * @property string $rent_per_annum_payable
 * @property string|null $commission_percentage
 * @property string|null $commission
 * @property string|null $deposit_percentage
 * @property string|null $deposit
 * @property string $rent_receivable_per_month
 * @property string $rent_receivable_per_annum
 * @property string $roi_perc
 * @property string $expected_profit
 * @property string $profit_percentage
 * @property string|null $receivable_start_date
 * @property string $total_payment_to_vendor
 * @property string|null $total_otc
 * @property string $final_cost
 * @property string $initial_investment
 * @property int $added_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Contract $contract
 * @property-read \App\Models\User|null $deletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|ContractRental newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractRental newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractRental onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractRental query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractRental whereAddedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractRental whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractRental whereCommissionPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractRental whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractRental whereContractRentalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractRental whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractRental whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractRental whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractRental whereDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractRental whereDepositPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractRental whereExpectedProfit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractRental whereFinalCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractRental whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractRental whereInitialInvestment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractRental whereProfitPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractRental whereReceivableStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractRental whereRentPerAnnumPayable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractRental whereRentReceivablePerAnnum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractRental whereRentReceivablePerMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractRental whereRoiPerc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractRental whereTotalOtc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractRental whereTotalPaymentToVendor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractRental whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractRental whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractRental withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractRental withoutTrashed()
 */
	class ContractRental extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $contract_id
 * @property int $contract_unit_id
 * @property int $contract_unit_detail_id
 * @property string $subunit_no
 * @property string $subunit_code proj. no / company code / unit no / subunit no
 * @property int $added_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Contract $contract
 * @property-read \App\Models\ContractUnit $contract_unit
 * @property-read \App\Models\ContractUnitDetail $contract_unit_detail
 * @property-read \App\Models\User|null $deletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|ContractSubunitDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractSubunitDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractSubunitDetail onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractSubunitDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractSubunitDetail whereAddedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractSubunitDetail whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractSubunitDetail whereContractUnitDetailId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractSubunitDetail whereContractUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractSubunitDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractSubunitDetail whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractSubunitDetail whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractSubunitDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractSubunitDetail whereSubunitCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractSubunitDetail whereSubunitNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractSubunitDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractSubunitDetail whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractSubunitDetail withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractSubunitDetail withoutTrashed()
 */
	class ContractSubunitDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $contract_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ContractType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractType query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractType whereContractType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractType whereUpdatedAt($value)
 */
	class ContractType extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $contract_unit_code
 * @property int $contract_id
 * @property int $building_type 0-normal, 1-full building
 * @property int $business_type 1-b2b, 2-b2c
 * @property int $no_of_units
 * @property string|null $unit_numbers
 * @property string|null $unit_type_count
 * @property int $added_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Contract $contract
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContractUnitDetail> $contractUnitDetails
 * @property-read int|null $contract_unit_details_count
 * @property-read \App\Models\User|null $deletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnit onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnit query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnit whereAddedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnit whereBuildingType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnit whereBusinessType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnit whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnit whereContractUnitCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnit whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnit whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnit whereNoOfUnits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnit whereUnitNumbers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnit whereUnitTypeCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnit whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnit withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnit withoutTrashed()
 */
	class ContractUnit extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $contract_id
 * @property int $contract_unit_id
 * @property string $unit_number
 * @property int $unit_type_id
 * @property string $floor_no
 * @property int $unit_status_id
 * @property string $unit_rent_per_annum
 * @property int $fb_unit_count
 * @property int|null $unit_size_unit_id
 * @property int|null $unit_size
 * @property int $property_type_id
 * @property int $partition
 * @property int $bedspace
 * @property int $total_partition
 * @property int $total_bedspace
 * @property string|null $rent_per_partition
 * @property string|null $rent_per_bedspace
 * @property string|null $rent_per_room
 * @property int $added_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Contract $contract
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ContractSubunitDetail> $contractSubUnitDetails
 * @property-read int|null $contract_sub_unit_details_count
 * @property-read \App\Models\ContractUnit $contract_unit
 * @property-read \App\Models\User|null $deletedBy
 * @property-read \App\Models\PropertyType|null $property_type
 * @property-read \App\Models\UnitSizeUnit|null $unit_size_unit
 * @property-read \App\Models\UnitStatus|null $unit_status
 * @property-read \App\Models\UnitType|null $unit_type
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnitDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnitDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnitDetail onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnitDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnitDetail whereAddedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnitDetail whereBedspace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnitDetail whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnitDetail whereContractUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnitDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnitDetail whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnitDetail whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnitDetail whereFbUnitCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnitDetail whereFloorNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnitDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnitDetail wherePartition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnitDetail wherePropertyTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnitDetail whereRentPerBedspace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnitDetail whereRentPerPartition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnitDetail whereRentPerRoom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnitDetail whereTotalBedspace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnitDetail whereTotalPartition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnitDetail whereUnitNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnitDetail whereUnitRentPerAnnum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnitDetail whereUnitSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnitDetail whereUnitSizeUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnitDetail whereUnitStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnitDetail whereUnitTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnitDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnitDetail whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnitDetail withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ContractUnitDetail withoutTrashed()
 */
	class ContractUnitDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Industry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Industry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Industry query()
 * @method static \Illuminate\Database\Eloquent\Builder|Industry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Industry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Industry whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Industry whereUpdatedAt($value)
 */
	class Industry extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int|null $company_id
 * @property string $installment_code
 * @property string $installment_name
 * @property int $interval
 * @property int|null $added_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Company|null $company
 * @property-read \App\Models\User|null $deletedBy
 * @method static \Database\Factories\InstallmentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Installment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Installment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Installment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Installment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Installment whereAddedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Installment whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Installment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Installment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Installment whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Installment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Installment whereInstallmentCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Installment whereInstallmentName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Installment whereInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Installment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Installment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Installment whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Installment withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Installment withoutTrashed()
 */
	class Installment extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $company_id
 * @property int $area_id
 * @property string $locality_code
 * @property string $locality_name
 * @property int $added_by
 * @property int|null $updated_by
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Area|null $area
 * @property-read \App\Models\Company|null $company
 * @property-write mixed $added_date
 * @method static \Illuminate\Database\Eloquent\Builder|Locality newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Locality newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Locality onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Locality query()
 * @method static \Illuminate\Database\Eloquent\Builder|Locality whereAddedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Locality whereAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Locality whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Locality whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Locality whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Locality whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Locality whereLocalityCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Locality whereLocalityName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Locality whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Locality whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Locality whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Locality withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Locality withoutTrashed()
 * @method static \Database\Factories\LocalityFactory factory($count = null, $state = [])
 * @mixin \Eloquent
 * @property int|null $deleted_by
 * @property-read \App\Models\User|null $deletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|Locality whereDeletedBy($value)
 */
	class Locality extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int|null $company_id
 * @property string $nationality_code
 * @property string $nationality_name
 * @property string $nationality_short_code
 * @property int|null $added_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Company|null $company
 * @property-read \App\Models\User|null $deletedBy
 * @method static \Database\Factories\NationalityFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality query()
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality whereAddedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality whereNationalityCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality whereNationalityName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality whereNationalityShortCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality withoutTrashed()
 */
	class Nationality extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int|null $company_id
 * @property string $payment_mode_code
 * @property string $payment_mode_name
 * @property string $payment_mode_short_code
 * @property int|null $added_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Company|null $company
 * @property-read \App\Models\User|null $deletedBy
 * @method static \Database\Factories\PaymentModeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMode onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMode query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMode whereAddedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMode whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMode whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMode whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMode wherePaymentModeCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMode wherePaymentModeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMode wherePaymentModeShortCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMode whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMode whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMode withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMode withoutTrashed()
 */
	class PaymentMode extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $permission_name
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Permission> $children
 * @property-read int|null $children_count
 * @property-read Permission|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission wherePermissionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereUpdatedAt($value)
 */
	class Permission extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $company_id
 * @property int $area_id
 * @property int $locality_id
 * @property int $property_type_id
 * @property string $property_code
 * @property string $property_name
 * @property string|null $property_size
 * @property int|null $property_size_unit
 * @property string $plot_no
 * @property int $added_by
 * @property int|null $updated_by
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Area|null $area
 * @property-read \App\Models\Company|null $company
 * @property-read \App\Models\Locality|null $locality
 * @property-read \App\Models\PropertySizeUnit|null $propertySizeUnit
 * @property-read \App\Models\PropertyType|null $propertyType
 * @method static \Illuminate\Database\Eloquent\Builder|Property newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Property newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Property onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Property query()
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereAddedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereLocalityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property wherePlotNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property wherePropertyCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property wherePropertyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property wherePropertySize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property wherePropertySizeUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property wherePropertyTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Property withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Property withoutTrashed()
 * @method static \Database\Factories\PropertyFactory factory($count = null, $state = [])
 * @mixin \Eloquent
 * @property int|null $deleted_by
 * @property-read \App\Models\User|null $deletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|Property whereDeletedBy($value)
 */
	class Property extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $unit_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PropertySizeUnit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertySizeUnit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertySizeUnit query()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertySizeUnit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertySizeUnit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertySizeUnit whereUnitName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertySizeUnit whereUpdatedAt($value)
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|PropertySizeUnit whereDeletedAt($value)
 * @mixin \Eloquent
 */
	class PropertySizeUnit extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $company_id
 * @property string $property_type_code
 * @property string $property_type
 * @property int $added_by
 * @property int|null $updated_by
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Company|null $company
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType query()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType whereAddedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType wherePropertyType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType wherePropertyTypeCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType withoutTrashed()
 * @method static \Database\Factories\PropertyTypeFactory factory($count = null, $state = [])
 * @mixin \Eloquent
 * @property int|null $deleted_by
 * @property-read \App\Models\User|null $deletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|PropertyType whereDeletedBy($value)
 */
	class PropertyType extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $unit_size_unit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UnitSizeUnit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UnitSizeUnit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UnitSizeUnit query()
 * @method static \Illuminate\Database\Eloquent\Builder|UnitSizeUnit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnitSizeUnit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnitSizeUnit whereUnitSizeUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnitSizeUnit whereUpdatedAt($value)
 */
	class UnitSizeUnit extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $unit_status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UnitStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UnitStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UnitStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|UnitStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnitStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnitStatus whereUnitStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnitStatus whereUpdatedAt($value)
 */
	class UnitStatus extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $unit_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UnitType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UnitType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UnitType query()
 * @method static \Illuminate\Database\Eloquent\Builder|UnitType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnitType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnitType whereUnitType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UnitType whereUpdatedAt($value)
 */
	class UnitType extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int|null $company_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string|null $phone
 * @property string $username
 * @property string $password
 * @property int $user_type 1:super_admin,2:admin,3:agent
 * @property string|null $agent_code
 * @property string|null $remember_token
 * @property string|null $password_reset_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAgentCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePasswordResetToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @mixin \Eloquent
 * @property string $user_code
 * @property int $user_type_id
 * @property string|null $profile_photo
 * @property string|null $profile_path
 * @property int|null $added_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Company|null $company
 * @property-read User|null $deletedBy
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property int $permission_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission wherePermissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermission withoutTrashed()
 */
	class UserPermission extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $user_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserType query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserType whereUserType($value)
 */
	class UserType extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $company_id
 * @property string $vendor_code
 * @property string $vendor_name
 * @property string|null $vendor_phone
 * @property string|null $vendor_email
 * @property string|null $vendor_address
 * @property string|null $accountant_name
 * @property string|null $accountant_phone
 * @property string|null $accountant_email
 * @property string|null $contact_person
 * @property string|null $contact_person_phone
 * @property string|null $contact_person_email
 * @property int|null $added_by
 * @property int|null $updated_by
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Company|null $company
 * @method static \Database\Factories\VendorFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereAccountantEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereAccountantName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereAccountantPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereAddedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereContactPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereContactPersonEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereContactPersonPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereVendorAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereVendorCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereVendorEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereVendorName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereVendorPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor withoutTrashed()
 * @mixin \Eloquent
 * @property int|null $deleted_by
 * @property-read \App\Models\User|null $deletedBy
 * @method static \Illuminate\Database\Eloquent\Builder|Vendor whereDeletedBy($value)
 */
	class Vendor extends \Eloquent {}
}

