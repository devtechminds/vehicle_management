@extends('layouts.master')
@section('content')
<div class="tab">
  <button class="tablinks" id="defaultOpen" onclick="openTab(event, 'cfs')">CFS</button>
  <button class="tablinks" onclick="openTab(event, 'loading')">Loading & Unloading</button>
</div>
<div id="cfs" class="tabcontent">
<div class="page-header card">
   <div class="row align-items-end">
      <div class="col-lg-8">
         <div class="page-header-title">
            <i class="feather icon-home bg-c-blue"></i>
            <div class="d-inline">
               <h5>Dashborad CFS</h5>
               <span></span>
            </div>
         </div>
      </div>
      <div class="col-lg-4">
         <div class="page-header-breadcrumb">
            <ul class=" breadcrumb breadcrumb-title">
               <li class="breadcrumb-item">
                  <a href="index.html"><i class="feather icon-home"></i></a>
               </li>
               <li class="breadcrumb-item"><a href="#!">Dashboard</a> </li>
            </ul>
         </div>
      </div>
   </div>
</div>
<div class="pcoded-inner-content">
   <div class="main-body">
      <div class="page-wrapper">
         <div class="page-body">
            <div class="row">
             
               <div class="col-xl-3 col-md-6 colheg">
                  <div class="card prod-p-card card-red chgt">
                     <div class="card-body">
                        <div class="row align-items-center m-b-30">
                           <div class="col">
                              <h6 class="m-b-5 text-white">  Total Vehicle In Registered </h6>
                              <h3 class="m-b-0 f-w-700 text-white">{{ $gate_entry['authorize_vehicle_in']}}</h3>
                           </div>
                           <div class="col-auto">
                              <!--<i class="fas fa-money-bill-alt text-c-red f-18"></i>-->
                              <i class="fa fa-bus text-c-red"></i>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-3 col-md-6 colheg">
                  <div class="card prod-p-card card-blue chgt">
                     <div class="card-body">
                        <div class="row align-items-center m-b-30">
                           <div class="col">
                              <h6 class="m-b-5 text-white">  Total Proceed Vehicle </h6>
                              <h3 class="m-b-0 f-w-700 text-white">{{ $gate_entry['proceed_vehicle']}}</h3>
                           </div>
                           <div class="col-auto">
                              <!--<i class="fas fa-database text-c-blue f-18"></i>-->
                              <i class="fa fa-bus text-c-blue"></i>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-3 col-md-6 colheg">
                  <div class="card prod-p-card card-green chgt">
                     <div class="card-body">
                        <div class="row align-items-center m-b-30 colh">
                           <div class="col">
                              <h6 class="m-b-5 text-white"> Total Container Out Registered</h6>
                              <h3 class="m-b-0 f-w-700 text-white">{{ $gate_entry['container_out_weigh_bridge_exit']}}</h3>
                           </div>
                           <div class="col-auto">
                              <!--<i class="fas fa-dollar-sign text-c-green f-18"></i>-->
                              <i class="fa fa-car text-c-green"></i>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-3 col-md-6 colheg">
                  <div class="card prod-p-card card-yellow chgt">
                     <div class="card-body">
                        <div class="row align-items-center m-b-30">
                           <div class="col">
                              <h6 class="m-b-5 text-white">Total CFS OUT </h6>
                              <h3 class="m-b-0 f-w-700 text-white">{{ $gate_entry['total_cfs_out']}} </h3>
                           </div>
                           <div class="col-auto">
                              <i class="fas fa-tags text-c-yellow f-18"></i>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-3 col-md-6 colheg">
                  <div class="card prod-p-card card-yellow chgt">
                     <div class="card-body">
                        <div class="row align-items-center m-b-30">
                           <div class="col">
                              <h6 class="m-b-5 text-white"> Total Weigh Bridge </h6>
                              <h3 class="m-b-0 f-w-700 text-white">{{ $gate_entry['weigh_bridge_entry']}} </h3>
                           </div>
                           <div class="col-auto">
                              <i class="fas fa-tags text-c-yellow f-18"></i>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
              
               </div>

               <div class="row">  
               <div class="col-md-6">
                  <div class="card table-card">
                     <div class="card-header">
                        <h5>Pending- Vehicle Return Approval</h5>
                        <div class="card-header-right">
                           <ul class="list-unstyled card-option">
                              <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                              <li><i class="feather icon-maximize full-card"></i></li>
                              <li><i class="feather icon-minus minimize-card"></i></li>
                              <li><i class="feather icon-refresh-cw reload-card"></i></li>
                              <li><i class="feather icon-trash close-card"></i></li>
                              <li><i class="feather icon-chevron-left open-card-option"></i></li>
                           </ul>
                        </div>
                     </div>
                     <div class="card-block p-b-0">
                        <div class="table-responsive">
                           <table class="table table-hover m-b-0" id="loading_dashboard_list">
                              <thead>
                                <tr>
                                <th class="hd">Id </th>
                                <th class="hd">Gate Entry No</th>

                                <th class="hd"> Ref No</th>
                                <th class="hd"> Cargo Ref No</th>
                                <th class="hd">Container No</th>
                                <th class="hd">Type of Cargo</th>
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
               <div class="col-md-6">
                  <div class="card table-card">
                     <div class="card-header">
                        <h5>Pending- Container Stuffing Approval</h5>
                        <div class="card-header-right">
                           <ul class="list-unstyled card-option">
                              <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                              <li><i class="feather icon-maximize full-card"></i></li>
                              <li><i class="feather icon-minus minimize-card"></i></li>
                              <li><i class="feather icon-refresh-cw reload-card"></i></li>
                              <li><i class="feather icon-trash close-card"></i></li>
                              <li><i class="feather icon-chevron-left open-card-option"></i></li>
                           </ul>
                        </div>
                     </div>
                     <div class="card-block p-b-0">
                        <div class="table-responsive">
                           <table class="table table-hover m-b-0" id="ContainerStuffingApproval">
                              <thead>
                                <tr>
                                <th class="hd">Id </th>
                                <th class="hd">Gate Entry No</th>

                                <th class="hd"> Ref No</th>
                                <th class="hd"> Cargo Ref No</th>
                                <th class="hd">Container No</th>
                                <th class="hd">Type of Cargo</th>
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
               
               <div class="col-md-6">
                  <div class="card table-card">
                     <div class="card-header">
                        <h5>Pending- Container Out Approval </h5>
                        <div class="card-header-right">
                           <ul class="list-unstyled card-option">
                              <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                              <li><i class="feather icon-maximize full-card"></i></li>
                              <li><i class="feather icon-minus minimize-card"></i></li>
                              <li><i class="feather icon-refresh-cw reload-card"></i></li>
                              <li><i class="feather icon-trash close-card"></i></li>
                              <li><i class="feather icon-chevron-left open-card-option"></i></li>
                           </ul>
                        </div>
                     </div>
                     <div class="card-block p-b-0">
                        <div class="table-responsive">
                           <table class="table table-hover m-b-0" id="ContainerOutApproval">
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
               <div class="col-md-12">
                  <div class="card table-card">
                     <div class="card-header">
                        <h5>Gate Entries </h5>
                        <div class="card-header-right">
                           <ul class="list-unstyled card-option">
                              <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                              <li><i class="feather icon-maximize full-card"></i></li>
                              <li><i class="feather icon-minus minimize-card"></i></li>
                              <li><i class="feather icon-refresh-cw reload-card"></i></li>
                              <li><i class="feather icon-trash close-card"></i></li>
                              <li><i class="feather icon-chevron-left open-card-option"></i></li>
                           </ul>
                        </div>
                     </div>
                     <div class="card-block p-b-0">
                        <div class="table-responsive">
                           <table class="table table-hover m-b-0" id="GateEntries">
                              <thead>
                                <tr>
                                <th class="hd">Id </th>
                                <th class="hd">Gate Entry No</th>
                                <th class="hd"> Ref No</th>
                                <th class="hd"> Cargo Ref No</th>
                                <th class="hd">Container No</th>
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
   </div>
