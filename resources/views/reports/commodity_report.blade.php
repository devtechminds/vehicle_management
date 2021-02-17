@extends('layouts.master')
@section('content')
<div class="page-header card">
<div class="row align-items-end">
<div class="col-lg-6">
<div class="page-header-title">
<i class="feather icon-clipboard bg-c-blue"></i>
<div class="d-inline">
<h2>Commodity Report
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
<li class="breadcrumb-item"><a href="#!">Reports


</a></li>
<li class="breadcrumb-item">
<a href="#!">Commodity Report</a></li>
</ul>
</div>
</div>
</div>
</div>
<div class="pcoded-inner-content">
@if (session('create'))
  <div class="alert alert-success alert-dismissable custom-success-box" style="margin: 15px;">
     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     <strong> {{ session('create') }} </strong>
  </div>
@endif
<div class="main-body">
<div class="page-wrapper">

<div class="page-body">
<div class="row">






<div class="col-md-12">
<div class="card table-card">
   
<div class="card-header flthd">
   
<div class="form-group row">

<div class="col boxspace">
<a href="{{ route('proceed.vehilce')}}" title="Clear filter"><i class="fa fa-filter flt"></i></a>
</div>
<div class="col boxspace">
<select name="report_type" id="report_type" class="form-control boxbrd hgt">
<option value="in">IN</option>
<option value="out">OUT</option>
</select>

</div>
<div class="col boxspace">
<select name="commodity" id="commodity" class="form-control boxbrd hgt">
<option value="">Select Commodity</option>
@foreach($commodity as $commoditys)
<option value="{{$commoditys['commodity_code']}}">{{ ucfirst($commoditys['commodity_name']) }}</option>
@endforeach
</select>

</div>


<div class="col boxspace">
<select name="material" id="material" class="form-control boxbrd hgt">
<option value="">Select Material</option>

</select>

</div>
<div class="col-sm-2 boxspace">
<input type="date" id="from_date" name="from_date" value="{{date('Y-m-d')}}" onkeydown="return false"  class="form-control hgt"  placeholder="Date">

</div>
<div class="col-sm-2 boxspace">
<input type="date" id="to_date" name="to_date" value="{{date('Y-m-d')}}" onkeydown="return false"  class="form-control hgt"  placeholder="Date">

</div>
<div class="col-sm-1 boxspace">
<button  id="filter" class="btn btn-info waves-effect waves-light btnspace">Filter</button>

</div>
<div class="col-sm-1 boxspace">
<form action="{{route('commodity.report.download')}}" method="post">
{{ csrf_field() }}
<input type="hidden" name="report_type_submit" id="report_type_submit">
<input type="hidden" name="commodity_id" id="commodity_id" >
<input type="hidden" name="material_id" id="material_id" >
<input type="hidden" name="from_date_submit" id="from_date_submit">
<input type="hidden" name="customer" id="customer_id">
<input type="hidden" name="to_date_submit" id="to_date_submit">
<button  id="download" class="btn btn-info waves-effect waves-light btnspace"><i class="fa fa-download"></i></button>
</form>
</div>
</div>

</div>
<div class="col-lg-12 boxspace">
    <!-- <button class="btn viewModal btn-info" data-title="Active Shipment" data-msg="Do you want to active all records"  data-name="" data-url="{{route('shipment.status',['status'=>'active'])}}"  data-type="active" data-id="" data-type="active" data-id="" title="Active">Active</button> -->
    <!-- <button class="btn viewModal btn-info" data-title="Inactive Shipment" data-msg="Do you want to inactive all records"  data-name="" data-url="{{route('shipment.status',['status'=>'inactive'])}}"  data-type="inactive" data-id="" data-type="inactive" data-id="" title="Inactive">Inactive</button> -->
</div>
<div class="card-block">
<div class="table-responsive">
<table id="agent_datatable" class="table table-hover m-b-0">
<thead>
<tr>
<th class="hd">Id </th>
<!-- <th class="hd">Gate Entry No</th> -->

<th class="hd"> Ref No</th>
<th class="hd"> Cargo Ref No</th>
<!-- <th class="hd">Container No</th> -->
<th class="hd">Type of Cargo</th>
<th class="hd">Type of Consignment</th>

<th class="hd">Date & Time</th>
<!-- <th class="hd">Actions</th> -->
</tr>
</thead>

