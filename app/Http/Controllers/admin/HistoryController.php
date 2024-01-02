<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HistoryController extends Controller
{
    public function index()
    {
        $pageTitle = "Sejarah Sekolah";
        $history = History::find(1);
        return view('dashboard.history', compact(['pageTitle', 'history']));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'text'     => 'required|min:5',
            'title'     => 'required',
            'image'      =>  $request->hasFile('image') ? 'image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048' : '',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $history = History::findOrFail(1);

        if ($request->hasFile('image')) {
            $image = $request->image;
            $image->storeAs('/public/history-image/' . $image->hashName());

            Storage::delete('/public/history-image/' . $history->image);

            $history->update([
                'text'     => $request->text,
                'title'     => $request->title,
                'image'     => $image->hashName(),
            ]);
        } else {
            $history->update([
                'text'     => $request->text,
                'title'     => $request->title,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $history
        ]);
    }
}
