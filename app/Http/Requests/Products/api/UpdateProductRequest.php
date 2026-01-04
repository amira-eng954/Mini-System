<?php

namespace App\Http\Requests\Products\api;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        $id=$this->route('product');
        return [
            //

            'name'=>"required|string",
            'sku'=>"required|string|unique:products,sku," .$id ,
            'price'=>"required",
            'qty'=>"required|integer",
            'status'=>"required|in:active,inactive",
        ];
    }

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
