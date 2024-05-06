<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectCollection;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $cols = [
            'id', 'name', 'description', 'type', 'is_featured', 'main_image'
        ];

        return new ProjectCollection(Project::select($cols)->paginate());
    }

    public function project($id)
    {
        $project = Project::with('features', 'plans')->findOrFail($id);
        return new ProjectResource($project);
    }
}
