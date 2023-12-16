<?php

namespace Tests\Unit;

use App\Constant;
use App\Interfaces\ITicketRepository;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Mockery;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->role = Role::factory()->create([
            'id' => Constant::ROLE_COMPANY
        ]);

        $this->role1 = Role::factory()->create([
            'id' => Constant::ROLE_ADMIN
        ]);

        $this->user = User::factory()->create([
            'role_id' => $this->role->id
        ]);

        $this->post = Post::factory()->create([
            'user_id' => $this->user->id,
        ]);
    }

    public function testCreatePost()
    {
        $data = [
            'title' => fake()->title,
            'requirements' => fake()->text,
            'description' => fake()->text,
            'benefit' => fake()->text,
            'quantity' => rand(3, 5),
            'position' => fake()->text,
            'workplace' => fake()->text,
            'experience' => rand(1, 5) . ' năm',
            'working' => fake()->text,
            'major' => Constant::MAJOR_IT,
            'user_id' => $this->user->id
        ];

        $response = $this->post(route('post.create'), $data);
        $response->assertStatus(302);
        $response->assertRedirect(route('company.index'));

        $this->assertDatabaseHas('post', [
            'title' => $data['title'],
            'requirements' => $data['requirements'],
            'description' => $data['description'],
            'benefit' => $data['benefit'],
            'quantity' => $data['quantity'],
            'position' => $data['position'],
            'workplace' => $data['workplace'],
            'experience' => $data['experience'],
            'working' => $data['working'],
            'major' => $data['major'],
            'status' => Constant::STATUS_NOT_APPROVED_POST,
            'user_id' => $data['user_id']
        ]);
    }

    public function testDetailAndEditPost()
    {
        $this->get(route('post.detail', ['id' => $this->post->id]))
            ->assertStatus(200)
            ->assertSee($this->post->title);
    }

    public function testUpdatePost()
    {
        $data = [
            'title' => fake()->title,
            'requirements' => fake()->text,
            'description' => fake()->text,
            'benefit' => fake()->text,
            'quantity' => rand(3, 5),
            'position' => fake()->text,
            'workplace' => fake()->text,
            'experience' => rand(1, 5) . ' năm',
            'working' => fake()->text,
            'major' => Constant::MAJOR_IT,
        ];

        $response = $this->post(route('post.update', ['id' => $this->post->id]), $data);
        $response->assertStatus(302);
        $response->assertRedirect(route('company.index'));

        $this->assertDatabaseHas('post', [
            'title' => $data['title'],
            'requirements' => $data['requirements'],
            'description' => $data['description'],
            'benefit' => $data['benefit'],
            'quantity' => $data['quantity'],
            'position' => $data['position'],
            'workplace' => $data['workplace'],
            'experience' => $data['experience'],
            'working' => $data['working'],
            'major' => $data['major'],
            'status' => Constant::STATUS_NOT_APPROVED_POST,
            'user_id' => $this->post->user_id
        ]);
    }

    public function testDeletePostByCompany()
    {
        Auth::shouldReceive('user')->andReturn($this->user);

        $response = $this->post(route('post.delete', ['id' => $this->post->id]), [
            'role_id' => $this->user->role_id
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('company.index'));

        $this->assertDatabaseHas('post', [
            'title' => $this->post->title,
            'requirements' => $this->post['requirements'],
            'description' => $this->post['description'],
            'benefit' => $this->post['benefit'],
            'quantity' => $this->post['quantity'],
            'position' => $this->post['position'],
            'workplace' => $this->post['workplace'],
            'experience' => $this->post['experience'],
            'working' => $this->post['working'],
            'major' => $this->post['major'],
            'status' => Constant::STATUS_NOT_APPROVED_POST,
            'user_id' => $this->post->user_id,
            'deleted_at' => Carbon::now()
        ]);
    }

    public function testDeletePostByAdmin()
    {
        $user = User::factory()->create([
            'role_id' => $this->role1->id
        ]);

        Auth::shouldReceive('user')->andReturn($user);

        $response = $this->post(route('post.delete', ['id' => $this->post->id]), [
            'role_id' => $user->role_id
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('dashboard.index'));

        $this->assertDatabaseHas('post', [
            'title' => $this->post->title,
            'requirements' => $this->post['requirements'],
            'description' => $this->post['description'],
            'benefit' => $this->post['benefit'],
            'quantity' => $this->post['quantity'],
            'position' => $this->post['position'],
            'workplace' => $this->post['workplace'],
            'experience' => $this->post['experience'],
            'working' => $this->post['working'],
            'major' => $this->post['major'],
            'status' => Constant::STATUS_NOT_APPROVED_POST,
            'user_id' => $this->post->user_id,
            'deleted_at' => Carbon::now()
        ]);
    }

    public function testRestorePostByCompany()
    {
        Auth::shouldReceive('user')->andReturn($this->user);

        $post = Post::factory()->create([
            'user_id' => $this->user->id,
            'deleted_at' => Carbon::now()->subWeek()
        ]);

        $response = $this->post(route('post.restore', ['id' => $post->id]), [
            'role_id' => $this->user->role_id
        ]);

        $response->assertStatus(200);
        $this->assertTrue($response['result']);

        $this->assertDatabaseHas('post', [
            'title' => $post->title,
            'requirements' => $post['requirements'],
            'description' => $post['description'],
            'benefit' => $post['benefit'],
            'quantity' => $post['quantity'],
            'position' => $post['position'],
            'workplace' => $post['workplace'],
            'experience' => $post['experience'],
            'working' => $post['working'],
            'major' => $post['major'],
            'status' => Constant::STATUS_NOT_APPROVED_POST,
            'user_id' => $post->user_id,
            'deleted_at' => null
        ]);
    }

    public function testChangeStatusPost()
    {
        $response = $this->get(route('post.status',[
            'id' => $this->post->id,
            'status' => Constant::STATUS_APPROVED_POST
        ]));

        $response->assertStatus(200);
        $this->assertTrue($response['result']);
        $this->assertDatabaseHas('post',[
            'title' => $this->post->title,
            'status' => Constant::STATUS_APPROVED_POST
        ]);
    }
}
