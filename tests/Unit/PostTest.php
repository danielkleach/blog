<?php

namespace Tests\Unit;

use App\Post;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostTest extends TestCase
{
    use DatabaseTransactions;

    public function test_it_can_get_formatted_date()
    {
        $post = factory(Post::class)->make([
            'date' => Carbon::parse('2017-08-01')
        ]);

        $this->assertEquals('August 1, 2017', $post->formatted_date);
    }

    public function test_published_posts_are_published()
    {
        $publishedPostA = factory(Post::class)->states('published')->create();
        $publishedPostB = factory(Post::class)->states('published')->create();
        $unpublishedPost = factory(Post::class)->states('unpublished')->create();

        $publishedPosts = Post::published()->get();

        $this->assertTrue($publishedPosts->contains($publishedPostA));
        $this->assertTrue($publishedPosts->contains($publishedPostB));
        $this->assertFalse($publishedPosts->contains($unpublishedPost));
    }
}
