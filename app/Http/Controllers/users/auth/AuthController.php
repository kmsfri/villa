<?php

namespace App\Http\Controllers\users\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RenterUser;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;
use Hash;
class AuthController extends Controller
{
    use AuthenticatesUsers;

    //protected $redirectTo = '/Admin/Dashboard';
    //protected $redirectPathAfterLogout = '/Login';
    protected $guard='user';

    protected $table='renter_users';
    protected $redirectTo = 'User/Dashboard';
    protected $redirectPathAfterLogout = 'User/Login';
    public function showUserLoginForm(){
        return view('user.auth.login');
    }
    public function showUserRegisterForm(){
        return view('user.auth.register');
    }
    public function showUserNewPasswordForm(){
        return view('user.auth.newpassword');
    }

    protected function guard()
    {
        return Auth::guard('user');
    }

    public function Login(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'phone'=>'required|digits:11',
                'password'=>'required',
            ]
        );

        if($validator->fails()){
            return redirect(url('User/Login'))
                ->withInput($request->input())
                ->withErrors($validator->errors())
                ->with('data','فیلد های مورد نظر را بررسی کنید');

        }
        if(Auth::guard('user')->attempt(['mobile_number' => $request->phone, 'password' => $request->password,'user_status' => 1])){
            return redirect(url('/User/Dashboard'));
        }else{
            $data="مقادیر وارد شده اشتباه می باشند";
            return redirect(url('User/Login'))
                ->withInput($request->input())->with('data', $data);
        }

    }
    public function Register(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'phone'=>'required|digits:11|unique:renter_users,mobile_number',
            ]
        );

        if($validator->fails()){
            return redirect(url('User/Register'))
                ->withInput($request->input())
                ->withErrors($validator->errors());

        }
        $randompass = rand(9999,9999999);


        try{
            $user = new RenterUser();
            $user->mobile_number = $request->phone;
            $user->user_status = 1;
            $user->password = bcrypt($randompass);

            $number = ltrim($request->phone, 0);
            if(\Helpers::sendsms($number,$randompass) == 0){
                $user->save();
                return redirect(url('User/Login'))
                    ->with('data', 'رمز عبور جدید برای شماره ی وارد شده ارسال شد، بعد از دریافت می توانید وارد شوید');
            }
            else {
                goto catch_block;
            }

        }
        catch(\Exception $e) {
            catch_block:
            return redirect()->back()->with('data','مشکلی در عملیات ثبت نام به وجود آمد، دوباره تلاش کنید');
        }

    }
    public function NewPassword(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'phone'=>'required|digits:11',
            ]
        );

        if($validator->fails()){
            return redirect(url('User/Password'))
                ->withInput($request->input())
                ->withErrors($validator->errors());

        }


        //sms to user

        $user = RenterUser::where('mobile_number',$request->phone)->where('user_status',1)->first();
        if(!isset($user)){
            //error user not exist
            return redirect()->back()
                ->withInput($request->input())
                ->with('data','این شماره در سیستم موجود نمی باشد');
        }
        $randompass = rand(9999,9999999);

        try{
            $user->password = bcrypt($randompass);

            $number = ltrim($request->phone, 0);
            if(\Helpers::sendsms($number,$randompass) == 0){
                $user->save();
                return redirect(url('User/Login'))
                    ->with('data', 'رمز عبور جدید برای شماره ی وارد شده ارسال شد، بعد از دریافت می توانید وارد شوید');
            }
            else {
                goto catch_block;
            }

        }
        catch(\Exception $e) {
            catch_block:
            return redirect()->back()->with('data','مشکلی در عملیات ثبت نام به وجود آمد، دوباره تلاش کنید');
        }

    }



    public function __construct()
    {
        $this->middleware('guest:user')->except('logout');
    }
    public function logout(Request $request)
    {
        $this->guard('user')->logout();
        $request->session()->invalidate();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect($this->redirectPathAfterLogout);
    }

}
