<?php

use App\Models\Admin;
use App\Models\Customer;

use function Pest\Laravel\postJson;

beforeEach(function () {
    $this->customer = Customer::factory()->create();
    $this->admin = Admin::factory()->create();
});

it('should not be able to login with wrong credentials', function () {
    postJson(route('api.auth.login', [
        'email' => 'some@email.com',
        'password' => 'password'
    ]))
        ->assertUnauthorized()
        ->assertJsonStructure(['message']);

    postJson(route('api.auth.login-admin', [
        'email' => 'some@email.com',
        'password' => 'password'
    ]))
        ->assertUnauthorized()
        ->assertJsonStructure(['message']);
});

it('should be able to login as a customer', function () {
    postJson(route('api.auth.login', [
        'email' => $this->customer->email,
        'password' => 'password'
    ]))
        ->assertOk()
        ->assertJsonStructure(['customer', 'token']);
});

it('should be able to login as an admin', function () {
    postJson(route('api.auth.login-admin', [
        'email' => $this->admin->email,
        'password' => 'password'
    ]))
        ->assertOk()
        ->assertJsonStructure(['user', 'token']);
});

test('email should be required and valid', function () {
    postJson(route('api.auth.login', [
        'email' => '',
        'password' => 'password'
    ]))
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['email' => 'required']);

    postJson(route('api.auth.login', [
        'email' => '',
        'password' => 'password'
    ]))
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['email' => 'required']);

    postJson(route('api.auth.login-admin', [
        'email' => 'invalid-email',
        'password' => 'password'
    ]))
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['email' => 'email']);

    postJson(route('api.auth.login-admin', [
        'email' => 'invalid-email',
        'password' => 'password'
    ]))
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['email' => 'email']);
});

test('password should be required', function () {
    postJson(route('api.auth.login', [
        'email' => 'email@email.com',
        'password' => ''
    ]))
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['password' => 'required']);

    postJson(route('api.auth.login-admin', [
        'email' => 'email@email.com',
        'password' => ''
    ]))
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['password' => 'required']);
});
