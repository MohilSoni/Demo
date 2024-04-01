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
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|min:6',
            'contact' => 'required',
            'department' => 'required',
            'image'=>($this->id == null ? 'required|image' : ''),
            'address' => 'required',
            'address_latitude' => 'required',
            'address_longitude' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.unique' => 'Email already exists',
            'email.email' => 'Email is not valid',
            'email.dns' => 'Email is not valid',
            'password.min' => 'Password must be at least 6 characters',
            'password.required' => 'Password is required',
            'contact.required' => 'Contact is required',
            'department.required' => 'Department is required',
            'image.required' => 'Image is required',
            'image.image' => 'Image is not valid',
            'address.required' => 'Address is required',
            'address_latitude.required' => 'Address Latitude is required',
            'address_longitude.required' => 'Address Longitude is required',
        ];
    }
}
