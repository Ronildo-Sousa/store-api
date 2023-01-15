<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\LoginUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginCustomerController extends Controller
{
    public function __invoke(Request $request)
    {
        $result = LoginUser::run($request->all());
        if (!$result) {
            return response()->json(['message' => 'credentials not matches'], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'customer' => $result->get('user'),
            'token' => $result->get('token'),
        ], Response::HTTP_OK);
    }
}
