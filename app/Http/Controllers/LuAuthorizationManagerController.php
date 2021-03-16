<?php

namespace App\Http\Controllers;

use DB;
use App\LuGateEntrie;
use App\Material;
use App\UOM;
use App\Location;
use App\Commodity;
use App\Customers;
use App\Transports;
use App\UserLog;
use App\Notifications;
use App\LuCommodityDetail;
use App\LuWeightBridge;
use App\LuTimeTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LuAuthorizationManagerController extends Controller
{
    public function index()
    {
        return view('lu_gate_entry_approval.index');
    }

    public function loadingEntryApprovalList(Request $request){
        $loading_entry_data = LuGateEntrie::with('getCustomer','getCommodity');
        if($request->status)
        {
            $loading_entry_data->where('status','=',$request->status);
            
        }else{
            $loading_entry_data->where('status','=',2);
        }
        if($request->ref_no)
        {
            $loading_entry_data->where('ref_no','=',$request->ref_no);
        }
        if(isset($request->created_date))
        {
            $created_date = date('Y-m-d',strtotime($request->created_date));
            $loading_entry_data->whereDate('created_at',$created_date);
        }
        $loading_entry_data->where('is_loading','=',1);
        $loading_entry_data_list = $loading_entry_data->get();
        $user = Auth::user();
        $user_type = explode(',',$user->user_type);
        return datatables()->of($loading_entry_data_list)
            ->addColumn('action', function ($loading_entry_data_list) use($user_type) {
                    $return_action = '<a href="' . route('loading.gate.entry.approval.edit',base64_encode($loading_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="Update details">
                    <span class="svg-icon svg-icon-md svg-icon-primary">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Settings-1.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"></rect>
                    <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
                    <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
                    </g>
                    </svg>
                    <!--end::Svg Icon-->
                    </span>
                    </a>';
                
            
            return $return_action;
            })
            ->editColumn('customer_name', function($row){
                return  $row->getCustomer->customer_name;
            })
            ->editColumn('commodity_name', function($row){
                return  $row->getCommodity->commodity_name;
            })
            ->editColumn('status', function($row){
                 $status= '';
                 if($row->status==3){
                    $status="Pending";
                }elseif($row->status==4){
                    $status="Approve";
                }
              return $status;

            })
            ->rawColumns(['customer_name','commodity_name','action'])
            ->make(true);
    }

      public function edit($id)
    {
        $loadingGateEntry = LuGateEntrie::with('getCustomer','getCommodity','getTransporter','getLuWeightBridge')
        ->where("id", "=", base64_decode($id))
        ->first();
        // echo "<pre>";
        // print_r($manifestoEntry->getConsignmentDetails);die;
        $customers  = Customers::getAllCustomers();
        $commoditys  = Commodity::getCommodity();
        $transports = Transports::getTransports();
        $materials = Material::getAllMaterialData();
        $uoms = UOM::getAllUOM();
        
        return view('lu_gate_entry_approval.update')->with('loadingGateEntry',$loadingGateEntry)
         ->with('customers',$customers)
         ->with('commoditys',$commoditys)->with('transports',$transports)
         ->with('materials',$materials)->with('uoms',$uoms);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required',
            'commodity' => 'required',
            'truck_no' => 'required',
            'container_no' => 'required',
            'driver_name' => 'required',
            'transporter' => 'required',
            
        ]);
      if($validatedData){
        try {
            DB::beginTransaction();
            $data = $request->all();  
            
            $update_data =array(
                'ref_no' => $data['ref_no']?$data['ref_no']:'',
                'date' => $data['date']? date('Y-m-d',strtotime($data['date'])):'',
                'customer_name' => $data['customer_name']? $data['customer_name']:'',
                'commodity' => $data['commodity']? $data['commodity']:'',
                'truck_no' => $data['truck_no']? $data['truck_no']:'',
                'trailer_no' => $data['trailer_no']? $data['trailer_no']:'',
                'transporter' => $data['transporter']? $data['transporter']:'',
                'driver_name' => $data['driver_name']? $data['driver_name']:'',
                'driver_ph_no' => $data['driver_ph_no']? $data['driver_ph_no']:'',
                'driver_lic_no' => $data['driver_lic_no']? $data['driver_lic_no']:'',
                'time_in' => $data['time_in']? $data['time_in']:'',
                'destination' => $data['destination']? $data['destination']:'',
                'container_no' => $data['container_no']? $data['container_no']:'',
                'bl_no' => $data['bl_no']? $data['bl_no']:'',
                'dn_no' => $data['dn_no']? $data['dn_no']:'',
                'bl_qty' => $data['bl_qty']? $data['bl_qty']:'',
                'dn_qty' => $data['dn_qty']? $data['dn_qty']:'',
                'quantity' => isset($data['quantity'])?$data['quantity']:NULL,
                'metric_ton' => isset($data['metric_ton'])?$data['metric_ton']:NULL,
                'shipping_line' => $data['shipping_line']? $data['shipping_line']:'',
                'interchange_no' => $data['interchange_no']? $data['interchange_no']:'',
                'tra_seal_no' => $data['tra_seal_no']? $data['tra_seal_no']:'',
                'status' => 4,
                'updated_at' => now(),
                'updated_by' => auth()->user()->id
                );
                $weigh_bridge_data =array(
                    'wb_ticket_no' => isset($data['wb_ticket_no'])?$data['wb_ticket_no']:NULL,
                    'wb_tare_wt' => isset($data['wb_tare_wt'])?$data['wb_tare_wt']:NULL,
                    'status' => 2,
                    'updated_at' => now(),
                    'updated_by' => auth()->user()->id
                    );
                LuGateEntrie::where("id", "=",$data['id'])->update($update_data);
                LuWeightBridge::where("lu_gate_entry_id", "=",$data['id'])->update($weigh_bridge_data);
                LuCommodityDetail::where('lu_gate_entry_id',$data['id'])->delete();
                if(count($data['material'])>0){
                    foreach($data['material'] as $key=>$value){
                     $commodity_detail = new LuCommodityDetail();
                     $commodity_detail->lu_gate_entry_id= $data['id'];
                     $commodity_detail->material= $data['material'][$key];
                     $commodity_detail->uom= $data['uom'][$key];
                     $commodity_detail->commodity_quantity= isset($data['commodity_quantity'][$key])?$data['commodity_quantity'][$key]:NULL;
                     $commodity_detail->total_weight= isset($data['total_weight'][$key])?$data['total_weight'][$key]:NULL;
                     $commodity_detail->created_by= auth()->user()->id;
                     $commodity_detail->updated_by= auth()->user()->id;
                     $commodity_detail->save();
                    }
                 }

                 $loading_gate_time = LuTimeTracking::where("lu_gate_entry_id", "=", $data['id'])->where("new_status", "=", 3)->where("in_or_out", "=", 1)->first();
                 $start_time = strtotime($loading_gate_time->new_status_time);
                 $end_time   = strtotime(date('h:i A', strtotime(now())));
                 $secs       = ($end_time-$start_time);
                 $loading_time_track_entry = new LuTimeTracking();
                 $loading_time_track_entry->lu_gate_entry_id = $data['id'];
                 $loading_time_track_entry->in_or_out = 1;
                 $loading_time_track_entry->old_status = 3;
                 $loading_time_track_entry->new_status = 4;
                 $loading_time_track_entry->new_status_time = date('h:i A', strtotime(now()));
                 $loading_time_track_entry->time_diff = $secs;
                 $loading_time_track_entry->is_loading = 1;
                 $loading_time_track_entry->updated_by = auth()->user()->id;
                 $loading_time_track_entry->save();
             
            DB::commit();
            //Send Notification
            Notifications::sendNotification(auth()->user()->user_type,'gate1_entry_officer','New Loading Gate Entry Authorized','','/manifesto-list-finance-officer');
            UserLog::AddLog('New Loading Gate Entry Authorized By');
            return redirect()->route('loading.gate.entry.approval.index')->with('create', 'Loading Gate Entry Authorized Successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            return redirect()->route('loading.gate.entry.approval.index')->with('create',$e->getMessage());
            
        }
      } 

    }


    public function unloadingIndex()
    {
        return view('unloading_gate_entry_approval.index');
    }

    
    public function unloadingEntryApprovalList(Request $request){
        $unloading_entry_data = LuGateEntrie::with('getCustomer','getCommodity');
        if($request->status)
        {
            $serch_status= 1;
            if($request->status==2){
                $serch_status = 0;
            }
            $unloading_entry_data->where('status','=',$serch_status);
            if($request->status==3){
                $unloading_entry_data->where('status','=',$request->status);
                $unloading_entry_data->Orwhere('status','=',$request->status);
            }
        }
        if($request->ref_no)
        {
            $unloading_entry_data->where('ref_no','=',$request->ref_no);
        }
        if(isset($request->created_date))
        {
            $created_date = date('Y-m-d',strtotime($request->created_date));
            $unloading_entry_data->whereDate('created_at',$created_date);
        }
        $unloading_entry_data->where('is_loading','=',2);
        $unloading_entry_data_list = $unloading_entry_data->get();
        $user = Auth::user();
        $user_type = explode(',',$user->user_type);
        return datatables()->of($unloading_entry_data_list)
            ->addColumn('action', function ($unloading_entry_data_list) use($user_type) {
                    $return_action = '<a href="' . route('unloading.gate.entry.approval.edit',base64_encode($unloading_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="Update details">
                    <span class="svg-icon svg-icon-md svg-icon-primary">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Settings-1.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"></rect>
                    <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
                    <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
                    </g>
                    </svg>
                    <!--end::Svg Icon-->
                    </span>
                    </a>';
                
            
            return $return_action;
            })
            ->editColumn('customer_name', function($row){
                return  $row->getCustomer->customer_name;
            })
            ->editColumn('commodity_name', function($row){
                return  $row->getCommodity->commodity_name;
            })
            ->editColumn('status', function($row){
                 $status= '';
                 if($row->status==3){
                    $status="Pending";
                }elseif($row->status==4){
                    $status="Approve";
                }
              return $status;

            })
            ->rawColumns(['customer_name','commodity_name','action'])
            ->make(true);
    }

    public function unloadingEdit($id)
    {
        $unloadingGateEntry = LuGateEntrie::with('getCustomer','getCommodity','getTransporter','getLuCommodityDetail','getLuCommodityDetail.getMaterial','getLuCommodityDetail.getUOM','getLuWeightBridge')
        ->where("id", "=", base64_decode($id))
        ->first();
        // echo "<pre>";
        // print_r($manifestoEntry->getConsignmentDetails);die;
        $customers  = Customers::getAllCustomers();
        $commoditys  = Commodity::getCommodity();
        $transports = Transports::getTransports();
        $materials = Material::getAllMaterialData();
        $uoms = UOM::getAllUOM();
        return view('unloading_gate_entry_approval.update')->with('unloadingGateEntry',$unloadingGateEntry)
         ->with('customers',$customers)
         ->with('commoditys',$commoditys)->with('transports',$transports)
         ->with('materials',$materials)->with('uoms',$uoms);
    }

    public function unloadingUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required',
            'commodity' => 'required',
            'truck_no' => 'required',
            'container_no' => 'required',
            'driver_name' => 'required',
            'transporter' => 'required',
            
        ]);
      if($validatedData){
        try {
            DB::beginTransaction();
            $data = $request->all();  
            
            $update_data =array(
                'ref_no' => $data['ref_no']?$data['ref_no']:'',
                'date' => $data['date']? date('Y-m-d',strtotime($data['date'])):'',
                'customer_name' => $data['customer_name']? $data['customer_name']:'',
                'commodity' => $data['commodity']? $data['commodity']:'',
                'truck_no' => $data['truck_no']? $data['truck_no']:'',
                'trailer_no' => $data['trailer_no']? $data['trailer_no']:'',
                'transporter' => $data['transporter']? $data['transporter']:'',
                'driver_name' => $data['driver_name']? $data['driver_name']:'',
                'driver_ph_no' => $data['driver_ph_no']? $data['driver_ph_no']:'',
                'driver_lic_no' => $data['driver_lic_no']? $data['driver_lic_no']:'',
                'time_in' => $data['time_in']? $data['time_in']:'',
                'destination' => $data['destination']? $data['destination']:'',
                'container_no' => $data['container_no']? $data['container_no']:'',
                'bl_no' => $data['bl_no']? $data['bl_no']:'',
                'dn_no' => $data['dn_no']? $data['dn_no']:'',
                'bl_qty' => $data['bl_qty']? $data['bl_qty']:'',
                'dn_qty' => $data['dn_qty']? $data['dn_qty']:'',
                'quantity' => isset($data['quantity'])?$data['quantity']:NULL,
                'metric_ton' => isset($data['metric_ton'])?$data['metric_ton']:NULL,
                'shipping_line' => $data['shipping_line']? $data['shipping_line']:'',
                'interchange_no' => $data['interchange_no']? $data['interchange_no']:'',
                'tra_seal_no' => $data['tra_seal_no']? $data['tra_seal_no']:'',
                'status' => 4,
                'updated_at' => now(),
                'updated_by' => auth()->user()->id
                );
                $weigh_bridge_data =array(
                    'wb_ticket_no' => isset($data['wb_ticket_no'])?$data['wb_ticket_no']:NULL,
                    'wb_tare_wt' => isset($data['wb_tare_wt'])?$data['wb_tare_wt']:NULL,
                    'status' => 1,
                    'updated_at' => now(),
                    'updated_by' => auth()->user()->id
                    );
                LuGateEntrie::where("id", "=",$data['id'])->update($update_data);
                LuWeightBridge::where("lu_gate_entry_id", "=",$data['id'])->update($weigh_bridge_data);
                LuCommodityDetail::where('lu_gate_entry_id',$data['id'])->delete();
                if(count($data['material'])>0){
                    foreach($data['material'] as $key=>$value){
                     $commodity_detail = new LuCommodityDetail();
                     $commodity_detail->lu_gate_entry_id= $data['id'];
                     $commodity_detail->material= $data['material'][$key];
                     $commodity_detail->uom= $data['uom'][$key];
                     $commodity_detail->commodity_quantity= isset($data['commodity_quantity'][$key])?$data['commodity_quantity'][$key]:NULL;
                     $commodity_detail->total_weight= isset($data['total_weight'][$key])?$data['total_weight'][$key]:NULL;
                     $commodity_detail->created_by= auth()->user()->id;
                     $commodity_detail->updated_by= auth()->user()->id;
                     $commodity_detail->save();
                    }
                 }

                 $loading_gate_time = LuTimeTracking::where("lu_gate_entry_id", "=", $data['id'])->where("new_status", "=", 3)->where("in_or_out", "=", 1)->first();
                 $start_time = strtotime($loading_gate_time->new_status_time);
                 $end_time   = strtotime(date('h:i A', strtotime(now())));
                 $secs       = ($end_time-$start_time);
                 $loading_time_track_entry = new LuTimeTracking();
                 $loading_time_track_entry->lu_gate_entry_id = $data['id'];
                 $loading_time_track_entry->in_or_out = 1;
                 $loading_time_track_entry->old_status = 3;
                 $loading_time_track_entry->new_status = 4;
                 $loading_time_track_entry->new_status_time = date('h:i A', strtotime(now()));
                 $loading_time_track_entry->time_diff = $secs;
                 $loading_time_track_entry->is_loading = 2;
                 $loading_time_track_entry->updated_by = auth()->user()->id;
                 $loading_time_track_entry->save();
             
            DB::commit();
            //Send Notification
            Notifications::sendNotification(auth()->user()->user_type,'gate1_entry_officer','New Unloading Gate Entry Authorized','','/manifesto-list-finance-officer');
            UserLog::AddLog('New Unloading Gate Entry Authorized By');
            return redirect()->route('unloading.gate.entry.approval.index')->with('create', 'Unloading Gate Entry Authorized Successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            return redirect()->route('unloading.gate.entry.approval.index')->with('create',$e->getMessage());
            
        }
      } 

    }


    public function afterReturnUpdateIndex()
    {
        return view('lu_gate_entry_after_return_update.index');
    }

    public function loadingEntryAfterReturnUpdatelList(Request $request){
        $loading_entry_data = LuGateEntrie::with('getCustomer','getCommodity');
        if($request->status)
        {
                $loading_entry_data->where('status','=',4);
                $loading_entry_data->where('out_process_status','=',$request->status);

        }else{
            $loading_entry_data->where('status','=',4);
            $loading_entry_data->where('out_process_status','=',3);
        }
        if($request->ref_no)
        {
            $loading_entry_data->where('ref_no','=',$request->ref_no);
        }
        if(isset($request->created_date))
        {
            $created_date = date('Y-m-d',strtotime($request->created_date));
            $loading_entry_data->whereDate('created_at',$created_date);
        }
        $loading_entry_data->where('is_loading','=',1);
        $loading_entry_data_list = $loading_entry_data->get();
        $user = Auth::user();
        $user_type = explode(',',$user->user_type);
        return datatables()->of($loading_entry_data_list)
            ->addColumn('action', function ($loading_entry_data_list) use($user_type) {
                $return_action = '<a href="' . route('loading.weigh.bridge.return.update.edit',base64_encode($loading_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="Update details">
                <span class="svg-icon svg-icon-md svg-icon-primary">
                <!--begin::Svg Icon | path:assets/media/svg/icons/General/Settings-1.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24"></rect>
                <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
                <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
                </g>
                </svg>
                <!--end::Svg Icon-->
                </span>
                </a>';
                
            
            return $return_action;
            })
            ->editColumn('customer_name', function($row){
                return  $row->getCustomer->customer_name;
            })
            ->editColumn('commodity_name', function($row){
                return  $row->getCommodity->commodity_name;
            })
            ->editColumn('status', function($row){
                 $status= '';
                 if($row->out_process_status==3){
                    $status="Pending";
                }elseif($row->out_process_status==4){
                    $status="Approve";
                }
              return $status;

            })
            ->rawColumns(['customer_name','commodity_name','action'])
            ->make(true);
    }

      public function afterReturnUpdateEdit($id)
    {
        $loadingGateEntry = LuGateEntrie::with('getCustomer','getCommodity','getTransporter','getLuWeightBridge')
        ->where("id", "=", base64_decode($id))
        ->first();
        // echo "<pre>";
        // print_r($loadingGateEntry);die;
        $customers  = Customers::getAllCustomers();
        $commoditys  = Commodity::getCommodity();
        $transports = Transports::getTransports();
        $materials = Material::getAllMaterialData();
        $uoms = UOM::getAllUOM();
        $locations = Location::getAllLocation();
        $gate_pass_no = LuGateEntrie::getGatePassNo();
        
        return view('lu_gate_entry_after_return_update.update')->with('loadingGateEntry',$loadingGateEntry)
         ->with('customers',$customers)->with('locations',$locations)
         ->with('commoditys',$commoditys)->with('transports',$transports)
         ->with('materials',$materials)->with('uoms',$uoms)
         ->with('gate_pass_no',$gate_pass_no);
    }

    public function afterReturnUpdateSubmit(Request $request)
    {
        $validatedData = $request->validate([
            'container_tare_wt' => 'required',
            'wb_gross_wt' => 'required',
            'loaded_by' => 'required',
            'quantity_loaded' => 'required',
            'quantity_short' => 'required',
            'kgs' => 'required',
            'customer_name' => 'required',
            'commodity' => 'required',
            'truck_no' => 'required',
            'container_no' => 'required',
            'driver_name' => 'required',
            'transporter' => 'required',
            
        ]);
      if($validatedData){
        try {
            DB::beginTransaction();
            $data = $request->all();
            $update_data =array(
                'ref_no' => $data['ref_no']?$data['ref_no']:'',
                'date' => $data['date']? date('Y-m-d',strtotime($data['date'])):'',
                'customer_name' => $data['customer_name']? $data['customer_name']:'',
                'commodity' => $data['commodity']? $data['commodity']:'',
                'truck_no' => $data['truck_no']? $data['truck_no']:'',
                'trailer_no' => $data['trailer_no']? $data['trailer_no']:'',
                'transporter' => $data['transporter']? $data['transporter']:'',
                'driver_name' => $data['driver_name']? $data['driver_name']:'',
                'driver_ph_no' => $data['driver_ph_no']? $data['driver_ph_no']:'',
                'driver_lic_no' => $data['driver_lic_no']? $data['driver_lic_no']:'',
                'time_in' => $data['time_in']? $data['time_in']:'',
                'destination' => $data['destination']? $data['destination']:'',
                'container_no' => $data['container_no']? $data['container_no']:'',
                'bl_no' => $data['bl_no']? $data['bl_no']:'',
                'dn_no' => $data['dn_no']? $data['dn_no']:'',
                'bl_qty' => $data['bl_qty']? $data['bl_qty']:'',
                'dn_qty' => $data['dn_qty']? $data['dn_qty']:'',
                'quantity' => isset($data['quantity'])?$data['quantity']:NULL,
                'metric_ton' => isset($data['metric_ton'])?$data['metric_ton']:NULL,
                'shipping_line' => $data['shipping_line']? $data['shipping_line']:'',
                'interchange_no' => $data['interchange_no']? $data['interchange_no']:'',
                'tra_seal_no' => $data['tra_seal_no']? $data['tra_seal_no']:'',
                'gate_pass_no' => $data['gate_pass_no']? $data['gate_pass_no']:'',
                'time_out' => $data['time_out']? $data['time_out']:'',
                'authorized_by' => $data['authorized_by']? $data['authorized_by']:'',
                'out_process_status' => 4,
                'updated_at' => now(),
                'updated_by' => auth()->user()->id
                );
                $weigh_bridge_data =array(
                    'wb_ticket_no' => isset($data['wb_ticket_no'])?$data['wb_ticket_no']:NULL,
                    'wb_tare_wt' => isset($data['wb_tare_wt'])?$data['wb_tare_wt']:NULL,
                    'container_tare_wt' => isset($data['container_tare_wt'])?$data['container_tare_wt']:NULL,
                    'wb_gross_wt' => isset($data['wb_gross_wt'])?$data['wb_gross_wt']:NULL,
                    'wb_net_wt' => isset($data['wb_net_wt'])?$data['wb_net_wt']:NULL,
                    'loaded_by' => isset($data['loaded_by'])?$data['loaded_by']:NULL,
                    'name' => isset($data['name'])?$data['name']:NULL,
                    'quantity_loaded' => isset($data['quantity_loaded'])?$data['quantity_loaded']:NULL,
                    'quantity_short' => isset($data['quantity_short'])?$data['quantity_short']:NULL,
                    'kgs' => isset($data['kgs'])?$data['kgs']:NULL,
                    'location' => isset($data['location'])?$data['location']:NULL,
                    'updated_at' => now(),
                    'updated_by' => auth()->user()->id
                    );
                LuGateEntrie::where("id", "=",$data['id'])->update($update_data);
                LuWeightBridge::where("lu_gate_entry_id", "=",$data['id'])->update($weigh_bridge_data);
                LuCommodityDetail::where('lu_gate_entry_id',$data['id'])->delete();
                if(count($data['material'])>0){
                    foreach($data['material'] as $key=>$value){
                     $commodity_detail = new LuCommodityDetail();
                     $commodity_detail->lu_gate_entry_id= $data['id'];
                     $commodity_detail->material= $data['material'][$key];
                     $commodity_detail->uom= $data['uom'][$key];
                     $commodity_detail->commodity_quantity= isset($data['commodity_quantity'][$key])?$data['commodity_quantity'][$key]:NULL;
                     $commodity_detail->total_weight= isset($data['total_weight'][$key])?$data['total_weight'][$key]:NULL;
                     $commodity_detail->created_by= auth()->user()->id;
                     $commodity_detail->updated_by= auth()->user()->id;
                     $commodity_detail->save();
                    }
                 }

                 $loading_gate_time = LuTimeTracking::where("lu_gate_entry_id", "=", $data['id'])->where("new_status", "=", 3)->where("in_or_out", "=", 2)->first();
                 $start_time = strtotime($loading_gate_time->new_status_time);
                 $end_time   = strtotime(date('h:i A', strtotime(now())));
                 $secs       = ($end_time-$start_time);
                 $loading_time_track_entry = new LuTimeTracking();
                 $loading_time_track_entry->lu_gate_entry_id = $data['id'];
                 $loading_time_track_entry->in_or_out = 2;
                 $loading_time_track_entry->old_status = 3;
                 $loading_time_track_entry->new_status = 4;
                 $loading_time_track_entry->new_status_time = date('h:i A', strtotime(now()));
                 $loading_time_track_entry->time_diff = $secs;
                 $loading_time_track_entry->is_loading = 1;
                 $loading_time_track_entry->updated_by = auth()->user()->id;
                 $loading_time_track_entry->save();
             
            DB::commit();
            //Send Notification
            Notifications::sendNotification(auth()->user()->user_type,'authorization_manager','New Loading Weigh Bridge Entry Updates After Return Updated','','/manifesto-list-finance-officer');
            UserLog::AddLog('New Loading Weigh Bridge Entry Updates After Return Updated By');
            return redirect()->route('loading.weigh.bridge.return.update.index')->with('create', 'Loading Weigh Bridge Entry Updates After Return Updated Successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            return redirect()->route('loading.weigh.bridge.return.update.index')->with('create',$e->getMessage());
            
        }
      } 

    }

    public function afterReturnUpdatePrint($id)
    {
        $loadingGateEntry = LuGateEntrie::with('getCustomer','getCommodity','getTransporter','getLuWeightBridge','getLuCommodityDetail','getLuCommodityDetail.getMaterial','getLuCommodityDetail.getUOM')
        ->where("id", "=", base64_decode($id))
        ->first();
        if($loadingGateEntry)  {
         UserLog::AddLog('Gate1 Entry Officer Loading Vehicle In Print By');   
        // $consignment_details_count= ConsignmentDetails::getGateEntryNo($gate_entry->manifesto_entry_id);
        }
         // return view('proceed_vehilce.print_proceed_vehilce')->with('gate_entry',$gate_entry)->with('consignment_details_count',$consignment_details_count)->with('msg','Main Gate1 Entry Proceed ');
          return view('lu_gate_entry_after_return_update.print_proceed_vehilce_new')->with('loadingGateEntry',$loadingGateEntry)->with('msg','Main Gate1 Loading Entry Proceed ');
    }


    public function unloadingAfterReturnUpdateIndex()
    {
        return view('unloading_gate_entry_after_return_update.index');
    }

    
    public function unloadingEntryAfterReturnUpdatelList(Request $request){
        $unloading_entry_data = LuGateEntrie::with('getCustomer','getCommodity');
        if($request->status)
        {
                $unloading_entry_data->where('status','=',4);
                $unloading_entry_data->where('out_process_status','=',$request->status);

        }else{
            $unloading_entry_data->where('status','=',4);
            $unloading_entry_data->where('out_process_status','=',3);
        }
        if($request->ref_no)
        {
            $unloading_entry_data->where('ref_no','=',$request->ref_no);
        }
        if(isset($request->created_date))
        {
            $created_date = date('Y-m-d',strtotime($request->created_date));
            $unloading_entry_data->whereDate('created_at',$created_date);
        }
        $unloading_entry_data->where('is_loading','=',2);
        $unloading_entry_data_list = $unloading_entry_data->get();
        $user = Auth::user();
        $user_type = explode(',',$user->user_type);
        return datatables()->of($unloading_entry_data_list)
            ->addColumn('action', function ($unloading_entry_data_list) use($user_type) {
                $return_action = '<a href="' . route('unloading.weigh.bridge.return.update.edit',base64_encode($unloading_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="Update details">
                <span class="svg-icon svg-icon-md svg-icon-primary">
                <!--begin::Svg Icon | path:assets/media/svg/icons/General/Settings-1.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24"></rect>
                <path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000"></path>
                <path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3"></path>
                </g>
                </svg>
                <!--end::Svg Icon-->
                </span>
                </a>';
                
            
            return $return_action;
            })
            ->editColumn('customer_name', function($row){
                return  $row->getCustomer->customer_name;
            })
            ->editColumn('commodity_name', function($row){
                return  $row->getCommodity->commodity_name;
            })
            ->editColumn('status', function($row){
                 $status= '';
                 if($row->out_process_status==3){
                    $status="Pending";
                }elseif($row->out_process_status==4){
                    $status="Approve";
                }
              return $status;

            })
            ->rawColumns(['customer_name','commodity_name','action'])
            ->make(true);
    }

    public function unloadingAfterReturnUpdateEdit($id)
    {
        $unloadingGateEntry = LuGateEntrie::with('getCustomer','getCommodity','getTransporter','getLuCommodityDetail','getLuCommodityDetail.getMaterial','getLuCommodityDetail.getUOM','getLuWeightBridge')
        ->where("id", "=", base64_decode($id))
        ->first();
        // echo "<pre>";
        // print_r($manifestoEntry->getConsignmentDetails);die;
        $customers  = Customers::getAllCustomers();
        $commoditys  = Commodity::getCommodity();
        $transports = Transports::getTransports();
        $materials = Material::getAllMaterialData();
        $uoms = UOM::getAllUOM();
        $locations = Location::getAllLocation();
        $gate_pass_no = LuGateEntrie::getGatePassNo();
        return view('unloading_gate_entry_after_return_update.update')->with('unloadingGateEntry',$unloadingGateEntry)
         ->with('customers',$customers)->with('locations',$locations)
         ->with('commoditys',$commoditys)->with('transports',$transports)
         ->with('materials',$materials)->with('uoms',$uoms)
         ->with('gate_pass_no',$gate_pass_no);
    }

    public function unloadingAfterReturnUpdateSubmit(Request $request)
    {
        $validatedData = $request->validate([
            'container_tare_wt' => 'required',
            'wb_gross_wt' => 'required',
            'loaded_by' => 'required',
            'quantity_loaded' => 'required',
            'quantity_short' => 'required',
            'kgs' => 'required',
            'customer_name' => 'required',
            'commodity' => 'required',
            'truck_no' => 'required',
            'container_no' => 'required',
            'driver_name' => 'required',
            'transporter' => 'required',
            
        ]);
      if($validatedData){
        try {
            DB::beginTransaction();
            $data = $request->all();  
            
            $update_data =array(
                'ref_no' => $data['ref_no']?$data['ref_no']:'',
                'date' => $data['date']? date('Y-m-d',strtotime($data['date'])):'',
                'customer_name' => $data['customer_name']? $data['customer_name']:'',
                'commodity' => $data['commodity']? $data['commodity']:'',
                'truck_no' => $data['truck_no']? $data['truck_no']:'',
                'trailer_no' => $data['trailer_no']? $data['trailer_no']:'',
                'transporter' => $data['transporter']? $data['transporter']:'',
                'driver_name' => $data['driver_name']? $data['driver_name']:'',
                'driver_ph_no' => $data['driver_ph_no']? $data['driver_ph_no']:'',
                'driver_lic_no' => $data['driver_lic_no']? $data['driver_lic_no']:'',
                'time_in' => $data['time_in']? $data['time_in']:'',
                'destination' => $data['destination']? $data['destination']:'',
                'container_no' => $data['container_no']? $data['container_no']:'',
                'bl_no' => $data['bl_no']? $data['bl_no']:'',
                'dn_no' => $data['dn_no']? $data['dn_no']:'',
                'bl_qty' => $data['bl_qty']? $data['bl_qty']:'',
                'dn_qty' => $data['dn_qty']? $data['dn_qty']:'',
                'quantity' => isset($data['quantity'])?$data['quantity']:NULL,
                'metric_ton' => isset($data['metric_ton'])?$data['metric_ton']:NULL,
                'shipping_line' => $data['shipping_line']? $data['shipping_line']:'',
                'interchange_no' => $data['interchange_no']? $data['interchange_no']:'',
                'tra_seal_no' => $data['tra_seal_no']? $data['tra_seal_no']:'',
                'gate_pass_no' => $data['gate_pass_no']? $data['gate_pass_no']:'',
                'time_out' => $data['time_out']? $data['time_out']:'',
                'authorized_by' => $data['authorized_by']? $data['authorized_by']:'',
                'out_process_status' => 4,
                'updated_at' => now(),
                'updated_by' => auth()->user()->id
                );
                $weigh_bridge_data =array(
                    'wb_ticket_no' => isset($data['wb_ticket_no'])?$data['wb_ticket_no']:NULL,
                    'wb_tare_wt' => isset($data['wb_tare_wt'])?$data['wb_tare_wt']:NULL,
                    'container_tare_wt' => isset($data['container_tare_wt'])?$data['container_tare_wt']:NULL,
                    'wb_gross_wt' => isset($data['wb_gross_wt'])?$data['wb_gross_wt']:NULL,
                    'wb_net_wt' => isset($data['wb_net_wt'])?$data['wb_net_wt']:NULL,
                    'loaded_by' => isset($data['loaded_by'])?$data['loaded_by']:NULL,
                    'name' => isset($data['name'])?$data['name']:NULL,
                    'quantity_loaded' => isset($data['quantity_loaded'])?$data['quantity_loaded']:NULL,
                    'quantity_short' => isset($data['quantity_short'])?$data['quantity_short']:NULL,
                    'kgs' => isset($data['kgs'])?$data['kgs']:NULL,
                    'location' => isset($data['location'])?$data['location']:NULL,
                    'updated_at' => now(),
                    'updated_by' => auth()->user()->id
                    );
                LuGateEntrie::where("id", "=",$data['id'])->update($update_data);
                LuWeightBridge::where("lu_gate_entry_id", "=",$data['id'])->update($weigh_bridge_data);
                LuCommodityDetail::where('lu_gate_entry_id',$data['id'])->delete();
                if(count($data['material'])>0){
                    foreach($data['material'] as $key=>$value){
                     $commodity_detail = new LuCommodityDetail();
                     $commodity_detail->lu_gate_entry_id= $data['id'];
                     $commodity_detail->material= $data['material'][$key];
                     $commodity_detail->uom= $data['uom'][$key];
                     $commodity_detail->commodity_quantity= isset($data['commodity_quantity'][$key])?$data['commodity_quantity'][$key]:NULL;
                     $commodity_detail->total_weight= isset($data['total_weight'][$key])?$data['total_weight'][$key]:NULL;
                     $commodity_detail->created_by= auth()->user()->id;
                     $commodity_detail->updated_by= auth()->user()->id;
                     $commodity_detail->save();
                    }
                 }
                 
                 $loading_gate_time = LuTimeTracking::where("lu_gate_entry_id", "=", $data['id'])->where("new_status", "=", 3)->where("in_or_out", "=", 2)->first();
                 $start_time = strtotime($loading_gate_time->new_status_time);
                 $end_time   = strtotime(date('h:i A', strtotime(now())));
                 $secs       = ($end_time-$start_time);
                 $loading_time_track_entry = new LuTimeTracking();
                 $loading_time_track_entry->lu_gate_entry_id = $data['id'];
                 $loading_time_track_entry->in_or_out = 2;
                 $loading_time_track_entry->old_status = 3;
                 $loading_time_track_entry->new_status = 4;
                 $loading_time_track_entry->new_status_time = date('h:i A', strtotime(now()));
                 $loading_time_track_entry->time_diff = $secs;
                 $loading_time_track_entry->is_loading = 2;
                 $loading_time_track_entry->updated_by = auth()->user()->id;
                 $loading_time_track_entry->save();
             
            DB::commit();
            //Send Notification
            Notifications::sendNotification(auth()->user()->user_type,'authorization_manager','New Unloading Weigh Bridge Entry Updates After Return Updated','','/manifesto-list-finance-officer');
            UserLog::AddLog('New Unloading Weigh Bridge Entry Updates After Return Updated By');
            return redirect()->route('unloading.gate.entry.return.update.index')->with('create', 'Unloading Weigh Bridge Entry Updates After Return Updated Successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            return redirect()->route('unloading.gate.entry.return.update.index')->with('create',$e->getMessage());
            
        }
      } 

    }


    public function unloadingAfterReturnUpdatePrint($id)
    {
        $unloadingGateEntry = LuGateEntrie::with('getCustomer','getCommodity','getTransporter','getLuWeightBridge','getLuCommodityDetail','getLuCommodityDetail.getMaterial','getLuCommodityDetail.getUOM')
        ->where("id", "=", base64_decode($id))
        ->first();
        if($unloadingGateEntry)  {
         UserLog::AddLog('Gate1 Entry Officer Loading Vehicle In Print By');   
        // $consignment_details_count= ConsignmentDetails::getGateEntryNo($gate_entry->manifesto_entry_id);
        }
         // return view('proceed_vehilce.print_proceed_vehilce')->with('gate_entry',$gate_entry)->with('consignment_details_count',$consignment_details_count)->with('msg','Main Gate1 Entry Proceed ');
          return view('unloading_gate_entry_after_return_update.print_proceed_vehilce_new')->with('unloadingGateEntry',$unloadingGateEntry)->with('msg','Main Gate1 Loading Entry Proceed ');
    }


}
