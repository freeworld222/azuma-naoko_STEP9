<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
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
            'quantity' => 'required|integer|min:1',
        ];
    }

    // バリデーションエラーメッセージ
    public function messages(): array
    {
        return [
            'quantity.required' => '購入数を入力してください。',
            'quantity.integer' => '購入数は整数で入力してください。',
            'quantity.min' => '購入数は1以上で入力してください。',
        ];
    }
}
