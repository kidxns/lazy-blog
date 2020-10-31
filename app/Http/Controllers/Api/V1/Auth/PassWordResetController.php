<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordResetRequest as PswResetRequest;
use App\Models\PasswordReset;
use App\Models\User;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PassWordResetController extends Controller
{
    /**
     *  Create
     * @param $request
     */

    public function create(Request $request)
    {

        $request->validate([
            'email' => 'required|string|email',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'We cant find the e-mail address!'], 404);
        }

        $pswReset = PasswordReset::updateOrCreate(
            ["email" => $user->email],
            [
                'email' => $user->email,
                'token' => Str::random(60),
            ]);
        if ($user && $pswReset) {
            $user->notify(
                new PasswordResetRequest($pswReset->token)

            );
        }
        return response()->json([
            'message' => 'We have e-mailed your password reset link!',
        ]);
    }

    /**
     *  Find
     * @param $request
     */
    public function find($token)
    {
        $pswReset = PasswordReset::where('token', $token)->first();
        if (!$pswReset) {
            return response()->json([
                'message' => 'This password reset token is invalid.',
            ], 404);
        }

        if (Carbon::parse($pswReset->updated_at)->addMinutes(720)->isPast()) {
            $pswReset->delete();
            return response()->json([
                'message' => 'This password reset token is invalid.',
            ], 404);
        }
        return response()->json($pswReset);
    }


    /**
     *  Reset
     * @param $request
     */
    public function reset(PswResetRequest $request)
    {
        $pswReset = PasswordReset::where([
            ['token', $request->token],
            ['email', $request->email],
        ])->first();

        if (!$pswReset) {
            return response()->json([
                'message' => 'This password reset token is invalid.',
            ], 404);
        }

        $user = User::where('email', $pswReset->email)->first();
        if (!$user) {
            return response()->json(['message' => "We can't find a user with that e-mail address."], 404);
        }
        $user->password = bcrypt($request->password);
        $user->save();
        $pswReset->delete();
        $user->notify(new PasswordResetSuccess($pswReset));
        return response()->json($user);
    }

}
