<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');

            });
        }

        $users = $query->latest()->paginate(10);

        $users->appends($request->all());

        $totalUsers = User::count();

        $totalAdmins = User::where('role', 'admin')->count();

        $totalNormalUsers = User::where('role', 'user')->count();

        return view('admin.users', compact(
            'users',
            'totalUsers',
            'totalAdmins',
            'totalNormalUsers'
        ));
    }


    /* ===========================
       Create User
    ============================ */

    public function create()
    {
        return view('admin.users.create');
    }


    /* ===========================
       Store User
    ============================ */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role'     => ['required', 'in:admin,user'],
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => $validated['role'],
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => "إضافة المستخدم {$user->name}",
            'karat'   => '-',
            'price'   => 0,
        ]);

        return redirect()
            ->route('admin.users')
            ->with('success', 'تم إضافة المستخدم بنجاح.');
    }


    /* ===========================
       Change User Role
    ============================ */

    public function role(User $user)
    {
        if ($user->id == auth()->id()) {
            return back()->with('error', 'لا يمكنك تغيير صلاحيتك.');
        }

        $newRole = $user->role == 'admin' ? 'user' : 'admin';

        $user->update([
            'role' => $newRole,
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => "تغيير صلاحية المستخدم {$user->name} إلى {$newRole}",
            'karat'   => '-',
            'price'   => 0,
        ]);

        return back()->with('success', 'تم تحديث الصلاحية بنجاح.');
    }


    /* ===========================
       Delete User
    ============================ */

    public function destroy(User $user)
    {
        if ($user->id == auth()->id()) {
            return back()->with('error', 'لا يمكنك حذف حسابك.');
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => "حذف المستخدم {$user->name}",
            'karat'   => '-',
            'price'   => 0,
        ]);

        $user->delete();

        return back()->with('success', 'تم حذف المستخدم.');
    }
}