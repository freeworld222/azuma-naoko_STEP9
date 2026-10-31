<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserUpdateRequest extends FormRequest
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
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'name_kanji' => 'required|string|max:255',
            'name_kana' => 'required|string|max:255',
        ];
    }

    // バリデーションエラーメッセージ
    public function messages(): array
    {
        return [
            'name.required' => 'ユーザー名を入力してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => '有効なメールアドレスを入力してください。',
            'name_kanji.required' => '名前を入力してください。',
            'name_kana.required' => 'カナを入力してください。',
        ];
    }
}
