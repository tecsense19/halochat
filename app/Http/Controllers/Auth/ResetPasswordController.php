<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    //
    public function showResetForm(Request $request, $token = null)
{
    return view('auth.passwords.reset')->with(
        ['token' => $token, 'email' => $request->email]
    );
}

public function reset(Request $request)
{
    $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required|confirmed|min:8',
    ]);

    // Verify the user's current password here before allowing the reset

    $response = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
        $user->forceFill([
            'password' => Hash::make($password)
        ])->save();
    });

    if ($response === Password::PASSWORD_RESET) {
        return redirect('/dashboard')->with('status', 'Your password has been reset!');
    } else {
        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => trans($response)]);
    }
}

}
