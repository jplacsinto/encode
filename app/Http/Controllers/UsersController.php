<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

use Gate;

class UsersController extends Controller
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
    public function index(Request $request)
    {
        $search = $request->get('search', null);

        $col = $request->get('col', 'id');

        $sort = $request->get('sort', 'desc');

        $rows = $request->get('rows', 10);

        $users = new User;

        if(!is_null($search)){
            $users = $users->where('name', 'LIKE', "%{$search}%")->orWhere('email', 'LIKE', "%{$search}%");
        }

        $users = $users->orderBy($col, $sort)->paginate($rows);

        return view('modules.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('modules.users.create')->with([
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

        $user = User::create($request->all());

        $user->roles()->attach($request->roles);

        return redirect()->route('users.index')->with('message', 'New user created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        /*if(Gate::denies('edit-users')){
            return redirect()->route('users.index');
        }
*/
        $roles = Role::all();

        return view('modules.users.edit')->with([
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        if(!$request->has('active')) $request->merge(['active' => 0]);

        $user->roles()->sync($request->roles);

        $user->update($request->all());

        return redirect()->back()->with('success', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->delete();

        return redirect()->back()->with('message', 'User successfully deleted');
    }
}
