<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UsersDatatable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{

    public function index(UsersDatatable $usersDatatable)
    {
        return $usersDatatable->render('admin.users.index');
    }


    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {

        $request->validate([
            'name' => ['required', 'min:5', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required']
        ]);

         User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'email_verified_at' => now()
        ]);
        return redirect()->route('users.index')->with('success', 'User created Success');

    }

    public function show(User $user)
    {
        return view('admin.users.view', [
            'user' => $user,
        ]);
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'min:5', 'max:255'],
            'password' => ['nullable', 'min:8'],
            'is_active' => ['nullable', 'boolean']
        ]);

        $user->name = $request->name;
        if (isset($request->password)) {
            $user->password = bcrypt($request->password);
        }
        if (auth()->user()->isAdmin()) {
            $user->status = $request->is_active;
        }
        $user->save();
        return redirect()->route('users.index')->with('success', 'User Updated Success');

    }

    public function destroy(User $user)
    {
        if (auth()->user()->isAdmin()) {
            $user->delete();
        }
        Session::flash('danger', 'User Deleted Success.');
    }
}
