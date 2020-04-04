@extends('layouts.app', ['header_title' => 'Visits'])
@include('plugins.dropify')

@push('css')
<style>
    .plans-grid {
        display: grid;
        grid-gap: 20px;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }

    tr td{
        width: 20%;
    }

    .card-header .btn {
        width: 23%;
        box-shadow: 0 3px 3px 0 rgba(0,0,0,0.04), 0 1px 7px 0 rgba(0,0,0,0.08), 0 3px 1px -1px rgba(0,0,0,0.1)!important;
    }

    .visit_card {
        background-color: #fff;
        /*background-color: #fff;*/
        box-shadow: 0 3px 3px 0 rgba(0,0,0,0.04), 0 1px 7px 0 rgba(0,0,0,0.08), 0 3px 1px -1px rgba(0,0,0,0.1)!important;
    }

    .visit_card .card-body{
        background-color: rgba(0, 0, 0,0.3);
        border-radius: 10px;
        color: #fff;
        padding: 20px 0;
    }

    .action-model .card {
        height: 100px !important;
        padding: 0px;
    }

    .action-model .back-card{
        background-color: rgba(37, 151, 212,0.5);
        color: #fff;
        width: 100%;
        height: 100%;
        border-radius: 10px;
        padding: 20px;
    }

    .action-model .card-body{
        border-radius: 10px;
        height: 100%;
        background-position: right;
        background-size: 100px;
        background-repeat: no-repeat;
        padding: 0px;
        box-shadow: 0 3px 3px 0 rgba(0,0,0,0.14), 0 1px 7px 0 rgba(0,0,0,0.12), 0 3px 1px -1px rgba(0,0,0,0.2);
    }

    .ribbon .ribbon-box.green{
        background-color: #3ca9cd;
    }

    .ribbon .ribbon-box.green::before {
        border-color: #3ca9cd;
        border-right-color: transparent;
    }

    .finish-btn {
        background-color: #f48524;
        position: absolute;
        top: 15px;
        right: 10px;
        color: #fff;
    }

</style>
@endpush

@section('content')

<div class="row clearfix" style="width: 100%">
  <div class="col-lg-12">
      <div class="card" style="background-color: transparent">
        <div class="card-header">
            @if(auth()->user()->add_visit == 1)
                <button id="addToTable" class="btn btn-primary mb-15" type="button" style="" data-toggle="modal" data-target="#modal" >
                    <i class="icon wb-plus" aria-hidden="true" ></i> Add Visit
                </button>
            @endif
        </div>
        <div class="card-body">
            <div id="data_visit">
            </div>
        </div>
      </div>
  </div>
@endsection
@push('modal')
<!-- Modal -->

<div class="modal fade" id="modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="padding-top: 12%;">
        <div class="modal-content">

            <div class="modal-header" style="background-color: #3ca9cd; color: #fff; padding: 20px;">
                <h5 class="modal-title" id="exampleModalLabel">Add Patient</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: #fff;">&times;</span></button>
            </div>

            <div class="modal-body">
                <form id="form-add" method="POST" action="{{route('visit',$id)}}"  enctype="multipart/form-data">
                    @csrf
                    <div class="row clearfix p-2">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label">Patient Name</label>
                                <select name="patient_id" style="width: 100%" id="patient_id">
                                    <option></option>
                                    @foreach($patients as $patient)
                                    <option value="{{$patient->id}}">{{$patient->name}}</option>
                                    @endforeach

                                </select>

                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" data-submit="form"  id="add">Add Visit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


{{--<div class="modal fade action-model" id="action" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--    <div class="modal-dialog modal-lg" role="document" style="padding-top: 12%">--}}
{{--        <div class="modal-content" id="action_body">--}}
{{--            <div class="modal-body">--}}
{{--                <form id="form-add" method="POST" action="{{route('visit',$id)}}"  enctype="multipart/form-data">--}}
{{--                    @csrf--}}
{{--                    <div class="row clearfix p-2">--}}
{{--                        @foreach($stations as $station)--}}
{{--                            <div class="card c_grid c_yellow col-lg-4 m-2" style="background-color:{{$station->background}};">--}}
{{--                                <div class="card-body text-center" style="background-image: url('{{$station->image}}');">--}}
{{--                                    <div class="back-card">--}}
{{--                                        <h4 class="mb-3">{{$station->name}}</h4>--}}

