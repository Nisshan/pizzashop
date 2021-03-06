<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Request;

class UsersController extends Controller
{
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
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $user->name = $request->name;
        if (isset($request->password)) {
            $user->password = $request->password;
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
