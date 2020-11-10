<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketContactRequest extends FormRequest
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
        return [
            'reason'  => 'required|max:200',
        ];
    }

    public function messages()
    {
        return [
            'reason.required' => 'お問い合わせ内容は必ず記入してください。',
        ];
    }
}
