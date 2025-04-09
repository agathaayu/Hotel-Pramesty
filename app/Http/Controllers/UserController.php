<?php

namespace App\Http\Controllers;

use App\Models\User; // ⬅️ Tambahkan ini!
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        // dd($users); <-- HAPUS baris ini
        return view('user-management.index', compact('users'));
    }
    

    // fungsi edit, update, dst.



    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user-management.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();
    
        return redirect()->route('user.management')->with('success', 'User updated successfully');
    }
    public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('user.management')->with('success', 'User deleted successfully');
}

}
