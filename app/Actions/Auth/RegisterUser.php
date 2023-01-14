<?php

namespace App\Actions\Auth;

use App\Actions\Actionable;
use App\Models\Admin;
use Illuminate\Contracts\Auth\Authenticatable;

class RegisterUser extends Actionable
{
    public function handle(?Authenticatable $user = null, ?array $requestData = null): Authenticatable
    {
        $user->name = $requestData['name'];
        $user->email = $requestData['email'];
        $user->password = $requestData['password'];

        if (class_basename($user) == 'Admin') {
            $user->type = Admin::class;
        }

        $user->save();

        return $user;
    }
}
