<?php

namespace Tests\Feature;

use App\User;
use App\Subject;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreatePostTest extends TestCase
{
    use DatabaseTransactions;

    public function test_user_can_create_a_post()
    {
        $user = factory(User::class)->create();

        $data = [
            'user_id' => $user->id,
            'subject_id' => factory(Subject::class)->create()->id,
            'date' => Carbon::now()->toDateString(),
            'title' => 'This is my title',
            'content' => 'This is my post content.',
            'published' => 0
        ];

        $response = $this->actingAs($user)
            ->postJson("/posts", $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('posts', $data);
    }
}
