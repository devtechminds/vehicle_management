@extends('layouts.master')
@section('content')
<div class="page-header card">
   <div class="row align-items-end">
      <div class="col-lg-6">
         <div class="page-header-title">
            <i class="feather icon-clipboard bg-c-blue"></i>
            <div class="d-inline">
               <h2>Vehicle Entry Updates

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
               <li class="breadcrumb-item"><a href="#!">Admin Update

</a></li>
               <li class="breadcrumb-item">
                  <a href="#!"> Update Entry

</a>
               </li>
            </ul>
         </div>
      </div>
   </div>
</div>
<div class="pcoded-inner-content">
   <div class="main-body">
   <form action="{{route('update.entry.submit')}}" id="myform" method="post">
      @csrf
      <div class="page-wrapper">
         <div class="page-body">
            <div class="row">
               <div class="col-sm-12">
                  <!-- <div class="card">
                     <div class="card-block">
                      
                       <input type="hidden" name="manifesto_entry_id" value="{{ $gate_entry->getManifestoEntry->id }}">
                       <input type="hidden" name="document_upload_id" value="{{ $gate_entry->id }}">
                           <div class="form-group row">
                              <div class="col-sm-2">
                                 <p class="bigf">Ref No:</p>
                                 <input type="text" name="ref_no" class="form-control bld sdt" value="{{ $gate_entry->getManifestoEntry->ref_no}} " placeholder="" readonly="">
                              </div>
                              <div class="col-sm-8">
                              </div>
                              <div class="col-sm-2">
                                 <p class="bigf">Date:</p>
                                 <input type="text" name="date" class="form-control bld" value="{{ $gate_entry->getManifestoEntry->date}}" placeholder="" readonly="">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Type of Consignment</label>
                              <div class="col-sm-4">
                              <select name="consignment_type" id="consignment_type" class="form-control boxbrd">
                                    <option value="">Select Consignment Type</option>
                                    @foreach($consignments as $consignment)
                                    <option {{($consignment['id']== $gate_entry->getManifestoEntry->consignment_type)?"selected":''}} value="{{ $consignment['id'] }}">{{ ucwords($consignment['consignment_type']) }}</option>
                                    @endforeach
                                 </select>
                              </div>
                              <label class="col-sm-2 col-form-label">Gate Entry No</label>
                              <div class="col-sm-4">
                                 <input type="text" name="gate_entry_no" class="form-control" value="{{ $gate_entry->gate_entry_no}}" placeholder="" readonly="">
                              </div>
                              
                           </div>

                           <div class="form-group row">
                              
                              <label class="col-sm-2 col-form-label"> Gate Pass No</label>
                              <div class="col-sm-4">
                                 <input type="text" name="gate_pass_no" class="form-control" value="{{ $gate_pass_no}}" placeholder="" readonly="">
                              </div>
                              
                           </div>

                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Cargo Ref No</label>
                              <div class="col-sm-4">
                                 <input type="text" name="cargo_reference_no" class="form-control" value="{{ $gate_entry->getManifestoEntry->cargo_reference_no}}" placeholder="Enter Cargo Ref No" >
                              </div>
                              <label class="col-sm-2 col-form-label">Type of Cargo</label>
                              <div class="col-sm-4">
                              <select name="cargo_type" id="cargo_type" class="form-control boxbrd">
                                    <option value="">Select Cargo Type</option>
                                    @foreach($cargos as $cargo)
                                       <option  {{($cargo['cargo_code']== $gate_entry->getManifestoEntry->cargo_type)?"selected":''}}  value="{{ $cargo['cargo_name'] }}/{{ $cargo['cargo_code'] }}">{{ucwords( str_replace('_',' ',$cargo['cargo_name'])) }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Delivery Note No</label>
                               <div class="col-sm-4">
                                 <input type="text" name="delivery_note_no"  id="delivery_note_no" class="form-control" value="{{ $gate_entry->getManifestoEntry->delivery_note_no}}" placeholder="" >
                              </div>
                              <label class="col-sm-2 col-form-label">No of Package  </label>
                              <div class="col-sm-4">
                                 <input type="text" name="no_package" id="no_package" class="form-control" value="{{ $gate_entry->getManifestoEntry->no_package}}" placeholder="" >
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Booking No </label>
                              <div class="col-sm-4">
                                 <input type="text" name="booking_no" id="booking_no" class="form-control" value="{{ $gate_entry->getManifestoEntry->booking_no}}" placeholder="" >
                              </div>
                              <label class="col-sm-2 col-form-label">Consignment Weight  </label>
                              <div class="col-sm-4">
                                 <input type="text" name="consignment_wgt" id="consignment_wgt" class="form-control" value="{{ $gate_entry->getManifestoEntry->consignment_wgt}}" placeholder="" >
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">CF Agent </label>
                              <div class="col-sm-4">
                              <select name="cf_agent" id="cf_agent" class="form-control boxbrd">
                                    <option value=""> Select Agent Name</option>
                                    @foreach($agents as $agent)
                                    <option {{($agent['agent_code']== $gate_entry->getManifestoEntry->cf_agent)?"selected":''}} value="{{ $agent['agent_code'] }}">{{ucwords( str_replace('_',' ',$agent['agent_name'])) }}</option>
                                    @endforeach
                                 </select>
                              </div>
                              <label class="col-sm-2 col-form-label">Customer Name </label>
                              <div class="col-sm-4">
                              <select name="customer_name"  id="customer_name" class="form-control boxbrd">
                                    <option value="">Customer Name</option>
                                    @foreach($customers as $customer)
                                    <option {{($customer['customer_code']== $gate_entry->getManifestoEntry->customer_name)?"selected":''}} value="{{ $customer['customer_code'] }}">{{ucwords( str_replace('_',' ',$customer['customer_name'])) }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                       
                     </div>
                  </div> -->
<!---------------------------------------------------------------------->

<div class="card">
                     <div class="card-block">

                   <input type="hidden" name="manifesto_entry_id" value="{{ $gate_entry->getManifestoEntry->id }}">
                       
                           <div class="form-group row">
                              <div class="col-sm-2">
                                 <p class="bigf">Ref No:</p>
                                 <input type="text" name="ref_no" id="ref_no" class="form-control bld" value="{{$gate_entry->getManifestoEntry->ref_no}}" placeholder="" readonly="">
                                 <input type="hidden" name="id" id="id" class="form-control bld" value="{{$gate_entry->getManifestoEntry->id}}" placeholder="" readonly="">
                              </div>
                              <div class="col-sm-8">
                              </div>
                              <div class="col-sm-2">
                                 <p class="bigf">Date:</p>
                                 <input type="text" name="date" id="date" class="form-control bld" value="{{ $gate_entry->getManifestoEntry->date}}" placeholder="" readonly="">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Type of Consignment</label>
                              <div class="col-sm-4">
                                 <select name="consignment_type" id="consignment_type" class="form-control boxbrd">
                                    <option value="">Select Consignment Type</option>
                                    @foreach($consignments as $consignment)
                                    <option {{ $consignment['id']== $gate_entry->getManifestoEntry->consignment_type?'selected':'' }} value="{{ $consignment['id'] }}">{{ ucwords($consignment['consignment_type']) }}</option>
                                    @endforeach
                                 </select>
                              </div>
                              <label class="col-sm-2 col-form-label">Type of Cargo</label>
                              <div class="col-sm-4">
                                 <select name="cargo_type" id="cargo_type" class="form-control boxbrd">
                                    <option value="">Select Cargo Type</option>
                                    @foreach($cargos as $cargo)
                                       <option {{ $cargo['cargo_code']== $gate_entry->getManifestoEntry->cargo_type?'selected':'' }} value="{{ $cargo['cargo_name'] }}/{{ $cargo['cargo_code'] }}">{{ucwords( str_replace('_',' ',$cargo['cargo_name'])) }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>

                           <div class="form-group row">
                              
                              <label class="col-sm-2 col-form-label"> Gate Pass No</label>
                              <div class="col-sm-4">
                                 <input type="text" name="gate_pass_no" class="form-control" value="{{ $gate_pass_no}}" placeholder="" readonly="">
                              </div>
                              <label class="col-sm-2 col-form-label">Gate Entry No</label>
                              <div class="col-sm-4">
                                 <input type="text" name="gate_entry_no" class="form-control" value="{{ $gate_entry->gate_entry_no}}" placeholder="" readonly="">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label cargo_ref_no_div">Cargo Ref No</label>
                              <div class="col-sm-4 cargo_ref_no_div">
                                 <input type="text" name="cargo_reference_no" id="cargo_reference_no" class="form-control" value="{{$gate_entry->getManifestoEntry->cargo_reference_no}}" placeholder="Enter Cargo Ref No">
                              </div>
                              <label class="col-sm-2 col-form-label ecd_name_div">ECD Name</label>
                              <div class="col-sm-4">
                                 <input type="text" name="ecd_name" id="ecd_name"  value="{{$gate_entry->getManifestoEntry->ecd_name}}" class="form-control ecd_name_div" placeholder="Enter ECD Name">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label delivery_note_no_div">Delivery Note No</label>
                              <div class="col-sm-4 delivery_note_no_div">
                                 <input type="text" name="delivery_note_no" id="delivery_note_no"  value="{{$gate_entry->getManifestoEntry->delivery_note_no}}" class="form-control" placeholder="Enter Delivery Note No">
                              </div>
                              <label class="total_no_of_container_div col-sm-2 col-form-label">Total No of Container</label>
                              <div class="col-sm-4 total_no_of_container_div">
                                 <input type="text" name="no_container" id="no_container"  value="{{$gate_entry->getManifestoEntry->no_container}}" class="form-control" placeholder="Enter Total No of Container">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Booking No </label>
                              <div class="col-sm-4">
                                 <input type="text" name="booking_no"  id="booking_no" value="{{$gate_entry->getManifestoEntry->booking_no}}"  class="form-control" placeholder="Enter Booking Number">
                              </div>
                              <label class="col-sm-2 col-form-label">Customer Name</label>
                              <div class="col-sm-4">
                                 <select name="customer_name"  id="customer_name" class="form-control boxbrd">
                                    <option value="">Customer Name</option>
                                    @foreach($customers as $customer)
                                    <option {{ $customer['customer_code']== $gate_entry->getManifestoEntry->customer_name?'selected':'' }}  value="{{ $customer['customer_code'] }}">{{ucwords( str_replace('_',' ',$customer['customer_name'])) }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">CF Agent </label>
                              <div class="col-sm-4">
                                 <select name="cf_agent" id="cf_agent" class="form-control boxbrd">
                                    <option value=""> Select Agent Name</option>
                                    @foreach($agents as $agent)
                                    <option {{ $agent['agent_code'] == $gate_entry->getManifestoEntry->cf_agent?'selected':'' }} value="{{ $agent['agent_code'] }}">{{ucwords( str_replace('_',' ',$agent['agent_name'])) }}</option>
                                    @endforeach
                                 </select>
                              </div>
                              <label class="col-sm-2 col-form-label">Consignment Weight  </label>
                              <div class="col-sm-4">
                                 <input type="number"  name="consignment_wgt" id="consignment_wgt" value="{{ $gate_entry->getManifestoEntry->consignment_wgt}}" class="form-control" placeholder="Enter Consignment Weight">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">No of Package  </label>
                              <div class="col-sm-4">
                                 <input type="number"  name="no_package" id="no_package"  value="{{ $gate_entry->getManifestoEntry->no_package}}" class="form-control" placeholder="Enter No of Package">
                              </div>
                           </div>
                        
                     </div>
                  </div>




<!---------------------------------------------------------------------->


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
                                 <input type="text" name="initiated_by" class="form-control" value="{{ $gate_entry->initiated_by }}" placeholder="Enter Initiated By" readonly >
                              </div>
                              <label class="col-sm-2 col-form-label">Interchange No </label>
                              <div class="col-sm-4">
                                 <input type="text" name="interchange_no" class="form-control" value="{{ $gate_entry->interchange_no}}" placeholder="Enter Interchange No" >
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Time In:  </label>
                              <div class="col-sm-4">
                                 <input type="text" name="time_in" class="form-control" value="{{ $gate_entry->time_in}}" placeholder="" readonly>
                              </div>
                              <label class="col-sm-2 col-form-label">Destination </label>
                              <div class="col-sm-4">
                                 <input type="text" name="destination" class="form-control" value="{{ $gate_entry->destination}}"  placeholder="Enter Destination">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Shipping Line </label>
                              <div class="col-sm-4">
                                 <input type="text" name="shipping_line" class="form-control" value="{{ $gate_entry->shipping_line}}"  placeholder="Enter Shipping Line">
                              </div>
                           </div>
                        
                     </div>
                  </div>

<!-- Weight Bridge Entry -->
@if($gate_entry->weighBridges)
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
<input type="hidden" name="weight_bridge_entry_id" value="{{ $gate_entry->weighBridges->id}}">
<input type="text" name="wb_ticket_no" class="form-control fill" value="{{ $gate_entry->weighBridges->wb_ticket_no}}" placeholder="Enter WB Ticket Number">
</div>
<label class="col-sm-2 col-form-label">WB Gross Wt </label>
<div class="col-sm-4">
<input type="number" class="form-control" name="wb_gross_wt" id="wb_gross_wt" value="{{ $gate_entry->weighBridges->wb_gross_wt}}" placeholder="Enter WB Gross Wt" >
</div>
</div>


<div class="form-group row">

<label class="col-sm-2 col-form-label">Container Tare Wt </label>
<div class="col-sm-4">
<input type="number"  name="container_tare_wt"  id="container_tare_wt" class="form-control calculate" value="{{ $gate_entry->weighBridges->container_tare_wt}}" placeholder="Enter Container Tare Wt"  >
</div>

<label class="col-sm-2 col-form-label">WB Tare Wt</label>
<div class="col-sm-4">
@if($gate_entry->weighBridges->status == 1)
<input type="number"  class="form-control calculate" name="wb_tare_wt" id="wb_tare_wt" value="{{ $gate_entry->weighBridges->wb_tare_wt}}" placeholder="Enter WB Tare Wt">
@else
<input type="number"  class="form-control calculate" name="wb_tare_wt" id="wb_tare_wt" value="{{ $gate_entry->weighBridges->wb_tare_wt}}" placeholder="Enter WB Tare Wt" readonly="">
@endif
</div>
</div>    

<div class="form-group row">
<label class="col-sm-2 col-form-label">WB Net Wt </label>
<div class="col-sm-4">
<input type="text" class="form-control " name="wb_net_wt" id="wb_net_wt" value="{{ $gate_entry->weighBridges->wb_net_wt}}" placeholder="" readonly="">
</div>

</div>


</form>

</div>
</div>
@endif
 
<!-- Field Supervisor Entry -->
@if($upload_document_entry)
<div class="card">
<div class="card-block">

    <div class="form-group row tblrw" style="border-bottom: 1px solid;
    margin-bottom: 15px;">
  <div class="col-sm-12">      
 <h4>Field Supervisor Entry</h4> 
 </div></div>  
 <input type="hidden" name="field_supervisor_entry" value="{{$upload_document_entry->id}}">
 <input type="hidden" name="document_upload_id" value="{{ $upload_document_entry->id }}">  
<div class="form-group row fheigt">
<label class="col-sm-2 col-form-label ">Field Supervisor Name: </label>
<div class="col-sm-4">
<input type="hidden" name="field_supervisor_entry_id" value="{{ $upload_document_entry->id}}">
<input type="text" name="field_supervisor_name" id="field_supervisor_name" class="form-control " value="{{ $upload_document_entry->field_supervisor_name}}" placeholder="" >
</div>
<label class="col-sm-2 col-form-label ">Container Physical Status: </label>
<div class="col-sm-4">
<input type="text" class="form-control" name="container_physical_status" id="container_physical_status" value="{{ $upload_document_entry->container_physical_status}}" placeholder="" >
</div>

</div>

<div class="form-group row  fheigt">

<label class="col-sm-2 col-form-label ">Location : </label>
<div class="col-sm-4">
<select name="location"  id="location" class="form-control boxbrd">
      <option value="">Select Location</option>
      @foreach($locations as $location)
      <option {{($location['id']== $upload_document_entry->location)?"selected":''}} value="{{ $location['id'] }}">{{ucwords( str_replace('_',' ',$location['location'])) }}</option>
      @endforeach
   </select>


</div>
<label class="col-sm-2 col-form-label ">Date:</label>
<div class="col-sm-4">
<input type="text" class="form-control" name="field_supervisor_entry_date"  id="field_supervisor_entry_date" value="{{ $upload_document_entry->field_supervisor_entry_date}}" placeholder="" readonly="">
</div>
</div>

<div class="form-group row fheigt">
<label class="col-sm-2 col-form-label">No of Package : </label>
<div class="col-sm-4">
<input type="text" class="form-control " name="no_of_package_field_supervisor" id="no_of_package_field_supervisor" value="{{ $upload_document_entry->no_of_package}}" placeholder="" >
</div>

</div>

<div class="form-group row fheigt">

<label class="col-sm-2 col-form-label ">Remarks:</label>
<div class="col-sm-10">
<textarea class="form-control" name="remarks" id="remarks" value="" placeholder="" >{{ $upload_document_entry->remarks}}</textarea>
</div>


</div>
</form>

</div>
</div>
@endif


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
                                       
                                          <td><input name="report_no" type="text" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->report_no}}" placeholder="Enter Report No" ></td>
                                          <td><input type="date" name="carry_in_date" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->carry_in_date}}" placeholder="Carry In Date" ></td>
                                          <td><input type="text"  name="container_no" class="form-control cwth container_no" value="{{$gate_entry->getConsignmentDetails->container_no}}" placeholder="Enter Container No" ></td>
                                          <td><input type="number"  name="size" class="form-control cwth size" value="{{$gate_entry->getConsignmentDetails->size}}" placeholder="Enter Size" ></td>
                                          <td><input type="text"  name="seal_s_no1" class="form-control cwth seal_s_no1" value="{{$gate_entry->getConsignmentDetails->seal_s_no1}}" placeholder="Enter Seal S.NO1" ></td>
                                          <td >
                                                   <select style="width: auto;" name="commodity" class="form-control boxbrd required clone_input commodity_select">
                                                   <option value="">Select Commodity</option>
                                                   @foreach($commodity as $commoditys)
                                                   <option {{ ($commoditys['commodity_code']== $gate_entry->getConsignmentDetails->commodity)?"selected":'' }} value="{{ $commoditys['commodity_code'] }}">{{ucwords( str_replace('_',' ',$commoditys['commodity_name'])) }}</option>
                                                   @endforeach
                                                   </select>
                                                </td>
                                                <td>
                                                <select   style="width: auto;" name="material"  class="form-control boxbrd required clone_input material_select">
                                                   <option value="">Select Material</option>
                                                   @foreach($materials as $material)
                                                   <option   {{ ($material['id']== $gate_entry->getConsignmentDetails->material)?"selected":'' }} value="{{ $material['id'] }}">{{ucwords( str_replace('_',' ',$material['material_name'])) }}</option>
                                                   @endforeach
                                                   </select>
                                                </td>
                                                <td>
                                                <select  style="width: auto;" name="uom" id="uom" class="form-control boxbrd  clone_input">
                                                   <option value="">Select UOM</option>
                                                   @foreach($uoms as $uom)
                                                   <option {{ ($uom['id']== $gate_entry->getConsignmentDetails->uom)?"selected":'' }} value="{{ $uom['id'] }}">{{ucwords( str_replace('_',' ',$uom['unit_entry_filed'])) }}</option>
                                                   @endforeach
                                                   </select>
                                                </td>
                                          
                                          <td><input type="text"  name="declared_wgt"  class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->declared_wgt}}" placeholder="Enter Declared Wgt" ></td>
                                          <td><input type="text" name="truck_no" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->truck_no}}" placeholder="Enter Truck No" ></td>
                                          <td><input type="text" name="trailer_no" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->trailer_no}}" placeholder="Enter Trailer No" ></td>
                                          <td><input type="text" name="driver_name" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->driver_name}}" placeholder="Enter Driver Name" ></td>
                                          <td><input type="text" name="driver_lic_no" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->driver_lic_no}}" placeholder="Enter Driver Lic.No" ></td>
                                          <!-- <td>
                                                <select  name="transporter" id="" class="form-control boxbrd clone_input">
                                                  <option value="">Select Transporter</option>
                                                   @foreach($transports as  $transport)
                                                   <option {{$transport['transport_code']== $gate_entry->getConsignmentDetails->transporter?'selected':''}}   value="{{$transport['transport_code']}}">{{$transport['transport_name']}}</option>
                                                   @endforeach 
                                                   </select>
                                                </td> -->
                                          <td><input type="text" name="transporter" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->transporter}}" placeholder="Enter Transporter"></td>
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
               <button class="btn btn-success waves-effect waves-light">Update</button>
	
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
  
   
  $(document).ready(function() {
   hideAndShow();
});
$("#cargo_type").change(function () {                            
   hideAndShow();
});

