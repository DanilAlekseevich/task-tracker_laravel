<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return Inertia::render('Auth/Login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            if ($user->force_password_change) {
                return redirect()->route('password.change');
            }

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Неверные учетные данные.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function showChangePasswordForm()
    {
        return Inertia::render('Auth/ChangePassword');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Проверяем, совпадает ли текущий пароль с временным
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Неверный текущий пароль.']);
        }

        // Обновляем пароль и сбрасываем флаг
        $user->update([
            'password' => Hash::make($request->new_password),
            'force_password_change' => false,
            'temp_password' => null, // Очищаем временный пароль
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Пароль успешно изменен.');
    }
}
