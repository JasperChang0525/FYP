<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Zon;
use App\Zonlist;
use App\SaveShift;
use App\Alert;
use App\Shifttimetable;
use Carbon\Carbon;
use Auth;

class PatrolController extends Controller
{
    public function __construct()
    {
        if(Auth::guard('web')->check())
        {
            $this->middleware('auth:web' ,['only' => ['displayshift','zon','sos','savesos','checkin']]);
        }
        if(Auth::guard('admin')->check())
        {
            $this->middleware('auth:admin' ,['only' => ['setuser']]);
        }
        
    }
    public function setuser()
    {
        $zonlist = Zonlist::get();
        $police = User::get(); 
        $policelistidlist = array();
        $data = array(
            'policelistidlist' => $policelistidlist,
            'police' => $police,
            'zonlist' => $zonlist,
        );
        return view('patrols.create')->with($data);
    }
    public function displayshift(Request $request)
    {
        $counter = 0;
        $request->session()->flash('counter' , $counter);
        $saveshift = SaveShift::where('police_id','=',Auth::user()->id)->get();
        return view('patrols.displayshift')->with('saveshift', $saveshift);
    }
    public function saveshift(Request $request)
    {
        $saveshift = new SaveShift;
        $saveshift->police_id = $request->get('police');
        $saveshift->zonlist_id = $request->get('zon');
        $saveshift->start_shift = $request->input('start_date');
        $saveshift->save();
        return back();
    }

    public function zon($shift_id,$zonlist_id ,$police_id, Request $request)
    {
        $zons= Zon::where('zonlist_id','=', $zonlist_id)->paginate(1);
        $counter = $request->session()->get('counter');
        $data = array(
            'id' => $shift_id,
            'zons' => $zons,
            'police_id' => $police_id,
            'counter' => $counter,
        );
        return view('patrols.zon')->with($data);
    }
    public function sos()
    {
        return view('patrols.alert');
    }
    public function savesos(Request $request)
    {
        $alert = new Alert;
        $alert->police_id = auth()->user()->id;
        $alert->lat = $request->input('lat');
        $alert->lng = $request->input('lng');
        $address = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=$alert->lat,$alert->lng&key=AIzaSyAIw269bXf_I8SJmtTRlxs6GqvfEdKKo1I");
        $json_address = json_decode($address);
        $full_address = $json_address->results[0]->formatted_address;
        $alert->address = $full_address;
        $alert->save();
        return back();
    }
    public function checkin($id, $zonlist_id,$police_id, Request $request)
    {   
        // $saveshift = SaveShift::where('police_id','=',auth()->user()->id)->where('zonlist_id','=',$zonlist_id)->get();
        // dd($saveshift);
        // $counter = $request->get('counter');
        // $counter += 1;
        // $request->session()->flash('counter', $counter);
        // dd($counter);
        $shifttimetable = new Shifttimetable();
        $shifttimetable->police_id = auth()->user()->id;
        $shifttimetable->zonlist_id = $zonlist_id;
        $shifttimetable->shift_id = $id;
        $shifttimetable->lat = $request->input('zonlat');
        $shifttimetable->lng = $request->input('zonlng');

        if($request->input('computedcounter') < 15)
        {

            $shifttimetable->save();
            // // dd($request->url()."?page=");
            // return redirect($request->getRequestUri())->with('success','test');
            return redirect($request->getRequestUri())->with('success','saved it');


        }
        else
        {
            return redirect($request->getRequestUri())->with('error','you are too far from the checkpoint');
        }
        // dd($request->getRequestUri());

        

    }
    // Function call with passing the start date and end date 
// $Date = getDatesFromRange('2010-10-01', '2010-10-05'); 
}