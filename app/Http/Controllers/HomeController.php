<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){


        $most_recent_projects = DB::table('projects')->select('image', 'name', 'description', 'created_at', 'id')->orderByDesc('created_at')->limit(10)->get();

        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'most_recent_projects' => $most_recent_projects
        ]);
    }
}
