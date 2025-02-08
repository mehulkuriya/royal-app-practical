<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Services\RoyalAppApi;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected $royalAppApiService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RoyalAppApi $royalAppApiService)
    {
        $this->royalAppApiService = $royalAppApiService;
    }

    public function login(Request $request)
    {
       $result = $this->royalAppApiService->getAccessToken($request->all());

        if(isset($result["token_key"]))
        {
            session(['token_key' => $result["token_key"]]);
            session(['user' => $result["user"]]);
            return redirect(url('authors'));
        }
        return redirect()->route('login')
        ->withErrors(['email' => 'Access Denied! You Have Entered Wrong Credentials.'])
        ->withInput($request->only('email'));
    }

    public function logout()
    {
        if (session()->has('token_key')) {
            session()->forget('token_key');
        }
        return redirect()->route('login');
    }
}
