<?php

namespace Tests\Feature\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testInsertData()
    {
        // User::factory()->create();
        // $this->assertDatabaseCount('users', 1);
        $data = User::factory()->make()->toArray();
        $data['password'] = '12345678';
        User::create($data);
        $this->assertDatabaseHas('users', $data);
    }
}
