<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientStoreFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'nullable',
            'name' => 'required',
            'cnpj' => 'required|cnpj|unique:clients,cnpj',
            'responsible_name' => 'required',
            'cell_phone' => 'required',
            'email' => 'required|email',
            'zip_code' => 'required',
            'address' => 'required',
            'number' => 'nullable',
            'complement' => 'nullable',
            'neighborhood' => 'required',
            'city' => 'required',
            'state' => 'required|uf',
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('Corporate Name'),
            'cnpj' => __('Cnpj'),
            'responsible_name' => __('Responsible Name'),
            'cell_phone' => __('Cell Phone'),
            'email' => __('Email'),
            'zip_code' => __('Zip Code'),
            'address' => __('Address'),
            'number' => __('Number'),
            'complement' => __('Complement'),
            'neighborhood' => __('Neighborhood'),
            'city' => __('City'),
            'state' => __('State'),
        ];
    }
}
