<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateExamRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:80',],
            'duration' => ['required', 'numeric', 'min:0',],
            'course_id' => ['required', 'numeric', 'exists:courses,id',],
            'passing_score' => ['required', 'numeric', 'min:0', 'max:100',],
            'intro_text' => ['string', 'nullable', 'max:80',],
            'conclusion_text' => ['string', 'nullable', 'max:80',],
            'pass_message' => ['string', 'nullable', 'max:80',],
            'fail_message' => ['string', 'nullable', 'max:80',],
        ];
    }
}
