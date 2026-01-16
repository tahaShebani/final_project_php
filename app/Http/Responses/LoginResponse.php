<?php

namespace App\Http\Responses;

use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();

        if (strtolower($user->role) === 'admin') {
            // ✅ توجيه الأدمن إلى لوحة Filament
            return redirect()->route('filament.admin.pages.dashboard');
        }

        // ✅ المستخدم العادي إلى الـ Dashboard
        return redirect()->route('dashboard');
    }
}
