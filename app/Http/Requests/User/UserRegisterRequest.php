<?php

namespace App\Http\Requests\User;

use App\DataTransferObjects\User\RegisterDto;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\DtoRequestContract;

class UserRegisterRequest extends FormRequest implements DtoRequestContract
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
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
        ];
    }

    /**
     * @return RegisterDto
     */
    public function toDto(): RegisterDto
    {
        return new RegisterDto(
            $this->input('name'),
            $this->input('email'),
            $this->input('password'),
        );
    }
}
