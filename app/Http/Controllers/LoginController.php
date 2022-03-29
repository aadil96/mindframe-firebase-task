<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->auth = app('firebase.auth');
    }

    public function show()
    {
        if (session()->has('firebase_user_id')) {
            return redirect()->route('task.index');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        try {
            $s = $this->auth->signInWithEmailAndPassword($request->email, $request->password);
            session(['firebase_token' => $s->idToken()]);
            session(['firebase_user_id' => $s->firebaseUserId()]);
            session(['firebase_data' => $s->data()]);
            return redirect()->route('task.index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('login')->withErrors([
                'message' => 'Invalid email or password.',
            ]);
        }
    }

    public function logout()
    {
        $this->auth->revokeRefreshTokens(session()->get('firebase_user_id'));

        try {
            $this->auth->verifyIdToken(session('firebase_token'), true);
        } catch (\Exception $e) {
            session()->forget('firebase_user_id');
            session()->forget('firebase_token');
            session()->forget('firebase_data');
            return redirect()->route('login');
        }
    }
}
