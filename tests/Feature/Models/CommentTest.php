<?php

namespace Tests\Feature\Models;

use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testInsertComment()
    {
        $data = Comment::factory()->make()->toArray();
        Comment::create($data);
        $this->assertDatabaseHas('comments', $data);
    }
}
