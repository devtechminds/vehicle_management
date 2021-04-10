@extends('layouts.master')
@section('content')
<div class="page-header card">
   <div class="row align-items-end">
      <div class="col-lg-6">
         <div class="page-header-title">
            <i class="feather icon-clipboard bg-c-blue"></i>
            <div class="d-inline">
               <h2>Container Stuffing
 </h2>
            </div>
         </div>
      </div>
      <div class="col-lg-6">
         <div class="page-header-breadcrumb">
            <ul class=" breadcrumb breadcrumb-title">
               <li class="breadcrumb-item">
                  <a href="index.html"><i class="feather icon-home"></i></a>
               </li>
               <li class="breadcrumb-item"><a href="#!">Field Supervisor

</a></li>
               <li class="breadcrumb-item">
                  <a href="#!">Container Stuffing Update 
</a>
               </li>
            </ul>
         </div>
      </div>
   </div>
</div>
<div class="pcoded-inner-content">
   <div class="main-body">
   <form action="{{route('container.stuffing.update.submit')}}" id="myform" method="post">
      @csrf
      <div class="page-wrapper">
         <div class="page-body">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-block">
                       <input type="hidden" name="document_upload_id" value="{{ $gate_entry->id }}">
                       <input type="hidden" name="manifesto_entry_id" value="{{ $gate_entry->manifesto_entry_id }}">
                           <div class="form-group row">
                              <div class="col-sm-2">
                                 <p class="bigf">Ref No:</p>
                                 <input type="text" class="form-control bld sdt" value="{{ $gate_entry->getManifestoEntry->ref_no}} " placeholder="" readonly="">
                              </div>
                              <div class="col-sm-8">
                              </div>
                              <div class="col-sm-2">
                                 <p class="bigf">Date:</p>
                                 <input type="text" class="form-control bld" value="{{ $gate_entry->getManifestoEntry->date}}" placeholder="" readonly="">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Type of Consignment</label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control" value="{{ $gate_entry->getManifestoEntry->getConsignment->consignment_type}}" placeholder="" readonly="">
                              </div>
                              <label class="col-sm-2 col-form-label">Gate Entry No</label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control" value="{{ $gate_entry->getGateEntry->gate_entry_no}}" placeholder="" readonly="">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Cargo Ref No</label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control" value="{{ $gate_entry->getManifestoEntry->cargo_reference_no}}" placeholder="" readonly="">
                              </div>
                              <label class="col-sm-2 col-form-label">Type of Cargo</label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control" value="{{ ucwords( str_replace('_',' ',$gate_entry->getManifestoEntry->getCargo->cargo_name))}}" placeholder="" readonly="">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Delivery Note No</label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control" value="{{ $gate_entry->getManifestoEntry->delivery_note_no}}" placeholder="" readonly="">
                              </div>
                              <label class="col-sm-2 col-form-label">No of Package  </label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control" value="{{ $gate_entry->getManifestoEntry->no_package}}" placeholder="" readonly="">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Booking No </label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control" value="{{ $gate_entry->getManifestoEntry->booking_no}}" placeholder="" readonly="">
                              </div>
                              <label class="col-sm-2 col-form-label">Consignment Weight  </label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control" value="{{ $gate_entry->getManifestoEntry->consignment_wgt}}" placeholder="" readonly="">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">CF Agent </label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control" value="{{ $gate_entry->getManifestoEntry->getAgent->agent_name}}" placeholder="" readonly="">
                              </div>
                              <label class="col-sm-2 col-form-label">Customer Name </label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control" value="{{ $gate_entry->getManifestoEntry->getCustomers->customer_name}}" placeholder="" readonly="">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">BL No: </label>
                              <div class="col-sm-4">
                                 <input type="text" name="bl_no" class="form-control" value="" placeholder="Enter BL No" >
                              </div>
                              
                           </div>
                     </div>
                  </div>
                  <div class="card">
                     <div class="card-block">
                        <div class="form-group row tblrw" style="border-bottom: 1px solid;
                           margin-bottom: 15px;">
                           <div class="col-sm-8">
                              <h3 class="title">Gate Entry</h3>
                           </div>
                        </div>
                        
                           <div class="form-group row">
                           <input type="hidden" name="gate_entry_id" value="{{ $gate_entry->id}}">
                              <label class="col-sm-2 col-form-label">Initiated By  </label>
                              <div class="col-sm-4">
                                 <input type="text" name="initiated_by" class="form-control" value="{{ $gate_entry->getGateEntry->initiated_by }}" placeholder="Enter Initiated By" readonly>
                              </div>
                              <label class="col-sm-2 col-form-label">Interchange No </label>
                              <div class="col-sm-4">
                                 <input type="text" name="interchange_no" class="form-control" value="{{ $gate_entry->getGateEntry->interchange_no}}" placeholder="Enter Interchange No" readonly>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Time In:  </label>
                              <div class="col-sm-4">
                                 <input type="text" name="time_in" class="form-control" value="{{ $gate_entry->getGateEntry->time_in}}" placeholder="" readonly="">
                              </div>
                              <label class="col-sm-2 col-form-label">Destination </label>
                              <div class="col-sm-4">
                                 <input type="text" name="destination" class="form-control" value="{{ $gate_entry->getGateEntry->destination}}" readonly placeholder="Enter Destination">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Shipping Line </label>
                              <div class="col-sm-4">
                                 <input type="text" name="shipping_line" class="form-control" value="{{ $gate_entry->getGateEntry->shipping_line}}" readonly placeholder="Enter Shipping Line">
                              </div>
                           </div>
                        
                     </div>
                  </div>
                  <div class="card">
