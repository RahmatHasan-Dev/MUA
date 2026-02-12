<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pengguna',
            'no_hp' => 'required|string|max:20',
            'tgl_lahir' => 'required|date',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Ambil domain dari email
        $email = $request->email;
        $domain = substr(strrchr($email, "@"), 1);

        // Tentukan role berdasarkan domain
        $role = 'user'; // Default role untuk email umum
        if (in_array($domain, ['mua.com', 'mua.co.id'])) {
            $role = 'admin'; // Role admin untuk email resmi
        }

        // Buat user baru
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'tgl_lahir' => $request->tgl_lahir,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        // Login otomatis
        Auth::login($user);

        // Redirect berdasarkan role
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.home');
    }
}