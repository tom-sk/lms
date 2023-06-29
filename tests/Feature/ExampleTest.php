<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Inertia\Testing\AssertableInertia;
use function Pest\Faker\fake;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     */
    public function test_inertia_register(): void
    {
        $this->get(route('register'))
            ->assertOk()
            ->assertInertia(
                fn (AssertableInertia $page) => $page
                    ->component('Auth/Register')
                    ->has('errors')
                    ->where('errors', [])
            );
    }

//    public function test_inertia_register_2(): void
//    {
//        $this->get(route('register'));
//
//        $this
//            ->followingRedirects()
//            ->post(route('register'), [
//                'name' => fake()-> name,
//                'email' => fake()->email,
//                'password' => 'password',
//                'password_confirmation' => 'password',
//            ])
//            ->assertOk()
//            ->assertInertia(
//                fn (AssertableInertia $page) => $page
//                    ->component('Dashboard')
//                    ->has('errors')
//                    ->where('errors', [])
//            );
//    }
}