<tbody>

</tbody>




 </table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="//code.jquery.com/jquery.js"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
        $(document).ready( function () {
        var tbl = $('#agent_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('commodity.report') }}",
                    type: 'GET',
                    data: function (d) {
                        d.report_type = $('#report_type').val();
                        d.status = $('#status').val();
                        d.gate_entry_no = $('#gate_entry_no').val();
                        d.to_date = $('#to_date').val();
                        d.commodity = $('#commodity').val();
                        d.from_date = $('#from_date').val();
                        d.material = $('#material').val();
                        d.customer = $('#customer').val();
                        
                        
                    }
                },
                columns: [
                    {
                    "data": "id",
                    render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                    }
                    },
                    
                    // {data: 'gate_entry_no', name: 'gate_entry_no',render:function(data, type, row){
                    //       if(row.get_gate_entry.gate_entry_no){
                    //         return row.get_gate_entry.gate_entry_no;
                    //     }else{
                    //         return '';
                    //     }
                        
                    // }},

                    {data: 'manifesto_entry_id', name: 'manifesto_entry_id',render:function(data, type, row){
                          if(row.get_manifesto_entry.ref_no){
                            return row.get_manifesto_entry.ref_no;
                        }else{
                            return '';
                        }
                        
                    }},
                    {data: 'manifesto_entry_id', name: 'manifesto_entry_id',render:function(data, type, row){
                          if(row.get_manifesto_entry.cargo_reference_no){
                            return row.get_manifesto_entry.cargo_reference_no;
                        }else{
                            return '';
                        }
                        
                    }},
                    // {data: 'consignment_details_id', name: 'consignment_details_id',render:function(data, type, row){
                    //       if(row.get_consignment_details.container_no){
                    //         return row.get_consignment_details.container_no;
                    //     }else{
                    //         return '';
                    //     }
                        
                    // }},
                  
                    {data: 'cargo_type', name: 'cargo_type',render:function(data, type, row){
                          if(row.cargo_type){
                            return row.cargo_type;
                        }else{
                            return '';
                        }
                        
                    }},
                      {data: 'manifesto_entry_id', name: 'manifesto_entry_id',render:function(data, type, row){
                          if(row.get_manifesto_entry.get_consignment.consignment_type){
                            return row.get_manifesto_entry.get_consignment.consignment_type;
                        }else{
                            return '';
                        }
                        
                    }},

                   
                    
                    {data: 'created_at', name: 'created_at'},
                    // {data: 'action', name: 'action'}
                ],
                'columnDefs': [{
                    'targets': [], /* column index */
                    'orderable'
            :
            false, /* true or false */
        }]
        }); setInterval(function() {
            tbl.rows().invalidate().draw(); 
    }, 11130000 );
        $('#filter').on('click', function(e) {
            tbl.draw();
            e.preventDefault();
            
        });
        
    });
    
    $(document).on("change", "#commodity", function () {
    var id = $(this).val(); //get the current value's option
    var thisObj = $(this);
    $.ajax({
        type:'GET',
        url:'/get-material-by-comodity/'+id,
        success:function(data){
           $('#material').html(data);
        }
    });
});


$(document).on("change", "#report_type", function () {
    var id = $(this).val(); //get the current value's option
    $('#report_type_submit').val(id);
  
});

$(document).on("change", "#commodity", function () {
    var id = $(this).val(); //get the current value's option
    $('#commodity_id').val(id);
  
});
$(document).on("change", "#material", function () {
    var id = $(this).val(); //get the current value's option
    $('#material_id').val(id);
  
});

$(document).on("change", "#from_date", function () {
    var id = $(this).val(); //get the current value's option
    $('#from_date_submit').val(id);
  
});
$(document).on("change", "#to_date", function () {
    var id = $(this).val(); //get the current value's option
    $('#to_date_submit').val(id);
  
});


$(document).on("change", "#customer", function () {
    var id = $(this).val(); //get the current value's option
    $('#customer_id').val(id);
  
});

$(document).ready(function() {
    $('#report_type_submit').val($('#report_type').val());
    $('#from_date_submit').val($('#from_date').val());
    $('#to_date_submit').val($('#to_date').val());
    $('#customer').val($('#customer_id').val());
    
});

    </script>
 
@endsection