<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Consignment;
use App\Cargo;
use App\Customers;
use App\EtcAgent;
use App\Commodity;
use App\Material;
use App\UOM;
use App\ManifestoEntry;
use App\ConsignmentDetails;
use App\GateEntry;
use App\Transports;
use App\Location;
use App\WeighBridge;
use App\UploadDocuments;
use App\Notifications;
use DB;
use App\UserLog;

class AdminUpdateController extends Controller
{
    //

    public function entryIndex()
    {
        return view('admin_update.index');
    }

    public function proceedEntryList(Request $request){
        $gate_entry_data = GateEntry::with('getManifestoEntry','getConsignmentDetails','getManifestoEntry.getConsignment','getManifestoEntry.getCargo');
        if($request->status)
        {
            $gate_entry_data->where('status','=',$request->status);
            $gate_entry_data->orWhere('status',3);
        }else{
            $gate_entry_data->where('status','=',0);
            $gate_entry_data->orWhere('status',1);
            $gate_entry_data->orWhere('status',2);
            $gate_entry_data->orWhere('status',3);
        }
        if(isset($request->created_date))
        {
            $created_date = date('Y-m-d',strtotime($request->created_date));
            $gate_entry_data->whereDate('created_at',$created_date);
        }
        if(isset($request->gate_entry_no))
        {
            
            $gate_entry_data->where('gate_entry_no',$request->gate_entry_no);
        }
        
        $gate_entry_data_list = $gate_entry_data->get();
        
        return datatables()->of($gate_entry_data_list)
            ->addColumn('action', function ($gate_entry_data_list) {
                $return_action = '<a href="' . route('update.entry.show',base64_encode($gate_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
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
            ->editColumn('ref_no', function($row){
              if(isset($row->getManifestoEntry->ref_no)){
                  return $row->getManifestoEntry->ref_no;
              }
               else{
                   return "__";
               }
               
            })
            ->editColumn('cargo_reference_no', function($row){
                if(isset($row->getManifestoEntry->cargo_reference_no)){
                    return $row->getManifestoEntry->cargo_reference_no;
                }
                 else{
                     return "__";
                 }
                 
              })
              ->editColumn('container_no', function($row){
                if(isset($row->getConsignmentDetails->container_no)){
                    return $row->getConsignmentDetails->container_no;
                }
                 else{
                     return "__";
                 }
                 
              })
              ->editColumn('truck_no', function($row){
                if(isset($row->getConsignmentDetails->truck_no)){
                    return $row->getConsignmentDetails->truck_no;
                }
                 else{
                     return "__";
                 }
                 
              })
              ->editColumn('trailer_no', function($row){
                if(isset($row->getConsignmentDetails->trailer_no)){
                    return $row->getConsignmentDetails->trailer_no;
                }
                 else{
                     return "__";
                 }
                 
              })
            ->rawColumns(['ref_no','cargo_reference_no','container_no','truck_no','trailer_no','action'])
           
            ->make(true);

     }

     public function proceedEntryShow($id){
         
        $gate_entry = GateEntry::with('getManifestoEntry','getConsignmentDetails','weighBridges','getConsignmentDetails.getUOM','getConsignmentDetails.getMaterial','getConsignmentDetails.getCommodity','getManifestoEntry.getConsignment','getManifestoEntry.getCargo','getManifestoEntry.getCustomers','getManifestoEntry.getAgent')
        ->where("id", "=", base64_decode($id))
        ->first();
        // echo "<pre>";
        // print_r($gate_entry);die;
        if($gate_entry)  {
         $consignment_details_count= ConsignmentDetails::getGateEntryNo($gate_entry->manifesto_entry_id);
        }
        //$weigh_bridge_entry = WeighBridge::with('getGateEntry')->where("gate_entry_id", "=", base64_decode($id))->first();
        $upload_document_entry=UploadDocuments::with('getGateEntry')->where("gate_entry_id", "=", base64_decode($id))->first();
        //echo "<pre>";
        //print_r($upload_document_entry);die;
        $consignments = Consignment::getAllConsignment();
        $cargos = Cargo::getCargoTypeByType($gate_entry->getManifestoEntry->getConsignment->consignment_type);
        $customers = Customers::getAllCustomers();
        $customers = Customers::getAllCustomers();
        $agents = EtcAgent::getAllAgents();
        $commodity = Commodity::getCommodity();
        $materials = Material::getAllMaterial();
        $uoms = UOM::getAllUOM();
        $locations = Location::getAllLocation();
        $gate_pass_no= ManifestoEntry::getGatePassNo();
        $transports =  Transports::getTransports();
         // echo "<pre>";
        // print_r($gate_entry->getConsignmentDetails);die;
         return view('admin_update.show')->with('gate_entry',$gate_entry)->with('consignment_details_count',$consignment_details_count)
         ->with('consignments',$consignments)->with('cargos',$cargos)
         ->with('agents',$agents)->with('customers',$customers)
         ->with('locations',$locations)->with('commodity',$commodity)
         ->with('materials',$materials)->with('uoms',$uoms)
         ->with('gate_pass_no',$gate_pass_no)
         ->with('transports',$transports)
         ->with('upload_document_entry',$upload_document_entry);
         
     }



     public function store(Request $request)
     {
       
         $validatedData = $request->validate([
             'ref_no' => 'required',
             'date' => 'required',
             'consignment_type' => 'required',
            // 'cargo_reference_no' => 'required',
             'cargo_type' => 'required',
             // 'delivery_note_no' => 'required',
             // 'no_package' => 'required',
           //  'booking_no' => 'required',
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
             // 'declared_wgt' => 'required',
             // 'truck_no' => 'required',
             // 'trailer_no' => 'required',
             // 'driver_name' => 'required',
             // 'driver_lic_no' => 'required',
             //'transporter' => 'required',
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
                 'no_package' => isset($data['no_package'])?$data['no_package']:NULL,
                 'interchange_no' => $data['interchange_no']?$data['interchange_no']:'',
                 'destination' => $data['destination']?$data['destination']:'',
                 'shipping_line' => $data['shipping_line']?$data['shipping_line']:'',
                 'gate_pass_no' => $data['gate_pass_no']?$data['gate_pass_no']:'',
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
                     if(!empty($data['weight_bridge_entry_id'])){
                        $update_data_Weigh_bridge=array(
                            'wb_ticket_no' => $data['wb_ticket_no']?$data['wb_ticket_no']:NULL,
                            'wb_gross_wt' => $data['initiated_by']?$data['wb_gross_wt']:'',
                            'container_tare_wt' => $data['container_tare_wt']?$data['container_tare_wt']:NULL,
                            'wb_tare_wt' => $data['wb_tare_wt']?$data['wb_tare_wt']:NULL,
                            'wb_net_wt' => $data['wb_net_wt']?$data['wb_net_wt']:NULL,
                            'updated_at' => now(),
                            'updated_by' => auth()->user()->id
                            );
                         WeighBridge::where("id", "=",$data['weight_bridge_entry_id'])->update($update_data_Weigh_bridge);
                        }
                        if(!empty($data['document_upload_id'])){
                         $update_data_upload_documents = array(
                             'field_supervisor_name' => $data['field_supervisor_name']?$data['field_supervisor_name']:'',
                             'container_physical_status' => $data['container_physical_status']?$data['container_physical_status']:'',
                             'location' => $data['location']?$data['location']:'',
                             'field_supervisor_entry_date' => $data['field_supervisor_entry_date']?$data['field_supervisor_entry_date']:'',
                             'no_of_package' => $data['no_of_package_field_supervisor']?$data['no_of_package_field_supervisor']:'',
                             'remarks' => $data['remarks']?$data['remarks']:'',
                             'out_process_status'=>0,
                             'updated_at' => now(),
                             'updated_by' => auth()->user()->id
                             );
                             UploadDocuments::where("id", "=",$data['document_upload_id'])->update($update_data_upload_documents);
                            }
                             $update_data_consignment_details = array(
                                 'report_no' => $data['report_no']?$data['report_no']:'',
                                 'carry_in_date' => $data['carry_in_date']?$data['carry_in_date']:'',
                                 'container_no' => isset($data['container_no'])?$data['container_no']:NULL,
                                 'size' => isset($data['size'])?$data['size']:NULL,
                                 'seal_s_no1' => isset($data['seal_s_no1'])?$data['seal_s_no1']:NULL,
                                 'commodity' => $data['commodity']?$data['commodity']:'',
                                 'material' => $data['material']?$data['material']:'',
                                 'uom' => $data['uom']?$data['uom']:NULL,
                                 'declared_wgt' => $data['declared_wgt']?$data['declared_wgt']:'',
                                 'truck_no' => $data['truck_no']?$data['truck_no']:'',
                                 'trailer_no' => $data['trailer_no']?$data['trailer_no']:'',
                                 'driver_name' => $data['driver_name']?$data['driver_name']:'',
                                 'driver_lic_no' => $data['driver_lic_no']?$data['driver_lic_no']:'',
                                // 'driver_ph_no' => $data['driver_ph_no']?$data['driver_ph_no']:'',
                                // 'chasis_no' => $data['chasis_no']?$data['chasis_no']:'',
                                 'transporter' => $data['transporter']?$data['transporter']:'',
                                
                                 'updated_at' => now(),
                                 'updated_by' => auth()->user()->id
                                 );
                                 ConsignmentDetails::where("id", "=",$data['consignment_details_id'])->update($update_data_consignment_details);      
                                 UserLog::AddLog('Vehicle Entry Updated By ');
                                 DB::commit();
 
                
             return redirect()->route('update.entry')->with('create', ' Authorized successfully!');
         } catch (\Exception $e) {
             DB::rollBack();
             return $e->getMessage();
             return redirect()->route('update.entry')->with('create',$e->getMessage());
         }
         return redirect()->route('update.entry')->with('create', 'Authorized successfully!');
       }
 
 
     }


}
