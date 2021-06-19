<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Http\UploadedFile;

class UserService
{
    public function update(
        User $user,
        array $attributes,
        ?UploadedFile $photo = null,
        ?string $password = null
    ): User {
        $user->update($attributes);

        if ($photo !== null) {
            $user->update(['photo_path' => $photo->store('users')]);
        }

        if ($password !== null) {
            $user->update(['password' => $password]);
        }

        return $user;
    }
}
