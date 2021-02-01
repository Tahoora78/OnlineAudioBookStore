<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;

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

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/panel';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // return Validator::make($data, [
        //     'name' => 'required|string|max:255',
        //     'username' => 'required|max:255',
        //     'password' => 'required|string|min:4|max:100|confirmed',
        //     'password_confirmation' =>'required',
        // ],
        // [
        //     'password_confirmation.required' => 'تکرار رمز عبور با رمز عبور یکسان نیست',
        //     'password.confirmed' => 'لطفا تکرار رمز عبور خود را وارد کنید',
        //     'password.max' => 'طول رمز عبور باید کمتر از 100 کاراکتر باشد',
        //     'password.min' => 'طول رمز عبور باید بیشتر از 4 کاراکتر باشد',
        //     'password.required' => 'لطفا رمز عبور خود را وارد کنید',
        //     'username.required' => 'لطفا شماره همراه خود را وارد کنید',
        //     'username.max' => 'طول شماره همراه و یا پست الکترونیکی باید کمتر از 255 کاراکتر باشد',
        //     'name.max' => 'طول نام و نام خانوادگی باید کمتر از 100 کاراکتر باشد',
        //     'name.min' => 'طول نام و نام خانوادگی باید بیشتر از 5 کاراکتر باشد',
        //     'name.string' => 'نام و نام خانوادگی باید از نوع متن باشد',
        //     'name.required' => 'لطفا نام و نام خانوادگی خود را وارد کنید',
        // ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return null;
        // return User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => bcrypt($data['password']),
        // ]);
    }
}
