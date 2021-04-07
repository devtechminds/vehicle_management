<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
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
use Illuminate\Support\Facades\Auth;

class LuWeightBridgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('lu_weigh-bridge-entry.index');
    }

    public function loadingWeightBridgeList(Request $request){
        $loading_entry_data = LuGateEntrie::with('getCustomer','getCommodity','getLuWeightBridge');
       // echo '<pre>';
       // print_r($loading_entry_data);die;
        if($request->status)
        {
            if($request->status==1){
                $loading_entry_data->whereHas('getLuWeightBridge', function($q) use($request){
                    $q->where('status','=', $request->status);
                 });
            }
            if($request->status==2){
                $loading_entry_data->where('status','=',$request->status);
                $loading_entry_data->where('loading_date','=',null);
            }
            
        }else{
            $loading_entry_data->where('status','=',2);
            $loading_entry_data->where('loading_date','=',null);
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
                    $return_action = '<a href="' . route('loading.weigh.bridge.entry.show',base64_encode($loading_entry_data_list->id)) . '"  class="btn btn-info " title="View details">
                    Proceed</a>';
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
                 if($row->status==2 && $row->loading_date == null){
                    $status="Pending";
                }elseif($row->getLuWeightBridge->status==1 ){
                    $status="Approve";
                }
              return $status;

            })
            ->rawColumns(['customer_name','commodity_name','action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'wb_ticket_no' => 'required',
            'wb_tare_wt' => 'required',
        ]);

      if($validatedData){
        try {
            DB::beginTransaction();
            $data = $request->all();
            
            $loading_weigh_bridge = new LuWeightBridge();
            $loading_weigh_bridge->wb_ticket_no = $data['wb_ticket_no']?$data['wb_ticket_no']:NULL;
            $loading_weigh_bridge->wb_tare_wt = $data['wb_tare_wt']?$data['wb_tare_wt']:NULL;
            $loading_weigh_bridge->lu_gate_entry_id = $data['loading_gate_entry_id']?$data['loading_gate_entry_id']:'';
            $loading_weigh_bridge->time_in = $data['weigh_bridge_time_in']?$data['weigh_bridge_time_in']:'';
            $loading_weigh_bridge->status = 1;
            $loading_weigh_bridge->created_at = now();
            $loading_weigh_bridge->updated_at = now();
            $loading_weigh_bridge->created_by = auth()->user()->id;
            $loading_weigh_bridge->updated_by = auth()->user()->id;
            $loading_weigh_bridge->save();
            $update_data =array(
                'loading_date' => now(),
                'updated_at' => now(),
                'updated_by' => auth()->user()->id
                );
            LuGateEntrie::where("id", "=",$data['loading_gate_entry_id'])->update($update_data);
            
            $loading_gate_time = LuTimeTracking::where("lu_gate_entry_id", "=", $data['loading_gate_entry_id'])->where("new_status", "=", 2)->where("is_loading", "=", 1)->where("in_or_out", "=", 1)->first();
            $start_time = strtotime($loading_gate_time->created_at);
            $end_time   = strtotime(date('Y-m-d h:i A', strtotime(now())));
            $secs       = ($end_time-$start_time);
            $loading_time_track_entry = new LuTimeTracking();
            $loading_time_track_entry->lu_gate_entry_id = $data['loading_gate_entry_id'];
            $loading_time_track_entry->in_or_out = 1;
            $loading_time_track_entry->old_status = 2;
            $loading_time_track_entry->new_status = 3;
            $loading_time_track_entry->new_status_time = date('h:i A', strtotime(now()));
            $loading_time_track_entry->time_diff = $secs;
            $loading_time_track_entry->is_loading = 1;
            $loading_time_track_entry->updated_by = auth()->user()->id;
            $loading_time_track_entry->save();

            DB::commit();
            //Send Notification
            Notifications::sendNotification(auth()->user()->user_type,'weigh_bridge_officer','New Loading Weigh BridgeEntry Added','','/loading-gate-entry-return-list');
            UserLog::AddLog('New Loading Weigh BridgeEntry Added By');
            return redirect()->route('loading.weigh.bridge.entry.index')->with('create', 'Loading Weigh BridgeEntry Added successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            // return $e->getMessage();
            return redirect()->route('loading.weigh.bridge.entry.index')->with('error',$e->getMessage());
            
        }
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LuWeightBridge  $luWeightBridge
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loadingGateEntry = LuGateEntrie::with('getCustomer','getCommodity','getTransporter','getLuWeightBridge','getLuCommodityDetail','getLuCommodityDetail.getMaterial','getLuCommodityDetail.getUOM')
        ->where("id", "=", base64_decode($id))
        ->first();
        
         return view('lu_weigh-bridge-entry.show')->with('loadingGateEntry',$loadingGateEntry);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LuWeightBridge  $luWeightBridge
     * @return \Illuminate\Http\Response
     */
    public function edit(LuWeightBridge $luWeightBridge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LuWeightBridge  $luWeightBridge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LuWeightBridge $luWeightBridge)
    {
        //
    }

    public function proceedVehilcePrint($id)
    {
        $loadingGateEntry = LuGateEntrie::with('getCustomer','getCommodity','getTransporter','getLuWeightBridge','getLuCommodityDetail','getLuCommodityDetail.getMaterial','getLuCommodityDetail.getUOM')
        ->where("id", "=", base64_decode($id))
        ->first();
        if($loadingGateEntry)  {
         UserLog::AddLog('Gate1 Entry Officer Loading Vehicle In Print By');   
        // $consignment_details_count= ConsignmentDetails::getGateEntryNo($gate_entry->manifesto_entry_id);
        }
         // return view('proceed_vehilce.print_proceed_vehilce')->with('gate_entry',$gate_entry)->with('consignment_details_count',$consignment_details_count)->with('msg','Main Gate1 Entry Proceed ');
          return view('lu_gate_entry_proceed.print_proceed_vehilce_new')->with('loadingGateEntry',$loadingGateEntry)->with('msg','Main Gate1 Loading Entry Proceed ');
    }


    public function unloadingIndex()
    {
        return view('unloading_weigh-bridge-entry.index');
    }


    public function unloadingWeightBridgeList(Request $request){
        $unloading_entry_data = LuGateEntrie::with('getCustomer','getCommodity','getLuWeightBridge');
        if($request->status)
        {
            if($request->status==1){
                $unloading_entry_data->whereHas('getLuWeightBridge', function($q) use($request){
                    $q->where('status','=', $request->status);
                 });
            }
            if($request->status==2){
                $unloading_entry_data->where('status','=',$request->status);
                $unloading_entry_data->where('loading_date','=',null);
            }
            
        }else{
            $unloading_entry_data->where('status','=',2);
            $unloading_entry_data->where('loading_date','=',null);
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
                    $return_action = '<a href="' . route('unloading.weigh.bridge.entry.show',base64_encode($unloading_entry_data_list->id)) . '"  class="btn btn-info " title="View details">
                    Proceed</a>';
            
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
                 if($row->status==2 && $row->loading_date == null){
                    $status="Pending";
                }elseif($row->getLuWeightBridge->status==1 ){
                    $status="Approve";
                }
              return $status;

            })
            ->rawColumns(['customer_name','commodity_name','action'])
            ->make(true);
    }


    public function unloadingShow($id)
    {
        $unloadingGateEntry = LuGateEntrie::with('getCustomer','getCommodity','getTransporter','getLuWeightBridge','getLuCommodityDetail','getLuCommodityDetail.getMaterial','getLuCommodityDetail.getUOM')
        ->where("id", "=", base64_decode($id))
        ->first();
        
         return view('unloading_weigh-bridge-entry.show')->with('unloadingGateEntry',$unloadingGateEntry);
    }

    public function unloadingStore(Request $request)
    {
        $validatedData = $request->validate([
            'wb_ticket_no' => 'required',
            'wb_tare_wt' => 'required',
        ]);

      if($validatedData){
        try {
            DB::beginTransaction();
            $data = $request->all();
            $loading_weigh_bridge = new LuWeightBridge();
            $loading_weigh_bridge->wb_ticket_no = $data['wb_ticket_no']?$data['wb_ticket_no']:NULL;
            $loading_weigh_bridge->wb_tare_wt = $data['wb_tare_wt']?$data['wb_tare_wt']:NULL;
            $loading_weigh_bridge->lu_gate_entry_id = $data['loading_gate_entry_id']?$data['loading_gate_entry_id']:'';
            $loading_weigh_bridge->time_in = $data['weigh_bridge_time_in']?$data['weigh_bridge_time_in']:'';
            $loading_weigh_bridge->status = 1;
            $loading_weigh_bridge->created_at = now();
            $loading_weigh_bridge->updated_at = now();
            $loading_weigh_bridge->created_by = auth()->user()->id;
            $loading_weigh_bridge->updated_by = auth()->user()->id;
            $loading_weigh_bridge->save();
            $update_data =array(
                'loading_date' => now(),
                'updated_at' => now(),
                'updated_by' => auth()->user()->id
                );
            LuGateEntrie::where("id", "=",$data['loading_gate_entry_id'])->update($update_data);

            $loading_gate_time = LuTimeTracking::where("lu_gate_entry_id", "=", $data['loading_gate_entry_id'])->where("new_status", "=", 2)->where("is_loading", "=", 2)->where("in_or_out", "=", 1)->first();
            $start_time = strtotime($loading_gate_time->created_at);
            $end_time   = strtotime(date('Y-m-d h:i A', strtotime(now())));
            $secs       = ($end_time-$start_time);
            $loading_time_track_entry = new LuTimeTracking();
            $loading_time_track_entry->lu_gate_entry_id = $data['loading_gate_entry_id'];
            $loading_time_track_entry->in_or_out = 1;
            $loading_time_track_entry->old_status = 2;
            $loading_time_track_entry->new_status = 3;
            $loading_time_track_entry->new_status_time = date('h:i A', strtotime(now()));
            $loading_time_track_entry->time_diff = $secs;
            $loading_time_track_entry->is_loading = 2;
            $loading_time_track_entry->updated_by = auth()->user()->id;
            $loading_time_track_entry->save();

            DB::commit();
            //Send Notification
            Notifications::sendNotification(auth()->user()->user_type,'weigh_bridge_officer','New Unloading Weigh BridgeEntry Added','','/unloading-gate-entry-return-list');
            UserLog::AddLog('New Unloading Weigh BridgeEntry Added By');
            return redirect()->route('unloading.weigh.bridge.entry.index')->with('create', 'Unloading Weigh BridgeEntry Added successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            // return $e->getMessage();
            return redirect()->route('unloading.weigh.bridge.entry.index')->with('error',$e->getMessage());
            
        }
      }
    }

    public function unloadingProceedVehilcePrint($id)
    {
        $unloadingGateEntry = LuGateEntrie::with('getCustomer','getCommodity','getTransporter','getLuWeightBridge','getLuCommodityDetail','getLuCommodityDetail.getMaterial','getLuCommodityDetail.getUOM')
        ->where("id", "=", base64_decode($id))
        ->first();
        if($unloadingGateEntry)  {
         UserLog::AddLog('Gate1 Entry Officer Loading Vehicle In Print By');   
        // $consignment_details_count= ConsignmentDetails::getGateEntryNo($gate_entry->manifesto_entry_id);
        }
         // return view('proceed_vehilce.print_proceed_vehilce')->with('gate_entry',$gate_entry)->with('consignment_details_count',$consignment_details_count)->with('msg','Main Gate1 Entry Proceed ');
          return view('unloading_gate_entry_proceed.print_proceed_vehilce_new')->with('unloadingGateEntry',$unloadingGateEntry)->with('msg','Main Gate1 Loading Entry Proceed ');
    }


    public function returnIndex()
    {
        return view('lu_gate_entry_return.index');
    }

    public function loadingEntryReturnlList(Request $request){
        $loading_entry_data = LuGateEntrie::with('getCustomer','getCommodity','getLuWeightBridge');
        if($request->status)
        {
            if($request->status==1){
                $loading_entry_data->where('out_process_status','=',$request->status);
                $loading_entry_data->orWhere('out_process_status','=',2);
            }
            if($request->status==2){
                $loading_entry_data->where('status','=',$request->status);
                $loading_entry_data->whereHas('getLuWeightBridge', function($q) use($request){
                    $q->where('status','=', 1);
                 });
                 $loading_entry_data->where('out_process_status','=',0);
            }
            
        }else{
            $loading_entry_data->where('status','=',2);
            $loading_entry_data->whereHas('getLuWeightBridge', function($q) use($request){
                $q->where('status','=', 1);
             });
             $loading_entry_data->where('out_process_status','=',0);
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
                $return_action = '<a href="' . route('loading.gate.entry.return.edit',base64_encode($loading_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="Update details">
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
                 if($row->out_process_status==0){
                    $status="Pending";
                }elseif($row->out_process_status==1 || $row->out_process_status==2){
                    $status="Approve";
                }
              return $status;

            })
            ->rawColumns(['customer_name','commodity_name','action'])
            ->make(true);
    }

      public function returnEdit($id)
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
        
        return view('lu_gate_entry_return.update')->with('loadingGateEntry',$loadingGateEntry)
         ->with('customers',$customers)->with('locations',$locations)
         ->with('commoditys',$commoditys)->with('transports',$transports)
         ->with('materials',$materials)->with('uoms',$uoms);
    }

    public function returnUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'container_tare_wt' => 'required',
            'wb_gross_wt' => 'required',
            'loaded_by' => 'required',
            'quantity_loaded' => 'required',
            'quantity_short' => 'required',
            'kgs' => 'required',
            
        ]);
      if($validatedData){
        try {
            DB::beginTransaction();
            $data = $request->all();  
            
            $update_data =array(
                'out_process_status' => 1,
                'updated_at' => now(),
                'updated_by' => auth()->user()->id
                );
                $weigh_bridge_data =array(
                    'container_tare_wt' => isset($data['container_tare_wt'])?$data['container_tare_wt']:NULL,
                    'wb_gross_wt' => isset($data['wb_gross_wt'])?$data['wb_gross_wt']:NULL,
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

                $loading_gate_time = LuTimeTracking::where("lu_gate_entry_id", "=", $data['id'])->where("new_status", "=", 3)->where("is_loading", "=", 1)->where("in_or_out", "=", 1)->first();
                $start_time = strtotime($loading_gate_time->created_at);
                $end_time   = strtotime(date('Y-m-d h:i A', strtotime(now())));
                 $secs       = ($end_time-$start_time);
                 $loading_time_track_entry = new LuTimeTracking();
                 $loading_time_track_entry->lu_gate_entry_id = $data['id'];
                 $loading_time_track_entry->in_or_out = 2;
                 $loading_time_track_entry->old_status = 3;
                 $loading_time_track_entry->new_status = 1;
                 $loading_time_track_entry->new_status_time = date('h:i A', strtotime(now()));
                 $loading_time_track_entry->time_diff = $secs;
                 $loading_time_track_entry->is_loading = 1;
                 $loading_time_track_entry->updated_by = auth()->user()->id;
                 $loading_time_track_entry->save();
             
            DB::commit();
            //Send Notification
            Notifications::sendNotification(auth()->user()->user_type,'authorization_manager','New Loading Weigh BridgeEntry Updated','','/loading-weigh-bridge-return-update-list');
            UserLog::AddLog('New Loading Weigh BridgeEntry Updated By');
            return redirect()->route('loading.gate.entry.return.index')->with('create', 'Loading Weigh BridgeEntry Updated Successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            return redirect()->route('loading.gate.entry.return.index')->with('create',$e->getMessage());
            
        }
      } 

    }


    public function unloadingReturnIndex()
    {
        return view('unloading_gate_entry_return.index');
    }

    
    public function unloadingEntryReturnlList(Request $request){
        $unloading_entry_data = LuGateEntrie::with('getCustomer','getCommodity','getLuWeightBridge');
        if($request->status)
        {
            if($request->status==1){
                $unloading_entry_data->where('out_process_status','=',$request->status);
                $unloading_entry_data->orWhere('out_process_status','=',2);
            }
            if($request->status==2){
                $unloading_entry_data->where('status','=',$request->status);
                $unloading_entry_data->whereHas('getLuWeightBridge', function($q) use($request){
                    $q->where('status','=', 1);
                 });
                 $unloading_entry_data->where('out_process_status','=',0);
            }
            
        }else{
            $unloading_entry_data->where('status','=',2);
            $unloading_entry_data->whereHas('getLuWeightBridge', function($q) use($request){
                $q->where('status','=', 1);
             });
             $unloading_entry_data->where('out_process_status','=',0);
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
                $return_action = '<a href="' . route('unloading.gate.entry.return.edit',base64_encode($unloading_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="Update details">
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
                 if($row->out_process_status==0){
                    $status="Pending";
                }elseif($row->out_process_status==1 || $row->out_process_status==2){
                    $status="Approve";
                }
              return $status;

            })
            ->rawColumns(['customer_name','commodity_name','action'])
            ->make(true);
    }

    public function unloadingReturnEdit($id)
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
        return view('unloading_gate_entry_return.update')->with('unloadingGateEntry',$unloadingGateEntry)
         ->with('customers',$customers)->with('locations',$locations)
         ->with('commoditys',$commoditys)->with('transports',$transports)
         ->with('materials',$materials)->with('uoms',$uoms);
    }

    public function unloadingReturnUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'container_tare_wt' => 'required',
            'wb_gross_wt' => 'required',
            'loaded_by' => 'required',
            'quantity_loaded' => 'required',
            'quantity_short' => 'required',
            'kgs' => 'required',
            
        ]);
      if($validatedData){
        try {
            DB::beginTransaction();
            $data = $request->all();  
            
            $update_data =array(
                'out_process_status' => 1,
                'updated_at' => now(),
                'updated_by' => auth()->user()->id
                );
                $weigh_bridge_data =array(
                    'container_tare_wt' => isset($data['container_tare_wt'])?$data['container_tare_wt']:NULL,
                    'wb_gross_wt' => isset($data['wb_gross_wt'])?$data['wb_gross_wt']:NULL,
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

                $loading_gate_time = LuTimeTracking::where("lu_gate_entry_id", "=", $data['id'])->where("new_status", "=", 3)->where("is_loading", "=", 2)->where("in_or_out", "=", 1)->first();
                 $start_time = strtotime($loading_gate_time->created_at);
                 $end_time   = strtotime(date('Y-m-d h:i A', strtotime(now())));
                 $secs       = ($end_time-$start_time);
                 $loading_time_track_entry = new LuTimeTracking();
                 $loading_time_track_entry->lu_gate_entry_id = $data['id'];
                 $loading_time_track_entry->in_or_out = 2;
                 $loading_time_track_entry->old_status = 3;
                 $loading_time_track_entry->new_status = 1;
                 $loading_time_track_entry->new_status_time = date('h:i A', strtotime(now()));
                 $loading_time_track_entry->time_diff = $secs;
                 $loading_time_track_entry->is_loading = 2;
                 $loading_time_track_entry->updated_by = auth()->user()->id;
                 $loading_time_track_entry->save();
             
            DB::commit();
            //Send Notification
            Notifications::sendNotification(auth()->user()->user_type,'authorization_manager','New Unloading Weigh BridgeEntry Updated','','/unloading-weigh-bridge-return-update-list');
            UserLog::AddLog('New Unloading Weigh BridgeEntry Updated By');
            return redirect()->route('unloading.gate.entry.return.index')->with('create', 'Unloading Weigh BridgeEntry Updated Successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            return redirect()->route('unloading.gate.entry.return.index')->with('create',$e->getMessage());
            
        }
      } 

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LuWeightBridge  $luWeightBridge
     * @return \Illuminate\Http\Response
     */
    public function destroy(LuWeightBridge $luWeightBridge)
    {
        //
    }
}
