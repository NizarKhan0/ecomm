<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
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
        $request->authenticate();

        $request->session()->regenerate();

        //Cara pertama url
        // $url= '';
        // if($request->user()->role == 'admin'){
        //     $url = 'admin/dashboard';
        // }elseif($request->user()->role == 'vendor'){
        //     $url = 'vendor/dashboard';
        // }elseif($request->user()->role == 'user'){
        //     $url = '/dashboard';
        // }

        // return redirect()->intended($url);

        //Cara kedua route name
        $routeName = '';
        if ($request->user()->role == 'admin') {
            $routeName = route('admin.dashboard', absolute: false);
        } elseif ($request->user()->role == 'vendor') {
            $routeName = route('vendor.dashboard', absolute: false);
        } elseif ($request->user()->role == 'user') {
            $routeName = route('dashboard', absolute: false);
        }

        $notification = array(
            'message' => 'Login Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->intended($routeName)->with($notification);

        // return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
