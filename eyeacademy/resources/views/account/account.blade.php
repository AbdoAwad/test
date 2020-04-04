
@extends('layouts.app', ['header_title' => 'Account'])

@section('content')

<div class="row" >
    <div class="col-lg-2"></div>
  <div class="card c_grid c_yellow col-lg-8" style="background-image: url('{{asset('image/account.svg')}}'); background-position: right bottom; background-repeat: no-repeat; background-size: 400px;box-shadow: 0 3px 3px 0 rgba(0,0,0,0.14), 0 1px 7px 0 rgba(0,0,0,0.12), 0 3px 1px -1px rgba(0,0,0,0.2);">

      <div class="card-body text-center" style="">


          @if(auth()->user()->image == null)
              <div class="form-group col-lg-6" style="margin:20px auto;">
                  <img src="{{asset('image/user.png')}}" style="border-radius: 50%;" width="100" height="100">
              </div>
          @else
              <div class="form-group col-lg-6" style="margin:20px auto;">
                  <img src="{{ auth()->user()->image }}" style="border-radius: 50%;" width="100" height="100">
              </div>
          @endif
          <div class="form-group col-lg-6" style="margin:20px auto;">
              <input value="{{ auth()->user()->name }}" name="name" autocomplete="off" required type="text" class="form-control circle" disabled>
          </div>
          <div class="form-group col-lg-6" style="margin:20px auto;">
              <input value="{{ auth()->user()->email }}" name="email" autocomplete="off" required type="email" class="form-control circle" disabled>
          </div>

          @if(auth()->user()->add_visit == 1)
              <div class="form-group col-lg-6" style="margin:20px auto;">
                  <input name="" value="You Can Add Patient And Visit" autocomplete="off" required type="text" class="form-control circle" disabled>
              </div>
          @else
              <div class="form-group col-lg-6" style="margin:20px auto;">
                  <input name="" value="You Can Not Add Patient And Visit" autocomplete="off" required type="text" class="form-control circle" disabled>
              </div>
          @endif
          @if(auth()->user()->finish_visit == 1)
              <div class="form-group col-lg-6" style="margin:20px auto;">
                  <input name="password" value="You Can Finish  Visit" autocomplete="off" required type="text" class="form-control circle" disabled>
              </div>
          @else
              <div class="form-group col-lg-6" style="margin:20px auto;">
                  <input name="password" value="You Can Not Finish Visit" autocomplete="off" required type="text" class="form-control circle" disabled>
              </div>
          @endif
          <div class="form-group col-lg-6" style="margin:20px auto;">
              <input name="password" value="{{ auth()->user()->password }}" autocomplete="off" required type="password" class="form-control circle" disabled>
          </div>
          <a type="button" class="btn btn-primary btn-sm "href="{{route('account.view', auth()->user()->id)}}"><i class="fa fa-edit"></i></a>
          <br>
      </div>
  </div>

</div>

@endsection
