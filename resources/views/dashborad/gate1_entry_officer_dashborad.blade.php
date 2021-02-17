@extends('layouts.master')
@section('content')
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
                              <h6 class="m-b-5 text-white"> Today Total Vehicle In Registered</h6>
                              <h3 class="m-b-0 f-w-700 text-white">{{ $gate_entry['total']}}</h3>
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
                              <h6 class="m-b-5 text-white"> Today Total Proceed Vehicle</h6>
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
                              <h6 class="m-b-5 text-white"> Today Total Container Out Registered</h6>
                              <h3 class="m-b-0 f-w-700 text-white">{{ $gate_entry['container_out_registered']}}</h3>
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
                              <h6 class="m-b-5 text-white">Today Total CFS OUT</h6>
                              <h3 class="m-b-0 f-w-700 text-white"> {{ $gate_entry['total_cfs_out']}}</h3>
                           </div>
                           <div class="col-auto">
                              <i class="fas fa-tags text-c-yellow f-18"></i>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="card table-card">
                     <div class="card-header">
                        <h5>Total Vehicle In Registered</h5>
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
                           <table class="table table-hover m-b-0" id="Total_Vehicle_In_Registered">
                              <thead>
                                 <tr>
                                    <th class="hd">Id </th>
                                    <th class="hd">Ref No</th>
                                    <th class="hd">Total</th>
                                    <th class="hd">Remaining</th>
                                    <th class="hd">Type of Consignment</th>
                                    <th class="hd">Type of Cargo</th>
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
               <div class="col-md-6">
                  <div class="card table-card">
                     <div class="card-header">
                        <h5>Pending Proceed Vehicle</h5>
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
                           <table class="table table-hover m-b-0" id="procced_vehicle">
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
               
               <div class="col-md-6">
                  <div class="card table-card">
                     <div class="card-header">
                        <h5>Container Out Registered</h5>
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
                           <table class="table table-hover m-b-0" id="container_out_registered">
                              <thead>
                                <tr>
                                <th class="hd">Id </th>
                                <th class="hd"> Ref No</th>
                                <th class="hd"> CFS Release No</th> 
                                <th class="hd">CF Agent</th>
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
                        <h5>CSF Out </h5>
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
                           <table class="table table-hover m-b-0" id="cfs_out">
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
   </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="//code.jquery.com/jquery.js"></script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
        $(document).ready( function () {
            var tbl = $('#Total_Vehicle_In_Registered').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('vehilce.in.register.list.dashborad') }}",
                    type: 'GET',
                    data: function (d) {
                        d.status = $('#status').val();
                        d.ref_no = $('#ref_no').val();
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
                    {data: 'ref_no', name: 'ref_no'},
                    {data: 'consignment_count', name: 'consignment_count'},
                    {data: 'pending_consignment_count', name: 'pending_consignment_count'},
                    {data: 'consignment_type', name: 'consignment_type',render:function(data, type, row){
                          if(row.get_consignment.consignment_type){
                            return row.get_consignment.consignment_type;
                        }else{
                            return '';
                        }
                        
                    }},
                   
                    {data: 'cargo_type', name: 'cargo_type'},
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

        setInterval(function() {
            tbl.rows().invalidate().draw(); 
    }, 30000);
        $('#filter').on('click', function(e) {
            tbl.draw();
            e.preventDefault();
            
        });


        var tbl1 = $('#procced_vehicle').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('proceed.vehilce.list') }}",
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
            tbl1.rows().invalidate().draw(); 
    }, 30000 );
        $('#filter').on('click', function(e) {
            tbl1.draw();
            e.preventDefault();
            
        });

        var tbl2 = $('#container_out_registered').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('container.out.register.list') }}",
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
                          if(row.get_manifesto_entry.ref_no){
                            return row.get_manifesto_entry.ref_no;
                        }else{
                            return '';
                        }
                        
                    }},
                    {data: 'cfs_release_no', name: 'cfs_release_no',render:function(data, type, row){
                          if(row.cfs_release_no){
                            return row.cfs_release_no;
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
        
   

        var tbl3 = $('#cfs_out').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('cfs.out.proceed.list.dashboard') }}",
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
      




       
        
    });


    </script>
 
@endsection