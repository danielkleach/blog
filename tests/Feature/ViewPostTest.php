<?php

namespace Tests\Feature;

use App\Post;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewPostTest extends TestCase
{
    use DatabaseTransactions;

    public function test_user_can_view_a_published_post()
    {
        $post = factory(Post::class)->states('published')->create([
            'date' => Carbon::parse('August 1, 2017'),
            'title' => 'This is a title',
            'content' => 'This is the content.',
        ]);

        $response = $this->get('/posts/' . $post->id);

        $response->assertSee('This is a title');
        $response->assertSee('This is the content.');
        $response->assertSee('August 1, 2017');
    }

    public function test_user_cannot_view_an_unpublished_post()
    {
        $post = factory(Post::class)->states('unpublished')->create([
            'date' => Carbon::parse('August 2, 2017'),
            'title' => 'This is the unpublished post',
            'content' => 'This is the content.',
        ]);

        $response = $this->get('/posts/' . $post->id);

        $response->assertStatus(404);
    }
}
