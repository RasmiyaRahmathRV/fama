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
 * @property array|null $changes
 * @property string $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLog whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLog whereChanges($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLog whereCreatedAt($value)
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
 */
	class Area extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $company_id
 * @property string $bank_code
 * @property string $bank_name
 * @property string $bank_short_code
 * @property int|null $added_by
 * @property int|null $updated_by
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Company|null $company
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
 * @property int|null $deleted_by
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereIndustryId($value)
 */
	class Company extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $file_name
 * @property int|null $total_rows
 * @property int $processed_rows
 * @property string $status
 * @property int $added_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ImportBatch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImportBatch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ImportBatch query()
 * @method static \Illuminate\Database\Eloquent\Builder|ImportBatch whereAddedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportBatch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportBatch whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportBatch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportBatch whereProcessedRows($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportBatch whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportBatch whereTotalRows($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ImportBatch whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ImportBatch extends \Eloquent {}
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
 * @property int $company_id
 * @property string $installment_code
 * @property string $installment_name
 * @property int|null $added_by
 * @property int|null $updated_by
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Company|null $company
 * @method static \Database\Factories\InstallmentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Installment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Installment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Installment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Installment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Installment whereAddedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Installment whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Installment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Installment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Installment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Installment whereInstallmentCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Installment whereInstallmentName($value)
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
 */
	class Locality extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $company_id
 * @property string $nationality_code
 * @property string $nationality_name
 * @property string $nationality_short_code
 * @property int|null $added_by
 * @property int|null $updated_by
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Company|null $company
 * @method static \Database\Factories\NationalityFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality query()
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality whereAddedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nationality whereDeletedAt($value)
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
 * @property int $company_id
 * @property string $payment_mode_code
 * @property string $payment_mode_name
 * @property string $payment_mode_short_code
 * @property int|null $added_by
 * @property int|null $updated_by
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Company|null $company
 * @method static \Database\Factories\PaymentModeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMode onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMode query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMode whereAddedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMode whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMode whereDeletedAt($value)
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
 */
	class PropertyType extends \Eloquent {}
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
 */
	class Vendor extends \Eloquent {}
}