<div class="card-block">
<form>
    <div class="form-group row tblrw" style="border-bottom: 1px solid;
    margin-bottom: 15px;">
  <div class="col-sm-12">      
 <h4>Weight Bridge Entry</h4> 
 </div></div>
<div class="form-group row">
   
<label class="col-sm-2 col-form-label">WB Ticket No </label>
<div class="col-sm-4">
<input type="hidden" name="weight_bridge_entry_id" value="{{ $gate_entry->getWeighBridge->id}}">
<input type="text" name="wb_ticket_no" class="form-control fill" value="{{ $gate_entry->getWeighBridge->wb_ticket_no}}" placeholder="" readonly="">
</div>
<label class="col-sm-2 col-form-label">WB Gross Wt </label>
<div class="col-sm-4">
<input type="number" class="form-control" name="wb_gross_wt"  id="wb_gross_wt" value="{{ $gate_entry->getWeighBridge->wb_gross_wt}}" placeholder="Enter WB Gross Wt" readonly>
</div>
</div>


<div class="form-group row">

<label class="col-sm-2 col-form-label">Container Tare Wt </label>
<div class="col-sm-4">
<input type="number" min="1" name="container_tare_wt"  id="container_tare_wt" class="form-control calculate" value="{{ $gate_entry->getWeighBridge->container_tare_wt}}" placeholder="Enter Container Tare Wt" readonly >
</div>
<label class="col-sm-2 col-form-label">WB Tare Wt</label>
<div class="col-sm-4">
<input type="number" min="1" class="form-control calculate" name="wb_tare_wt" id="wb_tare_wt" value="{{ $gate_entry->getWeighBridge->wb_tare_wt}}" placeholder="Enter WB Tare Wt" readonly>
</div>
</div>    

<div class="form-group row">
<label class="col-sm-2 col-form-label">WB Net Wt </label>
<div class="col-sm-4">
<input type="text" class="form-control" name="wb_net_wt"  id="wb_net_wt" value="{{ $gate_entry->getWeighBridge->wb_net_wt}}" placeholder="" readonly="">
</div>

