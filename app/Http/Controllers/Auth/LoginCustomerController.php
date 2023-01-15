<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\LoginUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Customer;
use Symfony\Component\HttpFoundation\Response;

class LoginCustomerController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        $result = LoginUser::run($request->validated(), new Customer);
        if (!$result) {
            return response()->json(['message' => 'credentials not matches'], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'customer' => $result->get('user'),
            'token' => $result->get('token'),
        ], Response::HTTP_OK);
    }
}
