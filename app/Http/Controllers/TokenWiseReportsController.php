<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WeightBridgeEntryOut;
use App\Commodity;
use App\UploadDocuments;
use App\Customers;
use App\ConsignmentDetails;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportsExport;
use App\Exports\TokenExport;

class TokenWiseReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){

                        
            
            if($request->report_type=='in'){

                $gate_entry_data = UploadDocuments::with(['getGateEntry','getManifestoEntry','getManifestoEntry.getCargo','getManifestoEntry.getConsignment','getConsignmentDetails' => function($q) use($request) {
                    // Query the name field in status table
                    if(isset($request->commodity)){
                        $q->where('commodity', '=', $request->commodity);
                    }
                    if(isset($request->material)){
                        $q->where('material', '=', $request->material);
                    }
                    if(isset($request->customer)){
                       
                        $q->where('transporter', '=', $request->customer);
                    }
                    // '=' is optional
                 }]);
                 if($request->customer)
                 {
                    $gate_entry_data->whereHas('getGateEntry', function($query) use($request)
                    {
                        $query->where('gate_entry_no',$request->customer);
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
          
                // echo "<pre>";
                // print_r($gate_entry_data_list);die;
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
                    ->editColumn('gate_entry_no', function($row){
                        return  str_replace('_',' ',ucwords($row->getGateEntry->gate_entry_no));
                    })
                    ->rawColumns(['cargo_type','gate_entry_no','action'])
                   
                    ->make(true);
            }else{

                $gate_entry_data = WeightBridgeEntryOut::with(['getManifestoEntry','getManifestoEntry.getCargo','getManifestoEntry.getConsignment','getManifestoEntry.getAgent','getReleaseApprovalFinacialOfficerEntry','getGateEntryOut','getConsignmentDetails'=> function($q) use($request) {
                    // Query the name field in status table
                    if(isset($request->commodity)){
                        $q->where('commodity', '=', $request->commodity);
                    }
                    if(isset($request->material)){
                        $q->where('material', '=', $request->material);
                    }
                    if(isset($request->customer)){
                       
                        $q->where('transporter', '=', $request->customer);
                    }
                   
                    // '=' is optional
                 }]);
                  if($request->customer)
                 {
                    $gate_entry_data->whereHas('getGateEntryOut', function($query) use($request)
                    {
                        $query->where('gate_entry_no',$request->customer);
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
                        $return_action = '<a href="' . route('print.out.pass.show',base64_encode($gate_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
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
    
                       
                        $return_action .= '<a target="_blank" href="' . route('print.out.pass',base64_encode($gate_entry_data_list->id)). '"  class="btn-clean btn-icon" title="Print"><i class="fa fa-print"></i></a>';
                       
                    return $return_action;
                    })
                    ->editColumn('cargo_type', function($row){
                        return  str_replace('_',' ',ucwords($row->getManifestoEntry->getCargo->cargo_name));
                    })
                    ->editColumn('gate_entry_no', function($row){
                        return  str_replace('_',' ',ucwords($row->getGateEntryOut->gate_entry_no));
                    })
                    ->rawColumns(['cargo_type','gate_entry_no','action'])
                   
                    ->make(true);
            }

                }else{

                     $commodity = Commodity::getCommodity();
                     $transporter= ConsignmentDetails::getAllTransporter();
                     
                     return view('reports.token_report')->with('commodity',$commodity)->with('transporter',$transporter);
                }

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
        //
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

    public function download(Request $request)
    {
        return Excel::download(new TokenExport($request->all()), 'TokenReport.xlsx');
    }
}
