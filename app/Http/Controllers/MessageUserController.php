<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\Chat;
use App\Models\ChatUser;


class MessageUserController extends Controller
{
    public function index($userId){

        $user = Auth::user();

        if($user->id == $userId){
            abort(403);
        }



        $recipent = User::select('name', 'id')->where('id', $userId)->first();

        if(!$recipent){
            abort(403);
        }

        return Inertia::render('Messages/New', [
            'recipent' => $recipent
        ]);
    }

    public function send(Request $request, $recipentId){


        $user = Auth::user();


        $recipent = User::where('id', $recipentId)->first();
        

        if(!$recipent){
            abort(403);
        }

        if($user->id == $recipentId){
            abort(403);
        }

        $validated = $request->validate([
            'message_subject' => 'string|max:100',
            'message_body' => 'required|string|max:855'
        ]);

        if(isset($validated['message_subject'])){
            $subject = $validated['message_subject'];
        }else{
            $subject = 'Reply';
        }

        $body = $validated['message_body'];


        foreach($user->chats->all() as $chat){
            if($chat = $recipent->chats->where('id', $chat->id)->first()){
                break;
            }
        }
        

        if(!isset($chat)){
            $chat = Chat::create([
                'subject' => $subject
            ]);

            $chat->users()->attach($user);

            $chat->users()->attach($recipent);
        }

        $message = Message::create([
            'message_body' => $body,
            'chat_id' => $chat->id,
            'user_id' => $user->id
        ]);

        
        $request->session()->flash('message', 'Successfully sent message to ' . $recipent->name . '!');

        return to_route('dashboard');
    }
}
