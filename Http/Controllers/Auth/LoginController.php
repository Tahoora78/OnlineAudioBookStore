<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/panel';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    // public function handle(Login $event)
    // {
    //     DB::table('users')->where('id', Auth::user()->id)->update([
    //         'ip' => request()->ip(),
    //         'updated_at' => date("Y-m-d H:i:s"),
    //     ]);
    // }
    

    public function username()
    {
        $identity  = request()->get('username');
        if(preg_match("/09\d{9}/",$identity)) {
            $fieldName = 'mobile';
        }else{
            $fieldName = 'email';
        }
        request()->merge([$fieldName => $identity]);
        return $fieldName;
    }
   


}
