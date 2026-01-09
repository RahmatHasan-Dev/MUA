<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the user's profile.
     */
    public function edit(Request $request)
    {
        return view('edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'tgl_lahir' => ['nullable', 'date'],
            'email' => ['required', 'string', 'email', 'max:100', Rule::unique('pengguna')->ignore($user->id)],
        ]);

        $user->fill($validated);

        $user->save();

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }
}