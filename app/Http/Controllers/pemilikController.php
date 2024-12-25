<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\pemilik;
use App\Models\Lomba;
use App\Mail\TestEmail;
use App\Models\booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class pemilikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = pemilik::all();
        return view('user.pemiliks', compact('data'));
        //
    }

    public function editpemilik(){
        $data = pemilik::where('user_id', auth()->user()->id)->first();
        return view('pemilik.edit', compact('data'));
    }
    public function updatepemilik(Request $request){
        $data = pemilik::where('user_id', auth()->user()->id)->first();
        $data->name = request('name');
        $user = User::find(auth()->user()->id);

        // image
        if($request->hasFile('image')){
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $data->image = $name;
            $user->image = $name;
        }
        $data->description = request('description');
        $data->price = request('price');

        $data->location = request('location');
        $data->save();
        // change also the user info
        $user->name = request('name');

        $user->save();
        return redirect()->back()->with('success', 'pemilik updated successfully');
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

    public function acceptBooking($id){
        $booking = booking::find($id);
        $booking->status = 'Di Terima';
        $booking->save();
        // send email to the user that his booking has been accepted
        // $details = [
        //     'title' => 'Booking accepted',
        //     'image' => 'https://thumbs.gfycat.com/ComfortableRealisticGuanaco-max-1mb.gif',
        //     'button' => '0',

        //     'body' => 'Your booking has been accepted by the pemilik'

        // ];
        // Mail::to($booking->email)->send(new \App\Mail\TestEmail($details));

        return redirect()->back()->with('success', 'Booking Di Terima');
    }

        public function rejectBooking($id){
        $booking = booking::find($id);
        $booking->status = 'Di Tolak';
        $booking->save();
        // send email to the user that his booking has been rejected
        // $details = [
        //     'title' => 'Booking rejected',
        //     'image' => 'https://media.tenor.com/YFhAP8U26GQAAAAM/rejected-stamp.gif',
        //     'button' => '0',

        //     'body' => 'Your booking has been rejected by the pemilik'

        // ];
        // Mail::to($booking->email)->send(new \App\Mail\TestEmail($details));

        return redirect()->back()->with('success', 'Booking Di Tolak');
    }

    public function dashboard(){
        $data = pemilik::where('user_id', auth()->user()->id)->first();
        $bookings = booking::where('pemilik_id', $data->id)->get();
        // accepted bookings
        $accepted = booking::where('pemilik_id', $data->id)->where('status', 'Di Terima')->get();
        // pending bookings
        $pending = booking::where('pemilik_id', $data->id)->where('status', 'pending')->get();
        // rejected booking
        $rejected = booking::where('pemilik_id', $data->id)->where('status', 'Di Tolak')->get();

        return view('pemilik.dashboard', compact('data', 'bookings', 'accepted', 'pending', 'rejected'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        // check if time or date is in the past
        if($inputs['date'] < date('Y-m-d')){
            return redirect()->back()->with('past', 'You cannot book a pemilik in the past');
        }
        if($inputs['date'] == date('Y-m-d') && $inputs['time'] < date('H:i')){
            return redirect()->back()->with('past', 'You cannot book a pemilik in the past');
        }
        // check if booking already exists
        $check = booking::where('pemilik_id', $inputs['pemilik_id'])->where('date', $inputs['date'])->where('time', $inputs['time'])->first();
        if($check){
            return redirect()->back()->with('alredy', 'You have already booked this pemilik at this time');
        }
        $inputs['name'] = auth()->user()->name;
        $inputs['email'] = auth()->user()->email;
        $inputs['phone'] = auth()->user()->phone;
        $inputs['jenis'] = "rakitkayu";
        $inputs['user_id'] = auth()->user()->id;
        $inputs['status'] = 'pending';

        booking::create($inputs);

        return redirect()->back()->with('success', 'Booking anda berhasil');
    }

    public function addlomba(){
        return view('pemilik.addlomba');
    }
    public function search(Request $request){
        $inputs = $request->all();
        $data = pemilik::where('name', 'like', '%'.$inputs['search'].'%')->orWhere('jenis', 'like', '%'.$inputs['search'].'%')->get();

        return view('user.pemilik', compact('data'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pemilik  $pemilik
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = pemilik::find($id);
        $pemilikuser = User::find($data->user_id);
        // return
        return view('user.pemilik', compact('data', 'pemilikuser'));
        // return view('user.pemilik', compact('data'));
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pemilik  $pemilik
     * @return \Illuminate\Http\Response
     */
    public function edit(pemilik $pemilik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pemilik  $pemilik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pemilik $pemilik)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pemilik  $pemilik
     * @return \Illuminate\Http\Response
     */
    public function destroy(pemilik $pemilik)
    {
        //
    }

    public function mylombas(){
        // find Lomba where the user_id = auth user id
        $data = Lomba::where('user_id', auth()->user()->id)->get();
        return view('pemilik.mylombas', compact('data'));
    }

    public function addalomba(Request $request){
        // validation
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'level' => 'required',
        ]);
        $inputs = $request->all();
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $inputs['image'] = "$profileImage";


        }
        $inputs['user_id'] = auth()->user()->id;
        $inputs['author'] = auth()->user()->name;


        Lomba::create($inputs);
        return redirect()->route('mylombas')->with('addedd', 'lomba added');
    }

    public function deletelomba($id){
        $data = Lomba::find($id);
        $data->delete();
        return redirect()->back()->with('deleted', 'lomba deleted');
    }
    public function editlomba(request $request){
        $data = Lomba::find($request->id);
        return view('pemilik.editlomba', compact('data'));
    }
    public function updatelomba(Request $request){
        $inputs = $request->all();
        $data = Lomba::find($request->id);
        $data->name = $inputs['name'];
        $data->description = $inputs['description'];
        $data->level = $inputs['level'];
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $inputs['image'] = "$profileImage";
            $data->image = $inputs['image'];

        }
        $data->save();
        return redirect()->route('mylombas')->with('updated', 'lomba updated');
    }
}

