<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        //return view('auth.register');
        return view('create-user');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:20', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'cep' => ['required', 'string', 'min:8', 'max:8'],
            'number' => ['required', 'string', 'min:1', 'max:10'],
            'complement' => ['string','max:100'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'cep' => $request->cep,
            'number' => $request->number,
            'complement' => $request->complement,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,

        ]);

        event(new Registered($user));

        //Auth::login($user);

        return redirect(RouteServiceProvider::HOME)->with([
                'success' => 'Usuário criado com sucesso!',
                'user' => $user
            ]);
    }
}
