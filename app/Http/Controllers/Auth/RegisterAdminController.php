<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\RegisterUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\Admin;
use Symfony\Component\HttpFoundation\Response;

class RegisterAdminController extends Controller
{
    public function __invoke(UserRequest $request)
    {
        $admin = RegisterUser::run($request->validated(), new Admin);

        return response()
            ->json([
                'user' => UserResource::make($admin),
                'token' => $admin->handleToken()
            ], Response::HTTP_CREATED);
    }
}
