<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Configuration;
use App\Models\Major;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    public function index()
    {
        $majors = Major::get();
        $configuration = Configuration::find(1);
        $socialMedia = SocialMedia::find(1);
        $about = About::find(1);
        return view('public.major', compact(
            'majors',
            'configuration',
            'socialMedia',
            'about'
        ));
    }

    public function show($slug)
    {
        $major = Major::where('slug',$slug)->first();
        $configuration = Configuration::find(1);
        $socialMedia = SocialMedia::find(1);
        $about = About::find(1);
        return view('public.major-detail', compact(
            'major',
            'configuration',
            'socialMedia',
            'about'
        ));
    }
}
