<?php

namespace App\Http\Controllers;

use App\Http\Resources\LogoCollection;
use App\Http\Resources\WebsiteDataResource;
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
}
