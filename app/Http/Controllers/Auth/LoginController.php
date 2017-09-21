<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;


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
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->hasRole('admin')) {
            return redirect('/admin');
        }

        return redirect('/');
    }

    /**
     * Redirect the user to the facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($service)
    {
        return Socialite::driver($service)->redirect();
    }

    /**
     * Obtain the user information from facebook.
     *
     * @return Response
     */
    public function handleProviderCallback($service)
    {
        $social_user = Socialite::driver($service)->user();

        $find_user = User::where('email', $social_user->email)->first();

        if ($find_user) {
            Auth::login($find_user);
        } else {
            $new_user = new User;
            $new_user->name = $social_user->name;
            $new_user->email = $social_user->email;
            $new_user->password = bcrypt($social_user->id);
            $new_user->save();

            $new_user->setMeta('social_password', $social_user->id);
            Auth::login($new_user);
        }
        return Redirect::to('/');

    }
}
