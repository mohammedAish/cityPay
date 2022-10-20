<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait RegistersUsers
{

    use RedirectsUsers;

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($users);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());

    }


    protected function guard()
    {
        return Auth::guard();

    }


    protected function registered(Request $request, $user)
    {
        if ($user->email == null) {
            return redirect()->route('verification');
        }
        else {
            return redirect()->route('home');
        }

    }

}
