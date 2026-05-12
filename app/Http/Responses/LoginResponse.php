<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = Auth::user();

        $redirect = match ($user->role) {
            'admin'   => route('dashboard'),
            'dokter'  => route('dashboard'),
            'perawat' => route('dashboard'),
            'pmik'    => route('dashboard'),
            default   => route('dashboard'),
        };

        return redirect($redirect);
    }
}
