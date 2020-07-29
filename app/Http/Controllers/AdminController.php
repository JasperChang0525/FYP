<?php

namespace App\Http\Controllers;

use App\Alert;
use App\SaveShift;
use App\Shifttimetable;
use Illuminate\Http\Request;
use App\User;
use App\Zon;
class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin');
    }
    public function reportlist()
    {
        $user = User::get();
        $data = array(
            'user' => $user,
        );
        return view ('report.index')->with($data);
    }
    public function policereport($id)
    {
        $save = SaveShift::where('police_id','=', $id)->get();
        return view('report.schedule')->with('save', $save);
    }
    
    public function policeschedule($id,$zonlist_id)
    {
        $shift = Shifttimetable::where('shift_id','=',$id)->get();
        $shufflezons = Zon::where('zonlist_id','=',$zonlist_id)->get();
        $zons = $shufflezons->shuffle(0);
        $data = array(
            'shift' => $shift,
            'zons' => $zons,
        );
        return view('report.policeschedule')->with($data);
    }
    public function policealert()
    {
        $alert = Alert::where('status','=', 0)->get();
        $user = User::get();
        $data = array(
            'user' => $user,
            'alert' => $alert,
        );
        return view('policealert')->with($data);
    }
    public function solvesos($id)
    {
        $alert = Alert::find($id);
        $alert->status = true;
        $alert->update();
        return back();

    }

}
