@extends('layouts.master')
@section('content')
<div class="page-header card">
<div class="row align-items-end">
<div class="col-lg-6">
<div class="page-header-title">
<i class="feather icon-clipboard bg-c-blue"></i>
<div class="d-inline">
<h2>Users Log List </h2>

</div>
</div>
</div>
<div class="col-lg-6">
<div class="page-header-breadcrumb">
<ul class=" breadcrumb breadcrumb-title">
<li class="breadcrumb-item">
<a href="index.html"><i class="feather icon-home"></i></a>
</li>
<li class="breadcrumb-item"><a href="#!">Users</a></li>
<li class="breadcrumb-item"><a href="#!">Users Log List</a></li>
<!-- <li class="breadcrumb-item"><a href="{{route('user.create')}}" class="btn btn-info btn-sm waves-effect waves-light btnspace">Add User</a></li> -->
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
<a href="{{ route('user.log')}}" title="Clear filter"><i class="fa fa-filter flt"></i></a>
</div>

<div class="col boxspace">
<input type="date" id="date" onkeydown="return false" class="form-control hgt" placeholder="Date">

</div>
<div class="col-sm-1 boxspace">
<button id="filter" class="btn btn-info waves-effect waves-light btnspace">Filter</button>

</div>
</div>

</div>
<div class="card-block">
<div class="table-responsive">
<table id="agent_datatable" class="table table-hover m-b-0">
<thead>
<tr>
<th class="hd">Id </th>
<!-- <th class="hd">User Name</th> -->

<th class="hd"> Log	</th>

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
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<script type="text/javascript">


        $(document).ready( function () {
         var tbl  = $('#agent_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('user.log') }}",
                    type: 'GET',
                    data: function (d) {
                        d.status = $('#status').val();
                        d.user_type = $('#user_type').val();
                        d.date_created = $('#date').val();
                        
                        
                    }
                },
                columns: [
                    {
                    "data": "id",
                    render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                    }
                    },
                    // {data: 'username', name: 'username'},
                    {data: 'message', name: 'message'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action'}
                ],
                'columnDefs': [{
                    'targets': [], /* column index */
                    'orderable':false, /* true or false */
                }],
        });setInterval(function() {
            tbl.rows().invalidate().draw(); 
         }, 30000 );
            $('#filter').on('click', function(e) {
            tbl.draw();
            e.preventDefault();
            });
        });

    </script>
 
@endsection