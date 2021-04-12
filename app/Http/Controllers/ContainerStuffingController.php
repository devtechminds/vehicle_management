<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UploadDocuments;
use App\ConsignmentDetails;
use App\ManifestoEntry;
use App\GateEntry;
use App\WeighBridge;
use DB;
use App\Location;
use App\Commodity;
use App\Material;
use App\UOM;
use App\Consignment;
use App\Cargo;
use App\Area;
use App\Notifications;
use App\FieldSupervisorEntryOut;
use App\UserLog;
class ContainerStuffingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
     
        if($request->ajax()){
            $gate_entry_data = UploadDocuments::whereHas('getManifestoEntry', function($where){ 
                $where->whereNotIn('cargo_type',[4,8,10,11]);
             })->with('getGateEntry','getManifestoEntry.getCargo','getManifestoEntry.getConsignment','getConsignmentDetails');
            
            
            if($request->status)
            {
                $serch_status= 1;
                if($request->status==2){
                    $serch_status = 0;
                }
                $gate_entry_data->where('out_process_status','=',$serch_status);
            }else{
                $gate_entry_data->where('out_process_status','=',0);
            }
            if(isset($request->created_date))
            {
                $created_date = date('Y-m-d',strtotime($request->created_date));
                $gate_entry_data->whereDate('created_at',$created_date);
            }
            
            $gate_entry_data_list = $gate_entry_data->get();
            return datatables()->of($gate_entry_data_list)
                ->addColumn('action', function ($gate_entry_data_list) {
                    $return_action = '<a href="' . route('container.stuffing.show',base64_encode($gate_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
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
                    return view('container_stuffing.index');
                } 
    }
    public function dashboard(Request $request)
    {
       
            $gate_entry_data = UploadDocuments::with('getGateEntry','getManifestoEntry','getManifestoEntry.getCargo','getManifestoEntry.getConsignment','getConsignmentDetails');
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
             $gate_entry_data->where('out_process_status','=',0);
            $gate_entry_data_list = $gate_entry_data->get();
            return datatables()->of($gate_entry_data_list)
                ->addColumn('action', function ($gate_entry_data_list) {
                    $return_action = '<a href="' . route('container.stuffing.show',base64_encode($gate_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
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
        
        $validatedData = $request->validate([
            'container_tare_wt' => 'required',
            'wb_tare_wt' => 'required',
            //'wb_net_wt' => 'required',
            // 'field_supervisor_name' => 'required',
            // 'container_physical_status' => 'required',
            // 'location' => 'required',
            // 'field_supervisor_entry_date' => 'required',
            // 'no_of_package' => 'required',
            // 'remarks' => 'required',

            'report_no' => 'required',
            'carry_in_date' => 'required',
            'container_no' => 'required',
            'size' => 'required',
            'seal_s_no1' => 'required',
            'commodity' => 'required',
            'material' => 'required',
            'remarks' => 'required',
            'remarks' => 'required',
            
        ]);
      if($validatedData){
        try {
            DB::beginTransaction();
            $data = $request->all(); 
            //echo "<pre>"; 
            //print_r($data);die;
            $update_data =array(
                'wb_gross_wt' => (int)$data['wb_gross_wt'],
                'container_tare_wt' => (int)$data['container_tare_wt'],
                'wb_tare_wt' => (int)$data['wb_tare_wt'],
                'wb_net_wt' => (int)$data['wb_net_wt'],
                'updated_at' => now(),
                'updated_by' => auth()->user()->id
                );
                if($data['consignment_type_id'] ==3){
                    $update_manifesto_entry_data =array(
                        'consignment_type' => $data['consignment_type']?$data['consignment_type']:'',
                        'cargo_type' => explode("/",$data['cargo_type'])[1],
                        'cargo_reference_no' => isset($data['cargo_reference_no'])? $data['cargo_reference_no']:'',
                        'updated_at' => now(),
                        'updated_by' => auth()->user()->id
                        );
                    $update_gate_entry_data =array(
                            'destination' => isset($data['destination'])?$data['destination']:'',
                            'updated_at' => now(),
                            'updated_by' => auth()->user()->id
                        );
                    ManifestoEntry::where("id", "=",$data['manifesto_entry_id'])->update($update_manifesto_entry_data);
                    GateEntry::where("id", "=",$data['gate_entry_id'])->update($update_gate_entry_data);
                }
              
                WeighBridge::where("id", "=",$data['weight_bridge_entry_id'])->update($update_data);
                $update_data_consignment_details =array(
                    'report_no' => $data['report_no']?$data['report_no']:'',
                    'carry_in_date' => $data['carry_in_date']?$data['carry_in_date']:'',
                    'container_no' => (strlen($data['container_no'])>0)?$data['container_no']:'',
                    'size' => (int)$data['size'],
                    'seal_s_no1' => (strlen($data['seal_s_no1'])>0)?$data['seal_s_no1']:'',
                    'commodity' => $data['commodity']?$data['commodity']:'',
                    'material' => $data['material']?$data['material']:'',
                    'uom' => $data['uom']?$data['uom']:NULL,
                    'declared_wgt' => (int)$data['declared_wgt'],
                    'updated_at' => now(),
                    'updated_by' => auth()->user()->id
                    );
                   
                  ConsignmentDetails::where("id", "=",$data['consignment_details_id'])->update($update_data_consignment_details);
                  UploadDocuments::where("id", "=",$data['upload_documents_id'])->update(array('out_process_status'=>1,'bin_id' => $data['bin']?$data['bin']:''));
                //   $field_supervisor_entry_out = new FieldSupervisorEntryOut();
                //   $field_supervisor_entry_out->manifesto_entry_id = $data['manifesto_entry_id']?$data['manifesto_entry_id']:'';
                //   $field_supervisor_entry_out->gate_entry_id = $data['gate_entry_id']?$data['gate_entry_id']:'';
                //   $field_supervisor_entry_out->weigh_bridges_id = $data['weight_bridge_entry_id']?$data['weight_bridge_entry_id']:'';
                //   $field_supervisor_entry_out->consignment_details_id = $data['consignment_details_id']?$data['consignment_details_id']:'';
                //   $field_supervisor_entry_out->field_supervisor_name = $data['field_supervisor_name']?$data['field_supervisor_name']:'';
                //   $field_supervisor_entry_out->container_physical_status = $data['container_physical_status']?$data['container_physical_status']:'';
                //   $field_supervisor_entry_out->location = $data['location']?$data['location']:'';
                //   $field_supervisor_entry_out->field_supervisor_entry_date = $data['field_supervisor_entry_date']?$data['field_supervisor_entry_date']:'';
                //   $field_supervisor_entry_out->no_of_package = $data['no_of_package']?$data['no_of_package']:'';
                //   $field_supervisor_entry_out->remarks = $data['remarks']?$data['remarks']:'';
                //   $field_supervisor_entry_out->area_id = $data['area']?$data['area']:'';
                //   $field_supervisor_entry_out->bin_id = $data['bin']?$data['bin']:'';
                //   $field_supervisor_entry_out->created_by = auth()->user()->id;
                //   $field_supervisor_entry_out->updated_by = auth()->user()->id;
                //   $field_supervisor_entry_out->save();
                 DB::commit();
                 Notifications::sendNotification(auth()->user()->user_type,'field_supervisor','Field Supervisor Entry Come For Container stuffing update','','/weigh-bridge-entry');
                 UserLog::AddLog('Container Stuffing Saved By');

            return redirect()->route('container.stuffing.list')->with('create', ' Container Stuffing
             Added successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            return redirect()->route('container.stuffing.show')->with('create',$e->getMessage());
        }
        return redirect()->route('container.stuffing.list')->with('create', 'Container Stuffing
        Added successfully!');
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
       
        $gate_entry = UploadDocuments::with('getGateEntry','getManifestoEntry','getManifestoEntry.getCargo','getManifestoEntry.getConsignment','getConsignmentDetails','getWeighBridge','getLocation','getUploadDocumentsFiles','getAllUploadDocumentsFiles')
        ->where("id", "=", base64_decode($id))
        ->first();
    
        $locations = Location::getAllLocation();
        $commodity = Commodity::getCommodity();
        $materials = Material::getAllMaterial();
        $uoms = UOM::getAllUOM();
        $consignments = Consignment::getAllConsignment();
        $cargos = Cargo::getCargoTypeByType($gate_entry->getManifestoEntry->getConsignment->consignment_type);

          $areas = Area::getAllAreaById($gate_entry->location);
        //echo "<pre>";
        //print_r($cargos);die;
         $consignment_details_count = ConsignmentDetails::getGateEntryNo($gate_entry->manifesto_entry_id);
         return view('container_stuffing.show')->with('gate_entry',$gate_entry)->with('consignment_details_count',$consignment_details_count)
         ->with('locations',$locations) ->with('commodity',$commodity)
         ->with('materials',$materials)->with('uoms',$uoms)->with('areas',$areas) ->with('consignments',$consignments)->with('cargos',$cargos);
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
