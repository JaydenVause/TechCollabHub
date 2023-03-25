<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;

class FindTopicController extends Controller
{
    public function find($topicName){
        $topics = Topic::where('name', 'like' , '%'. $topicName . '%')->get();
        return response()->json($topics);
    }
}
