<?php


namespace App\Http\Controllers\Traits;


use App\Helpers\APPIPData;
use App\Http\Resources\ServiceInstructionResource;
use App\Models\Country;
use App\Models\Currency;
use App\Models\ServiceInstruction;

trait CommonTrait
{
    public static function getActiveCountries() {
        return Country::whereActive(1)->get();
    }

    public static function getCurrencies() {
        return Currency::where("active", 1)->get();
    }

    public static function getServiceInstructions($service_id = null) {
        if (empty($service_id)) {
            $instruction = ServiceInstruction::all();
            if (isFromApi()) {
                $instruction = ServiceInstructionResource::collection($instruction);
            }
        } else {
            $instruction = ServiceInstruction::where('id', $service_id)->get();
            /*// if (isFromApi()) {
                 $instruction = new ServiceInstructionResource($instruction);
             //}*/
        }
        $instruction = ServiceInstructionResource::collection($instruction);

        return $instruction;
    }

    /**
     * لارجاع أعلى كورسات مشاهدة لدى الطلاب
     * @return array
     */
    public static function getPoplarCourses(): array {
        return [];
    }

    /**
     * لارجاع أعلى كورس شعبية لكل فئة - واحد من كل فئة
     * @return array
     */
    public static function getMostCoursesByAll(): array {
        return [];
    }

    public static function createImageFromFile($request, $name = "fileup", $order_type = 'deposits') {
        $file = $request->file($name);
        if (!$file) {
            return null;
        }
        $file       = $request->$name;
        $folderPath = "storage/".$order_type.'/';
        $file_name  = $folderPath.uniqid('', false).'.'.$file->extension();
        $moved      = $file->move(public_path('storage/'.$order_type), $file_name);

        return $file_name;
    }

    public static function getCountryIDFromIP() {
        $ip_data = APPIPdata::get();
        if ($ip_data) {
            $countryInfo = Country::where('code', $ip_data->country_code)->first();
            if ($countryInfo) {
                return $countryInfo->id;
            }

            return null;
        }

        return null;
    }

    public static function getUserCountryId() {
        $countryId  = self::getCountryIDFromIP();
        $country_id = $countryId != null
            ? $countryId
            : ((auth()->user()->country_code)
                ? auth()->user()->country_code
                : \config('ytadawul.country_id'));//YEMEN 247
        return $country_id ?? 247;
    }
}
