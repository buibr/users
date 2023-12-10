<?php

namespace TreeDepo\Account\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use TreeDepo\Account\Enums\AccountTypeEnum;

class StoreAccountRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'type'      => ['required', Rule::in(AccountTypeEnum::toArray())],
            'uuid'      => ['uuid'],
            'username'  => ['required', 'string'],
            'full_name' => ['string'],
            'active'    => ['bool'],
        ];
    }
}
