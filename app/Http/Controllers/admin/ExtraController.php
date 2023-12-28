<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Extra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ExtraController extends Controller
{
    public function index()
    {
        $pageTitle = "Ekstrakurikuler";
        $extras = Extra::latest()->get();
        if (request()->ajax()) {
            return DataTables::of($extras)->make(true);
        }
        return view('dashboard.extra', compact(['pageTitle', 'extras']));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image'      => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'name'       => 'required|min:5',
            'description'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $image = $request->image;
        $image->storeAs('/public/extra-image/' . $image->hashName());

        $extra = Extra::create([
            'image'     => $image->hashName(),
            'name'     => $request->name,
            'description'   => $request->description,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $extra
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image_edit'      =>  $request->hasFile('image_edit') ? 'image|mimes:jpg,png,jpeg,gif,svg|max:2048' : '',
            'name_edit'       => 'required|min:5',
            'description_edit'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $extra = Extra::findOrFail($id);

        if ($request->hasFile('image_edit')) {
            $image = $request->image_edit;
            $image->storeAs('/public/extra-image/' . $image->hashName());

            Storage::delete('/public/extra-image/' . $extra->image_edit);

            $extra->update([
                'image'     => $image->hashName(),
                'name'     => $request->name_edit,
                'description'   => $request->description_edit,
            ]);
        } else {
            $extra->update([
                'name'     => $request->name_edit,
                'description'   => $request->description_edit,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $extra
        ]);
    }

    public function show($id)
    {
        $extra = Extra::find($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data'    => $extra,
        ]);
    }

    public function delete($id)
    {
        $extra = Extra::find($id);
        $extra->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus!'
        ]);
    }
}
