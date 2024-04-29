<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectCollection;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        // return true;
        return new ProjectCollection(Project::with('plans', 'features')->paginate());
    }
}
