<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Station;
use App\Track;
use App\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(){
        $patient_count = Patient::count();
        $visit_count = Visit::count();
        $satisfied_count = Track::where('feedback','=',1)->count();
        $unsatisfied_count = Track::where('feedback','=',0)->count();
        $stations = Station::all();

        $stations->transform(function ($station) {
            return [
                'name'=> $station->name,
                'id' => $station->id,
                'background' => $station->background,
                'numVisits' => $station->tracks->count(),
                'numSat' => $station->tracks->where('feedback',1)->count(),
                'numUnsat' => $station->tracks->where('feedback',2)->count()

            ];

        });
        //dd($stations[0]->name);

//        foreach ($stations as $station){
//            //dd($station->tracks->all());
//            $numVisits = $station->tracks->count();
//            //dd($numVisits);
//            $numSat = $station->tracks->where('feedback',1)->count();
//            //dd($numSat);
//
//
//            $merged = $station->merge(['numSat' => $numSat, 'numVisits' => $numVisits]);
//            $merged->all();
//            dd($station);
//        }


        //$tracks = Track::get();
        return view('report.index', compact('patient_count','visit_count','satisfied_count','unsatisfied_count','stations'));
    }

    public function currentDate($id){
        $patient_count = Patient::count();
        $visit_count = Visit::count();
        $satisfied_count = Track::where('feedback','=',1)->count();
        $unsatisfied_count = Track::where('feedback','=',2)->count();
        $stations = Station::all();


        $stations->transform(function ($station) {
            $yesterday = Carbon::yesterday();
            //$current = date('Y-m-d H:i:s');

//            dd($current);
            return [
                'name'=> $station->name,
                'id' => $station->id,
                'background' => $station->background,
                'numVisits' => $station->tracks->where('created_at','>', $yesterday)->count(),
                'numSat' => $station->tracks->where('feedback',1)->where('created_at','>', $yesterday)->count(),
                'numUnsat' => $station->tracks->where('feedback',0)->where('created_at','>', $yesterday)->count()

            ];

        });


        return view('report.index', compact('patient_count','visit_count','satisfied_count','unsatisfied_count','stations'));
    }
}
