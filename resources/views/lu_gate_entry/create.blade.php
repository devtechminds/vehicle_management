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
               <li class="breadcrumb-item"><a href="#!">Gate1 Entry Officer</a></li>
               <li class="breadcrumb-item">
                  <a href="#!">Loading Gate1 Entry Screen</a>
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
<form action="{{route('manifesto.store')}}" id="myform" method="post">
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
                           <input type="text" class="form-control bld sdt" value="{{$ref_no}}" placeholder="" readonly>
                           </div>
                           <div class="col-sm-8">

                           </div>
                           <div class="col-sm-2">
                           <p class="bigf">Date:</p>	
                           <input type="text" class="form-control bld"  value="{{ date('d-m-Y')}}" placeholder="" readonly>
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
                                       <option value="{{ {{ $commodity['commodity_code'] }}">{{ucwords( str_replace('_',' ',$commodity['commodity_name'])) }}</option>
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
                                       <option value="{{ {{ $transport['transport_code'] }}">{{ucwords( str_replace('_',' ',$transport['transport_name'])) }}</option>
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
                           <input type="text" name="time_in" id="time_in" class="form-control" placeholder="" value="10:10 AM" readonly>
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
                  </div>
                 
                  <div class="card">
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
    console.log(cargo);
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

   // if((consignment_type =='Transit' && cargo=='transit_loose_material_comes_in_and_empty_vehicle_goes_out') || (consignment_type =='Local' && cargo=='local_loose_material_comes_in_and_empty_vehicle_goes_out')){
   //    $('.seal_s_no1').attr('disabled','disabled');
   //    $('.container_no').attr('disabled','disabled');
   //    $('.size').attr('disabled','disabled');
   // }else{
   //    $('.seal_s_no1').removeAttr('disabled');
   //    $('.container_no').removeAttr('disabled','disabled');
   //    $('.size').removeAttr('disabled','disabled');
   // }
   
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


        booking_no: {
            required: true,
            
        },
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
      $(".btnSubmitClick").addClass("disabled");
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

   var cargo_type = $("#cargo_type").find("option:selected").val();
   cargo  =  cargo_type.substring(0, cargo_type.lastIndexOf("/"));
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