</div>


</form>

</div>
</div>

<div class="card">
<div class="card-block">

    <div class="form-group row tblrw" style="border-bottom: 1px solid;
    margin-bottom: 15px;">
  <div class="col-sm-12">      
 <h4>Field Supervisor Entry</h4> 
 </div></div>  
<div class="form-group row fheigt">
<label class="col-sm-2 col-form-label ">Field Supervisor Name: </label>
<div class="col-sm-4">
<input type="hidden" name="field_supervisor_entry_id" value="{{ $gate_entry->id}}">
<input type="text" name="field_supervisor_name" class="form-control " value="{{  $gate_entry->field_supervisor_name}}" placeholder="Entere Field Supervisor Name" readonly>
</div>
<label class="col-sm-2 col-form-label ">Container Physical Status: </label>
<div class="col-sm-4">
<input type="text" class="form-control" name="container_physical_status" value="{{$gate_entry->container_physical_status}}" placeholder="Enter Container Physical Status" readonly>
</div>

</div>

<div class="form-group row  fheigt">

<label class="col-sm-2 col-form-label ">Location : </label>
<div class="col-sm-4">
<select name="location"  id="location" class="form-control boxbrd"  disabled>
      <option value="">Select Location</option>
      @foreach($locations as $location)
      <option  {{ $location['id'] ==  $gate_entry->location ?'selected':'' }} value="{{ $location['id'] }}">{{ucwords( str_replace('_',' ',$location['location'])) }}</option>
      @endforeach
   </select>
</div>
<label class="col-sm-2 col-form-label ">Date:</label>
<div class="col-sm-4">
<input type="text" name="field_supervisor_entry_date" class="form-control " value="{{$gate_entry->field_supervisor_entry_date}}" placeholder="" readonly="">
</div>
</div>

<div class="form-group row  fheigt">

<label class="col-sm-2 col-form-label ">Area : </label>
<div class="col-sm-4">
<select name="area"  id="area" class="form-control boxbrd"  disabled>
      <option value="">Select Area</option>
      @foreach($areas as $area)
      <option  {{ $area->id ==  $gate_entry->area_id ?'selected':'' }} value="{{ $area->id }}">{{ucwords( str_replace('_',' ',$area->area)) }}</option>
      @endforeach
   </select>
</div>
<label class="col-sm-2 col-form-label ">Yard : </label>

<div class="col-sm-4">
<input type="text" name="bin" class="form-control "  value="{{ $gate_entry->bin_id}}" placeholder="Enter Yard" disabled>
</div>

</div>

<div class="form-group row fheigt">
<label class="col-sm-2 col-form-label">No of Package : </label>
<div class="col-sm-4">
<input type="number" name="no_of_package" class="form-control " min="1" value="{{ $gate_entry->no_of_package}}" placeholder="Enter No of Package" readonly>
</div>
<label class="col-sm-2 col-form-label">Uploaded File : </label>
<div class="col-sm-4">
@if(isset($gate_entry->getAllUploadDocumentsFiles))
@foreach($gate_entry->getAllUploadDocumentsFiles as $attachment)
<a href="{{route('download.document',['file'=>$attachment->document])}}" class="btn btn-large pull-right"><i class="fa fa-download" aria-hidden="true"> </i>  Document </a>
@endforeach
@endif
</div>
</div>

<div class="form-group row fheigt">

<label class="col-sm-2 col-form-label ">Remarks:</label>
<div class="col-sm-10">
<textarea class="form-control" name="remarks" value="" placeholder="Enter Remarks" disabled>{{ $gate_entry->remarks}}</textarea>
</div>


</div>
</form>

