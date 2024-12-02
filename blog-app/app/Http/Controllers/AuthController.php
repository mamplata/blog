<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function index()
    {
        return view('login');
    }

    public function login(Request $request)

    {
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::where('email',  $request->email)->where('password',  $request->password)->first();

        if ($user) {
            session(['logged_in' => true, 'user_id' => $user->id, 'name' => $user->name]);
            $userName = session('name');
            return redirect()->route('blog')->with('success', 'Welcome, ' . $userName);
        } else {
            return redirect()->route('login')->with('error', 'Invalid email or password.');
        }
    }

    public function logout(Request $request)
    {
        session()->forget(['logged_in', 'user_id', 'name']);
        return redirect()->route('login')->with('error', 'Logout successfully.');
    }
}
