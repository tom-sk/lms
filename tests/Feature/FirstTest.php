<?php

use Inertia\Testing\AssertableInertia;
use function Pest\Faker\fake;

test('user can access register page', function (){
    $this->get(route('register'))
        ->assertOk()
        ->assertInertia(
            fn (AssertableInertia $page) => $page
                ->component('Auth/Register')
                ->has('errors')
                ->where('errors', [])
        );
});

test('user can register', function () {
    $this->get(route('register'));

    $this
        ->followingRedirects()
        ->post(route('register'), [
            'name' => fake()-> name,
            'email' => fake()->email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ])
        ->assertOk();

    $this->get(route('dashboard'))
        ->assertStatus(302)
        ->assertRedirect('/billing');;
});
