@extends('layouts.master')
@section('content')
<div class="page-header card">
   <div class="row align-items-end">
      <div class="col-lg-8">
         <div class="page-header-title">
            <i class="feather icon-clipboard bg-c-blue"></i>
            <div class="d-inline">
               <h3>AUTHORIZATION SELECTION WINDOW(UNLOADING)</h3>
            </div>
         </div>
      </div>
      <div class="col-lg-4">
         <div class="page-header-breadcrumb">
            <ul class=" breadcrumb breadcrumb-title">
               <li class="breadcrumb-item">
                  <a href="index.html"><i class="feather icon-home"></i></a>
               </li>
               <li class="breadcrumb-item"><a href="#!">Authorization Manager</a></li>
               <li class="breadcrumb-item">
                  <a href="#!">Weigh bridge entry update</a>
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
<form action="{{route('unloading.weigh.bridge.return.update.submit')}}" id="myform" method="post">
  <div class="main-body">
    <div class="page-wrapper">
      <div class="page-body">
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-block">
                @csrf
                <input type="hidden" name="_method" value="PUT">                 
                <div class="form-group row">
                  <div class="col-sm-2">
                    <p class="bigf">Token No:</p>
                    <input type="text" name="ref_no" id="ref_no" class="form-control bld sdt" value="{{ $unloadingGateEntry->ref_no}}" placeholder="" >
                    <input type="hidden" name="id" id="id" class="form-control bld" value="{{$unloadingGateEntry->id}}" placeholder="" >
                    <input type="hidden" name="gate_pass_no" id="gate_pass_no" class="form-control bld" value="{{ isset($unloadingGateEntry->gate_pass_no)?$unloadingGateEntry->gate_pass_no:$gate_pass_no}}" placeholder="" readonly="">
                  </div>
                  <div class="col-sm-8">
                  </div>
                  <div class="col-sm-2">
                    <p class="bigf">Date:</p>
                    <input type="text" name="date" id="date" class="form-control bld"  value="{{ $unloadingGateEntry->date}}" placeholder="" >
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Customer Name</label>
                  <div class="col-sm-4">
                    <select name="customer_name"  id="customer_name" class="form-control boxbrd">
                      <option value="">Customer Name</option>
                      @foreach($customers as $customer)
                      <option {{ $customer['customer_code']== $unloadingGateEntry->customer_name?'selected':'' }} value="{{ $customer['customer_code'] }}">{{ucwords( str_replace('_',' ',$customer['customer_name'])) }}</option>
                      @endforeach
                    </select>
                  </div>
                  <label class="col-sm-2 col-form-label">Truck No</label>
                  <div class="col-sm-4">
                    <input type="text" name="truck_no" id="truck_no" value="{{ $unloadingGateEntry->truck_no}}" class="form-control" placeholder="" >
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">DN No</label>
                  <div class="col-sm-4">
                    <input type="text" name="dn_no" id="dn_no" value="{{ $unloadingGateEntry->dn_no}}" class="form-control" placeholder="" >
                  </div>
                  <label class="col-sm-2 col-form-label">DN Qty</label>
                  <div class="col-sm-4">
                    <input type="text" name="dn_qty" id="dn_qty" value="{{ $unloadingGateEntry->dn_qty}}" class="form-control" placeholder="" >
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">BL No</label>
                  <div class="col-sm-4">
                    <input type="text" name="bl_no" id="bl_no" value="{{ $unloadingGateEntry->bl_no}}" class="form-control" placeholder="" >
                  </div>
                  <label class="col-sm-2 col-form-label">BL Qty</label>
                  <div class="col-sm-4">
                    <input type="text" name="bl_qty" id="bl_qty" value="{{ $unloadingGateEntry->bl_qty}}" class="form-control" placeholder="" >
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Trailer No</label>
                  <div class="col-sm-4">
                    <input type="text" name="trailer_no" id="trailer_no" value="{{ $unloadingGateEntry->trailer_no}}" class="form-control" placeholder="" >
                  </div>
                  <label class="col-sm-2 col-form-label">Quantity</label>
                  <div class="col-sm-4">
                    <input type="text" name="quantity" id="quantity" value="{{ $unloadingGateEntry->quantity}}" class="form-control" placeholder="" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Transporter </label>
                  <div class="col-sm-4">
                    <select name="transporter" id="transporter" class="form-control boxbrd">
                      <option value="">Select Transporter</option>
                      @foreach($transports as $transport)
                      <option {{ $transport['transport_code']== $unloadingGateEntry->transporter?'selected':'' }} value="{{ $transport['transport_code'] }}">{{ucwords( str_replace('_',' ',$transport['transport_name'])) }}</option>
                      @endforeach
                    </select>
                  </div>
                  <label class="col-sm-2 col-form-label">Metric Ton</label>
                  <div class="col-sm-4">
                    <input type="text" name="metric_ton" id="metric_ton" value="{{ $unloadingGateEntry->metric_ton}}" class="form-control" placeholder="" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Driver Name </label>
                  <div class="col-sm-4">
                    <input type="text" name="driver_name" id="driver_name" value="{{ $unloadingGateEntry->driver_name}}" class="form-control" placeholder="" >
                  </div>
                  <label class="col-sm-2 col-form-label">Driver Ph</label>
                  <div class="col-sm-4">
                    <input type="text" name="driver_ph_no" id="driver_ph_no" value="{{ $unloadingGateEntry->driver_ph_no}}" class="form-control" placeholder="" >
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Driver Lic  </label>
                  <div class="col-sm-4">
                    <input type="text" name="driver_lic_no" id="driver_lic_no" value="{{ $unloadingGateEntry->driver_lic_no}}" class="form-control" placeholder="" >
                  </div>
                  <label class="col-sm-2 col-form-label">Container </label>
                  <div class="col-sm-4">
                    <input type="text" name="container_no" id="container_no" value="{{ $unloadingGateEntry->container_no}}" class="form-control" placeholder="" >
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Time In </label>
                  <div class="col-sm-4">
                    <input type="text" name="time_in" id="time_in" value="{{ $unloadingGateEntry->time_in}}" class="form-control" placeholder="" value="{{  date('h:i A', strtotime(now())) }}" >
                  </div>
                  <label class="col-sm-2 col-form-label">Commodity </label>
                  <div class="col-sm-4">
                    <select name="commodity" id="commodity" class="form-control boxbrd commodity_select">
                      <option value="">Select Commodity</option>
                      @foreach($commoditys as $commodity)
                      <option {{ $commodity['commodity_code']== $unloadingGateEntry->commodity?'selected':'' }} value="{{ $commodity['commodity_code'] }}">{{ucwords( str_replace('_',' ',$commodity['commodity_name'])) }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Destination (From)  </label>
                  <div class="col-sm-4">
                    <input type="text" name="destination" id="destination" value="{{ $unloadingGateEntry->destination}}" class="form-control" placeholder="" >
                  </div>
                  <label class="col-sm-2 col-form-label">Shipping Line</label>
                  <div class="col-sm-4">
                    <input type="text" name="shipping_line" id="shipping_line" value="{{ $unloadingGateEntry->shipping_line}}" class="form-control" placeholder="" >
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Interchange No  </label>
                  <div class="col-sm-4">
                    <input type="text" name="interchange_no" id="interchange_no" value="{{ $unloadingGateEntry->interchange_no}}" class="form-control" placeholder="" >
                  </div>
                  <label class="col-sm-2 col-form-label">TRA Seal No </label>
                  <div class="col-sm-4">
                    <input type="text" name="tra_seal_no" id="tra_seal_no" value="{{ $unloadingGateEntry->tra_seal_no}}" class="form-control" placeholder="" >
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
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">WB Ticket No </label>
                              <div class="col-sm-4">
                                 <input type="text" name="wb_ticket_no" id="wb_ticket_no" value="{{ $unloadingGateEntry->getLuWeightBridge->wb_ticket_no}}" class="form-control" value="" placeholder="" >
                              </div>
                              <label class="col-sm-2 col-form-label">WB Gross Wt </label>
                              <div class="col-sm-4">
                                 <input type="text" name="wb_gross_wt" id="wb_gross_wt" value="{{ $unloadingGateEntry->getLuWeightBridge->wb_gross_wt}}" class="form-control" value="" placeholder="">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Container Tare Wt </label>
                              <div class="col-sm-4">
                                 <input type="text" name="container_tare_wt" id="container_tare_wt" value="{{ $unloadingGateEntry->getLuWeightBridge->container_tare_wt}}" class="form-control calculate" value="" placeholder="">
                              </div>
                              <label class="col-sm-2 col-form-label">WB Tare Wt</label>
                              <div class="col-sm-4">
                                 <input type="text" name="wb_tare_wt" id="wb_tare_wt" value="{{ $unloadingGateEntry->getLuWeightBridge->wb_tare_wt}}" class="form-control calculate" value="" placeholder="" >
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">WB Net Wt </label>
                              <div class="col-sm-4">
                                 <input type="text" name="wb_net_wt" id="wb_net_wt" value="{{ $unloadingGateEntry->getLuWeightBridge->wb_net_wt}}"  class="form-control" value="" placeholder="" readonly >
                              </div>
                           </div>
                     </div>
                  </div>

                  <div class="card">
                     <div class="card-block">
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Loaded By </label>
                              <div class="col-sm-4">
                                 <input type="text" name="loaded_by" id="loaded_by" value="{{ $unloadingGateEntry->getLuWeightBridge->loaded_by}}" class="form-control" placeholder="">
                              </div>
                              <label class="col-sm-2 col-form-label">Name</label>
                              <div class="col-sm-4">
                                 <input type="text" name="name" id="name" value="{{ $unloadingGateEntry->getLuWeightBridge->name}}" class="form-control" placeholder="">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Quantity Loaded </label>
                              <div class="col-sm-4">
                                 <input type="text" name="quantity_loaded" id="quantity_loaded" value="{{ $unloadingGateEntry->getLuWeightBridge->quantity_loaded}}" class="form-control" placeholder="">
                              </div>
                              <label class="col-sm-2 col-form-label">Quantity (short)</label>
                              <div class="col-sm-4">
                                 <input type="text" name="quantity_short" id="quantity_short" value="{{ $unloadingGateEntry->getLuWeightBridge->quantity_short}}" class="form-control"  placeholder="">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">KGS </label>
                              <div class="col-sm-4">
                                 <input type="text" name="kgs" id="kgs" class="form-control" value="{{ $unloadingGateEntry->getLuWeightBridge->kgs}}" placeholder="">
                              </div>
                              <label class="col-sm-2 col-form-label">Warehouse </label>
                              <div class="col-sm-4">
                              <select name="location" id="location" class="form-control boxbrd">
                                    <option value="">Select Warehouse</option>
                                    @foreach($locations as $location)
                                       <option {{ $location['id']== $unloadingGateEntry->getLuWeightBridge->location?'selected':'' }} value="{{ $location['id'] }}">{{ucwords( str_replace('_',' ',$location['location'])) }}</option>
                                    @endforeach
                              </select>
                              </div>
                           </div>
                     </div>
                  </div>

            <div class="card">
              <div class="card-block">
                <div class="row" >
                  <div class="col-sm-12">
                    <div class="form-group row tblrw" style="border-bottom: 1px solid;
                      padding-bottom: 8px;">
                      <div class="col-sm-8">
                        <h3 class="title">Commodity Details</h3>
                      </div>
                      <div class="card-right">	
                        <button 
                          onclick="if (!window.__cfRLUnblockHandlers) return false; javascript:toggleFullScreen()" class=" waves-effect waves-light btn waves-effect waves-dark btn-primary btn-outline-primary btn-icon" data-cf-modified-41c5a08083d3d25c74495efb-="">
                        <i class="full-screen feather icon-maximize"></i>
                        </button>	
                        <span id="addMoreCommodity" class="btn waves-effect waves-dark btn-primary btn-outline-primary btn-icon"><i class="fa fa-plus" aria-hidden="true"></i></span>
                      </div>
                    </div>
                    <div class="card-block">
                      <div class="table-responsive">
                        <table id="tableExample"  class="table tableExample m-b-0">
                          <thead>
                            <tr>
                              <th>Material Name</th>
                              <th>UOM</th>
                              <th>Quantity</th>
                              <th>Total Weight </th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach($unloadingGateEntry->getLuCommodityDetail as $key=>$value)
                            <tr class="line">
                              <td class="material-data">
                                <select name="material[0]" id="material" class="form-control boxbrd required clone_input material_select">
                                  <option value="">Select Material</option>
                                  @foreach($materials as $material)
                                    <option {{ $material['id'] == $value->material?'selected':'' }} data-unit_weight="{{ $material['unit_weight'] }}" value="{{ $material['id'] }}">{{ucwords( str_replace('_',' ',$material['material_name'])) }}</option>
                                  @endforeach
                                </select>
                              </td>
                              <td >
                                <select name="uom[0]" id="uom" class="form-control boxbrd clone_input">
                                  <option value="">Select UOM</option>
                                  @foreach($uoms as $uom)
                                    <option   {{ $uom['id'] == $value->uom?'selected':'' }} value="{{ $uom['id'] }}">{{ucwords( str_replace('_',' ',$uom['unit_entry_filed'])) }}</option>
                                  @endforeach
                                </select>
                              </td>
                              <td><input type="text" name="commodity_quantity[0]" id="commodity_quantity" value="{{ $value->commodity_quantity}}" class="form-control boxbrd required clone_input "  placeholder="" ></td>
                              <td><input type="text" name="total_weight[0]" id="total_weight" value="{{ $value->total_weight}}" class="form-control boxbrd clone_input"  placeholder="" readonly></td>
                              <td><div class='rmv' ><i class='btn-danger fa fa-minus-circle' aria-hidden='true'></i></div></td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                        <input type="hidden" id="counter" value="{{ count($unloadingGateEntry->getLuCommodityDetail) }}">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-block height">
                <div class="row" >
                  <div class="col-sm-12" style="text-align: center;">
                  @if($unloadingGateEntry->status=='6')
                  <button class="btn btn-success waves-effect waves-light">Update</button>
                  @else
                  <a class="btn btn-warning waves-effect waves-light" target="_blank" href="{{route('unloading.weigh.bridge.return.update.print',base64_encode($unloadingGateEntry->id))}}">Print <i class="fa fa-print"></i></a>
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
        container_tare_wt: {
            required: true,
            
        },
        wb_gross_wt: {
            required: true,
            
        },
        loaded_by: {
            required: true,
            
        },
        quantity_loaded: {
            required: true,
            
        },
        quantity_short: {
            required: true,
        },
        kgs: {
            required: true,
           
        },
        

       
    },
    submitHandler: function (form) { // for demo
      $(".btnSubmitClick").addClass("disabled");
      $('#myform').submit();
    }
});


