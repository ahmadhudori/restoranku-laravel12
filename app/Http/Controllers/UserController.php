<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		// ambil user yang role nya bukan customer
        // $users = User::where('role_id', '!=', 4)->get();
		$users = User::whereHas('role', function ($query) {
			$query->where('role_name', '!=', 'customer');
		})->get();
		return view('admin.User.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
		$roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
		$validatedData = $request->validate([
			'fullname' => 'required|max:255',
			'username' => 'required|max:255|unique:users,username',
			'phone' => 'required',
			'email' => 'required|email|unique:users,email',
			'password' => 'required|confirmed',
			'role_id' => 'required',
		], [
			'fullname.required' => 'Nama karyawan harus diisi.',
			'username.required' => 'Username harus diisi.',
			'username.unique' => 'Username sudah digunakan.',
			'phone.required' => 'Nomor telepon harus diisi.',
			'email.required' => 'Email harus diisi.',
			'email.email' => 'Format email tidak valid.',
			'email.unique' => 'Email sudah digunakan.',
			'password.required' => 'Password harus diisi.',
			'password.confirmed' => 'Password tidak cocok.',
		]);
		$validatedData['password'] = bcrypt($validatedData['password']);

		User::create($validatedData);
		return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
		$roles = Role::all();
		return view('admin.user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
		$validatedData = $request->validate([
			'fullname' => 'required|max:255',
			'username' => 'required|max:255|unique:users,username,' . $id,
			'phone' => 'required|max:15',
			'email' => 'required|email|unique:users,email,' . $id,
			'role_id' => 'required',
			'password' => 'nullable|confirmed',
		], [
			'fullname.required' => 'Nama karyawan harus diisi.',
			'username.required' => 'Username harus diisi.',
			'username.unique' => 'Username sudah digunakan.',
			'phone.required' => 'Nomor telepon harus diisi.',
			'email.required' => 'Email harus diisi.',
			'email.email' => 'Format email tidak valid.',
			'email.unique' => 'Email sudah digunakan.',
		]);
		$user = User::findOrFail($id);
		$user->username = $validatedData['username'];
		$user->fullname = $validatedData['fullname'];
		$user->phone = $validatedData['phone'];
		$user->email = $validatedData['email'];
		$user->role_id = $validatedData['role_id'];
		if ($validatedData['password']) {
			$user->password = bcrypt($validatedData['password']);
		}
		$user->save();
		return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
		$user = User::findOrFail($id);
		$user->delete();
		return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
