<?php

use App\Models\User;

test('post owner can open edit pages protected by gate policy and middleware', function () {
    $user = User::factory()->create();
    $post = $user->posts()->create([
        'title' => 'Post milik saya',
        'body' => 'Isi post',
    ]);

    $this->actingAs($user)
        ->get(route('posts.gate-edit', $post))
        ->assertOk()
        ->assertSee('Gate');

    $this->actingAs($user)
        ->get(route('posts.policy-edit', $post))
        ->assertOk()
        ->assertSee('Policy');

    $this->actingAs($user)
        ->get(route('posts.middleware-edit', $post))
        ->assertOk()
        ->assertSee('Middleware can:update,post');
});

test('another user cannot edit a post through gate policy or middleware', function () {
    $owner = User::factory()->create();
    $anotherUser = User::factory()->create();
    $post = $owner->posts()->create([
        'title' => 'Post milik pengguna lain',
        'body' => 'Isi post',
    ]);

    $this->actingAs($anotherUser)
        ->get(route('posts.gate-edit', $post))
        ->assertForbidden();

    $this->actingAs($anotherUser)
        ->get(route('posts.policy-edit', $post))
        ->assertForbidden();

    $this->actingAs($anotherUser)
        ->get(route('posts.middleware-edit', $post))
        ->assertForbidden();
});

test('creating a post associates it with the authenticated user', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('posts.store'), [
            'title' => 'Post baru',
            'body' => 'Isi post baru',
        ])
        ->assertRedirect(route('posts.index'));

    $this->assertDatabaseHas('posts', [
        'user_id' => $user->id,
        'title' => 'Post baru',
    ]);
});