$(document).on("change", ".commodity_select", function () {
    var id = $(this).val(); //get the current value's option
    var thisObj = $(this);
    if(id){
      $.ajax({
        type:'GET',
        url:'/material-by-comodity/'+id,
        success:function(data){
           $("td.material-data select").html(data);
        }
      });
    }    
});

$(document).on("change", ".material_select", function () {
   calculateWeight($(this));
    var id = $(this).val(); //get the current value's option
    var thisObj = $(this);
    if(id){       
      $.ajax({
        type:'GET',
        url:'/uom-by-material/'+id,
        success:function(data){
         thisObj.closest('td').next().find('select').html(data);
        }
      });
    }
   
});

$(document).on("keyup", "#commodity_quantity", function () {
   calculateWeight($(this));
});

var calculateWeight = function(_this){
   var tot_weight = 0;
   var _parent = _this.parent().parent();   
   var qty = _parent.find('td:eq(2)').find('input').val();
   var weight = _parent.find('#material :selected').data('unit_weight');   
   weight = (!weight)? 0 : parseFloat(weight);
   qty = (!qty)? 0 : parseInt(qty);
   tot_weight = weight*qty;
   
   _parent.find('#total_weight').val(tot_weight);
   updateMetricTonQty();   
}



var updateMetricTonQty = function (){
   var metric_ton = tot_qty = 0;
   $('#tableExample tbody tr.line').each(function(k,v){
      let totWeight = parseFloat($(this).find('#total_weight').val());
      let qty = parseInt($(this).find('#commodity_quantity').val());
      totWeight = !totWeight?0:totWeight;
      qty = !qty?0:qty;      
      metric_ton += totWeight;
      tot_qty += qty;
   });
   $('#metric_ton').val(metric_ton);
   $('#quantity').val(tot_qty);  
}



$("#addMoreCommodity").click(function(){
   var counter = parseInt($('#counter').val());
   var $clone = $('table.tableExample tr.line:first').clone();   
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
   if (confirm('Do you want to delete this Commodity Details?')){    
     $(this).closest('tr').remove();
     updateMetricTonQty();
   }else{
         return false;
   }
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


$('.required').each(function() {
 $(this).rules('add', {
    required: true,
 });
});

</script>
@endsection