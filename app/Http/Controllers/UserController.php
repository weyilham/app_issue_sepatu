<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.users.index', [
            'users' => User::all()
        ]);
    }

    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        $exists = User::where('email', $email)->exists();

        return response()->json(['exists' => $exists]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.users.create', [
            'level' => Role::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validate = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|min:3|max:255|unique:users',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255',
            'role_id' => 'required|exists:roles,id',

        ]);

        
        if ($request->password != $request->password_confirmation) {
            return redirect('/users/create')->with('error_password', 'Password Tidak Sesuai');
        } else {
            
            $validate['password'] = bcrypt($validate['password']);
            $validate['image'] = 'default.jpg';
        }
        
        // dd($validate);
        // dd($validate);
        User::create($validate);
        return redirect('/users')->with('success', 'Data Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        $level = Role::all();
        return view('dashboard.users.edit', [
            'user' => $user,
            'level' => $level
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $validate = $request->validate([
            'name' => 'nullable|max:255',
            'username' => 'nullable|min:3|max:255',
            'email' => 'nullable|email:dns|unique:users,email,' . $user->id,
            'password' => 'nullable|min:5|max:255',
            'role_id' => 'required',

        ]);


        if ($request->password != $request->password_confirmation) {
            return redirect('/users/create')->with('error_password', 'Password Tidak Sesuai');
        } else {

            $validate['password'] = bcrypt($validate['password']);
            $validate['image'] = 'default.jpg';
        }



        // dd($validate);
        $user->update($validate);
        return redirect('/users')->with('success', 'Data Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $user->delete();
        return response()->json(['success' => 'Data Berhasil']);
    }
}
