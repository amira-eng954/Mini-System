<?php
namespace App\Http\Requests\Products\web;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule ;

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
            //'sku'=>"required|string|unique:products,sku,".$this->product,
            'sku'=>[
                'required',
                'string',
               Rule::unique("products",'sku')->ignore($this->product)
            ],
            'price'=>"required",
            'qty'=>"required|integer",
            'status'=>"required|in:active,inactive",
        ];
    }

        //public function 
        
 


    }

