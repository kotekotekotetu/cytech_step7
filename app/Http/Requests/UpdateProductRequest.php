<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_name' => 'required|string|max:255',
            'company_id'   => 'required|exists:companies,id',
            'price'        => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'comment'      => 'nullable|string|max:255',
            'img_path'     => 'nullable|image|max:2048',
        ];
    }

        /**
     * 項目名
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'product_name' => '商品名',
            'company_id'   => 'メーカー名',
            'price'        => '価格',
            'stock'        => '在庫数',
            'comment'      => 'コメント',
            'img_path'     => '商品画像',
        ];
    }

    /**
     * エラーメッセージ
     *
     * @return array
     */
    public function messages()
    {
        return [
            'product_name.required' => ':attributeは必須項目です。',
            'product_name.string'   => ':attributeは文字列で入力してください。',
            'product_name.max'      => ':attributeは:max字以内で入力してください。',

            'company_id.required'   => ':attributeは必須項目です。',
            'company_id.exists'     => '選択された:attributeは存在しません。',

            'price.required'        => ':attributeは必須項目です。',
            'price.numeric'         => ':attributeは数値で入力してください。',
            'price.min'             => ':attributeは:min以上で入力してください。',

            'stock.required'        => ':attributeは必須項目です。',
            'stock.integer'         => ':attributeは整数で入力してください。',
            'stock.min'             => ':attributeは:min以上で入力してください。',

            'comment.string'        => ':attributeは文字列で入力してください。',
            'comment.max'           => ':attributeは:max字以内で入力してください。',
            
            'img_path.image'        => ':attributeには画像ファイルを指定してください。',
            'img_path.max'          => ':attributeは2MB以下のファイルを指定してください。',
        ];
    }
}
