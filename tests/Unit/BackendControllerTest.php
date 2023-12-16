<?php

namespace Tests\Unit;

use App\Constant;
use App\Mail\DeletePostMail;
use App\Mail\NotificationDeleteUser;
use App\Mail\NotificationRestoreUser;
use App\Mail\RestorePostMail;
use App\Models\Activity;
use App\Models\InformationType;
use App\Models\Post;
use App\Models\Role;
use App\Models\Ticket;
use App\Models\TicketType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class BackendControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->position = fake()->text;
        $this->working = fake()->text;
        $this->major = Constant::MAJOR_IT;

        $this->role = Role::factory()->create([
            'id' => Constant::ROLE_CANDIDATE
        ]);

        $this->user = User::factory()->create([
            'id' => fake()->unique()->randomNumber(),
            'major' => $this->major,
            'position' => $this->position,
            'role_id' => Constant::ROLE_CANDIDATE,
            'email' => 'test@gmail.com',
            'name' => fake()->firstName
        ]);

        $this->post = Post::factory()->count(3)->create([
            'major' => $this->major,
            'working' => $this->working,
            'position' => $this->position,
            'user_id' => $this->user->id,
            'status' => Constant::STATUS_APPROVED_POST,
            'created_at' => Carbon::now()->subWeek(),
        ]);

        $this->type = TicketType::factory()->create([
            'id' => Constant::TICKET_REPORT_POST
        ]);
    }

    public function testSearchFilterNotFound()
    {
        $data = [
            'position' => fake()->text,
            'working' => fake()->text,
            'major' => Constant::MAJOR_ACCOUNTANT,
        ];

        $response = $this->post(route('search.layout.filter'), $data);
        $value = $response->getOriginalContent()->getData();

        foreach ($value as $result) {
            $this->assertEquals(0, count($result));
        }
        $response->assertStatus(200);
        $response->assertViewHas('posts');
    }

    public function testSearchFilterWithMajor()
    {
        $data = [
            'position' => fake()->text,
            'working' => fake()->text,
            'major' => Constant::MAJOR_IT,
        ];

        $response = $this->post(route('search.layout.filter'), $data);
        $value = $response->getOriginalContent()->getData();

        foreach ($value as $result) {
            $this->assertEquals(0, count($result));
        }
        $response->assertStatus(200);
        $response->assertViewHas('posts');
    }

    public function testSearchFilterWithPosition()
    {
        $data = [
            'position' => $this->position,
            'working' => fake()->text,
            'major' => Constant::MAJOR_ACCOUNTANT,
        ];

        $response = $this->post(route('search.layout.filter'), $data);
        $value = $response->getOriginalContent()->getData();

        foreach ($value as $result) {
            $this->assertEquals(0, count($result));
        }
        $response->assertStatus(200);
        $response->assertViewHas('posts');
    }

    public function testSearchFilterWithWorking()
    {
        $data = [
            'position' => fake()->text,
            'working' => $this->working,
            'major' => Constant::MAJOR_ACCOUNTANT,
        ];

        $response = $this->post(route('search.layout.filter'), $data);
        $value = $response->getOriginalContent()->getData();

        foreach ($value as $result) {
            $this->assertEquals(0, count($result));
        }
        $response->assertStatus(200);
        $response->assertViewHas('posts');
    }

    public function testSearchFilterSuccessful()
    {
        $data = [
            'position' => $this->position,
            'working' => $this->working,
            'major' => Constant::MAJOR_IT,
        ];

        $response = $this->post(route('search.layout.filter'), $data);
        $value = $response->getOriginalContent()->getData();

        foreach ($value as $result) {
            $this->assertEquals(3, count($result));
            $this->assertEquals($data['position'], $result[0]['position']);
            $this->assertEquals($data['working'], $result[0]['working']);
            $this->assertEquals($data['major'], $result[0]['major']);
            $this->assertEquals($data['position'], $result[1]['position']);
            $this->assertEquals($data['working'], $result[1]['working']);
            $this->assertEquals($data['major'], $result[1]['major']);
            $this->assertEquals($data['position'], $result[2]['position']);
            $this->assertEquals($data['working'], $result[2]['working']);
            $this->assertEquals($data['major'], $result[2]['major']);
        }
        $response->assertStatus(200);
        $response->assertViewHas('posts');
    }

    public function testSearchFilterCompanyWithPosition()
    {
        Auth::shouldReceive('user')->andReturn($this->user);

        $data = [
            'position' => fake()->text,
            'major' => Constant::MAJOR_IT,
        ];

        $response = $this->post(route('search.company.filter'), $data);
        $value = $response->getOriginalContent()->getData();

        foreach ($value as $result) {
            $this->assertEquals(0, count($result));
        }
        $response->assertStatus(200);
        $response->assertViewHas('candidates');
    }

    public function testSearchFilterCompanySuccessful()
    {
        Auth::shouldReceive('user')->andReturn($this->user);

        $data = [
            'position' => $this->position,
            'major' => Constant::MAJOR_IT,
        ];

        $response = $this->post(route('search.company.filter'), $data);
        $value = $response->getOriginalContent()->getData();

        foreach ($value as $result) {

            $this->assertEquals(1, count($result));
            $this->assertEquals($data['position'], $result[0]['position']);
            $this->assertEquals($data['major'], $result[0]['major']);
        }
        $response->assertStatus(200);
        $response->assertViewHas('candidates');
    }

    public function testSearchFilterDateTimeSuccessful()
    {
        Auth::shouldReceive('user')->andReturn($this->user);

        $data = [
            'from' => Carbon::now()->subWeek(),
            'to' => Carbon::now()->subWeek(),
            'user_id' => $this->user->id
        ];

        $response = $this->post(route('search.filter.datetime'), $data);
        $value = $response->getOriginalContent()->getData();

        $this->assertEquals(4, count($value));
        $this->assertEquals(3, count($value["all_post"]));
        $response->assertStatus(200);
    }

    public function testSearchAjaxSuccessful()
    {
        $data = [
            'key' => $this->post[0]['title'],
        ];

        $response = $this->get(route('search.ajax'), $data);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Đã tìm thấy ' . count($response['data']) . ' kết quả',
            'data' => $response['data']
        ]);
    }

    public function testSearchPostByMajorNotfound()
    {
        $post = Post::factory()->create([
            'major' => Constant::MAJOR_IT,
            'created_at' => Carbon::now()->subWeek()
        ]);

        $response = $this->get(route('post.major', ['major' => Constant::MAJOR_CAR_TECHNOLOGY]));

        $response->assertStatus(200);
        $response->assertViewHas([
            'posts',
            'company_outstanding'
        ]);

        $response->assertDontSee($post->title);
    }

    public function testSearchPostByMajorSuccessful()
    {
        Post::factory()->create([
            'major' => Constant::MAJOR_IT,
            'created_at' => Carbon::now()->subMonth()
        ]);

        $response = $this->get(route('post.major', ['major' => Constant::MAJOR_IT]));

        $response->assertStatus(200);
        $response->assertViewHas([
            'posts',
            'company_outstanding'
        ]);
    }

    public function testSearchNameNotFound()
    {
        Auth::shouldReceive('user')->andReturn($this->user);

        $data = [
            'name' => fake()->firstName,
            'email' => fake()->email
        ];

        $response = $this->post(route('search.user'), $data);

        $value = $response->getOriginalContent()->getData();

        $response->assertStatus(200);
        $this->assertEquals(0, count($value['users']));
        $response->assertViewHas($value);
    }

    public function testSearchNameSuccessful()
    {
        Auth::shouldReceive('user')->andReturn($this->user);

        $data = [
            'name' => $this->user->name,
            'email' => $this->user->email
        ];

        $response = $this->post(route('search.user'), $data);
        $value = $response->getOriginalContent()->getData();

        $response->assertStatus(200);
        $this->assertEquals(1, count($value['users']));
        $response->assertViewHas($value);
    }

    public function testSendMailWhenDeletePost()
    {
        Mail::fake();

        $post = Post::factory()->create([
            'id' => rand(1, 100),
            'major' => Constant::MAJOR_IT,
            'deleted_at' => Carbon::now()->subMonth(),
            'user_id' => $this->user->id
        ]);

        $response = $this->get(route('mail.delete.post', ['id' => $post]));
        $response->assertStatus(200);
        Mail::assertSent(DeletePostMail::class);
    }

    public function testSendMailWhenRestorePost()
    {
        Mail::fake();

        $post = Post::factory()->create([
            'id' => rand(1, 999999),
            'major' => Constant::MAJOR_IT,
            'user_id' => $this->user->id
        ]);

        $response = $this->get(route('mail.restore.post', ['id' => $post]));
        $response->assertStatus(200);
        Mail::assertSent(RestorePostMail::class);
    }

    public function testSendMailWhenDeleteUser()
    {
        Mail::fake();

        $user = User::factory()->create([
            'id' => rand(1, 100),
            'name' => fake()->firstName,
            'deleted_at' => Carbon::now()->subMonth(),
            'email' => 'test1@gmail.com'
        ]);

        $response = $this->get(route('mail.delete.user', ['id' => $user]));
        $response->assertStatus(200);
        Mail::assertSent(NotificationDeleteUser::class);
    }

    public function testSendMailWhenRestoreUser()
    {
        Mail::fake();

        $user = User::factory()->create([
            'id' => rand(1, 100),
            'name' => fake()->firstName,
            'email' => 'test2@gmail.com',
        ]);

        $response = $this->get(route('mail.restore.user', ['id' => $user]));
        $response->assertStatus(200);
        Mail::assertSent(NotificationRestoreUser::class);
    }

    public function testGetUser()
    {
        $user = User::factory()->create([
            'id' => rand(1, 10),
        ]);

        $response = $this->get(route('backend.user', ['id' => $user]));

        $this->assertEquals($user->id, $response['user']['id']);
        $this->assertEquals($user->username, $response['user']['username']);
        $this->assertEquals($user->name, $response['user']['name']);
        $this->assertEquals($user->email, $response['user']['email']);
        $this->assertEquals($user->phone, $response['user']['phone']);
    }

    public function testGetPost()
    {
        $post = Post::factory()->create([
            'id' => rand(1, 10),
        ]);

        $response = $this->get(route('backend.post', ['id' => $post]));

        $this->assertEquals($post->id, $response['post']['id']);
        $this->assertEquals($post->title, $response['post']['title']);
        $this->assertEquals($post->major, $response['post']['major']);
        $this->assertEquals($post->requirements, $response['post']['requirements']);
        $this->assertEquals($post->workplace, $response['post']['workplace']);
    }

    public function testListRepliedTrashed()
    {
        $ticket = Ticket::factory()->create([
            'id' => rand(1, 5),
            'ticket_id' => rand(1, 100),
            'deleted_at' => Carbon::now()
        ]);

        $ticket2 = Ticket::factory()->create([
            'id' => $ticket->ticket_id,
            'deleted_at' => Carbon::now()
        ]);
        $response = $this->get(route('backend.ticket', ['id' => $ticket]));

        $this->assertEquals($ticket2->id, $response['ticket']['id']);
        $this->assertEquals($ticket2->content, $response['ticket']['content']);
        $this->assertEquals($ticket2->ticket_id, $response['ticket']['ticket_id']);
        $this->assertNotNull($response['reply_ticket']);
        $this->assertEquals($ticket->id, $response['reply_ticket']['id']);
        $this->assertEquals($ticket->content, $response['reply_ticket']['content']);
        $this->assertEquals($ticket->ticket_id, $response['reply_ticket']['ticket_id']);
    }

    public function testListTicketTrashed()
    {
        $ticket = Ticket::factory()->create([
            'id' => rand(1, 5),
            'ticket_id' => rand(1, 100),
            'deleted_at' => Carbon::now()
        ]);

        $response = $this->get(route('backend.ticket', ['id' => $ticket]));

        $this->assertNull($response['reply_ticket']);
        $this->assertEquals($ticket->id, $response['ticket']['id']);
        $this->assertEquals($ticket->content, $response['ticket']['content']);
        $this->assertEquals($ticket->ticket_id, $response['ticket']['ticket_id']);
    }

    public function testListRepliedTicket()
    {
        $ticket = Ticket::factory()->create([
            'id' => rand(1, 5),
            'deleted_at' => null
        ]);

        $ticket2 = Ticket::factory()->create([
            'id' => rand(6, 10),
            'status' => Constant::TICKET_REPORT_REPLIED,
            'type_id' => $this->type->id,
            'ticket_id' => $ticket->id,
            'deleted_at' => null
        ]);

        $response = $this->get(route('backend.ticket', ['id' => $ticket->id]));

        $this->assertEquals($ticket->id, $response['ticket']['id']);
        $this->assertEquals($ticket->content, $response['ticket']['content']);
        $this->assertEquals($ticket->ticket_id, $response['ticket']['ticket_id']);
        $this->assertEquals($ticket2->id, $response['reply_ticket']['id']);
        $this->assertEquals($ticket2->content, $response['reply_ticket']['content']);
        $this->assertEquals($ticket2->ticket_id, $response['reply_ticket']['ticket_id']);
        $this->assertNull($response['reply_ticket']['deleted_at']);
    }

    public function testListRepliedTicketTrashed()
    {
        $ticket = Ticket::factory()->create([
            'id' => rand(1, 5),
            'deleted_at' => null
        ]);

        $ticket2 = Ticket::factory()->create([
            'id' => rand(6, 10),
            'status' => Constant::TICKET_REPORT_REPLIED,
            'type_id' => $this->type->id,
            'ticket_id' => $ticket->id,
            'deleted_at' => Carbon::now()
        ]);

        $response = $this->get(route('backend.ticket', ['id' => $ticket->id]));

        $this->assertEquals($ticket->id, $response['ticket']['id']);
        $this->assertEquals($ticket->content, $response['ticket']['content']);
        $this->assertEquals($ticket->ticket_id, $response['ticket']['ticket_id']);
        $this->assertEquals($ticket2->id, $response['reply_ticket']['id']);
        $this->assertEquals($ticket2->content, $response['reply_ticket']['content']);
        $this->assertEquals($ticket2->ticket_id, $response['reply_ticket']['ticket_id']);
        $this->assertNotNull($response['reply_ticket']['deleted_at']);
    }

    public function testGetInformationTrashed()
    {
        $activity = Activity::factory()->create([
            'user_id' => $this->user->id,
        ]);

        $infor_type = InformationType::factory()->create([
            'id' => rand(1, 10),
            'deleted_at' => Carbon::now(),
        ]);

        $response = $this->get(route('backend.information', [
            'id' => $activity->id,
            'idType' => $infor_type->id
        ]));

        $this->assertEquals($activity->id, $response['activity']['id']);
        $this->assertEquals($activity->content, $response['activity']['content']);
        $this->assertEquals($activity->user_id, $response['activity']['user_id']);
        $this->assertEquals($infor_type->id, $response['information']['id']);
        $this->assertEquals($infor_type->content, $response['information']['content']);
        $this->assertNotNull($response['information']['deleted_at']);
    }

    public function testSearchHistoryDateTime()
    {
        Auth::shouldReceive('user')->andReturn($this->user);

        $activity1 = Activity::factory()->create([
            'user_id' => $this->user->id,
            'created_at' => Carbon::now()->subWeek()
        ]);

        $activity2 = Activity::factory()->create([
            'user_id' => $this->user->id,
            'created_at' => Carbon::now()->subWeek()
        ]);

        $activity3 = Activity::factory()->create([
            'user_id' => $this->user->id,
            'created_at' => Carbon::now()->subWeek()
        ]);

        $data = [
            'from' => Carbon::now()->subWeek()->startOfWeek()->toDateString(),
            'to' => Carbon::now()->subWeek()->endOfWeek()->toDateString()
        ];

        $response = $this->post(route('backend.filter.datetime'), $data);
        $result = $response->getOriginalContent()->getData();

        $this->assertEquals(3, count($result['history']));
        $response->assertViewHas($result);
        $response->assertSee($result['history'][0]['content']);
        $response->assertSee($result['history'][1]['content']);
    }
}
