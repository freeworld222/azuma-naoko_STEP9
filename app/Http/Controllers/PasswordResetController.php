<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    public function showRequestForm()
    {
        return view('users.password-reset-request');
    }


    public function showResetForm(Request $request, string $token)
    {
        return view('users.password-reset-form', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }



    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        return back()
            ->withErrors(['email' => __($status)])
            ->onlyInput('email');
    }


    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = $password;
                $user->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')
                ->with('status', 'パスワードを変更しました。新しいパスワードでログインしてください。');
        }

        return back()
            ->withErrors(['email' => __($status)])
            ->withInput($request->only('email'));
    }
}