</div>
</div><!-- cfs -->

<div id="loading" class="tabcontent">
<div class="page-header card">
   <div class="row align-items-end">
      <div class="col-lg-8">
         <div class="page-header-title">
            <i class="feather icon-home bg-c-blue"></i>
            <div class="d-inline">
               <h5>Dashborad Loading & Unloading</h5>
               <span></span>
            </div>
         </div>
      </div>
      <div class="col-lg-4">
         <div class="page-header-breadcrumb">
            <ul class=" breadcrumb breadcrumb-title">
               <li class="breadcrumb-item">
                  <a href="index.html"><i class="feather icon-home"></i></a>
               </li>
               <li class="breadcrumb-item"><a href="#!">Dashboard</a> </li>
            </ul>
         </div>
      </div>
   </div>
</div>
<div class="pcoded-inner-content">
   <div class="main-body">
      <div class="page-wrapper">
         <div class="page-body">
            <div class="row">
             
               <div class="col-xl-3 col-md-6 colheg">
                  <div class="card prod-p-card card-red chgt">
                     <div class="card-body">
                        <div class="row align-items-center m-b-30">
                           <div class="col">
                              <h6 class="m-b-5 text-white">  Loading </h6>
                              <h3 class="m-b-0 f-w-700 text-white">{{ $loading_entry['loading_count']}}</h3>
                           </div>
                           <div class="col-auto">
                              <!--<i class="fas fa-money-bill-alt text-c-red f-18"></i>-->
                              <i class="fa fa-bus text-c-red"></i>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-xl-3 col-md-6 colheg">
                  <div class="card prod-p-card card-blue chgt">
                     <div class="card-body">
                        <div class="row align-items-center m-b-30">
                           <div class="col">
                              <h6 class="m-b-5 text-white">  Unloading </h6>
                              <h3 class="m-b-0 f-w-700 text-white">{{ $loading_entry['unloading_count']}}</h3>
                           </div>
                           <div class="col-auto">
                              <!--<i class="fas fa-database text-c-blue f-18"></i>-->
                              <i class="fa fa-bus text-c-blue"></i>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               
               </div>

               <div class="row">  
               <div class="col-md-6">
                  <div class="card table-card">
                     <div class="card-header">
                        <h5>Loading</h5>
                        <div class="card-header-right">
                           <ul class="list-unstyled card-option">
                              <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                              <li><i class="feather icon-maximize full-card"></i></li>
                              <li><i class="feather icon-minus minimize-card"></i></li>
                              <li><i class="feather icon-refresh-cw reload-card"></i></li>
                              <li><i class="feather icon-trash close-card"></i></li>
                              <li><i class="feather icon-chevron-left open-card-option"></i></li>
                           </ul>
                        </div>
                     </div>
                     <div class="card-block p-b-0">
                        <div class="table-responsive">
                           <table class="table table-hover m-b-0" id="Vehicle_Return_Approval">
                              <thead>
                                <tr>
                                <th class="hd">Id </th>
                                <th class="hd">Gate Entry No</th>
                                <th class="hd"> Ref No</th>
                                <th class="hd"> Cargo Ref No</th>
                                <th class="hd">Container No</th>
                                <th class="hd">Type of Cargo</th>
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
               <div class="col-md-6">
                  <div class="card table-card">
                     <div class="card-header">
                        <h5>Unloading</h5>
                        <div class="card-header-right">
                           <ul class="list-unstyled card-option">
                              <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                              <li><i class="feather icon-maximize full-card"></i></li>
                              <li><i class="feather icon-minus minimize-card"></i></li>
                              <li><i class="feather icon-refresh-cw reload-card"></i></li>
                              <li><i class="feather icon-trash close-card"></i></li>
                              <li><i class="feather icon-chevron-left open-card-option"></i></li>
                           </ul>
                        </div>
                     </div>
                     <div class="card-block p-b-0">
                        <div class="table-responsive">
                           <table class="table table-hover m-b-0" id="ContainerStuffingApproval">
                              <thead>
                                <tr>
                                <th class="hd">Id </th>
                                <th class="hd">Gate Entry No</th>
                                <th class="hd"> Ref No</th>
                                <th class="hd"> Cargo Ref No</th>
                                <th class="hd">Container No</th>
                                <th class="hd">Type of Cargo</th>
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
               
               <div class="col-md-6">
                  <div class="card table-card">
                     <div class="card-header">
                        <h5>Pending- Container Out Approval </h5>
                        <div class="card-header-right">
                           <ul class="list-unstyled card-option">
                              <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                              <li><i class="feather icon-maximize full-card"></i></li>
                              <li><i class="feather icon-minus minimize-card"></i></li>
                              <li><i class="feather icon-refresh-cw reload-card"></i></li>
                              <li><i class="feather icon-trash close-card"></i></li>
                              <li><i class="feather icon-chevron-left open-card-option"></i></li>
                           </ul>
                        </div>
                     </div>
                     <div class="card-block p-b-0">
                        <div class="table-responsive">
                           <table class="table table-hover m-b-0" id="ContainerOutApproval">
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
               <div class="col-md-12">
                  <div class="card table-card">
                     <div class="card-header">
                        <h5>Gate Entries </h5>
                        <div class="card-header-right">
                           <ul class="list-unstyled card-option">
                              <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                              <li><i class="feather icon-maximize full-card"></i></li>
                              <li><i class="feather icon-minus minimize-card"></i></li>
                              <li><i class="feather icon-refresh-cw reload-card"></i></li>
                              <li><i class="feather icon-trash close-card"></i></li>
                              <li><i class="feather icon-chevron-left open-card-option"></i></li>
                           </ul>
                        </div>
                     </div>
                     <div class="card-block p-b-0">
                        <div class="table-responsive">
                           <table class="table table-hover m-b-0" id="GateEntries">
                              <thead>
                                <tr>
                                 <th class="hd">Id</th>
                                 <th class="hd">Ref No</th>
                                 <th class="hd">Customer Name</th>
                                 <th class="hd">Commodity</th>
                                 <th class="hd">Truck No</th>
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
   </div>
