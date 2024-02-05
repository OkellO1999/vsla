<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use \Illuminate\Auth\SessionGuard;
use Illuminate\Support\Facades\DB;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the admin login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

   

    /**
     * Handle an incoming authentication request.
     */

    public function store(LoginRequest $request): RedirectResponse
    {
        $data = $request->authenticate();
        
        $request->session()->regenerate();
        if(Auth::user()->role === 'super_admin'){

            return redirect()->intended(RouteServiceProvider::DASHBOARD);
        }
        if(Auth::user()->role === 'non_member'){

            return redirect()->intended(RouteServiceProvider::PAYMENTS);
        }
        if(Auth::user()->role === 'member' || Auth::user()->role === 'admin' || Auth::user()->role === 'secretary' && Auth::user()->verified === 1){
            return redirect()->intended(RouteServiceProvider::UNVERIFIED);
        }
        return redirect()->intended(RouteServiceProvider::HOME);


    }
 

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        DB::table('users')
        ->where('id',Auth::user()->id)
        ->update(['verified' => 0])
        ;
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
