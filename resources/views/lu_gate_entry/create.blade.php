@extends('layouts.master')
@section('content')
<div class="page-header card">
   <div class="row align-items-end">
      <div class="col-lg-8">
         <div class="page-header-title">
            <i class="feather icon-clipboard bg-c-blue"></i>
            <div class="d-inline">
               <h3>TRUCK PARKING NOTE(LOADING)</h3>
            </div>
         </div>
      </div>
      <div class="col-lg-4">
         <div class="page-header-breadcrumb">
            <ul class=" breadcrumb breadcrumb-title">
               <li class="breadcrumb-item">
                  <a href="index.html"><i class="feather icon-home"></i></a>
               </li>
               <li class="breadcrumb-item"><a href="#!">Gate1 Entry Officer</a></li>
               <li class="breadcrumb-item">
                  <a href="#!">Loading Entry Screen</a>
               </li>
            </ul>
         </div>
      </div>
      <div class="col-lg-12">
      @if (count($errors) > 0)
      
         <div class="alert alert-danger">
            <ul>
               @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
               @endforeach
            </ul>
         </div>
      
      @endif

      @if (session('error'))
      <div class="alert alert-danger alert-dismissable custom-danger-box" style="margin: 15px;">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <strong> {{ session('error') }} </strong>
      </div>
      @endif
      @if (session('create'))
      <div class="alert alert-success alert-dismissable custom-success-box" style="margin: 15px;">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <strong> {{ session('create') }} </strong>
      </div>
      @endif
      </div>
   </div>
