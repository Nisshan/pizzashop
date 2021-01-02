<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        return view('frontend.pages.profile');
    }

    public function changeName(Request $request)
    {
        $request->validate(['name' => ['required', 'min:5']]);
        auth()->user()->update([
            'name' => $request->name
        ]);
        return back()->with('success', 'Name update Success');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (!(Hash::check($request->current_password, auth()->user()->password))) {
            return back()->with('danger', 'Current Password didnt match');
        } else {
            auth()->user()->update([
                'password' => $request->password
            ]);
            return back()->with('success', 'password changed');

        }

    }
}
