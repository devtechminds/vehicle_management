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
use App\Notifications;
use DB;
use App\UserLog;
class GateEntryOfficerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_ref_no = ManifestoEntry::getAllRefNo();
        return view('gate_entry_officer.index')->with('all_ref_no',$all_ref_no);
    }


    public function vehilceList(Request $request){
        
        $manifesto_entry_data = ManifestoEntry::with('getConsignment','getCargo');
        if($request->status)
        {
            
            $manifesto_entry_data->where('status','=',$request->status);
        }else{
            $manifesto_entry_data->where('status','=',2);
        }
        if(isset($request->created_date))
        {
            $created_date = date('Y-m-d',strtotime($request->created_date));
            $manifesto_entry_data->whereDate('created_at',$created_date);
        }
        if($request->ref_no)
        {
            $manifesto_entry_data->where('ref_no','=',$request->ref_no);
        }
        
        $manifesto_entry_data_list = $manifesto_entry_data->get();
        return datatables()->of($manifesto_entry_data_list)
            ->addColumn('action', function ($manifesto_entry_data_list) {
                $return_action = '<a href="' . route('vehilce.in.show',base64_encode($manifesto_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
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
                return  str_replace('_',' ',ucwords($row->getCargo->cargo_name));
            })
            ->editColumn('consignment_count', function($row){

                return  ConsignmentDetails::where('manifesto_entry_id','=',$row->id)->count();
            })
            ->editColumn('pending_consignment_count', function($row){

                return  ConsignmentDetails::where('manifesto_entry_id','=',$row->id)->where('status','=',0)->count();
            })
            ->editColumn('truck_number', function($row){

                 $consignment_details = ConsignmentDetails::where('manifesto_entry_id','=',$row->id)->get();
                if(count($consignment_details)>0){
                   $truck_no =array();
                  foreach($consignment_details as $key=>$consignment_detail){
                    
                    if(isset($consignment_detail->truck_no)){
                        $no = $key +1 ."] ".ucfirst($consignment_detail->truck_no);
                        array_push($truck_no,$no);
                   }
                  }
                 
                  return implode(" ",$truck_no);
                }else{
                     return ' ';
                }
                 
                })
            ->rawColumns(['cargo_type','truck_number','action'])
            ->make(true);
    }

    public function vehilceListdashboard(Request $request){
        $manifesto_entry_data = ManifestoEntry::with('getConsignment','getCargo');
        if($request->status)
        {
            $serch_status= 1;
            if($request->status==2){
                $serch_status = 0;
            }
            $manifesto_entry_data->where('status','=',$serch_status);
        }
        if(isset($request->created_date))
        {
            $created_date = date('Y-m-d',strtotime($request->created_date));
            $manifesto_entry_data->whereDate('created_at',$created_date);
        }
        if($request->ref_no)
        {
            $manifesto_entry_data->where('ref_no','=',$request->ref_no);
        }
        $manifesto_entry_data->where('status','=',2);
        $manifesto_entry_data->orderBy('id','asc');
        $manifesto_entry_data_list = $manifesto_entry_data->get();
        return datatables()->of($manifesto_entry_data_list)
            ->addColumn('action', function ($manifesto_entry_data_list) {
                $return_action = '<a href="' . route('vehilce.in.show',base64_encode($manifesto_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
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
                return  str_replace('_',' ',ucwords($row->getCargo->cargo_name));
            })
            ->editColumn('consignment_count', function($row){

                return  ConsignmentDetails::where('manifesto_entry_id','=',$row->id)->count();
            })
            ->editColumn('pending_consignment_count', function($row){

                return  ConsignmentDetails::where('manifesto_entry_id','=',$row->id)->where('status','=',0)->count();
            })
            ->rawColumns(['cargo_type','action'])
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
            'gate_entry_no' => 'required|string',
            'initiated_by' => 'required',
            'interchange_no' => 'required',
            'time_in' => 'required',
            'destination' => 'required',
            'shipping_line' => 'required',
           
        ]);
      if($validatedData){
        try {
            DB::beginTransaction();
            $data = $request->all();  
            // echo "<pre>";
            // print_r($data);die;
            $gate_entry = new GateEntry();
            $gate_entry->gate_entry_no = $data['gate_entry_no']?$data['gate_entry_no']:'';
            $gate_entry->manifesto_entry_id= $data['id'];
            $gate_entry->initiated_by = $data['initiated_by']?$data['initiated_by']:'';
            $gate_entry->interchange_no = $data['interchange_no']?$data['interchange_no']:'';
            $gate_entry->time_in = $data['time_in']?$data['time_in']:'';
            $gate_entry->destination = $data['destination']?$data['destination']:'';
            $gate_entry->shipping_line = $data['shipping_line']?$data['shipping_line']:'';
            $gate_entry->shipping_line = $data['shipping_line']?$data['shipping_line']:'';
            $gate_entry->created_at = now();
            $gate_entry->created_by = auth()->user()->id;
            $gate_entry->updated_by = auth()->user()->id;
            $gate_entry->consignment_details_id = $data['check'];
            $gate_entry->save();
            $update_data =array(
                'status'=>1,
                'transporter' => isset($data['transporter'][$data['check']])?$data['transporter'][$data['check']]:'',
                'updated_at' => now(),
                'updated_by' => auth()->user()->id
                );
                ConsignmentDetails::where("id", "=",$data['check'])->update($update_data);
              //  echo $data['id'];
               $pendig_consignment= ConsignmentDetails::where(["manifesto_entry_id"=>$data['id'],"status" =>0])->count();
               if($pendig_consignment<1){
                ManifestoEntry::where("id", "=",$data['id'])->update(array('status'=>3));
               }
           
                DB::commit();
                Notifications::sendNotification(auth()->user()->user_type,'cfs_gate_officer','Gate1 Entry Officer Vehicle in Register Added','','/authorize-vehicle-in');
                UserLog::AddLog('Gate1 Entry Officer Vehicle in Register Added By');
                return redirect()->route('vehilce.in.register.index')->with('create', ' Added successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->route('vehilce.in.show')->with('create',$e->getMessage());
            
        }

        return redirect()->route('vehilce.in.register.index')->with('create', 'Customer Added successfully!');
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
        
        $manifestoEntry = ManifestoEntry::with('getConsignment','getCargo','getCustomers','getAgent','getConsignmentDetails','getConsignmentDetails.getCommodity','getConsignmentDetails.getMaterial','getConsignmentDetails.getUOM')
        ->where("id", "=", base64_decode($id))
        ->first();
         $transports =  Transports::getTransports();
         $gate_entry_no = GateEntry::getGateEntryNo(); 
        return view('gate_entry_officer.show')->with('manifestoEntry',$manifestoEntry)->with('gate_entry_no',$gate_entry_no)->with('transports',$transports);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function proceedVehilcePrint($id)
    {
        $gate_entry = GateEntry::with('getManifestoEntry','getConsignmentDetails','getConsignmentDetails.getUOM','getConsignmentDetails.getMaterial','getConsignmentDetails.getCommodity','getManifestoEntry.getConsignment','getManifestoEntry.getCargo','getManifestoEntry.getCustomers','getManifestoEntry.getAgent','getConsignmentDetails.getTransports')
        ->where("id", "=", base64_decode($id))
        ->first();
        if($gate_entry)  {
         UserLog::AddLog('Gate1 Entry Officer Vehicle In Print By');   
         $consignment_details_count= ConsignmentDetails::getGateEntryNo($gate_entry->manifesto_entry_id);
        }
         // return view('proceed_vehilce.print_proceed_vehilce')->with('gate_entry',$gate_entry)->with('consignment_details_count',$consignment_details_count)->with('msg','Main Gate1 Entry Proceed ');
          return view('proceed_vehilce.print_proceed_vehilce_new')->with('gate_entry',$gate_entry)->with('consignment_details_count',$consignment_details_count)->with('msg','Main Gate1 Entry Proceed ');
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
    public function vehilceIndex()
    {
        return view('proceed_vehilce.index');
    }
   
     public function proceedVehilceList(Request $request){
        $gate_entry_data = GateEntry::with('getManifestoEntry','getConsignmentDetails','getManifestoEntry.getConsignment','getManifestoEntry.getCargo');
        if($request->status)
        {
            $gate_entry_data->where('status','=',$request->status);
            $gate_entry_data->orWhere('status',3);
        }else{
            $gate_entry_data->where('status','=',1);
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
                $return_action = '<a href="' . route('proceed.form.gate',base64_encode($gate_entry_data_list->id)) . '"  class="btn btn-info " title="View details">
                
                Proceed
                
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

     public function proceedVehilceListDashboard(Request $request){
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
            $gate_entry_data->whereDate('created_at',$created_date);
        }
        if(isset($request->gate_entry_no))
        {
            
            $gate_entry_data->where('gate_entry_no',$request->gate_entry_no);
        }
        $gate_entry_data->where('status','=',1);
        $gate_entry_data_list = $gate_entry_data->get();
        return datatables()->of($gate_entry_data_list)
            ->addColumn('action', function ($gate_entry_data_list) {
                $return_action = '<a href="' . route('proceed.form.gate',base64_encode($gate_entry_data_list->id)) . '"  class="btn btn-info " title="View details">
                
                Proceed
                
                </a>';
            return $return_action;
            })
            // ->editColumn('cargo_type', function($row){
            //     return  str_replace('_',' ',ucwords($row->getCargo->cargo_name));
            // })
            // ->rawColumns(['cargo_type','action'])
           
            ->make(true);

     }

     public function proceedVehilceShow($id){
        
        $gate_entry = GateEntry::with('getManifestoEntry','getConsignmentDetails','getConsignmentDetails.getUOM','getConsignmentDetails.getMaterial','getConsignmentDetails.getCommodity','getManifestoEntry.getConsignment','getManifestoEntry.getCargo','getManifestoEntry.getCustomers','getManifestoEntry.getAgent')
        ->where("id", "=", base64_decode($id))
        ->first();
        // echo "<pre>";
        // print_r($gate_entry);die;
        if($gate_entry)  {
         $consignment_details_count= ConsignmentDetails::getGateEntryNo($gate_entry->manifesto_entry_id);
        }
         // echo "<pre>";
        // print_r($gate_entry->getConsignmentDetails);die;
         return view('proceed_vehilce.show')->with('gate_entry',$gate_entry)->with('consignment_details_count',$consignment_details_count);
     }

     public function proceedVehilceSubmit(Request $request){
      
   if($request->action =='Proceed'){
       
        $validatedData = $request->validate([
            'gate_entry_id' => 'required',
        ]);
      if($validatedData){
        try {
            DB::beginTransaction();
            $data = $request->all();  
            $update_data =array(
                'status'=>2,
                'updated_at' => now(),
                'updated_by' => auth()->user()->id
                );
                GateEntry::where("id", "=",$data['gate_entry_id'])->update($update_data);
                DB::commit();
                Notifications::sendNotification(auth()->user()->user_type,'weigh_bridge_officer','Proceed Vehilce Added ','','/weigh-bridge-entry');
                UserLog::AddLog('Proceed Vehilce Added By ');
                return redirect()->route('proceed.vehilce')->with('create', ' Proceed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            return redirect()->route('authorize.vehicle')->with('create',$e->getMessage());
            
        }

        return redirect()->route('proceed.vehilce')->with('create', 'Proceed  successfully!');
      }
   }else{
            $gate_entry = GateEntry::with('getManifestoEntry','getConsignmentDetails','getConsignmentDetails.getUOM','getConsignmentDetails.getMaterial','getConsignmentDetails.getCommodity','getManifestoEntry.getConsignment','getManifestoEntry.getCargo','getManifestoEntry.getCustomers','getManifestoEntry.getAgent')
            ->where("id", "=", $request->gate_entry_id)
            ->first();
            return view('proceed_vehilce.print_proceed_vehilce',compact('gate_entry'));
           
   }

     }
    
}
