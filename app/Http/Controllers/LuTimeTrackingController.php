<?php

namespace App\Http\Controllers;


use App\Customers;
use App\LuTimeTracking;
use App\LuGateEntrie;
use App\User;
use App\LuCommodityDetail;
use Illuminate\Http\Request;

class LuTimeTrackingController extends Controller
{
    public function luTimeTrackingReport(Request $request)
    {
        
        if($request->ajax()){

           $loading_gate_entry = LuGateEntrie::with('getCustomer');


            if(isset($request->report_type)){

                $loading_gate_entry->where('is_loading','=',$request->report_type);

            }

            if(isset($request->customer)){

             $loading_gate_entry->where('customer_name','=',$request->customer);

             }
        
            if(isset($request->from_date) && isset($request->to_date))
            {
                $loading_gate_entry->whereBetween('created_at', [$request->from_date, $request->to_date]);

            }
        
            $loading_gate_entry_list = $loading_gate_entry->get();

            return datatables()->of($loading_gate_entry_list)
                ->addColumn('action', function ($loading_gate_entry_list) {
                   
                    $return_action = '<a target="_blank" href="' . route('loading.time.tracking.report',['id'=>base64_encode($loading_gate_entry_list->id)]) . '"  class="btn-clean btn-icon" title="Print"><i class="fa fa-clock"></i></a>';


                return $return_action;
                })
                ->editColumn('customer_name', function($row){
                    return  $row->getCustomer->customer_name;
                })
                ->editColumn('created_at', function($row){
                    $created_at = date('d-m-Y', strtotime($row->created_at) );
                    return  isset($row->created_at)?$created_at:'';
                })
                
                
                ->rawColumns(['customer_name','created_at','action'])
               
                ->make(true);
       

            }else{
                 $customers = Customers::getAllCustomers();
                return view('lu_reports.time_tacking_report')->with('customers',$customers);
            }
    }

    // public function luTimeTrackingReportData(Request $request)
    // {
        
    //     if($request->ajax()){

    //         \Log::info('ssss');
    //        $loading_gate_entry_list = LuTimeTracking::where('lu_gate_entry_id','=',base64_decode($request->id))->get();

    //        \Log::info($loading_gate_entry_list);

    // }
    public function luTimeTrackingReportData(Request $request)
    {
        
        if($request->ajax()){

            $loading_gate_entry_list = LuTimeTracking::where('lu_gate_entry_id','=',base64_decode($request->id))->get();
            $msg='';
        
            return datatables()->of($loading_gate_entry_list)
            ->editColumn('new_status', function($row) use($msg){
                if($row->new_status == 1 && $row->in_or_out == 1 && $row->is_loading == 1){
                    $msg = 'Loading Vehicle Registration';
                }elseif($row->new_status == 2 && $row->in_or_out == 1 && $row->is_loading == 1){
                    $msg = 'Loading Authorization';
                }elseif($row->new_status == 3 && $row->in_or_out == 1 && $row->is_loading == 1){
                    $msg = 'Loading Vehicle';
                }elseif($row->new_status == 1 && $row->in_or_out == 2 && $row->is_loading == 1){
                    $msg = 'Vehicle After Loading';
                }elseif($row->new_status == 2 && $row->in_or_out == 2 && $row->is_loading == 1){
                    $msg = 'Vehicle return after Loading';
                }elseif($row->new_status == 1 && $row->in_or_out == 1 && $row->is_loading == 2){
                    $msg = 'Unloading Vehicle Registration';
                }elseif($row->new_status == 2 && $row->in_or_out == 1 && $row->is_loading == 2){
                    $msg = 'Unloading Authorization';
                }elseif($row->new_status == 3 && $row->in_or_out == 1 && $row->is_loading == 2){
                    $msg = 'Unloading Vehicle';
                }elseif($row->new_status == 1 && $row->in_or_out == 2 && $row->is_loading == 2){
                    $msg = 'Vehicle After Unloading';
                }elseif($row->new_status == 2 && $row->in_or_out == 2 && $row->is_loading == 2){
                    $msg = 'Vehicle return after Unloading';
                }
                return  $msg;
            })
            ->editColumn('action_time', function($row){
                $created_at = date('d-m-Y h:i A', strtotime($row->created_at) );
                return  isset($row->created_at)?$created_at:'';
            })
            ->editColumn('action_time_diff', function($row){
                $time_diff = gmdate("h:i", $row->time_diff);
                return  isset($row->time_diff)?$time_diff:'';
            })
            ->editColumn('action_by', function($row){
                $action_by = User::find($row->updated_by)->name;
                return  isset($row->updated_by)?$action_by:'';
            })
               
                ->rawColumns(['new_status','action_time','action_time_diff','action_by'])
               
                ->make(true);
       

            }else{
                 $customers = Customers::getAllCustomers();
                return view('lu_reports.time_tacking_report_data')->with('customers',$customers);
            }
    }
}
