<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\RegisterUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\Customer;
use Symfony\Component\HttpFoundation\Response;

class RegisterCustomerController extends Controller
{
    public function __invoke(UserRequest $request)
    {
        $customer = RegisterUser::run(new Customer(), $request->all());

        return response()
            ->json([
                'customer' => new UserResource($customer),
                'token' => $customer->handleToken()
            ], Response::HTTP_CREATED);
    }
}
