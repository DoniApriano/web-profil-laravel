<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Article;
use App\Models\Configuration;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->get();
        $configuration = Configuration::find(1);
        $socialMedia = SocialMedia::find(1);
        $about = About::find(1);
        return view('public.article', compact(
            'articles',
            'configuration',
            'socialMedia',
            'about'
        ));
    }

    public function show($slug)
    {
        $article = Article::where('slug',$slug)->first();
        $configuration = Configuration::find(1);
        $socialMedia = SocialMedia::find(1);
        $about = About::find(1);
        return view('public.article-detail', compact(
            'article',
            'configuration',
            'socialMedia',
            'about'
        ));
    }
}
