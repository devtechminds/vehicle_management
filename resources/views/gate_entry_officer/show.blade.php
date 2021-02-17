@extends('layouts.master')
@section('content')
<div class="page-header card">
   <div class="row align-items-end">
      <div class="col-lg-6">
         <div class="page-header-title">
            <i class="feather icon-clipboard bg-c-blue"></i>
            <div class="d-inline">
               <h2>Main Gate1 Entry Screen</h2>
            </div>
         </div>
      </div>
      <div class="col-lg-6">
         <div class="page-header-breadcrumb">
            <ul class=" breadcrumb breadcrumb-title">
               <li class="breadcrumb-item">
                  <a href="index.html"><i class="feather icon-home"></i></a>
               </li>
               <li class="breadcrumb-item"><a href="#!">Gate1 Entry Officer</a></li>
               <li class="breadcrumb-item">
                  <a href="#!">Main Gate1 Entry Screen</a>
               </li>
            </ul>
         </div>
      </div>
   </div>
</div>
<div class="pcoded-inner-content">
<form action="{{route('vehilce.store')}}" id="myform" method="post">
@csrf
   <div class="main-body">
      <div class="page-wrapper">
         <div class="page-body">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-block">
                        <input type="hidden" name="id" value="{{ $manifestoEntry->id}}">
                           <div class="form-group row">
                              <div class="col-sm-2">
                                 <p class="bigf">Ref No:</p>
                                 <input type="text" class="form-control bld sdt" value="{{ $manifestoEntry->ref_no}}" placeholder="" readonly="">
                              </div>
                              <div class="col-sm-8">
                              </div>
                              <div class="col-sm-2">
                                 <p class="bigf">Date:</p>
                                 <input type="text" class="form-control bld" value="{{ $manifestoEntry->date}}" placeholder="" readonly="">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Type of Consignment</label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control" value="{{isset($manifestoEntry->getConsignment->consignment_type)?$manifestoEntry->getConsignment->consignment_type:''}}" placeholder="" readonly="">
                              </div>
                              <label class="col-sm-2 col-form-label">Gate Entry No</label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control" name="gate_entry_no" id="gate_entry_no" value="{{ $gate_entry_no}}" placeholder="" readonly="">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Cargo Ref No</label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control" value="{{ $manifestoEntry->cargo_reference_no}}" placeholder="" readonly="">
                              </div>
                              <label class="col-sm-2 col-form-label">Type of Cargo</label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control" value="{{  str_replace('_',' ',$manifestoEntry->getCargo->cargo_name) }}" placeholder="" readonly="">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Delivery Note No</label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control" value="{{ $manifestoEntry->delivery_note_no }}" placeholder="" readonly="">
                              </div>
                              <label class="col-sm-2 col-form-label">Booking No </label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control" value="{{ $manifestoEntry->booking_no}}" placeholder="" readonly="">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">No of Package  </label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control" value="{{ $manifestoEntry->no_package }}" placeholder="" readonly="">
                              </div>
                              <label class="col-sm-2 col-form-label">Consignment Weight  </label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control" value="{{ $manifestoEntry->consignment_wgt }}" placeholder="" readonly="">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">CF Agent </label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control" value="{{ $manifestoEntry->getAgent->agent_name }}" placeholder="" readonly="">
                              </div>
                              <label class="col-sm-2 col-form-label">Customer Name </label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control" value="{{ $manifestoEntry->getCustomers->customer_name }}" placeholder="" readonly="">
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
                              <label class="col-sm-2 col-form-label">Initiated By  </label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control" name="initiated_by" id="initiated_by" value="{{ auth()->user()->name}}" placeholder="Enter Initiated By" readonly>
                              </div>
                              <label class="col-sm-2 col-form-label">Interchange No </label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control" name="interchange_no" id="interchange_no" value="" placeholder="Enter Interchange No">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Time In:  </label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control"  name="time_in" id="time_in" value="{{  date('h:i A', strtotime(now())) }}" placeholder="" readonly="">
                              </div>
                              <label class="col-sm-2 col-form-label">Destination </label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control" name="destination" id="destination" value="" placeholder="Enter Destination">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Shipping Line </label>
                              <div class="col-sm-4">
                                 <input type="text" class="form-control" name="shipping_line" id="shipping_line" value="" placeholder="Enter Shipping Line">
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
                                 <div class="col-sm-8">
                                    <h3 class="title">Consignment Details (FULL)</h3>
                                 </div>
                                 <div class="card-right">	
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
                                          <th></th>
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
                 
                                       <tr class="rowclass">
                                       
                                       @php
                                       $flag = 0;
                                       @endphp
                                       @foreach($manifestoEntry->getConsignmentDetails as $key=>$value)
                                          
                                             <tr class="line">
                                             @if($value->status==0) 
                                             @php
                                             $flag = 1;
                                             @endphp

                                                <td><input type="radio" name="check" value="{{ $value->id}}" class="tick" onclick="markRow(1)"></td>
                                             @endif
                                             @if($value->status==1)
                                                <td><i class="fa fa-check alert alert-success "></i</td>
                                             @endif
                                             
                                                <td><input type="text" name="report_no" class="form-control cwth required clone_input " readonly value="{{$value->report_no}}" placeholder="Enter Rerport No"></td>
                                                <td><input type="date"  onkeydown="return false" name="carry_in_date"  readonly value="{{$value->carry_in_date}}"  class="form-control cwth required clone_input" placeholder=""></td>
                                                <td><input type="text" name="container_no"  readonly value="{{$value->container_no}}" class="form-control cwth  clone_input" placeholder="Enter Container No"></td>
                                                <td><input type="text" name="size"  readonly value="{{$value->size}}"  class="form-control cwth   clone_input" placeholder=""></td>
                                                <td><input type="text" name="seal_s_no1"  readonly value="{{$value->seal_s_no1}}" class="form-control cwth  clone_input" placeholder="Enter Seal No"></td>
                                                <td>
                                                   <select disabled name="commodity" class="form-control boxbrd required clone_input">
                                                   <option value="">{{$value->getCommodity->commodity_name}}</option>
                                                   
                                                   </select>
                                                </td>
                                                <td>
                                                <select  disabled name="material"  class="form-control boxbrd required clone_input">
                                                   <option value="">{{$value->getMaterial->material_name}}</option>
                                                 
                                                   </select>
                                                </td>
                                                <td>
                                                <select disabled name="uom" id="uom" class="form-control boxbrd required clone_input">
                                                   <option value="">{{ isset($value->getUOM->unit_entry_filed)?$value->getUOM->unit_entry_filed:''}}</option>
                                                   </select>
                                                </td>

                                                <td><input type="text"  readonly value="{{$value->declared_wgt}}"  name="declared_wgt"  class="form-control cwth required clone_input" placeholder="Declared wgt"></td>
                                                <td><input type="text"  readonly value="{{$value->truck_no}}"  name="truck_no"  class="form-control cwth required clone_input" placeholder="Truck No"></td>
                                                <td><input type="text"   readonly value="{{$value->trailer_no}}"  name="trailer_no" class="form-control cwth required clone_input" placeholder="Trailer No"></td>
                                                <td><input type="text"   readonly value="{{$value->driver_name}}"  name="driver_name" class="form-control cwth required clone_input" placeholder="Driver Name"></td>
                                                <td><input type="text"   readonly value="{{$value->driver_lic_no}}"   name="driver_lic_no"   class="form-control cwth required clone_input" placeholder="Driver lic No"></td>
                                                <!-- <td>
                                                <select   {{ $value->status==1?'disabled':''}} name="transporter[{{$value->id}}]" id="{{$value->id}}" class="form-control boxbrd clone_input">
                                                  <option value="">Select Transporter</option>
                                                   @foreach($transports as  $transport)
                                                   <option {{$transport['transport_code']== $value['transporter']?'selected':''}}   value="{{$transport['transport_code']}}">{{$transport['transport_name']}}</option>
                                                   @endforeach 
                                                   </select>
                                                   
                                                </td> -->
                                                <td><input type="text"  name="transporter[{{$value->id}}]" class="form-control cwth" value="{{ $value->status==1?$value->transporter:''}}" placeholder="Enter Transporter" {{ $value->status==1?'readonly':''}}></td>
                                             </tr>
                                          @endforeach
                                         
                                          <input type="hidden" name="oldSelectedcheck" id="oldSelectedcheck" value="">
                                         
                                       </tr>
                                    </tbody>
                                   
                                 </table>
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
                 @if($flag==1)
                  <div class="col-sm-12" style="text-align: center;">
                     <button class="btn btn-success waves-effect waves-light">Register</button>
                  </div>
                 @endif 
                 @if($flag==0)
                 <div class="col-sm-12" style="text-align: center;">
                     <a href="{{route('vehilce.in.register.index')}}" class="btn btn-success waves-effect waves-light">Back</a>
                  </div>
                 @endif
               </div>
            </div>
         </div>
      </div>
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
           'check[]': {
               required: true,
               minlength: 1
           },
           check: {
               required: true,
              
           }
           
           
   
          
       },
       submitHandler: function (form) { // for demo
         $('#myform').submit();
       }
   });
   
   
   
   
   
   $('.required').each(function() {
    $(this).rules('add', {
       required: true,
    });
   });

   $('input[type=radio][name=check]').change(function() {
       
     var oldcheck = '#'+$('#oldSelectedcheck').val();
    
    // console.log(oldcheck);
   //  $('#'+oldcheck).removeAttr('required');​​​​​
     // $("#"+this.value+").removeAttr('required');
    //  $('#oldSelectedcheck').val(this.value);
    //  $('#'+this.value).prop('required',true);
    // console.log()
});
   
</script>
@endsection