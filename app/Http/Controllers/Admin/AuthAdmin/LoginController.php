<?php

namespace App\Http\Controllers\Admin\AuthAdmin;

use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/management/dashboard';
    
    protected $redirectPathAfterLogout='/management/login';



    public function showLoginForm()
    {
        return view('admin.auth.login');
    }


    public function username()
    {
        return 'user_name';
    }

    protected $registerView='admin.auth-admin.register';
    protected function guard()
    {
        return Auth::guard('admin');
    }

    protected $table='admin_users';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
}
