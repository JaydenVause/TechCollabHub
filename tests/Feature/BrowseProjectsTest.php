<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;

class BrowseProjectsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_browse_projects_page(){

        Project::factory()->count(10)->create();

        $response = $this->get('/projects');

        $response->assertStatus(200);

        $projects = Project::orderByDesc('created_at')->limit(10)->get();

        foreach($projects as $project){
            $response->assertSee($project->name);

            $response->assertSee($project->description);
        }
    }
}
