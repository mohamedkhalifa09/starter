<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
         "name"=> "required|max:100|unique:offers,name",
          "price" => "required|numeric|max:1000",
          "details"=>"required",
        ];
    }
    public function messages()
    {
        return [
         "name.required" => __("messages.Offer name is  Required"),
          "price.required" => __("messages.Offer price is  Required"),
          "name.unique" => __("messages.Offer name must be unique"),
          "price.numeric" => __("messages.Price offer must be Number"),
          "details.required" => __("messages.Offer details are  Required"),
        ];
    }
}
