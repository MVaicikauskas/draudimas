<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Consultation;
use App\Models\User;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role === 'Admin'){
             $consultations = DB::table('consultations')
            ->join('users', 'users.id', '=', 'consultations.user_id',)
            ->select('consultations.id as id','consultations.topic as topic','consultations.type as type','consultations.additional_info as info','consultations.consultation_date as date', 'users.name as name', 'users.phone_number as phone', 'users.email as email')->orderBy('date','asc')
            ->get();
        } else {
            $consultations = DB::table('consultations')
            ->join('users', 'users.id', '=', 'consultations.user_id',)
            ->select('consultations.id as id','consultations.topic as topic','consultations.type as type','consultations.additional_info as info','consultations.consultation_date as date', 'users.id as user_id','users.name as name', 'users.phone_number as phone', 'users.email as email')->where('user_id', '=', Auth::user()->id)->orderBy('date','asc')
            ->get();
        }


        return view('consultations.index', compact('consultations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::orderBy('name','asc')->get();
        return view('consultations.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        {
            $this->validate($request, [
                'user_id' => 'required',
                'topic' => 'required',
                'type' => 'required',
                'consultation_date' => 'required'
            ], [
                'user_id.required' => 'Nepasirinktas Vartotojas konsultacijai.',
                'topic.required' => 'Prašome pasirinkti konsultacijos temą.',
                'type.email' => 'Prašome pasirinkti konsultacijos tipą.',
                'consultation_date.required' => 'Prašome pasirinkti konsultacijos dieną ir laiką.',
            ]);

            if($request->topic === 1){
                $request->topic = 'Draudimo išmokos';
            } elseif ($request->topic === 2){
                $request->topic = 'Žalos atvėju';
            } elseif($request->topic === 3) {
                $request->topic = 'Draudimo produktai';
            }
            if($request->type === 1){
                $request->type = 'Telefonu';
            } elseif ($request->type === 2){
                $request->type = 'Vaizdo skambučiu';
            }

            $consultations = DB::table('consultations')->insert([
                ['user_id' => $request->user_id,
                'topic' => $request->topic,
                'type' => $request->type,
                'additional_info' => $request->additional_info,
                'consultation_date' => $request->consultation_date
                ]
            ]);

            return redirect('/consultations')->with('success', 'Konsultacijos registracija sėkminga.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Consultation $consultations, $id)
    {
        $users = User::orderBy('name','asc')->get();
        $oneUser = DB::table('users')
        ->join('consultations', 'consultations.user_id', '=', 'users.id',)
        ->select('users.name', 'users.id')->where('consultations.id', '=', $id)->get();
        $consultations = DB::table('consultations')
        ->where('id', '=', $id)
        ->get();

        return view('consultations.update', compact('consultations', 'users', 'oneUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'topic' => 'required',
            'type' => 'required',
            'consultation_date' => 'required',
            'id' => 'required'
        ], [
            'user_id.required' => 'Nepasirinktas Vartotojas konsultacijai.',
            'topic.required' => 'Prašome pasirinkti konsultacijos temą.',
            'type.email' => 'Prašome pasirinkti konsultacijos tipą.',
            'consultation_date.required' => 'Prašome pasirinkti konsultacijos dieną ir laiką.',
            'id.required' => 'Įvyko klaida, negautas konsultacijos ID, prašome bandyti dar kartą arba susisiekti su Administracija.',
        ]);

        $consultations = DB::table('consultations')
              ->where('id', $id)
              ->update(['user_id' => $request->user_id,
              'topic' => $request->topic,
              'type' => $request->type,
              'additional_info' => $request->additional_info,
              'consultation_date' => $request->consultation_date
            ]);

            return redirect('/consultations')->with('success', 'Konsultacija atnaujinta sėkmingai.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $consultations = DB::table('consultations')->where('id', $id)->delete();
        return redirect('/consultations')->with('success', 'Konsultacija ištrinta sėkmingai.');
    }


}
