<?php

use App\Models\Admin;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\postJson;

it('should be able to register a customer', function () {
    postJson(route('api.auth.register', [
        'name' => fake()->name(),
        'email' => 'customer@email.com',
        'password' => 'password'
    ]))
        ->assertCreated()
        ->assertJsonStructure(['customer', 'token']);

    assertDatabaseHas('users', ['email' => 'customer@email.com']);
});

test('admin should be able to register a new admin user', function () {
    $admin = Admin::factory()->create();

    actingAs($admin)
        ->postJson(route('api.auth.register-admin', [
            'name' => fake()->name(),
            'email' => 'newadmin@email.com',
            'password' => 'password'
        ]))
        ->assertCreated();

    assertDatabaseHas('users', ['email' => 'newadmin@email.com']);
});

test('all fileds should be required and valid', function () {
    postJson(route('api.auth.register', [
        'name' => '',
        'email' => '',
        'password' => ''
    ]))
        ->assertUnprocessable()
        ->assertJsonValidationErrors([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

    postJson(route('api.auth.register', [
        'name' => 'test name',
        'email' => 'some-email',
        'password' => 'password'
    ]))
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['email' => 'email']);
});
