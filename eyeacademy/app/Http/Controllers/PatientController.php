<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(){
        $patients = Patient::get();
        return view('patients.index', compact('patients'));
    }

    public function create(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'file_number' => 'required'
        ]);

        if ($validator->fails()) {
            $patients = Patient::get();
            return redirect('/patient')->with(['patients'=>$patients])->with('error', 'Please fill up the form');
        }

        // Add Patient
        $patient = Patient::create([
            'name' => $request->name,
            'file_number' => $request->file_number
        ]);

        $patients = Patient::get();
        return redirect('/patient')->with(['patients'=>$patient])->with('success', 'Patient is Added');
    }

    public function view($id)
    {
        $patient = Patient::findOrFail($id);
        return view('patients.view', compact('patient'));
    }

    public function update(Request $request, $id)
    {

        $patient = Patient::findOrFail($id)->update([
            'name' => $request->name,
            'file_number' => $request->file_number
        ]);
        $patients = Patient::get();
        return redirect('/patient')->with(['patients'=>$patient])->with('success', 'Patient is Updated');

    }


    public function delete($id)
    {
        $patint = Patient::findOrFail($id);
        $patint->delete();
        $patint = Patient::get();
        return redirect('/patient')->with(['patient'=>$patint])->with('error', 'Patient is Deleted');
    }
}
