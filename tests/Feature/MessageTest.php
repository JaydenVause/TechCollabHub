<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Message; 
use App\Models\Chat;
use App\Models\ChatUser;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    public function test_message_user_page(){
        $user = User::factory()->create();

        $poster = User::factory()->create();


        $response = $this->actingAs($user)->get("/message-user/$poster->id");

        $response->assertStatus(200);

        $response->assertSee($poster->id);

        $response->assertSee($poster->name);
    }

    public function test_user_logged_in_message_user_page(){
        $response = $this->get('/message-user/1');

        $response->assertStatus(302);
    }

    public function test_user_message(){
        $user = User::factory()->create();

        $recipent = User::factory()->create();

        $packet =  [
            'message_subject' => fake()->text(100),
            'message_body' => fake()->text(800),
        ];

        $response = $this->actingAs($user)->post("/message-user/$recipent->id", $packet);

        $response->assertStatus(302);


        $this->assertDatabaseHas('chat_user', [
            'user_id' => $user->id
        ]);

        $this->assertDatabaseHas('chat_user', [
            'user_id' => $recipent->id
        ]);

        $this->assertDatabaseHas('messages', [
            'message_body' => $packet['message_body'],
        ]);

        $response->assertSessionHas('message', "Successfully sent message to $recipent->name!");
    }

     public function test_user_logged_in_access_message_user(){
    

        $recipent = User::factory()->create();

        $packet =  [
            'message_subject' => fake()->text(100),
            'message_body' => fake()->text(800),
        ];

        $response = $this->post("/message-user/$recipent->id", $packet);

        $response->assertStatus(302);

        $this->assertDatabaseMissing('messages', [
            'message_body' => $packet['message_body'],
        ]);

        $response->assertSessionMissing('message', "Successfully sent message to $recipent->name!");
    }


    public function test_user_view_chats(){
        

        $user = User::factory()
            ->hasAttached(
                Chat::factory()->count(3)
            )->create();

        $user_chats = $user->chats;

        // dd($user_chats);

        $users = [];
        $messages = [];

        $i = 0;
        foreach($user_chats as $chat){
            #create 3 messages for each chat
            $users[] = $new_user = User::factory()->hasAttached($user_chats[$i])->create();

            for($j = 0; $j < 3; $j ++ ){
                $messages[$new_user->id] = Message::factory()->for($new_user)->for($chat)->create();
            }

            $i += 1;
        }

        $response = $this->actingAs($user)->get('/inbox');

        $response->assertStatus(200);

        $chats = ChatUser::where('user_id', $user->id)->get();

        foreach($users as $user){
            $user_messages = Message::where('user_id', $user->id)->orderBy('created_at','desc')->get();
            for($i = 0 ; $i < 3; $i ++){
                if($i == 0){
                    $response->assertSee($user->name);
                    $response->assertSee($user_messages[$i]);
                }
            }
        }

    }


    public function test_user_logged_in_send_message(){

        $response = $this->get('/message-user/1');

        $response->assertStatus(302);
    }

    public function test_user_not_message_self(){
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/message-user/'.$user->id);

        $response->assertStatus(403);
    }

    public function test_user_logged_in_access_send_message(){
        $response = $this->post('/message-user/1');

        $response->assertStatus(302);
    }

    public function test_user_not_send_message_non_user(){
        $user = User::factory()->create();

        $recipent = User::factory()->create();

        $user_id = $recipent->id;

        $recipent->delete();

        $response = $this->actingAs($user)->get('/message-user/'.$user_id);

        $response->assertStatus(403);
    }

    public function test_user_not_send_message_non_user_post(){
        $user = User::factory()->create();

        $recipent = User::factory()->create();

        $user_id = $recipent->id;

        $recipent->delete();

        $response = $this->actingAs($user)->post('/message-user/'.$user_id);

        $response->assertStatus(403);
    }

    public function test_user_not_send_message_self(){
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/message-user/'.$user->id);

        $response->assertStatus(403);
    }
}



// we should get groups of messages between the user and other users
// only return the latest message of that group
// that counts as a chat