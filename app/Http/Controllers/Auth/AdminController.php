<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Admin;

class AdminController extends Controller
{

    public function showLoginForm(){
        return view('auth.adminlogin');
    }

    public function login(Request $request){
        // Validation
        $this->validateLogin($request);

        // Attempt login
        if ($this->guard()->attempt($this->credentials($request), $request->remeber)) {
            // If successful 
            return redirect()->intended(route('adminDashboard'));
        }
        // If unsuccessful
        return $this->sendFailedLoginResponse($request);

        // return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    protected function validateLogin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);
    }

    protected function credentials(Request $request){
        return $request->only('email', 'password');
    }

    protected function guard(){
        return Auth::guard('admin');
    }
    
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }
}