function hideAndShow(){
   var test = $('#cargo_type').val();
    cargo  =  test.substring(0, test.lastIndexOf("/"));
     console.log(cargo);

    $('.ecd_name_div').css('display','block');
    $('.total_no_of_container_div').css('display','block');
    $('.delivery_note_no_div').css('display','block');
    $('.cargo_ref_no_div').css('display','block');
    
    if(cargo == 'transit_full_container_comes_and_empty_container_goes_out_with_vehicle' || 
       cargo == 'transit_full_container_comes_and_full_container_goes_out_with_vehicle'||
       cargo =='transit_full_container_comes_and_empty_vehicle_goes_out'||
       cargo =='transit_loose_material_comes_in_and_empty_vehicle_goes_out'){
       $('.ecd_name_div').css('display','none');
       $('.total_no_of_container_div').css('display','none');
       $('.delivery_note_no_div').css('display','none');
       $('.booking_no_div').css('display','none');
       

    }else if(cargo == 'local_full_container_comes_and_empty_container_goes_out_with_vehicle'||
    cargo =="local_full_container_comes_and_full_container_goes_out_with_vehicle" ||
    cargo =="local_full_container_comes_and_empty_vehicle_goes_out" ||
    cargo =="local_loose_material_comes_in_and_empty_vehicle_goes_out"){
        $('.ecd_name_div').css('display','none');
        $('.total_no_of_container_div').css('display','none');
        $('.cargo_ref_no_div').css('display','none');
        $('.booking_no_div').css('display','none');
    }else if(cargo == 'empty_container_comes_in_and_empty_vehicle_goes_out.' ||
        cargo =="empty_vehicle_comes_in_and_empty_container_goes_out_with_vehicle" ||
        cargo =="empty_vehicle_comes_in_and_full_container_goes_with_vehicle" ){
        $('.cargo_ref_no_div').css('display','none');
        $('.booking_no_div').css('display','block');
        $('.delivery_note_no_div').css('display','none');
    }




    
    var consignment_type = $("#consignment_type").find("option:selected").text();
    if(consignment_type =='Empty' && cargo=='empty_container_comes_in_and_empty_vehicle_goes_out.' || cargo=='empty_vehicle_comes_in_and_empty_container_goes_out_with_vehicle' || cargo=='empty_vehicle_comes_in_and_full_container_goes_with_vehicle'){
      $("#consignment_wgt").attr('disabled','disabled');
      $("#no_package").attr('disabled','disabled');
      $('.seal_s_no1').attr('disabled','disabled');
      $('.container_no').removeAttr('disabled','disabled');
      $('.size').removeAttr('disabled','disabled');
   }else if((consignment_type =='Transit' && cargo=='transit_loose_material_comes_in_and_empty_vehicle_goes_out') || (consignment_type =='Local' && cargo=='local_loose_material_comes_in_and_empty_vehicle_goes_out')){
      $('.seal_s_no1').attr('disabled','disabled');
      $('.container_no').attr('disabled','disabled');
      $('.size').attr('disabled','disabled');
      $("#consignment_wgt").removeAttr('disabled');
      $("#no_package").removeAttr('disabled');
   }else{
      $("#consignment_wgt").removeAttr('disabled');
      $("#no_package").removeAttr('disabled');
      $('.seal_s_no1').removeAttr('disabled');
      $('.container_no').removeAttr('disabled','disabled');
      $('.size').removeAttr('disabled','disabled');
   }
   
}

