<?php

namespace TreeDepo\Account\Requests\Account;

use Bi\Users\Enums\AccountTypeEnum;
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
        $enum = config('bi-users.account.types') ?? AccountTypeEnum::class;

        if (my_is_enum($enum)) {
            $enum = $enum::toArray();
        }

        return [
            'type'      => ['required', Rule::in($enum)],
            'uuid'      => ['uuid'],
            'username'  => ['string'],
            'full_name' => ['string'],
            'active'    => ['bool'],
        ];
    }
}
