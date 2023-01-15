<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\LoginUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use Symfony\Component\HttpFoundation\Response;

class LoginAdminController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        $result = LoginUser::run($request->validated(), new Admin);
        if (!$result) {
            return response()->json(['message' => 'credentials not matches'], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'user' => $result->get('user'),
            'token' => $result->get('token'),
        ], Response::HTTP_OK);
    }
}
