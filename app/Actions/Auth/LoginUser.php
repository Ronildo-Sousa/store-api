<?php

namespace App\Actions\Auth;

use App\Actions\Actionable;
use App\Http\Resources\UserResource;
use App\Models\Customer;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class LoginUser extends Actionable
{
    /**
     * @param Customer|Admin $model
     */
    public function handle(?array $userData = [], ?Authenticatable $model = new Customer)
    {
        if (empty($userData)) {
            return null;
        }

        $credentials = [
            'email' => $userData['email'],
            'password' => $userData['password'],
        ];

        $user = $model->where('email', $userData['email'])->first();

        if (!Auth::attempt($credentials)) {
            return null;
        }

        return collect([
            'user' => UserResource::make($user),
            'token' => $user->handleToken()
        ]);
    }
}
