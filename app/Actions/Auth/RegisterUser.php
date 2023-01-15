<?php

namespace App\Actions\Auth;

use App\Actions\Actionable;
use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Contracts\Auth\Authenticatable;

class RegisterUser extends Actionable
{
    /**
     * @param Customer|Admin $user
     */
    public function handle(?array $requestData = null, ?Authenticatable $user = null): Authenticatable
    {
        $user->name = $requestData['name'];
        $user->email = $requestData['email'];
        $user->password = bcrypt($requestData['password']);

        if (class_basename($user) == 'Admin') {
            $user->type = Admin::class;
        }

        $user->save();

        return $user;
    }
}
