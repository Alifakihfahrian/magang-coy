<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display login page.
     * 
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('layouts.login');
    }

    /**
     * Handle account login request.
     * 
     * @param LoginRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        // Ambil credentials dari LoginRequest (bisa username atau email)
        $credentials = $request->getCredentials();

        // Validasi credentials
        if (!Auth::validate($credentials)) {
            return redirect()->route('login')
                ->withErrors(trans('auth.failed')); // Handle error jika gagal
        }

        // Retrieve user dari credential yang valid
        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        // Login user
        Auth::login($user);

        return $this->authenticated($request, $user);
    }

    /**
     * Handle response after user authenticated.
     * 
     * @param Request $request
     * @param Auth $user
     * 
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        // Redirect ke halaman home setelah login berhasil
        return redirect()->route('home.index');
    }
}
