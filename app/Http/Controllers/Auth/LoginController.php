<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    /**
     * show admin login page
     * @since 1.0.0
     * */
    public function showAdminLoginForm(){
        /**

         * @get('/login/admin')
         * @name('admin.login')
         * @middlewares(web, guest, guest:admin)
         */
        return view('auth.admin.login');
    }
    /**
     * admin login system
     * */
    public function adminLogin(Request $request)
    {
        /**

         * @post('/login/admin')
         * @name('')
         * @middlewares(web, guest, guest:admin)
         */
        $this->validate($request, [
            'username'   => 'required|string',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->route('admin.home');
        }
        return back()->with([
            'msg' => 'Username Or Password Doest Not Matched !!!',
            'type' => 'danger'
        ]);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        /**

         * @get('/login')
         * @name('frontend.pages.login')
         * @middlewares(web, globalVariable, guest, guest:admin)
         */
        return view('frontend.pages.login');
    }

}
