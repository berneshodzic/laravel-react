<?php

namespace App\Containers\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertContainerRequest extends FormRequest
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
            'name' => 'required|string|unique:containers',
            'active' => 'required|boolean',
            'tag' => 'required|string',
        ];
    }
}
