<?php

use App\Models\User;

test('authenticated user can access own resources', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('private.businesses.list', $user))
        ->assertStatus(200);
});

test('authenticated user cannot access other users resources', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $this->actingAs($user1)
        ->get(route('private.businesses.list', $user2))
        ->assertStatus(403);
});

test('unauthenticated user is redirected to login', function () {
    $user = User::factory()->create();

    $this->get(route('private.businesses.list', $user))
        ->assertRedirect('/login');
});
