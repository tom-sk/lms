<?php

use App\Models\Module;
use App\Models\User;
use Inertia\Testing\AssertableInertia;
use function Pest\Faker\fake;

test('User can enrole in module', function () {
    $module = Module::create([
        'title' => 'Module 1',
    ]);

    $user = User::create([
        'name' => fake()->name(),
        'email' => fake()->email(),
    ]);

    $this->actingAs($user)
        ->followingRedirects()
        ->post(route('module.enrol', $module->id))
        ->assertOk()
        ->assertInertia(
            fn (AssertableInertia $page) => $page
                ->component('Dashboard')
                ->has('errors')
                ->where('errors', [])
        );;

    expect($user->modules()->first()->id)->toBe($module->id);
});
