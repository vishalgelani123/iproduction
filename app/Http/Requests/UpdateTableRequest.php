<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTableRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'table_name' => 'required|string|max:100',
            'floor_id' => 'required|exists:production_floors,id',
            'number_of_seats' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ];
    }
}
