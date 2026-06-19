<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::user()->hasRole('admin')) {
            return abort(403);
        }

        $query = User::with('roles');

        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('role') && $request->role != '') {
            $query->whereHas('roles', function($q) use ($request) {
                $q->where('name', $request->role);
            });
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $users = $query->latest()->paginate(10);
        $roles = Role::all();
        
        $total_users = User::count();
        $total_students = User::whereHas('roles', function($q) { $q->where('name', 'student'); })->count();
        $total_organizers = User::whereHas('roles', function($q) { $q->where('name', 'organizer'); })->count();
        $total_admins = User::whereHas('roles', function($q) { $q->where('name', 'admin'); })->count();

        return view('admin.users.index', compact('users', 'roles', 'total_users', 'total_students', 'total_organizers', 'total_admins'));
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->hasRole('admin')) {
                return redirect()->intended('admin/dashboard');
            } elseif ($user->hasRole('organizer')) {
                return redirect()->intended('organizer/dashboard');
            } else {
                return redirect()->intended('student/dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,name',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'active',
            'phone' => $request->phone,
        ]);

        $role = Role::where('name', $request->role)->first();
        $user->roles()->attach($role);

        Auth::login($user);

        if ($user->hasRole('admin')) {
            return redirect('admin/dashboard');
        } elseif ($user->hasRole('organizer')) {
            return redirect('organizer/dashboard');
        } else {
            return redirect('student/dashboard');
        }
    }

    public function store(Request $request)
    {
        if (!Auth::user()->hasRole('admin')) {
            return abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'active',
        ]);

        $role = Role::where('name', $request->role)->first();
        $user->roles()->attach($role);

        return back()->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        if (!Auth::user()->hasRole('admin')) {
            return abort(403);
        }
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        if (!Auth::user()->hasRole('admin')) {
            return abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|exists:roles,name',
            'status' => 'required|in:active,inactive,suspended',
        ]);

        $user->update($request->only('name', 'email', 'status'));

        $role = Role::where('name', $request->role)->first();
        $user->roles()->sync([$role->id]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if (!Auth::user()->hasRole('admin')) {
            return abort(403);
        }

        if ($user->id === Auth::id()) {
            return back()->with('error', 'You cannot delete yourself.');
        }

        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($request->only('name', 'email', 'phone'));

        return back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password changed successfully.');
    }
}
