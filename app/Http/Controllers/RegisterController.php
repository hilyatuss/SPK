<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view ('user.register');
    }
    public function store(Request $request)
    {   
        $request->validate([
            'nama_user' => 'required',
            'username' => 'required|unique:tb_user',
            'password' => 'required|min:8|confirmed',
        ], [
            'nama_user.required' => 'Nama user harus diisi',
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username harus unik',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Password tidak sama dengan konfirmasi password'
        ]);
        $user = new User($request->all());
        $user->password = Hash::make($request->password);
        $user->level = "mhs";
        $user->status_user = "1";
        $user->save();
        return redirect('login')->with('message', 'Data berhasil ditambah!');
    }
}
