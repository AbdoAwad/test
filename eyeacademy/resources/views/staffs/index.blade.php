@extends('layouts.app', ['header_title' => 'Staff'])
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

    .user_avtar{
        width: 100px !important;
        padding-top:10px;
    }

    .rounded-circle {
        width: 100%;
        height: 85%;
        box-shadow: 0 3px 3px 0 rgba(0,0,0,0.14), 0 1px 7px 0 rgba(0,0,0,0.12), 0 3px 1px -1px rgba(0,0,0,0.2);
    }


</style>
@endpush

@section('content')
    @if( strcasecmp(auth()->user()->name,'super admin') == 0)
    <button id="addToTable" class="add btn btn-primary mb-15" type="button" style="float:right;" data-toggle="modal" data-target="#modal" >
        +
    </button>
    @endif
    <div class="row clearfix" style="padding-top: 5%;">
        @foreach($staffs as $staff)
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-body w_user">
                        <div class="user_avtar">
                            <img class="rounded-circle" src="{{url($staff->image)}}" alt="staff image">
                        </div>
                        <div class="wid-u-info">
                            <h5>{{$staff->name}}</h5>
                            <p class="text-muted m-b-0">{{$staff->email}}</p>
                            <ul class="list-unstyled">
                                <li>
                                    @if($staff->add_visit == 1)
                                        <h5 class="mb-0">Yes</h5>
                                    @else
                                        <h5 class="mb-0">No</h5>
                                    @endif
                                    <small>Add Visit</small>
                                </li>
                                <li>
                                    @if($staff->finish_visit == 1)
                                        <h5 class="mb-0">Yes</h5>
                                    @else
                                        <h5 class="mb-0">No</h5>
                                    @endif
                                    <small>Finish Visit</small>
                                </li>
                                @if(strcasecmp(auth()->user()->name,'super admin') == 0)
                                    <li style="padding-top:5px ">
                                        <form id="form" method="POST" style="display:inline;" action="{{route('staff.delete', $staff->id)}}"  enctype="multipart/form-data">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger btn-sm pull" style="background-color: #f48524"><i class="fa fa-trash-o"></i></button>
                                        </form>
                                        <a type="button" class="btn btn-primary btn-sm "href="{{route('staff.view', $staff->id)}}"><i class="fa fa-edit"></i></a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

@endsection

@push('modal')
<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="padding-top: 4%;">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3ca9cd; color: #fff; padding: 20px;">
                <h5 class="modal-title" id="exampleModalLabel">Add Staff</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: #fff;">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form" method="POST" action="{{route('staff')}}"  enctype="multipart/form-data">
                    @csrf
                    <div class="row clearfix p-2">
                        <div class="col-sm-6">
                          <div class="form-group ">
                              <label class="form-label">Name</label>
                              <input name="name" autocomplete="off" required type="text" class="form-control circle" >
                          </div>

                            <div class="form-group ">
                                <label class="form-label">Email</label>
                                <input name="email" autocomplete="off" required type="text" class="form-control circle" >
                            </div>

                            @if(auth()->user()->name == "super admin" || auth()->user()->name == "admin")
                                <div class="form-group">
                                    <label class="form-label">Can Add Visit</label>
                                    <div class="selectgroup w-100">

                                        <label class="selectgroup-item">
                                            <input type="radio" name="add_visit" value="1" class="selectgroup-input">
                                            <span class="selectgroup-button">Yes</span>
                                        </label>

                                        <label class="selectgroup-item">
                                            <input type="radio" name="add_visit" value="0" class="selectgroup-input"  checked>
                                            <span class="selectgroup-button">No</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Can Finish Visit</label>
                                    <div class="selectgroup w-100">
                                        <label class="selectgroup-item">
                                            <input type="radio" name="finish_visit" value="1" class="selectgroup-input" checked>
                                            <span class="selectgroup-button">Yes</span>
                                        </label>
                                        <label class="selectgroup-item">
                                            <input type="radio" name="finish_visit" value="0" class="selectgroup-input" checked>
                                            <span class="selectgroup-button">No</span>
                                        </label>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group ">
                                <label class="form-label">Password</label>
                                <input name="password" value="" autocomplete="off" required type="password" class="form-control circle" >
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group mt-2 mb-3" >
                                <label class="form-label">Staff's Image</label>
                                <input type="file" id="image" name="image" class="dropify">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" data-submit="form">Add Staff</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endpush
