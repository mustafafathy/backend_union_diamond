<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectCollection;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\WebsiteData;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $badge = WebsiteData::select('badge')->get()->first()->badge;

        $cols = [
            'id', 'name', 'description', 'type', 'is_featured', 'main_image'
        ];

        return new ProjectCollection(Project::select($cols)->paginate(), $badge);
    }

    public function project($id)
    {
        $project = Project::with('features', 'plans')->findOrFail($id);
        return new ProjectResource($project);
    }

    public function project_images()
    {
        $cols = [
            'id', 'name', 'alt_images', 'logo_id'
        ];

        return new ProjectCollection(Project::with('logo')->select($cols)->get(), '');
    }

    public function project_stages()
    {
        $cols = [
            'id', 'name', 'stages_images', 'logo_id'
        ];

        return new ProjectCollection(Project::with('logo')->select($cols)->get(), '');
    }
}
