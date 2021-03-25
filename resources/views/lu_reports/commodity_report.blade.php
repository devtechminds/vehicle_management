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
               <h2>Commodity Wise Report</h2>
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
                  <a href="#!">Commodity Wise Report </a>
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
                              <select name="report_type" id="report_type" class="form-control boxbrd hgt">
                                 <option value="1">Loading</option>
                                 <option value="2">Unloading</option>
                              </select>
                           </div>
                           <div class="col boxspace">
                              <select name="commodity" id="commodity" class="form-control boxbrd hgt commodity_select">
                                 <option value="">Select Commodity</option>
                                 @foreach($commoditys as $commodity)
                                 <option value="{{ $commodity['commodity_code'] }}">{{ucwords( str_replace('_',' ',$commodity['commodity_name'])) }}</option>
                                 @endforeach
                              </select>
                           </div>
                           <div class="col boxspace material-data">
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
                              <form action="{{route('loading.commodity.report.download')}}" method="post">
                                 {{ csrf_field() }}
                                 <input type="hidden" name="report_type_submit" id="report_type_submit">
                                 <input type="hidden" name="from_date_submit" id="from_date_submit">
                                 <input type="hidden" name="commodity" id="commodity_id">
                                 <input type="hidden" name="material" id="material_id">
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
               url: "{{ route('loading.commodity.report') }}",
               type: 'GET',
               data: function (d) {
                   d.report_type = $('#report_type').val();
                   d.to_date = $('#to_date').val();
                   d.from_date = $('#from_date').val();
                   d.commodity = $('#commodity').val();
                   d.material = $('#material').val();
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
   
   $(document).on("change", "#commodity", function () {
   var id = $(this).val(); //get the current value's option
   $('#commodity_id').val(id);
   
   });

   $(document).on("change", "#material", function () {
   var id = $(this).val(); //get the current value's option
   $('#material_id').val(id);
   
   });
   
   $(document).ready(function() {
   $('#report_type_submit').val($('#report_type').val());
   $('#from_date_submit').val($('#from_date').val());
   $('#to_date_submit').val($('#to_date').val());
   $('#commodity').val($('#commodity_id').val());
   $('#material').val($('#material_id').val());
   });

   $(document).on("change", ".commodity_select", function () {
    var id = $(this).val(); //get the current value's option
    var thisObj = $(this);
    if(id){
      $.ajax({
        type:'GET',
        url:'/material-by-comodity/'+id,
        success:function(data){
           $(".material-data select").html(data);
        }
      });
    }    
});
   
</script>
@endsection