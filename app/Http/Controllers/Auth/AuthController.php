<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Validator;
use Auth;
use Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectPath = '/admin/';
    protected $homePath = '/admin/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function authenticate()
    {
        if (Auth::attempt(['login' => Request::get('login'), 'password' => Request::get('password')])) {
            return redirect()->intended($this->redirectPath);
        }

        return back()->withInput()->withErrors(trans('content.bad_password'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'login' => 'required|max:255',
            'password' => 'required|confirmed|min:4',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'login' => $data['login'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
