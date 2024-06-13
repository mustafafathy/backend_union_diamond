<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectCollection;
use App\Http\Resources\WebsiteDataResource;
use App\Models\Project;
use App\Models\Slider;
use App\Models\WebsiteData;
use Illuminate\Http\Request;

class WebsiteDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new WebsiteDataResource(WebsiteData::first());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function logos()
    {
        return new WebsiteDataResource(WebsiteData::select('logos')->first());
    }

    public function map_info()
    {
        return new ProjectCollection(Project::select(['id', 'name', 'longitude', 'latitude', 'status', 'main_image'])->get());
    }

    public function slider()
    {
        return (Slider::orderBy('order')->select('id', 'image')->get());
    }
}
