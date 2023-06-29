<?php

use App\Models\User;
use Inertia\Testing\AssertableInertia;
use function Pest\Faker\fake;

test('has first page', function () {
    $this->get(route('register'));

    $this
        ->followingRedirects()
        ->post(route('register'), [
            'name' => fake()-> name,
            'email' => fake()->email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ])
        ->assertOk()
        ->assertInertia(
            fn (AssertableInertia $page) => $page
                ->component('Dashboard')
                ->has('errors')
                ->where('errors', [])
        );
});
