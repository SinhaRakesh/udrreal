<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Mail\Welcome;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
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
    protected $redirectTo = '/home';

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
     * Redirect the user to the social provider's authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        Session::put('url.intended', URL::previous());

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from social provider.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        if ($user->email) {
            Auth::login($this->findOrCreateUser($user, $provider), true);

            return redirect()->intended($this->redirectTo);
        }

        return redirect('/login')->withErrors(['msg', 'Can not login without an email.']);
    }

    /**
     * find a user by name or create if doesn't exist
     * @param  [type] $user     [description]
     * @param  [type] $provider [description]
     * @return App/User           [description]
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('email', $user->email)
            ->orWhere(function ($query) use ($provider, $user) {
                $query->where('provider', $provider)
                    ->where('provider_id', $user->id);
            })->first();

        if ($authUser) {
            return $authUser;
        }

        $user = User::create([
            'name' => $user->name,
            'email' => $user->email,
            'password' => Hash::make(str_random(16)),
            'mobile' => '0000000000',
            'provider' => $provider,
            'provider_id' => $user->id,
        ]);

        Mail::to($user['email'])->send(new Welcome($user));

        return $user;
    }
}
