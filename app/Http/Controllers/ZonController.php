<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Zon;
use App\Zonlist;



class ZonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(Request $request)
    {
        $zonlist = Zonlist::get();
        return view('patrols.zonlist')->with('zonlist',$zonlist);
    }
    public function show($zonlist_id, $zon_ukm, Request $request)
    {
        $zonlist = Zonlist::where('zon_ukm', '=', $zon_ukm)->get();
        $zon = Zon::where('zon_ukm','=', $zon_ukm)->get();
        $request->session()->put('currentpage', $request->getRequestUri());
        $request->session()->put('zonlist_id' , $zonlist_id);
        $request->session()->put('zon_ukm' , $zon_ukm);
        // dd($request->session()->get('zon_ukm'));
        $data = array(
            'zonlist_id' => $zonlist_id,
            'zon_ukm' => $zon_ukm,
            'zonlist' => $zonlist,
            'zon' => $zon
        );
        return view('patrols.createzonlist')->with($data);
    }
    public function createzonlist()
    {
        $zonlist = new Zonlist;
        $zonlistid = Zonlist::max('zonlist_id');
        $zonlistid+=1;
        $zonlist->zon_ukm = 'zon_' . ''. $zonlistid ;
        $zonlist->save();
        return back();

    }
    
    public function addcheckpoint(Request $request)
    {
        return view('patrols.addcheckpoint');
    }
    public function addcheckpointlist( Request $request)
    {
        $zon = new Zon;
        $zon_ukm = $request->session()->get('zon_ukm');
        $zonlist_id = $request->session()->get('zonlist_id');
        $zon->zon_ukm = $request->session()->get('zon_ukm');
        $zon->zonlist_id = $request->session()->get('zonlist_id');
        $zon->checkpoint = $request->input('checkpoint');
        $zon->lat = $request->input('lat');
        $zon->lng = $request->input('lng');
        $zon->save();
        return redirect(strval($request->session()->get('currentpage')));
        // return back();
    }

    public function destroy($zonlist_id, $zon_ukm, $id,Request $request)
    {
        $zon = Zon::find($id);
        $zon->delete();
        return back()->with('sucess','Checkpoint Removed');
    }


    
}
