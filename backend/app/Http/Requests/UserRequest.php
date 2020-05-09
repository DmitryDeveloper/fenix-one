<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UserRequest
 * @package App\Http\Requests
 */
class UserRequest extends FormRequest
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
            "first_name" => "required|alpha_dash|max:25",
            "last_name" => "required|alpha_dash|max:40",
            "email" => "required|email|unique:users|max:100",
            "password" => "required|string|min:5",
            "phone" => "required|integer|between:5,30",
            "role" => "string|max:30",
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
            "first_name.required" => "Введите ваше имя",
            "first_name.alpha_dash" => "Имя должно содержать только буквы, тире или символ подчёркивания",
            "first_name.max:25" => "Имя не должно превышать 25 символов",
            "last_name.required" => "Введите вашу фамилию",
            "last_name.alpha_dash" => "Фамилия должна содержать только буквы, тире или символ подчёркивания",
            "last_name.max:40" => "Фамилия не должна превышать 40 символов",
            "email.required" => "Введите ваш email",
            "email.email" => "Формат не соответсвует",
            "email.unique:users" => "Такой email уже существует на этом сайте",
            "email.max:100" => "Email не должен превышать 100 символов",
            "password.required" => "Введите ваш пароль",
            "password.max:25" => "Пароль должен превышать 5 символов",
            "phone.required" => "Введите ваш телефон",
            "phone.integer" => "Телефон должен содержать только цифры",
            "phone.between:5,30" => "Телефон должен быть от 5 до 30 символов"
        ];
    }
}
