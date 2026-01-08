<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CustomerProfile;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone_number' => ['required', 'string',  'regex:/^[0-9]+$/', 'min:10','max:15' ],
            'driver_license_number' => ['required', 'string', 'max:50', 'unique:'.CustomerProfile::class],
            'license_expiry_date' => ['required', 'date', 'after:today'],
            'date_of_birth' => ['required', 'date', 'before:-18 years'],
            'address' => ['required', 'string', 'max:500'],
        ]);

        $user = User::create([
            'full_name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number'=>$request->phone_number,
            'role'=>'customer'
        ]);

        CustomerProfile::create([
        'user_id'=>$user->id,
        'driver_license_number'=>$request->driver_license_number,
        'license_expiry_date'=>$request->license_expiry_date,
        'date_of_birth'=>$request->date_of_birth,
        'address'=>$request->address,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
