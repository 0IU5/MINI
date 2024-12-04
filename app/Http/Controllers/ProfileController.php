<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Jika ada gambar yang diupload
        if ($request->hasFile('image')) {
            // Cek apakah pengguna sudah memiliki gambar sebelumnya
            if ($user->image && Storage::exists('public/' . $user->image)) {
                // Hapus gambar lama dari storage
                Storage::delete('public/' . $user->image);
            }

            // Simpan gambar baru ke storage (ke folder 'profile_images' dalam 'public' disk)
            $imagePath = $request->file('image')->store('profile_images', 'public');

            // Update kolom image di database dengan path gambar yang baru
            $user->image = $imagePath;
        }

        // Update data lainnya seperti name dan email
        $user->fill($request->validated());

        // Jika email berubah, set ulang email_verified_at
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Simpan perubahan ke database
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
