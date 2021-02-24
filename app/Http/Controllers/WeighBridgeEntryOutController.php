<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReleaseApprovalFinacialOfficerEntry;
use DB;
use App\GateEntryOut;
use App\ConsignmentDetails;
use App\WeightBridgeEntryOut;
use App\Notifications;
use App\UserLog;
class WeighBridgeEntryOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->ajax()){
            $gate_entry_data = GateEntryOut::with('getManifestoEntry','getManifestoEntry.getCargo','getManifestoEntry.getConsignment','getManifestoEntry.getAgent','getConsignmentDetails','getReleaseApprovalFinacialOfficerEntry');
            
            if(isset($request->created_date))
            {
                $created_date = date('Y-m-d',strtotime($request->created_date));
                $gate_entry_data->whereDate('created_at',$created_date);
            }
            if($request->status)
            {
                $gate_entry_data->where('status','=',$request->status);
            }else{
             $gate_entry_data->where('status','=',1);
            }
            $gate_entry_data_list = $gate_entry_data->get();

            
            return datatables()->of($gate_entry_data_list)
                ->addColumn('action', function ($gate_entry_data_list) {
                    $return_action = '<a href="' . route('weigh.bridge.entry.out.show',base64_encode($gate_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
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
                }else{
                    return view('weigh_bridge_entry_out.index');
                }
    }


    public function dashboard(Request $request)
    {
        
        
            $gate_entry_data = GateEntryOut::with('getManifestoEntry','getManifestoEntry.getCargo','getManifestoEntry.getConsignment','getManifestoEntry.getAgent','getConsignmentDetails','getReleaseApprovalFinacialOfficerEntry');
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
             $gate_entry_data->where('status','=',1);
            $gate_entry_data_list = $gate_entry_data->get();

            
            return datatables()->of($gate_entry_data_list)
                ->addColumn('action', function ($gate_entry_data_list) {
                    $return_action = '<a href="' . route('weigh.bridge.entry.out.show',base64_encode($gate_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
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
        if($request->action=='process'){
            $validatedData = $request->validate([
               // 'container_tare_wt' => 'required',
                'wb_tare_wt' => 'required',
            ]);
          if($validatedData){
            try {
                DB::beginTransaction();
                $data = $request->all(); 
                // echo "<pre>";
                // print_r($data);die;
                $weight_bridge_entry_out = new WeightBridgeEntryOut();
                $weight_bridge_entry_out->manifesto_entry_id= $data['manifesto_entry_id']?$data['manifesto_entry_id']:'';
                $weight_bridge_entry_out->gate_entry_out_id = $data['gate_enrty_out_id']? $data['gate_enrty_out_id']:'';
                $weight_bridge_entry_out->consignment_details_id= $data['consignment_details_id']?$data['consignment_details_id']:'';
                $weight_bridge_entry_out->finacial_officer_entry_id= $data['release_approval_finacial_officer_entries_id']?$data['release_approval_finacial_officer_entries_id']:'';
                $weight_bridge_entry_out->wb_ticket_no= $data['wb_ticket_no']?$data['wb_ticket_no']:'';
                $weight_bridge_entry_out->wb_gross_wt= ($data['wb_gross_wt'])?$data['wb_gross_wt']:NULL;
                $weight_bridge_entry_out->container_tare_wt= $data['container_tare_wt']?$data['container_tare_wt']:NULL;
                $weight_bridge_entry_out->wb_tare_wt= $data['wb_tare_wt']?$data['wb_tare_wt']:NULL;
                $weight_bridge_entry_out->wb_net_wt= ($data['wb_net_wt'])?$data['wb_net_wt']:NULL;
                $weight_bridge_entry_out->created_by= auth()->user()->id;
                $weight_bridge_entry_out->updated_by= auth()->user()->id;
                $weight_bridge_entry_out->save();
                  $update_data = array(
                    'status' => 2,
                    'updated_at' => now(),
                    'updated_by' => auth()->user()->id
                    );
                   // echo $data['gate_enrty_out_id'];die;
                    GateEntryOut::where("id", "=",$data['gate_enrty_out_id'])->update($update_data);      
    
                    DB::commit();
                    Notifications::sendNotification(auth()->user()->user_type,'weigh_bridge_officer','Weigh Bridge Entry Come For Update By  Weigh Bridge Officer','','/container-weigh-bridge-out-list');
                    UserLog::AddLog('Weigh Bridge Entry Proceed By');
                    return redirect()->route('weigh.bridge.entry.out.list')->with('create', ' Authorize successfully!');
            } catch (\Exception $e) {
                DB::rollBack();
                return $e->getMessage();
                return redirect()->route('weigh.bridge.entry.out.list')->with('create',$e->getMessage());
            }
            return redirect()->route('weigh.bridge.entry.out.list')->with('create', 'Authorize successfully!');
          }



        }else{
         $gate_entry = GateEntryOut::with('getManifestoEntry','getManifestoEntry.getCargo','getManifestoEntry.getConsignment','getManifestoEntry.getAgent','getConsignmentDetails','getReleaseApprovalFinacialOfficerEntry')
        ->where("id", "=", $request->gate_enrty_out_id)
        ->first();
        // echo "<pre>";
        // print_r($gate_entry->getConsignmentDetails);die;
         return view('weigh_bridge_entry_out.print_weigh_bridge_entry')->with('gate_entry',$gate_entry);
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
        $gate_entry = GateEntryOut::with('getManifestoEntry','getManifestoEntry.getCargo','getManifestoEntry.getConsignment','getManifestoEntry.getAgent','getConsignmentDetails','getReleaseApprovalFinacialOfficerEntry')
        ->where("id", "=", base64_decode($id))
        ->first();
        $WB_Ticket_No=  WeightBridgeEntryOut::getWBTicketNo();
        $wb_entry_out= WeightBridgeEntryOut::where("gate_entry_out_id", "=", base64_decode($id))->first();
        return view('weigh_bridge_entry_out.show')->with('gate_entry',$gate_entry)->with('WB_Ticket_No',$WB_Ticket_No)->with('wb_entry_out',$wb_entry_out);
    }


    public function print($id){
        $gate_entry = GateEntryOut::with('getManifestoEntry','getManifestoEntry.getCargo','getManifestoEntry.getConsignment','getManifestoEntry.getAgent','getConsignmentDetails','getReleaseApprovalFinacialOfficerEntry')
        ->where("id", "=", base64_decode($id))
        ->first();
        $wb_entry_out= WeightBridgeEntryOut::where("gate_entry_out_id", "=", base64_decode($id))->first();
        UserLog::AddLog('Weigh Bridge Entry Printed By');
         return view('weigh_bridge_entry_out.print_weigh_bridge_entry_new')->with('gate_entry',$gate_entry)->with('wb_entry_out',$wb_entry_out)->with('msg',' Weigh Bridge Entry-Weigh - Bridge Officer
         ');
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
