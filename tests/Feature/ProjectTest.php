<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use App\Generators\BlockGenerator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /**
     * test we can get create project page
     */
    public function test_new_project_page(){
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/create-project');

        $response->assertStatus(200);
    }

    public function test_upload_project_image(){
        Storage::fake('project-images');

        $file = UploadedFile::fake()->image('image2.png');

        $response = $this->post('/project-image', [
            'image' => $file
        ]);

        Storage::disk('project-images')->assertExists($file->hashName());
    }

    public function test_get_project_image(){
        Storage::fake('project-images');
        $file = UploadedFile::fake()->image('image2.png');
        Storage::disk('project-images')->putFile($file);

        $response = $this->get('/project-images/'.$file->hashName());
        $response->assertStatus(200);

        $response->assertDownload($file->hashName());
    }

    public function test_create_new_project(){
        $user = User::factory()->create();

        $data = [
            'project_name' => fake()->name(),
            'project_description' => fake()->text(),
            'blocks' => []
        ];

        for($i = 0; $i < 3; $i ++){
            #generate a new block for content
            if($i == 0){
                $data['blocks'][] = BlockGenerator::generate('header');    
            }elseif ($i == 1) {
                $data['blocks'][] = BlockGenerator::generate();
            }elseif($i == 2){
                $data['blocks'][] = BlockGenerator::generate('image');
            }
            
        }

        // dd($this->castAsJson($data['blocks']));

        $response = $this->actingAs($user)->post('/create-project', $data);

        $this->assertDatabaseHas('projects', [
            'user_id' => $user->id,
            'name' => $data['project_name'],
            'description' => $data['project_description'],
            'blocks' => $this->castAsJson($data['blocks'])
        ]);
    }

    public function test_view_project(){
        $project = Project::factory()->create();
        $response = $this->get("/projects/$project->id");
        $blocks = json_decode($project->blocks);

        $response->assertStatus(200);
        $response->assertSee($project->name);
        $response->assertSee($project->description);


        

        foreach($blocks as $block){
            if($block->type == 'paragraph'){
                $response->assertSee($block->data->text);
            }else if($block->type == 'header'){
                $response->assertSee($block->data->text);
            }else if($block->type == 'image'){
                $response->assertSee(str_replace('/', '\\/', $block->data->file->url));
            }
        }

    }


}
