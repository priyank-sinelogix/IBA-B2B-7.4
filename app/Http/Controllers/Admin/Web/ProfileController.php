<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function editPassword()
    {
        return view('admin.change-password');
    }

    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'confirmed', Password::min(8)],
        ]);

        $user = Auth::user();

        if (!Hash::check($data['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.'])->withInput();
        }

        $user->password = bcrypt($data['password']);
        $user->save();

        return back()->with('success', 'Your password has been updated.');
    }
}