</div>
</div>
                  <div class="card">
                     <div class="card-block">
                        <div class="row">
                           <div class="col-sm-12">
                              <div class="form-group row tblrw" style="border-bottom: 1px solid;
                                 padding-bottom: 8px;">
                                 <div class="col-sm-6">
                                    <h3 class="title">Consignment Details (FULL)</h3>
                                 </div>

                                 <div class="col-sm-4">
                                 <input type="checkbox"> Verified by Custom Officer
                                 </div>
                                 <div class="col-sm-5">
                                    <!-- Total Consignment : {{ $consignment_details_count['total']}} | 
                                    Remaining :{{ $consignment_details_count['pending']}} -->
                                 </div>
                                 <div class="card-right ">	
                                    <button onclick="if (!window.__cfRLUnblockHandlers) return false; javascript:toggleFullScreen()" class="waves-effect waves-light btn waves-effect waves-dark btn-primary btn-outline-primary btn-icon" data-cf-modified-41c5a08083d3d25c74495efb-="">
                                    <i class="full-screen feather icon-maximize"></i>
                                    </button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        
                           <div class="card-block">
                              <div class="table-responsive">
                                 <table class="table table-hover m-b-0" id="tbl">
                                    <thead>
                                       <tr>
                                          <th>Report No</th>
                                          <th>Carry In Date</th>
                                          <th>Container No</th>
                                          <th>Size </th>
                                          <th>Seal S.NO1</th>
                                          <th>Seal S.NO2</th>
                                          <th>Commodity</th>
                                          <th>Material</th>
                                          <th>UOM</th>
                                          <th>Qty</th>
                                          <th>Lot No</th>
                                          <th>Location</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                       
                                          <td><input type="text" name="report_no" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->report_no}}" placeholder="" ></td>
                                          <td><input type="date" name="carry_in_date" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->carry_in_date}}" placeholder=""></td>
                                          <td><input type="text" name="container_no"  class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->container_no}}" placeholder="" ></td>
                                          <td><input type="number" name="size"  class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->size}}" placeholder="" ></td>
                                          <td><input type="text" name="seal_s_no1" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->seal_s_no1}}" placeholder=""></td>
                                          <td><input type="text" name="seal_s_no2" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->seal_s_no2}}" placeholder=""></td>
                                          <td >
                                                   <select style="width: auto;" name="commodity" class="form-control boxbrd required clone_input commodity_select">
                                                   <option value="">Select Commodity</option>
                                                   @foreach($commodity as $commoditys)
                                                   <option {{ $commoditys['commodity_code']== $gate_entry->getConsignmentDetails->commodity?'selected':''}} value="{{ $commoditys['commodity_code'] }}">{{ucwords( str_replace('_',' ',$commoditys['commodity_name'])) }}</option>
                                                   @endforeach
                                                   </select>
                                                </td>
                                                <td>
                                                <select   style="width: auto;" name="material"  class="form-control boxbrd required clone_input material_select">
                                                   <option value="">Select Material</option>
                                                   @foreach($materials as $material)
                                                   <option {{ $material['id']== $gate_entry->getConsignmentDetails->material?'selected':''}} value="{{ $material['id'] }}">{{ucwords( str_replace('_',' ',$material['material_name'])) }}</option>
                                                   @endforeach
                                                   </select>
                                                </td>
                                                <td>
                                                <select  style="width: auto;" name="uom" id="uom" class="form-control boxbrd required clone_input">
                                                   <option value="">Select UOM</option>
                                                   @foreach($uoms as $uom)
                                                   <option {{ $uom['id']== $gate_entry->getConsignmentDetails->uom?'selected':''}} value="{{ $uom['id'] }}">{{ucwords( str_replace('_',' ',$uom['unit_entry_filed'])) }}</option>
                                                   @endforeach
                                                   </select>
                                                </td>
                                          <td><input type="number" min="1" name="qty" class="form-control cwth" value="" placeholder="Enter Qty" ></td>
                                          <td><input type="text" name="lot_no" class="form-control cwth" value="" placeholder="Enter Lot No" ></td>  
                                          <td>
                                          <input type="text"  name="location_consignment" class="form-control cwth" value="" placeholder="Enter Location" >
                                                <!-- <select  style="width: auto;" name="location" id="location" class="form-control boxbrd required clone_input">
                                                   <option value="">Select Location</option>
                                                   @foreach($locations as $location)
                                                   <option  value="{{ $location['id'] }}">{{ucwords( str_replace('_',' ',$location['location'])) }}</option>
                                                   @endforeach
                                                   </select> -->
                                                </td>
                                       </tr>
                                    </tbody>
                                   
                                 </table>
                                 <input type="hidden" name="consignment_details_id" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->id}}"
                              </div>
                           </div>
                        
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-block height">
               <div class="form-group row dwn">
               <div class="col-sm-12" style="text-align: center;">
	<button class="btn btn-warning waves-effect waves-light">Update/Verify</button>
	<!-- <button class="btn btn-success waves-effect waves-light">Print <i class="fa fa-print"></i></button> -->
	
