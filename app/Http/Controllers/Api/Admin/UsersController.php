<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::get());
    }

    public function store(Request $request)
    {
        //this will only perform by super admin i.e user having role 1
        //role of 1 and 2 are given as option i.e. Admin and Staff respectively
        //role 0 is user so admin doesn't create user as they register themself
        $request->validate([
            'name' => ['required', 'min:5', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required']
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
            'email_verified_at' => now()
        ]);
        return response()->json(['msg' => 'User Created Success']);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function edit(User $user)
    {
        return new UserResource($user);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'min:5', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['nullable'],
            'status' => ['nullable', 'boolean']
        ]);

        $user->name = $request->name;
        $user->role = $request->role;
        if (isset($request->password)) {
            $user->password = $request->password;
        }
        if (auth()->user()->isAdmin()) {
            $user->status = $request->status;
        }
        $user->save();

        return response()->json(['msg' => 'User Updated Success']);
    }


    public function delete(User $user)
    {
        $user->delete();

        return response()->json(['msg' => 'User Deleted']);
    }

}
