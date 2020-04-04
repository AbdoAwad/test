@extends('layouts.app', ['header_title' => 'Edit Patient'])
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
</style>
@endpush

@section('content')
<div class="row clearfix">
<div class="col-lg-2"></div>
<div class="col-lg-8">
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Patient</h3>
    </div>
    <div class="card-body">
      <form id="form" method="POST" action="{{route('patient.update', $patient->id)}}"  enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          <div class="row clearfix p-2">
              <div class="col-sm-6">
                <div class="form-group ">
                    <label class="form-label">Name</label>
                    <input name="name" value="{{$patient->name}}" autocomplete="off" required type="text" class="form-control circle" >
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group ">
                    <label class="form-label">File Number</label>
                    <input name="file_number" value="{{$patient->file_number}}" autocomplete="off" required type="text" class="form-control circle" >
                </div>
              </div>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" data-submit="form">Edit Patient</button>
          </div>
      </form>
    </div>
</div>

@endsection
