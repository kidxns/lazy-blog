<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.setting.index')->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        $psw = $request->get('password');
        $request->validate([
            'name' => ['required','string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',Rule::unique('users')->ignore($user->id)],

        ]);

        if($psw){
            $request -> validate([
                'password' => 'min:8 | confirmed',
            ]);
            $user->password = bcrypt($request->get( 'password'));
        }
        $update = $user->update([
            'name' => $request->name,
            'email' => $request->email,

        ]);
        $true = response() -> json(['true' => 'Your account is updated!']);
        $false = response() -> json(['false' => 'Something went wrong - user!']);
        return  $update ? $true : $false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $id = Auth::user()->id;
        $delete = User::findOrFail($id)->delete();
        $true = response() -> json(['true' => 'Successfully!']);
        $false = response() -> json(['false' => 'Something went wrong!']);
        return  $delete ? $true : $false;
    }
}
