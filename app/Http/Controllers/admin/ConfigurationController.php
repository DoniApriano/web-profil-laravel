<?php

namespace App\Http\Controllers\admin;

use App\Models\Configuration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ConfigurationController extends Controller
{
    public function index()
    {
        $pageTitle = "Konfigurasi";
        $config = Configuration::find(1);
        return view('dashboard.configuration', compact(['pageTitle', 'config']));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'icon' => $request->hasFile('icon') ? 'image|mimes:jpg,png,jpeg,gif,svg|max:2048' : '',
            'title'     => 'required|min:5',
            'phone_number'   => 'required|numeric',
            'email'   => 'required|email',
            'address'   => 'required',
            'open_hours'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $config = Configuration::findOrFail(1);

        if ($request->hasFile('icon')) {
            $icon = $request->icon;
            $icon->storeAs('/public/icon/' . $icon->hashName());

            Storage::delete('/public/icon/' . $config->icon);

            $config->update([
                'icon'     => $icon->hashName(),
                'title'     => $request->title,
                'phone_number'     => $request->phone_number,
                'email'     => $request->email,
                'address'     => $request->address,
                'open_hours'     => $request->open_hours,
            ]);
        } else {
            $config->update([
                'title'     => $request->title,
                'phone_number'     => $request->phone_number,
                'email'     => $request->email,
                'address'     => $request->address,
                'open_hours'     => $request->open_hours,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diudapte!',
            'data'    => $config
        ]);
    }
}
