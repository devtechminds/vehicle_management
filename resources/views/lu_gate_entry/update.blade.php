@extends('layouts.master',['header' => 'Loading & Unloading'])
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
<form action="{{route('loading.entry.update')}}" id="myform" method="post">
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
                           <input type="text" name="ref_no" id="ref_no" class="form-control bld sdt" value="{{ $loadingGateEntry->ref_no}}" placeholder="" readonly>
                           <input type="hidden" name="id" id="id" class="form-control bld" value="{{$loadingGateEntry->id}}" placeholder="" readonly="">
                           </div>
                           <div class="col-sm-8">

                           </div>
                           <div class="col-sm-2">
                           <p class="bigf">Date:</p>	
                           <input type="text" name="date" id="date" class="form-control bld"  value="{{ $loadingGateEntry->date}}" placeholder="" readonly>
                           </div>

                           </div>

                           <div class="form-group row">
                           <label class="col-sm-2 col-form-label">Customer Name</label>
                           <div class="col-sm-4">
                              <select name="customer_name"  id="customer_name" class="form-control boxbrd">
                                    <option value="">Customer Name</option>
                                    @foreach($customers as $customer)
                                    <option {{ $customer['customer_code']== $loadingGateEntry->customer_name?'selected':'' }} value="{{ $customer['customer_code'] }}">{{ $customer['customer_name'] }}</option>
                                    @endforeach
                              </select>
                           </div>
                           <label class="col-sm-2 col-form-label">Commodity</label>
                           <div class="col-sm-4">
                              <select name="commodity" id="commodity" class="form-control boxbrd commodity_select">
                                    <option value="">Select Commodity</option>
                                    @foreach($commoditys as $commodity)
                                       <option {{ $commodity['commodity_code']== $loadingGateEntry->commodity?'selected':'' }} value="{{ $commodity['commodity_code'] }}">{{$commodity['commodity_name'] }}</option>
                                    @endforeach
                              </select>
                           </div>
                           </div>

                           <div class="form-group row">
                           <label class="col-sm-2 col-form-label">Truck No</label>
                           <div class="col-sm-4">
                           <input type="text" name="truck_no" id="truck_no" class="form-control" value="{{ $loadingGateEntry->truck_no}}" placeholder="">
                           </div>
                           <label class="col-sm-2 col-form-label">Trailer No</label>
                           <div class="col-sm-4">
                           <input type="text" name="trailer_no" id="trailer_no" class="form-control" value="{{ $loadingGateEntry->trailer_no}}" placeholder="">
                           </div>
                           </div>

                           <div class="form-group row">
                           <label class="col-sm-2 col-form-label">Transporter</label>
                           <div class="col-sm-4">
                             <select name="transporter" id="transporter" class="form-control boxbrd">
                                    <option value="">Select Transporter</option>
                                    @foreach($transports as $transport)
                                       <option {{ $transport['transport_code']== $loadingGateEntry->transporter?'selected':'' }} value="{{ $transport['transport_code'] }}">{{ $transport['transport_name'] }}</option>
                                    @endforeach
                              </select>
                           </div>
                           <label class="col-sm-2 col-form-label">Quantity</label>
                           <div class="col-sm-4">
                           <input type="text" name="quantity" id="quantity" value="{{ $loadingGateEntry->quantity}}" class="form-control" placeholder="" readonly>
                           </div>
                           </div>

                           <div class="form-group row">
                           <label class="col-sm-2 col-form-label">Driver Name</label>
                           <div class="col-sm-4">
                           <input type="text" name="driver_name" id="driver_name" class="form-control" value="{{ $loadingGateEntry->driver_name}}" placeholder="">
                           </div>
                           <label class="col-sm-2 col-form-label">Metric Ton</label>
                           <div class="col-sm-4">
                           <input type="text" name="metric_ton" id="metric_ton" value="{{ round($loadingGateEntry->metric_ton,2) }}" class="form-control" placeholder="" readonly>
                           </div>
                           </div>

                           <div class="form-group row">
                           <label class="col-sm-2 col-form-label">Driver Ph </label>
                           <div class="col-sm-4">
                           <input type="text" name="driver_ph_no" id="driver_ph_no" class="form-control" value="{{ $loadingGateEntry->driver_ph_no}}" placeholder="">
                           </div>
                           <label class="col-sm-2 col-form-label">Driver Lic</label>
                           <div class="col-sm-4">
                           <input type="text" name="driver_lic_no" id="driver_lic_no" class="form-control" value="{{ $loadingGateEntry->driver_lic_no}}" placeholder="">
                           </div>
                           </div>

                           <div class="form-group row">
                           <label class="col-sm-2 col-form-label">Time In </label>
                           <div class="col-sm-4">
                           <input type="text" name="time_in" id="time_in" class="form-control" placeholder="" value="{{ $loadingGateEntry->time_in}}" readonly>
                           </div>
                           <label class="col-sm-2 col-form-label">Destination (TO) </label>
                           <div class="col-sm-4">
                           <input type="text" name="destination" id="destination" class="form-control" value="{{ $loadingGateEntry->destination}}" placeholder="">
                           </div>
                           </div>


                           <div class="form-group row">
                           <label class="col-sm-2 col-form-label">Container No  </label>
                           <div class="col-sm-4">
                           <input type="text" name="container_no" id="container_no" class="form-control" value="{{ $loadingGateEntry->container_no}}" placeholder="">
                           </div>
                           <label class="col-sm-2 col-form-label">Bl No </label>
                           <div class="col-sm-4">
                           <input type="text" name="bl_no" id="bl_no" class="form-control" value="{{ $loadingGateEntry->bl_no}}" placeholder="">
                           </div>
                           </div>

                           <div class="form-group row">
                           <label class="col-sm-2 col-form-label">Do No  </label>
                           <div class="col-sm-4">
                           <input type="text" name="dn_no" id="dn_no" class="form-control" value="{{ $loadingGateEntry->dn_no}}" placeholder="">
                           </div>
                           <label class="col-sm-2 col-form-label">Bl Qty </label>
                           <div class="col-sm-4">
                           <input type="text" name="bl_qty" id="bl_qty" class="form-control" value="{{ $loadingGateEntry->bl_qty}}" placeholder="">
                           </div>
                           </div>

                           <div class="form-group row">
                           <label class="col-sm-2 col-form-label">DO Qty  </label>
                           <div class="col-sm-4">
                           <input type="text" name="dn_qty" id="dn_qty" class="form-control" value="{{ $loadingGateEntry->dn_qty}}" placeholder="">
                           </div>
                           <label class="col-sm-2 col-form-label">Shipping Line</label>
                           <div class="col-sm-4">
                           <input type="text" name="shipping_line" id="shipping_line" class="form-control" value="{{ $loadingGateEntry->shipping_line}}" placeholder="">
                           </div>
                           </div>

                           <div class="form-group row">
                           <label class="col-sm-2 col-form-label">Interchange No  </label>
                           <div class="col-sm-4">
                           <input type="text" name="interchange_no" id="interchange_no" class="form-control" value="{{ $loadingGateEntry->interchange_no}}" placeholder="">
                           </div>
                           <label class="col-sm-2 col-form-label">TRA Seal No </label>
                           <div class="col-sm-4">
                           <input type="text" name="tra_seal_no" id="tra_seal_no" class="form-control" value="{{ $loadingGateEntry->tra_seal_no}}" placeholder="">
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
                                    @foreach($loadingGateEntry->getLuCommodityDetail as $key=>$value)
                                       <tr class="line">
                                          <td class="material-data">
                                          <select name="material[{{$key}}]" id="material" class="form-control boxbrd required clone_input material_select">
                                             <option value="">Select Material</option>
                                             @foreach($materials as $material)
                                                <option {{ $material['id'] == $value->material?'selected':'' }} data-unit_weight="{{ $material['unit_weight'] }}" value="{{ $material['id'] }}">{{ucwords( str_replace('_',' ',$material['material_name'])) }}</option>
                                             @endforeach
                                          </select>
                                          </td>
                                          <td >
                                          <select name="uom[{{$key}}]" id="uom" class="form-control boxbrd clone_input">
                                             <option value="">Select UOM</option>
                                             @foreach($uoms as $uom)
                                                <option   {{ $uom['id'] == $value->uom?'selected':'' }} value="{{ $uom['id'] }}">{{ucwords( str_replace('_',' ',$uom['unit_entry_filed'])) }}</option>
                                             @endforeach
                                          </select>
                                          </td>
                                          <td><input type="text" name="commodity_quantity[{{$key}}]" id="commodity_quantity" value="{{ $value->commodity_quantity}}" class="form-control boxbrd required clone_input "  placeholder=""></td>
                                          <td><input type="text" name="total_weight[{{$key}}]" id="total_weight" value="{{ round($value->total_weight,2)}}" class="form-control boxbrd clone_input"  placeholder="" readonly></td>
                                          <td><div class='rmv' ><i class='btn-danger fa fa-minus-circle' aria-hidden='true'></i></div></td>
                                       </tr>
                                       @endforeach
                                    </tbody>
                                    </table>
                                    <input type="hidden" id="counter" value="{{ count($loadingGateEntry->getLuCommodityDetail) }}">
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
                              <button class="btn btn-success waves-effect waves-light btnSubmitClick" id="myButton" >Update</button>
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
    //$clone.append("<td><div class='rmv' ><i class='btn-danger fa fa-minus-circle' aria-hidden='true'></i></div></td>");
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


$('.required').each(function() {
 $(this).rules('add', {
    required: true,
 });
});



</script>
@endsection