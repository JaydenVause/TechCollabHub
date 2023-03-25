<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Inertia\Inertia;

class BrowseProjectsController extends Controller
{
    public function index(){
        $lastest_projects = Project::orderByDesc('created_at')->limit(10)->get();

        return Inertia::render('BrowseProjects', [
            'projects' => $lastest_projects
        ]);
    }
}
