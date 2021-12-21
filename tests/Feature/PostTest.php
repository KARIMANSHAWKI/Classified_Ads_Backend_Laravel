<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    
    /** @test */
    public function test_user_can_create_a_post()
    {
        $user =  User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $attributes = [
          'title' => $this->faker->sentence,
          'description' => $this->faker->paragraph,
          'phone' => '01010959072',
          'user_id' => $user->id

      ];

        $this->post('/api/posts', $attributes);
        $this->assertDatabaseHas('posts', $attributes);
    }

    public function test_auth_user_can_view_a_post()
    {
        $post =  Post::factory()->create();
        $user =  User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $this->get('/api/posts/'. $post->id)->assertSee($post->title)->assertSee($post->description)->assertSee($post->User->name);
    }

    public function test_user_can_view_a_post()
    {
        $post =  Post::factory()->create();

        $this->get('/api/posts/list')->assertSee($post->title)->assertSee($post->description);
    }
}
