@extends('layouts.master')
@section('css')
<style>
   .error {
      color: red;
   }
</style>
@endsection
@section('content')
<div class="page-header card">
   <div class="row align-items-end">
      <div class="col-lg-6">
         <div class="page-header-title">
            <i class="feather icon-clipboard bg-c-blue"></i>
            <div class="d-inline">
               <h2>Yard Master Update </h2>
            </div>
         </div>
      </div>
      <div class="col-lg-6">
         <div class="page-header-breadcrumb">
            <ul class=" breadcrumb breadcrumb-title">
               <li class="breadcrumb-item">
                  <a href="index.html"><i class="feather icon-home"></i></a>
               </li>
               <li class="breadcrumb-item"><a href="#!">Yard Master</a></li>
               <li class="breadcrumb-item"><a href="#!">Yard Master Update</a></li>
            </ul>
         </div>
      </div>
   </div>
</div>
<div class="pcoded-inner-content">
   <div class="main-body">
      <div class="page-wrapper">
         <div class="page-body">
            @if(count($errors) > 0 )
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
               <ul class="p-0 m-0" style="list-style: none;">
                  @foreach($errors->all() as $error)
                  <li>{{$error}}</li>
                  @endforeach
               </ul>
            </div>
            @endif
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-block">
                        <form action="{{route('bin.update')}}" id="myform" method="post">
                           @csrf
                           @csrf
                        {{method_field('put')}}
                           <div class="form-group row">
                           <input type="hidden" name="id" value="{{ $bins->id}}">
                              <label class="col-sm-2 col-form-label">Yard</label>
                              <div class="col-sm-4">
                                 <input type="text" name="bin" value="{{ $bins->bin}}" class="form-control"
                                    placeholder="Enter Yard">
                              </div>
                              <label class="col-sm-2 col-form-label">Location</label>
                              <div class="col-sm-4">
                                 <select name="location_id" id="location_id" class="form-control boxbrd fill">
                                    <option value=''>Select Location</option>
                                    @foreach($locations as $location)
                                       <option {{ $location->id== $bins->location_id?'selected':'' }} value="{{$location->id}}">{{$location->location}}</option>
                                    @endforeach
                                 </select>
                              </div><br><br><br>
                              <label class="col-sm-2 col-form-label">Area</label>
                              <div class="col-sm-4">
                                 <select name="area" id="area" class="form-control boxbrd fill">
                                    <option value=''>Select Area</option>
                                    @foreach($area as $areas)
                                       <option {{ $areas->id== $bins->area_id?'selected':'' }} value="{{$areas->id}}">{{$areas->area}}</option>
                                    @endforeach
                                 </select>
                              </div>
                              <label class="col-sm-2 col-form-label">Status</label>
                              <div class="col-sm-4">
                                 <select name="status" class="form-control boxbrd fill">
                                    <option value=''>Select Status</option>
                                    <option {{ $bins->status ==1 ?'selected':'' }} value="1">Active</option>
                                    <option  {{ $bins->status ==0 ?'selected':'' }} value="0">Inactive</option>
                                 </select>
                              </div>
                           </div>
                           <div class="card">
                              <div class="card-block height">
                                 <div class="row">
                                    <div class="col-sm-12" style="text-align: center;">
                                       <button class="btn btn-success waves-effect waves-light">Update</button>
                                       <a href="{{route('bin.index')}}"
                                          class="btn btn-success waves-effect waves-light">Cancel</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/additional-methods.js"></script>
<script>

   $(document).ready(function () {
      $('#myform').validate({ // initialize the plugin
         rules: {
            bin: {
               required: true,
            },
            area: {
               required: true,
            },
            location_id: {
               required: true,
            },
            status: {
               required: true,
            }
         },
         submitHandler: function (form) { // for demo
            $('#myform').submit();
         }
      });
   });

   $(document).on("change", "#location_id", function () {
    var id = $(this).val(); //get the current value's option
    var thisObj = $(this);
    $.ajax({
        type:'GET',
        url:'/get-area-by-location/'+id,
        success:function(data){
           // thisObj.closest('td').next().find('select').html(data);
            $("#area").html(data);
        }
    });
});
</script>
@endsection