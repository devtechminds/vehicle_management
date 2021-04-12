<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReleaseApprovalFinacialOfficerEntry;
use DB;
use App\GateEntryOut;
use App\ConsignmentDetails;
use App\WeightBridgeEntryOut;
use App\UploadDocuments;

use App\Consignment;
use App\Cargo;
use App\Customers;
use App\EtcAgent;
use App\Commodity;
use App\Location;
use App\Material;
use App\UOM;
use App\WeighBridge;
use App\ManifestoEntry;
use App\GateEntry;
use App\Area;
use App\Bin;
use App\FieldSupervisorEntryOut;
use App\Notifications;
use App\UserLog;
class ApproveContainerOutController extends Controller
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
               
                $gate_entry_data->where('status','=',$request->status);
            }else{
                $gate_entry_data->where('status','=',2);
            }
            if(isset($request->created_date))
            {
                $created_date = date('Y-m-d',strtotime($request->created_date));
                $gate_entry_data->whereDate('created_at',$created_date);
            }
             
            $gate_entry_data_list = $gate_entry_data->get();

            
            return datatables()->of($gate_entry_data_list)
                ->addColumn('action', function ($gate_entry_data_list) {
                    $return_action = '<a href="' . route('approve.container.out.show',base64_encode($gate_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
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
                    if($row->getManifestoEntry->getCargo->cargo_name){
                    return  str_replace('_',' ',ucwords($row->getManifestoEntry->getCargo->cargo_name));
                  }
                  else{
                        return "";
                  }
                })
                ->editColumn('cfs_release_no', function($row){
                   if(isset($row->getReleaseApprovalFinacialOfficerEntry->cfs_release_no)){
                    return  str_replace('_',' ',ucwords($row->getReleaseApprovalFinacialOfficerEntry->cfs_release_no));
                }else{
                    return "";
                }
                })
                ->editColumn('cfs_release_date', function($row){
                    if(isset($row->getReleaseApprovalFinacialOfficerEntry->cfs_release_date)){
                     return  str_replace('_',' ',ucwords($row->getReleaseApprovalFinacialOfficerEntry->cfs_release_date));
                 }else{
                     return "";
                 }
                 })
                ->rawColumns(['cargo_type','action'])
               
                ->make(true);
                }else{
                    return view('approve_container_out.index');
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
             $gate_entry_data->where('status','=',2);
            $gate_entry_data_list = $gate_entry_data->get();

            
            return datatables()->of($gate_entry_data_list)
                ->addColumn('action', function ($gate_entry_data_list) {
                    $return_action = '<a href="' . route('approve.container.out.show',base64_encode($gate_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
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
        // echo "<pre>";
        // print_r($request->all());die;
     $validatedData = $request->validate([
            'weight_bridge_entry_outs_id' => 'required',
           
            
        ]);
      if($validatedData){
        try {
            DB::beginTransaction();
            $data = $request->all(); 
            $update_data_manifesto_entry = array(
                'consignment_type'=> $data['consignment_type']?$data['consignment_type']:'',
                'cargo_reference_no'=> isset($data['cargo_reference_no'])?$data['cargo_reference_no']:'',
                'ecd_name'=> isset($data['ecd_name'])?$data['ecd_name']:'',
                'cargo_type'=> explode("/",$data['cargo_type'])[1],
                'delivery_note_no'=> isset($data['delivery_note_no'])?$data['delivery_note_no']:'',
                'no_package'=> isset($data['no_package'])?$data['no_package']:NULL,
                'no_container'=> isset($data['no_container'])?$data['no_container']:'',
                'booking_no'=> isset($data['booking_no'])?$data['booking_no']:'',
                'consignment_wgt'=> isset($data['consignment_wgt'])?$data['consignment_wgt']:NULL,
                'cf_agent'=> isset($data['cf_agent'])?$data['cf_agent']:'',
                'customer_name'=> isset($data['customer_name'])?$data['customer_name']:'',
                'bl_no'=> isset($data['bl_no'])?$data['bl_no']:'',
                'gate_pass_no'=> isset($data['gate_pass_no'])?$data['gate_pass_no']:'',
                'updated_at' => now(),
                'updated_by' => auth()->user()->id
                );
                ManifestoEntry::where("id", "=",$data['manifesto_entry_id'])->update($update_data_manifesto_entry);
                $update_gate_entry_out = array(
                    'initiated_by'=> $data['initiated_by']?$data['initiated_by']:'',
                    'interchange_no'=> $data['interchange_no']?$data['interchange_no']:'',
                    'destination'=> $data['destination']?$data['destination']:'',
                    'shipping_line'=> $data['shipping_line']?$data['shipping_line']:'',
                    'updated_at' => now(),
                    'updated_by' => auth()->user()->id
                    );
                GateEntryOut::where("id", "=",$data['gate_enrty_out_id'])->update($update_gate_entry_out);    
             
                $update_finacial_officer_entry = array(
                    'invoice_no'=> $data['invoice_no']?$data['invoice_no']:'',
                    'cfa_release_date'=> $data['cfa_release_date']?$data['cfa_release_date']:'',
                    'invoice_date'=> $data['invoice_date']?$data['invoice_date']:'',
                    'cfs_release_date'=> $data['cfs_release_date']?$data['cfs_release_date']:'',
                    'cfs_release_exp_date'=> $data['cfs_release_exp_date']?$data['cfs_release_exp_date']:'',
                    'updated_at' => now(),
                    'updated_by' => auth()->user()->id
                    );
                 ReleaseApprovalFinacialOfficerEntry::where("id", "=",$data['release_approval_finacial_officer_entries_id'])->update($update_finacial_officer_entry);    
                 $update_WeightBridgeEntryOut = array(
                    'wb_gross_wt'=> (int)$data['wb_gross_wt'],
                    'container_tare_wt'=> (int)$data['container_tare_wt'],
                    'wb_tare_wt'=> (int)$data['wb_tare_wt'],
                    'wb_net_wt'=>(int)$data['wb_net_wt'], 
                    'status' => 3,
                    'updated_at' => now(),
                    'updated_by' => auth()->user()->id
                    );
                    WeightBridgeEntryOut::where("id", "=",$data['weight_bridge_entry_outs_id'])->update($update_WeightBridgeEntryOut);      
              
                $update_data_field_supervisor_entry_out = array(
                    'field_supervisor_name'=> $data['field_supervisor_name']?$data['field_supervisor_name']:'',
                    'container_physical_status'=> $data['container_physical_status']?$data['container_physical_status']:'',
                    'location'=> $data['location_supervisor']?$data['location_supervisor']:'',
                    'area_id'=> $data['area']?$data['area']:'',
                    'bin_id'=> $data['bin']?$data['bin']:'',
                    'no_of_package'=> $data['no_of_package']?$data['no_of_package']:'',
                    'remarks'=> $data['remarks']?$data['remarks']:'',
                    'status' => 3,
                    'updated_at' => now(),
                    'updated_by' => auth()->user()->id
                );
                FieldSupervisorEntryOut::where("id", "=",$data['field_supervisor_entry_out_id'])->update($update_data_field_supervisor_entry_out);      
                $update_data_consignment_details = array(
                    'report_no'=> $data['report_no']?$data['report_no']:'',
                    'carry_in_date'=> $data['carry_in_date']?$data['carry_in_date']:'',
                    'container_no'=> (strlen($data['container_no'])>0)?$data['container_no']:NULL,
                    'size'=> (int)$data['size'],
                    'seal_s_no1'=> (strlen($data['seal_s_no1'])>0)?$data['seal_s_no1']:NULL,
                    'seal_s_no2'=> (strlen($data['seal_s_no2'])>0)?$data['seal_s_no2']:'',
                    'commodity'=> $data['commodity']?$data['commodity']:'',
                    'material'=> $data['material']?$data['material']:'',
                    'uom'=> $data['uom']?$data['uom']:'',
                    'qty'=> (int)$data['qty'],
                    'lot_no'=> $data['lot_no']?$data['lot_no']:'',
                    'location'=> $data['location']?$data['location']:'',
                    'truck_no'=> $data['truck_no']?$data['truck_no']:'',
                    'trailer_no'=> $data['trailer_no']?$data['trailer_no']:'',
                    'driver_name'=> $data['driver_name']?$data['driver_name']:'',
                    'driver_lic_no'=> $data['driver_license']?$data['driver_license']:'',
                    'driver_ph_no'=> $data['driver_ph_no']?$data['driver_ph_no']:'',
                    'chasis_no'=> $data['chasis_no']?$data['chasis_no']:'',
                    'updated_at' => now(),
                    'updated_by' => auth()->user()->id
                );
                ConsignmentDetails::where("id", "=",$data['field_supervisor_entry_out_id'])->update($update_data_consignment_details);      

                DB::commit();
                Notifications::sendNotification(auth()->user()->user_type,'cfs_gate_officer','Gate Pass Generation Done By Operation manager','','/print-out-pass-list');
                UserLog::AddLog('Approve Container Out By');
                return redirect()->route('approve.container.out.list')->with('create', 'Gate pass generation updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            return redirect()->route('approve.container.out.list')->with('create',$e->getMessage());
        }
        return redirect()->route('approve.container.out.list')->with('create', 'Gate pass generation updated successfully!');
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
       
        $gate_entry =  WeightBridgeEntryOut::with('getFieldSupervisorEntryOut','getManifestoEntry','getManifestoEntry.getCargo','getManifestoEntry.getConsignment','getManifestoEntry.getAgent','getConsignmentDetails','getReleaseApprovalFinacialOfficerEntry','getGateEntryOut','getGateEntryOut.getFieldSupervisorEntryOut','getGateEntryOut.getGateEntryIn')
        ->where("id", "=", base64_decode($id))
        ->first();
       
        $consignments = Consignment::getAllConsignment();
        $cargos = Cargo:: getCargoTypeByType($gate_entry->getManifestoEntry->getConsignment->consignment_type);
        //echo "<pre>";
        //print_r($gate_entry);die;
           
        //  $cargos = Cargo::getAllCargo();
        $customers = Customers::getAllCustomers();
        $agents = EtcAgent::getAllAgents();
        $commodity = Commodity::getCommodity();
        $materials = Material::getAllMaterial();
        $uoms = UOM::getAllUOM();
        $locations = Location::getAllLocation();
        $gate_pass_no= ManifestoEntry::getGatePassNoOut();
        $upload_document= UploadDocuments::with('getUploadDocumentsFiles','getAllUploadDocumentsFiles')->where("manifesto_entry_id", "=", $gate_entry->manifesto_entry_id)->first();
        //echo "<pre>";
       // print_r($gate_pass_no);die;
        if(isset($gate_entry->getFieldSupervisorEntryOut->location)){
            $areas = Area::getAllAreaById($gate_entry->getFieldSupervisorEntryOut->location);
        }
        else{
            $areas = Area::getAllArea();
        }
        
         $bins = Bin::get();
        // echo "<pre>";
        // print_r($gate_entry);die;
        
       
        return view('approve_container_out.show')->with('gate_entry',$gate_entry)
        ->with('consignments',$consignments)
        ->with('cargos',$cargos)->with('agents',$agents)
        ->with('customers',$customers)->with('commodity',$commodity)
        ->with('materials',$materials)->with('uoms',$uoms)
        ->with('locations',$locations)->with('areas',$areas)
        ->with('gate_pass_no',$gate_pass_no)
        ->with('bins',$bins)
        ->with('upload_document',$upload_document)
        ;
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
