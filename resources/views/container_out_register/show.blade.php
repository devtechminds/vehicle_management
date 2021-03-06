@extends('layouts.master')
@section('content')
<div class="page-header card">
   <div class="row align-items-end">
      <div class="col-lg-6">
         <div class="page-header-title">
            <i class="feather icon-clipboard bg-c-blue"></i>
            <div class="d-inline">
               <h2>CFS Container Out
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
               <li class="breadcrumb-item"><a href="#!">Gate1 entry officer



</a></li>
               <li class="breadcrumb-item">
                  <a href="#!">  CFS Container Out

</a>
               </li>
            </ul>
         </div>
      </div>
   </div>
</div>
<div class="pcoded-inner-content">
   <div class="main-body">
   <form action="{{route('container.out.register.submit')}}" id="myform" method="post">
      @csrf
      <div class="page-wrapper">
         <div class="page-body">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-block">
                      
                       <input type="hidden" name="manifesto_entry_id" value="{{ $gate_entry->getManifestoEntry->id }}">
                       <input type="hidden" name="field_supervisor_entry_out_id" value="{{ $gate_entry->field_supervisor_entry_out_id }}">
                       <input type="hidden" name="weight_bridge_entry_id" value="{{ $gate_entry->getWeighBridge->id}}">
                        <input type="hidden" name="release_approval_finacial_officer_entries_id" value="{{$gate_entry->id}}">
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
                              <select name="consignment_type" id="consignment_type" class="form-control boxbrd" disabled>
                                    <option value="">{{ $gate_entry->getManifestoEntry->getConsignment->consignment_type}}</option>
                                    
                                 </select>
                              </div>
                              <label class="col-sm-2 col-form-label">Gate Entry No</label>
                              <div class="col-sm-4">
                                 <input type="text" name="gate_entry_no" class="form-control" value="{{ $gate_entry->getGateEntry->gate_entry_no}}" placeholder="" readonly="">
                              </div>
                              
                           </div>

                       
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Cargo Ref No</label>
                              <div class="col-sm-4">
                                 <input type="text" name="cargo_reference_no" class="form-control" value="{{ $gate_entry->getManifestoEntry->cargo_reference_no}}" placeholder="Enter Cargo Ref No" readonly>
                              </div>
                              <label class="col-sm-2 col-form-label">Type of Cargo</label>
                              <div class="col-sm-4">
                              <select name="cargo_type" id="cargo_type" class="form-control boxbrd" disabled>
                                    <option value="">{{ $gate_entry->getManifestoEntry->getCargo->cargo_name}}</option>
                                   
                                 </select>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Delivery Note No</label>
                              <div class="col-sm-4">
                                 <input type="text" name="delivery_note_no"  id="delivery_note_no" class="form-control" value="{{ $gate_entry->getManifestoEntry->delivery_note_no}}" placeholder="" readonly >
                              </div>
                              <label class="col-sm-2 col-form-label">No of Package  </label>
                              <div class="col-sm-4">
                                 <input type="text" name="no_package" id="no_package" class="form-control" value="{{ $gate_entry->getManifestoEntry->no_package}}" placeholder=""  readonly>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Booking No </label>
                              <div class="col-sm-4">
                                 <input type="text" name="booking_no" id="booking_no" class="form-control" value="{{ $gate_entry->getManifestoEntry->booking_no}}" placeholder="" readonly>
                              </div>
                              <label class="col-sm-2 col-form-label">Consignment Weight  </label>
                              <div class="col-sm-4">
                                 <input type="text" name="consignment_wgt" id="consignment_wgt" class="form-control" value="{{ $gate_entry->getManifestoEntry->consignment_wgt}}" placeholder="" readonly>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">CF Agent </label>
                              <div class="col-sm-4">
                              <select name="cf_agent" id="cf_agent" class="form-control boxbrd" disabled>
                                    <option value="">{{ $gate_entry->getManifestoEntry->getAgent->agent_name}}</option>
                                   
                                 </select>
                              </div>
                              <label class="col-sm-2 col-form-label">Customer Name </label>
                              <div class="col-sm-4">
                              <select name="customer_name"  id="customer_name" class="form-control boxbrd" disabled>
                                    <option value="">{{ $gate_entry->getManifestoEntry->getCustomers->customer_name}}</option>
                                   
                                 </select>
                              </div>
                           </div>

                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label"> </label>
                              <div class="col-sm-4">
                             
                              </div>
                              <label class="col-sm-2 col-form-label">BL No: </label>
                              <div class="col-sm-4">
                              <input type="text"  name="bl_no" id="bl_no" class="form-control" value="{{ $gate_entry->getManifestoEntry->bl_no}}" placeholder=""  readonly>
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
                                 <input type="text" name="initiated_by" class="form-control" value="{{ auth()->user()->name}}" readonly placeholder="Enter Initiated By" >
                              </div>
                              <label class="col-sm-2 col-form-label">Interchange No </label>
                              <div class="col-sm-4">
                                 <input type="text" name="interchange_no" class="form-control" value="" placeholder="Enter Interchange No" >
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Time In:  </label>
                              <div class="col-sm-4">
                                 <input type="text" name="time_in" class="form-control" value="{{ $gate_entry->getGateEntry->time_in}}" placeholder="" readonly >
                              </div>
                              <label class="col-sm-2 col-form-label">Destination </label>
                              <div class="col-sm-4">
                                 <input type="text" name="destination" class="form-control" value=""  placeholder="Enter Destination" >
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Shipping Line </label>
                              <div class="col-sm-4">
                                 <input type="text" name="shipping_line" class="form-control" value=""  placeholder="Enter Shipping Line" >
                              </div>
                              <label class="col-sm-2 col-form-label">Gate Entry No </label>
                              <div class="col-sm-4">
                                 <input readonly type="text" name="gate_entry_no" class="form-control" value="{{$gate_entry_out_no }}"  placeholder="Enter Gate Entry No" >
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
               <h4>Finacial Officer Entry</h4>
            </div>
         </div>
         <div class="form-group row">
            <label class="col-sm-2 col-form-label">CFS Release No </label>
            <div class="col-sm-4">
               <input type="text" name="cfs_release_no" class="form-control" value="{{ $gate_entry->cfs_release_no}}" placeholder="" readonly="">
            </div>
            <label class="col-sm-2 col-form-label">Invoice No: </label>
            <div class="col-sm-4">
               <input type="text" name="invoice_no" class="form-control" value="{{ $gate_entry->invoice_no}}" readonly placeholder="Enter Invoice No">
            </div>
         </div>
         <div class="form-group row">
            <label class="col-sm-2 col-form-label">CFS Release Date</label>
            <div class="col-sm-4">
               <input type="date" onkeydown="return false" name="cfa_release_date" class="form-control" readonly value="{{ $gate_entry->cfa_release_date}}" placeholder="">
            </div>
            <label class="col-sm-2 col-form-label">Invoice Date: </label>
            <div class="col-sm-4">
               <input type="date" onkeydown="return false" name="invoice_date" class="form-control" value="{{ $gate_entry->invoice_date}}" placeholder="" readonly>
            </div>
         </div>
         <div class="form-group row">
            <label class="col-sm-2 col-form-label">CFS Release Date</label>
            <div class="col-sm-4">
               <input type="date" onkeydown="return false" name="cfs_release_date" class="form-control" value="{{ $gate_entry->cfs_release_date}}" placeholder="" readonly>
            </div>
            <label class="col-sm-2 col-form-label">CFS Release Exp Date</label>
            <div class="col-sm-4">
               <input type="date" onkeydown="return false" name="cfs_release_exp_date" class="form-control" value="{{ $gate_entry->cfs_release_exp_date}}" placeholder="" readonly>
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
                                    <!-- Total Consignment :  | 
                                    Remaining : -->
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
                                          <th>Truck No</th>
                                          <th>Trailer No</th>
                                          <th>Driver Name</th>
                                          <th>Driver License</th>
                                          <th>Driver Ph No</th>
                                          <th>Chasis No</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                       
                                          <td><input name="report_no" type="text" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->report_no}}" placeholder="Enter Report No" readonly ></td>
                                          <td><input type="date" name="carry_in_date" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->carry_in_date}}" placeholder="Carry In Date" readonly></td>
                                          <td><input type="number" min="1" name="container_no" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->container_no}}" placeholder="Enter Container No" readonly></td>
                                          <td><input type="number" min="1" name="size" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->size}}" placeholder="Enter Size"readonly></td>
                                          <td><input type="text" min="1" name="seal_s_no1" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->seal_s_no1}}" placeholder="Enter Seal S.NO1" readonly></td>
                                          <td><input type="text" min="1" name="seal_s_no2" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->seal_s_no2}}" placeholder="Enter Seal S.NO"  readonly></td>
                                          <td >
                                                   <select disabled style="width: auto;" name="commodity" class="form-control boxbrd required clone_input commodity_select">
                                                   <option value="">{{$gate_entry->getConsignmentDetails->getCommodity->commodity_name}}</option>
                                                  
                                                   </select>
                                                </td>
                                                <td>
                                                <select  disabled  style="width: auto;" name="material"  class="form-control boxbrd required clone_input material_select">
                                                   <option value="">{{$gate_entry->getConsignmentDetails->getMaterial->material_name}}</option>
                                                  
                                                   </select>
                                                </td>
                                                <td>
                                                <select  disabled style="width: auto;" name="uom" id="uom" class="form-control boxbrd required clone_input">
                                                   <option value="">{{$gate_entry->getConsignmentDetails->getUOM->unit_entry_filed}}</option>
                                                 
                                                   </select>
                                                </td>
                                          
                                          <td><input type="number"  name="qty" min="1" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->qty}}" placeholder="Enter Qty" readonly></td>
                                          <td><input type="text" name="lot_no" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->lot_no}}" placeholder="Enter Lot No" readonly></td>
                                          <td><input type="text" name="location" class="form-control cwth" value="{{$gate_entry->getConsignmentDetails->location}}" placeholder="Enter Location" readonly></td>  
                                          <td><input type="text" name="truck_no" class="form-control cwth" value="" placeholder="Enter Truck Number"></td> 
                                          <td><input type="text" name="trailer_no" class="form-control cwth" value="" placeholder="Enter Trailer Number"></td> 
                                          <td><input type="text" name="driver_name" class="form-control cwth" value="" placeholder="Enter Driver Name"></td>                          
                                          <td><input type="text" name="driver_license" class="form-control cwth" value="" placeholder="Enter Driver License"></td>                          
                                          <td><input type="text" name="driver_ph_no" class="form-control cwth" value="" placeholder="Enter Driver Phone Number"></td> 
                                          <td><input type="text" name="chasis_no" class="form-control cwth" value="" placeholder="Enter Chasis Number"></td>   
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
               <button class="btn btn-success waves-effect waves-light" {{$gate_entry->status==3?'disabled':''}}>Register</button>
	
	
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
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/additional-methods.js"></script>
<script>
  
   
   $('#myform').validate({ // initialize the plugin
       rules: {
         initiated_by: {
            required: true,
        },
        interchange_no: {
            required: true,
        },
        destination: {
            required: true,
        },
        shipping_line: {
            required: true,
        },
        truck_no: {
            required: true,
        },
        trailer_no: {
            required: true,
        },
        driver_name: {
            required: true,
        },
        driver_license: {
            required: true,
        },
        driver_ph_no: {
            required: true,
        },
        chasis_no: {
            required: true,
        },
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


$("#cargo_type").change(function () {                            
    var test = $('#cargo_type').val();
    cargo  =  test.substring(0, test.lastIndexOf("/"));
     console.log(cargo);
  //  $("#myform").validate(); //sets up the validator
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
    }else if(cargo == 'local_full_container_comes_and_empty_container_goes_out_with_vehicle'||
    cargo =="local_full_container_comes_and_full_container_goes_out_with_vehicle" ||
    cargo =="local_full_container_comes_and_empty_vehicle_goes_out" ||
    cargo =="local_loose_material_comes_in_and_empty_vehicle_goes_out"){
        $('.ecd_name_div').css('display','none');
        $('.total_no_of_container_div').css('display','none');
        $('.cargo_ref_no_div').css('display','none');
    }else if(cargo == 'empty_container_comes_in_and_empty_vehicle_goes_out.' ||
        cargo =="empty_vehicle_comes_in_and_empty_container_goes_out_with_vehicle." ||
        cargo =="empty_vehicle_comes_in_and_full_container_goes_with_vehicle" ){
      $('.cargo_ref_no_div').css('display','none');
      $('.delivery_note_no_div').css('display','none');
    }                                                                                              
});


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