@extends('layouts.master')
@section('content')
<div class="page-header card">
   <div class="row align-items-end">
      <div class="col-lg-6">
         <div class="page-header-title">
            <i class="feather icon-clipboard bg-c-blue"></i>
            <div class="d-inline">
               <h2>Upload Documents
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
                  </a>
               </li>
               <li class="breadcrumb-item">
                  <a href="#!">Upload Documents
                  </a>
               </li>
            </ul>
         </div>
      </div>
   </div>
</div>
<div class="pcoded-inner-content">
   <div class="main-body">
      <form action="{{route('supervisor.doc.upload.submit')}}" id="myform" method="post" enctype="multipart/form-data">
         @csrf
         <div class="page-wrapper">
            <div class="page-body">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="card">
                        <div class="card-block">
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
                              <input type="hidden" name="gate_entry_id" value="{{ $gate_entry->getGateEntry->id}}">
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

      <div class="form-group row tblrw" style="border-bottom: 1px solid;
         margin-bottom: 15px;">
      <div class="col-sm-12">      
      <h4>Weight Bridge Entry</h4> 
      </div></div>
      <div class="form-group row">
      <label class="col-sm-2 col-form-label">WB Ticket No </label>
      <div class="col-sm-4">
      <input type="hidden" name="weigh_bridges_id" value="{{ $gate_entry->id}}">
      <input type="text" name="wb_ticket_no" class="form-control fill" value="{{ isset($gate_entry->wb_ticket_no)?$gate_entry->wb_ticket_no:''}}" placeholder="" readonly="">
      </div>
      <label class="col-sm-2 col-form-label">WB Gross Wt </label>
      <div class="col-sm-4">
      <input type="number" class="form-control" name="wb_gross_wt" value="{{ isset($gate_entry->wb_gross_wt)?$gate_entry->wb_gross_wt:''}}" placeholder="Enter WB Gross Wt" readonly>
      </div>
      </div>
      <div class="form-group row">
      <label class="col-sm-2 col-form-label">Container Tare Wt </label>
      <div class="col-sm-4">
      <input type="text" name="container_tare_wt" class="form-control" value="{{ isset($gate_entry->container_tare_wt)?$gate_entry->container_tare_wt:''}}" placeholder="" readonly="">
      </div>
      <label class="col-sm-2 col-form-label">WB Tare Wt</label>
      <div class="col-sm-4">
      <input type="text" class="form-control" value="{{ isset($gate_entry->wb_tare_wt)?$gate_entry->wb_tare_wt:''}}" placeholder="" readonly="">
      </div>
      </div>    
      <div class="form-group row">
      <label class="col-sm-2 col-form-label">WB Net Wt </label>
      <div class="col-sm-4">
      <input type="text" class="form-control" value="{{ isset($gate_entry->wb_net_wt)?$gate_entry->wb_net_wt:''}}" placeholder="" readonly="">
      </div>
      </div>
     
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
      <input type="text" class="form-control " name="field_supervisor_name" value="{{auth()->user()->name}}" placeholder=" Enter Field Supervisor Name" readonly>
      </div>
      <label class="col-sm-2 col-form-label ">Container Physical Status: </label>
      <div class="col-sm-4">
      <input type="text" class="form-control "  name="container_physical_status" value="" placeholder="Enter Container Physical Status">
      </div>
      </div>
      <div class="form-group row  fheigt">
      <label class="col-sm-2 col-form-label ">Location : </label>
      <div class="col-sm-4">
      <select name="location" id="location" class="form-control boxbrd hgt">
      <option value="">Select Location</option>
      @foreach($locations as $location)
      <option value="{{ $location->id}}">{{ $location->location}}</option>
      @endforeach
      </select>
      </div>
      <label class="col-sm-2 col-form-label ">Date:</label>
      <div class="col-sm-4">
      <input type="text" class="form-control " name="field_supervisor_entry_date" value="{{date('d-m-Y')}}" placeholder="" readonly="">
      </div>
      </div>


      <div class="form-group row  fheigt">
      <label class="col-sm-2 col-form-label ">Area : </label>
      <div class="col-sm-4">
      <select name="area" id="area" class="form-control boxbrd hgt">
      <option value="">Select Area</option>
      
      </select>
      </div>
      <label class="col-sm-2 col-form-label ">Yard : </label>
     
       <div class="col-sm-4">
      <input type="taxt"   class="form-control " name="bin" value="" placeholder="Enter No of Yard">
      
      </div>
      </div>
  

      <div class="form-group row fheigt">
      <label class="col-sm-2 col-form-label">No of Package : </label>
      <div class="col-sm-4">
      <input type="number"  min="1" class="form-control " name="no_of_package" value="" placeholder="Enter No of Package">
      </div>
      <label class="col-sm-2 col-form-label ">File Upload:</label>
      <div class="col-sm-4">
      <input type="file" name="file_upload[]" accept="application/pdf, image/jpeg,image/jpg"  class="form-control" multiple>
      </div>    
      </div>
      <div class="form-group row fheigt">
      <label class="col-sm-2 col-form-label ">Remarks:</label>
      <div class="col-sm-10">
      <textarea class="form-control" name="remarks" value="" placeholder="Enter Remarks"></textarea>
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
      <div class="col-sm-5">
      Total Consignment : {{ $consignment_details_count['total']}} | 
      Remaining :{{ $consignment_details_count['pending']}}
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
      <th>Commodity</th>
      <th>Material</th>
      <th>UOM</th>
      <th>Declared Wgt</th>
      <th>Truck No</th>
      <th>Trailer No</th>
      <th>Driver Name </th>
      <th>Driver Lic.No </th>
      <th>Transporter</th>
      </tr>
      </thead>
      <tbody>
      <tr>
      <td><input type="text" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->report_no}}" placeholder="" readonly=""></td>
      <td><input type="text" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->carry_in_date}}" placeholder="" readonly=""></td>
      <td><input type="text" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->container_no}}" placeholder="" readonly=""></td>
      <td><input type="text" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->size}}" placeholder="" readonly=""></td>
      <td><input type="text" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->seal_s_no1}}" placeholder="" readonly=""></td>
      <td><input type="text" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->getCommodity->commodity_name}}" placeholder="" readonly=""></td>
      <td><input type="text" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->getMaterial->material_name}}" placeholder="" readonly=""></td>
      <td><input type="text" class="form-control cwth" value="{{isset($gate_entry->getConsignmentDetails->getUOM->unit_entry_filed)?$gate_entry->getConsignmentDetails->getUOM->unit_entry_filed:''}}" placeholder="" readonly=""></td>
      <td><input type="text" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->declared_wgt}}" placeholder="" readonly=""></td>
      <td><input type="text" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->truck_no}}" placeholder="" readonly=""></td>
      <td><input type="text" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->trailer_no}}" placeholder="" readonly=""></td>
      <td><input type="text" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->driver_name}}" placeholder="" readonly=""></td>
      <td><input type="text" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->driver_lic_no}}" placeholder="" readonly=""></td>
      <td><input type="text" name="transporter" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->transporter}}" placeholder="" readonly>
                                          <input type="hidden" value="{{$gate_entry->getConsignmentDetails->transporter}}" name="transporter">
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
      @if($gate_entry->status==0)
      <button class="btn btn-success waves-effect waves-light">Update</button>
      @endif
      @if($gate_entry->status==1)
      <a  href="{{route('supervisor.doc.upload.entry')}}" class="btn btn-success waves-effect waves-light">Back</a>
      @endif

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
         field_supervisor_name: {
               required: true,
               
           },
           container_physical_status: {
               required: true,
               
           },
           container_physical_status: {
               required: true,
               
           },

           location: {
               required: true,
               
           },

           no_of_package: {
               required: true,
               
           },
           'file_upload[]': {
               required: true,
               
           },
           remarks: {
               required: true,
               
           },
           area: {
               required: true,
               
           },
           
       },
       submitHandler: function (form) { // for demo
         $('#myform').submit();
       }
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
</script>
@endsection