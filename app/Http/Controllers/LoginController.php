<?php

namespace App\Http\Controllers;

use App\Mail\PasswordResetMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function doLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($request->only('username', 'password'))) {
            return redirect()->route('dashboard.index');
        } else {
            return redirect()->route('login')->with('message', 'The provided credentials do not match our records.')->with('status', 'error');
        }
    }

    public function forgotPassword()
    {
        return view('forgot_password');
    }

    public function doForgotPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $token = Str::random(120);
            $user->update(['password_reset_token' => $token]);
            Mail::to(request('email'))->send(new PasswordResetMail($user, $token));
            return redirect()->back()->with('message', 'Please check your inbox for reset link.')->with('status', 'success');
        } else {
            return redirect()->back()->with('message', 'Invalid Email Address.')->with('status', 'error');
        }
    }

    public function resetPassword($token)
    {

        $user = User::where('password_reset_token', $token)->first();

        if ($user) {
            return view('reset_password', array('user_id' => $user->id));
        } else {
            return redirect()->route('forgot.password')->with('message', 'Invalid Token.')->with('status', 'error');
        }
    }

    public function doResetPassword(Request $request)
    {
        $credentials = $request->validate([
            'password' => ['required', 'confirmed'],
        ]);

        $user = User::find(decrypt(request('user_id')));
        if ($user) {
            $user->update([
                'password' => bcrypt($credentials['password']),
                'password_reset_token' => NULL
            ]);
            return redirect()->route('login')->with('message', 'Login with your new password')->with('status', 'success');
        } else {
            return redirect()->route('login')->with('message', 'Something went wrong. Please try again !')->with('status', 'error');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout(); // logs out the current user using default guard

        $request->session()->invalidate();   // invalidate the session
        $request->session()->regenerateToken(); // prevent CSRF issues

        return redirect()->route('login');
    }
}
