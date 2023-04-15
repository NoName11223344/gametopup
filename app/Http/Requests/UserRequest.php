<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'user_name' => [
                'required',
                'regex:/^[a-zA-Z0-9\s]{1,15}$/',
                'unique:users'
            ],
            'password' => [
                'required',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/',
                'confirmed'
            ],
            'password_confirmation' => 'required',
            'name' => 'required',
            'phone' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'user_name.required' => "Tên đăng nhập không được để trống.",
            'user_name.regex' => "Tên đăng nhập không được chứa ký tự đặc biệt.",
            'user_name.unique' => "Tên đăng nhập đã tồn tại.",
            'password.required' => "Mật khẩu không được để trống.",
            'password.confirmed' => "Mật khẩu không không giống nhau.",
            'password.regex' => "Mật khẩu phải lớn hơn 8 ký tự, không được chứa ký tự đặc biệt và có cả chữ hoa và chữ thường.",
            'password_confirmation.required' => "Xác nhận mật khẩu không được để trống.",
            'name.required' => "Tên không được để trống.",
            'phone.required' => "Số điện thoại không được để trống.",
        ];
    }
}
