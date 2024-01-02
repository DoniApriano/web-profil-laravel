<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Configuration;
use App\Models\Home;
use App\Models\Major;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $configuration = Configuration::find(1);
        $home = Home::find(1);
        $socialMedia = SocialMedia::find(1);
        $majors = Major::get();
        $latestArticle = Article::latest()->paginate(6);
        return view('public.home', compact(
            'configuration',
            'home',
            'socialMedia',
            'majors',
            'latestArticle'
        ));
    }
}
