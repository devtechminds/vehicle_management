<?php

namespace App\Http\Controllers;

use App\Customers;
use Illuminate\Http\Request;

class LuCustomerWiseReportController extends Controller
{
    public function luCustomerReport(Request $request)
    {
        if($request->ajax()){

            $gate_entry_data = UploadDocuments::with(['getGateEntry','getManifestoEntry','getManifestoEntry.getCargo','getManifestoEntry.getConsignment','getConsignmentDetails' => function($q) use($request) {
                // Query the name field in status table
               
                if(isset($request->commodity)){
                    $q->where('commodity', '=', $request->commodity);
                }
                if(isset($request->material)){
                    $q->where('material', '=', $request->material);
                }
                
                // '=' is optional
             }]);
            if(isset($request->customer)){
             $gate_entry_data->whereHas('getManifestoEntry', function($q) use($request){
                $q->where('customer_name','=',$request->customer);
            });
           }
            if($request->status)
            {
                $serch_status= 1;
                if($request->status==2){
                    $serch_status = 0;
                }
                $gate_entry_data->where('status','=',$serch_status);
            }else{
                $gate_entry_data->where('status','=',3);
            }
            if(isset($request->from_date) && isset($request->to_date))
            {
                $gate_entry_data->whereBetween('created_at', [$request->from_date, $request->to_date]);


                // $created_date = date('Y-m-d',strtotime($request->created_date));
                // $gate_entry_data->whereDate('created_at',$created_date);
            }
           
            
            $gate_entry_data_list = $gate_entry_data->get();

            return datatables()->of($gate_entry_data_list)
                ->addColumn('action', function ($gate_entry_data_list) {
                    $return_action = '<a href="' . route('gate.pass.show',base64_encode($gate_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
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
                    $return_action .= '<a target="_blank" href="' . route('gate.pass.print',base64_encode($gate_entry_data_list->id)) . '"  class="btn-clean btn-icon" title="Print"><i class="fa fa-print"></i></a>';


                return $return_action;
                })
                ->editColumn('cargo_type', function($row){
                    return  str_replace('_',' ',ucwords($row->getManifestoEntry->getCargo->cargo_name));
                })
                ->rawColumns(['cargo_type','action'])
               
                ->make(true);
       

            }else{
                 $customers = Customers::getAllCustomers();
                return view('reports.customer_report')->with('customers',$customers);
            }
    }
}
