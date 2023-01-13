<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\RegisterUser;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegisterCustomerController extends Controller
{
    public function __invoke(Request $request)
    {
        $customer = RegisterUser::run(new Customer, $request->all());

        return response()
            ->json([
                'customer' => $customer,
                'token' => $customer->handleToken()
            ], Response::HTTP_CREATED);
    }
}
