<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MajorController extends Controller
{
    public function index()
    {
        $pageTitle = "Jurusan";
        $majors = Major::latest()->get();
        if (request()->ajax()) {
            return DataTables::of($majors)->make(true);
        }
        return view('dashboard.major', compact(['pageTitle', 'majors']));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image'      => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'name'       => 'required',
            'description'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $image = $request->image;
        $image->storeAs('/public/major-image/' . $image->hashName());

        $major = Major::create([
            'image'     => $image->hashName(),
            'name'     => $request->name,
            'description'   => $request->description,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $major
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image'      =>  $request->hasFile('image') ? 'image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048' : '',
            'name'       => 'required',
            'description'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $major = Major::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->image;
            $image->storeAs('/public/major-image/' . $image->hashName());

            Storage::delete('/public/major-image/' . $major->image);

            $major->update([
                'image'     => $image->hashName(),
                'name'     => $request->name,
                'description'   => $request->description,
            ]);
        } else {
            $major->update([
                'name'     => $request->name,
                'description'   => $request->description,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $major
        ]);
    }

    public function show($id)
    {
        $major = Major::find($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data'    => $major,
        ]);
    }

    public function delete($id)
    {
        $major = Major::find($id);
        Storage::delete('/public/major-image/' . $major->image);
        $major->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus!'
        ]);
    }
}
