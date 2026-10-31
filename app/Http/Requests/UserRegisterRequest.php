<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'name' => 'required',
            'name_kanji' => 'required',
            'name_kana' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ];
    }

    // バリデーションエラーメッセージ
    public function messages(): array
    {
        return [
            'name.required' => 'ユーザー名を入力してください。',
            'name_kanji.required' => '名前を入力してください。',
            'name_kana.required' => 'カナを入力してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => '有効なメールアドレスを入力してください。',
            'email.unique' => 'このメールアドレスはすでに登録されています。',
            'password.required' => 'パスワードを入力してください。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.confirmed' => 'パスワードが一致しません。',
        ];
    }
}
