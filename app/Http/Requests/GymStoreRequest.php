<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GymStoreRequest extends FormRequest
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
        // dd('test');
        return [
            'gym_name'       => ['bail', 'required', 'string', 'max: 64'],
            "gym_zipcode"    => ['bail', 'required', 'numeric', 'digits:7'],
            "gym_prefecture" => ['bail', 'required', 'string', 'max: 64'],
            "gym_city"       => ['bail', 'required', 'string', 'max: 64'],
            "gym_street"     => ['bail', 'required', 'string', 'max: 64'],
            "gym_building"   => ['bail', 'nullable', 'string', 'max: 64'],
            "gym_tel"        => ['bail', 'nullable', 'string', 'max: 100'],
            'gym_image'      => ['image','max:5000','mimes:jpeg,bmp,png'], // 画像容量5MB
            "gym_facility"   => [''],
            "mon_opening"    => [''],
            "mon_close"      => ['nullable', 'after:mon_opening'],
            // "tue_opening"    => [''],
            "tue_close"      => ['nullable', 'after:tue_opening'],
            // "wed_opening"    => [''],
            "wed_close"      => ['nullable', 'after:wed_opening'],
            // "thu_opening"    => [''],
            "thu_close"      => ['nullable', 'after:thu_opening'],
            // "fri_opening"    => [''],
            "fri_close"      => ['nullable', 'after:fri_opening'],
            // "sat_opening"    => [''],
            "sat_close"      => ['nullable', 'after:sat_opening'],
            // "sun_opening"    => [''],
            "sun_close"      => ['nullable', 'after:sun_opening'],
        ];
    }

    public function messages()
    {
        return [
            
        ];
    }
}
