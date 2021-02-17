@extends('layouts.master')
@section('content')
<div class="page-header card">
<div class="row align-items-end">
<div class="col-lg-6">
<div class="page-header-title">
<i class="feather icon-clipboard bg-c-blue"></i>
<div class="d-inline">
<h2>Material List </h2>

</div>
</div>
</div>
<div class="col-lg-6">
<div class="page-header-breadcrumb">
<ul class=" breadcrumb breadcrumb-title">
<li class="breadcrumb-item">
<a href="index.html"><i class="feather icon-home"></i></a>
</li>
<li class="breadcrumb-item"><a href="#!">Material Master</a></li>
<li class="breadcrumb-item"><a href="#!">Material List</a></li>
<li class="breadcrumb-item"><a href="{{route('material.create')}}" class="btn btn-info btn-sm waves-effect waves-light btnspace">Add Material</a></li>
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
<a href="{{ route('material.index')}}" title="Clear filter"><i class="fa fa-filter flt"></i></a>
</div>

<div class="col boxspace">
<select name="uom"  id="uom" class="form-control boxbrd hgt">
<option value="">Select UOM</option>
@foreach($uom as $value)
<option value="{{ $value['id'] }}">{{ ucwords($value['unit_entry_filed'])}}</option>
@endforeach
</select>
</div>
<div class="col boxspace">
<select name="commodity" id="commodity" class="form-control boxbrd hgt">
<option value="">Select Commodity</option>
@foreach($commodity as $value)
<option value="{{ $value['commodity_code'] }}">{{ ucwords($value['commodity_name'])}}</option>
@endforeach
</select>
</div>



<div class="col boxspace">
<select name="status"  id="status" class="form-control boxbrd hgt">
<option value="">Select Status</option>
<option value="1">Active</option>
<option value="2">Inactive</option>
</select>

</div>

<div class="col boxspace">
<input type="date" id="created_date" onkeydown="return false" class="form-control hgt" placeholder="Date">

</div>
<div class="col-sm-1 boxspace">
<button  id="filter" class="btn btn-info waves-effect waves-light btnspace">Filter</button>

</div>
</div>

</div>
<div class="col-lg-12 boxspace">
    <button class="btn viewModal btn-info" data-title="Active Material" data-msg="Do you want to active all records"  data-name="" data-url="{{route('material.status',['status'=>'active'])}}"  data-type="active" data-id="" data-type="active" data-id="" title="Active">Active</button>
    <button class="btn viewModal btn-info" data-title="Inactive Material" data-msg="Do you want to inactive all records"  data-name="" data-url="{{route('material.status',['status'=>'inactive'])}}"  data-type="inactive" data-id="" data-type="inactive" data-id="" title="Inactive">Inactive</button>
</div>
<div class="card-block">
<div class="table-responsive">
<table id="agent_datatable" class="table table-hover m-b-0">
<thead>
<tr>
<th class="hd">Id </th>
<th class="hd">Material Name</th>
<th class="hd">UOM</th>
<th class="hd">Commodity</th>
<th class="hd">Status</th>
<th class="hd">Created Date</th>
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
           var tbl= $('#agent_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('list.material') }}",
                    type: 'GET',
                    data: function (d) {
                        d.uom = $('#uom').val();
                        d.commodity = $('#commodity').val();
                        d.status = $('#status').val();
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
                    {data: 'material_name', name: 'material_name'},
                    {data: 'material_name', name: 'material_name',render:function(data, type, row){
                       return row.get_u_o_m.unit_entry_filed;
                        
                    }},
                    {data: 'material_name', name: 'material_name',render:function(data, type, row){
                       return row.get_commodity.commodity_name;
                        
                    }},
                    
                    {data: 'status', name: 'status',render:function(data, type, row){
                        if(row.status =='1'){
                            return 'Active';
                        }
                        else{
                            return "Inactive";
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
        });
        $('#filter').on('click', function(e) {
            tbl.draw();
            e.preventDefault();
            
        });
        });
    </script>
 
@endsection