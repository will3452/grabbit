<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\AuthServiceProvider;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
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

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'exists:users,email'],
            'password' => ['required']
            ]);


        $user = User::whereEmail($data['email'])->first();

        if (Hash::check($data['password'], $user->password)) {

            if ($user->approved_at == null) {
                toast('User is not yet approved by admin.', 'danger');
                return back();
            }

            if ($user->blocked_at != null) {
                toast('User is blocked by admin.', 'danger');
                return back();
            }
            auth()->login($user);

            return redirect()->to('/home');
        } else {
            toast('Invalid Credentials.', 'danger');
            return back();
        }




    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
