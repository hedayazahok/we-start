<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:freelancer')->except('logout');
    }





public function showFreelancerLoginForm(){
return view('auth.freelancerLogin');
}

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ],[
            'required'=>'this input is required',
            'email.exists'=>'this email does not  register',
        ]);

        if (Auth::attempt($request->only(['email','password']), $request->get('remember'))){
            if(Auth::user()->type=='admin'){
            return redirect()->route('admin.dashboard');

        } if(Auth::user()->type=='client'){
            return redirect()->route('client.profile');
        }

        }





        return back()->withInput($request->only('email', 'remember'));
    }


    public function loginFreelancer(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ],[
            'required'=>'this input is required',
            'email.exists'=>'this email does not  register',
        ]);

        if (Auth::guard('freelancer')->attempt($request->only(['email','password']), $request->get('remember'))){
            return redirect()->route('freelancer.dashboard');
        }

        return back()->withInput($request->only('email', 'remember'));
    }







    public function logout()
    {

        //Auth::logout();
        Auth::guard('freelancer')->logout();

        return redirect('login');
    }

    protected function authenticated() {
        if (Auth::check()) {
            if(Auth::user()->type=='admin'){
                return redirect()->route('admin.dashboard');

            } if(Auth::user()->type=='client'){
                return redirect()->route('client.profile');
            }
        }
        if(Auth::guard('freelancer')->check()){
            return redirect()->route('freelancer.dashboard');


        }
    }

/*
protected function authenticated(Request $request, $user)
{
       if(Auth::user()->type == 'admin'&& Auth::attempt($request->only(['email','password']), $request->get('remember')))
        {
               return redirect()->route('admin.dashboard');
        }
        if(Auth::guard('freelancer')->attempt($request->only(['email','password']), $request->get('remember'))){
        return redirect()->route('freelancer.profile');
    }
    if(Auth::user()->type == 'client'&& Auth::attempt($request->only(['email','password']), $request->get('remember')))
    {
           return redirect()->route('client.profile');
    }

    }*/

}
