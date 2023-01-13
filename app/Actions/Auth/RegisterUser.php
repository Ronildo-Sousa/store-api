<?php

namespace App\Actions\Auth;

use App\Actions\Actionable;
use Illuminate\Contracts\Auth\Authenticatable;

class RegisterUser extends Actionable
{
    public function handle(?Authenticatable $user = null, ?array $requestData = null): Authenticatable
    {
        $user->name = $requestData['name'];
        $user->email = $requestData['email'];
        $user->password = $requestData['password'];
        $user->type = $requestData['type'] ?? null;
        $user->save();

        return $user;
    }
}
