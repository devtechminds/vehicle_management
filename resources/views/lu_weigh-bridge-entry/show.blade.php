@extends('layouts.master',['header' => 'Loading & Unloading'])
@section('content')
<div class="page-header card">
   <div class="row align-items-end">
      <div class="col-lg-8">
         <div class="page-header-title">
            <i class="feather icon-clipboard bg-c-blue"></i>
            <div class="d-inline">
               <h3>VEHICLE SLIP FORM(LOADING)</h3>
            </div>
         </div>
      </div>
      <div class="col-lg-4">
         <div class="page-header-breadcrumb">
            <ul class=" breadcrumb breadcrumb-title">
               <li class="breadcrumb-item">
                  <a href="index.html"><i class="feather icon-home"></i></a>
               </li>
               <li class="breadcrumb-item"><a href="#!">Weigh Bridge</a></li>
               <li class="breadcrumb-item">
                  <a href="#!">Registered Vehicle</a>
               </li>
            </ul>
         </div>
      </div>
      <div class="col-lg-12">
      @if (count($errors) > 0)
      
         <div class="alert alert-danger">
            <ul>
               @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
               @endforeach
            </ul>
         </div>
      
      @endif

      @if (session('error'))
      <div class="alert alert-danger alert-dismissable custom-danger-box" style="margin: 15px;">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <strong> {{ session('error') }} </strong>
      </div>
      @endif
      @if (session('create'))
      <div class="alert alert-success alert-dismissable custom-success-box" style="margin: 15px;">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <strong> {{ session('create') }} </strong>
      </div>
      @endif
      </div>
   </div>
