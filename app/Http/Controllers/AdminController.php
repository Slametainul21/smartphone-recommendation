<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Smartphone;
use App\Models\Specification;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        $admin = Admin::where('username', $request->username)->first();

        if ($admin && $admin->verifyPassword($request->password)) {
            Session::put('admin_id', $admin->id);
            Session::put('admin_name', $admin->name);
            return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
        }

        return back()->with('error', 'Username atau password salah!');
    }

    public function dashboard()
    {
        // Statistik untuk dashboard
        $stats = [
            'total_smartphones' => Smartphone::count(),
            'active_smartphones' => Smartphone::active()->count(),
            'total_categories' => Category::count(),
            'total_specifications' => Specification::count()
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('admin.login')->with('success', 'Logout berhasil!');
    }
}
