<?php

namespace Tests\Unit;

use App\Constant;
use App\Models\Company;
use App\Models\Information;
use App\Models\InformationType;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->company = Company::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->type = InformationType::factory()->create();

        $this->infor = Information::factory()->create([
            'user_id' => $this->user->id,
            'type_id' => $this->type->id
        ]);

        $this->post = Post::factory()->count(10)->create([
            'user_id' => $this->user->id,
            'status' => Constant::STATUS_APPROVED_POST
        ]);
    }

    public function testRouteUser()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('home'))->assertStatus(200);
//        $data = $response->getOriginalContent()->getData();

        $this->assertInstanceOf(Paginator::class, $response->viewData('posts'));
//        $response->assertSee($data['posts']);
////        $response->assertSee($data['posts'][9]);

        $this->get(route('user.login'))->assertStatus(200);
        $this->get(route('user.register'))->assertStatus(200);
    }

    public function testProfile()
    {
        $this->get(route('profile.user', ['id' => $this->user->id]))
            ->assertStatus(200)
            ->assertSee($this->user->name);
    }

    public function testProfileUserDetail()
    {
        Auth::shouldReceive('user')->andReturn($this->user);

        $this->get(route('profile.user.detail', ['id' => $this->user->id,]))
            ->assertStatus(200)
            ->assertSee($this->user->name)
            ->assertViewHas([
                'user',
                'information',
                'type_infor',
                'company',
                'count_review',
                'reviews',
                'admin_replied'
            ]);
    }

    public function testProfileUser()
    {
        Auth::shouldReceive('user')->andReturn($this->user);
        Auth::shouldReceive('check')->andReturn($this->user);

        $this->get(route('profile.index', ['id' => $this->user->id,]))
            ->assertStatus(200)
            ->assertSee($this->user->name)
            ->assertViewHas([
                'user',
                'information',
                'type_infor',
                'company',
                'count_review',
                'reviews',
                'admin_replied'
            ]);
    }

    public function testUpdateProfileByAdmin()
    {
        Auth::shouldReceive('user')->andReturn($this->user);

        $data = [
            'email' => fake()->unique()->safeEmail(),
            'address' => fake()->address(),
            'phone' => fake()->unique()->phoneNumber(),
            'position' => fake()->text(10),
            'major' => fake()->text(10),
            'description' => fake()->text(20),
        ];

        $response = $this->post(route('profile.update', ['id' => $this->user->id,]), $data);

        $response->assertStatus(302);
        $response->assertRedirect(route('dashboard.profile', ['id' => $this->user->id,]));
    }

    public function testUpdateProfileByCompany()
    {
        $role = Role::factory()->create([
            'id' => Constant::ROLE_COMPANY
        ]);

        $user = User::factory()->create([
            'role_id' => $role
        ]);

        Auth::shouldReceive('user')->andReturn($user);

        $data = [
            'email' => fake()->unique()->safeEmail(),
            'address' => fake()->address(),
            'phone' => fake()->unique()->phoneNumber(),
            'position' => fake()->text(10),
            'major' => fake()->text(10),
            'description' => fake()->text(20),
        ];

        $response = $this->post(route('profile.update', ['id' => $user->id,]), $data);

        $response->assertStatus(302);
        $response->assertRedirect(route('company.profile', ['id' => $user->id,]));
    }

    public function testUpdateProfileByCandidate()
    {
        $role = Role::factory()->create([
            'id' => Constant::ROLE_CANDIDATE
        ]);

        $user = User::factory()->create([
            'role_id' => $role
        ]);

        Auth::shouldReceive('user')->andReturn($user);

        $data = [
            'email' => fake()->unique()->safeEmail(),
            'address' => fake()->address(),
            'phone' => fake()->unique()->phoneNumber(),
            'position' => fake()->text(10),
            'major' => fake()->text(10),
            'description' => fake()->text(20),
        ];

        $response = $this->post(route('profile.update', ['id' => $user->id,]), $data);

        $response->assertStatus(302);
        $response->assertRedirect(route('profile.index', ['id' => $user->id,]));
    }

    public function testUpdateBasicProfileByAdmin()
    {
        $role = Role::factory()->create([
            'id' => Constant::ROLE_ADMIN
        ]);

        $user = User::factory()->create([
            'role_id' => $role
        ]);

        Auth::shouldReceive('user')->andReturn($user);

        $data = [
            'img_avatar' => UploadedFile::fake()->image('ImageTest.png'),
            'name' => fake()->firstName(),
        ];

        $response = $this->post(route('profile.update.basic', ['id' => $user->id,]), $data);
        $this->assertFileExists($data['img_avatar']->path());
        $response->assertStatus(302);
        $response->assertRedirect(route('dashboard.profile', ['id' => $user->id,]));
    }

    public function testUpdateBasicProfileByCompany()
    {
        $role = Role::factory()->create([
            'id' => Constant::ROLE_COMPANY
        ]);

        $user = User::factory()->create([
            'role_id' => $role
        ]);

        Auth::shouldReceive('user')->andReturn($user);

        $data = [
            'img_avatar' => UploadedFile::fake()->image('ImageTest.png'),
            'name' => fake()->firstName(),
        ];

        $response = $this->post(route('profile.update.basic', ['id' => $user->id,]), $data);
        $this->assertFileExists($data['img_avatar']->path());
        $response->assertStatus(302);
        $response->assertRedirect(route('company.profile', ['id' => $user->id,]));
    }

    public function testUpdateBasicProfileByCandidate()
    {
        $role = Role::factory()->create([
            'id' => Constant::ROLE_CANDIDATE
        ]);

        $user = User::factory()->create([
            'role_id' => $role
        ]);

        Auth::shouldReceive('user')->andReturn($user);

        $data = [
            'img_avatar' => UploadedFile::fake()->image('ImageTest.png'),
            'name' => fake()->firstName(),
        ];

        $response = $this->post(route('profile.update.basic', ['id' => $user->id,]), $data);
        $this->assertFileExists($data['img_avatar']->path());
        $response->assertStatus(302);
        $response->assertRedirect(route('profile.index', ['id' => $user->id,]));
    }

    public function testUpdateBasicInforByAdmin()
    {
        $role = Role::factory()->create([
            'id' => Constant::ROLE_ADMIN
        ]);

        $user = User::factory()->create([
            'role_id' => $role
        ]);

        Auth::shouldReceive('user')->andReturn($user);

        $data = [
            'id' => $user->id,
            'type_id' => $this->type->id,
            'content' => $this->type->content
        ];

        $response = $this->post(route('profile.update.information', ['id' => $user->id,]), $data);
        $response->assertStatus(302);
        $response->assertRedirect(route('dashboard.profile', ['id' => $user->id,]));
    }

    public function testUpdateBasicInforByCompany()
    {
        $role = Role::factory()->create([
            'id' => Constant::ROLE_COMPANY
        ]);

        $user = User::factory()->create([
            'role_id' => $role
        ]);

        Auth::shouldReceive('user')->andReturn($user);

        $data = [
            'id' => $user->id,
            'type_id' => $this->type->id,
            'content' => $this->type->content
        ];

        $response = $this->post(route('profile.update.information', ['id' => $user->id,]), $data);
        $response->assertStatus(302);
        $response->assertRedirect(route('company.profile', ['id' => $user->id,]));
    }

    public function testUpdateBasicInforByCandidate()
    {
        $role = Role::factory()->create([
            'id' => Constant::ROLE_CANDIDATE
        ]);

        $user = User::factory()->create([
            'role_id' => $role
        ]);

        Auth::shouldReceive('user')->andReturn($user);

        $data = [
            'id' => $user->id,
            'type_id' => $this->type->id,
            'content' => $this->type->content
        ];

        $response = $this->post(route('profile.update.information', ['id' => $user->id,]), $data);
        $response->assertStatus(302);
        $response->assertRedirect(route('profile.index', ['id' => $user->id,]));
    }

    public function testProfileCompany()
    {
        Auth::shouldReceive('user')->andReturn($this->user);

        $this->get(route('company.profile', ['id' => $this->user->id]))
            ->assertStatus(200)
            ->assertSee($this->user->name)
            ->assertViewHas([
                'user',
                'information',
                'type_infor',
                'company',
                'count_review',
                'reviews',
            ]);
    }
}
