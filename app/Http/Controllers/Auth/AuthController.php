<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SignupRequest;
use App\Models\RoleUser;
use App\Models\User;
use App\Notifications\SignUpActiveWeb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    /**
     * Get SignUp View
     */
    public function getSignUp()
    {
        return Auth::check() ?  redirect()->route('posts.index') :
        view('admin.auth.signup');

    }


    /**
     *
     * SignUp user
     */
    public function signup(SignupRequest $request)
    {
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'activation_token' => Str::random(60),
        ]);
        $user->save();
        RoleUser::create([
            'user_id' => $user->id,
            'role_id' => 3
        ]);

        $user->notify(new SignUpActiveWeb($user));
        return redirect()->route('login');
    }


    /**
     *
     * Get Login View
     */
    public function getLogin()
    {
        return Auth::check()  ?  redirect()->route('posts.index') :
        view('admin.auth.login') ;

    }


    /**
     *
     * Login user
     */
    public function login(LoginRequest $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $login['active'] = 1;
        $login['deleted_at'] = null;

        if (Auth::attempt($login)) {
            return redirect()->route('posts.index');
        } else {
            return redirect()->back()->withErrors('Your account is invaild');
        }
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {

        Auth::logout();
        return redirect()->route('login');

    }

    /**
     *
     * Activate account
     */

    public function signupActivate($token)
    {

        $user = User::where('activation_token', $token)->first();
        if (!$user) {
            return 'This activation token is invalid';

        }
        $user->active = true;
        $user->activation_token = '';
        $user->save();
        return 'Your account is acctived!';
    }
}
