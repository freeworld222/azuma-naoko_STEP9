<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
    　　　　リクエストを許可
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
    　　このリクエストに適用するバリデーションルールを取得する
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_name' => 'required',
            'price' => 'required|integer|min:0',
            'description' => 'required',
            'stock' => 'required|integer|min:0',
            'img_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];
    }

    // バリデーションエラーメッセージ
    public function messages(): array
    {
        return [
            'product_name.required' => '商品名を入力してください。',
            'price.required' => '価格を入力してください。',
            'price.integer' => '価格は整数で入力してください。',
            'price.min' => '価格は0以上で入力してください。',
            'description.required' => '商品説明を入力してください。',
            'stock.required' => '在庫数を入力してください。',
            'stock.integer' => '在庫数は整数で入力してください。',
            'stock.min' => '在庫数は0以上で入力してください。',
            'img_path.image' => '画像ファイルを選択してください。',
            'img_path.mimes' => '画像はjpeg、png、jpg、gif、webp形式で選択してください。',
            'img_path.max' => '画像は2MB以下にしてください。',
        ];
    }
}
