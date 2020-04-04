@extends('layouts.app', ['header_title' => 'Edit Station'])
@include('plugins.dropify')

@push('css')
<style>
    .plans-grid {
        display: grid;
        grid-gap: 20px;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }
</style>
@endpush

@section('content')
<div class="row clearfix">
<div class="col-lg-2"></div>
<div class="col-lg-8">
<div class="card" style="box-shadow: 0 3px 3px 0 rgba(0,0,0,0.14), 0 1px 7px 0 rgba(0,0,0,0.12), 0 3px 1px -1px rgba(0,0,0,0.2);">
    <div class="card-header">
        <h3 class="card-title">Edit Data</h3>
    </div>
    <div class="card-body">
      <form id="form" method="POST" action="{{route('station.update', $station->id)}}"  enctype="multipart/form-data">
          @csrf
          @method('PATCH')
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group ">
              <label class="form-label">Name</label>
              <input value="{{$station->name}}" name="name" autocomplete="off" required type="text" class="form-control circle" >
          </div>

            <div class="form-group ">
                <label class="form-label">Warning Time</label>
                <input value="{{$station->warning_time}}" name="warning_time" autocomplete="off" required type="number" class="form-control circle" >
            </div>

            <div class="form-group ">
                <label class="form-label">Dangerous Time</label>
                <input value="{{$station->dangerous_time}}" name="dangerous_time" autocomplete="off" required type="number" class="form-control circle" >
            </div>

            <div class="form-group " >
                <label class="form-label">Background Color</label>
                <div class="input-group colorpicker" id="demo-input">
                    <input name="background" type="text" class="form-control" value="{{$station->background}}" >
                    <div class="input-group-append">
                        <span class="input-group-text  "><span class="input-group-addon"><i></i></span> </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Staff</label>
                <select name="staff_id" id="select-countries" class="form-control custom-select package">
                    {{-- <option selected disabled hidden>-- Choose one --</option> --}}
                    @foreach($staffs as $staff)
                        @if($station->staff_id == $staff->id)
                            <option selected value="{{$staff->id}}">{{$staff->name}}</option>
                        @else
                            <option  value="{{$staff->id}}">{{$staff->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
          <div class="col-sm-6">
              <div class="form-group mt-2 mb-3" >
                  <label class="form-label">Station's Image</label>
                  <input data-default-file="{{url($station->image)}}" value="{{$station->image}}" type="file" id="image"  name="image" class="dropify">
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" data-submit="form">Update</button>
      </div>
    </form>
    </div>
</div>
@endsection
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
