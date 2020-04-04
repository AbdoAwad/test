@extends('layouts.app', ['header_title' => 'Report'])
@include('plugins.dropify')

@push('css')
    <style>
        .plans-grid {
            display: grid;
            grid-gap: 20px;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        }

        .card {
            box-shadow: 0 3px 3px 0 rgba(0,0,0,0.14), 0 1px 7px 0 rgba(0,0,0,0.12), 0 3px 1px -1px rgba(0,0,0,0.2);
        }

        .card i{
            color: #f48524;
        }

        .check {
            background-color: #f48524;
        }
    </style>
@endpush

@section('content')
    <div class=" row clearfix">
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body w_sparkline">
                    <div class="details">
                        <span>Total Patients</span>
                        <h3 class="mb-0 counter">{{$patient_count}}</h3>
                    </div>
                    <div class="w_chart">
                        <i class="fas fa-procedures fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body w_sparkline">
                    <div class="details">
                        <span>Total Visits</span>
                        <h3 class="mb-0 counter">{{$visit_count}}</h3>
                    </div>
                    <div class="w_chart">
                        <i class="fas fa-eye fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body w_sparkline">
                    <div class="details">
                        <span>Total Satisfied Patient</span>
                        <h3 class="mb-0 counter">{{$satisfied_count}}</h3>
                    </div>
                    <div class="w_chart">
                        <i class="fas fa-smile fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body w_sparkline">
                    <div class="details">
                        <span>Total Unsatisfied Patient</span>
                        <h3 class="mb-0 counter">{{$unsatisfied_count}}</h3>
                    </div>
                    <div class="">
                        <i class="fas fa-sad-tear fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class=" row clearfix" style="margin: 20px 0">
        <a id="" class="btn btn-primary mb-15 {{ request()->is('report/1*') ? 'check' : '' }}" style="float:right; margin-right: 20px; color: #fff;"  href="{{route('current_report', 1)}}">
            ToDay Report
        </a>
        <a id="" class="btn btn-primary mb-15 {{ request()->is('report') ? 'check' : '' }}" style="float:right; margin-right: 20px; color: #fff;"  href="{{route('report')}}">
            All Report
        </a>
    </div>
    <div class=" row clearfix">

        @foreach($stations as $station)
            <div class="col-lg-3 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{$station['name']}}</h3>
                    </div>
                    <div class="card-body">
                        <div id="" style="height: 200px;">

                                <div class="details mt-2">
                                    <span>Total Visit</span>
                                        <h3 class="mb-0 counter" style="width: 75%; display: inline-block">{{$station['numVisits']}}</h3>

                                    <i class="fas fa-procedures fa-2x" style="color:{{$station['background']}} "></i>
                                </div>
                                <div class="details mt-2">
                                    <span>Total Satisfied Visit</span>
                                        <h3 class="mb-0 counter" style="width: 75%; display: inline-block">{{$station['numSat']}}</h3>
                                    <i class="fas fa-smile fa-2x" style="color:{{$station['background']}} "></i>
                                </div>
                                <div class="details mt-2">
                                    <span>Total Unsatisfied Visit</span>
                                        <h3 class="mb-0 counter" style="width: 75%; display: inline-block">{{$station['numUnsat']}}</h3>
                                    <i class="fas fa-sad-tear fa-2x" style="color:{{$station['background']}} "></i>
                                </div>


                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@push('js')
    <script>
        $(function() {
            "use strict";
            $('.counter').counterUp({
                delay: 10,
                time: 1000
            });

            function getRandomValues() {
                // data setup
                var values = new Array(20);

                for (var i = 0; i < values.length; i++) {
                    values[i] = [5 + randomVal(), 10 + randomVal(), 15 + randomVal(), 20 + randomVal(), 30 + randomVal(),
                        35 + randomVal(), 40 + randomVal(), 45 + randomVal(), 50 + randomVal()
                    ];
                }

                return values;
            }
            function randomVal() {
                return Math.floor(Math.random() * 80);
            }

            // MINI BAR CHART
            var values2 = getRandomValues();
            var paramsBar = {
                type: 'bar',
                barWidth: 5,
                height: 25,
            };

            $('#mini-bar-chart1').sparkline(values2[0], paramsBar);
            paramsBar.barColor = '#6c757d';
            $('#mini-bar-chart2').sparkline(values2[1], paramsBar);
            paramsBar.barColor = '#6c757d';
            $('#mini-bar-chart3').sparkline(values2[2], paramsBar);
            paramsBar.barColor = '#6c757d';
            $('#mini-bar-chart4').sparkline(values2[3], paramsBar);
            paramsBar.barColor = '#6c757d';

        });

    </script>


@endpush
