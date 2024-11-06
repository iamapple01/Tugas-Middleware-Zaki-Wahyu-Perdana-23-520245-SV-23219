<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class LoginRegisterController extends Controller
{
    /**
     * Instantiate a new LoginRegisterController instance
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'dashboard']);
    }
    /**
     * Display a registration form.
     * 
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('auth.register');
    }
    /**
     * Store a new user.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        
        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('dashboard')
            ->withSuccess('You have successfully registered & logged in!');
        
    }
    /**
     * Display a login form.
     * 
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('auth.login');
    }
    /**
     * Authenticate a user.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')
                ->withSuccess('You have successfully logged in!');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ])->onlyInput('email');
    }
    /**
     * Display a dashboard to authenticated users.
     * 
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        if (Auth::check()) {
            return redirect()->route('buku');
        }
        return redirect()->route('login')
            ->withErrors([
                'email' => 'Please login to access the dashboard.'
            ])->onlyInput('email');
    }
    /**
     * Log out a user from application.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out! successfully.');
    }
}
