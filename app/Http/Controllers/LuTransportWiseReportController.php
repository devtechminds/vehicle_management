<?php

namespace App\Http\Controllers;

use App\Transports;
use App\LuGateEntrie;
use App\LuCommodityDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LuTransportExport;

class LuTransportWiseReportController extends Controller
{
    public function luTransportReport(Request $request)
    {
        
        if($request->ajax()){

           // $loading_gate_entry = LuGateEntrie::with('getCustomer','getCommodity','getTransporter','getLuWeightBridge','getLuCommodityDetail','getLuCommodityDetail.getMaterial','getLuCommodityDetail.getUOM');
           $loading_gate_entry = LuCommodityDetail::with('getLuGateEntry.getCustomer','getLuGateEntry.getCommodity','getLuGateEntry.getTransporter','getLuGateEntry.getLuWeightBridge','getLuGateEntry','getMaterial','getUOM');
           

            if(isset($request->report_type)){

                $loading_gate_entry->whereHas('getLuGateEntry', function($q) use($request){
                    $q->where('is_loading','=',$request->report_type);
                });

            }

            if(isset($request->transporter)){

             $loading_gate_entry->whereHas('getLuGateEntry', function($q) use($request){
                $q->where('transporter','=',$request->transporter);
            });

             }
        
            if(isset($request->from_date) && isset($request->to_date))
            {
                $loading_gate_entry->whereHas('getLuGateEntry', function($q) use($request){
                    $q->whereBetween('created_at', [$request->from_date, $request->to_date]);
                });

            }

            $loading_gate_entry->whereHas('getLuGateEntry', function($q) use($request){
                $q->where('out_process_status','=',2);
            });
        
            $loading_gate_entry_list = $loading_gate_entry->get();

            return datatables()->of($loading_gate_entry_list)
                ->editColumn('ref_no', function($row){
                    return  $row->getLuGateEntry->ref_no;
                })
                ->editColumn('created_at', function($row){
                    $created_at = date('d-m-Y', strtotime($row->getLuGateEntry->created_at) );
                    return  isset($row->getLuGateEntry->created_at)?$created_at:'';
                })
                ->editColumn('loading_date', function($row){
                    $loading_date = date('d-m-Y', strtotime($row->getLuGateEntry->loading_date) );
                    return  isset($row->getLuGateEntry->loading_date)?$loading_date:'';
                })
                ->editColumn('vehicle_exit_date', function($row){
                    $vehicle_exit_date = date('d-m-Y', strtotime($row->getLuGateEntry->vehicle_exit_date) );
                    return  isset($row->getLuGateEntry->vehicle_exit_date)?$vehicle_exit_date:'';
                })
                ->editColumn('tra_seal_no', function($row){
                    return  $row->getLuGateEntry->tra_seal_no;
                })
                ->editColumn('shipping_line', function($row){
                    return  $row->getLuGateEntry->shipping_line;
                })
                ->editColumn('interchange_no', function($row){
                    return  $row->getLuGateEntry->interchange_no;
                })
                ->editColumn('container_no', function($row){
                    return  $row->getLuGateEntry->container_no;
                })
                ->editColumn('truck_no', function($row){
                    return  $row->getLuGateEntry->truck_no;
                })
                ->editColumn('trailer_no', function($row){
                    return  $row->getLuGateEntry->trailer_no;
                })
                ->editColumn('destination', function($row){
                    return  $row->getLuGateEntry->destination;
                })
                ->editColumn('dn_no', function($row){
                    return  $row->getLuGateEntry->dn_no;
                })
                ->editColumn('dn_qty', function($row){
                    return  $row->getLuGateEntry->dn_qty;
                })
                ->editColumn('bl_no', function($row){
                    return  $row->getLuGateEntry->bl_no;
                })
                ->editColumn('bl_qty', function($row){
                    return  $row->getLuGateEntry->bl_qty;
                })
                ->editColumn('customer_name', function($row){
                    return  $row->getLuGateEntry->getCustomer->customer_name;
                })
                ->editColumn('transport_name', function($row){
                    return  $row->getLuGateEntry->getTransporter->transport_name;
                })
                ->editColumn('commodity_name', function($row){
                    return  $row->getLuGateEntry->getCommodity->commodity_name;
                })
                ->editColumn('material_name', function($row){

                   return  $row->getMaterial->material_name;  
                })
                ->editColumn('unit_entry_filed', function($row){

                   return  $row->getUOM->unit_entry_filed;
                })
                ->editColumn('commodity_quantity', function($row){

                   return  $row->commodity_quantity;
                    
                })
                ->editColumn('total_weight', function($row){

                   return  round($row->total_weight,2);     
                })
                ->editColumn('wb_ticket_no', function($row){
                    $wb_ticket_no = isset($row->getLuGateEntry->getLuWeightBridge->wb_ticket_no)?$row->getLuGateEntry->getLuWeightBridge->wb_ticket_no:"";
                    return  $wb_ticket_no;
                })
                ->editColumn('container_tare_wt', function($row){
                    $container_tare_wt = isset($row->getLuGateEntry->getLuWeightBridge->container_tare_wt)?$row->getLuGateEntry->getLuWeightBridge->container_tare_wt:"";
                    return  $container_tare_wt;
                })
                ->editColumn('wb_gross_wt', function($row){
                    $wb_gross_wt = isset($row->getLuGateEntry->getLuWeightBridge->wb_gross_wt)?$row->getLuGateEntry->getLuWeightBridge->wb_gross_wt:"";
                    return  $wb_gross_wt;
                })
                ->editColumn('wb_tare_wt', function($row){
                    $wb_tare_wt = isset($row->getLuGateEntry->getLuWeightBridge->wb_tare_wt)?$row->getLuGateEntry->getLuWeightBridge->wb_tare_wt:"";
                    return  $wb_tare_wt;
                })
                ->editColumn('wb_net_wt', function($row){
                    $wb_net_wt = isset($row->getLuGateEntry->getLuWeightBridge->wb_net_wt)?$row->getLuGateEntry->getLuWeightBridge->wb_net_wt:"";
                    return  $wb_net_wt;
                })
                ->editColumn('metric_ton', function($row){
                    return  round($row->getLuGateEntry->metric_ton,2);
                })
                ->editColumn('remarks', function($row){
                    if($row->getLuGateEntry->is_loading==1){
                        return "Loading";
                    } else {
                        return "Unloading";
                    }
                })
                ->editColumn('status', function($row){
                    if($row->getLuGateEntry->out_process_status==4){
                        return "COMPLETED TOKEN";
                    } else {
                        return "NOT COMPLETED TOKEN";
                    }
                })
                ->rawColumns(['customer_name','wb_ticket_no','container_tare_wt','wb_gross_wt','wb_tare_wt','wb_net_wt','metric_ton','material_name','unit_entry_filed','commodity_quantity','total_weight','remarks','status','loading_date','vehicle_exit_date'])
               
                ->make(true);
       

            }else{
                 $transports = Transports::getTransports();
                 return view('lu_reports.transport_report')->with('transports',$transports);
            }
    }

    public function transportDownload(Request $request){
       
        return Excel::download(new LuTransportExport($request->all()), 'Transporter.xlsx');
                  
    }
}
