<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Station;
use App\Track;
use App\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    private $station_id = 1;

    public function getFormattedDateAttribute()
    {
        return $this->date->format('d-m-Y');
    }

    public function index(Request $request, $id)
    {
        $patients = Patient::get();
        $station  = Station::findOrFail($id);
        $tracks = $station->tracks->where('feedback',null);
        $stations = Station::where('id','!=', $id)->get();
        if($request->ajax()) {
            $response ='<div class="row clearfix">';
            foreach($tracks as $track) {
                $date = date('M j, Y h:ia', strtotime($track->visit->created_at));
                //dd($date);
                $response = $response .'
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="card visit_card" id="visit_card">
                            <div class="card-body text-center ribbon">
                                <div class="ribbon-box green">'.$date.'</div>
                                <h4 class="mt-5 mb-4">'.$track->visit->patient->name.'</h4>

                                <div class="row text-center mb-4">
                                    <div class="col-lg-12">
                                        <label class="mb-2">Timer</label>
                                        <h4 class="font-18">07</h4>
                                    </div>
                                </div>';
                foreach($stations as $stationx) {
                    $response = $response .'
                    <button class="btn btn-default btn-sm mb-3" id = "moveTo" type = "button" style = "width: 45%;"> '.$stationx->name.'</button >
                    ';
                    }
                if (auth()->user()->finish_visit == 1){
                    $response = $response .'
                        <button type="button" class="btn finish-btn" data-submit="visit" onclick="update('.$track->id .','.$id.')"><i class="fe fe-log-out"></i></button>
                    ';
                }
                $response = $response .'
                            </div>
                        </div>
                    </div>';

            }
            $response = $response .'
            </div>';
            return $response;
        };
        return view('visits.index', compact('patients', 'id'));
    }

    public function create(Request $request, $id)
    {

        //dd($request);
        $this->station_id = $id;
        $validator = \Validator::make($request->all(), [
            'patient_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'title' => 'Error',
                'message' => $validator->errors()->first()
            ]);
        }
        // Add Visit
        //dd($request);
        $visit = Visit::create([
            'patient_id' => $request->patient_id,
        ]);
        $track = Track::create([
            'visit_id' => $visit->id,
            'station_id' => $this->station_id
        ]);
        $visit->save();
        $track->save();
        return response()->json([
            'status' => 'success',
            'title' => 'Success',
            'message' => 'Visit successfully added.'
        ]);


    }

    public function update(Request $request)
    {
        $track = Track::findOrFail(1)->update([
            'out_time' => Carbon::now(),
            'feedback' => 1
        ]);
        $track = Track::findOrFail(1);
        dd($track);

        $visit = Visit::findOrFail($track->visit_id)->update([
            'out_time' => Carbon::now()
            ]);


        return response()->json([
            'status' => 'success',
            'title' => 'Success',
            'message' => 'Visit successfully Finished.'
        ]);

        $patients = Patient::get();
        return view('visits.index', compact('patients', 'id'));
    }
}
