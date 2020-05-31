<?php

namespace Tests\Unit;

use App\Comment;
use App\Post;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class CommentsApiTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate');
    }

    public function testGetComments()
    {
        $post = factory(Post::class)->create();
        $comment = factory(Comment::class)->create(['commentable_type' => 'Post', 'commentable_id' => $post->id]);
        $comment2 = factory(Comment::class)->create(['commentable_type' => 'Post', 'commentable_id' => $post->id]);
        $comment3 = factory(Comment::class)->create(['commentable_type' => 'Post', 'commentable_id' => $post->id, 'reply' => $comment2->id]);

        $response = $this->call('GET', '/comments', ['type' => 'Post', 'id' => $post->id]);
        $comments = json_decode($response->getContent());
        $this->assertEquals(200, $response->getStatusCode(), $response->getContent());
        $this->assertEquals(2, count($comments));
        $this->assertSame(0, $comments[0]->reply);
        $this->assertSame($comment2->id, $comments[0]->id);
        $this->assertSame(1, count($comments[0]->replies));
        $this->assertSame($comment->id, $comments[1]->id);
    }
}
