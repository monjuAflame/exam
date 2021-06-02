<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBatchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && auth()->user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:40',],
            'course_id' => ['required', 'numeric', 'exists:courses,id'],
            'id_prefix' => ['required', 'string', 'min:1'],
            'days' => ['string', 'nullable', 'max:50'],
            'start_time' => ['string', 'nullable', 'regex:/(\d{2}):(\d{2})(AM|PM)/'],
            'end_time' => ['string', 'nullable', 'regex:/(\d{2}):(\d{2})(AM|PM)/'],
        ];
    }
}
