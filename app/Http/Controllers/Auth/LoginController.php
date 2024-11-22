<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Socialite;
use App\Models\User;

class LoginController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('graph')->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            $microsoftUser = Socialite::driver('graph')->user();

            // Buscar o crear el usuario en la base de datos
            $user = User::firstOrCreate(
                ['email' => $microsoftUser->getEmail()],
                [
                    'name' => $microsoftUser->getName(),
                    'password' => bcrypt('defaultpassword'),
                ]
            );

            // Iniciar sesión al usuario
            Auth::login($user, true);

            return redirect('/home');
        } catch (\Exception $e) {
            // Manejar la excepción
            return redirect('/login')->with('error', 'Error al iniciar sesión con Microsoft.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Invalida la sesión y regenera el token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
