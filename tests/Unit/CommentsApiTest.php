<?php

namespace Tests\Unit;

use App\Comment;
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
        # code...
        $comment = factory(Comment::class)->create(['commentable_type' => 'Post', 'commentable_id' => 1]);
        $this->assertEquals(1, Comment::count());
    }
}