{{--                                        <a type="button" class="btn btn-primary btn-sm display-visitors"  href="{{route('visit', $station->id)}}">Mone Visit</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                        @if(auth()->user()->add_visit == 1)--}}
{{--                            <button type="submit" class="btn btn-primary col-lg-4 m-2" data-submit="visit"><i class="fe fe-log-out"></i></button>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@endpush

@push('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="{{ asset('dashboard/js/select2.min.js') }}"></script>

    <script type="text/javascript">

        // let move = document.getElementById("moveTo");
        // var rect = move.getBoundingClientRect();
        //
        // let actionModel = document.getElementById("action_body");
        // let card = document.getElementById("visit_card");
        //
        // actionModel.style.position = "absolute";
        // actionModel.style.left = `${rect.left-card.offsetWidth}px`;
        // actionModel.style.top = `${rect.top}px`;


    $( document ).ready(function() {
        fetchData();
    });

    function fetchData(){
        console.log("hi")
    	$("#data_visit").load("{{ request()->fullUrl() }}");
    }

    $("#patient_id").select2({
        placeholder: "Select a Name",
        allowClear: true
    });


    $("#form-add").on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: new FormData(form[0]),
            dataType: 'json',
            async: true,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.status == 'success') {
                    Swal.fire({
                        title: data.title,
                        text: data.message,
                        type: data.status,
                        showCancelButton: false,
                        closeOnConfirm: true,
                    }).then((confirm) => {
                        if (confirm.value) {
                            $('#modal').hide();
                            $("#modal").removeClass("in");
                            $(".modal-backdrop").remove();
                            // $('#modal').modal('hide');
                            fetchData();
                            console.log("hi")
                            // location.reload(true);
                        }
                    });
                } else {
                    Swal.fire(data.title, data.message, data.status);
                }
            },
            error: function () {
                Swal.fire('Unexpected Error', 'The data cannot be sent. Please check your input.', 'error');
            }
        });
    });


        function update(track_id,id) {
            console.log(track_id);
            console.log(typeof( id));

            Swal.fire({
                title: "Confirm Finish?",
                text: "Any visit finish would not be recoverable. Proceed?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Finish",
                cancelButtonText: "Cancel",
                closeOnConfirm: false,
                closeOnCancel: true,
                showLoaderOnConfirm: true,
            }).then((confirm) => {
                    if (confirm.value) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: 'http://127.0.0.1:8000/station/1/visit/1',
                            method: 'put',
                            dataType: 'json',
                            async: true,
                            contentType: false,
                            processData: false,
                            success: function (data) {
                                //console.log(data);
                                Swal.fire({
                                    title: data.title,
                                    text: data.message,
                                    type: data.status,
                                    showCancelButton: false,
                                    closeOnConfirm: true,
                                }).then((confirm) => {
                                    if (confirm.value) {
                                        fetchData();
                                    }
                                });
                            },
                            error: function () {
                                Swal.fire('Unexpected Error', 'The data cannot be sent. Please check your input.', 'error');
                            },
                        });

                    }
                }
            );
        }

        // let clock = setInterval(() => {
        //     console.log("hi intervel")
        //     fetchData();
        // },10000);
</script>

{{--        <script>--}}
{{--            // Set the date we're counting down to--}}
{{--            var countDownDate = new Date("Jan 5, 2021 15:37:25").getTime();--}}

{{--            // Update the count down every 1 second--}}
{{--            var x = setInterval(function() {--}}

{{--                // Get today's date and time--}}
{{--                var now = new Date().getTime();--}}

{{--                // Find the distance between now and the count down date--}}
{{--                var distance = countDownDate - now;--}}

{{--                // Time calculations for days, hours, minutes and seconds--}}
{{--                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));--}}
{{--                var seconds = Math.floor((distance % (1000 * 60)) / 1000);--}}

{{--                // Display the result in the element with id="demo"--}}
{{--                document.getElementById("demo").innerHTML = minutes + "m " + seconds + "s ";--}}

{{--                // If the count down is finished, write some text--}}
{{--                if (distance < 0) {--}}
{{--                    clearInterval(x);--}}
{{--                    document.getElementById("demo").innerHTML = "EXPIRED";--}}
{{--                }--}}
{{--            }, 1000);--}}
{{--        </script>--}}

@endpush