</div>
               </div>
            </div>
         </div>
      </div>
      </form>
   </div>
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

         
         
         bl_no: {
               required: true,
               
           },
    
         
         container_tare_wt: {
               required: true,
               
           },
   
           wb_tare_wt: {
               required: true,
               
           },   
            
           container_physical_status: {
               required: true,
               
           }, 
           
           location: {
               required: true,
               
           }, 

  
           location_consignment: {
               required: true,
               
           }, 
           
           no_of_package: {
               required: true,
               
           }, 
           remarks: {
               required: true,
               
           },
           report_no: {
               required: true,
           },
           carry_in_date: {
               required: true,
           },
           container_no: {
               required: true,
           },
           declared_wgt: {
               required: true,
           },
           carry_in_date: {
               required: true,
           },
           container_no: {
               required: true,
           },
           size: {
               required: true,
           },
           seal_s_no1: {
               required: true,
           },

           field_supervisor_name:{
            required: true,
           },
           

           seal_s_no2:{
            required: true,
           },

           qty:{
            required: true,
           },
           
           lot_no:{
            required: true,
           },
           area:{
            required: true,
           },
         //   bin:{
         //    required: true,
         //   },
       },
       submitHandler: function (form) { // for demo

       
         $('#myform').submit();
       }
   });

   $(document).on("change", ".commodity_select", function () {
    var id = $(this).val(); //get the current value's option
    var thisObj = $(this);
    $.ajax({
        type:'GET',
        url:'/get-material-by-comodity/'+id,
        success:function(data){
            thisObj.closest('td').next().find('select').html(data);
        }
    });
});


$(document).on("change", "#location", function () {
    var id = $(this).val(); //get the current value's option
    var thisObj = $(this);
    $.ajax({
        type:'GET',
        url:'/get-area-by-location/'+id,
        success:function(data){
          $('#area').html(data);
        }
    });
});

$(document).on("change", "#area", function () {
    var id = $(this).val(); //get the current value's option
    var thisObj = $(this);
    $.ajax({
        type:'GET',
        url:'/get-bin-by-area/'+id,
        success:function(data){
          $('#bin').html(data);
        }
    });
});

   $(".calculate").change(function(){
      WBNetWt();
   });
   
   $(".calculate").keypress(function(){
      WBNetWt();
   });
   function WBNetWt(){
      var container_tare_wt = $('#container_tare_wt').val();
      var wb_tare_wt = $('#wb_tare_wt').val();
      
      if(wb_tare_wt==''){
         wb_tare_wt = 0;
      }
      if(container_tare_wt==''){
         container_tare_wt = 0;
      }
      var add  = parseInt(container_tare_wt) + parseInt(wb_tare_wt);
      console.log(add);
      var wb_gross_wt = $('#wb_gross_wt').val(); 
      $('#wb_net_wt').val(parseInt(wb_gross_wt)-parseInt(add));
     
   } 
   </script>
@endsection