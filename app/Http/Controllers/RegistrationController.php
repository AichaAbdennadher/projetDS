<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    /**
     * Display the dashboard with registrations.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->aa_role === 'admin') {
            $registrations = Registration::join('aa_events', 'aa_registrations.aa_event_id', '=', 'aa_events.aa_id')
                ->select('aa_registrations.*')
                ->with(['user', 'event'])
                ->orderBy('aa_events.aa_start_date', 'desc')
                ->paginate(5);
        } else {
            $registrations = $user->registrations()
                ->join('aa_events', 'aa_registrations.aa_event_id', '=', 'aa_events.aa_id')
                ->select('aa_registrations.*')
                ->with('event')
                ->orderBy('aa_events.aa_start_date', 'desc')
                ->paginate(5);
        }

        return view('dashboard', compact('registrations'));
    }
}