</div>
<div class="pcoded-inner-content">
<form action="{{route('loading.entry.store')}}" id="myform" method="post">
   <div class="main-body">
      <div class="page-wrapper">
         <div class="page-body">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-block">
                        @csrf
                           <div class="form-group row">
                           <div class="col-sm-2">
                           <p class="bigf">Token No:</p>
                           <input type="text" name="ref_no" id="ref_no" class="form-control bld sdt" value="{{$ref_no}}" placeholder="" readonly>
                           </div>
                           <div class="col-sm-8">

                           </div>
                           <div class="col-sm-2">
                           <p class="bigf">Date:</p>	
                           <input type="text" name="date" id="date" class="form-control bld"  value="{{ date('d-m-Y')}}" placeholder="" readonly>
                           </div>

                           </div>

                           <div class="form-group row">
                           <label class="col-sm-2 col-form-label">Customer Name</label>
                           <div class="col-sm-4">
                              <select name="customer_name"  id="customer_name" class="form-control boxbrd">
                                    <option value="">Customer Name</option>
                                    @foreach($customers as $customer)
                                    <option value="{{ $customer['customer_code'] }}">{{ucwords( str_replace('_',' ',$customer['customer_name'])) }}</option>
                                    @endforeach
                              </select>
                           </div>
                           <label class="col-sm-2 col-form-label">Commodity</label>
                           <div class="col-sm-4">
                              <select name="commodity" id="commodity" class="form-control boxbrd">
                                    <option value="">Select Commodity</option>
                                    @foreach($commoditys as $commodity)
                                       <option value="{{ $commodity['commodity_code'] }}">{{ucwords( str_replace('_',' ',$commodity['commodity_name'])) }}</option>
                                    @endforeach
                              </select>
                           </div>
                           </div>

                           <div class="form-group row">
                           <label class="col-sm-2 col-form-label">Truck No</label>
                           <div class="col-sm-4">
                           <input type="text" name="truck_no" id="truck_no" class="form-control" placeholder="">
                           </div>
                           <label class="col-sm-2 col-form-label">Trailer No</label>
                           <div class="col-sm-4">
                           <input type="text" name="trailer_no" id="trailer_no" class="form-control" placeholder="">
                           </div>
                           </div>

                           <div class="form-group row">
                           <label class="col-sm-2 col-form-label">Transporter</label>
                           <div class="col-sm-4">
                             <select name="transporter" id="transporter" class="form-control boxbrd">
                                    <option value="">Select Transporter</option>
                                    @foreach($transports as $transport)
                                       <option value="{{ $transport['transport_code'] }}">{{ucwords( str_replace('_',' ',$transport['transport_name'])) }}</option>
                                    @endforeach
                              </select>
                           </div>
                           <label class="col-sm-2 col-form-label">Driver Name</label>
                           <div class="col-sm-4">
                           <input type="text" name="driver_name" id="driver_name" class="form-control" placeholder="">
                           </div>
                           </div>

                           <div class="form-group row">
                           <label class="col-sm-2 col-form-label">Driver Ph </label>
                           <div class="col-sm-4">
                           <input type="text" name="driver_ph_no" id="driver_ph_no" class="form-control" placeholder="">
                           </div>
                           <label class="col-sm-2 col-form-label">Driver Lic</label>
                           <div class="col-sm-4">
                           <input type="text" name="driver_lic_no" id="driver_lic_no" class="form-control" placeholder="">
                           </div>
                           </div>

                           <div class="form-group row">
                           <label class="col-sm-2 col-form-label">Time In </label>
                           <div class="col-sm-4">
                           <input type="text" name="time_in" id="time_in" class="form-control" placeholder="" value="{{  date('h:i A', strtotime(now())) }}" readonly>{{  date_default_timezone_get()}}
                           </div>
                           <label class="col-sm-2 col-form-label">Destination (TO) </label>
                           <div class="col-sm-4">
                           <input type="text" name="destination" id="destination" class="form-control" placeholder="">
                           </div>
                           </div>


                           <div class="form-group row">
                           <label class="col-sm-2 col-form-label">Container No  </label>
                           <div class="col-sm-4">
                           <input type="text" name="container_no" id="container_no" class="form-control" placeholder="">
                           </div>
                           <label class="col-sm-2 col-form-label">Bl No </label>
                           <div class="col-sm-4">
                           <input type="text" name="bl_no" id="bl_no" class="form-control" placeholder="">
                           </div>
                           </div>

                           <div class="form-group row">
                           <label class="col-sm-2 col-form-label">Do No  </label>
                           <div class="col-sm-4">
                           <input type="text" name="dn_no" id="dn_no" class="form-control" placeholder="">
                           </div>
                           <label class="col-sm-2 col-form-label">Bl Qty </label>
                           <div class="col-sm-4">
                           <input type="text" name="bl_qty" id="bl_qty" class="form-control" placeholder="">
                           </div>
                           </div>

                           <div class="form-group row">
                           <label class="col-sm-2 col-form-label">DO Qty  </label>
                           <div class="col-sm-4">
                           <input type="text" name="dn_qty" id="dn_qty" class="form-control" placeholder="">
                           </div>
                           <label class="col-sm-2 col-form-label">Shipping Line</label>
                           <div class="col-sm-4">
                           <input type="text" name="shipping_line" id="shipping_line" class="form-control" placeholder="">
                           </div>
                           </div>

                           <div class="form-group row">
                           <label class="col-sm-2 col-form-label">Interchange No  </label>
                           <div class="col-sm-4">
                           <input type="text" name="interchange_no" id="interchange_no" class="form-control" placeholder="">
                           </div>
                           <label class="col-sm-2 col-form-label">TRA Seal No </label>
                           <div class="col-sm-4">
                           <input type="text" name="tra_seal_no" id="tra_seal_no" class="form-control" placeholder="">
                           </div>
                           </div>
                     </div>
                     <div class="card-block height">
                        <div class="row">
                           <div class="col-sm-12" style="text-align: center;">
                              <button class="btn btn-success waves-effect waves-light btnSubmitClick">Register</button>
                           </div>
                        </div>
                     </div>
                  </div>
                 
               </div>
            </div>
         </div>
      </div>
   </div>
   </form>
</div>
<style>
 .error {
      color: red;
   }
   table tr td {
      width: auto;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/jquery.validate.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/additional-methods.js"></script>


<script>
$('#myform').validate({ // initialize the plugin
    rules: {
      customer_name: {
            required: true,
            
        },
        commodity: {
            required: true,
            
        },
        truck_no: {
            required: true,
            
        },
        container_no: {
            required: true,
            
        },
        driver_name: {
            required: true,
        },
        transporter: {
            required: true,
           
        },
        

       
    },
    submitHandler: function (form) { // for demo
      $(".btnSubmitClick").addClass("disabled");
      $('#myform').submit();
    }
});



</script>
@endsection