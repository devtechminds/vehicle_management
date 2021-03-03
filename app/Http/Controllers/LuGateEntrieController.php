<?php

namespace App\Http\Controllers;

use DB;
use App\LuGateEntrie;
use App\Material;
use App\Commodity;
use App\Customers;
use App\Transports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LuGateEntrieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('lu_gate_entry.index');
    }

    public function loadingList(Request $request){
        $loading_entry_data = LuGateEntrie::with('getCustomer','getCommodity');
        if($request->status)
        {
            $serch_status= 1;
            if($request->status==2){
                $serch_status = 0;
            }
            $loading_entry_data->where('status','=',$serch_status);
            if($request->status==3){
                $loading_entry_data->where('status','=',$request->status);
                $loading_entry_data->Orwhere('status','=',$request->status);
            }
        }
        if($request->ref_no)
        {
            $loading_entry_data->where('ref_no','=',$request->ref_no);
        }
        if(isset($request->created_date))
        {
            $created_date = date('Y-m-d',strtotime($request->created_date));
            $loading_entry_data->whereDate('created_at',$created_date);
        }
        $loading_entry_data_list = $loading_entry_data->get();
        $user = Auth::user();
        $user_type = explode(',',$user->user_type);
        return datatables()->of($loading_entry_data_list)
            ->addColumn('action', function ($loading_entry_data_list) use($user_type) {
                $return_action = '<a href="' . route('manifesto.show',base64_encode($loading_entry_data_list->id)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
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
            ->editColumn('customer_name', function($row){
                return  $row->getCustomer->customer_name;
            })
            ->editColumn('commodity_name', function($row){
                return  $row->getCommodity->commodity_name;
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
            ->rawColumns(['customer_name','commodity_name','action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers    = Customers::getAllCustomers();
        $commoditys   = Commodity::getCommodity();
        $transports   = Transports::getTransports();
        $ref_no       = LuGateEntrie::getRefNo();
        return view('lu_gate_entry.create')->with('customers',$customers)
        ->with('commoditys',$commoditys)->with('transports',$transports)
        ->with('ref_no',$ref_no);
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
     * @param  \App\LuGateEntrie  $luGateEntrie
     * @return \Illuminate\Http\Response
     */
    public function show(LuGateEntrie $luGateEntrie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LuGateEntrie  $luGateEntrie
     * @return \Illuminate\Http\Response
     */
    public function edit(LuGateEntrie $luGateEntrie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LuGateEntrie  $luGateEntrie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LuGateEntrie $luGateEntrie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LuGateEntrie  $luGateEntrie
     * @return \Illuminate\Http\Response
     */
    public function destroy(LuGateEntrie $luGateEntrie)
    {
        //
    }
}
