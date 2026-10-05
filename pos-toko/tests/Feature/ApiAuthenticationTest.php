<?php

use App\Models\User;

it('authenticates with a token and revokes it on logout', function () {
    $user = User::create([
        'name' => 'API Test User',
        'email' => 'api-test@example.com',
        'password' => 'secret-password',
    ]);

    $loginResponse = $this->postJson('/api/login', [
        'email' => $user->email,
        'password' => 'secret-password',
    ]);

    $loginResponse->assertOk()
        ->assertJsonPath('user.id', $user->id);

    $token = $loginResponse->json('token');
    $headers = ['Authorization' => 'Bearer '.$token];

    $this->getJson('/api/user', $headers)
        ->assertOk()
        ->assertJsonPath('id', $user->id)
        ->assertJsonMissingPath('password');

    $this->assertDatabaseCount('personal_access_tokens', 1);

    $this->postJson('/api/logout', [], $headers)
        ->assertOk();

    $this->assertDatabaseCount('personal_access_tokens', 0);
});

it('rejects invalid API credentials', function () {
    $user = User::create([
        'name' => 'API Test User',
        'email' => 'api-test@example.com',
        'password' => 'secret-password',
    ]);

    $this->postJson('/api/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ])->assertUnauthorized();
});
