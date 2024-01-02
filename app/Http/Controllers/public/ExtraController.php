<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Models\Extra;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class ExtraController extends Controller
{
    public function index()
    {
        $extras = Extra::get();
        $configuration = Configuration::find(1);
        $socialMedia = SocialMedia::find(1);
        return view('public.extra', compact(
            'extras',
            'configuration',
            'socialMedia'
        ));
    }

    public function show($slug)
    {
        $extra = Extra::where('slug', $slug)->first();
        $configuration = Configuration::find(1);
        $socialMedia = SocialMedia::find(1);
        return view('public.extra-detail', compact(
            'extra',
            'configuration',
            'socialMedia'
        ));
    }
}
