<?php

namespace Tests\Feature;

use App\Post;
use App\Subject;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostTest extends TestCase
{
    use DatabaseTransactions;

    public function testShowEndpointReturnsTheSpecifiedPublishedPost()
    {
        $post = factory(Post::class)->states('published')->create([
            'date' => Carbon::parse('August 1, 2017'),
            'title' => 'This is a title',
            'slug' => 'this_is_the_slug',
            'description' => 'This is the description.',
            'content' => 'This is the content.',
            'preview_image_url' => 'https://google.com'
        ]);

        $response = $this->get("/posts/{$post->slug}");

        $response->assertSee('This is a title');
        $response->assertSee('this_is_the_slug');
        $response->assertSee('This is the description.');
        $response->assertSee('This is the content.');
        $response->assertSee('https://google.com');
        $response->assertSee('August 1, 2017');
    }

    public function testShowEndpointDoesNotReturnTheSpecifiedUnpublishedPost()
    {
        $post = factory(Post::class)->states('unpublished')->create([
            'date' => Carbon::parse('August 2, 2017'),
            'title' => 'This is the unpublished post',
            'slug' => 'this_is_the_slug',
            'description' => 'This is the description.',
            'content' => 'This is the content.',
            'preview_image_url' => 'https://google.com'
        ]);

        $response = $this->get("/posts/{$post->slug}");

        $response->assertStatus(404);
    }

    public function testStoreEndpointCreatesAPostInTheDatabase()
    {
        $data = [
            'subject_id' => factory(Subject::class)->create()->id,
            'date' => Carbon::now()->toDateString(),
            'title' => 'This is my title',
            'slug' => 'this_is_the_slug',
            'description' => 'This is the description.',
            'content' => 'This is the content.',
            'preview_image_url' => 'https://google.com',
            'published' => 0
        ];

        $response = $this->postJson("/posts", $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('posts', $data);
    }

    public function testUpdateEndpointUpdatesAPostInTheDatabase()
    {
        $post = factory(Post::class)->create();

        $data = [
            'subject_id' => factory(Subject::class)->create()->id,
            'date' => Carbon::now()->toDateString(),
            'title' => 'This is my title',
            'slug' => 'this_is_the_slug',
            'description' => 'This is the description.',
            'content' => 'This is the content.',
            'preview_image_url' => 'https://google.com',
            'published' => 0
        ];

        $response = $this->patchJson("/posts/{$post->slug}/update", $data);

        $response->assertStatus(200);
        $this->assertDatabaseHas('posts', $data);
    }

    public function testDestroyEndpointRemovesAPost()
    {
        $post = factory(Post::class)->create();

        $response = $this->deleteJson("/posts/{$post->slug}/delete");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('posts', ['slug' => $post->slug, 'deleted_at' => null]);
    }
}
