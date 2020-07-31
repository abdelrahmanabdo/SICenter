<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showLoginForm()
    {
        return view('pages.login');
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

    public function login(Request $request)
    {

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if(\Auth::attempt(['mobile' => $request->mobile, 'password' => $request->password])) {
            $user = User::where(['mobile' => $request->mobile])
                         ->select(['is_active','is_subscribed'])
                         ->first();
            if($user->is_active == 1 && $user->is_subscribed == 1) {
                    return redirect('/');
            }else{
                if($user->is_active == 1 ){
                    $notification = array(
                        'message' => 'هذا الحساب غير متاح برجاء التواصل مع المدرسات لمعرفة السبب' ,
                        'alert-type' =>'error'
                    );
                }else{
                    $notification = array(
                        'message' => 'لم يتم الموافقة علي حسابك من قبل المدرس بعد' ,    
                        'alert-type' =>'error'
                    );
                }
                $this->guard()->logout();
                return back()->with($notification);
            }
        } else {
            $this->incrementLoginAttempts($request);
            $notification = array(
                'message' => ' رقم الموبايل او كلمة السر غير صحيحين' ,               
                'alert-type' =>'error'
            );
            return redirect('/login')->with($notification);
        }

        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }
}
