<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return true;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => ['nullable','image','max:10000'],
            'first_name' => ['required','max:255','string'],
            'last_name' => ['required','max:255','string'],
            'email' => ['required','email'],
            'phone' => ['required','string','max:20'],
            'bank_acc' => ['required','numeric'],
            'about' => ['nullable' , 'string' , 'max:500']
        ];
    }
}
