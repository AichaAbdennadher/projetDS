<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'aa_email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink(
            $request->only('aa_email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('success', 'We have emailed your password reset link.');
        }

        return back()->withInput($request->only('aa_email'))
                     ->withErrors(['aa_email' => __($status)]);
    }
}
