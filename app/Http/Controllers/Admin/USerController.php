<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class USerController extends Controller
{
    function index() {

        $users = User::paginate(10);
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8',],
            'role_as' => ['required','integer'],
        ]);

         User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'hole_as' => $request->hole_as,
        ]);

        return redirect('/admin/users')->with('message', 'User add successfully');
    }

    function edit(int $userId) {

        $user = User::findOrFail($userId);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, int $userId)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8',],
            'role_as' => ['required','integer'],
        ]);

        User::findOrFail($userId)->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role_as' => $request->role_as,
        ]);

        return redirect('/admin/users')->with('message', 'update  successfully');
    }

    public function destroy(int $userId)
    {
         $user = User::findOrFail($userId);
         $user->delete();
         return redirect('/admin/users')->with('message', 'User Deleted');
    }
}
