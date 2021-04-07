<?php

namespace App\Exports;
use App\User;
use App\LuCommodityDetail;
use Carbon\Carbon;
use App\WeightBridgeEntryOut;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
class LuTransportExport implements FromCollection ,WithMapping, WithHeadings
{
    protected $request;

    function __construct($request) {
         $this->request = $request;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       $request_data = $this->request;
   
        
            $loading_gate_entry = LuCommodityDetail::with('getLuGateEntry.getCustomer','getLuGateEntry.getCommodity','getLuGateEntry.getTransporter','getLuGateEntry.getLuWeightBridge','getLuGateEntry','getMaterial','getUOM');


            if(isset($request_data['report_type_submit'])){

                $loading_gate_entry->whereHas('getLuGateEntry', function($q) use($request_data){
                    $q->where('is_loading','=',$request_data['report_type_submit']);
                });

            }

            if(isset($request_data['transporter'])){

             $loading_gate_entry->whereHas('getLuGateEntry', function($q) use($request_data){
                $q->where('transporter','=',$request_data['transporter']);
            });

             }
        
            

            if(isset($this->request['from_date_submit']) && isset($this->request['to_date_submit']))
            {

                $loading_gate_entry->whereHas('getLuGateEntry', function($q) use($request_data){
                    $date_from = Carbon::parse($request_data['from_date_submit'])->startOfDay();
                    $date_to = Carbon::parse($request_data['to_date_submit'])->endOfDay();
                    $q->whereBetween('created_at', [$date_from, $date_to]);
                });

               // $gate_entry_data->whereBetween('created_at', [$this->request['from_date'], $this->request['to_date']]);
            }
            $loading_gate_entry->whereHas('getLuGateEntry', function($q) use($request_data){
                $q->where('out_process_status','=',2);
            });
        
            $loading_gate_entry_list = $loading_gate_entry->get();
            // echo "<pre>";
            // print_r(count($gate_entry_data_list));die;
      

             return  $loading_gate_entry_list;
     
      //  return User::all();
    }

