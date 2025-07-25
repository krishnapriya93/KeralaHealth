<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Captcha;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Redirect;
use Session;

// use Auth;

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
     * //@var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * //@return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginview()
    {
        return view('backend.loginpage');
    }

    public function checklogin(Request $request)
    {

       
        // $result = Auth::logoutOtherDevices($request->password);

        // Auth::logoutOtherDevices($request->get('password'));

        // dd($result);
        try {
            $validator = Validator::make(
                $request->all(),
                [
                'email' => 'required|email',
                'password' => 'required',
                'captcha' => 'required|captcha',
                ],
                [
                    'email.required' => 'The email is required.',
                    'email.email' => 'The email needs to have a valid format.',
                    'email.exists' => 'The email is not registered in the system.',

                    'password.required' => 'Password required',

                    'captcha.required' => 'captcha required',
                    'captcha.captcha' => 'Invalid captcha',
                ]
            );
            
                if ($validator->fails()) {
                    // dd($validator->errors());
                    return redirect()->route('loginview')->withInput()->withErrors($validator->errors());
                }

            $email = $request->email;
            $password = $request->password;

            $user_data = [
                'email' => $email,
                'password' => $password,
            ];
    
            if (Auth::attempt($user_data)) {

                //for prevent concurrent login
                User::where('id', Auth::user()->id)->update(['session_id' => session()->getId()]);
              
                if (Auth::user()->role_id == 1) {
                    // \LogActivity::addToLog('Master admin login.');
                    return redirect()->route('masteradminhome');
                } elseif (Auth::user()->role_id == 2) {
                    return redirect()->route('siteadminhome');
                } elseif (Auth::user()->role_id == 3) {
                    return redirect()->route('masterhome');
                } elseif (Auth::user()->role_id == 4) {
                    return redirect()->route('mediaadminhome');
                } elseif (Auth::user()->role_id == 5) {
                    return redirect()->route('blockcoordinatorhome');
                } elseif (Auth::user()->role_id == 7) {
                    return redirect()->route('acsadminhome');
                }elseif (Auth::user()->role_id == 8) {
                    return redirect()->route('officerhome');
                }elseif (Auth::user()->role_id == 9) {
                    return redirect()->route('editorhome');
                }elseif (Auth::user()->role_id == 10) {
                    return redirect()->route('publichome');
                }elseif (Auth::user()->role_id == 11) {
                    return redirect()->route('dashboarduser');
                }
            } else {
                if (Auth::user()->role_id == 10) {
                    return redirect()->route('main.publiclogin')->withErrors('Incorrect username or password');
                }else{
                    return redirect()->route('loginview')->withErrors('Incorrect username or password');

                }
            }

        } catch (ModelNotFoundException $exception) {

            \LogActivity::addToLog($exception->getMessage(), 'error');
            $data = \LogActivity::logLatestItem();

            return Redirect::back()->withInput()->withErrors('Please contact admin; the error code is ERROR'.$data->id);

        }

    }

    public function logout(Request $request)
    {

        Session::flush();

        if (Auth::check() && Auth::user()->role_id == 1) {
            Auth::logout();
            Session::flash('success', 'Logout successfully.');

            return redirect()->route('main.index');
        } else {
            Auth::logout();
            Session::flash('success', 'Logout successfully.');

            return redirect()->route('main.index');
        }
    }

    public function refreshCaptcha()
    {
        return response()->json([
            'captcha' => Captcha::img(),
        ]);
    }

    public function authenticated(Request $request, $user)
    {

        Auth::logoutOtherDevices($request->get('password'));

    }
}
