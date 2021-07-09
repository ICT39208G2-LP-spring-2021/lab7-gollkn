<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }

    public function home()
    {
        return view('pages.home');
    }

    public function register()
    {
        return view('pages.registration-page');
    }

    public function addUser(Request $request)
    {
        $token = uniqid();
        $this->validate($request, [
            'FirstName' => 'required',
            'LastName' => 'required',
            'PersonalNumber' => 'required|unique:users,PersonalNumber',
            'Email' => 'required|email|unique:users,Email',
            'Password' => 'required'
        ]);


        $user = User::create([
            'FirstName' => $request->FirstName,
            'LastName' => $request->LastName,
            'PersonalNumber' => $request->PersonalNumber,
            'Email' => $request->Email,
            'Password' => bcrypt($request->Password),
            'StatusId' => '0',
            'remember_token' => $token
        ]);
        session(['token' => $token]);
        session(['email' => $request->Email]);
        Auth::login($user);


        MailController::sendVerificationEmail($request->Email, $request->_token);
        $request->session()->flash('notification', 'Registration successful, verification email has been sent');
        session(['resend-attempts' => 4]);
        return redirect()->route('register');
    }

    public function login()
    {
        return view('pages.login');
    }

    public function loginAuth(Request $request)
    {

        $login_data = request()->validate([
            'Email' => 'required',
            'Password' => 'required',
        ]);

        if (Auth::attempt($login_data)) {
            if (Auth::attempt('StatusId' != 0)) {
                $request->session()->regenerate();
                return redirect()->route('home');
            } else {
                return back()->with('unverified-email', 'Please activate your account with the link that has been sent to your email');
            }
        }

        return back()->withErrors([
            'Email' => 'Wrong email',
            'Password' => 'Wrong password',
        ]);
    }

    public function logOut()
    {
        Auth::logout();
        return redirect('/');
    }
}
