<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitApplicationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'message' => 'required|string',
            // 'cv_upload' => 'required|file|mimes:pdf|max:1014',
            'opportunity_id' => 'required|exists:opportunities,id',
            'user_id' => 'nullable|exists:users,id'
        ];
    }
}
