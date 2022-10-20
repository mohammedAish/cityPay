<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;
use Illuminate\Support\Str;

class PayingOrderClintRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Route $route)
    {
        $rules       = [];
        $routeMethod = $route->getActionName();

        //when create order
        if (Str::contains($routeMethod, "confirmPayingOrder")) {

            $rules = [
                'product_name'  => 'required',
                'link_url'      => 'required',
                'product_price' => 'required|numeric',
                'paying_date'   => 'required|date',
            ];

        }
        if (Str::contains($routeMethod, "confirmAndWithdraw")) {
            $rules = [
                'paying_order_id' => 'required|exists:paying_orders,id',
            ];
        }

        return $rules;


    }
}
