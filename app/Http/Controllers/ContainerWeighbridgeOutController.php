<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReleaseApprovalFinacialOfficerEntry;
use DB;
use App\GateEntryOut;
use App\ConsignmentDetails;
use App\WeightBridgeEntryOut;
use App\Location;
use App\UploadDocuments;
use App\Area;
use App\FieldSupervisorEntryOut;
use App\Notifications;
use App\UserLog;
class ContainerWeighbridgeOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $gate_entry_data = WeightBridgeEntryOut::with('getManifestoEntry','getManifestoEntry.getCargo','getManifestoEntry.getConsignment','getManifestoEntry.getAgent','getConsignmentDetails','getReleaseApprovalFinacialOfficerEntry','getGateEntryOut');
            if($request->status)
            {
                $serch_status= 1;
                if($request->status==2){
                    $serch_status = 0;
                }
                $gate_entry_data->where('status','=',$serch_status);
            }
            else{
                $gate_entry_data->where('status','=',0);
            }
            if(isset($request->created_date))
            {
                $created_date = date('Y-m-d',strtotime($request->created_date));
                $gate_entry_data->whereDate('created_at',$created_date);
            }
             
            $gate_entry_data_list = $gate_entry_data->get();

            
            return datatables()->of($gate_entry_data_list)
                ->addColumn('action', function ($gate_entry_data_list) {
                    $return_action = '<a href="' . route('container.weigh.bridge.out.show',base64_encode($gate_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
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
                ->editColumn('cfs_release_no', function($row){
                      if(isset($row->getReleaseApprovalFinacialOfficerEntry->cfs_release_no)){
                         return $row->getReleaseApprovalFinacialOfficerEntry->cfs_release_no;
                      }else{
                          return "__________";
                      }
                   
                })
                ->editColumn('cfs_release_date', function($row){
                    if(isset($row->getReleaseApprovalFinacialOfficerEntry->cfs_release_date)){
                       return $row->getReleaseApprovalFinacialOfficerEntry->cfs_release_date;
                    }else{
                        return "__________";
                    }
                 
              })
                ->rawColumns(['cargo_type','cfs_release_no','action'])
               
                ->make(true);
                }else{
                    return view('container-weigh-bridge-out.index');
                }
    }


    public function dashboard(Request $request)
    {
       
            $gate_entry_data = WeightBridgeEntryOut::with('getManifestoEntry','getManifestoEntry.getCargo','getManifestoEntry.getConsignment','getManifestoEntry.getAgent','getConsignmentDetails','getReleaseApprovalFinacialOfficerEntry','getGateEntryOut');
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
             $gate_entry_data->where('status','=',0);
            $gate_entry_data_list = $gate_entry_data->get();

            
            return datatables()->of($gate_entry_data_list)
                ->addColumn('action', function ($gate_entry_data_list) {
                    $return_action = '<a href="' . route('container.weigh.bridge.out.show',base64_encode($gate_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
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
                'weight_bridge_entry_outs_id' => 'required',
               // 'wb_gross_wt' => 'required',
                'container_tare_wt' => 'required',
                'wb_gross_wt' => 'required',
                
            ]);
          if($validatedData){
            try {
                DB::beginTransaction();
                $data = $request->all(); 
                  $field_supervisor_entry_out = new FieldSupervisorEntryOut();
                  $field_supervisor_entry_out->manifesto_entry_id = $data['manifesto_entry_id']?$data['manifesto_entry_id']:'';
                  $field_supervisor_entry_out->gate_entry_id = $data['weight_bridge_entry_outs_id']?$data['weight_bridge_entry_outs_id']:'';
                  $field_supervisor_entry_out->weigh_bridges_id = $data['weight_bridge_entry_outs_id']?$data['weight_bridge_entry_outs_id']:'';
                  $field_supervisor_entry_out->consignment_details_id = $data['consignment_details_id']?$data['consignment_details_id']:'';
                  $field_supervisor_entry_out->field_supervisor_name = $data['field_supervisor_name']?$data['field_supervisor_name']:'';
                  $field_supervisor_entry_out->container_physical_status = $data['container_physical_status']?$data['container_physical_status']:'';
                  $field_supervisor_entry_out->location = $data['location_field']?$data['location_field']:'';
                  $field_supervisor_entry_out->field_supervisor_entry_date = $data['field_supervisor_entry_date']?$data['field_supervisor_entry_date']:'';
                  $field_supervisor_entry_out->no_of_package = $data['no_of_package']?$data['no_of_package']:'';
                  $field_supervisor_entry_out->remarks = $data['remarks']?$data['remarks']:'';
                  $field_supervisor_entry_out->area_id = $data['area']?$data['area']:'';
                  $field_supervisor_entry_out->bin_id = $data['bin']?$data['bin']:'';
                  $field_supervisor_entry_out->created_by = auth()->user()->id;
                  $field_supervisor_entry_out->updated_by = auth()->user()->id;
                  $field_supervisor_entry_out->save();

                  $update_data = array(
                    'wb_gross_wt'=>(int)$data['wb_gross_wt'], 
                    'wb_net_wt'=>(int)$data['wb_net_wt'], 
                    'wb_tare_wt'=>(int)$data['wb_tare_wt'], 
                    'container_tare_wt'=>(int)$data['container_tare_wt'], 
                    'weight_bridge_entry_outs_id' => $field_supervisor_entry_out->id,
                    'updated_at' => now(),
                    'status'=>1,
                    'updated_by' => auth()->user()->id
                    );
                   // echo $data['gate_enrty_out_id'];die;
                   WeightBridgeEntryOut::where("id", "=",$data['weight_bridge_entry_outs_id'])->update($update_data);      
                  
                    DB::commit();
                    Notifications::sendNotification(auth()->user()->user_type,'cfs_gate_officer','Container Weigh bridge Out By CFS Weigh Bridge ','','/proceed-container-out-list');
                    UserLog::AddLog('Container Weigh bridge Out By');
                    return redirect()->route('container.weigh.bridge.out.list')->with('create', ' Weigh Bridge out successfully!');
            } catch (\Exception $e) {
                DB::rollBack();
                return $e->getMessage();
                return redirect()->route('container.weigh.bridge.out.list')->with('create',$e->getMessage());
            }
            return redirect()->route('container.weigh.bridge.out.list')->with('create', 'Weigh Bridge out successfully!');
          }



        }else{
         $gate_entry = WeightBridgeEntryOut::with('getManifestoEntry','getManifestoEntry.getCargo','getManifestoEntry.getConsignment','getManifestoEntry.getAgent','getConsignmentDetails','getReleaseApprovalFinacialOfficerEntry','getGateEntryOut')
        ->where("id", "=", $request->gate_enrty_out_id)
        ->first();
         return view('container-weigh-bridge-out.print_container_weigh_bridge_out')->with('gate_entry',$gate_entry);
        }
    }

    public function print($id)
    {
        $gate_entry = WeightBridgeEntryOut::with('getManifestoEntry','getManifestoEntry.getCargo','getManifestoEntry.getConsignment','getManifestoEntry.getAgent','getConsignmentDetails','getReleaseApprovalFinacialOfficerEntry','getGateEntryOut','getFieldSupervisorEntryOut')
        ->where("id", "=", base64_decode($id))
        ->first();
        UserLog::AddLog('Container Weigh bridge Out Printed By');
         return view('container-weigh-bridge-out.print_container_weigh_bridge_out_new')->with('gate_entry',$gate_entry);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gate_entry =  WeightBridgeEntryOut::with('getManifestoEntry','getManifestoEntry.getCargo','getManifestoEntry.getConsignment','getManifestoEntry.getAgent','getConsignmentDetails','getReleaseApprovalFinacialOfficerEntry','getGateEntryOut')
        ->where("id", "=", base64_decode($id))
        ->first();
        $upload_document= UploadDocuments::with('getUploadDocumentsFiles','getAllUploadDocumentsFiles')->where("manifesto_entry_id", "=", $gate_entry->manifesto_entry_id)->first();
        $locations = Location::getAllLocation();
        $areas = Area::getAllAreaById($gate_entry->location);
        return view('container-weigh-bridge-out.show')
        ->with('gate_entry',$gate_entry)->with('locations',$locations)
        ->with('areas',$areas)->with('upload_document',$upload_document);
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
