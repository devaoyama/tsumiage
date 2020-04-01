<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfigForm extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'before_comment' => ['max:40'],
            'after_comment' => ['max:40'],
        ];
    }

    public function attributes()
    {
        return [
            'before_comment' => '宣言ツイートのコメント',
            'after_comment' => '報告ツイートのコメント',
        ];
    }
}
