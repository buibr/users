<?php

namespace Bi\Users\Requests\Account;

use Illuminate\Validation\Rule;
use Bi\Users\Enums\AccountTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class StoreAccountRequest extends FormRequest
{
    public function rules(): array
    {
        $enum = config('bi-users.account.types') ?? AccountTypeEnum::class;

        if (my_is_enum($enum)) {
            $enum = $enum::toArray();
        }

        return [
            'type'      => ['required', Rule::in($enum)],
            'uuid'      => ['uuid'],
            'username'  => ['required', 'string'],
            'full_name' => ['string'],
            'active'    => ['bool'],
        ];
    }
}
