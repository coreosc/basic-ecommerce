<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class DeliveryAddress extends FormRequest
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
    public function rules()
    {
        //@TODO: walidacja poprawna
        return [
            'first_name'    => 'required',
            'last_name'     => 'required',
            'street'        => 'required',
            'street_number' => 'required',
            'flat_number'   => '',
            'post_code'     => 'required',
            'city'          => 'required',
            'phone'         => 'required',
        ];
    }

    public function response(array $errors)
    {
        if ($this->is('vue/*')) {
            return response()->json($errors);
        }

        return parent::response($errors);
    }

}
