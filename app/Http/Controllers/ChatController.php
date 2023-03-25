<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use Inertia\Inertia;
use App\Models\User;
use App\Models\ChatUser;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index($chatId){
        $chat = Chat::where('id', $chatId)->first();

        $user = Auth::user();

        $messages = $chat->messages()->where('chat_id', $chat->id)->orderBy('created_at', 'desc')->limit(10)->get();
        
        $otherChatUser = ChatUser::where('user_id', '!=', $user->id)->where('chat_id', $chatId)->first();

        $otherChatUser = User::where('id', $otherChatUser->user_id)->first();
        $otherUserName = $otherChatUser->name;
        $otherUserId = $otherChatUser->id;

        return Inertia::render('Inbox/Chat', [
            'messages' => $messages,
            'otherUserName' => $otherUserName,
            'otherUserId' => $otherUserId
        ]);
    }
}
