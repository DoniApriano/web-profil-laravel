<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
    public function index()
    {
        $pageTitle = "Tentang";
        $about = About::find(1);
        return view('dashboard.about', compact(['pageTitle', 'about']));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'text'     => 'required|min:5',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $about = About::findOrFail(1);

        $about->update([
            'text'     => $request->text,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diudapte!',
            'data'    => $about
        ]);
    }
}
