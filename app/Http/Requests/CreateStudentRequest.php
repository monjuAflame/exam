<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateStudentRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:60',],
            'last_name' => ['string', 'nullable', 'max:60',],
            'gender' => ['required', 'string', 'in:male,female',],
            'email' => ['required', 'string', 'email', 'max:150', 'unique:users',],
            'phone' => ['required', 'string', 'unique:users', 'regex:/^(8801|\+8801|01)[3-9]{1,1}[0-9]{8,8}$/',],
            'password' => ['required', 'string', 'min:6', 'confirmed',],            
            'guardian_name' => ['string', 'nullable', 'max:60',],
            'guardian_phone' => ['string', "nullable", 'regex:/^(8801|\+8801|01)[3-9]{1,1}[0-9]{8,8}$/',],
            'address' => ['string', 'nullable', 'max:150',],

            'course_id' => ['required', 'exists:courses,id'],
            'batch_id' => ['required', 'exists:batches,id'],
            'session' => ['required', 'string', 'nullable', 'max:30',],
            'admission_id' => ['required', 'string', 'in:monthly,admission',],

            'ssc_academic_name' => ['string', 'nullable', 'max:150',],
            'ssc_board' => ['string', 'nullable', 'max:30',],
            'ssc_group' => ['string', 'nullable', 'max:30',],
            'ssc_passing_year' => ['string', 'nullable', 'max:30',],
            'ssc_gpa' => ['string', 'nullable', 'numeric', 'max:30',],
            'ssc_roll' => ['string', 'nullable', 'max:30',],
            'hsc_academic_name' => ['string', 'nullable', 'max:150',],
            'hsc_board' => ['string', 'nullable', 'max:30',],
            'hsc_group' => ['string', 'nullable', 'max:30',],
            'hsc_passing_year' => ['string', 'nullable', 'max:30',],
            'hsc_gpa' => ['string', 'nullable', 'numeric', 'max:30',],
            'hsc_roll' => ['string', 'nullable', 'max:30',],
        ];
    }
}
