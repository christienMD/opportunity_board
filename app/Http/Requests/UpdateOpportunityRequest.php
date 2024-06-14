<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOpportunityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $opportunity = $this->route('opportunity');
        return $opportunity && auth()->user()->can('update', $opportunity);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'min:6'],
            'category' => ['sometimes', 'string', 'in:job,internship,volunteer'],
            'description' => ['sometimes', 'min:60'],
            'img_upload' => ['sometimes', 'string'],
        ];
    }
}
