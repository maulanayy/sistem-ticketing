<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('post')) {
            return $this->createRules();
        } elseif ($this->isMethod('put')) {
            return $this->updateRules();
        }
    }

    /**
     * Define validation rules to store method for resource creation
     *
     * @return array
     */
    public function createRules(): array
    {
        return [
            'name' => 'required|string|max:191',
            'ticket' => 'required|numeric|max:191',
            'type' => 'required|string|max:50',
            'amount' => 'required|numeric',
            'harga_ticket' => 'required|numeric' 
        ];
    }

    /**
     * Define validation rules to update method for resource update
     *
     * @return array
     */
    public function updateRules(): array
    {
        return [
            'name' => 'required|string|max:191',
            'ticket' => 'required|numeric|max:191',
            'type' => 'required|string|max:50',
            'amount' => 'required|numeric',
            'harga_ticket' => 'required|numeric'
        ];
    }
}
