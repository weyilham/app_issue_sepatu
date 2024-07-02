<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(Request $request, $username)
    {
        $data = User::where('username', $username)->first();
        $role = [
            'admin' => 'Admin',
            'laboratorium' => 'Laboratorium',
            'quality-control' => 'Quality Control',
        ];
        // dd($data);
        return view('dashboard.profile.index', ['user' => $data, 'role' => $role]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'level' => 'required',
            'image' => 'image|file|max:1024',
        ]);

        if ($request->hasFile('image')) {
            $oldImage = public_path('storage/' . $request->image);

            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
            $data['image'] = $request->file('image')->store('profile');
        }

        // if($data['level'] == null){}

        // dd($data);
        User::where('id', $request->id)->update($data);
        $user = User::find($request->id);
        return response()->json(['success' => 'Data Berhasil di Update', 'user' => $user]);
    }

    public function changePassword(Request $request, $username)
    {
        $user = User::where('username', $username)->first();
        return view('dashboard.profile.changePassword', ['user' => $user]);
    }

    public function updatePassword(Request $request, $id)
    {
        $user = User::find($id);
        $validate = $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:3',
            'password_confirmation' => 'required|same:password'
        ], [
            'required' => ':attribute tidak boleh kosong',
            'min' => ':attribute minimal :min karakter',
            'same' => 'Konfirmasi Password tidak sama',
        ],);

        $passwordCheck = Hash::check($request->old_password, $user->password);
        if (!$passwordCheck) {
            return back()->with('loginError', 'loginError');
        }

        if ($request->password != $request->password_confirmation) {
            return back()->with('passwordError', 'passwordError');
        } else {
            $user->password = Hash::make($request->password);
            $user->save();
            // dd($user);
            // redirect()->back()->with('Passwordsuccess', 'success');
            return  redirect('/profile/' . $user->username)->with('passwordSuccess', 'success');
        }
    }
}
