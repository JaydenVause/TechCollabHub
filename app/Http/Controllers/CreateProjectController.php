<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\ValidBlock;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use App\Models\Topic;
class CreateProjectController extends Controller
{


    public function index(){


        $topics = Topic::all();

        return Inertia::render("Project/New", [
            'csrf_token' => csrf_token(),
            'topics' => $topics
        ]);
    }


    /**
     * creates users project
     */

    public function create(Request $request){
        $validated = $request->validate([
            'project_name' => ['string', 'required', 'max:100', 'unique:App\Models\Project,name'],
            'project_description' => ['string', 'required', 'max:255'],
            'project_image' => 'image|max:20000|required',
            'topics' => 'required|array',
            'topic.*' => 'required|integer|max:855',
            'blocks' => ['array', 'required' , 'max:10000'],
            'blocks.*' => ['array', 'min:1', 'max:4'],
            'blocks.*.id' => ['required', 'string', 'max:100'],
            'blocks.*.type' => ['required', 'string', 'max:100', new ValidBlock],
            'blocks.*.data.text' => ['string', 'max:855'],
            'blocks.*.data.level' => ['integer'],
            'blocks.*.data.file' => ['array', 'max:2'],
            'blocks.*.data.file.url' => ['string', 'max:255'],
            'blocks.*.data.caption' => ['string', 'max:100'],
            'blocks.*.data.stretched' => ['boolean'],
            'blocks.*.data.withBackground' => ['boolean'],
            'blocks.*.data.withBorder' => ['boolean']
        ]);

        $user = Auth::user();

        $blockData = [];

       

        // dd($validated['blocks']);

        foreach($validated['blocks'] as $block){
            // dd($block);
            $currentBlock  = [];
            $currentBlock['id'] = $block['id'];
            $currentBlock['type'] = $block['type'];

            if(isset($block['data']['text'])){
                $currentBlock['data']['text'] = $block['data']['text'];
            }

            if(isset($block['data']['level'])){
                $currentBlock['data']['level'] = $block['data']['level'];
            }

            if(isset($block['data']['file']['url'])){
                $currentBlock['data']['file']['url'] = $block['data']['file']['url'];
            }

            if(isset($block['data']['caption'])){
                $currentBlock['data']['caption'] = $block['data']['caption'];
            }

            if(isset($block['data']['stretched'])){
                $currentBlock['data']['stretched'] = $block['data']['stretched'];
            }

            if(isset($block['data']['withBackground'])){
                $currentBlock['data']['withBackground'] = $block['data']['withBackground'];
            }

            if(isset($block['data']['withBorder'])){
                $currentBlock['data']['withBorder'] = $block['data']['withBorder'];
            }

            $blockData[] = $currentBlock;
        }
        
        $blockData =  json_encode($blockData);

        $image = $validated['project_image'];

        $path = Storage::disk('project-images')->putFile($image);

        $project = Project::create([
            'user_id' => $user->id,
            'name' => $validated['project_name'],
            'description'=> $validated['project_description'],
            'blocks' => $blockData,
            'image' => $path
        ]);

        foreach($validated['topics'] as $topic_id){
            $topic = Topic::where('id', $topic_id)->first();
            $project->topics()->attach($topic);
        }

        $request->session()->flash('message', 'Create project successfully!');
        
        return to_route('dashboard');

    }
}
