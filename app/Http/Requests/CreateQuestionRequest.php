<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateQuestionRequest extends FormRequest
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
                'type' => ['required', 'string'],
                'title' => ['required', 'string', 'min:0',],
                'options' => ['required', 'array', 'min:0'],
                'mcq_ans_index' => ['numeric', 'min:0'],
                'mark' => ['required', 'string'],
                'course_id' => ['numeric'],
                'user_id' => ['numeric'],
        ];
    }
}
