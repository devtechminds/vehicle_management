@extends('layouts.master')
@section('content')
<div class="page-header card">
<div class="row align-items-end">
<div class="col-lg-6">
<div class="page-header-title">
<i class="feather icon-clipboard bg-c-blue"></i>
<div class="d-inline">
<h2>Update Vehicle Entry
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
<a href="#!">Update Entry</a></li>
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
<!-- <a href="{{ route('proceed.vehilce')}}" title="Clear filter"><i class="fa fa-filter flt"></i></a> -->
</div>
<div class="col-sm-2 boxspace">

 <input type="text" class="form-control hgt" name="gate_entry_no"  id="gate_entry_no" placeholder="Gate Entry No"> 

</div>
<div class="col-sm-1 boxspace">

 <input type="text" class="form-control hgt" name="ref_no" id="ref_no" placeholder="Ref No"> 

</div>

 <div class="col boxspace">
<select name="status" id="status" class="form-control boxbrd hgt">
<option value="">Select Status</option>
<option value="2">Approved</option>
<option value="1">Pending</option>
</select>

</div>
<div class="col-sm-3 boxspace">
<input type="date" id="created_date" onkeydown="return false"  class="form-control hgt"  placeholder="Date">

</div>
<div class="col-sm-1 boxspace">
<button  id="filter" class="btn btn-info waves-effect waves-light btnspace">Filter</button>

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
<th class="hd">Gate Entry No</th>

<th class="hd"> Ref No</th>
<th class="hd"> Cargo Ref No</th>
<th class="hd">Container No</th>
<th class="hd">Truck No</th>
<th class="hd">Trailer No</th>

<!-- <th class="hd">Type of Consignment</th>
<th class="hd">Type of Cargo</th> -->
<th class="hd">Date & Time</th>
<th class="hd">Actions</th>
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
                    url: "{{ route('update.entry.list') }}",
                    type: 'GET',
                    data: function (d) {
                        d.status = $('#status').val();
                        d.gate_entry_no = $('#gate_entry_no').val();
                        d.created_date = $('#created_date').val();
                        d.ref_no = $('#ref_no').val();
                    }
                },
                columns: [
                    {
                    "data": "id",
                    render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                    }
                    },
                    {data: 'gate_entry_no', name: 'gate_entry_no'},

                    {data: 'ref_no', name: 'ref_no',render:function(data, type, row){
                          if(row.ref_no){
                            return row.ref_no;
                        }else{
                            return '';
                        }
                        
                    }},
                    {data: 'cargo_reference_no', name: 'cargo_reference_no',render:function(data, type, row){
                          if(row.cargo_reference_no){
                            return row.cargo_reference_no;
                        }else{
                            return '';
                        }
                        
                    }},
                    {data: 'container_no', name: 'container_no',render:function(data, type, row){
                          if(row.container_no){
                            return row.container_no;
                        }else{
                            return '';
                        }
                        
                    }},
                    {data: 'truck_no', name: 'truck_no',render:function(data, type, row){
                          if(row.truck_no){
                            return row.truck_no;
                        }else{
                            return '';
                        }
                        
                    }},
                    {data: 'trailer_no', name: 'trailer_no',render:function(data, type, row){
                          if(row.trailer_no){
                            return row.trailer_no;
                        }else{
                            return '';
                        }
                        
                    }},
                    // {data: 'manifesto_entry_id', name: 'manifesto_entry_id',render:function(data, type, row){
                    //       if(row.get_manifesto_entry.get_consignment.consignment_type){
                    //         return row.get_manifesto_entry.get_consignment.consignment_type;
                    //     }else{
                    //         return '';
                    //     }
                        
                    // }},

                    // {data: 'manifesto_entry_id', name: 'manifesto_entry_id',render:function(data, type, row){
                    //       if(row.get_manifesto_entry.get_cargo.cargo_name){
                    //         return row.get_manifesto_entry.get_cargo.cargo_name;
                    //     }else{
                    //         return '';
                    //     }
                        
                    // }},
                    
                   
                    
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action'}
                ],
                'columnDefs': [{
                    'targets': [], /* column index */
                    'orderable'
            :
            false, /* true or false */
        }]
        }); setInterval(function() {
            tbl.rows().invalidate().draw(); 
    }, 30000 );
        $('#filter').on('click', function(e) {
            tbl.draw();
            e.preventDefault();
            
        });
        
    });
    
 
    </script>
 
@endsection