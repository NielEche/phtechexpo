<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Mail\WelcomeEmail;
use App\Mail\ExhibitorWelcomeEmail;
use Illuminate\Support\Facades\Mail;

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
        ]);

        $user = User::create([
            'name' => $request->name,
            'role' => $request->role,
            'booth' => $request->booth,
            'job' => $request->job,
            'industry' => $request->industry,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'age' => $request->age,
            'referral' => $request->referral,
            'reasons_attending' => $request->reasons_attending,
            'interest' => $request->interest,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));


        Auth::login($user);

        // Determine if the user is an exhibitor
        if ($request->input('role') === 'exhibitor') {
            // Send email to exhibitor with booth details attached
            Mail::to($request->input('email'))->send(new ExhibitorWelcomeEmail($user->booth));
        } else {
            // Send the default welcome email
            Mail::to($request->input('email'))->send(new WelcomeEmail());
        }

        return redirect()->route('successReg')->with('success', 'Thank you for registering for Port Harcourt Tech Expo. We are thrilled to have you join us for this exciting event.');
    }
}
