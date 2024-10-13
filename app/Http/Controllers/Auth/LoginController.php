<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function authenticated()
    {
        if(Auth()->user()->role_id==2||Auth()->user()->role_id==3){
          return redirect()->route('home');
        }
       else{
// Log out the user
Auth::logout();

// Optionally, you can flash a message before redirection
// $request->session()->flash('error', 'You do not have permission to access this resource.');

// Redirect to the login page or any other page as needed
return redirect()->route('login');
        }


    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

    }
}
