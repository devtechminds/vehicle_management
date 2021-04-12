<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GateEntry;
use App\WeighBridge;
use App\ConsignmentDetails;
use App\Notifications;
use DB;
use App\UserLog;
class CFSWeighBridgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cfs_weigh_bridge.index'); 
    }

    public function weighBridgeEntryList(Request $request){
        $gate_entry_data = GateEntry::with('getManifestoEntry','getConsignmentDetails','getManifestoEntry.getConsignment','getManifestoEntry.getCargo');
           
            if(isset($request->created_date))
            {
                $created_date = date('Y-m-d',strtotime($request->created_date));
                $gate_entry_data->whereDate('created_at',$created_date);
            }
            if($request->status)
            {
                $gate_entry_data->where('status','=',$request->status);
            }else{
             $gate_entry_data->where('status','=',2);
            }
            $gate_entry_data_list = $gate_entry_data->get();
            return datatables()->of($gate_entry_data_list)
                ->addColumn('action', function ($gate_entry_data_list) {
                    $return_action = '<a href="' . route('weigh.bridge.officer',base64_encode($gate_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
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
                ->editColumn('cargo_type', function($row){
                    return  str_replace('_',' ',ucwords($row->getManifestoEntry->getCargo->cargo_name));
                })
                ->rawColumns(['cargo_type','action'])
               
                ->make(true);
        }

        public function dashborad(Request $request){
            $gate_entry_data = GateEntry::with('getManifestoEntry','getConsignmentDetails','getManifestoEntry.getConsignment','getManifestoEntry.getCargo');
                if($request->status)
                {
                    $serch_status= 1;
                    if($request->status==2){
                        $serch_status = 0;
                    }
                    $gate_entry_data->where('status','=',$serch_status);
                }
                if(isset($request->created_date))
                {
                    $created_date = date('Y-m-d',strtotime($request->created_date));
                    $manifestogatgate_entry_datae_entry_data_entry_data->whereDate('created_at',$created_date);
                }
                 $gate_entry_data->where('status','=',2);
                $gate_entry_data_list = $gate_entry_data->get();
                return datatables()->of($gate_entry_data_list)
                    ->addColumn('action', function ($gate_entry_data_list) {
                        $return_action = '<a href="' . route('weigh.bridge.officer',base64_encode($gate_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
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
                    // ->editColumn('cargo_type', function($row){
                    //     return  str_replace('_',' ',ucwords($row->getCargo->cargo_name));
                    // })
                    // ->rawColumns(['cargo_type','action'])
                   
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
        if($request->action=='save'){
    //     $validatedData = $request->validate([
    //       //  'wb_gross_wt' => 'required',
    //     ]);
    //   if($validatedData){

        // echo "<pre>";
        // print_r($request->all());die;
        try {
            DB::beginTransaction();
            $data = $request->all();  
            $weigh_bridge = new WeighBridge();
            $weigh_bridge->wb_gross_wt = (int)$data['wb_gross_wt'];
            $weigh_bridge->container_tare_wt = (int)$data['container_tare_wt'];
            $weigh_bridge->gate_entry_id = $data['gate_entry_id']?$data['gate_entry_id']:'';
            $weigh_bridge->consignment_details_id = $data['consignment_details_id']?$data['consignment_details_id']:'';
            $weigh_bridge->manifesto_entry_id = $data['manifesto_entry_id']?$data['manifesto_entry_id']:'';
            $weigh_bridge->wb_ticket_no = $data['wb_ticket_no']?$data['wb_ticket_no']:NULL;
            $weigh_bridge->created_at = now();
            $weigh_bridge->updated_at = now();
            $weigh_bridge->created_by = auth()->user()->id;
            $weigh_bridge->updated_by = auth()->user()->id;
            $weigh_bridge->save();
            $update_data =array(
                'status'=>3,
                'updated_at' => now(),
                'updated_by' => auth()->user()->id
                );
                GateEntry::where("id", "=",$data['gate_entry_id'])->update($update_data);
            DB::commit();
            Notifications::sendNotification(auth()->user()->user_type,'field_supervisor','New Weigh BridgeEntry Added ','','/supervisor-doc-upload-entry');
            UserLog::AddLog('New Weigh BridgeEntry Added By');
            return redirect()->route('weigh.bridge.entry')->with('create', ' Added successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            return redirect()->route('weigh.bridge.officer')->with('create',$e->getMessage());
            
        }

        return redirect()->route('weigh.bridge.entry')->with('create', ' Added successfully!');
     // }
    }
    else{
        $gate_entry = GateEntry::with('getManifestoEntry','getConsignmentDetails','getConsignmentDetails.getUOM','getConsignmentDetails.getMaterial','getConsignmentDetails.getCommodity','getManifestoEntry.getConsignment','getManifestoEntry.getCargo','getManifestoEntry.getCustomers','getManifestoEntry.getAgent')
        ->where("id", "=", $request->gate_entry_id)
        ->first();
       
        return view('cfs_weigh_bridge.print_cfs_weigh_bridge',compact('gate_entry'));
    } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gate_entry = GateEntry::with('getManifestoEntry','getConsignmentDetails','weighBridges','getConsignmentDetails.getUOM','getConsignmentDetails.getMaterial','getConsignmentDetails.getCommodity','getManifestoEntry.getConsignment','getManifestoEntry.getCargo','getManifestoEntry.getCustomers','getManifestoEntry.getAgent')
        ->where("id", "=", base64_decode($id))
        ->first();
        $wb_ticket_no= WeighBridge::getWBTicketNo();
        
        $consignment_details_count = ConsignmentDetails::getGateEntryNo($gate_entry->manifesto_entry_id);
         return view('cfs_weigh_bridge.show')->with('gate_entry',$gate_entry)->with('wb_ticket_no',$wb_ticket_no)->with('consignment_details_count',$consignment_details_count);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        $gate_entry = GateEntry::with('getManifestoEntry','getConsignmentDetails','getConsignmentDetails.getUOM','getConsignmentDetails.getMaterial','getConsignmentDetails.getCommodity','getManifestoEntry.getConsignment','getManifestoEntry.getCargo','getManifestoEntry.getCustomers','getManifestoEntry.getAgent','getConsignmentDetails.getTransports')
        ->where("id", "=", base64_decode($id))
        ->first();
  
        $wb_ticket_no= WeighBridge::getWBTicketNo();
        UserLog::AddLog('New Weigh BridgeEntry Printed By');
        $consignment_details_count = ConsignmentDetails::getGateEntryNo($gate_entry->manifesto_entry_id);
         return view('cfs_weigh_bridge.print_cfs_weigh_bridge_new')->with('gate_entry',$gate_entry)->with('wb_ticket_no',$wb_ticket_no)->with('consignment_details_count',$consignment_details_count);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
