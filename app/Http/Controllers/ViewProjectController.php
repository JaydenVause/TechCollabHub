<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Inertia\Inertia;

class ViewProjectController extends Controller
{
    /**
     * view users project
     */
    public function view($projectId){
        $project = Project::where('id', $projectId)->first();

        return Inertia::render('Project/View', [
            'project' => $project
        ]);
    }
}
