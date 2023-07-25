<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show()
    {
        $users = User::with('vendor', 'pegawai')->get();
        
        return view('plninternal.User.index', compact('users'));
    }

    public function create()
    {
        return view('plninternal.User.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',

        ]);
        $user = new User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'role' => $request->get('role')
        ]);
        $user->save();
   
        // Redirect ke halaman dashboard
       
        return redirect()->route('users')->with('success', 'User created successfully');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('plninternal.User.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        // $user->password = bcrypt($request->get('password'));
        $user->role = $request->get('role');
        $user->save();
        return redirect()->route('users')->with('success', 'User updated successfully');
      
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users')->with('success', 'User deleted successfully');
      
    }

    public function resetpass($id)
    {
        $user = User::find($id);
        $user->password = bcrypt("password");
        $user->save();
        return redirect()->route('users')->with('success', 'Password tereset ke "password"');
      
    }
}
