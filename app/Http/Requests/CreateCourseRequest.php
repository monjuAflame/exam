<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCourseRequest extends FormRequest
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
            'code' => ['string', 'nullable', 'max:20',],
            'fee' => ['required', 'numeric', 'min:0'],
            'course_category_id' => ['required', 'numeric', 'exists:course_categories,id'],
            'duration_in_weeks' => ['numeric', 'nullable', 'min:1'],
            'total_class' => ['numeric', 'nullable', 'min:1'],
            'total_exam' => ['numeric', 'nullable', 'min:1'],
        ];
    }
}
