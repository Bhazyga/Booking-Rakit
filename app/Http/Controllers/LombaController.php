<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lomba;
use App\Models\comment;
use Illuminate\Http\Request;

class LombaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Lomba::all();
        return view('user.lombas', compact('data'));
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $data = Lomba::where('name', 'like', '%'.$search.'%')->get();
        return view('user.lombas', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\lomba  $lomba
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Lomba::find($id);
        $userid = User::find($data->user_id);
        $comments = comment::where('lomba_id', $id)->get();
        // return view('user.lomba', compact('data', 'comments'));
        return view('user.lomba', compact('data', 'comments', 'userid'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\lomba  $lomba
     * @return \Illuminate\Http\Response
     */
    public function edit(lomba $lomba)
    {

        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\lomba  $lomba
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lomba $lomba)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\lomba  $lomba
     * @return \Illuminate\Http\Response
     */
    public function destroy(lomba $lomba)
    {

        // destroy Lomba ussing id by Lombae:destr

    }
}