    public function map($luCommodityDetail) : array {

        $ref_no =isset($luCommodityDetail->getLuGateEntry->ref_no)?$luCommodityDetail->getLuGateEntry->ref_no:'';
        $gate_entry_date =isset($luCommodityDetail->getLuGateEntry->created_at)?date('d-m-Y', strtotime($luCommodityDetail->getLuGateEntry->created_at)):'';
        $loading_date =isset($luCommodityDetail->getLuGateEntry->loading_date)?date('d-m-Y', strtotime($luCommodityDetail->getLuGateEntry->loading_date)):'';
        $vehicle_exit_date =isset($luCommodityDetail->getLuGateEntry->vehicle_exit_date)?date('d-m-Y', strtotime($luCommodityDetail->getLuGateEntry->vehicle_exit_date)):'';
        $tra_seal_no =isset($luCommodityDetail->getLuGateEntry->tra_seal_no)?$luCommodityDetail->getLuGateEntry->tra_seal_no:'';
        $shipping_line =isset($luCommodityDetail->getLuGateEntry->shipping_line)?$luCommodityDetail->getLuGateEntry->shipping_line:'';
        $interchange_no =isset($luCommodityDetail->getLuGateEntry->interchange_no)?$luCommodityDetail->getLuGateEntry->interchange_no:'';
        $container_no =isset($luCommodityDetail->getLuGateEntry->container_no)?$luCommodityDetail->getLuGateEntry->container_no:'';
        $truck_no =isset($luCommodityDetail->getLuGateEntry->truck_no)?$luCommodityDetail->getLuGateEntry->truck_no:'';
        $trailer_no =isset($luCommodityDetail->getLuGateEntry->trailer_no)?$luCommodityDetail->getLuGateEntry->trailer_no:'';
        $destination =isset($luCommodityDetail->getLuGateEntry->destination)?$luCommodityDetail->getLuGateEntry->destination:'';
        $dn_no =isset($luCommodityDetail->getLuGateEntry->dn_no)?$luCommodityDetail->getLuGateEntry->dn_no:'';
        $dn_qty =isset($luCommodityDetail->getLuGateEntry->dn_qty)?$luCommodityDetail->getLuGateEntry->dn_qty:'';
        $bl_no =isset($luCommodityDetail->getLuGateEntry->bl_no)?$luCommodityDetail->getLuGateEntry->bl_no:'';
        $bl_qty =isset($luCommodityDetail->getLuGateEntry->bl_qty)?$luCommodityDetail->getLuGateEntry->bl_qty:'';
        $customer_name =isset($luCommodityDetail->getLuGateEntry->getCustomer->customer_name)?$luCommodityDetail->getLuGateEntry->getCustomer->customer_name:'';
        $transport_name =isset($luCommodityDetail->getLuGateEntry->getTransporter->transport_name)?$luCommodityDetail->getLuGateEntry->getTransporter->transport_name:'';
        $commodity_name =isset($luCommodityDetail->getLuGateEntry->getCommodity->commodity_name)?$luCommodityDetail->getLuGateEntry->getCommodity->commodity_name:'';
        $material_name =isset($luCommodityDetail->getMaterial->material_name)?$luCommodityDetail->getMaterial->material_name:'';
        $unit_entry_filed =isset($luCommodityDetail->getUOM->unit_entry_filed)?$luCommodityDetail->getUOM->unit_entry_filed:'';
        $commodity_quantity =isset($luCommodityDetail->commodity_quantity)?$luCommodityDetail->commodity_quantity:'';
        $total_weight =isset($luCommodityDetail->total_weight)?round($luCommodityDetail->total_weight,2):'';
        $wb_ticket_no =isset($luCommodityDetail->getLuGateEntry->getLuWeightBridge->wb_ticket_no)?$luCommodityDetail->getLuGateEntry->getLuWeightBridge->wb_ticket_no:'';
        $container_tare_wt =isset($luCommodityDetail->getLuGateEntry->getLuWeightBridge->container_tare_wt)?$luCommodityDetail->getLuGateEntry->getLuWeightBridge->container_tare_wt:'';
        $wb_gross_wt =isset($luCommodityDetail->getLuGateEntry->getLuWeightBridge->wb_gross_wt)?$luCommodityDetail->getLuGateEntry->getLuWeightBridge->wb_gross_wt:'';
        $wb_tare_wt =isset($luCommodityDetail->getLuGateEntry->getLuWeightBridge->wb_tare_wt)?$luCommodityDetail->getLuGateEntry->getLuWeightBridge->wb_tare_wt:'';
        $wb_net_wt =isset($luCommodityDetail->getLuGateEntry->getLuWeightBridge->wb_net_wt)?$luCommodityDetail->getLuGateEntry->getLuWeightBridge->wb_net_wt:'';
        $metric_ton =isset($luCommodityDetail->getLuGateEntry->metric_ton)?$luCommodityDetail->getLuGateEntry->metric_ton:'';
        $remarks =($luCommodityDetail->getLuGateEntry->is_loading==1)?"Loading":"Unloading";
        $status =($luCommodityDetail->getLuGateEntry->out_process_status==4)?"COMPLETED TOKEN":"NOT COMPLETED TOKEN";   
        
       return [
          $luCommodityDetail->id,
          $gate_entry_date,
          $loading_date,
          $vehicle_exit_date,
          $ref_no,
          $wb_ticket_no,
          $container_tare_wt,
          $tra_seal_no,
          $shipping_line,
          $interchange_no,
          $container_no,
          $customer_name,
          $transport_name,
          $truck_no,
          $trailer_no,
          $destination,
          $dn_no,
          $dn_qty,
          $bl_no,
          $bl_qty,
          $commodity_name,
          $material_name,
          $unit_entry_filed,
          $commodity_quantity,
          $total_weight,
          $wb_gross_wt,
          $wb_tare_wt,
          $wb_net_wt,
          $metric_ton,
          $remarks,
          $status,
          // $registration->user->plus_one,
          // Carbon::parse($gate_entry_date)->toFormattedDateString(),
          // Carbon::parse($registration->created_at)->toFormattedDateString()
      ] ;

   }



    public function headings(): array
    {
        return [
            'Sr. No',
            'Gate Entry Date',
            'Loading Date',
            'Vehicle Exit Date',
            'Token No',
            'WB Ticket No',
            'Container Tare Wt(Kg)',
            'TRA Seal No',
            'Shipping Line No',
            'Interchange No',
            'Container No',
            'Customer',
            'Transporter',
            'Truck No',
            'Trailor No',
            'Destination To',
            'DO NO',
            'DO QTY',
            'BL NO',
            'BL QTY',
            'Commodity',
            'Material Name',
            'Unit',
            'Despatch QTY',
            'Total Weight',
            'Gross Weight',
            'Tare Weight',
            'Net Weight',
            'Total Despatch QTY',
            'Remarks',
            'Status'       
        ];
    }

    
}
