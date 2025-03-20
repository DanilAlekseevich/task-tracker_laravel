<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Mail\TemporaryPasswordMail;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Inertia\Inertia;

final class UserController extends Controller
{
    public function create()
    {
        return Inertia::render('Users/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        $tempPassword = Str::random(10);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($tempPassword),
            'tmp_password' => $tempPassword,
            'force_password_change' => true,
        ]);

        $userRole = Role::where('name', 'user')->first();
        if ($userRole) {
            $user->roles()->attach($userRole);
        }

        Mail::to($user->email)->send(new TemporaryPasswordMail($tempPassword));

        return redirect()->back()
            ->with('success', 'Пользователь успешно создан.');
    }
}
