<?php

namespace App\Http\Controllers;

use DB;
use App\LuGateEntrie;
use App\Material;
use App\UOM;
use App\Commodity;
use App\Customers;
use App\Transports;
use App\UserLog;
use App\Notifications;
use App\LuCommodityDetail;
use App\LuTimeTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LuGateEntrieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('lu_gate_entry.index');
    }

    public function loadingList(Request $request){      

        $loading_entry_data = LuGateEntrie::with('getCustomer','getCommodity');
        if($request->status)
        {
            $loading_entry_data->where('status','=',$request->status);
            
        }else{
            $loading_entry_data->where('status','=',1);
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
                $return_action = '<a href="' . route('loading.entry.show',base64_encode($loading_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
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
                if($loading_entry_data_list->status==0 ||  in_array("admin", $user_type)){
                    $return_action .= '<a href="' . route('loading.entry.edit',base64_encode($loading_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="Update details">
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
                }
            
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
                 if($row->status==1){
                    $status="Pending";
                }elseif($row->status==2){
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
        $customers    = Customers::getAllCustomers();
        $commoditys   = Commodity::getCommodity();
        $transports   = Transports::getTransports();
        $materials    = Material::getAllMaterial();
        $uoms         = UOM::getAllUOM();
        $ref_no       = LuGateEntrie::getRefNo();
        return view('lu_gate_entry.create')->with('customers',$customers)
        ->with('commoditys',$commoditys)->with('transports',$transports)
        ->with('materials',$materials)->with('uoms',$uoms)
        ->with('ref_no',$ref_no);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //   echo "<pre>";
        //   print_r($request->all());die;  
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
            $data['ref_no'] = LuGateEntrie::getRefNo();

            $loading_gate_entry = new LuGateEntrie();
            $loading_gate_entry->ref_no = $data['ref_no']?$data['ref_no']:'';
            $loading_gate_entry->date = $data['date']? date('Y-m-d',strtotime($data['date'])):'';
            $loading_gate_entry->customer_name = $data['customer_name']? $data['customer_name']:'';
            $loading_gate_entry->commodity   = $data['commodity']? $data['commodity']:'';
            $loading_gate_entry->truck_no    = $data['truck_no']?$data['truck_no']:'';
            $loading_gate_entry->trailer_no  = $data['trailer_no']?$data['trailer_no']:'';
            $loading_gate_entry->transporter = $data['transporter']?$data['transporter']:'';
            $loading_gate_entry->driver_name = $data['driver_name']?$data['driver_name']:'';
            $loading_gate_entry->driver_ph_no = $data['driver_ph_no']?$data['driver_ph_no']:'';
            $loading_gate_entry->driver_lic_no = $data['driver_lic_no']?$data['driver_lic_no']:'';
            $loading_gate_entry->time_in = $data['time_in']?$data['time_in']:'';
            $loading_gate_entry->destination = $data['destination']?$data['destination']:'';
            $loading_gate_entry->container_no = $data['container_no']?$data['container_no']:'';
            $loading_gate_entry->bl_no = $data['bl_no']?$data['bl_no']:'';
            $loading_gate_entry->dn_no = $data['dn_no']?$data['dn_no']:'';
            $loading_gate_entry->bl_qty = $data['bl_qty']?$data['bl_qty']:'';
            $loading_gate_entry->dn_qty = $data['dn_qty']?$data['dn_qty']:'';
            $loading_gate_entry->quantity = isset($data['quantity'])?$data['quantity']:NULL;
            $loading_gate_entry->metric_ton = isset($data['metric_ton'])?$data['metric_ton']:NULL;
            $loading_gate_entry->shipping_line = $data['shipping_line']?$data['shipping_line']:'';
            $loading_gate_entry->interchange_no = $data['interchange_no']?$data['interchange_no']:'';
            $loading_gate_entry->tra_seal_no = $data['tra_seal_no']?$data['tra_seal_no']:'';
            $loading_gate_entry->is_loading = 1;
            $loading_gate_entry->created_at  = now();
            $loading_gate_entry->created_by  = auth()->user()->id;
            $loading_gate_entry->updated_by  = auth()->user()->id;
            $loading_gate_entry->save();

            if(count($data['material'])>0){
                foreach($data['material'] as $key=>$value){
                 $commodity_detail = new LuCommodityDetail();
                 $commodity_detail->lu_gate_entry_id= $loading_gate_entry->id;
                 $commodity_detail->material= $data['material'][$key];
                 $commodity_detail->uom= $data['uom'][$key];
                 $commodity_detail->commodity_quantity= isset($data['commodity_quantity'][$key])?$data['commodity_quantity'][$key]:NULL;
                 $commodity_detail->total_weight= isset($data['total_weight'][$key])?$data['total_weight'][$key]:NULL;
                 $commodity_detail->created_by= auth()->user()->id;
                 $commodity_detail->updated_by= auth()->user()->id;
                 $commodity_detail->save();
                }
             }

            $loading_time_track_entry = new LuTimeTracking();
            $loading_time_track_entry->lu_gate_entry_id = $loading_gate_entry->id;
            $loading_time_track_entry->in_or_out = 1;
            $loading_time_track_entry->old_status = NULL;
            $loading_time_track_entry->new_status = 1;
            $loading_time_track_entry->new_status_time = date('h:i A', strtotime(now()));
            $loading_time_track_entry->time_diff = 0;
            $loading_time_track_entry->is_loading = 1;
            $loading_time_track_entry->updated_by = auth()->user()->id;
            $loading_time_track_entry->save();
            
           
            DB::commit();
            //Send Notification
            Notifications::sendNotification(auth()->user()->user_type,'authorization_manager','New Loading Truck Parking Note Added','','/loading-gate-entry-approval-list');
            UserLog::AddLog('New Loading Truck Parking Note Added By');
            //return redirect()->route('loading.entry.index')->with('create', 'Loading Truck Parking Note Added successfully!');
            $loadingGateEntry = LuGateEntrie::with('getCustomer','getCommodity','getTransporter','getLuWeightBridge','getLuCommodityDetail','getLuCommodityDetail.getMaterial','getLuCommodityDetail.getUOM')
            ->where("id", "=", $loading_gate_entry->id)
            ->first();
            //return view('lu_gate_entry_proceed.print_proceed_vehilce_new')->with('loadingGateEntry',$loadingGateEntry)->with('msg','Loading Truck Parking Note Added successfully! ');
            return view('lu_gate_entry.print_truck_parking_note')->with('loadingGateEntry',$loadingGateEntry)->with('msg','Loading Truck Parking Note Added successfully! ');
        } catch (\Exception $e) {
            DB::rollBack();
            // return $e->getMessage();
            return redirect()->route('loading.entry.create')->with('error',$e->getMessage());
            
        }
      }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LuGateEntrie  $luGateEntrie
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loadingGateEntry = LuGateEntrie::with('getCustomer','getCommodity','getTransporter','getLuCommodityDetail','getLuCommodityDetail.getMaterial','getLuCommodityDetail.getUOM')
        ->where("id", "=", base64_decode($id))
        ->first();
        
         return view('lu_gate_entry.show')->with('loadingGateEntry',$loadingGateEntry);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LuGateEntrie  $luGateEntrie
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $loadingGateEntry = LuGateEntrie::with('getCustomer','getCommodity','getTransporter','getLuCommodityDetail','getLuCommodityDetail.getMaterial','getLuCommodityDetail.getUOM')
        ->where("id", "=", base64_decode($id))
        ->first();
        // echo "<pre>";
        // print_r($manifestoEntry->getConsignmentDetails);die;
        $customers  = Customers::getAllCustomers();
        $commoditys  = Commodity::getCommodity();
        $transports = Transports::getTransports();
        $materials = Material::select('id','material_name','unit_weight')
                                ->where('status','=','1')
                                ->where('commodity_id', '=', (int)$loadingGateEntry->commodity)
                                ->get()->toArray();
        $uoms = UOM::getAllUOM();
        
        return view('lu_gate_entry.update')->with('loadingGateEntry',$loadingGateEntry)
         ->with('customers',$customers)
         ->with('commoditys',$commoditys)->with('transports',$transports)
         ->with('materials',$materials)->with('uoms',$uoms);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LuGateEntrie  $luGateEntrie
     * @return \Illuminate\Http\Response
     */
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
                'status' => 1,
                'updated_at' => now(),
                'updated_by' => auth()->user()->id
                );
                LuGateEntrie::where("id", "=",$data['id'])->update($update_data);
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
             
            DB::commit();
            //Send Notification
            Notifications::sendNotification(auth()->user()->user_type,'authorization_manager','New Loading Truck Parking Note Updated','','/loading-gate-entry-approval-list');
            UserLog::AddLog('New Loading Truck Parking Note Updated By');
            return redirect()->route('loading.entry.index')->with('create', 'Loading Truck Parking Note Updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            return redirect()->route('loading.entry.create')->with('create',$e->getMessage());
            
        }
      } 

    }


    public function gateEntryPrint($id)
    {
        $loadingGateEntry = LuGateEntrie::with('getCustomer','getCommodity','getTransporter','getLuWeightBridge','getLuCommodityDetail','getLuCommodityDetail.getMaterial','getLuCommodityDetail.getUOM')
        ->where("id", "=", base64_decode($id))
        ->first();
        if($loadingGateEntry)  {
         UserLog::AddLog('Gate1 Entry Officer Loading Vehicle In Print By');   
        // $consignment_details_count= ConsignmentDetails::getGateEntryNo($gate_entry->manifesto_entry_id);
        }
         // return view('proceed_vehilce.print_proceed_vehilce')->with('gate_entry',$gate_entry)->with('consignment_details_count',$consignment_details_count)->with('msg','Main Gate1 Entry Proceed ');
          return view('lu_gate_entry.print_truck_parking_note')->with('loadingGateEntry',$loadingGateEntry);
    }




    public function unloadingIndex()
    {
        return view('unloading_gate_entry.index');
    }

    
    public function unloadingList(Request $request){
        $unloading_entry_data = LuGateEntrie::with('getCustomer','getCommodity');
        if($request->status)
        {
            $unloading_entry_data->where('status','=',$request->status);
        }else{
            $unloading_entry_data->where('status','=',1);
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
                $return_action = '<a href="' . route('unloading.entry.show',base64_encode($unloading_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
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
                if($unloading_entry_data_list->status==0 ||  in_array("admin", $user_type)){
                    $return_action .= '<a href="' . route('unloading.entry.edit',base64_encode($unloading_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="Update details">
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
                }
            
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
                 if($row->status==1){
                    $status="Pending";
                }elseif($row->status==2){
                    $status="Approve";
                }
              return $status;

            })
            ->rawColumns(['customer_name','commodity_name','action'])
            ->make(true);
    }


    public function unloadingCreate()
    {
        $customers    = Customers::getAllCustomers();
        $commoditys   = Commodity::getCommodity();
        $transports   = Transports::getTransports();
        $materials    = Material::getAllMaterial();
        $uoms         = UOM::getAllUOM();
        $ref_no       = LuGateEntrie::getRefNo();
        return view('unloading_gate_entry.create')->with('customers',$customers)
        ->with('commoditys',$commoditys)->with('transports',$transports)
        ->with('materials',$materials)->with('uoms',$uoms)
        ->with('ref_no',$ref_no);
    }
    

    public function getMaterialByComodity($id)
    {
        $html = '<option value="">Select Material</option>';
        if($id){
           $materials = Material::where('commodity_id',$id)->get();
           foreach ($materials as $key => $material) {
             $html .= '<option data-unit_weight="'.$material->unit_weight.'" value="'.$material->id.'">'.ucwords( str_replace('_',' ',$material['material_name'])).' - '.$material['unit_weight'] .'Kg'.'</option>';
           }
        }
        return $html;
    }


    public function getUomByMaterial($id)
    {
        $html = '<option value="">Select Uom</option>';
        if($id){
           $materials = Material::with('getUOM')->where('id',$id)->get();
           foreach ($materials as $key => $uom) {
             $html .= '<option selected  value="'.$uom->uom_id.'">'.ucwords( str_replace('_',' ',$uom->getUOM->unit_entry_filed)) .'</option>';
           }
        }
        return $html;
    }


    public function unloadingStore(Request $request)
    {
         //   echo "<pre>";
        //   print_r($request->all());die;  
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
            $data['ref_no'] = LuGateEntrie::getRefNo();
            
            $unloading_gate_entry = new LuGateEntrie();
            $unloading_gate_entry->ref_no = $data['ref_no']?$data['ref_no']:'';
            $unloading_gate_entry->date = $data['date']? date('Y-m-d',strtotime($data['date'])):'';
            $unloading_gate_entry->customer_name = $data['customer_name']? $data['customer_name']:'';
            $unloading_gate_entry->commodity   = $data['commodity']? $data['commodity']:'';
            $unloading_gate_entry->truck_no    = $data['truck_no']?$data['truck_no']:'';
            $unloading_gate_entry->trailer_no  = $data['trailer_no']?$data['trailer_no']:'';
            $unloading_gate_entry->transporter = $data['transporter']?$data['transporter']:'';
            $unloading_gate_entry->driver_name = $data['driver_name']?$data['driver_name']:'';
            $unloading_gate_entry->driver_ph_no = $data['driver_ph_no']?$data['driver_ph_no']:'';
            $unloading_gate_entry->driver_lic_no = $data['driver_lic_no']?$data['driver_lic_no']:'';
            $unloading_gate_entry->time_in = $data['time_in']?$data['time_in']:'';
            $unloading_gate_entry->destination = $data['destination']?$data['destination']:'';
            $unloading_gate_entry->container_no = $data['container_no']?$data['container_no']:'';
            $unloading_gate_entry->bl_no = $data['bl_no']?$data['bl_no']:'';
            $unloading_gate_entry->dn_no = $data['dn_no']?$data['dn_no']:'';
            $unloading_gate_entry->bl_qty = $data['bl_qty']?$data['bl_qty']:'';
            $unloading_gate_entry->dn_qty = $data['dn_qty']?$data['dn_qty']:'';
            $unloading_gate_entry->quantity = isset($data['quantity'])?$data['quantity']:NULL;
            $unloading_gate_entry->metric_ton = isset($data['metric_ton'])?$data['metric_ton']:NULL;
            $unloading_gate_entry->shipping_line = $data['shipping_line']?$data['shipping_line']:'';
            $unloading_gate_entry->interchange_no = $data['interchange_no']?$data['interchange_no']:'';
            $unloading_gate_entry->tra_seal_no = $data['tra_seal_no']?$data['tra_seal_no']:'';
            $unloading_gate_entry->is_loading = 2;
            $unloading_gate_entry->created_at  = now();
            $unloading_gate_entry->created_by  = auth()->user()->id;
            $unloading_gate_entry->updated_by  =  auth()->user()->id;
            $unloading_gate_entry->save();
            if(count($data['material'])>0){
                foreach($data['material'] as $key=>$value){
                 $commodity_detail = new LuCommodityDetail();
                 $commodity_detail->lu_gate_entry_id= $unloading_gate_entry->id;
                 $commodity_detail->material= $data['material'][$key];
                 $commodity_detail->uom= $data['uom'][$key];
                 $commodity_detail->commodity_quantity= isset($data['commodity_quantity'][$key])?$data['commodity_quantity'][$key]:NULL;
                 $commodity_detail->total_weight= isset($data['total_weight'][$key])?$data['total_weight'][$key]:NULL;
                 $commodity_detail->created_by= auth()->user()->id;
                 $commodity_detail->updated_by= auth()->user()->id;
                 $commodity_detail->save();
                }
             }

            $loading_time_track_entry = new LuTimeTracking();
            $loading_time_track_entry->lu_gate_entry_id = $unloading_gate_entry->id;
            $loading_time_track_entry->in_or_out = 1;
            $loading_time_track_entry->old_status = NULL;
            $loading_time_track_entry->new_status = 1;
            $loading_time_track_entry->new_status_time = date('h:i A', strtotime(now()));
            $loading_time_track_entry->time_diff = 0;
            $loading_time_track_entry->updated_by = auth()->user()->id;
            $loading_time_track_entry->is_loading = 2;
            $loading_time_track_entry->save();
             
            DB::commit();
            //Send Notification
            Notifications::sendNotification(auth()->user()->user_type,'authorization_manager','New Unloading Truck Parking Note Added','','/unloading-gate-entry-approval-list');
            UserLog::AddLog('New Unloading Truck Parking Note Added By');
            //return redirect()->route('unloading.entry.index')->with('create', 'Unloading Truck Parking Note Added successfully!');
            $unloadingGateEntry = LuGateEntrie::with('getCustomer','getCommodity','getTransporter','getLuWeightBridge','getLuCommodityDetail','getLuCommodityDetail.getMaterial','getLuCommodityDetail.getUOM')
            ->where("id", "=", $unloading_gate_entry->id)
            ->first();
            return view('unloading_gate_entry.print_truck_parking_note')->with('unloadingGateEntry',$unloadingGateEntry)->with('msg','Unloading Truck Parking Note Added successfully! ');
        } catch (\Exception $e) {
            DB::rollBack();
            // return $e->getMessage();
            return redirect()->route('unloading.entry.create')->with('error',$e->getMessage());
            
        }
      }

    }



    public function unloadingShow($id)
    {
        $unloadingGateEntry = LuGateEntrie::with('getCustomer','getCommodity','getTransporter','getLuCommodityDetail','getLuCommodityDetail.getMaterial','getLuCommodityDetail.getUOM')
        ->where("id", "=", base64_decode($id))
        ->first();
        
         return view('unloading_gate_entry.show')->with('unloadingGateEntry',$unloadingGateEntry);
    }


    public function unloadingEdit($id)
    {
        $unloadingGateEntry = LuGateEntrie::with('getCustomer','getCommodity','getTransporter','getLuCommodityDetail','getLuCommodityDetail.getMaterial','getLuCommodityDetail.getUOM')
        ->where("id", "=", base64_decode($id))
        ->first();
        // echo "<pre>";
        // print_r($manifestoEntry->getConsignmentDetails);die;
        $customers  = Customers::getAllCustomers();
        $commoditys  = Commodity::getCommodity();
        $transports = Transports::getTransports();
        $materials = Material::select('id','material_name','unit_weight')
                                ->where('status','=','1')
                                ->where('commodity_id', '=', (int)$unloadingGateEntry->commodity)
                                ->get()->toArray();
        $uoms = UOM::getAllUOM();
        return view('unloading_gate_entry.update')->with('unloadingGateEntry',$unloadingGateEntry)
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
                'status' => 1,
                'updated_at' => now(),
                'updated_by' => auth()->user()->id
                );
                LuGateEntrie::where("id", "=",$data['id'])->update($update_data);
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
             
            DB::commit();
            //Send Notification
            Notifications::sendNotification(auth()->user()->user_type,'authorization_manager','New Unloading Truck Parking Note Updated','','/unloading-gate-entry-approval-list');
            UserLog::AddLog('New Unloading Truck Parking Note Updated By');
            return redirect()->route('unloading.entry.index')->with('create', 'Unloading Truck Parking Note Updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            return redirect()->route('unloading.entry.create')->with('create',$e->getMessage());
            
        }
      } 

    }


    public function unloadingGateEntryPrint($id)
    {
        $unloadingGateEntry = LuGateEntrie::with('getCustomer','getCommodity','getTransporter','getLuWeightBridge','getLuCommodityDetail','getLuCommodityDetail.getMaterial','getLuCommodityDetail.getUOM')
        ->where("id", "=", base64_decode($id))
        ->first();
        if($unloadingGateEntry)  {
         UserLog::AddLog('Gate1 Entry Officer Loading Vehicle In Print By');   
        // $consignment_details_count= ConsignmentDetails::getGateEntryNo($gate_entry->manifesto_entry_id);
        }
         // return view('proceed_vehilce.print_proceed_vehilce')->with('gate_entry',$gate_entry)->with('consignment_details_count',$consignment_details_count)->with('msg','Main Gate1 Entry Proceed ');
          return view('unloading_gate_entry.print_truck_parking_note')->with('unloadingGateEntry',$unloadingGateEntry);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LuGateEntrie  $luGateEntrie
     * @return \Illuminate\Http\Response
     */
    public function destroy(LuGateEntrie $luGateEntrie)
    {
        //
    }
}