</div>
</div><!-- loading -->
<style>
/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #c2dbef;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #f2f7fb;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="//code.jquery.com/jquery.js"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript">

function openTab(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

document.getElementById("defaultOpen").click();

        $(document).ready( function () {
                var tbl = $('#Vehicle_Return_Approval').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('operation.manager.entry') }}",
                    type: 'GET',
                    data: function (d) {
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
                    
                    {data: 'gate_entry_no', name: 'gate_entry_no',render:function(data, type, row){
                          if(row.get_gate_entry.gate_entry_no){
                            return row.get_gate_entry.gate_entry_no;
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
                    {data: 'consignment_details_id', name: 'consignment_details_id',render:function(data, type, row){
                          if(row.get_consignment_details.container_no){
                            return row.get_consignment_details.container_no;
                        }else{
                            return '';
                        }
                        
                    }},
                  
                    {data: 'manifesto_entry_id', name: 'manifesto_entry_id',render:function(data, type, row){
                          if(row.get_manifesto_entry.get_cargo.cargo_name){
                            return row.get_manifesto_entry.get_cargo.cargo_name;
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


        var tbl2 = $('#ContainerStuffingApproval').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('stuffing.approval.list.dashboard') }}",
                    type: 'GET',
                    data: function (d) {
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
                    
                    {data: 'gate_entry_no', name: 'gate_entry_no',render:function(data, type, row){
                          if(row.get_gate_entry.gate_entry_no){
                            return row.get_gate_entry.gate_entry_no;
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
                    {data: 'consignment_details_id', name: 'consignment_details_id',render:function(data, type, row){
                          if(row.get_consignment_details.container_no){
                            return row.get_consignment_details.container_no;
                        }else{
                            return '';
                        }
                        
                    }},
                  
                    {data: 'manifesto_entry_id', name: 'manifesto_entry_id',render:function(data, type, row){
                          if(row.get_manifesto_entry.get_cargo.cargo_name){
                            return row.get_manifesto_entry.get_cargo.cargo_name;
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
            tbl2.rows().invalidate().draw(); 
    }, 30000 );
        $('#filter').on('click', function(e) {
            tbl2.draw();
            e.preventDefault();
            
        });

        var tbl3 = $('#ContainerOutApproval').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('approve.container.out.list.dashboard') }}",
                    type: 'GET',
                    data: function (d) {
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
                    {data: 'manifesto_entry_id', name: 'manifesto_entry_id',render:function(data, type, row){
                          if(row.get_manifesto_entry.get_cargo.cargo_name){
                            return row.get_manifesto_entry.get_cargo.cargo_name;
                        }else{
                            return '';
                        }
                        
                    }},
                    {data: 'manifesto_entry_id', name: 'manifesto_entry_id',render:function(data, type, row){
                          if(row.get_release_approval_finacial_officer_entry.cfs_release_no){
                            return row.get_release_approval_finacial_officer_entry.cfs_release_no;
                             }else{
                            return '';
                        }
                        
                    }},
                    {data: 'manifesto_entry_id', name: 'manifesto_entry_id',render:function(data, type, row){
                          if(row.get_release_approval_finacial_officer_entry.cfs_release_date){
                            return row.get_release_approval_finacial_officer_entry.cfs_release_date;
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
            tbl3.rows().invalidate().draw(); 
    }, 30000 );
        $('#filter').on('click', function(e) {
            tbl3.draw();
            e.preventDefault();
            
        });

        var tbl4 = $('#GateEntries').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('proceed.vehilce.list.dashboard') }}",
                    type: 'GET',
                    data: function (d) {
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
                    {data: 'gate_entry_no', name: 'gate_entry_no'},

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
                    {data: 'consignment_details_id', name: 'consignment_details_id',render:function(data, type, row){
                          if(row.get_consignment_details.container_no){
                            return row.get_consignment_details.container_no;
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
            tbl4.rows().invalidate().draw(); 
    }, 30000 );
        $('#filter').on('click', function(e) {
            tbl4.draw();
            e.preventDefault();
            
        });

       
        var tb5 = $('#Vehicle_Return_Approval').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('operation.manager.entry') }}",
                    type: 'GET',
                    data: function (d) {
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
                    
                    {data: 'gate_entry_no', name: 'gate_entry_no',render:function(data, type, row){
                          if(row.get_gate_entry.gate_entry_no){
                            return row.get_gate_entry.gate_entry_no;
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
                    {data: 'consignment_details_id', name: 'consignment_details_id',render:function(data, type, row){
                          if(row.get_consignment_details.container_no){
                            return row.get_consignment_details.container_no;
                        }else{
                            return '';
                        }
                        
                    }},
                  
                    {data: 'manifesto_entry_id', name: 'manifesto_entry_id',render:function(data, type, row){
                          if(row.get_manifesto_entry.get_cargo.cargo_name){
                            return row.get_manifesto_entry.get_cargo.cargo_name;
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
            tb5.rows().invalidate().draw(); 
    }, 30000 );
        $('#filter').on('click', function(e) {
            tb5.draw();
            e.preventDefault();
            
        });

        
    });


    </script>
 
@endsection