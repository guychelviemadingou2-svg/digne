<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Afficher le profil
    public function show()
    {
        $user = auth()->user();
        return view('profile.show', compact('user'));
    }

    // Afficher le formulaire de modification
    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    // Mettre à jour le profil
    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($validated);

        return redirect()->route('profile.show')
                       ->with('success', 'Profil mis à jour avec succès!');
    }

    // Afficher le formulaire de changement de mot de passe
    public function editPassword()
    {
        return view('profile.edit-password');
    }

    // Mettre à jour le mot de passe
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        auth()->user()->update([
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->route('profile.show')
                       ->with('success', 'Mot de passe mis à jour avec succès!');
    }
}
