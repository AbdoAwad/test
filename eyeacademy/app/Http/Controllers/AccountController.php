<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index()
    {
        return view('account.account');
    }

    public function view($id)
    {
        return view('account.view');
    }

    public function update(Request $request, $id)
    {
        $account = User::findOrFail($id);
        $image  = $request->image ?  $request->file('image')->store('users', 'public_uploads') : $account->image;
        $pass = $account->password;
        if(!$pass == $request->password) $pass = Hash::make($request->password);
        //dd($pass);
        $account = User::findOrFail($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $request->image ? $image :$image,
            'password' => $pass
        ]);

        return redirect('/account')->with('success', 'Account is Updated');
    }
}
