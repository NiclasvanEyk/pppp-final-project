<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'max:50'],
            'last_name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')->ignore($this->route('user'))],
            'password' => ['nullable'],
            'owner' => ['required', 'boolean'],
            'photo' => ['nullable', 'image'],
        ];
    }

    /**
     * @return array The new values that are directly attached to the user
     */
    public function getUpdatedUserAttributes(): array
    {
        return Arr::only($this->validated(), ['first_name', 'last_name', 'email', 'owner']);
    }

    public function getPassword(): ?string
    {
        return $this->get('password');
    }

    public function getPhoto(): ?UploadedFile
    {
        return $this->file('photo');
    }
}
