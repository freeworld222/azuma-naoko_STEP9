<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    // リクエストを許可
    public function authorize(): bool
    {
        return true;
    }

    /**
     * このリクエストに適用するバリデーションルールを取得する
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ];
    }

    // バリデーションエラーメッセージ
    public function messages(): array
    {
        return [
            'name.required' => '名前を入力してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => '有効なメールアドレスを入力してください。',
            'message.required' => 'お問い合わせ内容を入力してください。',
        ];
    }
}
