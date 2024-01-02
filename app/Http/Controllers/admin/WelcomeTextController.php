<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\WelcomeText;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WelcomeTextController extends Controller
{

    public function index()
    {
        $pageTitle = "Sambutan";
        $welcomeText = WelcomeText::find(1);
        return view('dashboard.welcome-text', compact(['pageTitle', 'welcomeText']));
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

        $welcomeText = WelcomeText::findOrFail(1);

        if ($request->hasFile('image')) {
            $image = $request->image;
            $image->storeAs('/public/welcome-image/' . $image->hashName());

            Storage::delete('/public/welcome-image/' . $welcomeText->image);

            $welcomeText->update([
                'text'     => $request->text,
                'title'     => $request->title,
                'image'     => $image->hashName(),
            ]);
        } else {
            $welcomeText->update([
                'text'     => $request->text,
                'title'     => $request->title,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $welcomeText
        ]);
    }
}
