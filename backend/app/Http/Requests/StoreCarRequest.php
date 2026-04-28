<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCarRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'make_id' => 'required|exists:car_makes,id',
            'model_id' => 'required|exists:car_models,id',
            'fuel_type_id' => 'required|exists:fuel_types,id',
            'body_type_id' => 'required|exists:body_types,id',
            'transmission_id' => 'required|exists:transmissions,id',
            'title' => 'required|string|min:3',
            'year' => 'required|integer|min:1950|max:' . now()->year,
            'price' => 'required|integer|gt:0',
            'mileage' => 'required|integer|gt:0',
            'engine_size' => 'nullable|numeric|between:0.8,8.0',
            'horsepower' => 'nullable|integer',
            'color' => 'nullable|string|min:3',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            //'status' => 'required|in:active,draft,sold',
        ];
    }

    public function messages(): array
    {
        return [
            'make_id.required' => 'Please choose the correspondent car make!',
            'model_id.required' => 'Please choose the correspondent model!',
            'fuel_type_id.required' => 'Please choose the correspondent fuel type!',
            'body_type_id.required' => 'Please choose the correspondent body type!',
            'transmission_id.required' => 'Please choose the correspondent transmission!',
            'title.required' => 'The car title is mandatory',
            'year.required' => 'The year is mandatory!',
            'price.required' => 'The price is mandatory!',
            'mileage.required' => 'The mileage is mandatory!',
            'slug.required' => 'The slug is mandatory!',
            'status.required' => 'The status of your car is mandatory!',     
        ];
          
    }
}
