<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DetailExtra;
use App\Models\Extra;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class GalleryController extends Controller
{
    public function index()
    {
        $pageTitle = "Galeri";
        $galleries = DetailExtra::with('extra', 'gallery')->latest()->get();
        $extras = Extra::latest()->get();
        if (request()->ajax()) {
            return DataTables::of($galleries)->make(true);
        }
        return view('dashboard.gallery', compact(['pageTitle', 'galleries', 'extras']));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image'        => 'required|image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048',
            'extra'        => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $image = $request->image;
        $image->storeAs('/public/gallery/' . $image->hashName());

        $gallery = Gallery::create([
            'image'     => $image->hashName(),
        ]);

        $detail_extra = DetailExtra::create([
            'extra_id'     => $request->extra,
            'gallery_id'     => $gallery->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
        ]);
    }

    public function delete($id)
    {
        $gallery = Gallery::find($id);
        Storage::delete('/public/gallery/' . $gallery->image);
        $gallery->delete();

        $detail_extra = DetailExtra::find($id);
        $detail_extra->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus!',
        ]);
    }
}
