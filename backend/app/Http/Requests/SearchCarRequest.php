<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SearchCarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'make_id' => 'nullable|exists:car_makes,id',
            'model_id' => 'nullable|exists:car_models,id',

            'fuel_type_id' => 'nullable|exists:fuel_types,id',
            'body_type_id' => 'nullable|exists:body_types,id',
            'transmission_id' => 'nullable|exists:transmissions,id',

            'price_min' => 'nullable|integer|min:0',
            'price_max' => 'nullable|integer|min:0',

            'year_min' => 'nullable|integer|min:1950|max:' . now()->year,
            'year_max' => 'nullable|integer|min:1950|max:' . now()->year,

            'mileage_max' => 'nullable|integer|min:0',

            'sort_by' => 'nullable|in:price,year,mileage,created_at',
            'sort_dir' => 'nullable|in:asc,desc',
        ];
    }
}
