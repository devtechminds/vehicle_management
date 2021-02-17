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
use App\Notifications;
use DB;
use App\UserLog;

class FinanceOfficerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_ref_no = ManifestoEntry::getAllRefNo();
        return view('finance_officer.index')->with('all_ref_no',$all_ref_no);
    }


    public function financeManifestoList(Request $request){
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
        return datatables()->of($manifesto_entry_data_list)
            ->addColumn('action', function ($manifesto_entry_data_list) {
                $return_action = '<a href="' . route('finance.officer.manifesto.show',base64_encode($manifesto_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
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

                return $row->status==2?'Authorized':'Pending';
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
        //
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
        
         return view('finance_officer.show')->with('manifestoEntry',$manifestoEntry);
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

    public function updateStatus($status,$id)
    {
        
        ManifestoEntry::query()->where('id','=',$id)->update(array('status' => $status));
        //Send Notification
        if($status==2){
            Notifications::sendNotification(auth()->user()->user_type,'gate1_entry_officer','Manifesto Entry Approved.','','/vehilce-in-register');
            UserLog::AddLog('Manifesto Entry Approved By');
        }elseif($status==10){
            Notifications::sendNotification(auth()->user()->user_type,'documentation_officer','Manifesto Entry Rejected.','','/manifesto-list');
            UserLog::AddLog('Manifesto Entry Rejected By');
        }
        return redirect()->route('finance.officer.manifesto.index')->with('create', 'Manifesto Entry updated successfully!');     
    }
}
