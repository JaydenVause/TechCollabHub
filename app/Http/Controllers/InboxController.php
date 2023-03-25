<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ChatUser;
use App\Models\User;
use Inertia\Inertia;


class InboxController extends Controller
{
    public function index(){
        $user = Auth::user();

        $chats = $user->chats->sortByDesc('created_at');

        $chats_display = [];

        foreach($chats as $chat){
            $last_message = $chat->messages->sortByDesc('created_at')->first();

            $current_chat = [];
            $current_chat['chat_id'] = $chat->id;
            $current_chat['message_body'] = $last_message->message_body;
            $current_chat['subject'] = $chat->subject;

            $current_chat['last_message'] = $last_message->created_at;

            #get the user that chat is with
            $other_users_chat_user = ChatUser::where('chat_id', $chat->id)->where('user_id', '!=', $user->id)->first();

            $other_user = User::where('id', $other_users_chat_user->user_id)->first();

            $current_chat['other_user_id'] = $other_user->id;

            $current_chat['other_user_name'] = $other_user->name;

            $chats_display[] = $current_chat;
        }

      
        return Inertia::render('Inbox/Index', [
            'messages' => $chats_display
        ]);
    }
}
