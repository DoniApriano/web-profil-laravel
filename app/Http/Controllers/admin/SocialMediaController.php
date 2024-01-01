<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SocialMediaController extends Controller
{
    public function index()
    {
        $pageTitle = "Tentang";
        $socialMedia = SocialMedia::find(1);
        return view('dashboard.social-media', compact(['pageTitle', 'socialMedia']));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'instagram'     => 'required',
            'youtube'     => 'required',
            'facebook'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $socialMedia = SocialMedia::findOrFail(1);

        $socialMedia->update([
            'instagram'     => $request->instagram,
            'facebook'     => $request->facebook,
            'youtube'     => $request->youtube,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $socialMedia
        ]);
    }
}
