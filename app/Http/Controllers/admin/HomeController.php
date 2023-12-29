<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        $mainPage = Home::find(1);
        $pageTitle = "Halaman Utama";
        return view('dashboard.main-page', compact(['mainPage', 'pageTitle']));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'unage' => $request->hasFile('image') ? 'image|mimes:jpg,png,jpeg,gif,svg,webp|max:2048' : '',
            'primary_quote'     => 'required',
            'secondary_quote'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $home = Home::findOrFail(1);

        if ($request->hasFile('image')) {
            $image = $request->image;
            $image->storeAs('/public/home/' . $image->hashName());

            Storage::delete('/public/home/' . $home->icon);

            $home->update([
                'image'     => $image->hashName(),
                'primary_quote'     => $request->primary_quote,
                'secondary_quote'     => $request->secondary_quote,
            ]);
        } else {
            $home->update([
                'primary_quote'     => $request->primary_quote,
                'secondary_quote'     => $request->secondary_quote,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diudapte!',
            'data'    => $home
        ]);
    }
}
