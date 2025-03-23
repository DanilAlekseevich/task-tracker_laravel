<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Mail\TemporaryPasswordMail;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
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

    public function edit(User $user)
    {
        return Inertia::render('Users/Edit');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'avatar' => $user->avatar,
        ]);

        return redirect()->back()->with('success', 'Пользователь успешно обновлен.');
    }
}
