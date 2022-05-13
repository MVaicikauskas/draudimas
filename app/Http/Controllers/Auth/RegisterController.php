<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'string', 'max:13'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Vardas ir Pavardė privalo būti įrašyti.',
            'name.max:255' => 'Vardas ir Pavardė negali būti ilgesni nei 255 simbolių.',
            'email.required' => 'El. pašto adresas privalo būti įrašytas.',
            'email.email' => 'Neteisingai įrašytas El. pašto adresas.',
            'email.max:255' => 'El. pašto adresas negali būti ilgesnis nei 255 simbolių.',
            'email.unique:users' => 'Toks El. pašto adresas jau egzistuoja, bandykite naudoti kitą.',
            'phone_number.required' => 'Telefono numeris privalo būti įrašytas.',
            'phone_number.numeric' => 'Telefono numeris privalo būti TIK skaičiai.',
            'phone_number.max:13' => 'Telefono numeris negali būti ilgesnis nei 13 skaitmenų.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
