<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        $pageTitle = 'Kategori Artikel';
        $categories = Category::latest()->get();
        if (request()->ajax()) {
            return DataTables::of($categories)->make(true);
        }
        return view('dashboard.category', compact('categories', 'pageTitle'));
    }
}
