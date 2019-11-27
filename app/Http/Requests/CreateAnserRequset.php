<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateAnserRequset extends FormRequest
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
            'contact_name' => 'required',
            'contact_mobile' => 'required|regex:/^1[3-9][0-9]\d{8}$/',
            'radioData' => 'required|array'
        ];
    }

    public function messages()
    {
        return [
            'contact_name.required' => '姓名必填',
            'contact_mobile.required' => '手机号必填',
            'contact_mobile.regex' => '手机号格式错误',
            'radioData.required' => '请选择数据',
            'radioData.array' => '数据格式错误',
        ];
    }

     /**
     * 验证失败处理
     * 
     * @param object $validator
     * @throws Illuminate\Http\Exceptions\HttpResponseException
     */
    public function failedValidation($validator)
    {
        $error = $validator->errors()->first();
        // $allErrors = $validator->errors()->all(); 所有错误

        $response = response()->json([
            'status' => 'error',
            'msg'  => $error,
        ]);

        throw new HttpResponseException($response);
    }
}
