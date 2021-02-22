<?php
namespace App\Http\Controllers;

use DB;
use App\Bin;
use App\UOM;
use App\Area;
use App\Cargo;
use App\UserLog;
use App\EtcAgent;
use App\Material;
use App\Commodity;
use App\Customers;
use App\Consignment;
use App\Notifications;
use App\ManifestoEntry;
use App\ConsignmentDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManifestoEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_ref_no = ManifestoEntry::getAllRefNo();
        return view('manifesto.index')->with('all_ref_no',$all_ref_no);
    }



    public function manifestoList(Request $request){
        $manifesto_entry_data = ManifestoEntry::with('getConsignment','getCargo');
        if($request->status)
        {
            $serch_status= 1;
            if($request->status==2){
                $serch_status = 0;
            }
            $manifesto_entry_data->where('status','=',$serch_status);
            if($request->status==3){
                $manifesto_entry_data->where('status','=',$request->status);
                $manifesto_entry_data->Orwhere('status','=',$request->status);
            }
        }
        if($request->ref_no)
        {
            $manifesto_entry_data->where('ref_no','=',$request->ref_no);
        }
        if(isset($request->created_date))
        {
            $created_date = date('Y-m-d',strtotime($request->created_date));
            $manifesto_entry_data->whereDate('created_at',$created_date);
        }
        $manifesto_entry_data_list = $manifesto_entry_data->get();
        $user = Auth::user();
        $user_type = explode(',',$user->user_type);
        return datatables()->of($manifesto_entry_data_list)
            ->addColumn('action', function ($manifesto_entry_data_list) use($user_type) {
                $return_action = '<a href="' . route('manifesto.show',base64_encode($manifesto_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
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
             if($manifesto_entry_data_list->status==0 || $manifesto_entry_data_list->status==10 || in_array("admin", $user_type)){
                $return_action .= '<a href="' . route('manifesto.edit',base64_encode($manifesto_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="Update details">
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
             }
            return $return_action;
            })
            ->editColumn('cargo_type', function($row){
                return  str_replace('_',' ',ucwords($row->getCargo->cargo_name));
            })
            ->editColumn('consignment_count', function($row){

                return  ConsignmentDetails::where('manifesto_entry_id','=',$row->id)->count();
            })
            ->editColumn('status', function($row){
                 $status= '';
                 if($row->status==0){
                    $status="Pending";
                }elseif($row->status==2 || $row->status==3){
                    $status="Approve";
                }elseif($row->status==10){
                    $status="Rejected";
                }
              return $status;

            })
            ->rawColumns(['cargo_type','action'])
            ->make(true);
    }

    public function manifestoListByOrder(Request $request){
        $manifesto_entry_data = ManifestoEntry::with('getConsignment','getCargo');
        if($request->status)
        {
            $serch_status= 1;
            if($request->status==2){
                $serch_status = 0;
            }
            $manifesto_entry_data->where('status','=',$serch_status);
        }
        if($request->ref_no)
        {
            $manifesto_entry_data->where('ref_no','=',$request->ref_no);
        }
        if(isset($request->created_date))
        {
            $created_date = date('Y-m-d',strtotime($request->created_date));
            $manifesto_entry_data->whereDate('created_at',$created_date);
        }
        $manifesto_entry_data->orderBy('id', 'ASC');;
        if(auth()->user()->user_type == 'finance_officer'){
            $manifesto_entry_data->where('status','=',0);
        }
        $manifesto_entry_data_list = $manifesto_entry_data->get();
        return datatables()->of($manifesto_entry_data_list)
            ->addColumn('action', function ($manifesto_entry_data_list) {
                $return_action = '<a href="' . route('manifesto.show',base64_encode($manifesto_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
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
            ->editColumn('status', function($row){
                 $status= '';
                 if($row->status==0){
                    $status="Pending";
                }elseif($row->status==2 || $row->status==3){
                    $status="Approve";
                }elseif($row->status==10){
                    $status="Rejected";
                }
              return $status;

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
        $consignments = Consignment::getAllConsignment();
        $cargos = Cargo::getAllCargo();
        $customers = Customers::getAllCustomers();
        $agents = EtcAgent::getAllAgents();
        $commodity = Commodity::getCommodity();
        $materials = Material::getAllMaterial();
        $uoms = UOM::getAllUOM();
        $ref_no= ManifestoEntry::getRefNo();
        return view('manifesto.create')->with('consignments',$consignments)->with('cargos',$cargos)
         ->with('customers',$customers)->with('agents',$agents)
         ->with('commodity',$commodity)->with('ref_no',$ref_no)
         ->with('materials',$materials)->with('uoms',$uoms);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //   echo "<pre>";
        //   print_r($request->all());die;  
        $validatedData = $request->validate([
            'ref_no' => 'required|string',
            'date' => 'required',
            'consignment_type' => 'required|string',
            'cargo_type' => 'required',
            //'booking_no' => 'required',
            'customer_name' => 'required',
            'cf_agent' => 'required',
            // 'consignment_wgt' => 'required',
            // 'no_package' => 'required',
        ]);
      if($validatedData){
           
        try {
            DB::beginTransaction();
            $data = $request->all();
            
            $consignment_wgt = isset($data['consignment_wgt']) && '' != $data['consignment_wgt']  ? $data['consignment_wgt']:NULL;
            $no_package = isset($data['no_package']) && '' != $data['no_package'] ? $data['no_package']:NULL;
            
            if($data['consignment_type']!='3' && explode("/",$data['cargo_type'])[1]!="9" && $consignment_wgt =='' && $no_package==''){
                return redirect()->route('manifesto.create')->with('error','No of Package and Consignment Weight required.');
            } 
      
            $manifesto_entry = new ManifestoEntry();
            $manifesto_entry->ref_no = $data['ref_no']?$data['ref_no']:'';
            $manifesto_entry->date = $data['date']? date('Y-m-d',strtotime($data['date'])):'';
            $manifesto_entry->cargo_reference_no = $data['cargo_reference_no']? $data['cargo_reference_no']:'';
            $manifesto_entry->ecd_name = $data['ecd_name']? $data['ecd_name']:'';
            $manifesto_entry->consignment_type = $data['consignment_type']?$data['consignment_type']:'';
            $manifesto_entry->delivery_note_no = $data['delivery_note_no']?$data['delivery_note_no']:'';
            $manifesto_entry->no_container = $data['no_container']?$data['no_container']:'';
            $manifesto_entry->interchange_no = 1;
            $manifesto_entry->destination = 1;
            $manifesto_entry->cargo_type =  explode("/",$data['cargo_type'])[1];
            $manifesto_entry->shipping_line =1;
            $manifesto_entry->booking_no = $data['booking_no']?$data['booking_no']:'';
            $manifesto_entry->customer_name = $data['customer_name']?$data['customer_name']:'';
            $manifesto_entry->cf_agent = $data['cf_agent']?$data['cf_agent']:'';
            $manifesto_entry->consignment_wgt = $consignment_wgt;
            $manifesto_entry->no_package = isset($no_package)?$no_package:0;
            $manifesto_entry->created_at = now();
            $manifesto_entry->created_by = auth()->user()->id;
            $manifesto_entry->updated_by =  auth()->user()->id;
            $manifesto_entry->save();
            if(count($data['report_no'])>0){
               foreach($data['report_no'] as $key=>$value){
                $consignment_detail = new ConsignmentDetails();
                $consignment_detail->manifesto_entry_id= $manifesto_entry->id;
                $consignment_detail->report_no= $data['report_no'][$key];
                $consignment_detail->carry_in_date= $data['carry_in_date'][$key];
                $consignment_detail->container_no= isset($data['container_no'][$key])?$data['container_no'][$key]:NULL;
                $consignment_detail->size= isset($data['size'][$key])?$data['size'][$key]:NULL;
                $consignment_detail->seal_s_no1= isset($data['seal_s_no1'][$key])?$data['seal_s_no1'][$key]:NULL;
                $consignment_detail->commodity= $data['commodity'][$key];
                $consignment_detail->material= $data['material'][$key];
                $consignment_detail->uom= $data['uom'][$key];
                $consignment_detail->declared_wgt= $data['declared_wgt'][$key];
                $consignment_detail->truck_no= $data['truck_no'][$key];
                $consignment_detail->trailer_no= $data['trailer_no'][$key];
                $consignment_detail->driver_name= $data['driver_name'][$key];
                $consignment_detail->driver_lic_no= $data['driver_lic_no'][$key];
              
                $consignment_detail->created_by= auth()->user()->id;
                $consignment_detail->updated_by= auth()->user()->id;
                $consignment_detail->save();
               }
            }
            DB::commit();
            //Send Notification
            Notifications::sendNotification(auth()->user()->user_type,'finance_officer','New Manifesto Entry added','','/manifesto-list-finance-officer');
            UserLog::AddLog('New Manifesto Entry Added By');
            return redirect()->route('manifesto.index')->with('create', 'Manifesto Added successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            // return $e->getMessage();
            return redirect()->route('manifesto.create')->with('error',$e->getMessage());
            
        }
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
        
         return view('manifesto.show')->with('manifestoEntry',$manifestoEntry);
    }

    public function cargoTypeChanges($type)
    {
        $html = '<option value="">Select Cargo Type</option>';
        if($type){
           $cargo_types = Cargo::where('type',strtolower($type))->get();
           foreach ($cargo_types as $key => $cargo) {
             $html .= '<option value="'.$cargo->cargo_name.'/'.$cargo->cargo_code.'">'.ucwords( str_replace('_',' ',$cargo['cargo_name'])).'</option>';
           }
        }
        return $html;
    } 

    public function getMaterialByComodity($id)
    {
        $html = '<option value="">Select Material</option>';
        if($id){
           $materials = Material::where('commodity_id',$id)->get();
           foreach ($materials as $key => $material) {
             $html .= '<option value="'.$material->id.'">'.ucwords( str_replace('_',' ',$material['material_name'])) .'</option>';
           }
        }
        return $html;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $manifestoEntry = ManifestoEntry::with('getConsignment','getCargo','getCustomers','getAgent','getConsignmentDetails','getConsignmentDetails.getCommodity','getConsignmentDetails.getMaterial','getConsignmentDetails.getUOM')
        ->where("id", "=", base64_decode($id))
        ->first();
        // echo "<pre>";
        // print_r($manifestoEntry->getConsignmentDetails);die;
        $consignments = Consignment::getAllConsignment();
        $cargos = Cargo::getCargoTypeByType($manifestoEntry->getConsignment->consignment_type);
        $customers = Customers::getAllCustomers();
        $agents = EtcAgent::getAllAgents();
        $commodity = Commodity::getCommodity();
        $materials = Material::getAllMaterial();
        $uoms = UOM::getAllUOM();
  
         return view('manifesto.update')->with('manifestoEntry',$manifestoEntry)
         ->with('consignments',$consignments)
         ->with('cargos',$cargos)
         ->with('customers',$customers)
         ->with('agents',$agents)
         ->with('commodity',$commodity)
         ->with('materials',$materials)->with('uoms',$uoms);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

      
        $validatedData = $request->validate([
            'ref_no' => 'required|string',
            'date' => 'required',
            'consignment_type' => 'required|string',
            'cargo_type' => 'required',
            'booking_no' => 'required',
            'customer_name' => 'required',
            'cf_agent' => 'required',
            // 'consignment_wgt' => 'required',
            // 'no_package' => 'required',
            
        ]);
      if($validatedData){
        try {
            DB::beginTransaction();
            $data = $request->all();  
            $consignment_wgt = isset($data['consignment_wgt']) && '' != $data['consignment_wgt']  ? $data['consignment_wgt']:NULL;
            $no_package = isset($data['no_package']) && '' != $data['no_package'] ? $data['no_package']:NULL;
            
            if($data['consignment_type']!='3' && explode("/",$data['cargo_type'])[1]!="9" && $consignment_wgt =='' && $no_package==''){
                return redirect()->route('manifesto.create')->with('error','No of Package and Consignment Weight required.');
            } 
            $update_data =array(
                'ref_no' => $data['ref_no']?$data['ref_no']:'',
                'date' => $data['date']? date('Y-m-d',strtotime($data['date'])):'',
                'cargo_reference_no' => $data['cargo_reference_no']? $data['cargo_reference_no']:'',
                'consignment_type' => $data['consignment_type']? $data['consignment_type']:'',
                'ecd_name' => $data['ecd_name']? $data['ecd_name']:'',
                'delivery_note_no' => $data['delivery_note_no']? $data['delivery_note_no']:'',
                'no_container' => $data['no_container']? $data['no_container']:'',
                'cargo_type' => explode("/",$data['cargo_type'])[1],
                'booking_no' => $data['booking_no']? $data['booking_no']:'',
                'customer_name' => $data['customer_name']? $data['customer_name']:'',
                'cf_agent' => $data['cf_agent']? $data['cf_agent']:'',
                'consignment_wgt' => $consignment_wgt,
                'no_package' => $no_package?$no_package:0,
                'status' => 0,
                'updated_at' => now(),
                'updated_by' => auth()->user()->id
                );
                ManifestoEntry::where("id", "=",$data['id'])->update($update_data);
                ConsignmentDetails::where('manifesto_entry_id',$data['id'])->delete();
              if(count($data['report_no'])>0){
               foreach($data['report_no'] as $key=>$value){
                $consignment_detail = new ConsignmentDetails();
                $consignment_detail->manifesto_entry_id= $data['id'];
                $consignment_detail->report_no= $data['report_no'][$key];
                $consignment_detail->carry_in_date= $data['carry_in_date'][$key];
                $consignment_detail->container_no= $data['container_no'][$key];
                $consignment_detail->size= $data['size'][$key];
                $consignment_detail->seal_s_no1= isset($data['seal_s_no1'][$key])?$data['seal_s_no1'][$key]:NULL;
                $consignment_detail->commodity= $data['commodity'][$key];
                $consignment_detail->material= $data['material'][$key];
                $consignment_detail->uom= $data['uom'][$key];
                $consignment_detail->declared_wgt= $data['declared_wgt'][$key];
                $consignment_detail->truck_no= $data['truck_no'][$key];
                $consignment_detail->trailer_no= $data['trailer_no'][$key];
                $consignment_detail->driver_name= $data['driver_name'][$key];
                $consignment_detail->driver_lic_no= $data['driver_lic_no'][$key];
                $consignment_detail->created_by= auth()->user()->id;
                $consignment_detail->updated_by= auth()->user()->id;
                $consignment_detail->save();
               }
            }
            DB::commit();
            //Send Notification
            Notifications::sendNotification(auth()->user()->user_type,'finance_officer','Manifesto Updated','','/manifesto-list-finance-officer');
            UserLog::AddLog('New Manifesto Entry Updated By');
            return redirect()->route('manifesto.index')->with('create', 'Manifesto Updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
            return redirect()->route('manifesto.create')->with('create',$e->getMessage());
            
        }
      }  
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

   
    public function getAreaByLocation($id)
    {
        $html = '<option value="">Select Area</option>';
        if($id){
           $areas = Area::where('location_id',$id)->get();
           foreach ($areas as $key => $area) {
             $html .= '<option value="'.$area->id.'">'.ucwords( str_replace('_',' ',$area['area'])) .'</option>';
           }
        }
        return $html;
    }

    public function getBinByArea($id)
    {
        $html = '<option value="">Select Bin</option>';
        if($id){
           $bins = Bin::where('id',$id)->get();
           foreach ($bins as $key => $bin) {
             $html .= '<option value="'.$bin->id.'">'.ucwords( str_replace('_',' ',$bin['bin'])) .'</option>';
           }
        }
        return $html;
    }
}
