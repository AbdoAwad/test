<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $staffs = User::get();
        return view('staffs.index', compact('staffs'));
    }

    public function create(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'add_visit' => 'required',
            'finish_visit' => 'required',
            'password' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            $staffs = User::get();
            return redirect('/staff')->with(['staffs'=>$staffs])->with('error', 'Please fill up the form');
        }

        // Add Stff

        // Adding the path of staff image
        $path = $request->file('image')->store('users', 'public_uploads');

        $staff = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'add_visit' => $request->add_visit,
            'finish_visit' => $request->finish_visit,
            'image' => $path,
            'password' => Hash::make($request->password)
        ]);

        $staffs = User::get();
        return redirect('/staff')->with(['staffs'=>$staffs])->with('success', 'Staff is Added');
    }

    public function view($id)
    {
        $staff = User::findOrFail($id);
        return view('staffs.view', compact('staff'));
    }

    public function update(Request $request, $id)
    {
        $staff = User::findOrFail($id);
        $image  = $request->image ?  $request->file('image')->store('users', 'public_uploads') : $staff->image;
        $pass = $staff->password;
        if(!$pass == $request->password) $pass = Hash::make($request->password);

        $staff = User::findOrFail($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $request->image? $image :$image,
            'password' => $pass
        ]);
        $staffs = User::get();
        return redirect('/staff')->with(['staffs'=>$staffs])->with('success', 'Staff is Updated');

    }


    public function delete($id)
    {
        $staff = User::findOrFail($id);
        $staff->delete();
        $staffs = User::get();
        return redirect('/staff')->with(['staffs'=>$staffs])->with('error', 'Staff is Deleted');
    }
}
