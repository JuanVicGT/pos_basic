<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Auth::user());

        $users = User::latest()->get();
        return view('backend.user.all_user', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $this->authorize('create', Auth::user());

        return view('backend.user.add_user');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        //
        $this->authorize('create', Auth::user());

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'name' => $request->name,
            'phone' => $request->phone,
            'printer' => $request->printer,
            'admin' => $request->admin,
            'password' => Hash::make('RUDEMAX2024')
        ]);
        $user->assignRole($request->role);

        $notification = array(
            'message' => 'User Insert Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.user')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
        $this->authorize('view', Auth::user());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $this->authorize('update', Auth::user());

        $user = User::findOrFail($id);
        $role = $user->getRoleNames()[0] ?? null;

        return view('backend.user.edit_user', compact('user', 'role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request)
    {
        $this->authorize('update', Auth::user());

        $user = User::findOrFail($request->id);
        
        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'name' => $request->name,
            'phone' => $request->phone,
            'printer' => $request->printer,
            'admin' => $request->admin
        ]);

        $user->syncRoles([$request->role]);

        $notification = array(
            'message' => 'User Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
        $this->authorize('delete', Auth::user());
    }
}
