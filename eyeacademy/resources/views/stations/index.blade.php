@extends('layouts.app', ['header_title' => 'Station'])
@include('plugins.dropify')

@push('css')
<style>
    .plans-grid {
        display: grid;
        grid-gap: 20px;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }

    .card {
        max-height: 250px;
        padding: 0px;
    }

    .back-card{
        background-color: rgba(0,0,0,0.5);
        color: #fff;
        width: 100%;
        height: 100%;
        border-radius: 10px;
        padding: 20px;
    }

    .card-body{
        border-radius: 10px;
        background-position: right;
        background-size: 250px;
        background-repeat: no-repeat;
        padding: 0px;
        box-shadow: 0 3px 3px 0 rgba(0,0,0,0.14), 0 1px 7px 0 rgba(0,0,0,0.12), 0 3px 1px -1px rgba(0,0,0,0.2);
    }

    .display-visitors{
        width: 50%;
        display: block;
        background-color: #666;
        margin: auto;
        margin-bottom: 10px;
    }

    @media (min-width: 992px){
        .col-lg-4 {
            flex: 0 0 31.333333%;
        }
    }

</style>
@endpush

@section('content')
<div class=" row clearfix">
    @if( strcasecmp(auth()->user()->name,'super admin') == 0)
        <button id="addToTable" class="add btn btn-primary mb-15" type="button" style="float:right;" data-toggle="modal" data-target="#modal" >
            +
        </button>
    @endif
    @foreach($stations as $station)
    @if(strcasecmp(auth()->user()->name,'super admin') == 0 || strcasecmp(auth()->user()->name,'admin') == 0 || $station->staff_id == auth()->user()->id)
         <div class="card c_grid c_yellow col-lg-4 m-2" style="background-color:{{$station->background}};">
            <div class="card-body text-center" style="background-image: url('{{$station->image}}');">
                <div class="back-card">
                    <h4 class="mb-0">{{$station->name}}</h4>
                    <br>
                    @foreach($staffs as $staff)
                        @if($staff->id == $station->staff_id)
                        <span style="">{{$staff->name}}</span>
                        @endif
                    @endforeach
                    <br>
                    <br>
                    <a type="button" class="btn btn-primary btn-sm display-visitors"  href="{{route('visit', $station->id)}}">Display Visits</a>
                    @if(strcasecmp(auth()->user()->name,'super admin') == 0)
                    <form id="form" method="POST" style="display:inline;" action="{{route('station.delete', $station->id)}}"  enctype="multipart/form-data">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger btn-sm pull" style="background-color: #f48524"><i class="fa fa-trash-o"></i></button>
                    </form>
                    <a type="button" class="btn btn-primary btn-sm " href="{{route('station.view', $station->id)}}"><i class="fa fa-edit"></i></a>
                    @endif
                </div>
            </div>
        </div>
    @endif
@endforeach

@endsection
@push('modal')
<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Station</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form" method="POST" action="{{route('station')}}"  enctype="multipart/form-data">
                    @csrf
                    <div class="row clearfix p-2" style="padding-top: 5%;">
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label class="form-label">Name</label>
                                <input name="name" autocomplete="off" required type="text" class="form-control circle" >
                            </div>

                            <div class="form-group ">
                                <label class="form-label">Warning Time</label>
                                <input name="warning_time" autocomplete="off" required type="number" class="form-control circle" >
                            </div>

                            <div class="form-group ">
                                <label class="form-label">Dangerous Time</label>
                                <input name="dangerous_time" autocomplete="off" required type="number" class="form-control circle" >
                            </div>

                            <div class="form-group " >
                                <label class="form-label">Background Color</label>
                                <div class="input-group colorpicker" id="demo-input">
                                    <input name="background" type="text" class="form-control" value="#00AABB" >
                                    <div class="input-group-append">
                                        <span class="input-group-text  "><span class="input-group-addon"><i></i></span> </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Staff Manger</label>
                                <select name="staff_id" id="select-countries" class="form-control custom-select package">
                                    <option selected disabled hidden>-- Choose one --</option>
                                    @foreach($staffs as $staff)
                                        <option value="{{$staff->id}}">{{$staff->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mt-2 mb-3" >
                                <label class="form-label">Station's Image</label>
                                <input type="file" id="image" required name="image" class="dropify">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" data-submit="form">Add Station</button>
                        </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endpush
@push('js')
    <script>
        $(function () {
            // Basic instantiation:
            $('#demo-input').colorpicker();

            // Example using an event, to change the color of the #demo div background:
            $('#demo-input').on('colorpickerChange', function(event) {
                $('#demo').css('background-color', event.color.toString());
            });
        });
    </script>
@endpush

