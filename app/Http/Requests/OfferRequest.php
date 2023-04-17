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
         "name_ar"=> "required|max:100|unique:offers,name_ar",
         "name_en"=> "required|max:100|unique:offers,name_en",
          "price" => "required|numeric|max:1000",
          "details_ar"=>"required",
          "details_en"=>"required",

        ];
    }
    public function messages()
    {
        return [
         "name_ar.required" => __("messages.Arabic Offer name is  Required"),
         "name_en.required" => __("messages.Offer name is  Required"),
          "price.required" => __("messages.Offer price is  Required"),
          "name_ar.unique" => __("messages.Offer name must be unique"),
          "name_en.unique" => __("messages.Arabic Offer name must be unique"),
          "price.numeric" => __("messages.Price offer must be Number"),
          "details_ar.required" => __("messages.Arabic Offer details are  Required"),
          "details_en.required" => __("messages.Offer details are  Required"),

        ];
    }
}
