<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EditUserController extends Controller
{
    function index($id)
    {
        $user = User::find($id);

        return view('edit-user', compact('user'));
    }

    public function updateAccount(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'last_name' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|string',
            'password' => 'string|min:8',
        ]);

        $user = User::find($id);

        if ($user['id'] !== Auth::id()) {
            return redirect('/home')->with('error', 'Not allowed!');

        }

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');

        if ($request->input('password') !== " ") {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->route('home')->with('success', 'Account updated successfully!');

    }
}
