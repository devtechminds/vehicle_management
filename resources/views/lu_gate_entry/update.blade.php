@extends('layouts.master')
@section('content')
<div class="page-header card">
   <div class="row align-items-end">
      <div class="col-lg-8">
         <div class="page-header-title">
            <i class="feather icon-clipboard bg-c-blue"></i>
            <div class="d-inline">
               <h2>Manifesto Entry</h2>
            </div>
         </div>
      </div>
      <div class="col-lg-4">
         <div class="page-header-breadcrumb">
            <ul class=" breadcrumb breadcrumb-title">
               <li class="breadcrumb-item">
                  <a href="index.html"><i class="feather icon-home"></i></a>
               </li>
               <li class="breadcrumb-item"><a href="#!">Document Officer</a></li>
               <li class="breadcrumb-item">
                  <a href="#!">Manifesto Entry</a>
               </li>
            </ul>
         </div>
      </div>
      @if (session('create'))
  <div class="alert alert-success alert-dismissable custom-success-box" style="margin: 15px;">
     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     <strong> {{ session('create') }} </strong>
  </div>
@endif
   </div>
</div>
<div class="pcoded-inner-content">
<form action="{{route('manifesto.update')}}" id="myform" method="post">
@csrf
<input type="hidden" name="_method" value="PUT">
   <div class="main-body">
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
      <div class="page-wrapper">
         <div class="page-body">
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-block">
                      
                           <div class="form-group row">
                              <div class="col-sm-2">
                                 <p class="bigf">Ref No:</p>
                                 <input type="text" name="ref_no" id="ref_no" class="form-control bld" value="{{$manifestoEntry->ref_no}}" placeholder="" readonly="">
                                 <input type="hidden" name="id" id="id" class="form-control bld" value="{{$manifestoEntry->id}}" placeholder="" readonly="">
                              </div>
                              <div class="col-sm-8">
                              </div>
                              <div class="col-sm-2">
                                 <p class="bigf">Date:</p>
                                 <input type="text" name="date" id="date" class="form-control bld" value="{{ date('d-m-Y')}}" placeholder="" readonly="">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Type of Consignment</label>
                              <div class="col-sm-4">
                                 <select name="consignment_type" id="consignment_type" class="form-control boxbrd">
                                    <option value="">Select Consignment Type</option>
                                    @foreach($consignments as $consignment)
                                    <option {{ $consignment['id']== $manifestoEntry->consignment_type?'selected':'' }} value="{{ $consignment['id'] }}">{{ ucwords($consignment['consignment_type']) }}</option>
                                    @endforeach
                                 </select>
                              </div>
                              <label class="col-sm-2 col-form-label">Type of Cargo</label>
                              <div class="col-sm-4">
                                 <select name="cargo_type" id="cargo_type" class="form-control boxbrd">
                                    <option value="">Select Cargo Type</option>
                                    @foreach($cargos as $cargo)
                                       <option {{ $cargo['cargo_code']== $manifestoEntry->cargo_type?'selected':'' }} value="{{ $cargo['cargo_name'] }}/{{ $cargo['cargo_code'] }}">{{ucwords( str_replace('_',' ',$cargo['cargo_name'])) }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label cargo_ref_no_div">Cargo Ref No</label>
                              <div class="col-sm-4 cargo_ref_no_div">
                                 <input type="text" name="cargo_reference_no" id="cargo_reference_no" class="form-control" value="{{$manifestoEntry->cargo_reference_no}}" placeholder="Enter Cargo Ref No">
                              </div>
                              <label class="col-sm-2 col-form-label ecd_name_div">ECD Name</label>
                              <div class="col-sm-4">
                                 <input type="text" name="ecd_name" id="ecd_name"  value="{{$manifestoEntry->ecd_name}}" class="form-control ecd_name_div" placeholder="Enter ECD Name">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label delivery_note_no_div">Delivery Note No</label>
                              <div class="col-sm-4 delivery_note_no_div">
                                 <input type="text" name="delivery_note_no" id="delivery_note_no"  value="{{$manifestoEntry->delivery_note_no}}" class="form-control" placeholder="Enter Delivery Note No">
                              </div>
                              <label class="total_no_of_container_div col-sm-2 col-form-label">Total No of Container</label>
                              <div class="col-sm-4 total_no_of_container_div">
                                 <input type="text" name="no_container" id="no_container"  value="{{$manifestoEntry->no_container}}" class="form-control" placeholder="Enter Total No of Container">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Booking No </label>
                              <div class="col-sm-4">
                                 <input type="text" name="booking_no"  id="booking_no" value="{{$manifestoEntry->booking_no}}"  class="form-control" placeholder="Enter Booking Number">
                              </div>
                              <label class="col-sm-2 col-form-label">Customer Name</label>
                              <div class="col-sm-4">
                                 <select name="customer_name"  id="customer_name" class="form-control boxbrd">
                                    <option value="">Customer Name</option>
                                    @foreach($customers as $customer)
                                    <option {{ $customer['customer_code']== $manifestoEntry->customer_name?'selected':'' }}  value="{{ $customer['customer_code'] }}">{{ucwords( str_replace('_',' ',$customer['customer_name'])) }}</option>
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
                                    <option {{ $agent['agent_code'] == $manifestoEntry->cf_agent?'selected':'' }} value="{{ $agent['agent_code'] }}">{{ucwords( str_replace('_',' ',$agent['agent_name'])) }}</option>
                                    @endforeach
                                 </select>
                              </div>
                              <label class="col-sm-2 col-form-label">Consignment Weight  </label>
                              <div class="col-sm-4">
                                 <input type="number" min="1" name="consignment_wgt" id="consignment_wgt" value="{{ $manifestoEntry->consignment_wgt}}" class="form-control" placeholder="Enter Consignment Weight">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">No of Package  </label>
                              <div class="col-sm-4">
                                 <input type="number" min="1" name="no_package" id="no_package"  value="{{ $manifestoEntry->no_package}}" class="form-control" placeholder="Enter No of Package">
                              </div>
                           </div>
                        
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
                                    <button onclick="if (!window.__cfRLUnblockHandlers) return false; javascript:toggleFullScreen()" class=" waves-effect waves-light btn waves-effect waves-dark btn-primary btn-outline-primary btn-icon" data-cf-modified-41c5a08083d3d25c74495efb-="">
                                    <i class="full-screen feather icon-maximize"></i>
                                    </button>
                                    <span id="addMoreConsignment" class="btn waves-effect waves-dark btn-primary btn-outline-primary btn-icon"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                 </div>
                              </div>
                              
                                 <div class="card-block">
                                    <div class="table-responsive">
                                       <table id="tableExample"  class="table tableExample table-hover m-b-0">
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
                                             </tr>
                                          </thead>
                                          <tbody>
                                          @foreach($manifestoEntry->getConsignmentDetails as $key=>$value)
                                             <tr class="line">
                                               
                                                <td><input type="text" value="{{$value->report_no}}" name="report_no[{{$key}}]" class="form-control cwth required clone_input " placeholder="Enter Rerport No"></td>
                                                <td><input type="date"   value="{{$value->carry_in_date}}" onkeydown="return false" name="carry_in_date[{{$key}}]"  class="form-control cwth required clone_input" placeholder=""></td>
                                                <td><input type="text"   value="{{$value->container_no}}" name="container_no[{{$key}}]"  class="form-control cwth  clone_input container_no" placeholder="Enter Container No"></td>
                                                <td><input type="number" min="1"  value="{{$value->size}}" name="size[{{$key}}]"  class="form-control cwth   clone_input size" placeholder="Enter Size"></td>
                                                <td ><input type="text"   value="{{$value->seal_s_no1}}"  name="seal_s_no1[{{$key}}]" class="form-control cwth required clone_input seal_s_no1" placeholder="Enter Seal No"></td>
                                                <td >
                                                   <select style="width: auto;" name="commodity[{{$key}}]" class="form-control boxbrd required clone_input commodity_select">
                                                   <option value="">Select Commodity</option>
                                                   @foreach($commodity as $commoditys)
                                                   <option  {{ $commoditys['commodity_code']== $value->commodity?'selected':'' }} value="{{ $commoditys['commodity_code'] }}">{{ucwords( str_replace('_',' ',$commoditys['commodity_name'])) }}</option>
                                                   @endforeach
                                                   </select>
                                                </td>
                                                <td>
                                                <select   style="width: auto;" name="material[{{$key}}]"  class="form-control boxbrd required clone_input material_select">
                                                   <option value="">Select Material</option>
                                                   @foreach($materials as $material)
                                                   <option {{ $material['id'] == $value->material?'selected':'' }} value="{{ $material['id'] }}">{{ucwords( str_replace('_',' ',$material['material_name'])) }}</option>
                                                   @endforeach
                                                   </select>
                                                </td>
                                                <td>
                                                <select  style="width: auto;" name="uom[{{$key}}]" id="uom" class="form-control boxbrd  clone_input">
                                                   <option value="">Select UOM</option>
                                                   @foreach($uoms as $uom)
                                                   <option   {{ $uom['id'] == $value->uom?'selected':'' }} value="{{ $uom['id'] }}">{{ucwords( str_replace('_',' ',$uom['unit_entry_filed'])) }}</option>
                                                   @endforeach
                                                   </select>
                                                </td>
                                                <td><input type="number" min="1"  value="{{$value->declared_wgt}}"  name="declared_wgt[{{$key}}]"  class="form-control cwth  clone_input" placeholder="Declared wgt"></td>
                                                <td><input type="text"   value="{{$value->truck_no}}" name="truck_no[{{$key}}]"  class="form-control cwth required clone_input" placeholder="Truck No"></td>
                                                <td><input type="text"  value="{{$value->trailer_no}}" name="trailer_no[{{$key}}]" class="form-control cwth required clone_input" placeholder="Trailer No"></td>
                                                <td><input type="text"  value="{{$value->driver_name}}"  name="driver_name[{{$key}}]" class="form-control cwth required clone_input" placeholder="Driver Name"></td>
                                                <td><input type="text"  value="{{$value->driver_lic_no}}"   name="driver_lic_no[{{$key}}]"   class="form-control cwth required clone_input" placeholder="Driver lic No"></td>
                                                 @if($key!=0)
                                                 <td><div class='rmv' ><i class='btn-danger fa fa-minus-circle' aria-hidden='true'></i></div></td>
                                                 @endif
                                             </tr>
                                            @endforeach
                                            <input type="hidden" id="counter" value="{{ count($manifestoEntry->getConsignmentDetails) }}">
                                          </tbody>
                                       </table>
                                       
                                    </div>
                                 </div>
                              
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="card">
                     <div class="card-block height">
                        <div class="row">
                           <div class="col-sm-12" style="text-align: center;">
                              <button class="btn btn-success waves-effect waves-light">Update</button>
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


      //   booking_no: {
      //       required: true,
            
      //   },
        customer_name: {
            required: true,
            
        },
        cf_agent: {
            required: true,
        },
        consignment_wgt: {
            required: true,
           
        },
        no_package: {
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



$('.required').each(function() {
 $(this).rules('add', {
    required: true,
 });
});

</script>
@endsection