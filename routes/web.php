<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CreateProjectController;
use App\Http\Controllers\ViewProjectController;
use App\Http\Controllers\ProjectImageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageUserController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\FindTopicController;
use App\Http\Controllers\BrowseProjectsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('dashboard');;


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/create-project', [CreateProjectController::class, 'index'])->name('project.create');

    Route::post('/create-project', [CreateProjectController::class, 'create']);

    Route::get('/message-user/{userId}', [MessageUserController::class, 'index']);

     Route::post('/message-user/{userId}', [MessageUserController::class, 'send'])->middleware('auth');

     Route::get('/inbox', [InboxController::class, 'index'])->name('inbox');
});


Route::get('/about', function (){
    return Inertia::render('About');
})->name('about');

Route::get('/services', function (){
    return Inertia::render('Services');
})->name('services');

Route::get('/contact', function (){
    return Inertia::render('Contact');
})->name('contact');

Route::get('/messages/{messageId}', [ChatController::class, 'index']);

Route::get('/topics/{topicName}', [FindTopicController::class, 'find']);

Route::get('/projects', [BrowseProjectsController::class, 'index'])->name('projects.browse');


Route::get('/projects/{projectId}', [ViewProjectController::class, 'view']);

Route::middleware(['throttle:ip_address'])->group(function (){
   
    Route::post('/project-image', [ProjectImageController::class, 'upload']);
});


Route::get('/project-images/{filePath}', [ProjectImageController::class, 'get']);

require __DIR__.'/auth.php';
