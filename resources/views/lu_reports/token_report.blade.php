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
               <h2>Token/Ticket No Wise Report</h2>
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
                  <a href="#!">Token/Ticket No Wise Report </a>
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
                           <div class="col boxspace">
                              <a href="{{ route('proceed.vehilce')}}" title="Clear filter"><i class="fa fa-filter flt"></i></a>
                           </div>
                           <div class="col boxspace">
                           <input type="text" name="token_no" id="token_no" class="form-control" value="" placeholder="Tocken No">
                           </div>
                           <div class="col boxspace">
                           <input type="text" name="wb_ticket_no" id="wb_ticket_no" value="" class="form-control" placeholder="Weighbridge Ticket No">
                           </div>
                           <div class="col-sm-1 boxspace">
                              <button  id="filter" class="btn btn-info waves-effect waves-light btnspace">Filter</button>
                           </div>
                           <div class="col-sm-1 boxspace">
                              <form action="{{route('loading.token.report.download')}}" method="post">
                                 {{ csrf_field() }}
                                 <input type="hidden" name="token_no" id="token_id">
                                 <input type="hidden" name="wb_ticket_no" id="wb_ticket_id">
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
                                    <th class="hd">Gate Entry Date</th>
                                    <th class="hd">Loading Date</th>
                                    <th class="hd">Vehicle Exit Date</th>
                                    <th class="hd">Token No</th>
                                    <th class="hd">WB Ticket No</th>
                                    <th class="hd">Container Tare Wt(Kg)</th>
                                    <th class="hd">TRA Seal No</th>
                                    <th class="hd">Shipping Line No</th>
                                    <th class="hd">Interchange No</th>
                                    <th class="hd">Container No</th>
                                    <th class="hd">Customer</th>
                                    <th class="hd">Transporter</th>
                                    <th class="hd">Truck No</th>
                                    <th class="hd">Trailor No</th>
                                    <th class="hd">Destination To</th>
                                    <th class="hd">DO NO</th>
                                    <th class="hd">DO QTY</th>
                                    <th class="hd">BL NO</th>
                                    <th class="hd">BL QTY</th>
                                    <th class="hd">Commodity</th>
                                    <th class="hd">Material Name</th>
                                    <th class="hd">Unit</th>
                                    <th class="hd">Despatch QTY</th>
                                    <th class="hd">Total Weight</th>
                                    <th class="hd">Gross Weight</th>
                                    <th class="hd">Tare Weight</th>
                                    <th class="hd">Net Weight</th>
                                    <th class="hd">Total Despatch QTY</th>
                                    <th class="hd">Remarks</th>
                                    <th class="hd">Status</th>
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
   $(document).ready( function () {
   var tbl = $('#agent_datatable').DataTable({
           processing: true,
           serverSide: true,
           ajax: {
               url: "{{ route('loading.token.report') }}",
               type: 'GET',
               data: function (d) {
                   d.token_no = $('#token_no').val();
                   d.wb_ticket_no = $('#wb_ticket_no').val();
               }
           },
           columns: [
               {
               "data": "id",
               render: function (data, type, row, meta) {
               return meta.row + meta.settings._iDisplayStart + 1;
               }
               },
               {data: 'created_at', name: 'created_at'},
               {data: 'loading_date', name: 'loading_date'},
               {data: 'vehicle_exit_date', name: 'vehicle_exit_date'},
               {data: 'ref_no', name: 'ref_no'},
               {data: 'wb_ticket_no', name: 'wb_ticket_no'},
               {data: 'container_tare_wt', name: 'container_tare_wt'},
               {data: 'tra_seal_no', name: 'tra_seal_no'},
               {data: 'shipping_line', name: 'shipping_line'},
               {data: 'interchange_no', name: 'interchange_no'},
               {data: 'container_no', name: 'container_no'},
               {data: 'customer_name', name: 'customer_name'},
               {data: 'transport_name', name: 'transport_name'},
               {data: 'truck_no', name: 'truck_no'},
               {data: 'trailer_no', name: 'trailer_no'},
               {data: 'destination', name: 'destination'}, 
               {data: 'dn_no', name: 'dn_no'},
               {data: 'dn_qty', name: 'dn_qty'},
               {data: 'bl_no', name: 'bl_no'},
               {data: 'bl_qty', name: 'bl_qty'},
               {data: 'commodity_name', name: 'commodity_name'},
               {data: 'material_name', name: 'material_name'},
               {data: 'unit_entry_filed', name: 'unit_entry_filed'},
               {data: 'commodity_quantity', name: 'commodity_quantity'},
               {data: 'total_weight', name: 'total_weight'},
               {data: 'wb_gross_wt', name: 'wb_gross_wt'},
               {data: 'wb_tare_wt', name: 'wb_tare_wt'},
               {data: 'wb_net_wt', name: 'wb_net_wt'},
               {data: 'metric_ton', name: 'metric_ton'},
               {data: 'remarks', name: 'remarks'},
               {data: 'status', name: 'status'}, 
           ],
           'order': [[ 1, "desc" ]],
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
   
 
   $(document).on("change", "#token_no", function () {
   var id = $(this).val(); //get the current value's option
   $('#token_id').val(id);
   
   });

   $(document).on("change", "#wb_ticket_no", function () {
   var id = $(this).val(); //get the current value's option
   $('#wb_ticket_id').val(id);
   
   });
   
   $(document).ready(function() {
   $('#token_no').val($('#token_id').val());
   $('#wb_ticket_no').val($('#wb_ticket_id').val());
   });

   
   
</script>
@endsection