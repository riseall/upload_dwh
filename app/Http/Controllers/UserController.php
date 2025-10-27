<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::all();

        return view('users.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users_dwh',
            'email' => 'required|string|email|max:255|unique:users_dwh',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
            'role' => 'required|string|exists:roles,name',
            'is_active' => 'boolean',
        ]);

        // Jika validasi gagal, kembalikan respons JSON dengan error
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $user = User::create([
                'name' => $request->nama,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_active' => $request->is_active ?? false,
            ]);

            $user->assignRole($request->input('role'));

            return response()->json([
                'success' => 'User berhasil dibuat!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal membuat user. ' . $e->getMessage(),
            ], 500);
        }
    }

    public function edit(User $user)
    {
        $userRole = $user->getRoleNames()->first();

        return response()->json([
            'user' => $user,
            'role' => $userRole,
        ], 200);
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users_dwh,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users_dwh,email,' . $user->id,
            'role' => 'required|string|exists:roles,name',
            'password' => 'nullable|string|min:8|confirmed',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $user->name = $request->nama;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->is_active = $request->is_active ?? false;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            $user->syncRoles($request->input('role'));

            return response()->json([
                'success' => 'User berhasil diubah!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal mengubah user. ' . $e->getMessage(),
            ], 500);
        }
    }
}
