<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name','asc')->get();

        return view('usersIndex', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usersAdd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|min:9|numeric',
            'password' => ['required',
            'string',
            Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()],
            'confirmed' => 'same:password',
            'role' => 'required'
        ], [
            'name.required' => 'Vardas ir Pavardė privalo būti įrašyti.',
            'email.required' => 'El. pašto adresas privalo būti įrašytas.',
            'email.email' => 'Neteisingai įrašytas El. pašto adresas.',
            'email.unique:users' => 'Toks El. pašto adresas jau egzistuoja.',
            'phone_number.required' => 'Telefono numeris privalo būti įrašytas.',
            'phone_number.numeric' => 'Telefono numeris privalo būti TIK skaičiai.',
            'phone_number.min:9' => 'Telefono numeris privalo būti ne trumpesnis nei 9 skaitmenys.',
            'password.required' => 'Slaptažodis privalo būti įrašytas.',
            'confirmed.same:password' => 'Slaptažodis privalo sutapti su Patvirtinimo Slaptažodžiu.',
        ]);

        $user = new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->phone_number=$request->phone_number;
        $user->password=Hash::make($request->password);
        $user->role=$request->role;
        $user->save();

        return redirect('/users')->with('success', 'Naujas Vartotojas sukurtas sėkmingai.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::find($id);

        return view('profile', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);
        if($users->role === 'Admin'){
            $users->role = 'Administratorius';
        } else {
            $users->role = 'Vartotojas';
        }

        return view('usersUpdate', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function passwordEdit($id)
    {
        $users = User::find($id);

        return view('passwordUpdate', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, User $users)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|min:9|numeric',
            'role' => 'required'
        ], [
            'name.required' => 'Vardas ir Pavardė privalo būti įrašyti.',
            'email.required' => 'El. pašto adresas privalo būti įrašytas.',
            'email.email' => 'Neteisingai įrašytas El. pašto adresas.',
            'phone_number.required' => 'Telefono numeris privalo būti įrašytas.',
            'phone_number.numeric' => 'Telefono numeris privalo būti TIK skaičiai.'
        ]);

        if($request->role === 'Administratorius'){
            $request->role = 'Admin';
        } else {
            $request->role = 'User';
        }

        $users = DB::table('users')
              ->where('id', $id)
              ->update(['name' => $request->name, 'email' => $request->email, 'phone_number' => $request->phone_number, 'role' => $request->role]);

        return redirect('/users')->with('success', 'Vartotojo duomenys atnaujinti sėkmingai.');
    }

    /**
     *  * Update the specified User's password in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function passwordUpdate(Request $request, $id, User $users)
    {
        $this->validate($request, [
            'new_password' => [
                'required',
                'string',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()],
                'confirmed' => ['same:new_password'],
        ], [
            'new_password.required' => 'Naujas Slaptažodis privalo būti įrašytas.',
            'confirmed.same:new_password' => 'Naujas Slaptažodis privalo sutapti su Patvirtinimo Slaptažodžiu.',
        ]);
        $users = DB::table('users')
              ->where('id', $id)
              ->update(['password' => Hash::make($request->new_password)]);

        return back()->with('success', 'Slaptažodis pakeistas sėkmingai.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, User $users)
    {
        $users = DB::table('users')->where('id', $id)->delete();
        return redirect('/users')->with('success', 'Vartotojas ištrintas sėkmingai.');
    }
}
