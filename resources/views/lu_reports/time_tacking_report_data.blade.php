@extends('layouts.master')
@section('content')
<style>
   table.dataTable td.dataTables_empty {
    text-align: left !important;
    padding-left: 400px !important;
}
</style>
<div class="page-header card">
   <div class="row align-items-end">
      <div class="col-lg-6">
         <div class="page-header-title">
            <i class="feather icon-clipboard bg-c-blue"></i>
            <div class="d-inline">
               <h2>Time Tacking Reports</h2>
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
                  </a>
               </li>
               <li class="breadcrumb-item">
                  <a href="#!">Time Tacking Report </a>
               </li>
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
                                    <th class="hd">Process</th>
                                    <th class="hd">Action Date/Time</th>
                                    <th class="hd">Action Time Diff</th>
                                    <th class="hd">Action By</th>
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
   </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="//code.jquery.com/jquery.js"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript">

var id = '{{ request()->get("id") }}'

   $(document).ready( function () {
   var tbl = $('#agent_datatable').DataTable({
           processing: true,
           serverSide: true,
           ajax: {
               url: "{{ route('loading.time.tracking.report') }}",
               type: 'GET',
               data: function (d) {
                   d.id = id;
                   
               }
           },
           columns: [
               {
               "data": "id",
               render: function (data, type, row, meta) {
               return meta.row + meta.settings._iDisplayStart + 1;
               }
               },
               {data: 'new_status', name: 'new_status'},
               {data: 'action_time', name: 'action_time'},
               {data: 'action_time_diff', name: 'action_time_diff'},
               {data: 'action_by', name: 'action_by'},
               
           ],
         //   'order': [[ 1, "desc" ]],
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
   
  
   
   
   $(document).on("change", "#report_type", function () {
   var id = $(this).val(); //get the current value's option
   $('#report_type_submit').val(id);
   
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