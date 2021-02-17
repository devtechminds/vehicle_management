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
use App\Area;
use App\Bin;
use App\Notifications;
use App\UserLog;

class StuffingApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $gate_entry_data = UploadDocuments::with('getGateEntry','getManifestoEntry','getManifestoEntry.getCargo','getManifestoEntry.getConsignment','getConsignmentDetails');
            if($request->status)
            {
                $gate_entry_data->where('out_process_status','=',$request->status);
            }
            else{
                $gate_entry_data->where('out_process_status','=',2);
            }
            if(isset($request->created_date))
            {
                $created_date = date('Y-m-d',strtotime($request->created_date));
                $gate_entry_data->whereDate('created_at',$created_date);
            }
             
            $gate_entry_data_list = $gate_entry_data->get();
            return datatables()->of($gate_entry_data_list)
                ->addColumn('action', function ($gate_entry_data_list) {
                    $return_action = '<a href="' . route('stuffing.approval.show',base64_encode($gate_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
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
                    return view('stuffing_approval.index');
                } 
    }

    public function dashboard(Request $request)
    {
        
            $gate_entry_data = FieldSupervisorEntryOut::with('getGateEntry','getManifestoEntry','getManifestoEntry.getCargo','getManifestoEntry.getConsignment','getConsignmentDetails');
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
                    $return_action = '<a href="' . route('stuffing.approval.show',base64_encode($gate_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
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
            'ref_no' => 'required',
            'date' => 'required',
            'consignment_type' => 'required',
            // 'cargo_reference_no' => 'required',
            // 'cargo_type' => 'required',
            // 'delivery_note_no' => 'required',
            // 'no_package' => 'required',
            // 'booking_no' => 'required',
            // 'cf_agent' => 'required',
            // 'customer_name' => 'required',
            // 'gate_entry_id' => 'required',
            // 'initiated_by' => 'required',
            // 'interchange_no' => 'required',
            // 'time_in' => 'required',
            // 'destination' => 'required',
            // 'shipping_line' => 'required',
            // 'wb_ticket_no' => 'required',
            // 'wb_gross_wt' => 'required',
            // 'container_tare_wt' => 'required',
            // 'wb_tare_wt' => 'required',
            // 'wb_net_wt' => 'required',
            // 'field_supervisor_entry' => 'required',
            // 'field_supervisor_entry_id' => 'required',
            // 'field_supervisor_name' => 'required',
            // 'container_physical_status' => 'required',
            // 'location' => 'required',
            // 'field_supervisor_entry_date' => 'required',
            // 'no_of_package_field_supervisor' => 'required',
            // 'remarks' => 'required',
            // 'report_no' => 'required',
            // 'carry_in_date' => 'required',
            // 'container_no' => 'required',
            // 'size' => 'required',
            // 'seal_s_no1' => 'required',
            // 'commodity' => 'required',
            // 'material' => 'required',
            // 'uom' => 'required',
            // 'seal_s_no2' => 'required',
            // 'qty' => 'required',
            // 'lot_no' => 'required',
            // 'location' => 'required',
        ]);
      if($validatedData){
        try {
            DB::beginTransaction();
            $data = $request->all(); 
            // echo "<pre>";
            // print_r($data);die;
            $update_data_manifesto_entry =array(
                'ref_no' => $data['ref_no']?$data['ref_no']:'',
                'date' => $data['date']?$data['date']:'',
                'consignment_type' => $data['consignment_type']?$data['consignment_type']:'',
                'cargo_type' => explode("/",$data['cargo_type'])[1],
                'cargo_reference_no' => $data['cargo_reference_no']?$data['cargo_reference_no']:'',
                //'ecd_name' => $data['ecd_name']?$data['ecd_name']:'',
                'delivery_note_no' => $data['delivery_note_no']?$data['delivery_note_no']:'',
               // 'no_container' => $data['no_container']?$data['no_container']:'',
                'booking_no' => $data['booking_no']?$data['booking_no']:'',
                'customer_name' => $data['customer_name']?$data['customer_name']:'',
                'cf_agent' => $data['cf_agent']?$data['cf_agent']:'',
                'no_package' => isset($data['no_package'])?$data['no_package']:NULl,
                'interchange_no' => $data['interchange_no']?$data['interchange_no']:'',
                'destination' => $data['destination']?$data['destination']:'',
                'shipping_line' => $data['shipping_line']?$data['shipping_line']:'',
                'bl_no' => $data['bl_no']?$data['bl_no']:'',
                'updated_at' => now(),
                'updated_by' => auth()->user()->id
                );
                ManifestoEntry::where("id", "=",$data['manifesto_entry_id'])->update($update_data_manifesto_entry);
                $update_data_gate_entry=array(
                    'gate_entry_no' => $data['ref_no']?$data['gate_entry_no']:'',
                    'initiated_by' => $data['initiated_by']?$data['initiated_by']:'',
                    'interchange_no' => $data['interchange_no']?$data['interchange_no']:'',
                    'time_in' => $data['time_in']?$data['time_in']:'',
                    'destination' => $data['destination']?$data['destination']:'',
                    'shipping_line' => $data['shipping_line']?$data['shipping_line']:'',
                    'updated_at' => now(),
                    'updated_by' => auth()->user()->id
                    );
                    GateEntry::where("id", "=",$data['gate_entry_id'])->update($update_data_gate_entry);
                    $update_data_Weigh_bridge=array(
                        'wb_ticket_no' => $data['wb_ticket_no']?$data['wb_ticket_no']:'',
                        'wb_gross_wt' => $data['initiated_by']?$data['wb_gross_wt']:'',
                        'container_tare_wt' => $data['container_tare_wt']?$data['container_tare_wt']:'',
                        'wb_tare_wt' => $data['wb_tare_wt']?$data['wb_tare_wt']:'',
                        'wb_net_wt' => $data['wb_net_wt']?$data['wb_net_wt']:'',
                        'updated_at' => now(),
                        'updated_by' => auth()->user()->id
                        );
                        WeighBridge::where("id", "=",$data['weight_bridge_entry_id'])->update($update_data_Weigh_bridge);
                        $update_data_upload_documents = array(
                            'field_supervisor_name' => $data['field_supervisor_name']?$data['field_supervisor_name']:'',
                            'container_physical_status' => $data['container_physical_status']?$data['container_physical_status']:'',
                            'location' => $data['location_supervisor']?$data['location_supervisor']:'',
                            'field_supervisor_entry_date' => $data['field_supervisor_entry_date']?$data['field_supervisor_entry_date']:'',
                            'no_of_package' => $data['no_of_package_field_supervisor']?$data['no_of_package_field_supervisor']:'',
                            'remarks' => $data['remarks']?$data['remarks']:NULL,
                            'area_id' => $data['area']?$data['area']:NULL,
                            'bin_id' => $data['bin']?$data['bin']:NULL,
                            'status' => 3,
                            'out_process_status'=> 3,
                            'updated_at' => now(),
                            'updated_by' => auth()->user()->id
                            );
                            UploadDocuments::where("id", "=",$data['upload_document_id'])->update($update_data_upload_documents);
                            $update_data_consignment_details = array(
                                'report_no' => $data['report_no']?$data['report_no']:'',
                                'carry_in_date' => $data['carry_in_date']?$data['carry_in_date']:'',
                                'container_no' => isset($data['container_no'])?$data['container_no']:NULL,
                                'size' => isset($data['size'])?$data['size']:NULL,
                                'seal_s_no1' => isset($data['seal_s_no1'])?$data['seal_s_no1']:NULL,
                                'commodity' => $data['commodity']?$data['commodity']:'',
                                'material' => $data['material']?$data['material']:'',
                                'uom' => $data['uom']?$data['uom']:'',
                                'seal_s_no2' => $data['seal_s_no2']?$data['seal_s_no2']:'',
                                'qty' => $data['qty']?$data['qty']:'',
                                'lot_no' => $data['lot_no']?$data['lot_no']:'',
                                'location' => $data['location']?$data['location']:'',
                                'updated_at' => now(),
                                'updated_by' => auth()->user()->id
                                );
                                ConsignmentDetails::where("id", "=",$data['consignment_details_id'])->update($update_data_consignment_details);      
              
                                // $update_field_supervisor_entry_out = array(
                                //     'status' => 2,
                                //     'updated_at' => now(),
                                //     'updated_by' => auth()->user()->id
                                //     );
                                //     FieldSUploadDocumentsupervisorEntryOut::where("id", "=",$data['upload_document_id'])->update($update_field_supervisor_entry_out);      
                                DB::commit();
                                Notifications::sendNotification(auth()->user()->user_type,'finance_officer','Stuffing Approval Come By Operation Manager
                                ','','/release-approval-list');
                                UserLog::AddLog('Container Stuffing approval By');
            return redirect()->route('stuffing.approval.list')->with('create', ' Stuffing Approval successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            return redirect()->route('stuffing.approval.list')->with('create',$e->getMessage());
        }
        return redirect()->route('stuffing.approval.list')->with('create', 'Stuffing Approval successfully!');
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
        $areas = Area::getAllAreaById($gate_entry->location);
        $bins = Bin::getAllBinById($gate_entry->area_id);

        $consignment_details_count = ConsignmentDetails::getGateEntryNo($gate_entry->manifesto_entry_id);
         return view('stuffing_approval.show')->with('gate_entry',$gate_entry)->with('consignment_details_count',$consignment_details_count)
         ->with('locations',$locations) ->with('commodity',$commodity)
         ->with('materials',$materials)->with('uoms',$uoms)
         ->with('consignments',$consignments)->with('agents',$agents)
         ->with('customers',$customers)
         ->with('cargos',$cargos)
         ->with('areas',$areas)
         ->with('bins',$bins);
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
