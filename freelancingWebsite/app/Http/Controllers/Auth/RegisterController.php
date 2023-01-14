<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Freelancer;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    protected $redirectTo=RouteServiceProvider::LOGIN;
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:freelancer');

    }


    public function setRedirectTo($redirectTo)
    {
         $this->redirectTo=$redirectTo;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {


        $table="users";
        if($data['register']=='freelancer'){
            $table="freelancers";
        }
        return Validator::make($data, [

            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', "unique:$table"],
            'country' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],
        [
            'fname.required' => 'first Name is required',
            'lname.required' => 'family Name is required',
            'password.required' => 'Password is required',
            'password.min' => 'Password minimum 8 char',
            'password.confirmed' => 'Password confirmed wrong',
            'country.required' => 'country is required',
            'email.required' => 'email is required',
            'email.email' => 'should be in email format',
            'email.unique' => 'this email is register',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */


    public function showRegistrationForm()
    {
        $countries=Country::all();
        return view('auth.register', compact('countries'));
    }

    protected function create(array $data)
    {
        if($data['register']=='freelancer'){

             $this->setRedirectTo( RouteServiceProvider::FLOGIN);
            return Freelancer::create([
                'name' => $data['fname'].' '. $data['lname'],
                'email' => $data['email'],
                'country' => $data['country'],
                'password' => Hash::make($data['password']),
            ]);


        }else{

        $this->setRedirectTo( RouteServiceProvider::LOGIN);


        return User::create([
            'name' => $data['fname'].' '. $data['lname'],
            'email' => $data['email'],
            'country' => $data['country'],
            'password' => Hash::make($data['password']),
        ]);

    }
}
}
