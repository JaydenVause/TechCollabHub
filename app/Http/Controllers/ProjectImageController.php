<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectImageController extends Controller
{
    public function upload(Request $request){
        $validated = $request->validate([
            'image' => ['image', 'max:20000']
        ]);

        $path = Storage::disk('project-images')->putFile($validated['image']);
        return [
            'success' => 1,
            'file' => [
                'url' => '/project-images/'.$path
            ]
        ];
    }

    public function get($filePath){
        return Storage::disk('project-images')->download($filePath);
    }
}
