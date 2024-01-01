<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $pageTitle = "Profil";
        $profile = Profile::find(1);
        return view('dashboard.profile', compact(['pageTitle', 'profile']));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'accreditation'     => 'required|max:1',
            'npsn'     => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $profile = Profile::findOrFail(1);

        $profile->update([
            'name'     => $request->name,
            'accreditation'     => $request->accreditation,
            'npsn'     => $request->npsn,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diudapte!',
            'data'    => $profile
        ]);
    }
}
