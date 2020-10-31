<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignupRequest;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view,App\Models\User');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::orderBy('id', 'desc')->paginate(50);
        return view('admin.users.index', compact('users'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(SignupRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'active' => true,
            'activation_token' =>''
        ]);

        RoleUser::create([
            'user_id' => $user['id'],
            'role_id' => $request -> role
        ]);
        return $user ? view('admin.users._list',
        ['users' => User::orderBy('id','desc')->paginate(50)])
        : response() -> json(['false' => 'Something went wrong']);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usr, $id)
    {
        $this->authorize('update', $usr);
        $user = User::where('id',$id)->first();
        return view('admin.users.edit',['user' => $user])->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request)
    {
        $this->authorize('update', $user);
        $request->validate([
            'name' => ['required','string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',Rule::unique('users')->ignore($user->id)],
            'password' => 'min:8',
            'role' => 'required',
        ]);

        $update = $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),

        ]);

        RoleUser::where('user_id', $user['id'])->update(['role_id' => $request->role]);
        $true = response() -> json(['true' => 'The user was updated!']);
        $false = response() -> json(['false' => 'Something went wrong - user!']);
        return  $update ? $true : $false;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Request $request)
    {   $this->authorize('delete', $user);
        $delete = User::whereIn('id',$request->input('id'))->delete();
        $true = response() -> json(['true' => 'Successfully!']);
        $false = response() -> json(['false' => 'Something went wrong!']);
        return  $delete ? $true : $false;
    }




   /**
     * Fetch data in the table
     * @param  \Illuminate\Http\Request  $request
     * @return $user result
     */
    public function fetch_data(Request $request)
    {
        $sort_by = $request->get('column');
        $sort_type = $request->get('sort');
        $paginate = $request->get('paginate');
        $users = User::orderBy($sort_by, $sort_type)->paginate($paginate);
        return view('admin.users._list', ['users' => $users])->render();

    }


   /**
     * Search data in the table
     * @param  \Illuminate\Http\Request  $request
     * @return $users result
     */

     public function search(Request $request){

        $query = $request->get('query');
            $users = User::where('name', 'like', '%' . $query . '%')
            ->orWhere('email', 'like', '%' . $query . '%')
                ->orderBy('id', 'desc')->paginate(50);
            return view('admin.users._list', compact('users'))->render();
     }
}
