<?php

namespace App\Http\Requests;

use Illuminate\Routing\Route;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CustomerOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Route $route){
        $routeMethod = $route->getActionName();
        $rules       = [];
        if (Str::contains($routeMethod,"courseOrder")

        ) {
            $rules = [
                'course_id' => ['required','numeric','min:1'],
            ];
        }
        if (Str::contains($routeMethod,"consultantOrder")

        ) {
            $rules = [
                'consultant_id' => ['required','numeric','min:1'],
            ];
        }
        if (Str::contains($routeMethod,"checkoutConsultant")

        ) {
            $rules = [
                'consultant_order_id' => ['required','numeric','min:1'],
            ];
        }

        return $rules;
    }
}
