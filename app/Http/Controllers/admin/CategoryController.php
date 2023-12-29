<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $category = Category::create([
            'name'     => $request->name,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $category
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name_edit'       => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $category = Category::find($id);

        $category->update([
            'name'     => $request->name_edit,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $category
        ]);
    }

    public function show($id)
    {
        $category = Category::find($id);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil ditemukan!',
            'data'    => $category
        ]);
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil DIhapus!',
        ]);
    }
}