</div>
<div class="pcoded-inner-content">
<form action="{{route('loading.weigh.bridge.officer.submit')}}" id="myform" method="post">
   <div class="main-body">
      <div class="page-wrapper">
         <div class="page-body">
            <div class="row">
               <div class="col-sm-12">
               <div class="card">
                     <div class="card-block">
                        @csrf
                        <div class="form-group row">
                           <div class="col-sm-2">
                              <p class="bigf">Token No:</p>
                              <input type="text" name="ref_no" id="ref_no" class="form-control bld sdt" value="{{ $loadingGateEntry->ref_no}}" placeholder="" readonly>
                              <input type="hidden" name="loading_gate_entry_id" value="{{ $loadingGateEntry->id}}">
                              <input type="hidden" name="weigh_bridge_time_in" id="weigh_bridge_time_in" class="form-control" placeholder="" value="{{  date('h:i A', strtotime(now())) }}" readonly>
                           </div>
                           <div class="col-sm-8">
                           </div>
                           <div class="col-sm-2">
                              <p class="bigf">Date:</p>
                              <input type="text" name="date" id="date" class="form-control bld"  value="{{ $loadingGateEntry->date}}" placeholder="" readonly>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-2 col-form-label">Customer Name</label>
                           <div class="col-sm-4">
                              <select name="customer_name"  id="customer_name" class="form-control boxbrd" disabled>
                                 <option value="">{{ $loadingGateEntry->getCustomer->customer_name }} </option>
                              </select>
                           </div>
                           <label class="col-sm-2 col-form-label">Commodity</label>
                           <div class="col-sm-4">
                              <select name="commodity" id="commodity" class="form-control boxbrd" disabled>
                                 <option value="">{{ $loadingGateEntry->getCommodity->commodity_name }} </option>
                              </select>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-2 col-form-label">Truck No</label>
                           <div class="col-sm-4">
                              <input type="text" name="truck_no" id="truck_no" value="{{ $loadingGateEntry->truck_no}}" class="form-control" placeholder="" readonly>
                           </div>
                           <label class="col-sm-2 col-form-label">Quantity</label>
                              <div class="col-sm-4">
                                 <input type="text" name="quantity" id="quantity" value="{{ $loadingGateEntry->quantity}}" class="form-control" placeholder="" readonly>
                              </div>
                        </div>
                        <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Trailer No</label>
                           <div class="col-sm-4">
                              <input type="text" name="trailer_no" id="trailer_no" value="{{ $loadingGateEntry->trailer_no}}" class="form-control" placeholder="" readonly>
                           </div>
                           <label class="col-sm-2 col-form-label">Metric Ton</label>
                              <div class="col-sm-4">
                                 <input type="text" name="metric_ton" id="metric_ton" value="{{ round($loadingGateEntry->metric_ton,2) }}" class="form-control" placeholder="" readonly>
                              </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-2 col-form-label">Transporter</label>
                           <div class="col-sm-4">
                              <select name="transporter" id="transporter" class="form-control boxbrd" disabled>
                                 <option value="">{{ $loadingGateEntry->getTransporter->transport_name }} </option>
                              </select>
                           </div>
                           <label class="col-sm-2 col-form-label">Driver Name</label>
                           <div class="col-sm-4">
                              <input type="text" name="driver_name" id="driver_name" value="{{ $loadingGateEntry->driver_name}}" class="form-control" placeholder="" readonly>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-2 col-form-label">Driver Ph </label>
                           <div class="col-sm-4">
                              <input type="text" name="driver_ph_no" id="driver_ph_no" value="{{ $loadingGateEntry->driver_ph_no}}" class="form-control" placeholder="" readonly>
                           </div>
                           <label class="col-sm-2 col-form-label">Driver Lic</label>
                           <div class="col-sm-4">
                              <input type="text" name="driver_lic_no" id="driver_lic_no" value="{{ $loadingGateEntry->driver_lic_no}}" class="form-control" placeholder="" readonly>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-2 col-form-label">Time In </label>
                           <div class="col-sm-4">
                              <input type="text" name="time_in" id="time_in" class="form-control" placeholder="" value="{{ $loadingGateEntry->time_in}}" readonly>
                           </div>
                           <label class="col-sm-2 col-form-label">Destination (TO) </label>
                           <div class="col-sm-4">
                              <input type="text" name="destination" id="destination" value="{{ $loadingGateEntry->destination}}" class="form-control" placeholder="" readonly>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-2 col-form-label">Container No  </label>
                           <div class="col-sm-4">
                              <input type="text" name="container_no" id="container_no" value="{{ $loadingGateEntry->container_no}}" class="form-control" placeholder="" readonly>
                           </div>
                           <label class="col-sm-2 col-form-label">Bl No </label>
                           <div class="col-sm-4">
                              <input type="text" name="bl_no" id="bl_no" value="{{ $loadingGateEntry->bl_no}}" class="form-control" placeholder="" readonly>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-2 col-form-label">Do No  </label>
                           <div class="col-sm-4">
                              <input type="text" name="dn_no" id="dn_no" value="{{ $loadingGateEntry->dn_no}}" class="form-control" placeholder="" readonly>
                           </div>
                           <label class="col-sm-2 col-form-label">Bl Qty </label>
                           <div class="col-sm-4">
                              <input type="text" name="bl_qty" id="bl_qty" value="{{ $loadingGateEntry->bl_qty}}" class="form-control" placeholder="" readonly>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-2 col-form-label">DO Qty  </label>
                           <div class="col-sm-4">
                              <input type="text" name="dn_qty" id="dn_qty" value="{{ $loadingGateEntry->dn_qty}}" class="form-control" placeholder="" readonly>
                           </div>
                           <label class="col-sm-2 col-form-label">Shipping Line</label>
                           <div class="col-sm-4">
                              <input type="text" name="shipping_line" id="shipping_line" value="{{ $loadingGateEntry->shipping_line}}" class="form-control" placeholder="" readonly>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-2 col-form-label">Interchange No  </label>
                           <div class="col-sm-4">
                              <input type="text" name="interchange_no" id="interchange_no" value="{{ $loadingGateEntry->interchange_no}}" class="form-control" placeholder="" readonly>
                           </div>
                           <label class="col-sm-2 col-form-label">TRA Seal No </label>
                           <div class="col-sm-4">
                              <input type="text" name="tra_seal_no" id="tra_seal_no" value="{{ $loadingGateEntry->tra_seal_no}}" class="form-control" placeholder="" readonly>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="card">
                     <div class="card-block">
                           <div class="form-group row tblrw" style="border-bottom: 1px solid;
                              margin-bottom: 15px;">
                              <div class="col-sm-12">
                                 <h4>Weight Bridge Entry</h4>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">WB Ticket No </label>
                              <div class="col-sm-4">
                                 <input type="text" name="wb_ticket_no" id="wb_ticket_no" class="form-control" value="" placeholder="">
                              </div>
                              <label class="col-sm-2 col-form-label">WB Gross Wt </label>
                              <div class="col-sm-4">
                                 <input type="text" name="wb_gross_wt" id="wb_gross_wt" class="form-control" value="" placeholder="" readonly>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Container Tare Wt </label>
                              <div class="col-sm-4">
                                 <input type="text" name="container_tare_wt" id="container_tare_wt" class="form-control" value="" placeholder="" readonly>
                              </div>
                              <label class="col-sm-2 col-form-label">WB Tare Wt</label>
                              <div class="col-sm-4">
                                 <input type="text" name="wb_tare_wt" id="wb_tare_wt" class="form-control" value="" placeholder="">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">WB Net Wt </label>
                              <div class="col-sm-4">
                                 <input type="text" name="wb_net_wt" id="wb_net_wt" class="form-control" value="" placeholder="" readonly >
                              </div>
                           </div>
                     </div>
                  </div>

                  <div class="card">
                     <div class="card-block">
                        <div class="row" >
                           <div class="col-sm-12">
                              <div class="form-group row tblrw" style="border-bottom: 1px solid;
                                 padding-bottom: 8px;">
                                 <div class="col-sm-8">
                                    <h3 class="title">Commodity Details</h3>
                                 </div>
                                 <div class="card-right">	
                                    <button 
                                       onclick="if (!window.__cfRLUnblockHandlers) return false; javascript:toggleFullScreen()" class=" waves-effect waves-light btn waves-effect waves-dark btn-primary btn-outline-primary btn-icon" data-cf-modified-41c5a08083d3d25c74495efb-="">
                                    <i class="full-screen feather icon-maximize"></i>
                                    </button>	
                                    <!-- <span id="addMoreCommodity" class="btn waves-effect waves-dark btn-primary btn-outline-primary btn-icon"><i class="fa fa-plus" aria-hidden="true"></i></span> -->
                                 </div>
                              </div>
                              <div class="card-block">
                                 <div class="table-responsive">
                                    <table id="tableExample"  class="table tableExample m-b-0">
                                       <thead>
                                          <tr>
                                             <th>Material Name</th>
                                             <th>UOM</th>
                                             <th>Quantity</th>
                                             <th>Total Weight </th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          @foreach($loadingGateEntry->getLuCommodityDetail as $key=>$value)
                                          <tr class="line">
                                             <td class="material-data">
                                                <select disabled name="material[0]" id="material" class="form-control boxbrd required clone_input material_select">
                                                   <option value="">{{$value->getMaterial->material_name}}</option>
                                                </select>
                                             </td>
                                             <td >
                                                <select disabled name="uom[0]" id="uom" class="form-control boxbrd clone_input">
                                                   <option value="">{{ isset($value->getUOM->unit_entry_filed)?$value->getUOM->unit_entry_filed:''}}</option>
                                                </select>
                                             </td>
                                             <td><input type="text" name="commodity_quantity[0]" id="commodity_quantity" value="{{$value->commodity_quantity}}" class="form-control boxbrd required clone_input "  placeholder="" readonly></td>
                                             <td><input type="text" name="total_weight[0]" id="total_weight" value="{{round($value->total_weight,2)}}" class="form-control boxbrd clone_input"  placeholder="" readonly></td>
                                          </tr>
                                          @endforeach
                                       </tbody>
                                    </table>
                                    <input type="hidden" id="counter" value="1">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="card">
                     <div class="card-block height">
                        <div class="form-group row dwn" >
                           <div class="col-sm-12" style="text-align: center;">
                             @if(isset($loadingGateEntry->getLuWeightBridge->status))
                              <a class="btn btn-success waves-effect waves-light" href="{{route('loading.weigh.bridge.entry.index')}}">Back </a>
                              <a class="btn btn-success waves-effect waves-light" target="_blank" href="{{route('loading.proceed.form.gate.print',base64_encode($loadingGateEntry->id))}}">Print <i class="fa fa-print"></i></a>
                              @else
                              <button class="btn btn-warning waves-effect waves-light">Proceed</button>
                             @endif
                           </div>
                        </div>
                     </div>
                  </div>


               </div>
            </div>
         </div>
      </div>
   </div>
   </form>
</div>
<style>
 .error {
      color: red;
   }
   table tr td {
      width: auto;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/jquery.validate.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/additional-methods.js"></script>
@endsection