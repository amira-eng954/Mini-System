<?php
namespace App\Http\Requests\Products\api;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            //
            
            'name'=>"required|string",
            'sku'=>"required|string|unique:products,sku",
            'price'=>"required",
            'qty'=>"required|integer",
            'status'=>"required|in:active,inactive",
        ];
    }

        //public function 
        
    protected function failedValidation(Validator $validator)
{
    throw new HttpResponseException(
        response()->json([
            'status' => false,
            'message' => $validator->errors()->first()
        ], 422)
    );
}


    }