$("#addMoreConsignment").click(function(){
   var counter = parseInt($('#counter').val());
   var $clone = $('table.tableExample tr.line:first').clone();
    console.log($clone);
    $clone.find("input").val("");
    $clone.find('label.error').remove();
    $clone.find('.error').removeClass('error');
    var data_children_count = $clone.find('td').attr("data-children-count");
      $clone.find('.clone_input').each(function() {
      this.name= this.name.replace('[0]', '['+counter+']');
   });
    $clone.append("<td><div class='rmv' ><i class='btn-danger fa fa-minus-circle' aria-hidden='true'></i></div></td>");
    $('table.tableExample').append($clone);
    $('#counter').val( counter + 1 );
});

$('.tableExample').on('click', '.rmv', function () {
   if (confirm('Do you want to delete this Consignment Details?')){
      $(this).closest('tr').remove();
   }else{
         return false;
   }
});

$('#myform').validate({ // initialize the plugin
    rules: {
      consignment_type: {
            required: true,
            
        },
        cargo_type: {
            required: true,
            
        },
        
        
        cargo_reference_no: {
            required: {
               depends: function(element) {
                  let myval = $('#cargo_type').val();
                  return (myval=='transit_full_container_comes_and_empty_container_goes_out_with_vehicle') ? false : true ;
               }
            
            }
        },

        ecd_name: {
            required: {
               depends: function(element) {
                  let myval = $('#cargo_type').val();
                  return (myval=='empty_vehicle_comes_in_and_full_container_goes_with_vehicle' || myval=='empty_vehicle_comes_in_and_empty_container_goes_out_with_vehicle' || myval=='empty_container_comes_in_and_empty_vehicle_goes_out.') ? false : true ;
               }
            
            },
        },


        wb_ticket_no: {
            required: true,
            
        },
      //   customer_name: {
      //       required: true,
            
      //   },
      //   cf_agent: {
      //       required: true,
      //   },
      //   consignment_wgt: {
      //       required: true,
           
      //   },
      //   no_package: {
      //       required: true,
           
      //   },

       
    },
    submitHandler: function (form) { // for demo
      $('#myform').submit();
    }
});

   $('#consignment_type').change(function() {
    var type = $(this).find("option:selected").text(); //get the current value's option
    $.ajax({
        type:'GET',
        url:'/cargo-type-changes/'+type,
        success:function(data){
            $("#cargo_type").html(data);
        }
    });
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


// $("#cargo_type").change(function () {                            
//     var test = $('#cargo_type').val();
//     cargo  =  test.substring(0, test.lastIndexOf("/"));
//      console.log(cargo);
//   //  $("#myform").validate(); //sets up the validator
//     $('.ecd_name_div').css('display','block');
//     $('.total_no_of_container_div').css('display','block');
//     $('.delivery_note_no_div').css('display','block');
//     $('.cargo_ref_no_div').css('display','block');
    
//     if(cargo == 'transit_full_container_comes_and_empty_container_goes_out_with_vehicle' || 
//        cargo == 'transit_full_container_comes_and_full_container_goes_out_with_vehicle'||
//        cargo =='transit_full_container_comes_and_empty_vehicle_goes_out'||
//        cargo =='transit_loose_material_comes_in_and_empty_vehicle_goes_out'){
//        $('.ecd_name_div').css('display','none');
//        $('.total_no_of_container_div').css('display','none');
//        $('.delivery_note_no_div').css('display','none');
//     }else if(cargo == 'local_full_container_comes_and_empty_container_goes_out_with_vehicle'||
//     cargo =="local_full_container_comes_and_full_container_goes_out_with_vehicle" ||
//     cargo =="local_full_container_comes_and_empty_vehicle_goes_out" ||
//     cargo =="local_loose_material_comes_in_and_empty_vehicle_goes_out"){
//         $('.ecd_name_div').css('display','none');
//         $('.total_no_of_container_div').css('display','none');
//         $('.cargo_ref_no_div').css('display','none');
//     }else if(cargo == 'empty_container_comes_in_and_empty_vehicle_goes_out.' ||
//         cargo =="empty_vehicle_comes_in_and_empty_container_goes_out_with_vehicle." ||
//         cargo =="empty_vehicle_comes_in_and_full_container_goes_with_vehicle" ){
//       $('.cargo_ref_no_div').css('display','none');
//       $('.delivery_note_no_div').css('display','none');
//     }                                                                                              
// });


$(".calculate").change(function(){
      WBNetWt();
   });
   
   $(".calculate").keypress(function(){
      WBNetWt();
   });
   $("#wb_gross_wt").change(function(){
      WBNetWt();
   });
   $("#wb_gross_wt").keypress(function(){
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

   

   </script>
@endsection