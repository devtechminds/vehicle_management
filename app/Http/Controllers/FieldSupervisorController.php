<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GateEntry;
use App\WeighBridge;
use App\UploadDocuments;
use App\Location;
use App\ConsignmentDetails;
use App\UploadDocumentsFiles;
use App\Notifications;
use App\UserLog;
use DB;
class FieldSupervisorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('field_supervisor.index'); 
    }


    public function supervisorEntryList(Request $request){
        $gate_entry_data = WeighBridge::with('getManifestoEntry','getConsignmentDetails','getManifestoEntry.getConsignment','getManifestoEntry.getCargo','getGateEntry');
            if($request->status)
            {
                $serch_status= 1;
                if($request->status==2){
                    $serch_status = 0;
                }
                $gate_entry_data->where('status','=',$serch_status);
            }else{
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
                    $return_action = '<a href="' . route('supervisor.doc.upload',base64_encode($gate_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
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

        public function dashboard(Request $request){
            $gate_entry_data = WeighBridge::with('getManifestoEntry','getConsignmentDetails','getManifestoEntry.getConsignment','getManifestoEntry.getCargo','getGateEntry');
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
                        $return_action = '<a href="' . route('supervisor.doc.upload',base64_encode($gate_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
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
            'field_supervisor_name' => 'required',
            'container_physical_status' => 'required',
            'location' => 'required',
            'area' => 'required',
            'bin' => 'required',
            'no_of_package' => 'required',
            'file_upload' => 'required',
            'remarks' => 'required',
        ]);
      if($validatedData){
        try {
            DB::beginTransaction();
            $data = $request->all(); 
            $upload_documents = new UploadDocuments();
            $upload_documents->manifesto_entry_id = $data['manifesto_entry_id']?$data['manifesto_entry_id']:'';
            $upload_documents->gate_entry_id = $data['gate_entry_id']?$data['gate_entry_id']:'';
            $upload_documents->consignment_details_id = $data['consignment_details_id']?$data['consignment_details_id']:'';
            $upload_documents->weigh_bridges_id = $data['weigh_bridges_id']?$data['weigh_bridges_id']:'';
            $upload_documents->field_supervisor_name = $data['field_supervisor_name']?$data['field_supervisor_name']:NULL;
            $upload_documents->container_physical_status = $data['container_physical_status']?$data['container_physical_status']:NULL;
            $upload_documents->location = $data['location']?$data['location']:NULL;
           // $upload_documents->field_supervisor_entry_date = $data['field_supervisor_entry_date']?$data['field_supervisor_entry_date']:NULL;
            $upload_documents->field_supervisor_entry_date = date('Y-m-d');
            $upload_documents->no_of_package = $data['no_of_package']?$data['no_of_package']:NULL;
            $upload_documents->remarks = $data['remarks']?$data['remarks']:'';
            $upload_documents->file_upload = 'na';
            $upload_documents->area_id = $data['area']?$data['area']:'';
            $upload_documents->bin_id = $data['bin']?$data['bin']:'';
            $upload_documents->created_at = now();
            $upload_documents->updated_at = now();
            $upload_documents->created_by = auth()->user()->id;
            $upload_documents->updated_by = auth()->user()->id;
            $upload_documents->save();
            if (isset($data['file_upload'])) {
                foreach($data['file_upload'] as $upload_data){
                // Upload blog image
                $file_original_name = $upload_data->getClientOriginalName();
                // $fileName = time() . '-' . $file_original_name;
                $ext = $upload_data->getClientOriginalExtension();
                $fileName = time() . '-' . rand(100000,999999).".".$ext;
                $image_path = $upload_data->storeAs('uploads' . '/', $fileName);
                $upload_documents_files =new UploadDocumentsFiles();
                $upload_documents_files->upload_documents_id = $upload_documents->id;
                $upload_documents_files->document = $fileName;
                $upload_documents_files->save();
              } 
            }
            $update_data =array(
                'status'=>1,
                'updated_at' => now(),
                'updated_by' => auth()->user()->id
                );
                WeighBridge::where("id", "=",$data['weigh_bridges_id'])->update($update_data);
                Notifications::sendNotification(auth()->user()->user_type,'weigh_bridge_officer','Upload Documents Added Field Supervisor
                ','','/weigh-bridge-exit');
                UserLog::AddLog('Field Supervisor Upload Documents Added By');
                DB::commit();
          
            return redirect()->route('supervisor.doc.upload.entry')->with('create', ' Document Uploaded Successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            return redirect()->route('supervisor.doc.upload.entry')->with('create',$e->getMessage());
            
        }

        return redirect()->route('supervisor.doc.upload.entry')->with('create', ' Document Uploaded Successfully.');
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
        //$gate_entry = GateEntry::with('getManifestoEntry','getConsignmentDetails','getConsignmentDetails.getUOM','getConsignmentDetails.getMaterial','getConsignmentDetails.getCommodity','getManifestoEntry.getConsignment','getManifestoEntry.getCargo','getManifestoEntry.getCustomers','getManifestoEntry.getAgent')
        $gate_entry = WeighBridge::with('getManifestoEntry','getConsignmentDetails','getManifestoEntry.getConsignment','getManifestoEntry.getCargo','getGateEntry')
        ->where("id", "=", base64_decode($id))
        ->first();
         $wb_ticket_no= WeighBridge::getWBTicketNo();
         $locations =Location::getAllLocation();
         $consignment_details_count= ConsignmentDetails::getGateEntryNo($gate_entry->manifesto_entry_id);
         return view('field_supervisor.show')->with('gate_entry',$gate_entry)->with('wb_ticket_no',$wb_ticket_no)->with('locations',$locations)->with('consignment_details_count',$consignment_details_count);
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
