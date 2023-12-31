<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ArticleController extends Controller
{
    public function index()
    {
        $pageTitle = 'Semua Artikel';
        $categories = Category::latest()->get();
        $articles = Article::with('category', 'user')->latest()->get();
        if (request()->ajax()) {
            return DataTables::of($articles)->make(true);
        }
        return view('dashboard.all-article', compact('pageTitle', 'articles', 'categories'));
    }

    public function show($id)
    {
        $article = Article::with('category','user')->find($id);
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Ditemukan!',
            'data'  => $article
        ]);
    }

    public function delete($id)
    {
        $article = Article::find($id);
        Storage::delete('/public/article/'.$article->image);
        $article->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil DIhapus!',
        ]);
    }
}
