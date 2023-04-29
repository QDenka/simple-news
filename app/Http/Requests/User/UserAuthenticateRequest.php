<?php

namespace App\Http\Requests\User;

use App\DataTransferObjects\User\AuthenticateDto;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\DtoRequestContract;

class UserAuthenticateRequest extends FormRequest implements DtoRequestContract
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
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:6'],
        ];
    }

    /**
     * @return AuthenticateDto
     */
    public function toDto(): AuthenticateDto
    {
        return new AuthenticateDto(
            $this->input('email'),
            $this->input('password'),
        );
    }
}
