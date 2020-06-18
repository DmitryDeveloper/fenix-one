<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CategoryRequest
 * @package App\Http\Requests
 */
class CategoryRequest extends FormRequest
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
            "title" => "required|string|unique:categories",
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
            "title.required" => "Введите название вашей категории",
            "title.unique:categories" => "Уже существует категория с таким названием"
        ];
    }
}
