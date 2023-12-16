<?php

namespace Tests\Unit;

use App\Constant;
use App\Models\Applied;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->role = Role::factory()->create([
            'id' => Constant::ROLE_ADMIN
        ]);

        $this->user = User::factory()->create([
            'role_id' => $this->role->id
        ]);

        $this->post = Post::factory()->create([
            'user_id' => $this->user->id,
        ]);
    }

    public function testAppliedButExist()
    {
        Applied::factory()->create([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id
        ]);

        $response = $this->get(route('user.applied.post',[
            'user_id' => $this->user->id,
            'post_id' => $this->post->id
        ]));
        $response->assertStatus(200);
        $this->assertFalse($response['result']);
    }

    public function testAppliedSuccessful()
    {
        $response = $this->get(route('user.applied.post',[
            'user_id' => $this->user->id,
            'post_id' => $this->post->id
        ]));

        $response->assertStatus(302);
        $response->assertRedirect(route('post.detail', $this->post->id));
    }

    public function testUnApplied()
    {
        Applied::factory()->create([
            'user_id' => $this->user->id,
            'post_id' => $this->post->id
        ]);

        $response = $this->get(route('user.un.applied.post',[
            'user_id' => $this->user->id,
            'post_id' => $this->post->id
        ]));
        $response->assertStatus(302);
        $response->assertRedirect(route('post.detail', $this->post->id));
    }
}
