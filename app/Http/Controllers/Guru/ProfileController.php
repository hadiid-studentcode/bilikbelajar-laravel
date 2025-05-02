<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $title = 'Profile';

    public function index()
    {
        $title = $this->title;

        return view('guru.profile.index', compact('title'));
    }

    public function update(Request $request, $id)
    {
        if ($request->password !== $request->password_confirmation) {
            return back()->with('error', 'Password tidak sama');
        }
        try {
            $request->validate([
                'username' => 'required|string|max:255',
                'password' => 'required|string|confirmed',
                'password_confirmation' => 'required|string',
            ]);

            User::where('id', $id)->update([
                'username' => $request->username,
                'password' => bcrypt($request->password),
            ]);

            return back()->with('success', 'Profile Berhasil Diperbarui');
        } catch (\Throwable $th) {
            return back()->with('error', 'Profile Gagal Diperbarui');
        }
    }
}
