<?php

namespace TreeDepo\Account\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'type'      => ['string'],
            'uuid'      => ['uuid'],
            'username'  => ['string'],
            'full_name' => ['string'],
            'active'    => ['bool'],
        ];
    }
}
