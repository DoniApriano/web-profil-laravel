<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ContributorController extends Controller
{
    public function index()
    {
        $pageTitle = "Pengguna";
        $users = User::where('id', '!=', '1')->latest()->get();
        if (request()->ajax()) {
            return DataTables::of($users)->make(true);
        }
        return view('dashboard.contributor', compact(['pageTitle', 'users']));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|min:5',
            'email'     => 'required|email',
            'password'   => 'required',
            'level'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name'     => $request->name,
            'email'   => $request->email,
            'password'   => Hash::make($request->password),
            'level' => $request->level,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name_edit'     => 'required|min:5',
            'email_edit'     => 'required|email',
            'password_edit'   => '',
            'level'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::findOrFail($id);

        $user->update([
            'name'     => $request->name_edit,
            'email'   => $request->email_edit,
            'password'   => Hash::make($request->password_edit),
            'level' => $request->level,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $user
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data'    => $user,
        ]);
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus!'
        ]);
    }
}
