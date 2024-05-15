<?php

namespace App\Http\Controllers\Auth;

use App\Charts\UsersByRoleChart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Validator;

class AuthController extends Controller
{
    public function dashboard(UsersByRoleChart $userChart)
    {
        if(Auth::check()){
            $user = User::count();
            return view('dashboard', compact('user'),['chart' => $userChart->build()]);
        } 
        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    public function index(): View
    {
        return view('auth.login');
    }

    public function registration(): View
    {
        $roles = Role::all();
        return view('auth.registration', compact('roles'));
    }

    public function postLogin(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            $user = User::where("email", $request->email)->first();
            
            // $token = $user->createToken("API_TOKEN");

            // session(['accessToken' => $token->plainTextToken]);

            return redirect()->intended('dashboard')
                        ->withSuccess('You have Successfully loggedin with token');
        }

        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }

    public function postRegistration(Request $request): RedirectResponse
    {  
        // dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        $data = $request->all();
        // dd($data);
        $check = $this->create($data);

        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'role_id' =>$data['role']
      ]);
    }
    public function logout(): RedirectResponse
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}