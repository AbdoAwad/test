<?php

namespace App\Http\Controllers;

use App\Station;
use App\User;
use Illuminate\Http\Request;

class StationController extends Controller
{
//    public function show(Request $request, $id){
//        $staffs = User::where('department_id' , $id )->get();
//        $categories = Category::where('department_id' , $id )->get();
//        return view('category',compact('categories','staffs'));
//    }

    public function index(){
        $stations = Station::get();
        $staffs = User::get();
        return view('stations.index', compact('stations', 'staffs'));
    }

    public function create(Request $request)
    {
        //dd($request);
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'staff_id' => 'required',
            'background' => 'required',
            'warning_time' => 'required',
            'dangerous_time' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            $stations = Station::get();
            $staffs = User::get();
            return redirect('/station')->with(['stations'=>$stations, 'staffs'=>$staffs])->with('error', 'Please fill up the form');
        }
        // Adding the path of Station image
        $path = $request->file('image')->store('stations', 'public_uploads');

        // Add Station
        $station = Station::create([
            'name' => $request->name,
            'background' => $request->background,
            'staff_id' => $request->staff_id,
            'warning_time' => $request->warning_time,
            'dangerous_time' => $request->dangerous_time,
            'image' => $path
        ]);

        $stations = Station::get();
        $staffs = User::get();
        return redirect('/station')->with(['stations'=>$stations, 'staffs'=>$staffs])->with('success', 'Station is Added');
    }

    public function view($id)
    {
        $station = Station::findOrFail($id);
        $staffs = User::get();
        return view('stations.view', compact('station', 'staffs'));
    }


    public function update(Request $request, $id)
    {
        $station = Station::findOrFail($id);
        $image  = $request->image ?  $request->file('image')->store('stations', 'public_uploads') : $station->image;

        $station = Station::findOrFail($id)->update([
            'name' => $request->name,
            'background' => $request->background,
            'staff_id' => $request->staff_id,
            'warning_time' => $request->warning_time,
            'dangerous_time' => $request->dangerous_time,
            'image' => $request->image ? $image :$image
        ]);

        $stations = Station::get();
        $staffs = User::get();
        return redirect('/station')->with(['stations'=>$stations, 'staffs'=>$staffs])->with('success', 'Station is Updated');
    }


    public function delete($id)
    {
        $station = Station::findOrFail($id);
        $station->delete();
        $stations = Station::get();
        $staffs = User::get();
        return redirect('/station')->with(['stations'=>$stations,'staffs'=>$staffs])->with('error', 'Station is Deleted');
    }
}
