<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function view()
    {
        return view('dashboard');
    }

    public function tagManagement()
    {
        $tags = Tag::all();

        return view('admin.tags.management', compact('tags'));
    }

    public function editTag($id)
    {
        $tag = Tag::find($id);

        return view('admin.tags.edit', compact('tag'));
    }

    public function updateTag(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        $tag = Tag::find($id);

        if (!$tag) {
            return redirect()->back()->with('error', 'Tag not found.');
        }

        $tag->name = $request->input('name');
        $tag->description = $request->input('description');

        $tag->save();

        return redirect()->route('tag-management')->with('success', 'Tag updated successfully!');

    }

    public function deleteTag($id)
    {
        $tag = Tag::find($id);

        $tag->delete();
        return redirect('/dashboard/tag-management')->with('succes', 'Product successfully deleted!');
    }

    public function createTag()
    {
        return view('admin.tags.create');
    }

    public function storeTag(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        $tag = Tag::create($validatedData);

        return redirect('/dashboard/tag-management')->with('success', 'Tag added successfully!');
    }

    public function accountAdministration()
    {
        $users = User::all();

        return view('admin.users.administration', compact('users'));
    }

    public function editAccount($id)
    {
        $user = User::find($id);

        return view('admin.users.edit', compact('user'));
    }

    public function updateAccount(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'last_name' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|string',
            'password' => 'string|min:8',
            'role' => 'required|string',
        ]);

        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'Tag not found.');
        }

        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');

        if ($request->input('password') !== " ") {
            $user->password = Hash::make($request->input('password'));
        }

        $user->role = $request->input('role');

        $user->save();

        return redirect()->route('account-administration')->with('success', 'Account updated successfully!');

    }

    public function deleteAccount($id)
    {
        $user = User::find($id);

        $user->delete();
        return redirect('/dashboard/account-administration')->with('succes', 'Account successfully deleted!');
    }

    public function updateAccountActive(Request $request) {

        $request->validate([
            'id' => 'required|integer',
            'active' => 'string',
        ]);


        $active = $request->active;

        if ($active === 'on') {
            $active = 1;
        } else {
            $active = 0;
        }

        // Find the product by ID
        $userToUpdate = User::find($request->id);

        // Update the private state based on the request
        $userToUpdate->active = $active;

        // Save the changes
        $userToUpdate->save();// Redirect back to the list view

        return redirect('/dashboard/account-administration');
    }

}
