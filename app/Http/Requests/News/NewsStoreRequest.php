<?php

namespace App\Http\Requests\News;

use App\DataTransferObjects\News\NewsDto;
use App\Http\Requests\DtoRequestContract;
use Illuminate\Foundation\Http\FormRequest;

class NewsStoreRequest extends FormRequest implements DtoRequestContract
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
            'title' => ['required', 'string'],
            'content' => ['required', 'string'],
            'category_ids' => ['required', 'array'],
            'category_ids.*' => ['required', 'integer', 'exists:categories,id'],
        ];
    }

    /**
     * @return NewsDto
     */
    public function toDto(): NewsDto
    {
        return new NewsDto(
            $this->input('title'),
            $this->input('content'),
            $this->input('category_ids')
        );
    }
}
