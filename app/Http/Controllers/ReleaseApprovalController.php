<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UploadDocuments;
use App\ConsignmentDetails;
use App\WeighBridge;
use DB;
use App\Location;
use App\Commodity;
use App\Material;
use App\UOM;
use App\FieldSupervisorEntryOut;
use App\ManifestoEntry;
use App\Consignment;
use App\Cargo;
use App\Customers;
use App\EtcAgent;
use App\GateEntry;
use App\ReleaseApprovalFinacialOfficerEntry;
use App\Notifications;
use App\UserLog;

class ReleaseApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $gate_entry_data = UploadDocuments::with('getGateEntry','getManifestoEntry','getManifestoEntry.getCargo','getManifestoEntry.getConsignment','getManifestoEntry.getAgent','getConsignmentDetails');
            if($request->status)
            {
                $gate_entry_data->where('out_process_status','=',$request->status);
            }else{
                $gate_entry_data->where('out_process_status','=',3);
            }
            if(isset($request->created_date))
            {
                $created_date = date('Y-m-d',strtotime($request->created_date));
                $gate_entry_data->whereDate('created_at',$created_date);
            }
            
            $gate_entry_data_list = $gate_entry_data->get();
            return datatables()->of($gate_entry_data_list)
                ->addColumn('action', function ($gate_entry_data_list) {
                    $return_action = '<a href="' . route('release.approval.show',base64_encode($gate_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
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
                }else{
                    return view('release_approval.index');
                } 
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
        // echo "<pre>";
        // print_r($request->all());die;
        $validatedData = $request->validate([
            'cfs_release_no' => 'required',
            'invoice_no' => 'required',
          
            'invoice_date' => 'required',
            'cfs_release_date' => 'required',
            'cfs_release_exp_date' => 'required',
        ]);
      if($validatedData){
        try {
            DB::beginTransaction();
            $data = $request->all(); 
            $ReleaseApproval = new ReleaseApprovalFinacialOfficerEntry();
            $ReleaseApproval->manifesto_entry_id= $data['manifesto_entry_id']?$data['manifesto_entry_id']:'';
            $ReleaseApproval->gate_entry_id= $data['gate_entry_id']?$data['gate_entry_id']:'';
            $ReleaseApproval->weigh_bridges_id= $data['weight_bridge_entry_id']?$data['weight_bridge_entry_id']:'';
            $ReleaseApproval->consignment_details_id= $data['consignment_details_id']?$data['consignment_details_id']:'';
            $ReleaseApproval->field_supervisor_entry_out_id= $data['field_supervisor_entry_out_id']?$data['field_supervisor_entry_out_id']:'';
            $ReleaseApproval->cfs_release_no= $data['cfs_release_no']?$data['cfs_release_no']:'';
            $ReleaseApproval->invoice_no= $data['invoice_no']?$data['invoice_no']:'';
            $ReleaseApproval->cfa_release_date= $data['cfs_release_date']?$data['cfs_release_date']:'';
            $ReleaseApproval->invoice_date = $data['invoice_date']?$data['invoice_date']:'';
            $ReleaseApproval->cfs_release_date = $data['cfs_release_date']?$data['cfs_release_date']:'';
            $ReleaseApproval->cfs_release_exp_date = $data['cfs_release_exp_date']?$data['cfs_release_exp_date']:'';
            $ReleaseApproval->created_by= auth()->user()->id;
            $ReleaseApproval->updated_by= auth()->user()->id;
            $ReleaseApproval->save();

            $update_consignment_details = array(
                'truck_no' => $data['truck_no']?$data['truck_no']:'',  
                'trailer_no' => $data['trailer_no']?$data['trailer_no']:'',
                'driver_name' => $data['driver_name']?$data['driver_name']:'',
                'driver_lic_no' => $data['driver_license']?$data['driver_license']:'',
                'driver_ph_no' => $data['driver_ph_no']?$data['driver_ph_no']:'',
                'chasis_no' => $data['chasis_no']?$data['chasis_no']:'',
                'updated_at' => now(),
                'updated_by' => auth()->user()->id
                );
            ConsignmentDetails::where("id", "=",$data['consignment_details_id'])->update($update_consignment_details);

            $update_document_upload = array(
                'out_process_status' => 4,
                'updated_at' => now(),
                'updated_by' => auth()->user()->id
                );
                UploadDocuments::where("id", "=",$data['document_upload_id'])->update($update_document_upload);      

            // $update_field_supervisor_entry_out = array(
            //     'status' => 3,
            //     'updated_at' => now(),
            //     'updated_by' => auth()->user()->id
            //     );
            //     FieldSupervisorEntryOut::where("id", "=",$data['field_supervisor_entry_out_id'])->update($update_field_supervisor_entry_out);      
        
                DB::commit();
                
                Notifications::sendNotification(auth()->user()->user_type,'finance_controller','New Release Approval By Finance Officer.','','/release-final-approval-list');
                UserLog::AddLog('Container release approval By');
                return redirect()->route('release.approval.list')->with('create', ' Release Approval successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            return redirect()->route('release.approval.list')->with('create',$e->getMessage());
        }
        return redirect()->route('release.approval.list')->with('create', 'Release Approval successfully!');
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
        $gate_entry = UploadDocuments::with('getGateEntry','getManifestoEntry','getManifestoEntry.getCargo','getManifestoEntry.getConsignment','getConsignmentDetails','getWeighBridge','getLocation')
        ->where("id", "=", base64_decode($id))
        ->first();
        $locations = Location::getAllLocation();
        $commodity = Commodity::getCommodity();
        $materials = Material::getAllMaterial();
        $uoms = UOM::getAllUOM();
        $consignments = Consignment::getAllConsignment();
        $cargos = Cargo::getAllCargo();
        $customers = Customers::getAllCustomers();
        $agents = EtcAgent::getAllAgents();
         $release_no=  ReleaseApprovalFinacialOfficerEntry::getCFSReleaseNo();
         $consignment_details_count = ConsignmentDetails::getGateEntryNo($gate_entry->manifesto_entry_id);
         return view('release_approval.show')->with('gate_entry',$gate_entry)->with('consignment_details_count',$consignment_details_count)
         ->with('locations',$locations) ->with('commodity',$commodity)
         ->with('materials',$materials)->with('uoms',$uoms)
         ->with('consignments',$consignments)->with('agents',$agents)
         ->with('customers',$customers)->with('release_no',$release_no)
         ->with('cargos',$cargos);
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

    public function print($id){

        $gate_entry = UploadDocuments::with('getGateEntry','getManifestoEntry','getManifestoEntry.getCargo','getManifestoEntry.getConsignment','getConsignmentDetails','getWeighBridge','getLocation','getManifestoEntry.getReleaseApprovalFinacialOfficerEntry')
        ->where("id", "=", base64_decode($id))
        ->first();
        // echo "<pre>";
        // print_r($gate_entry->getManifestoEntry->getReleaseApprovalFinacialOfficerEntry);die;
        $locations = Location::getAllLocation();
        $commodity = Commodity::getCommodity();
        $materials = Material::getAllMaterial();
        $uoms = UOM::getAllUOM();
        $consignments = Consignment::getAllConsignment();
        $cargos = Cargo::getAllCargo();
        $customers = Customers::getAllCustomers();
        $agents = EtcAgent::getAllAgents();
         $release_no=  ReleaseApprovalFinacialOfficerEntry::getCFSReleaseNo();
         $consignment_details_count = ConsignmentDetails::getGateEntryNo($gate_entry->manifesto_entry_id);
         
         return view('release_approval.print_new')->with('gate_entry',$gate_entry)->with('consignment_details_count',$consignment_details_count)
         ->with('locations',$locations) ->with('commodity',$commodity)
         ->with('materials',$materials)->with('uoms',$uoms)
         ->with('consignments',$consignments)->with('agents',$agents)
         ->with('customers',$customers)->with('release_no',$release_no)
         ->with('cargos',$cargos);
      
    }
}
