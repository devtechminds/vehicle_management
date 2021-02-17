@extends('layouts.master')
@section('content')
<div class="page-header card">
<div class="row align-items-end">
<div class="col-lg-6">
<div class="page-header-title">
<i class="feather icon-clipboard bg-c-blue"></i>
<div class="d-inline">
<h2>
Gate Pass Approval
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
<li class="breadcrumb-item"><a href="#!">Gate Officer

</a></li>
<li class="breadcrumb-item">
<a href="#!">
Gate pass Approval</a></li>
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
<div class="col-sm-2 boxspace">

 <input type="text" class="form-control hgt" name="gate_entry_no"  id="gate_entry_no" placeholder="Gate Entry No"> 

</div>
<div class="col-sm-1 boxspace">

 <input type="text" class="form-control hgt" name="ref_no" id="ref_no" placeholder="Ref No"> 

</div>

<div class="col boxspace">
<select name="status" id="status" class="form-control boxbrd hgt">
<option value="">Select Status</option>
<option value="3">Pending</option>
<<option value="2">Approved</option>
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
<th class="hd"> Gate Entry No</th>

<th class="hd"> Ref No</th>
<th class="hd"> Cargo Ref No</th>
<th class="hd">Type of Cargo</th>
<th class="hd"> CFS Release No</th> 
<th class="hd"> CFS Release Date</th>
<th class="hd">CF Agent</th>
<th class="hd">Container No</th>


<th class="hd">Type of Consignment</th>

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
                    url: "{{ route('proceed.container.out.list') }}",
                    type: 'GET',
                    data: function (d) {
                        d.status = $('#status').val();
                        d.gate_entry_no = $('#gate_entry_no').val();
                        d.created_date = $('#created_date').val();
                    }
                },
                columns: [
                    {
                    "data": "id",
                    render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                    }
                    },
                    
                   
                    {data: 'manifesto_entry_id', name: 'manifesto_entry_id',render:function(data, type, row){
                          if(row.get_gate_entry_out.gate_entry_no){
                            return row.get_gate_entry_out.gate_entry_no;
                        }else{
                            return '';
                        }
                        
                    }},
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
                    {data: 'cargo_type', name: 'cargo_type',render:function(data, type, row){
                          if(row.cargo_type){
                            return row.cargo_type;
                        }else{
                            return '';
                        }
                        
                    }},
                    // {data: 'manifesto_entry_id', name: 'manifesto_entry_id',render:function(data, type, row){
                    //       if(row.get_release_approval_finacial_officer_entry.cfs_release_no){
                    //         return row.get_release_approval_finacial_officer_entry.cfs_release_no;
                    //          }else{
                    //         return '';
                    //     }
                        
                    // }},
                    {data: 'cfs_release_no', name: 'cfs_release_no',render:function(data, type, row){
                          if(row.cfs_release_no){
                            return row.cfs_release_no;
                             }else{
                            return '';
                        }
                        
                    }},
                    // {data: 'manifesto_entry_id', name: 'manifesto_entry_id',render:function(data, type, row){
                    //       if(row.get_release_approval_finacial_officer_entry.cfs_release_date){
                    //         return row.get_release_approval_finacial_officer_entry.cfs_release_date;
                    //          }else{
                    //         return '';
                    //     }
                        
                    // }},
                    {data: 'cfs_release_date', name: 'cfs_release_date',render:function(data, type, row){
                          if(row.cfs_release_date){
                            return row.cfs_release_date;
                             }else{
                            return '';
                        }
                        
                    }},
                    {data: 'manifesto_entry_id', name: 'manifesto_entry_id',render:function(data, type, row){
                          if(row.get_manifesto_entry.get_agent.agent_name){
                            return row.get_manifesto_entry.get_agent.agent_name;
                        }else{
                            return '';
                        }
                        
                    }},
                    
                    {data: 'consignment_details_id', name: 'consignment_details_id',render:function(data, type, row){
                          if(row.get_consignment_details.container_no){
                            return row.get_consignment_details.container_no;
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