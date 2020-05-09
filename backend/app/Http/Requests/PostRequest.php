<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PostRequest
 * @package App\Http\Requests
 */
class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array|string[]
     */
    public function rules(): array
    {
        return [
            "user_id" => "required|integer",
            "title" => "required|string|unique:posts",
            "text" => "present|string",
        ];
    }

    /**
     * Retrieve the massages for validation rules that apply to the request.
     *
     * @return array|string[]
     */
    public function messages(): array
    {
        return [
            "title.required" => "Введите название вашей статьи",
            "title.unique:posts" => "Уже существует статья с таким названием"
        ];
    }
}
