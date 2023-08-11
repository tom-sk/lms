<?php

use App\Models\Module;
use App\Models\Slide;
use App\Models\Topic;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use function Pest\Faker\fake;

test('User can complete a slide', function () {
    $module = Module::create([
        'title' => 'Module 1',
    ]);

    $slide = Slide::create([
        'title' => 'Module 1',
    ]);

    $topic = Topic::create([
        'title' => 'Topic 1',
    ]);

    $user = User::create([
        'name' => fake()->name(),
        'email' => fake()->email(),
    ]);

    $this->actingAs($user)
        ->followingRedirects()
        ->postJSON(route('slide.update', [
            'slideId' => $slide->id,
            'slideComplete' => true,
            'topicId' => $topic->id,
            'moduleId' => $module->id,
        ]))
        ->assertStatus(Response::HTTP_OK);

    expect($user->completedSlides()->get())->toContainOnlyInstancesOf(Slide::class);
});
