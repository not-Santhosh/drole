<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Concurrency;

class AuthController extends Controller
{
    public function index() {
        [$departmentCount, $programmeCount] = Concurrency::run([
            fn() => \App\Models\Department::all()->count(),
            fn() => \App\Models\Programme::all()->count(),
        ]);

        return view('dashboard', [
            'departmentCount' => $departmentCount,
            'programmeCount' => $programmeCount,
        ]);
    }

    public function register()
    {
        return view('auth.register');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authLogin(LoginRequest $request)
    {
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return back()->with('error', 'Invalid Credentials');  
        }

        return redirect()->intended('/');
    }

    public function authRegister(RegisterRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        
        return redirect()->route('login')->with('success', 'Registration completed successfully');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
