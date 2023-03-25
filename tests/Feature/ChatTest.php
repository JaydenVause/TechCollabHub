<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Chat;
use App\Models\User;
use App\Models\Message;

class ChatTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        

        $user1 = User::factory()->create();

        $user2 = User::factory()->create();

        $chat = Chat::factory()->hasAttached($user1)->hasAttached($user2)->create();

        $user1Messages = Message::factory()->for($user1)->for($chat)->count(10)->create();

        $user2Messages = Message::factory()->for($user2)->for($chat)->count(10)->create();

        $response = $this->actingAs($user1)->get("/messages/$chat->id");

        $response->assertStatus(200);

        foreach($chat->messages()->orderByDesc('created_at')->limit(10)->get() as $message){
            $response->assertSee($message);
        }
    }
}
