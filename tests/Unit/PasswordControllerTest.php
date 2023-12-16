<?php

namespace Tests\Unit;

use App\Constant;
use App\Mail\ForgotPassMail;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Tests\TestCase;

class PasswordControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testRoute()
    {
        $this->get(route('forgot.mail.index'))->assertStatus(200);
        $this->get(route('forgot.password.index', ['email' => fake()->email]))->assertStatus(200);
    }

    public function testSendEmailForgotWithNotFound()
    {
        $email = [
            'email' => fake()->email
        ];

        $response = $this->post(route('send.forgot.mail'), $email);
        $response->assertStatus(302);
        $response->assertRedirect(route('user.login'));
    }

    public function testSendEmailForgot()
    {
        Mail::fake();

        $user = User::factory()->create([
            'email' => 'test@gmail.com'
        ]);

        $response = $this->post(route('send.forgot.mail'), $user->toArray());
        $response->assertStatus(302);
        Mail::assertSent(ForgotPassMail::class);
        $response->assertRedirect(route('user.login'));
    }

    public function testHandleForgot()
    {
        $user = User::factory()->create([
            'password' => '12345678',
            'email' => 'test@gmail.com'
        ]);

        $response = $this->post(route('handle.forgot'), $user->toArray());
        $response->assertStatus(302);
        $response->assertRedirect(route('home'));
    }

    public function testUpdateForgotByAdmin()
    {
        $password_new = Str::random(10);

        $role = Role::factory()->create([
            'id' => Constant::ROLE_ADMIN
        ]);

        $user = User::factory()->create([
            'id' => rand(1,100),
            'email' => 'test@gmail.com',
            'role_id' => $role
        ]);

        $data = [
            'id' => $user->id,
            'email' => $user->email,
            'password_old' => '12345678',
            'password' => $password_new,
            'password_confirmation' => $password_new,
        ];

        Auth::shouldReceive('user')->andReturn($user);

        $response = $this->post(route('password.update'), $data);
        $response->assertStatus(302);
        $response->assertRedirect(route('dashboard.profile',['id' => $user->id]));
    }

    public function testUpdateForgotByCompany()
    {
        $password_new = Str::random(10);

        $role = Role::factory()->create([
            'id' => Constant::ROLE_COMPANY
        ]);

        $user = User::factory()->create([
            'id' => rand(1,100),
            'email' => 'test@gmail.com',
            'role_id' => $role
        ]);

        $data = [
            'id' => $user->id,
            'email' => $user->email,
            'password_old' => '12345678',
            'password' => $password_new,
            'password_confirmation' => $password_new,
        ];

        Auth::shouldReceive('user')->andReturn($user);

        $response = $this->post(route('password.update'), $data);
        $response->assertStatus(302);
        $response->assertRedirect(route('company.profile',['id' => $user->id]));
    }

    public function testUpdateForgotByCandidate()
    {
        $password_new = Str::random(10);

        $role = Role::factory()->create([
            'id' => Constant::ROLE_CANDIDATE
        ]);

        $user = User::factory()->create([
            'id' => rand(1,100),
            'email' => 'test@gmail.com',
            'role_id' => $role
        ]);

        $data = [
            'id' => $user->id,
            'email' => $user->email,
            'password_old' => '12345678',
            'password' => $password_new,
            'password_confirmation' => $password_new,
        ];

        Auth::shouldReceive('user')->andReturn($user);

        $response = $this->post(route('password.update'), $data);
        $response->assertStatus(302);
        $response->assertRedirect(route('profile.index',['id' => $user->id]));
    }
}
