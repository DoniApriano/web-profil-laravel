<?php

namespace App\Http\Controllers\contributor;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $pageTitle = 'Artikel';
        $categories = Category::latest()->get();
        $articles = Article::where('user_id', Auth::user()->id)->with('category')->latest()->get();
        if (request()->ajax()) {
            return DataTables::of($articles)->make(true);
        }
        return view('dashboard.article', compact('pageTitle', 'articles', 'categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image'     => 'required|image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048',
            'title'     => 'required|unique:articles,title',
            'content' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $image = $request->image;
        $image->storeAs('/public/article/' . $image->hashName());

        $article = Article::create([
            'image' => $image->hashName(),
            'user_id'     => Auth::user()->id,
            'title'     => $request->title,
            'content'     => $request->content,
            'category_id'     => $request->category_id,
            'slug' =>  Str::slug($request->title),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $article
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image'     => $request->hasFile('image') ? 'image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048' : '',
            'title'     => 'required',
            'content' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $article = Article::find($id);

        if ($request->hasFile('image')) {
            $image = $request->image;
            $image->storeAs('/public/article/' . $image->hashName());

            Storage::delete('/public/article/' . $article->image);

            $article->update([
                'image' => $image->hashName(),
                'title'     => $request->title,
                'content'     => $request->content,
                'category_id'     => $request->category_id,
                'slug' =>  Str::slug($request->title),
            ]);
        } else {
            $article->update([
                'title'     => $request->title,
                'content'     => $request->content,
                'category_id'     => $request->category_id,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diubah!',
            'data'    => $article
        ]);
    }

    public function show($id)
    {
        $article = Article::with('category')->find($id);
        $categories = Category::get();

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil ditemukan!',
            'data'    => $article,
            'categories' => $categories,
        ]);
    }

    public function delete($id)
    {
        $article = Article::find($id);
        Storage::delete('/public/article/' . $article->image);
        $article->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil DIhapus!',
        ]);
    }
}
