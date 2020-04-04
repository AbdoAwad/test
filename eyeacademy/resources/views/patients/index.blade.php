@extends('layouts.app', ['header_title' => 'Patient'])
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
  <div class="col-lg-12">
      <div class="card">
          <div class="card-header">
              <h3 class="card-title">Patients</h3>
          </div>
          <div class="card-body">
              <button id="addToTable" class="btn btn-primary mb-15" type="button" style="float:right" data-toggle="modal" data-target="#modal" >
                  <i class="icon wb-plus" aria-hidden="true" ></i> Add patient
              </button>
              <div class="table-responsive">
                  <table class="table table-hover table-vcenter table-striped" cellspacing="0" id="addrowExample">
                      <thead>
                          <tr>
                              <th>id</th>
                              <th>Patient Name</th>
                              <th>Patient File Number</th>
                              <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach($patients as $patient)
                          <tr class="gradeA">
                              <td >#{{$patient->id}}</td>
                              <td >{{$patient->name}}</td>
                              <td>{{$patient->file_number}}</td>

                              <td class="actions">
                                  <button class="btn btn-sm btn-icon on-editing m-r-5 button-save"
                                  data-toggle="tooltip" data-original-title="Save" hidden><i class="icon-drawer" aria-hidden="true"></i></button>
                                  <button class="btn btn-sm btn-icon on-editing button-discard"
                                  data-toggle="tooltip" data-original-title="Discard" hidden><i class="icon-close" aria-hidden="true"></i></button>
                                  <a href="{{route('patient.view', $patient->id)}}" class="btn btn-sm btn-icon on-default m-r-5 button-edit"
                                  data-toggle="tooltip" data-original-title="Edit" ><i class="icon-pencil" aria-hidden="true"></i></a>
                                  <form id="form" method="POST" style="display:inline;"action="{{route('patient.delete', $patient->id)}}"  enctype="multipart/form-data">
                                      @csrf
                                      {{ method_field('DELETE') }}
                                      <button class="btn btn-sm btn-icon on-default button-remove"
                                      data-toggle="tooltip" data-original-title="Remove"><i class="icon-trash" aria-hidden="true"></i></button>
                                  </form>
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
</div>

@endsection
@push('modal')
<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="padding-top: 12%;">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3ca9cd; color: #fff; padding: 20px;">
                <h5 class="modal-title" id="exampleModalLabel">Add Patient</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: #fff;">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form" method="POST" action="{{route('patient')}}"  enctype="multipart/form-data">
                    @csrf
                    <div class="row clearfix p-2">
                        <div class="col-sm-6">
                          <div class="form-group ">
                              <label class="form-label">Name</label>
                              <input name="name" autocomplete="off" required type="text" class="form-control circle" >
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group ">
                              <label class="form-label">File Number</label>
                              <input name="file_number" autocomplete="off" required type="text" class="form-control circle" >
                          </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" data-submit="form">Add Patiet</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endpush
