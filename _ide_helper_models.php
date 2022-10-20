<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Badge
 *
 * @property int $id
 * @property array $name
 * @property array|null $description
 * @property string|null $img_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Customer[] $customers
 * @property-read int|null $customers_count
 * @property-read array $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Badge newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Badge newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Badge query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Badge whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Badge whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Badge whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Badge whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Badge whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Badge whereUpdatedAt($value)
 */
	class Badge extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BaseModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel query()
 */
	class BaseModel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\City
 *
 * @property int $id
 * @property string $name
 * @property string $name_en
 * @property string|null $country_code
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string|null $timezone
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Country|null $country
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereTimezone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\City whereUpdatedAt($value)
 */
	class City extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Comment
 *
 * @property int $id
 * @property int $customer_id
 * @property string $content
 * @property string $commentable_type
 * @property int $commentable_id
 * @property int $likes
 * @property int $dislikes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $commentable
 * @property-read \App\Models\Customer $customer
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereCommentableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereCommentableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereDislikes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereLikes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Comment whereUpdatedAt($value)
 */
	class Comment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Consultant
 *
 * @property int $id
 * @property int $consultants_category_id
 * @property array $name
 * @property string $consultant_type
 * @property float|null $price
 * @property int|null $currency_id
 * @property int $service_id
 * @property int|null $service_package_id
 * @property array|null $description
 * @property string|null $who_will_benefit
 * @property string|null $what_will_benefit
 * @property string|null $img_path
 * @property string|null $external_link
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ConsultantsCategory $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\Currency|null $currency
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Customer[] $customers
 * @property-read int|null $customers_count
 * @property-read array $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultant query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultant whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultant whereConsultantType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultant whereConsultantsCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultant whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultant whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultant whereExternalLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultant whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultant whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultant wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultant whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultant whereServicePackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultant whereWhatWillBenefit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Consultant whereWhoWillBenefit($value)
 */
	class Consultant extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ConsultantOrderProcedure
 *
 * @property int $id
 * @property int $consultants_order_id
 * @property int|null $procedure_type_id
 * @property string $process_description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConsultantOrderProcedure newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConsultantOrderProcedure newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConsultantOrderProcedure query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConsultantOrderProcedure whereConsultantsOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConsultantOrderProcedure whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConsultantOrderProcedure whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConsultantOrderProcedure whereProcedureTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConsultantOrderProcedure whereProcessDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConsultantOrderProcedure whereUpdatedAt($value)
 */
	class ConsultantOrderProcedure extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ConsultantsCategory
 *
 * @property int $id
 * @property array $name
 * @property string $slug
 * @property string|null $img_path
 * @property array|null $short_description
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Consultant[] $consultants
 * @property-read int|null $consultants_count
 * @property-read array $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConsultantsCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConsultantsCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConsultantsCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConsultantsCategory whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConsultantsCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConsultantsCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConsultantsCategory whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConsultantsCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConsultantsCategory whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConsultantsCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ConsultantsCategory whereUpdatedAt($value)
 */
	class ConsultantsCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Country
 *
 * @property int $id
 * @property string $code
 * @property string|null $iso3
 * @property int|null $iso_numeric
 * @property string|null $fips
 * @property array|null $name
 * @property string|null $capital
 * @property int|null $area
 * @property int|null $population
 * @property string|null $continent_code
 * @property string|null $tld
 * @property string|null $currency_code
 * @property int|null $currency_id
 * @property string|null $phone
 * @property string|null $postal_code_format
 * @property string|null $postal_code_regex
 * @property string|null $languages
 * @property string|null $neighbours
 * @property string|null $equivalent_fips_code
 * @property string|null $time_zone
 * @property string|null $date_format
 * @property string|null $datetime_format
 * @property string|null $background_image
 * @property string|null $admin_type
 * @property int|null $admin_field_active
 * @property int|null $active
 * @property int|null $is_source_transferring
 * @property int|null $is_dist_transferring
 * @property float|null $transfer_fee
 * @property string|null $img_path
 * @property string|null $flag_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TransferAgency[] $transferAgencies
 * @property-read int|null $transfer_agencies_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country active()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereAdminFieldActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereAdminType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereBackgroundImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereCapital($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereContinentCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereCurrencyCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereDateFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereDatetimeFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereEquivalentFipsCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereFips($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereFlagPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereIsDistTransferring($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereIsSourceTransferring($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereIso3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereIsoNumeric($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereLanguages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereNeighbours($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country wherePopulation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country wherePostalCodeFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country wherePostalCodeRegex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereTimeZone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereTld($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereTransferFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Country whereUpdatedAt($value)
 */
	class Country extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CourseCategory
 *
 * @property int $id
 * @property array $name
 * @property string|null $img_path
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CourseTraining[] $courses
 * @property-read int|null $courses_count
 * @property-read array $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseCategory morethan()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseCategory whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseCategory whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseCategory whereUpdatedAt($value)
 */
	class CourseCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CourseExercise
 *
 * @property int $id
 * @property int $course_id
 * @property int|null $part_id
 * @property int $sort
 * @property string $content
 * @property string|null $external_link
 * @property string $subject_type Question OR Answer
 * @property int $visited
 * @property int $is_helpful
 * @property int $is_not_helpful
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\CourseTraining $course
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseExercise newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseExercise newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseExercise query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseExercise whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseExercise whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseExercise whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseExercise whereExternalLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseExercise whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseExercise whereIsHelpful($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseExercise whereIsNotHelpful($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseExercise wherePartId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseExercise whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseExercise whereSubjectType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseExercise whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseExercise whereVisited($value)
 */
	class CourseExercise extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CoursePart
 *
 * @property int $id
 * @property int $course_id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CourseTraining $course
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CoursePart courselimit($course_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CoursePart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CoursePart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CoursePart query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CoursePart whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CoursePart whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CoursePart whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CoursePart whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CoursePart whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CoursePart whereUpdatedAt($value)
 */
	class CoursePart extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CourseSubject
 *
 * @property int $id
 * @property int $course_id
 * @property int $part_id
 * @property int $sort
 * @property string $name
 * @property string $subject_path
 * @property string|null $description
 * @property string $subject_type
 * @property float $kb_volume in kilobyte
 * @property int|null $duration by minutes
 * @property int $is_free
 * @property int|null $visited
 * @property int|null $likes
 * @property int|null $dis_likes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\CourseTraining $course
 * @property-read \App\Models\CoursePart $coursePart
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Customer[] $customers
 * @property-read int|null $customers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CourseSubjectAttachment[] $subjectAttachments
 * @property-read int|null $subject_attachments_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseSubject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseSubject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseSubject query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseSubject whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseSubject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseSubject whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseSubject whereDisLikes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseSubject whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseSubject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseSubject whereIsFree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseSubject whereKbVolume($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseSubject whereLikes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseSubject whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseSubject wherePartId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseSubject whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseSubject whereSubjectPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseSubject whereSubjectType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseSubject whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseSubject whereVisited($value)
 */
	class CourseSubject extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CourseSubjectAttachment
 *
 * @property int $id
 * @property int|null $subject_id
 * @property string $name
 * @property string $subject_path
 * @property string|null $description
 * @property string $subject_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CourseSubject|null $courseSubject
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseSubjectAttachment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseSubjectAttachment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseSubjectAttachment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseSubjectAttachment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseSubjectAttachment whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseSubjectAttachment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseSubjectAttachment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseSubjectAttachment whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseSubjectAttachment whereSubjectPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseSubjectAttachment whereSubjectType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseSubjectAttachment whereUpdatedAt($value)
 */
	class CourseSubjectAttachment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CourseTraining
 *
 * @property int $id
 * @property int $teacher_id
 * @property array $name
 * @property int $course_category_id
 * @property string $language
 * @property array|null $description
 * @property array|null $requirements
 * @property array|null $what_learn
 * @property string|null $img_path
 * @property float $price
 * @property int|null $currency_id
 * @property float|null $discount
 * @property string $discount_type
 * @property string|null $external_link
 * @property int $active
 * @property string $level
 * @property int|null $subjects_count
 * @property int|null $duration
 * @property int|null $total_students who studies in this course
 * @property float|null $rating
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CourseCategory $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CourseExercise[] $courseExercises
 * @property-read int|null $course_exercises_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CoursePart[] $courseParts
 * @property-read int|null $course_parts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CourseSubject[] $courseSubjects
 * @property-read int|null $course_subjects_count
 * @property-read \App\Models\Currency|null $currency
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Customer[] $customers
 * @property-read int|null $customers_count
 * @property-read array $translations
 * @property-read \App\Models\TeacherDetail $teacher
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseTraining newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseTraining newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseTraining query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseTraining whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseTraining whereCourseCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseTraining whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseTraining whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseTraining whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseTraining whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseTraining whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseTraining whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseTraining whereExternalLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseTraining whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseTraining whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseTraining whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseTraining whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseTraining whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseTraining wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseTraining whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseTraining whereRequirements($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseTraining whereSubjectsCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseTraining whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseTraining whereTotalStudents($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseTraining whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CourseTraining whereWhatLearn($value)
 */
	class CourseTraining extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Currency
 *
 * @property int $id
 * @property string $name
 * @property string $name_en
 * @property string $code
 * @property string|null $symbol
 * @property string|null $img_path
 * @property float $exchange_price
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency whereExchangePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency whereSymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Currency whereUpdatedAt($value)
 */
	class Currency extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Customer
 *
 * @property int $id
 * @property string $first_name
 * @property string|null $last_name
 * @property string $email
 * @property string $password
 * @property string|null $email_verified_at
 * @property int|null $verified_email
 * @property int|null $verified_phone
 * @property string|null $email_token
 * @property string|null $phone_token
 * @property string|null $phone
 * @property string|null $img_profile
 * @property string|null $whatsapp_acc
 * @property string|null $facebook_acc
 * @property string|null $country_code
 * @property string|null $phone2
 * @property string $gender
 * @property string|null $birth_date
 * @property int|null $city_id
 * @property string|null $address
 * @property string|null $address_2
 * @property string|null $account_number that related with wallet account
 * @property string $customer_type
 * @property string|null $wallet_code
 * @property int|null $badge_id
 * @property string|null $reference_id
 * @property string|null $referrer
 * @property int $active
 * @property int|null $blocked
 * @property string|null $ip_addr
 * @property string|null $remember_token
 * @property string|null $last_login_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Badge|null $badge
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\LiveBroadcasting[] $broadcasting
 * @property-read int|null $broadcasting_count
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Consultant[] $consultants
 * @property-read int|null $consultants_count
 * @property-read \App\Models\Country|null $country
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CourseTraining[] $courses
 * @property-read int|null $courses_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DepositOrder[] $deposits
 * @property-read int|null $deposits_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CustomerFinanceAccount[] $financeAccounts
 * @property-read int|null $finance_accounts_count
 * @property-read int|float|string $balance
 * @property-read int|float|string $balance_float
 * @property-read mixed $full_address
 * @property-read mixed $name
 * @property-read mixed $wallet_code_symbol
 * @property-read mixed $withdraws_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \App\Models\TeacherDetail|null $teacher
 * @property-read \Illuminate\Database\Eloquent\Collection|\Bavix\Wallet\Models\Transaction[] $transactions
 * @property-read int|null $transactions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Bavix\Wallet\Models\Transfer[] $transfers
 * @property-read int|null $transfers_count
 * @property-read \Bavix\Wallet\Models\Wallet $wallet
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DepositOrder[] $withdrawals
 * @property-read int|null $withdrawals_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereBadgeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereBlocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereCustomerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereEmailToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereFacebookAcc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereImgProfile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereIpAddr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereLastLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer wherePhone2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer wherePhoneToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereReferenceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereReferrer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereVerifiedEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereVerifiedPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereWalletCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Customer whereWhatsappAcc($value)
 */
	class Customer extends \Eloquent implements \Tymon\JWTAuth\Contracts\JWTSubject, \Bavix\Wallet\Interfaces\Wallet, \Bavix\Wallet\Interfaces\WalletFloat {}
}

namespace App\Models{
/**
 * App\Models\CustomerBankAccount
 *
 * @property int $id
 * @property int $customer_id
 * @property string $account_number
 * @property string $account_type
 * @property int $receiving_agencies_country_id
 * @property string|null $country_code
 * @property int|null $currency_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Country|null $country
 * @property-read \App\Models\ReceivingAgenciesCountry $countryAgencyBankCountry
 * @property-read \App\Models\Currency|null $currency
 * @property-read \App\Models\Customer $customer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CustomerLoverBankAccount[] $lovers
 * @property-read int|null $lovers_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerBankAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerBankAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerBankAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerBankAccount whereAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerBankAccount whereAccountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerBankAccount whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerBankAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerBankAccount whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerBankAccount whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerBankAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerBankAccount whereReceivingAgenciesCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerBankAccount whereUpdatedAt($value)
 */
	class CustomerBankAccount extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CustomerConsultantOrder
 *
 * @property int $id
 * @property int $customer_id
 * @property int $consultant_id
 * @property float $price
 * @property int $is_open
 * @property string $current_status
 * @property string $paid_status
 * @property string|null $reference_id_type
 * @property int $currency_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Consultant $consultant
 * @property-read \App\Models\Customer $customer
 * @property-read \App\Models\CustomersLoyaltyPointsPrice|null $loyalties
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerConsultantOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerConsultantOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerConsultantOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerConsultantOrder whereConsultantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerConsultantOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerConsultantOrder whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerConsultantOrder whereCurrentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerConsultantOrder whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerConsultantOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerConsultantOrder whereIsOpen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerConsultantOrder wherePaidStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerConsultantOrder wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerConsultantOrder whereReferenceIdType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerConsultantOrder whereUpdatedAt($value)
 */
	class CustomerConsultantOrder extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CustomerCourse
 *
 * @property int $id
 * @property int $course_id
 * @property int $customer_id
 * @property \Illuminate\Support\Carbon $joined_date
 * @property int|null $last_subject_id the last subject that customer interact with
 * @property mixed|null $completed_subjects
 * @property float $final_degree that will get in course
 * @property string $level_result
 * @property string|null $customer_note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CourseTraining $course
 * @property-read \App\Models\Customer $customer
 * @property-read \App\Models\CustomersLoyaltyPointsPrice|null $loyalties
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerCourse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerCourse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerCourse query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerCourse whereCompletedSubjects($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerCourse whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerCourse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerCourse whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerCourse whereCustomerNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerCourse whereFinalDegree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerCourse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerCourse whereJoinedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerCourse whereLastSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerCourse whereLevelResult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerCourse whereUpdatedAt($value)
 */
	class CustomerCourse extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CustomerDCOrder
 *
 * @property int $id
 * @property int $customer_id
 * @property string $current_status
 * @property float $total_amount
 * @property string|null $cards_codes will fill during buying the cards
 * @property string|null $customer_hint
 * @property string|null $admin_note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Customer $customer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DCardsPurchasesDetail[] $digitalCardsBought
 * @property-read int|null $digital_cards_bought_count
 * @property-read mixed $current_status_ar
 * @property-read mixed $deposit_type
 * @property-read \App\Models\CustomersLoyaltyPointsPrice|null $loyalties
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerDCOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerDCOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerDCOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerDCOrder whereAdminNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerDCOrder whereCardsCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerDCOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerDCOrder whereCurrentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerDCOrder whereCustomerHint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerDCOrder whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerDCOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerDCOrder whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerDCOrder whereUpdatedAt($value)
 */
	class CustomerDCOrder extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CustomerDCOrderDetail
 *
 * @property int $id
 * @property int $digital_cards_purchase_id
 * @property int $digital_card_id
 * @property string|null $card_code when order accept and admin will put code here
 * @property float $buy_price
 * @property string|null $expire_date
 * @property float|null $sell_price
 * @property int|null $currency_id
 * @property string $card_status
 * @property int|null $customer_d_c_order_id
 * @property string|null $assign_date when the card assigned to the customer
 * @property string|null $description instruction about using
 * @property string $assigned_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CustomerDCOrder|null $DCOrder
 * @property-read \App\Models\Currency|null $currency
 * @property-read \App\Models\DigitalCard $digitalCard
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerDCOrderDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerDCOrderDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerDCOrderDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerDCOrderDetail whereAssignDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerDCOrderDetail whereAssignedType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerDCOrderDetail whereBuyPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerDCOrderDetail whereCardCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerDCOrderDetail whereCardStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerDCOrderDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerDCOrderDetail whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerDCOrderDetail whereCustomerDCOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerDCOrderDetail whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerDCOrderDetail whereDigitalCardId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerDCOrderDetail whereDigitalCardsPurchaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerDCOrderDetail whereExpireDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerDCOrderDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerDCOrderDetail whereSellPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerDCOrderDetail whereUpdatedAt($value)
 */
	class CustomerDCOrderDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CustomerFinanceAccount
 *
 * @property int $id
 * @property int $customer_id
 * @property int $agency_id
 * @property string|null $agency_name
 * @property string|null $customer_agency_acc_number
 * @property string|null $customer_agency_acc_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DepositAgency $agency
 * @property-read \App\Models\Customer $customer
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerFinanceAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerFinanceAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerFinanceAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerFinanceAccount whereAgencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerFinanceAccount whereAgencyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerFinanceAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerFinanceAccount whereCustomerAgencyAccName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerFinanceAccount whereCustomerAgencyAccNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerFinanceAccount whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerFinanceAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerFinanceAccount whereUpdatedAt($value)
 */
	class CustomerFinanceAccount extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CustomerLiveBroadcasting
 *
 * @property int $id
 * @property int $customer_id
 * @property int|null $live_broadcasting_id
 * @property float|null $rating
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerLiveBroadcasting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerLiveBroadcasting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerLiveBroadcasting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerLiveBroadcasting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerLiveBroadcasting whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerLiveBroadcasting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerLiveBroadcasting whereLiveBroadcastingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerLiveBroadcasting whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerLiveBroadcasting whereUpdatedAt($value)
 */
	class CustomerLiveBroadcasting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CustomerLoverBankAccount
 *
 * @property int $id
 * @property string $lover_name
 * @property int $customer_id
 * @property string $account_number
 * @property string $account_type
 * @property int $receiving_agencies_country_id
 * @property string|null $country_code
 * @property int|null $currency_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Country|null $country
 * @property-read \App\Models\ReceivingAgenciesCountry $countryAgencyBankCountry
 * @property-read \App\Models\Currency|null $currency
 * @property-read \App\Models\Customer $relatedCustomer
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerLoverBankAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerLoverBankAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerLoverBankAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerLoverBankAccount whereAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerLoverBankAccount whereAccountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerLoverBankAccount whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerLoverBankAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerLoverBankAccount whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerLoverBankAccount whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerLoverBankAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerLoverBankAccount whereLoverName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerLoverBankAccount whereReceivingAgenciesCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerLoverBankAccount whereUpdatedAt($value)
 */
	class CustomerLoverBankAccount extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CustomersLoyaltyPointsPrice
 *
 * @property int $id
 * @property int $customer_id
 * @property int|null $customer_s_p_ops_id
 * @property float $count_scores
 * @property string $score_type
 * @property int $transferred when transferred wil convert to equable price
 * @property string|null $transferred_date
 * @property string|null $transferred_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $loyaltyable_type
 * @property int $loyaltyable_id
 * @property-read \App\Models\Customer $customer
 * @property-read \App\Models\CustomerSPOps|null $customerSPOps
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $loyaltyable
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomersLoyaltyPointsPrice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomersLoyaltyPointsPrice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomersLoyaltyPointsPrice query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomersLoyaltyPointsPrice whereCountScores($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomersLoyaltyPointsPrice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomersLoyaltyPointsPrice whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomersLoyaltyPointsPrice whereCustomerSPOpsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomersLoyaltyPointsPrice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomersLoyaltyPointsPrice whereLoyaltyableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomersLoyaltyPointsPrice whereLoyaltyableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomersLoyaltyPointsPrice whereScoreType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomersLoyaltyPointsPrice whereTransferred($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomersLoyaltyPointsPrice whereTransferredBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomersLoyaltyPointsPrice whereTransferredDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomersLoyaltyPointsPrice whereUpdatedAt($value)
 */
	class CustomersLoyaltyPointsPrice extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CustomerSPOps
 *
 * @property int $id
 * @property int $customer_id
 * @property int $service_package_id
 * @property string|null $description this will fill by customer
 * @property string|null $link_url
 * @property string|null $file_path
 * @property string $current_status
 * @property int $is_open
 * @property string|null $ip_address
 * @property string $device_type
 * @property string $device_info
 * @property string|null $admin_note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Customer $customer
 * @property-read \App\Models\CustomersLoyaltyPointsPrice|null $loyalties
 * @property-read \App\Models\CustomersLoyaltyPointsPrice|null $loyaltyPoint
 * @property-read \App\Models\ServicesPackage $servicePackage
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerSPOps newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerSPOps newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerSPOps query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerSPOps whereAdminNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerSPOps whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerSPOps whereCurrentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerSPOps whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerSPOps whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerSPOps whereDeviceInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerSPOps whereDeviceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerSPOps whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerSPOps whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerSPOps whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerSPOps whereIsOpen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerSPOps whereLinkUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerSPOps whereServicePackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CustomerSPOps whereUpdatedAt($value)
 */
	class CustomerSPOps extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DCardsPurchasesDetail
 *
 * @property int $id
 * @property int $digital_cards_purchase_id
 * @property int $digital_card_id
 * @property string|null $card_code when order accept and admin will put code here
 * @property float $buy_price
 * @property string|null $expire_date
 * @property float|null $sell_price
 * @property int|null $currency_id
 * @property string $card_status
 * @property int|null $customer_d_c_order_id
 * @property string|null $assign_date when the card assigned to the customer
 * @property string|null $description instruction about using
 * @property string $assigned_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DigitalCard $digitalCard
 * @property-read \App\Models\DigitalCardsPurchase $digitalCardPurchase
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DCardsPurchasesDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DCardsPurchasesDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DCardsPurchasesDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DCardsPurchasesDetail whereAssignDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DCardsPurchasesDetail whereAssignedType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DCardsPurchasesDetail whereBuyPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DCardsPurchasesDetail whereCardCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DCardsPurchasesDetail whereCardStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DCardsPurchasesDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DCardsPurchasesDetail whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DCardsPurchasesDetail whereCustomerDCOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DCardsPurchasesDetail whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DCardsPurchasesDetail whereDigitalCardId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DCardsPurchasesDetail whereDigitalCardsPurchaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DCardsPurchasesDetail whereExpireDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DCardsPurchasesDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DCardsPurchasesDetail whereSellPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DCardsPurchasesDetail whereUpdatedAt($value)
 */
	class DCardsPurchasesDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DepositAgency
 *
 * @property int $id
 * @property array $name
 * @property int|null $deposit_method_id
 * @property string $national
 * @property int|null $is_withdraw_agency
 * @property array|null $description
 * @property string|null $img_path
 * @property string|null $address
 * @property string|null $phone
 * @property int $active
 * @property string|null $ytadawul_account_number
 * @property string|null $ytadawul_account_name
 * @property float $deposit_fee_percent
 * @property float $fixed_charge_deposit when deposit maybe want to put charge as fixed amount
 * @property float $withdraw_fee_percent
 * @property float $fixed_charge_withdraw when withdraw maybe want to put charge as fixed amount
 * @property float $min_deposit_amount
 * @property float $max_deposit_amount
 * @property float $min_withdraw_amount
 * @property float $max_withdraw_amount
 * @property string|null $deposit_instructions
 * @property string|null $withdraw_instructions
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Country[] $countries
 * @property-read int|null $countries_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CustomerFinanceAccount[] $customersFinanceAccounts
 * @property-read int|null $customers_finance_accounts_count
 * @property-read \App\Models\DepositMethod|null $depositMethod
 * @property-read array $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgency query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgency whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgency whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgency whereDepositFeePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgency whereDepositInstructions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgency whereDepositMethodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgency whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgency whereFixedChargeDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgency whereFixedChargeWithdraw($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgency whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgency whereIsWithdrawAgency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgency whereMaxDepositAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgency whereMaxWithdrawAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgency whereMinDepositAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgency whereMinWithdrawAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgency whereNational($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgency wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgency whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgency whereWithdrawFeePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgency whereWithdrawInstructions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgency whereYtadawulAccountName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgency whereYtadawulAccountNumber($value)
 */
	class DepositAgency extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DepositAgencyCountry
 *
 * @property int $id
 * @property int $deposit_agency_id
 * @property int $country_id
 * @property string|null $ytadawul_account_number ytadawul account number in this country_id for this agency_id
 * @property string|null $ytadawul_account_name
 * @property float $fee_percent
 * @property float|null $withdraw_fee_percent when the agency is agency for withdraw too
 * @property array|null $description here will show the description for client how will we receive deposit from him
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Country $country
 * @property-read \App\Models\DepositAgency $depositAgency
 * @property-read mixed $name_agency_country
 * @property-read array $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgencyCountry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgencyCountry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgencyCountry query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgencyCountry whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgencyCountry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgencyCountry whereDepositAgencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgencyCountry whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgencyCountry whereFeePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgencyCountry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgencyCountry whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgencyCountry whereWithdrawFeePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgencyCountry whereYtadawulAccountName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgencyCountry whereYtadawulAccountNumber($value)
 */
	class DepositAgencyCountry extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DepositAgencyMethod
 *
 * @property int $id
 * @property int $deposit_agency_id
 * @property int $deposit_method_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DepositAgency $depositAgency
 * @property-read \App\Models\DepositMethod $depositMethod
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgencyMethod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgencyMethod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgencyMethod query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgencyMethod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgencyMethod whereDepositAgencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgencyMethod whereDepositMethodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgencyMethod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositAgencyMethod whereUpdatedAt($value)
 */
	class DepositAgencyMethod extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DepositMethod
 *
 * @property int $id
 * @property array $name
 * @property string $deposit_type
 * @property array|null $description
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositMethod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositMethod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositMethod query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositMethod whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositMethod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositMethod whereDepositType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositMethod whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositMethod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositMethod whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositMethod whereUpdatedAt($value)
 */
	class DepositMethod extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DepositOrder
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $deposit_date
 * @property string $op_type is deposit or withdrawals
 * @property string|null $op_code
 * @property string $order_type this col to know the deposit type not ..
 * @property float $amount
 * @property int $currency_id
 * @property float $client_amount the amount that must paied from client
 * @property int|null $cl_amount_curr_id
 * @property float $exchange_price the exchange price per USD in deposit moment
 * @property float $fee_percent
 * @property float $fee_amount
 * @property float $final_amount
 * @property int|null $customer_id
 * @property string $deposit_type
 * @property int|null $agency_id
 * @property int|null $deposit_agency_country_id
 * @property string|null $customer_finance_account
 * @property string $current_status
 * @property string|null $status_note when rejected or when still pending
 * @property \Illuminate\Support\Carbon|null $status_changed_date
 * @property int|null $confirmed_code DEPRECATED the voucher id in transaction head or the deposit_id in wallet
 * @property string|null $detail_statement
 * @property int|null $admin_id who confirmed this op
 * @property string|null $img_path
 * @property string|null $reference_id will be filled by customer and reviewed by admin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DepositWithdrawProcess|null $DepositWithdrawProcess
 * @property-read \App\Models\DepositAgency|null $agency
 * @property-read \App\Models\DepositAgencyCountry|null $agencyCountry
 * @property-read \App\Models\Currency $currency
 * @property-read \App\Models\Currency $currencyClient
 * @property-read \App\Models\Customer|null $customer
 * @property-read \App\Models\FreelancingPlatform|null $freelance
 * @property-read mixed $current_status_ar
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereAgencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereClAmountCurrId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereClientAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereConfirmedCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereCurrentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereCustomerFinanceAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereDepositAgencyCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereDepositDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereDepositType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereDetailStatement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereExchangePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereFeeAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereFeePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereFinalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereOpCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereOpType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereOrderType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereReferenceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereStatusChangedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereStatusNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrder whereUpdatedAt($value)
 */
	class DepositOrder extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DepositOrderCompleted
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $deposit_date
 * @property string $op_type is deposit or withdrawals
 * @property string|null $op_code
 * @property string $order_type this col to know the deposit type not ..
 * @property float $amount
 * @property int $currency_id
 * @property float $client_amount the amount that must paied from client
 * @property int|null $cl_amount_curr_id
 * @property float $exchange_price the exchange price per USD in deposit moment
 * @property float $fee_percent
 * @property float $fee_amount
 * @property float $final_amount
 * @property int|null $customer_id
 * @property string $deposit_type
 * @property int|null $agency_id
 * @property int|null $deposit_agency_country_id
 * @property string|null $customer_finance_account
 * @property string $current_status
 * @property string|null $status_note when rejected or when still pending
 * @property \Illuminate\Support\Carbon|null $status_changed_date
 * @property int|null $confirmed_code DEPRECATED the voucher id in transaction head or the deposit_id in wallet
 * @property string|null $detail_statement
 * @property int|null $admin_id who confirmed this op
 * @property string|null $img_path
 * @property string|null $reference_id will be filled by customer and reviewed by admin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DepositWithdrawProcess|null $DepositWithdrawProcess
 * @property-read \App\Models\DepositAgency|null $agency
 * @property-read \App\Models\DepositAgencyCountry|null $agencyCountry
 * @property-read \App\Models\Currency $currency
 * @property-read \App\Models\Currency $currencyClient
 * @property-read \App\Models\Customer|null $customer
 * @property-read \App\Models\FreelancingPlatform|null $freelance
 * @property-read mixed $current_status_ar
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderCompleted newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderCompleted newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderCompleted query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderCompleted whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderCompleted whereAgencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderCompleted whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderCompleted whereClAmountCurrId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderCompleted whereClientAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderCompleted whereConfirmedCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderCompleted whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderCompleted whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderCompleted whereCurrentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderCompleted whereCustomerFinanceAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderCompleted whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderCompleted whereDepositAgencyCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderCompleted whereDepositDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderCompleted whereDepositType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderCompleted whereDetailStatement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderCompleted whereExchangePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderCompleted whereFeeAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderCompleted whereFeePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderCompleted whereFinalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderCompleted whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderCompleted whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderCompleted whereOpCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderCompleted whereOpType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderCompleted whereOrderType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderCompleted whereReferenceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderCompleted whereStatusChangedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderCompleted whereStatusNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderCompleted whereUpdatedAt($value)
 */
	class DepositOrderCompleted extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DepositOrderRejected
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $deposit_date
 * @property string $op_type is deposit or withdrawals
 * @property string|null $op_code
 * @property string $order_type this col to know the deposit type not ..
 * @property float $amount
 * @property int $currency_id
 * @property float $client_amount the amount that must paied from client
 * @property int|null $cl_amount_curr_id
 * @property float $exchange_price the exchange price per USD in deposit moment
 * @property float $fee_percent
 * @property float $fee_amount
 * @property float $final_amount
 * @property int|null $customer_id
 * @property string $deposit_type
 * @property int|null $agency_id
 * @property int|null $deposit_agency_country_id
 * @property string|null $customer_finance_account
 * @property string $current_status
 * @property string|null $status_note when rejected or when still pending
 * @property \Illuminate\Support\Carbon|null $status_changed_date
 * @property int|null $confirmed_code DEPRECATED the voucher id in transaction head or the deposit_id in wallet
 * @property string|null $detail_statement
 * @property int|null $admin_id who confirmed this op
 * @property string|null $img_path
 * @property string|null $reference_id will be filled by customer and reviewed by admin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DepositWithdrawProcess|null $DepositWithdrawProcess
 * @property-read \App\Models\DepositAgency|null $agency
 * @property-read \App\Models\DepositAgencyCountry|null $agencyCountry
 * @property-read \App\Models\Currency $currency
 * @property-read \App\Models\Currency $currencyClient
 * @property-read \App\Models\Customer|null $customer
 * @property-read \App\Models\FreelancingPlatform|null $freelance
 * @property-read mixed $current_status_ar
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderRejected newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderRejected newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderRejected query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderRejected whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderRejected whereAgencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderRejected whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderRejected whereClAmountCurrId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderRejected whereClientAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderRejected whereConfirmedCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderRejected whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderRejected whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderRejected whereCurrentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderRejected whereCustomerFinanceAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderRejected whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderRejected whereDepositAgencyCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderRejected whereDepositDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderRejected whereDepositType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderRejected whereDetailStatement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderRejected whereExchangePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderRejected whereFeeAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderRejected whereFeePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderRejected whereFinalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderRejected whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderRejected whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderRejected whereOpCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderRejected whereOpType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderRejected whereOrderType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderRejected whereReferenceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderRejected whereStatusChangedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderRejected whereStatusNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderRejected whereUpdatedAt($value)
 */
	class DepositOrderRejected extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DepositOrderSuspended
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $deposit_date
 * @property string $op_type is deposit or withdrawals
 * @property string|null $op_code
 * @property string $order_type this col to know the deposit type not ..
 * @property float $amount
 * @property int $currency_id
 * @property float $client_amount the amount that must paied from client
 * @property int|null $cl_amount_curr_id
 * @property float $exchange_price the exchange price per USD in deposit moment
 * @property float $fee_percent
 * @property float $fee_amount
 * @property float $final_amount
 * @property int|null $customer_id
 * @property string $deposit_type
 * @property int|null $agency_id
 * @property int|null $deposit_agency_country_id
 * @property string|null $customer_finance_account
 * @property string $current_status
 * @property string|null $status_note when rejected or when still pending
 * @property \Illuminate\Support\Carbon|null $status_changed_date
 * @property int|null $confirmed_code DEPRECATED the voucher id in transaction head or the deposit_id in wallet
 * @property string|null $detail_statement
 * @property int|null $admin_id who confirmed this op
 * @property string|null $img_path
 * @property string|null $reference_id will be filled by customer and reviewed by admin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DepositWithdrawProcess|null $DepositWithdrawProcess
 * @property-read \App\Models\DepositAgency|null $agency
 * @property-read \App\Models\DepositAgencyCountry|null $agencyCountry
 * @property-read \App\Models\Currency $currency
 * @property-read \App\Models\Currency $currencyClient
 * @property-read \App\Models\Customer|null $customer
 * @property-read \App\Models\FreelancingPlatform|null $freelance
 * @property-read mixed $current_status_ar
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderSuspended newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderSuspended newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderSuspended query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderSuspended whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderSuspended whereAgencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderSuspended whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderSuspended whereClAmountCurrId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderSuspended whereClientAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderSuspended whereConfirmedCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderSuspended whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderSuspended whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderSuspended whereCurrentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderSuspended whereCustomerFinanceAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderSuspended whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderSuspended whereDepositAgencyCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderSuspended whereDepositDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderSuspended whereDepositType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderSuspended whereDetailStatement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderSuspended whereExchangePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderSuspended whereFeeAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderSuspended whereFeePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderSuspended whereFinalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderSuspended whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderSuspended whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderSuspended whereOpCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderSuspended whereOpType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderSuspended whereOrderType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderSuspended whereReferenceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderSuspended whereStatusChangedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderSuspended whereStatusNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositOrderSuspended whereUpdatedAt($value)
 */
	class DepositOrderSuspended extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DepositWithdrawProcess
 *
 * @property int $id
 * @property string $processable_type
 * @property int $processable_id
 * @property string|null $transfer_number
 * @property string|null $reference_id_type
 * @property string $last_modified_by
 * @property string|null $new_values
 * @property string|null $old_values
 * @property int $admin_id who confirmed this op
 * @property string|null $admin_note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $processable
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositWithdrawProcess newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositWithdrawProcess newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositWithdrawProcess query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositWithdrawProcess whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositWithdrawProcess whereAdminNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositWithdrawProcess whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositWithdrawProcess whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositWithdrawProcess whereLastModifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositWithdrawProcess whereNewValues($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositWithdrawProcess whereOldValues($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositWithdrawProcess whereProcessableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositWithdrawProcess whereProcessableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositWithdrawProcess whereReferenceIdType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositWithdrawProcess whereTransferNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DepositWithdrawProcess whereUpdatedAt($value)
 */
	class DepositWithdrawProcess extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DigitalCard
 *
 * @property int $id
 * @property int $provider_id
 * @property int $store_id
 * @property int $d_c_package_id
 * @property string|null $name deprecated
 * @property string|null $img_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $provider_store_package_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CustomerDCOrderDetail[] $orderDetails
 * @property-read int|null $order_details_count
 * @property-read \App\Models\DigitalCardsProvider $provider
 * @property-read \App\Models\DigitalCardProviderPackage $providerPackage
 * @property-read \App\Models\DigitalCardProviderPackage $providerPackageDistinct
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DCardsPurchasesDetail[] $purchaseDetails
 * @property-read int|null $purchase_details_count
 * @property-read \App\Models\DigitalCardStore $store
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCard newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCard query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCard whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCard whereDCPackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCard whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCard whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCard whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCard whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCard whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCard whereUpdatedAt($value)
 */
	class DigitalCard extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DigitalCardCategory
 *
 * @property int $id
 * @property array $name
 * @property int|null $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DigitalCardsProvider[] $providers
 * @property-read int|null $providers_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardCategory whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardCategory whereUpdatedAt($value)
 */
	class DigitalCardCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DigitalCardProviderPackage
 *
 * @property int $id
 * @property int $d_card_provider_id
 * @property int $store_id
 * @property array $name
 * @property float $price
 * @property int|null $currency_id
 * @property int|null $expire_days
 * @property string|null $img_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Currency|null $currency
 * @property-read \App\Models\DigitalCard|null $digitalCard
 * @property-read mixed $provider_store_package_name
 * @property-read array $translations
 * @property-read \App\Models\DigitalCardsProvider $provider
 * @property-read \App\Models\DigitalCardStore $store
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardProviderPackage distinctInDigitalCard()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardProviderPackage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardProviderPackage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardProviderPackage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardProviderPackage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardProviderPackage whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardProviderPackage whereDCardProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardProviderPackage whereExpireDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardProviderPackage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardProviderPackage whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardProviderPackage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardProviderPackage wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardProviderPackage whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardProviderPackage whereUpdatedAt($value)
 */
	class DigitalCardProviderPackage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DigitalCardsProvider
 *
 * @property int $id
 * @property array $name
 * @property array|null $short_desc
 * @property int|null $category_id
 * @property array|null $description
 * @property string|null $back_ground_color1
 * @property string|null $back_ground_color2
 * @property string|null $img_path
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DigitalCardCategory|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DigitalCard[] $digitalCards
 * @property-read int|null $digital_cards_count
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DigitalCardStore[] $stores
 * @property-read int|null $stores_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardsProvider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardsProvider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardsProvider query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardsProvider whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardsProvider whereBackGroundColor1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardsProvider whereBackGroundColor2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardsProvider whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardsProvider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardsProvider whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardsProvider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardsProvider whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardsProvider whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardsProvider whereShortDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardsProvider whereUpdatedAt($value)
 */
	class DigitalCardsProvider extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DigitalCardsPurchase
 *
 * @property int $id
 * @property string|null $purchase_date
 * @property string|null $credit_account_number deprecated
 * @property float $total_invoice
 * @property int $currency_id
 * @property string|null $description
 * @property string|null $reference_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Currency $currency
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DigitalCard[] $invoiceItems
 * @property-read int|null $invoice_items_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardsPurchase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardsPurchase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardsPurchase query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardsPurchase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardsPurchase whereCreditAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardsPurchase whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardsPurchase whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardsPurchase whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardsPurchase wherePurchaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardsPurchase whereReferenceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardsPurchase whereTotalInvoice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardsPurchase whereUpdatedAt($value)
 */
	class DigitalCardsPurchase extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DigitalCardStore
 *
 * @property int $id
 * @property array $name
 * @property int $shown if true then there are other stores for this provider
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DigitalCardProviderPackage[] $providerPackages
 * @property-read int|null $provider_packages_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DigitalCardsProvider[] $providers
 * @property-read int|null $providers_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardStore newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardStore newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardStore query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardStore whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardStore whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardStore whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardStore whereShown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DigitalCardStore whereUpdatedAt($value)
 */
	class DigitalCardStore extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EmailTemplate
 *
 * @property int $id
 * @property string $category
 * @property string $action
 * @property string $name
 * @property string $subject
 * @property string|null $email_body
 * @property string|null $sms_body
 * @property string $shortcodes
 * @property int $email_status
 * @property int $sms_status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailTemplate whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailTemplate whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailTemplate whereEmailBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailTemplate whereEmailStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailTemplate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailTemplate whereShortcodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailTemplate whereSmsBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailTemplate whereSmsStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailTemplate whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EmailTemplate whereUpdatedAt($value)
 */
	class EmailTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FreelancingPlatform
 *
 * @property int $id
 * @property string $name
 * @property string|null $img_path
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DepositAgency[] $depositAgencies
 * @property-read int|null $deposit_agencies_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FreelancingPlatform newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FreelancingPlatform newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FreelancingPlatform query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FreelancingPlatform whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FreelancingPlatform whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FreelancingPlatform whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FreelancingPlatform whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FreelancingPlatform whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FreelancingPlatform whereUpdatedAt($value)
 */
	class FreelancingPlatform extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Language
 *
 * @property int $id
 * @property string $abbr
 * @property string|null $locale
 * @property string $name
 * @property string|null $local_name
 * @property string|null $flag
 * @property string|null $direction
 * @property string|null $date_format
 * @property string|null $datetime_format
 * @property int|null $active
 * @property int|null $default
 * @property int|null $lft
 * @property int|null $rgt
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereAbbr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereDateFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereDatetimeFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereDirection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereFlag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereLocalName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereRgt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereUpdatedAt($value)
 */
	class Language extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LiveBroadcasting
 *
 * @property int $id
 * @property array $subject
 * @property array|null $description
 * @property string|null $img_path
 * @property string|null $start_at
 * @property string|null $end_at
 * @property string|null $sharing_link zoom,gmeet,..
 * @property string|null $external_link after complete maybe share it on youtube
 * @property string|null $author
 * @property int $commentable
 * @property float|null $rating
 * @property int $active_now
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Customer[] $customers
 * @property-read int|null $customers_count
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CustomerLiveBroadcasting[] $liveBroadcastingCustomer
 * @property-read int|null $live_broadcasting_customer_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveBroadcasting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveBroadcasting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveBroadcasting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveBroadcasting whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveBroadcasting whereActiveNow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveBroadcasting whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveBroadcasting whereCommentable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveBroadcasting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveBroadcasting whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveBroadcasting whereEndAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveBroadcasting whereExternalLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveBroadcasting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveBroadcasting whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveBroadcasting whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveBroadcasting whereSharingLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveBroadcasting whereStartAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveBroadcasting whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LiveBroadcasting whereUpdatedAt($value)
 */
	class LiveBroadcasting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LoyaltyPointsPrice
 *
 * @property int $id
 * @property float $from
 * @property float $to
 * @property int|null $badge_id
 * @property float $price
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Badge|null $badge
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoyaltyPointsPrice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoyaltyPointsPrice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoyaltyPointsPrice query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoyaltyPointsPrice whereBadgeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoyaltyPointsPrice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoyaltyPointsPrice whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoyaltyPointsPrice whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoyaltyPointsPrice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoyaltyPointsPrice wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoyaltyPointsPrice whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoyaltyPointsPrice whereUpdatedAt($value)
 */
	class LoyaltyPointsPrice extends \Eloquent {}
}

namespace App\Models\OrgModels{
/**
 * App\Models\OrgModels\AboutCompanyPageSetting
 *
 * @property int $id
 * @property string $trade_mark_title
 * @property string $trade_mark_desc
 * @property string $Definition_company_title
 * @property string $Definition_company_desc
 * @property string $trade_mark_title_en
 * @property string $trade_mark_desc_en
 * @property string $Definition_company_title_en
 * @property string $Definition_company_desc_en
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read mixed $definition_company_desc
 * @property-read mixed $definition_company_title
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AboutCompanyPageSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AboutCompanyPageSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AboutCompanyPageSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AboutCompanyPageSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AboutCompanyPageSetting whereDefinitionCompanyDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AboutCompanyPageSetting whereDefinitionCompanyDescEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AboutCompanyPageSetting whereDefinitionCompanyTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AboutCompanyPageSetting whereDefinitionCompanyTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AboutCompanyPageSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AboutCompanyPageSetting whereTradeMarkDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AboutCompanyPageSetting whereTradeMarkDescEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AboutCompanyPageSetting whereTradeMarkTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AboutCompanyPageSetting whereTradeMarkTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AboutCompanyPageSetting whereUpdatedAt($value)
 */
	class AboutCompanyPageSetting extends \Eloquent {}
}

namespace App\Models\OrgModels{
/**
 * App\Models\OrgModels\AccessPolicy
 *
 * @property int $id
 * @property string $introduction
 * @property string $target
 * @property string $uses_website
 * @property string $included_website
 * @property string $subscribe_customer
 * @property string $Alternative_solutions
 * @property string $Compliance_standards
 * @property string $phone
 * @property string $whatsApp
 * @property string $default_email
 * @property string $introduction_en
 * @property string $target_en
 * @property string $uses_website_en
 * @property string $included_website_en
 * @property string $subscribe_customer_en
 * @property string $Alternative_solutions_en
 * @property string $Compliance_standards_en
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AccessPolicy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AccessPolicy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AccessPolicy query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AccessPolicy whereAlternativeSolutions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AccessPolicy whereAlternativeSolutionsEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AccessPolicy whereComplianceStandards($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AccessPolicy whereComplianceStandardsEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AccessPolicy whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AccessPolicy whereDefaultEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AccessPolicy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AccessPolicy whereIncludedWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AccessPolicy whereIncludedWebsiteEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AccessPolicy whereIntroduction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AccessPolicy whereIntroductionEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AccessPolicy wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AccessPolicy whereSubscribeCustomer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AccessPolicy whereSubscribeCustomerEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AccessPolicy whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AccessPolicy whereTargetEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AccessPolicy whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AccessPolicy whereUsesWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AccessPolicy whereUsesWebsiteEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\AccessPolicy whereWhatsApp($value)
 */
	class AccessPolicy extends \Eloquent {}
}

namespace App\Models\OrgModels{
/**
 * App\Models\OrgModels\BrokerageFirm
 *
 * @property int $id
 * @property string $brokerage_firms_name
 * @property string|null $brokerage_firms_logo
 * @property string|null $brokerage_firms_link
 * @property string $language
 * @property int|null $original_row
 * @property int $translated
 * @property int|null $translated_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\BrokerageFirm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\BrokerageFirm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\BrokerageFirm query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\BrokerageFirm whereBrokerageFirmsLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\BrokerageFirm whereBrokerageFirmsLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\BrokerageFirm whereBrokerageFirmsName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\BrokerageFirm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\BrokerageFirm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\BrokerageFirm whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\BrokerageFirm whereOriginalRow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\BrokerageFirm whereTranslated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\BrokerageFirm whereTranslatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\BrokerageFirm whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\BrokerageFirm whereUserId($value)
 */
	class BrokerageFirm extends \Eloquent {}
}

namespace App\Models\OrgModels{
/**
 * App\Models\OrgModels\Certificate
 *
 * @property int $id
 * @property string|null $certificate_name
 * @property string $certificate_image
 * @property string|null $certificate_link
 * @property string $language
 * @property int|null $original_row
 * @property int $translated
 * @property int|null $translated_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Certificate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Certificate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Certificate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Certificate whereCertificateImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Certificate whereCertificateLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Certificate whereCertificateName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Certificate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Certificate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Certificate whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Certificate whereOriginalRow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Certificate whereTranslated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Certificate whereTranslatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Certificate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Certificate whereUserId($value)
 */
	class Certificate extends \Eloquent {}
}

namespace App\Models\OrgModels{
/**
 * App\Models\OrgModels\ContactUsPageSetting
 *
 * @property int $id
 * @property string $title
 * @property string $first_paragraph
 * @property string $second_paragraph
 * @property string $phone
 * @property string $whatsapp
 * @property string $support_email
 * @property string $title_en
 * @property string $first_paragraph_en
 * @property string $second_paragraph_en
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\ContactUsPageSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\ContactUsPageSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\ContactUsPageSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\ContactUsPageSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\ContactUsPageSetting whereFirstParagraph($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\ContactUsPageSetting whereFirstParagraphEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\ContactUsPageSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\ContactUsPageSetting wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\ContactUsPageSetting whereSecondParagraph($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\ContactUsPageSetting whereSecondParagraphEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\ContactUsPageSetting whereSupportEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\ContactUsPageSetting whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\ContactUsPageSetting whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\ContactUsPageSetting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\ContactUsPageSetting whereWhatsapp($value)
 */
	class ContactUsPageSetting extends \Eloquent {}
}

namespace App\Models\OrgModels{
/**
 * App\Models\OrgModels\Contact_us_social_link_setups
 *
 * @property int $id
 * @property string|null $phone
 * @property string|null $whatsapp
 * @property string|null $email
 * @property string|null $telegram
 * @property string|null $messenger
 * @property string|null $skype
 * @property string|null $viber
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $fb
 * @property string|null $twitter
 * @property string|null $instagram
 * @property string|null $linkdein
 * @property string|null $youtube
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Contact_us_social_link_setups newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Contact_us_social_link_setups newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Contact_us_social_link_setups query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Contact_us_social_link_setups whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Contact_us_social_link_setups whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Contact_us_social_link_setups whereFb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Contact_us_social_link_setups whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Contact_us_social_link_setups whereInstagram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Contact_us_social_link_setups whereLinkdein($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Contact_us_social_link_setups whereMessenger($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Contact_us_social_link_setups wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Contact_us_social_link_setups whereSkype($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Contact_us_social_link_setups whereTelegram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Contact_us_social_link_setups whereTwitter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Contact_us_social_link_setups whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Contact_us_social_link_setups whereViber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Contact_us_social_link_setups whereWhatsapp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Contact_us_social_link_setups whereYoutube($value)
 */
	class Contact_us_social_link_setups extends \Eloquent {}
}

namespace App\Models\OrgModels{
/**
 * App\Models\OrgModels\Counter
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string|null $image
 * @property string|null $counter
 * @property string $language
 * @property int|null $original_row
 * @property int $translated
 * @property int|null $translated_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Counter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Counter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Counter query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Counter whereCounter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Counter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Counter whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Counter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Counter whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Counter whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Counter whereOriginalRow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Counter whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Counter whereTranslated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Counter whereTranslatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Counter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Counter whereUserId($value)
 */
	class Counter extends \Eloquent {}
}

namespace App\Models\OrgModels{
/**
 * App\Models\OrgModels\News
 *
 * @property int $id
 * @property string $new_title
 * @property string $new_subtitle
 * @property string $slug
 * @property string $short_link
 * @property string $keywords
 * @property int $views
 * @property string|null $new_image
 * @property string $new_content
 * @property string $language
 * @property int|null $original_row
 * @property int $translated
 * @property int|null $translated_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\News query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\News whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\News whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\News whereNewContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\News whereNewImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\News whereNewSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\News whereNewTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\News whereOriginalRow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\News whereShortLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\News whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\News whereTranslated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\News whereTranslatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\News whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\News whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\News whereViews($value)
 */
	class News extends \Eloquent {}
}

namespace App\Models\OrgModels{
/**
 * App\Models\OrgModels\NewsletterSubscriber
 *
 * @property int $id
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\NewsletterSubscriber newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\NewsletterSubscriber newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\NewsletterSubscriber query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\NewsletterSubscriber whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\NewsletterSubscriber whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\NewsletterSubscriber whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\NewsletterSubscriber whereUpdatedAt($value)
 */
	class NewsletterSubscriber extends \Eloquent {}
}

namespace App\Models\OrgModels{
/**
 * App\Models\OrgModels\Offer
 *
 * @property int $id
 * @property string $offer_title
 * @property int $activated
 * @property string|null $offer_logo
 * @property string $offer_discount_text
 * @property string $offer_small_description
 * @property string $offer_desc_title
 * @property string $offer_desc
 * @property int|null $old_price
 * @property int|null $discount_rate
 * @property int|null $new_price
 * @property string $offer_currency
 * @property int|null $offer_period
 * @property string|null $finish_date
 * @property string|null $offer_button_text
 * @property string|null $offer_button_link
 * @property string $language
 * @property int|null $original_row
 * @property int $translated
 * @property int|null $translated_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Offer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Offer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Offer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Offer whereActivated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Offer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Offer whereDiscountRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Offer whereFinishDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Offer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Offer whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Offer whereNewPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Offer whereOfferButtonLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Offer whereOfferButtonText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Offer whereOfferCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Offer whereOfferDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Offer whereOfferDescTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Offer whereOfferDiscountText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Offer whereOfferLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Offer whereOfferPeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Offer whereOfferSmallDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Offer whereOfferTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Offer whereOldPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Offer whereOriginalRow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Offer whereTranslated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Offer whereTranslatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Offer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Offer whereUserId($value)
 */
	class Offer extends \Eloquent {}
}

namespace App\Models\OrgModels{
/**
 * App\Models\OrgModels\PageSetup
 *
 * @property int $id
 * @property string $about_company_title
 * @property string $about_company_background
 * @property string $about_company_sub_title
 * @property string $about_company_keyword
 * @property string $news_title
 * @property string $news_background
 * @property string $news_sub_title
 * @property string $news_keyword
 * @property string $services_title
 * @property string $services_background
 * @property string $services_sub_title
 * @property string $services_keyword
 * @property string $offers_title
 * @property string $offers_background
 * @property string $offers_sub_title
 * @property string $offers_keyword
 * @property string $blog_title
 * @property string $blog_background
 * @property string $blog_sub_title
 * @property string $blog_keyword
 * @property string $about_company_title_en
 * @property string $about_company_sub_title_en
 * @property string $about_company_keyword_en
 * @property string $news_title_en
 * @property string $news_sub_title_en
 * @property string $news_keyword_en
 * @property string $services_title_en
 * @property string $services_sub_title_en
 * @property string $services_keyword_en
 * @property string $offers_title_en
 * @property string $offers_sub_title_en
 * @property string $offers_keyword_en
 * @property string $blog_title_en
 * @property string $blog_sub_title_en
 * @property string $blog_keyword_en
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereAboutCompanyBackground($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereAboutCompanyKeyword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereAboutCompanyKeywordEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereAboutCompanySubTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereAboutCompanySubTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereAboutCompanyTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereAboutCompanyTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereBlogBackground($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereBlogKeyword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereBlogKeywordEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereBlogSubTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereBlogSubTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereBlogTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereBlogTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereNewsBackground($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereNewsKeyword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereNewsKeywordEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereNewsSubTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereNewsSubTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereNewsTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereNewsTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereOffersBackground($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereOffersKeyword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereOffersKeywordEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereOffersSubTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereOffersSubTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereOffersTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereOffersTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereServicesBackground($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereServicesKeyword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereServicesKeywordEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereServicesSubTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereServicesSubTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereServicesTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereServicesTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PageSetup whereUpdatedAt($value)
 */
	class PageSetup extends \Eloquent {}
}

namespace App\Models\OrgModels{
/**
 * App\Models\OrgModels\Partner
 *
 * @property int $id
 * @property string|null $partner_name
 * @property string $partner_logo
 * @property string|null $partner_link
 * @property string $language
 * @property int|null $original_row
 * @property int $translated
 * @property int|null $translated_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Partner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Partner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Partner query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Partner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Partner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Partner whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Partner whereOriginalRow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Partner wherePartnerLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Partner wherePartnerLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Partner wherePartnerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Partner whereTranslated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Partner whereTranslatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Partner whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Partner whereUserId($value)
 */
	class Partner extends \Eloquent {}
}

namespace App\Models\OrgModels{
/**
 * App\Models\OrgModels\PaymentCompany
 *
 * @property int $id
 * @property string|null $payment_company_name
 * @property string $payment_company_logo
 * @property string|null $payment_company_link
 * @property string $language
 * @property int|null $original_row
 * @property int $translated
 * @property int|null $translated_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PaymentCompany newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PaymentCompany newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PaymentCompany query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PaymentCompany whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PaymentCompany whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PaymentCompany whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PaymentCompany whereOriginalRow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PaymentCompany wherePaymentCompanyLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PaymentCompany wherePaymentCompanyLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PaymentCompany wherePaymentCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PaymentCompany whereTranslated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PaymentCompany whereTranslatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PaymentCompany whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PaymentCompany whereUserId($value)
 */
	class PaymentCompany extends \Eloquent {}
}

namespace App\Models\OrgModels{
/**
 * App\Models\OrgModels\Post
 *
 * @property int $id
 * @property string $post_title
 * @property string $post_subtitle
 * @property string $author_post
 * @property string $slug
 * @property string $short_link
 * @property string $keywords
 * @property int $views
 * @property string|null $post_image
 * @property string $post_content
 * @property string $language
 * @property int|null $original_row
 * @property int $translated
 * @property int|null $translated_id
 * @property int $user_id
 * @property int $post_category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\OrgModels\PostCategory $category
 * @property-read \App\Models\User $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Post whereAuthorPost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Post whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Post whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Post whereOriginalRow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Post wherePostCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Post wherePostContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Post wherePostImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Post wherePostSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Post wherePostTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Post whereShortLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Post whereTranslated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Post whereTranslatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Post whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Post whereViews($value)
 */
	class Post extends \Eloquent {}
}

namespace App\Models\OrgModels{
/**
 * App\Models\OrgModels\PostCategory
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $color
 * @property string $for_what
 * @property string $language
 * @property int|null $original_row
 * @property int $translated
 * @property int|null $translated_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\User $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PostCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PostCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PostCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PostCategory whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PostCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PostCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PostCategory whereForWhat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PostCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PostCategory whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PostCategory whereOriginalRow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PostCategory whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PostCategory whereTranslated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PostCategory whereTranslatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PostCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\PostCategory whereUserId($value)
 */
	class PostCategory extends \Eloquent {}
}

namespace App\Models\OrgModels{
/**
 * App\Models\OrgModels\Privacy_policies
 *
 * @property int $id
 * @property string $public_information
 * @property string $access_for_data
 * @property string $manage_personal_data
 * @property string $information_collect
 * @property string $how_Uses_data
 * @property string $sharing_data
 * @property string $For_inquiries
 * @property string $public_information_en
 * @property string $access_for_data_en
 * @property string $manage_personal_data_en
 * @property string $information_collect_en
 * @property string $how_Uses_data_en
 * @property string $sharing_data_en
 * @property string $For_inquiries_en
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Privacy_policies newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Privacy_policies newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Privacy_policies query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Privacy_policies whereAccessForData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Privacy_policies whereAccessForDataEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Privacy_policies whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Privacy_policies whereForInquiries($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Privacy_policies whereForInquiriesEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Privacy_policies whereHowUsesData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Privacy_policies whereHowUsesDataEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Privacy_policies whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Privacy_policies whereInformationCollect($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Privacy_policies whereInformationCollectEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Privacy_policies whereManagePersonalData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Privacy_policies whereManagePersonalDataEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Privacy_policies wherePublicInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Privacy_policies wherePublicInformationEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Privacy_policies whereSharingData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Privacy_policies whereSharingDataEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Privacy_policies whereUpdatedAt($value)
 */
	class Privacy_policies extends \Eloquent {}
}

namespace App\Models\OrgModels{
/**
 * App\Models\OrgModels\ServiceCategory
 *
 * @property int $id
 * @property string $category_name
 * @property string $category_desc
 * @property string $category_icon
 * @property string $category_keywords
 * @property string $slug
 * @property string $language
 * @property int|null $original_row
 * @property int $translated
 * @property int|null $translated_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\ServiceCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\ServiceCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\ServiceCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\ServiceCategory whereCategoryDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\ServiceCategory whereCategoryIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\ServiceCategory whereCategoryKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\ServiceCategory whereCategoryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\ServiceCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\ServiceCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\ServiceCategory whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\ServiceCategory whereOriginalRow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\ServiceCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\ServiceCategory whereTranslated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\ServiceCategory whereTranslatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\ServiceCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\ServiceCategory whereUserId($value)
 */
	class ServiceCategory extends \Eloquent {}
}

namespace App\Models\OrgModels{
/**
 * App\Models\OrgModels\Services
 *
 * @property int $id
 * @property string $service_title
 * @property string $service_sub_title
 * @property string $service_background
 * @property string $language
 * @property int|null $original_row
 * @property int $translated
 * @property int|null $translated_id
 * @property string $service_short_desc_title
 * @property string $service_short_desc
 * @property string $service_desc
 * @property string $slug
 * @property string|null $service_icons
 * @property string $login_title
 * @property string $login_desc
 * @property string $service_keyword
 * @property int $user_id
 * @property int $service_category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Services newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Services newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Services query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Services whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Services whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Services whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Services whereLoginDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Services whereLoginTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Services whereOriginalRow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Services whereServiceBackground($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Services whereServiceCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Services whereServiceDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Services whereServiceIcons($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Services whereServiceKeyword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Services whereServiceShortDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Services whereServiceShortDescTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Services whereServiceSubTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Services whereServiceTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Services whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Services whereTranslated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Services whereTranslatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Services whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Services whereUserId($value)
 */
	class Services extends \Eloquent {}
}

namespace App\Models\OrgModels{
/**
 * App\Models\OrgModels\Service_features
 *
 * @property int $id
 * @property string $feature_title
 * @property string $feature_desc
 * @property int $service_id
 * @property int $user_id
 * @property string $language
 * @property int|null $original_row
 * @property int $translated
 * @property int|null $translated_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Service_features newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Service_features newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Service_features query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Service_features whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Service_features whereFeatureDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Service_features whereFeatureTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Service_features whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Service_features whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Service_features whereOriginalRow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Service_features whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Service_features whereTranslated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Service_features whereTranslatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Service_features whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Service_features whereUserId($value)
 */
	class Service_features extends \Eloquent {}
}

namespace App\Models\OrgModels{
/**
 * App\Models\OrgModels\SiteSetting
 *
 * @property int $id
 * @property string $website_title
 * @property string $website_description
 * @property string $home_keywords
 * @property int $show_two_lang
 * @property string $logo
 * @property string $who_us
 * @property string $mission
 * @property string $vision
 * @property string $default_email
 * @property string $copy_right
 * @property string $website_title_en
 * @property string $website_description_en
 * @property string $home_keywords_en
 * @property string $who_us_en
 * @property string $mission_en
 * @property string $vision_en
 * @property string $copy_right_en
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\SiteSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\SiteSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\SiteSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\SiteSetting whereCopyRight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\SiteSetting whereCopyRightEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\SiteSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\SiteSetting whereDefaultEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\SiteSetting whereHomeKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\SiteSetting whereHomeKeywordsEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\SiteSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\SiteSetting whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\SiteSetting whereMission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\SiteSetting whereMissionEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\SiteSetting whereShowTwoLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\SiteSetting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\SiteSetting whereVision($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\SiteSetting whereVisionEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\SiteSetting whereWebsiteDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\SiteSetting whereWebsiteDescriptionEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\SiteSetting whereWebsiteTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\SiteSetting whereWebsiteTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\SiteSetting whereWhoUs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\SiteSetting whereWhoUsEn($value)
 */
	class SiteSetting extends \Eloquent {}
}

namespace App\Models\OrgModels{
/**
 * App\Models\OrgModels\Slider
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string|null $image
 * @property string|null $image_en
 * @property int $showSlide
 * @property string|null $button_text
 * @property string|null $button_link
 * @property string $language
 * @property int|null $original_row
 * @property int $translated
 * @property int|null $translated_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Slider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Slider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Slider query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Slider whereButtonLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Slider whereButtonText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Slider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Slider whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Slider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Slider whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Slider whereImageEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Slider whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Slider whereOriginalRow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Slider whereShowSlide($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Slider whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Slider whereTranslated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Slider whereTranslatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Slider whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\Slider whereUserId($value)
 */
	class Slider extends \Eloquent {}
}

namespace App\Models\OrgModels{
/**
 * App\Models\OrgModels\WhyUs
 *
 * @property int $id
 * @property string $title
 * @property string $icon
 * @property string|null $description
 * @property string $language
 * @property int|null $original_row
 * @property int $translated
 * @property int|null $translated_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\WhyUs newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\WhyUs newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\WhyUs query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\WhyUs whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\WhyUs whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\WhyUs whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\WhyUs whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\WhyUs whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\WhyUs whereOriginalRow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\WhyUs whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\WhyUs whereTranslated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\WhyUs whereTranslatedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\WhyUs whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrgModels\WhyUs whereUserId($value)
 */
	class WhyUs extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PackagesCategory
 *
 * @property int $id
 * @property array $name
 * @property string|null $short_description
 * @property array|null $description
 * @property string $num_days for once usage 0 ,for one day 1 , for week 7 for month 31 for year 365
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Service[] $services
 * @property-read int|null $services_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PackagesCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PackagesCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PackagesCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PackagesCategory whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PackagesCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PackagesCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PackagesCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PackagesCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PackagesCategory whereNumDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PackagesCategory whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PackagesCategory whereUpdatedAt($value)
 */
	class PackagesCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ParentService
 *
 * @property int $id
 * @property array $name
 * @property string|null $short_description
 * @property array|null $description
 * @property string|null $img_path
 * @property int $active
 * @property string|null $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ServiceFeature[] $serviceFeatures
 * @property-read int|null $service_features_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Service[] $services
 * @property-read int|null $services_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParentService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParentService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParentService query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParentService whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParentService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParentService whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParentService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParentService whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParentService whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParentService whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParentService whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ParentService whereUpdatedAt($value)
 */
	class ParentService extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PayingOrder
 *
 * @property int $id
 * @property int $customer_id
 * @property string|null $product_name
 * @property string|null $paying_date
 * @property float $product_price
 * @property float|null $real_price
 * @property int $currency_id
 * @property float|null $commission_percent
 * @property float|null $commission_fee
 * @property float|null $final_price
 * @property string|null $description this will fill by customer
 * @property string|null $link_url
 * @property string|null $file_path
 * @property string $current_status
 * @property string $last_edited_by
 * @property int|null $withdraw_id the related withdraw id if the op succeed
 * @property int|null $admin_id who process the order
 * @property string|null $admin_note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $admin
 * @property-read \App\Models\Currency $currency
 * @property-read \App\Models\Customer $customer
 * @property-read \App\Models\DepositOrder|null $depositOrder
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PayingOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PayingOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PayingOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PayingOrder whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PayingOrder whereAdminNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PayingOrder whereCommissionFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PayingOrder whereCommissionPercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PayingOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PayingOrder whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PayingOrder whereCurrentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PayingOrder whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PayingOrder whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PayingOrder whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PayingOrder whereFinalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PayingOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PayingOrder whereLastEditedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PayingOrder whereLinkUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PayingOrder wherePayingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PayingOrder whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PayingOrder whereProductPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PayingOrder whereRealPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PayingOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PayingOrder whereWithdrawId($value)
 */
	class PayingOrder extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProcedureType
 *
 * @property int $id
 * @property array $name
 * @property array $command_processing what the processing which admin must did when chose this type
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProcedureType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProcedureType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProcedureType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProcedureType whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProcedureType whereCommandProcessing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProcedureType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProcedureType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProcedureType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProcedureType whereUpdatedAt($value)
 */
	class ProcedureType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PullEarning
 *
 * @property int $id
 * @property int $customer_id
 * @property int $freelancing_platform_id
 * @property float $amount
 * @property int $currency_id
 * @property int $deposit_order_id when register order must have deposit order
 * @property string|null $admin_note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Currency $currency
 * @property-read \App\Models\Customer $customer
 * @property-read \App\Models\DepositOrder|null $depositOrder
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PullEarning newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PullEarning newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PullEarning query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PullEarning whereAdminNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PullEarning whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PullEarning whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PullEarning whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PullEarning whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PullEarning whereDepositOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PullEarning whereFreelancingPlatformId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PullEarning whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PullEarning whereUpdatedAt($value)
 */
	class PullEarning extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ReceivingAgenciesCountry
 *
 * @property int $id
 * @property int $country_id
 * @property int $transfer_agency_id
 * @property float|null $transfer_fee transfer percent will count over the amount of transferred money and must be less then 100
 * @property array|null $description explain how the fees counted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Country $country
 * @property-read array $translations
 * @property-read \App\Models\TransferAgency $transferAgency
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReceivingAgenciesCountry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReceivingAgenciesCountry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReceivingAgenciesCountry query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReceivingAgenciesCountry whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReceivingAgenciesCountry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReceivingAgenciesCountry whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReceivingAgenciesCountry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReceivingAgenciesCountry whereTransferAgencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReceivingAgenciesCountry whereTransferFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReceivingAgenciesCountry whereUpdatedAt($value)
 */
	class ReceivingAgenciesCountry extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Service
 *
 * @property int $id
 * @property array $name
 * @property array|null $short_description
 * @property array|null $description
 * @property array|null $instructions
 * @property int $parent_service_id
 * @property string $price_type
 * @property string|null $img_path
 * @property string|null $view_link
 * @property string|null $img_path_en
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $translations
 * @property-read \App\Models\ParentService $parentService
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service tradingServices()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereImgPathEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereInstructions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereParentServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service wherePriceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereViewLink($value)
 */
	class Service extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ServiceFeature
 *
 * @property int $id
 * @property int $parent_service_id
 * @property array $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $translations
 * @property-read \App\Models\ParentService $parentService
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceFeature newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceFeature newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceFeature query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceFeature whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceFeature whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceFeature whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceFeature whereParentServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceFeature whereUpdatedAt($value)
 */
	class ServiceFeature extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ServiceInstruction
 *
 * @property int $id
 * @property array $service_name
 * @property string $steps
 * @property array|null $instructions
 * @property string|null $img_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceInstruction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceInstruction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceInstruction query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceInstruction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceInstruction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceInstruction whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceInstruction whereInstructions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceInstruction whereServiceName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceInstruction whereSteps($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceInstruction whereUpdatedAt($value)
 */
	class ServiceInstruction extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ServicesPackage
 *
 * @property int $id
 * @property int $service_id
 * @property int $package_id
 * @property float $price
 * @property int $currency_id
 * @property float|null $discount
 * @property float $subscription_scores count scores which customer win when subscribe in service
 * @property float $operation_scores count the scores will gave to customer when use this service
 * @property int $orders_count count the orders that customer can reuse this services by this price for this services,if 0 then unlimited
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Currency $currency
 * @property-read \App\Models\Service $services
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServicesPackage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServicesPackage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServicesPackage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServicesPackage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServicesPackage whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServicesPackage whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServicesPackage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServicesPackage whereOperationScores($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServicesPackage whereOrdersCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServicesPackage wherePackageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServicesPackage wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServicesPackage whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServicesPackage whereSubscriptionScores($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServicesPackage whereUpdatedAt($value)
 */
	class ServicesPackage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SusbendedWithdrawOrder
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SusbendedWithdrawOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SusbendedWithdrawOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SusbendedWithdrawOrder query()
 */
	class SusbendedWithdrawOrder extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TeacherDetail
 *
 * @property int $id
 * @property int $customer_id
 * @property \Illuminate\Support\Carbon|null $last_certificate
 * @property string|null $classification
 * @property float $scores that has from university
 * @property string|null $skills
 * @property float $rating
 * @property \Illuminate\Support\Carbon $join_date
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CourseTraining[] $courses
 * @property-read int|null $courses_count
 * @property-read \App\Models\Customer $customer
 * @property-read mixed $teacher_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TeacherDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TeacherDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TeacherDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TeacherDetail whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TeacherDetail whereClassification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TeacherDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TeacherDetail whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TeacherDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TeacherDetail whereJoinDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TeacherDetail whereLastCertificate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TeacherDetail whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TeacherDetail whereScores($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TeacherDetail whereSkills($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TeacherDetail whereUpdatedAt($value)
 */
	class TeacherDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TradingAgency
 *
 * @property int $id
 * @property string $name
 * @property array|null $description
 * @property string|null $img_path
 * @property string|null $img_path_en
 * @property string|null $primary_email
 * @property string|null $secondary_mail
 * @property string|null $phone1
 * @property string|null $phone2
 * @property string|null $contact_info
 * @property string|null $email_from_yt_to
 * @property string|null $email_from_cust_to
 * @property string|null $agency_terms if there term in agency
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $translations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TradingService[] $services
 * @property-read int|null $services_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingAgency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingAgency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingAgency query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingAgency whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingAgency whereAgencyTerms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingAgency whereContactInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingAgency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingAgency whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingAgency whereEmailFromCustTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingAgency whereEmailFromYtTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingAgency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingAgency whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingAgency whereImgPathEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingAgency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingAgency wherePhone1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingAgency wherePhone2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingAgency wherePrimaryEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingAgency whereSecondaryMail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingAgency whereUpdatedAt($value)
 */
	class TradingAgency extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TradingAgencyService
 *
 * @property int $id
 * @property int $trading_service_id
 * @property int $trading_agency_id
 * @property int|null $loyalty_points
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TradingAgency $tradingAgency
 * @property-read \App\Models\TradingService $tradingService
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingAgencyService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingAgencyService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingAgencyService query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingAgencyService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingAgencyService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingAgencyService whereLoyaltyPoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingAgencyService whereTradingAgencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingAgencyService whereTradingServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingAgencyService whereUpdatedAt($value)
 */
	class TradingAgencyService extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TradingCustomerPoint
 *
 * @property int $id
 * @property int $customer_id
 * @property int|null $trading_service_id
 * @property int|null $trading_agency_id
 * @property string $operation_number
 * @property float $loyalty_points
 * @property float $dollar_equal
 * @property int $transferred
 * @property string $win_lose
 * @property string $transferred_date when convert to usd
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Customer $customer
 * @property-read \App\Models\TradingAgency|null $tradingAgency
 * @property-read \App\Models\TradingService|null $tradingService
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingCustomerPoint newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingCustomerPoint newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingCustomerPoint query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingCustomerPoint whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingCustomerPoint whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingCustomerPoint whereDollarEqual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingCustomerPoint whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingCustomerPoint whereLoyaltyPoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingCustomerPoint whereOperationNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingCustomerPoint whereTradingAgencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingCustomerPoint whereTradingServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingCustomerPoint whereTransferred($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingCustomerPoint whereTransferredDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingCustomerPoint whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingCustomerPoint whereWinLose($value)
 */
	class TradingCustomerPoint extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TradingService
 *
 * @property int $id
 * @property string $name
 * @property int|null $common_service_id
 * @property int|null $is_operational
 * @property string|null $description
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Service|null $commonService
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingService query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingService whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingService whereCommonServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingService whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingService whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingService whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingService whereIsOperational($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingService whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingService whereUpdatedAt($value)
 */
	class TradingService extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TradingServiceCustomer
 *
 * @property int $id
 * @property int $customer_id
 * @property int $trading_agency_id
 * @property string|null $customer_agency_number
 * @property string|null $customer_agency_email
 * @property string $subscription_status
 * @property string|null $status_change_reason
 * @property string|null $status_change_date
 * @property string|null $replay_code
 * @property string|null $agency_replay
 * @property string|null $admin_note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Customer $customer
 * @property-read \App\Models\TradingAgency $tradingAgency
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingServiceCustomer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingServiceCustomer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingServiceCustomer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingServiceCustomer whereAdminNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingServiceCustomer whereAgencyReplay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingServiceCustomer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingServiceCustomer whereCustomerAgencyEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingServiceCustomer whereCustomerAgencyNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingServiceCustomer whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingServiceCustomer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingServiceCustomer whereReplayCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingServiceCustomer whereStatusChangeDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingServiceCustomer whereStatusChangeReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingServiceCustomer whereSubscriptionStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingServiceCustomer whereTradingAgencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingServiceCustomer whereUpdatedAt($value)
 */
	class TradingServiceCustomer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TradingServicesOrder
 *
 * @property int $id
 * @property int $customer_id
 * @property int $trading_service_id
 * @property string $order_status
 * @property string|null $status_change_reason
 * @property string|null $status_change_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Customer $customer
 * @property-read \App\Models\TradingService $tradingService
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingServicesOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingServicesOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingServicesOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingServicesOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingServicesOrder whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingServicesOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingServicesOrder whereOrderStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingServicesOrder whereStatusChangeDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingServicesOrder whereStatusChangeReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingServicesOrder whereTradingServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TradingServicesOrder whereUpdatedAt($value)
 */
	class TradingServicesOrder extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TransferAgency
 *
 * @property int $id
 * @property array $agency_name
 * @property array|null $agency_desc
 * @property string|null $img_path
 * @property string $receive_method
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Country[] $countries
 * @property-read int|null $countries_count
 * @property-read array $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferAgency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferAgency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferAgency query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferAgency whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferAgency whereAgencyDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferAgency whereAgencyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferAgency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferAgency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferAgency whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferAgency whereReceiveMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferAgency whereUpdatedAt($value)
 */
	class TransferAgency extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TransferWithdrawOrder
 *
 * @property int $id
 * @property float $amount
 * @property int $currency_id
 * @property float $exchange_price the exchange price per USD in deposit moment
 * @property float $transfer_fee صافي رسوم التحويل التي ستضاف فوق المبلغ ويسحب من رصيد المحفظة عليه
 * @property float|null $fee_percent نسبة رسوم التحويل
 * @property float|null $transferred_amount
 * @property int|null $transferred_currency_id
 * @property int|null $customer_id
 * @property string|null $transfer_type depracted
 * @property string $receiving_mode
 * @property int|null $transfer_agency_country_id
 * @property string $current_status
 * @property string|null $status_note when rejected or when still pending
 * @property \Illuminate\Support\Carbon|null $status_changed_date
 * @property string|null $detail_statement
 * @property int|null $admin_id who confirmed this op
 * @property string|null $img_path
 * @property string|null $reference_id_type
 * @property string|null $receiver_name
 * @property string|null $receiver_acc_number
 * @property string|null $receiver_phone
 * @property string|null $receiver_email
 * @property string|null $receiver_address
 * @property string|null $receiver_other_info
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DepositWithdrawProcess|null $DepositWithdrawProcess
 * @property-read \App\Models\ReceivingAgenciesCountry|null $agencyCountry
 * @property-read \App\Models\Currency $currency
 * @property-read \App\Models\Customer|null $customer
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferWithdrawOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferWithdrawOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferWithdrawOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferWithdrawOrder whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferWithdrawOrder whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferWithdrawOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferWithdrawOrder whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferWithdrawOrder whereCurrentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferWithdrawOrder whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferWithdrawOrder whereDetailStatement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferWithdrawOrder whereExchangePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferWithdrawOrder whereFeePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferWithdrawOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferWithdrawOrder whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferWithdrawOrder whereReceiverAccNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferWithdrawOrder whereReceiverAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferWithdrawOrder whereReceiverEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferWithdrawOrder whereReceiverName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferWithdrawOrder whereReceiverOtherInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferWithdrawOrder whereReceiverPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferWithdrawOrder whereReceivingMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferWithdrawOrder whereReferenceIdType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferWithdrawOrder whereStatusChangedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferWithdrawOrder whereStatusNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferWithdrawOrder whereTransferAgencyCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferWithdrawOrder whereTransferFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferWithdrawOrder whereTransferType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferWithdrawOrder whereTransferredAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferWithdrawOrder whereTransferredCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransferWithdrawOrder whereUpdatedAt($value)
 */
	class TransferWithdrawOrder extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WithdrawAgency
 *
 * @property int $id
 * @property array $name
 * @property int|null $deposit_method_id
 * @property string $national
 * @property int|null $is_withdraw_agency
 * @property array|null $description
 * @property string|null $img_path
 * @property string|null $address
 * @property string|null $phone
 * @property int $active
 * @property string|null $ytadawul_account_number
 * @property string|null $ytadawul_account_name
 * @property float $deposit_fee_percent
 * @property float $fixed_charge_deposit when deposit maybe want to put charge as fixed amount
 * @property float $withdraw_fee_percent
 * @property float $fixed_charge_withdraw when withdraw maybe want to put charge as fixed amount
 * @property float $min_deposit_amount
 * @property float $max_deposit_amount
 * @property float $min_withdraw_amount
 * @property float $max_withdraw_amount
 * @property string|null $deposit_instructions
 * @property string|null $withdraw_instructions
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Country[] $countries
 * @property-read int|null $countries_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CustomerFinanceAccount[] $customersFinanceAccounts
 * @property-read int|null $customers_finance_accounts_count
 * @property-read \App\Models\DepositMethod|null $depositMethod
 * @property-read array $translations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawAgency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawAgency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawAgency query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawAgency whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawAgency whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawAgency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawAgency whereDepositFeePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawAgency whereDepositInstructions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawAgency whereDepositMethodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawAgency whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawAgency whereFixedChargeDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawAgency whereFixedChargeWithdraw($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawAgency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawAgency whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawAgency whereIsWithdrawAgency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawAgency whereMaxDepositAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawAgency whereMaxWithdrawAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawAgency whereMinDepositAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawAgency whereMinWithdrawAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawAgency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawAgency whereNational($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawAgency wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawAgency whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawAgency whereWithdrawFeePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawAgency whereWithdrawInstructions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawAgency whereYtadawulAccountName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawAgency whereYtadawulAccountNumber($value)
 */
	class WithdrawAgency extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WithdrawOrder
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $deposit_date
 * @property string $op_type is deposit or withdrawals
 * @property string|null $op_code
 * @property string $order_type this col to know the deposit type not ..
 * @property float $amount
 * @property int $currency_id
 * @property float $client_amount the amount that must paied from client
 * @property int|null $cl_amount_curr_id
 * @property float $exchange_price the exchange price per USD in deposit moment
 * @property float $fee_percent
 * @property float $fee_amount
 * @property float $final_amount
 * @property int|null $customer_id
 * @property string $deposit_type
 * @property int|null $agency_id
 * @property int|null $deposit_agency_country_id
 * @property string|null $customer_finance_account
 * @property string $current_status
 * @property string|null $status_note when rejected or when still pending
 * @property \Illuminate\Support\Carbon|null $status_changed_date
 * @property int|null $confirmed_code DEPRECATED the voucher id in transaction head or the deposit_id in wallet
 * @property string|null $detail_statement
 * @property int|null $admin_id who confirmed this op
 * @property string|null $img_path
 * @property string|null $reference_id will be filled by customer and reviewed by admin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DepositWithdrawProcess|null $DepositWithdrawProcess
 * @property-read \App\Models\DepositAgency|null $agency
 * @property-read \App\Models\DepositAgencyCountry|null $agencyCountry
 * @property-read \App\Models\Currency $currency
 * @property-read \App\Models\Currency $currencyClient
 * @property-read \App\Models\Customer|null $customer
 * @property-read \App\Models\FreelancingPlatform|null $freelance
 * @property-read mixed $current_status_ar
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrder whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrder whereAgencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrder whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrder whereClAmountCurrId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrder whereClientAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrder whereConfirmedCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrder whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrder whereCurrentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrder whereCustomerFinanceAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrder whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrder whereDepositAgencyCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrder whereDepositDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrder whereDepositType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrder whereDetailStatement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrder whereExchangePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrder whereFeeAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrder whereFeePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrder whereFinalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrder whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrder whereOpCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrder whereOpType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrder whereOrderType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrder whereReferenceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrder whereStatusChangedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrder whereStatusNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrder whereUpdatedAt($value)
 */
	class WithdrawOrder extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WithdrawOrderCompleted
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $deposit_date
 * @property string $op_type is deposit or withdrawals
 * @property string|null $op_code
 * @property string $order_type this col to know the deposit type not ..
 * @property float $amount
 * @property int $currency_id
 * @property float $client_amount the amount that must paied from client
 * @property int|null $cl_amount_curr_id
 * @property float $exchange_price the exchange price per USD in deposit moment
 * @property float $fee_percent
 * @property float $fee_amount
 * @property float $final_amount
 * @property int|null $customer_id
 * @property string $deposit_type
 * @property int|null $agency_id
 * @property int|null $deposit_agency_country_id
 * @property string|null $customer_finance_account
 * @property string $current_status
 * @property string|null $status_note when rejected or when still pending
 * @property \Illuminate\Support\Carbon|null $status_changed_date
 * @property int|null $confirmed_code DEPRECATED the voucher id in transaction head or the deposit_id in wallet
 * @property string|null $detail_statement
 * @property int|null $admin_id who confirmed this op
 * @property string|null $img_path
 * @property string|null $reference_id will be filled by customer and reviewed by admin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DepositWithdrawProcess|null $DepositWithdrawProcess
 * @property-read \App\Models\DepositAgency|null $agency
 * @property-read \App\Models\DepositAgencyCountry|null $agencyCountry
 * @property-read \App\Models\Currency $currency
 * @property-read \App\Models\Currency $currencyClient
 * @property-read \App\Models\Customer|null $customer
 * @property-read \App\Models\FreelancingPlatform|null $freelance
 * @property-read mixed $current_status_ar
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderCompleted newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderCompleted newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderCompleted query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderCompleted whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderCompleted whereAgencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderCompleted whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderCompleted whereClAmountCurrId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderCompleted whereClientAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderCompleted whereConfirmedCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderCompleted whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderCompleted whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderCompleted whereCurrentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderCompleted whereCustomerFinanceAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderCompleted whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderCompleted whereDepositAgencyCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderCompleted whereDepositDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderCompleted whereDepositType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderCompleted whereDetailStatement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderCompleted whereExchangePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderCompleted whereFeeAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderCompleted whereFeePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderCompleted whereFinalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderCompleted whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderCompleted whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderCompleted whereOpCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderCompleted whereOpType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderCompleted whereOrderType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderCompleted whereReferenceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderCompleted whereStatusChangedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderCompleted whereStatusNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderCompleted whereUpdatedAt($value)
 */
	class WithdrawOrderCompleted extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WithdrawOrderRejected
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $deposit_date
 * @property string $op_type is deposit or withdrawals
 * @property string|null $op_code
 * @property string $order_type this col to know the deposit type not ..
 * @property float $amount
 * @property int $currency_id
 * @property float $client_amount the amount that must paied from client
 * @property int|null $cl_amount_curr_id
 * @property float $exchange_price the exchange price per USD in deposit moment
 * @property float $fee_percent
 * @property float $fee_amount
 * @property float $final_amount
 * @property int|null $customer_id
 * @property string $deposit_type
 * @property int|null $agency_id
 * @property int|null $deposit_agency_country_id
 * @property string|null $customer_finance_account
 * @property string $current_status
 * @property string|null $status_note when rejected or when still pending
 * @property \Illuminate\Support\Carbon|null $status_changed_date
 * @property int|null $confirmed_code DEPRECATED the voucher id in transaction head or the deposit_id in wallet
 * @property string|null $detail_statement
 * @property int|null $admin_id who confirmed this op
 * @property string|null $img_path
 * @property string|null $reference_id will be filled by customer and reviewed by admin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DepositWithdrawProcess|null $DepositWithdrawProcess
 * @property-read \App\Models\DepositAgency|null $agency
 * @property-read \App\Models\DepositAgencyCountry|null $agencyCountry
 * @property-read \App\Models\Currency $currency
 * @property-read \App\Models\Currency $currencyClient
 * @property-read \App\Models\Customer|null $customer
 * @property-read \App\Models\FreelancingPlatform|null $freelance
 * @property-read mixed $current_status_ar
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderRejected newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderRejected newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderRejected query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderRejected whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderRejected whereAgencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderRejected whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderRejected whereClAmountCurrId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderRejected whereClientAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderRejected whereConfirmedCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderRejected whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderRejected whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderRejected whereCurrentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderRejected whereCustomerFinanceAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderRejected whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderRejected whereDepositAgencyCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderRejected whereDepositDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderRejected whereDepositType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderRejected whereDetailStatement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderRejected whereExchangePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderRejected whereFeeAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderRejected whereFeePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderRejected whereFinalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderRejected whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderRejected whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderRejected whereOpCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderRejected whereOpType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderRejected whereOrderType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderRejected whereReferenceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderRejected whereStatusChangedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderRejected whereStatusNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderRejected whereUpdatedAt($value)
 */
	class WithdrawOrderRejected extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WithdrawOrderSuspended
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $deposit_date
 * @property string $op_type is deposit or withdrawals
 * @property string|null $op_code
 * @property string $order_type this col to know the deposit type not ..
 * @property float $amount
 * @property int $currency_id
 * @property float $client_amount the amount that must paied from client
 * @property int|null $cl_amount_curr_id
 * @property float $exchange_price the exchange price per USD in deposit moment
 * @property float $fee_percent
 * @property float $fee_amount
 * @property float $final_amount
 * @property int|null $customer_id
 * @property string $deposit_type
 * @property int|null $agency_id
 * @property int|null $deposit_agency_country_id
 * @property string|null $customer_finance_account
 * @property string $current_status
 * @property string|null $status_note when rejected or when still pending
 * @property \Illuminate\Support\Carbon|null $status_changed_date
 * @property int|null $confirmed_code DEPRECATED the voucher id in transaction head or the deposit_id in wallet
 * @property string|null $detail_statement
 * @property int|null $admin_id who confirmed this op
 * @property string|null $img_path
 * @property string|null $reference_id will be filled by customer and reviewed by admin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DepositWithdrawProcess|null $DepositWithdrawProcess
 * @property-read \App\Models\DepositAgency|null $agency
 * @property-read \App\Models\DepositAgencyCountry|null $agencyCountry
 * @property-read \App\Models\Currency $currency
 * @property-read \App\Models\Currency $currencyClient
 * @property-read \App\Models\Customer|null $customer
 * @property-read \App\Models\FreelancingPlatform|null $freelance
 * @property-read mixed $current_status_ar
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BaseModel limitOrder($limit, $last_id)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderSuspended newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderSuspended newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderSuspended query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderSuspended whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderSuspended whereAgencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderSuspended whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderSuspended whereClAmountCurrId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderSuspended whereClientAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderSuspended whereConfirmedCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderSuspended whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderSuspended whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderSuspended whereCurrentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderSuspended whereCustomerFinanceAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderSuspended whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderSuspended whereDepositAgencyCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderSuspended whereDepositDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderSuspended whereDepositType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderSuspended whereDetailStatement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderSuspended whereExchangePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderSuspended whereFeeAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderSuspended whereFeePercent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderSuspended whereFinalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderSuspended whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderSuspended whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderSuspended whereOpCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderSuspended whereOpType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderSuspended whereOrderType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderSuspended whereReferenceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderSuspended whereStatusChangedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderSuspended whereStatusNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WithdrawOrderSuspended whereUpdatedAt($value)
 */
	class WithdrawOrderSuspended extends \Eloquent {}
}

