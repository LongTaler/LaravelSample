<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePokemonRequest extends FormRequest
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
            'pokemon' => 'required|string|max:255', // pokemonは必須で、文字列、最大255文字
            'pokemonDictionary' => 'required|integer', // pokemonDictionaryは必須で、整数であること
        ];
    }
        /**
     * Get custom validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'pokemon.required' => 'Pokemon name is required.',
            'pokemon.string' => 'Pokemon name must be a string.',
            'pokemon.max' => 'Pokemon name cannot exceed 255 characters.',
            'pokemonDictionary.required' => 'Pokemon dictionary ID is required.',
            'pokemonDictionary.integer' => 'Pokemon dictionary ID must be an integer.',
        ];
    }
 
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422)
        );
    }


}
