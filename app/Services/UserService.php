<?php

namespace App\Services;

use App\Contracts\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Cookie;

class UserService implements UserServiceInterface
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            // return response()->json([
            //     'user' => Auth::user()
            // ]);

            $request->session()->regenerate();

            $cookie = Cookie::make(
                'laravel_session', // Nombre de la cookie (debe coincidir con config/session.php)
                session()->getId(), // Valor: ID de sesión
                config('session.lifetime'), // Tiempo de expiración (en minutos)
                config('session.path'),
                config('session.domain'),
                config('session.secure'),
                config('session.http_only'),
                false,
                config('session.same_site')
            );

            return response()->json([
                'user' => Auth::user()
            ])->withCookie($cookie);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        return response()->json(['message' => 'Logged out']);
    }

    public function checkAuth()
    {
        return response()->json(['authenticated' => Auth::check()]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'Usuario creado']);
    }

    public function getUser(Request $request)
    {
        $user = User::find($request->user()->id);
        return response()->json($user);
    }
}
