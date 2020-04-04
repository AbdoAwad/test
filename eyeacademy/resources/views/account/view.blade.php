@extends('layouts.app', ['header_title' => 'Edit Account'])
@include('plugins.dropify')

@push('css')
<style>
    .plans-grid {
        display: grid;
        grid-gap: 20px;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }

    .card-header {
        background-color: #6d6d6d;
        color: #fff;
        padding: 20px 20px 20px 20px;
    }
</style>
@endpush

@section('content')
<div class="row clearfix">
<div class="col-lg-2"></div>
<div class="col-lg-8">
<div class="card" style="box-shadow: 0 3px 3px 0 rgba(0,0,0,0.14), 0 1px 7px 0 rgba(0,0,0,0.12), 0 3px 1px -1px rgba(0,0,0,0.2);">
    <div class="card-header">
        <h3 class="card-title">Edit Account</h3>
    </div>
    <div class="card-body">
      <form id="form" method="POST" action="{{route('account.update', auth()->user()->id)}}"  enctype="multipart/form-data">
          @csrf
          @method('PATCH')
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group ">
              <label class="form-label">Name</label>
              <input value="{{auth()->user()->name}}" name="name" autocomplete="off" required type="text" class="form-control circle" >
          </div>
          <div class="form-group ">
              <label class="form-label">Email</label>
              <input value="{{auth()->user()->email}}" name="email" autocomplete="off" required type="email" class="form-control circle" >
          </div>
            @if(auth()->user()->name == "super admin" || auth()->user()->name == "admin")
            <div class="form-group">
                <label class="form-label">Can Add Visit</label>
                <div class="selectgroup w-100">

                    <label class="selectgroup-item">
                        @if(auth()->user()->add_visit == 1)
                            <input type="radio" name="add_visit" value="1" class="selectgroup-input" checked="">
                        @else
                            <input type="radio" name="add_visit" value="1" class="selectgroup-input">
                        @endif
                        <span class="selectgroup-button">Yes</span>
                    </label>

                    <label class="selectgroup-item">
                        @if(auth()->user()->add_visit == 1)
                            <input type="radio" name="add_visit" value="0" class="selectgroup-input" >
                        @else
                            <input type="radio" name="add_visit" value="0" class="selectgroup-input" checked>
                        @endif
                        <span class="selectgroup-button">No</span>
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Can Finish Visit</label>
                <div class="selectgroup w-100">
                    <label class="selectgroup-item">
                        @if(auth()->user()->finish_visit == 1)
                            <input type="radio" name="finish_visit" value="1" class="selectgroup-input" checked>
                        @else
                            <input type="radio" name="finish_visit" value="1" class="selectgroup-input">
                        @endif
                        <span class="selectgroup-button">Yes</span>
                    </label>
                    <label class="selectgroup-item">
                        @if(auth()->user()->finish_visit == 1)
                        <input type="radio" name="finish_visit" value="0" class="selectgroup-input" >
                        @else
                            <input type="radio" name="finish_visit" value="0" class="selectgroup-input" checked>
                        @endif
                        <span class="selectgroup-button">No</span>
                    </label>
                </div>
            </div>
            @endif
          <div class="form-group ">
              <label class="form-label">Password</label>
              <input name="password" value="{{auth()->user()->password}}" autocomplete="off" required type="password" class="form-control circle" >
          </div>

        </div>
          <div class="col-sm-6">
              <div class="form-group mt-2 mb-3" >
                  <label class="form-label">Account Image</label>
                  <input data-default-file="{{url(auth()->user()->image)}}" value="{{auth()->user()->image}}"  type="file" id="image" name="image" class="dropify">
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
