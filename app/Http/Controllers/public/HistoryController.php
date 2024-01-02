<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Configuration;
use App\Models\History;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $configuration = Configuration::find(1);
        $socialMedia = SocialMedia::find(1);
        $about = About::find(1);
        $history = History::find(1);
        return view('public.history', compact(
            'configuration',
            'socialMedia',
            'about',
            'history'
        ));
    }
}
