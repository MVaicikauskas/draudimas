<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsfeed;
use Illuminate\Support\Facades\DB;

class newsfeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsfeed = Newsfeed::orderBy('id','desc')->get();

        return view('home', compact('newsfeed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('newsfeeds.create');
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
            'name' => 'required|max:64',
            'info' => 'required|max:2000'
        ], [
            'name.required' => 'Temos pavadinimas privalo būti įrašytas.',
            'name.max:64' => 'Temos pavadinimo ilgis negali būti ilgesnis nei 64 simboliai.',
            'info.required' => 'Temos Informacija privalo būti įrašyta.',
            'info.max:2000' => 'Temos Informacijos ilgis negali būti ilgesnis nei 2000 simbolių.'
        ]);

        $newsfeed = new Newsfeed();
        $newsfeed->name=$request->name;
        $newsfeed->info=$request->info;
        $newsfeed->save();
        return redirect('/home')->with('success', 'Naujiena įrašyta sėkmingai.');
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
    public function edit(Request $request, $id, Newsfeed $newsfeed)
    {

        $newsfeed = Newsfeed::find($id);

        return view('newsfeeds.update', compact('newsfeed'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Newsfeed $newsfeed)
    {

        $this->validate($request, [
            'name' => 'required|max:64',
            'info' => 'required|max:2000'
        ], [
            'name.required' => 'Temos pavadinimas privalo būti įrašytas.',
            'name.max:64' => 'Temos pavadinimo ilgis negali būti ilgesnis nei 64 simboliai.',
            'info.required' => 'Temos Informacija privalo būti įrašyta.',
            'info.max:2000' => 'Temos Informacijos ilgis negali būti ilgesnis nei 2000 simbolių.'
        ]);

        $newsfeed = DB::table('newsfeeds')
              ->where('id', $id)
              ->update(['name' => $request->name, 'info' => $request->info]);

        return redirect('/home')->with('success', 'Naujiena atnaujinta sėkmingai.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Newsfeed $newsfeed)
    {
        $newsfeed = DB::table('newsfeeds')->where('id', $id)->delete();
        return redirect('/home')->with('success', 'Tema ištrinta sėkmingai.');
    }
}

