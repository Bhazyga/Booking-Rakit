<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\pemilik;
use App\Models\Course;
use App\Mail\TestEmail;
use Illuminate\Http\Request;
use App\Models\demandbepemilik;
use Illuminate\Support\Facades\Mail;

class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get data orderBy('created_at', 'desc') and where status == pending and paginate
        $data = demandbepemilik::orderBy('created_at', 'desc')->where('status', 'pending')->paginate(10);
        return view('admin.acceptpemilik', compact('data'));
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function acceptpemilik($id)
    {
        $data = demandbepemilik::find($id);
        $data->status = "accepted";
        $data->save();
        // send notification email to user that his request has been accepted



        return redirect()->back()->with('success', 'pemilik accepted successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    public function acceptandemailing(Request $request)
    {

        $data = demandbepemilik::find($request->id);
        $data->status = "accepted";
        $data->save();
        // add user to pemilik table
        $inputs = $request->all();
        $inputs['name'] = $data->name;
        $inputs['image'] = $data->image;
        $inputs['jenis'] = $data->jenis;
        $inputs['location'] = $data->location;
        $inputs['price'] = $data->price;
        $inputs['description'] = $data->description;
        $inputs['status'] = "active";
        $inputs['yearsofexperience'] = $data->yearsofexperience;
        $inputs['rating'] = 0;
        $inputs['user_id'] = $data->pemilik_id;
        pemilik::create($inputs);

        demandbepemilik::destroy($request->id);

        // update role user by id
        $user = User::find($data->pemilik_id);
        $user->role = "pemilik";
        $user->save();

        // send notification email to user that his request has been accepted
        $mailData = [
            "name" => "$data->name",
            "dob" => "12/12/1990",
            'image' => 'https://media.tenor.com/2xfw9AtV19EAAAAS/hired-excited.gif',
            'button' => '1',
            "body" => "you are accepted as a pemilik",
        ];

        Mail::to("$data->email")->send(new TestEmail($mailData));

        return redirect()->back()->with('success', 'pemilik accepted successfully');
    }

    public function rejectpemilik(Request $request)
    {
        $data = demandbepemilik::find($request->id);
        $data->status = "rejected";
        $data->save();
        // send notification email to user that his request has been rejected
        $mailData = [
            "name" => "$data->name",
            "dob" => "12/12/1990",
            'image' => 'https://media.tenor.com/qn-45RI4FNoAAAAd/request-denied-tom-welling.gif',
            'button' => '1',
            "body" => "you are rejected as a pemilik",
        ];

        Mail::to("$data->email")->send(new TestEmail($mailData));
        return redirect()->back()->with('delete', 'pemilik rejected successfully');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showallpemiliks()
    {
        $data = pemilik::orderBy('created_at', 'desc')->paginate(999);
        return view('admin.showallpemiliks', compact('data'));
    }
    public function destroy($id)
    {
        // find pemilik by user_id
        $pemilik = pemilik::where('user_id', $id)->first();
        // delete pemilik
        $pemilik->delete();
        // update role user by id
        $user = User::find($id);
        $user->role = "user";
        $user->save();
        return redirect()->back()->with('delete', 'pemilik deleted successfully');
    }

    public function showCourses()
    {
        $data = Course::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.deletecourse', compact('data'));
    }

    public function deleteCourse($id)
    {
        $data = Course::find($id);
        $data->delete();
        return redirect()->back()->with('delete', 'Course deleted successfully');
    }
}
