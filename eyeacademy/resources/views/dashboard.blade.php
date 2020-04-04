
@extends('layouts.app', ['header_title' => 'Dashboard'])

@push('css')
<style>
    .card {
      box-shadow: 0 3px 3px 0 rgba(0,0,0,0.14), 0 1px 7px 0 rgba(0,0,0,0.12), 0 3px 1px -1px rgba(0,0,0,0.2);
      background-size:cover;
      background-position: center;
      padding: 0;
      min-height:200px;
      margin-right:5px;
      width:80%;
    }

    .card-body {
      background-color:rgba(3,3,3,.3);
      border-radius:10px;
      padding: 10px;
      color: #fff;
    }

    .card-body .btn {
      color: #fff;
      border: 1px solid #fff;
      width:70%;
      margin-top:20%;
    }

    .btn:hover {
      background-color:#2597d4;
      color: #fff;
      border: 1px solid #2597d4;
      transition: all 1s ease-in-out;
    }


</style>


@endpush

@section('content')
<div class="row">
    <div class="card c_grid c_yellow col-lg" style="background-image:url('{{asset('image/account.svg')}}');">
        <div class="card-body text-center" style="">
            <h6 class="mt-3 mb-0">Account</h6>
            <br>
            <a href="{{route('account')}}" class="btn">See It</a>
            <br>
        </div>
    </div>


    <div class="card c_grid c_yellow col-lg" style="background-image:url('{{asset('image/station.jpg')}}');">
        <div class="card-body text-center" style="">
            <h6 class="mt-3 mb-0">Station</h6>
            <br>
            <a href="{{route('station')}}" class="btn">See All</a>
            <br>
        </div>
    </div>


</div>

@if(strcasecmp(auth()->user()->name,"super admin") == 0 || strcasecmp(auth()->user()->name, "admin") == 0)
    <div class="row">

        <div class="card c_grid c_yellow col-lg" style="background-image:url('{{asset('image/dash6.png')}}');">
            <div class="card-body text-center" style="">
                <h6 class="mt-3 mb-0">Staff</h6>
                <br>
                <a href="{{route('staff')}}" class="btn">See All</a>
                <br>
            </div>
        </div>

        <div class="card c_grid c_yellow col-lg" style="background-image:url('{{asset('image/report.png')}}'); background-position: center;
            background-size: 55%;
            background-repeat: no-repeat;">
            <div class="card-body text-center" style="">
                <h6 class="mt-3 mb-0">Report</h6>
                <br>
                <a href="{{route('report')}}" class="btn">See All</a>
                <br>
            </div>
        </div>

    </div>
@endif

@if(auth()->user()->add_visit == 1)
    <div class="row">

        <div class="card c_grid c_yellow col-lg-6" style="background-image:url('{{asset('image/patient.png')}}');">
            <div class="card-body text-center" style="">
                <h6 class="mt-3 mb-0">Patient</h6>
                <br>
                <a href="{{route('patient')}}" class="btn">See All</a>
                <br>
            </div>
        </div>

    </div>
@endif


@endsection
