<?php

namespace App\Exports;
use App\User;
use App\UploadDocuments;
use Carbon\Carbon;
use App\WeightBridgeEntryOut;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
class DatewiseReportExport implements FromCollection ,WithMapping, WithHeadings
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
    //    echo "<pre>";
    //    print_r($this->request);die;
        if($this->request['report_type_submit']=='in'){
         //   $arr =array();
            $gate_entry_data = UploadDocuments::with(['getGateEntry','getWeighBridge','getManifestoEntry','getManifestoEntry.getCustomers','getManifestoEntry.getCargo','getManifestoEntry.getConsignment','getConsignmentDetails.getCommodity','getConsignmentDetails.getMaterial','getConsignmentDetails' => function($q) use($request_data) {
                // Query the name field in status table
               
                if(isset($request_data['commodity_id'])){
                    
                    $q->where('commodity', '=', $request_data['commodity_id']);
                }
                if(isset( $request_data['material_id'])){
                    $q->where('material', '=', $request_data['material_id']);
                }
                if(isset( $request_data['customer'])){
                    $q->where('transporter', '=', $request_data['customer']);
                }
             }]);
          
            //     if(isset( $request_data['customer'])){
            //     $gate_entry_data->whereHas('getManifestoEntry', function($q) use($request_data){
            //        $q->where('customer_name','=',$request_data['customer']);
            //    });
            //   }
               
        //   echo print_r($this->request);die;
            if(isset($this->request['from_date_submit']) && isset($this->request['to_date_submit']))
            {

                $start = Carbon::parse($this->request['from_date_submit'])
                ->startOfDay()        // 2018-09-29 00:00:00.000000
                ->toDateTimeString(); // 2018-09-29 00:00:00

                $end    = Carbon::parse($this->request['to_date_submit'])
                ->startOfDay()        // 2018-09-29 00:00:00.000000
                ->toDateTimeString(); // 2018-09-29 00:00:00
                $gate_entry_data->whereBetween('created_at', [$start, $end]);

               // $gate_entry_data->whereBetween('created_at', [$this->request['from_date'], $this->request['to_date']]);
            }
            $gate_entry_data->where('status','=',3);
             $gate_entry_data_list = $gate_entry_data->get();
            // echo "<pre>";
            // print_r(count($gate_entry_data_list));die;
      

             return  $gate_entry_data_list;
        }else{
            $exoprt_array= array();
            $gate_entry_data = WeightBridgeEntryOut::with(['getManifestoEntry','getManifestoEntry.getCustomers','getManifestoEntry.getCargo','getManifestoEntry.getConsignment','getManifestoEntry.getAgent','getReleaseApprovalFinacialOfficerEntry','getGateEntryOut','getConsignmentDetails.getCommodity','getConsignmentDetails.getMaterial','getConsignmentDetails'=> function($q) use($request_data) {
                if(isset($request_data['commodity_id'])){
                    
                    $q->where('commodity', '=', $request_data['commodity_id']);
                }
                if(isset( $request_data['material_id'])){
                    $q->where('material', '=', $request_data['material_id']);
                }
                if(isset( $request_data['customer'])){
                    $q->where('transporter', '=', $request_data['customer']);
                }
             }]);
            //   if(isset( $request_data['customer'])){
            //     $gate_entry_data->whereHas('getManifestoEntry', function($q) use($request_data){
            //        $q->where('customer_name','=',$request_data['customer']);
            //     });
            //   }
                $gate_entry_data->where('status','=',3);
                if(isset($this->request['from_date_submit']) && isset($this->request['to_date_submit']))
                {
    
                    $start = Carbon::parse($this->request['from_date_submit'])
                    ->startOfDay()        // 2018-09-29 00:00:00.000000
                    ->toDateTimeString(); // 2018-09-29 00:00:00
    
                    $end    = Carbon::parse($this->request['to_date_submit'])
                    ->startOfDay()        // 2018-09-29 00:00:00.000000
                    ->toDateTimeString(); // 2018-09-29 00:00:00
                    $gate_entry_data->whereBetween('created_at', [$start, $end]);
    
                   // $gate_entry_data->whereBetween('created_at', [$this->request['from_date'], $this->request['to_date']]);
                }
               
              
              $gate_entry_data_list = $gate_entry_data->get();



            //   echo "<pre>";
            //   print_r($gate_entry_data_list);die;
              return $gate_entry_data_list;

        }
      //  return User::all();
    }

    public function map($uploadDocuments) : array {
        
        $cfa =isset($uploadDocuments->getManifestoEntry->getAgent->agent_name)?$uploadDocuments->getManifestoEntry->getAgent->agent_name:''; 

        $uom = isset($uploadDocuments->getConsignmentDetails->getUOM->unit_entry_filed)?$uploadDocuments->getConsignmentDetails->getUOM->unit_entry_filed:'';
        $qty= isset($uploadDocuments->getConsignmentDetails->qty)?$uploadDocuments->getConsignmentDetails->qty:'';
        $declared_wgt  = isset($uploadDocuments->getConsignmentDetails->declared_wgt)?$uploadDocuments->getConsignmentDetails->declared_wgt:'';
        $container_no  = isset($uploadDocuments->getConsignmentDetails->container_no)?$uploadDocuments->getConsignmentDetails->container_no:'';
        $size  = isset($uploadDocuments->getConsignmentDetails->size)?$uploadDocuments->getConsignmentDetails->size:'';
        $transporter = isset($uploadDocuments->getConsignmentDetails->transporter)?$uploadDocuments->getConsignmentDetails->transporter:'';
        $vehilce_exit_date ='-';
        $time_in = isset($uploadDocuments->getGateEntry->time_in)?$uploadDocuments->getGateEntry->time_in:'-';
        $wb_ticket_no ='';
        $remark ='';
        $gross_weight ='';
        $wb_tare_wt ='';
        $container_tare_wt ='-';
        
        if($this->request['report_type_submit']== 'out'){
           $wb_ticket_no = isset($uploadDocuments->wb_ticket_no)?$uploadDocuments->wb_ticket_no:'-';
           $remark='Out';
           $gross_weight = isset($uploadDocuments->wb_net_wt)?$uploadDocuments->wb_net_wt:'-';
           $wb_tare_wt = isset($uploadDocuments->wb_tare_wt)?$uploadDocuments->wb_tare_wt:'-'; 
           $container_tare_wt = isset($uploadDocuments->container_tare_wt)?$uploadDocuments->container_tare_wt:'-';   
      
       }else{
        $wb_ticket_no = isset($uploadDocuments->getWeighBridge->wb_ticket_no)?$uploadDocuments->getWeighBridge->wb_ticket_no:'-';
        $remark='In';
        $gross_weight = isset($uploadDocuments->getWeighBridge->wb_net_wt)?$uploadDocuments->getWeighBridge->wb_net_wt:'-';
        $wb_tare_wt = isset($uploadDocuments->getWeighBridge->wb_tare_wt)?$uploadDocuments->getWeighBridge->wb_tare_wt:'-';
        $container_tare_wt = isset($uploadDocuments->getWeighBridge->container_tare_wt)?$uploadDocuments->getWeighBridge->container_tare_wt:'-';   
        
       }
     
       $customer_name= isset($uploadDocuments->getManifestoEntry->getCustomers->customer_name)?$uploadDocuments->getManifestoEntry->getCustomers->customer_name:'-';
       $truck_no = isset($uploadDocuments->getConsignmentDetails->truck_no)?$uploadDocuments->getConsignmentDetails->truck_no:'-';
       $trailer_no = isset($uploadDocuments->getConsignmentDetails->trailer_no)?$uploadDocuments->getConsignmentDetails->trailer_no:'-';
       $From_Destination =isset($uploadDocuments->getGateEntry->destination)?$uploadDocuments->getGateEntry->destination:'-';
       $Customer_DN_No='-';
       $Bill_No=isset($uploadDocuments->getManifestoEntry->bl_no)?$uploadDocuments->getManifestoEntry->bl_no:'-';
       
       $commodity_name = isset($uploadDocuments->getConsignmentDetails->getCommodity->commodity_name)?$uploadDocuments->getConsignmentDetails->getCommodity->commodity_name:'-';
       $material_name = isset($uploadDocuments->getConsignmentDetails->getMaterial->material_name)?$uploadDocuments->getConsignmentDetails->getMaterial->material_name:'-';
       $shipping_line = isset($uploadDocuments->getManifestoEntry->shipping_line)?$uploadDocuments->getManifestoEntry->shipping_line:'-';
       $no_container = isset($uploadDocuments->getManifestoEntry->no_container)?$uploadDocuments->getManifestoEntry->no_container:'-';
       $Lot_No= isset($uploadDocuments->getConsignmentDetails->lot_no)?$uploadDocuments->getConsignmentDetails->lot_no:'-';
       $consignment_type = isset($uploadDocuments->getManifestoEntry->getConsignment->consignment_type)?$uploadDocuments->getManifestoEntry->getConsignment->consignment_type:'-';
       $Interchange_No =isset($uploadDocuments->getGateEntry->interchange_no)?$uploadDocuments->getGateEntry->interchange_no:'-';
       return [
          $uploadDocuments->id,
          $uploadDocuments->getManifestoEntry->date,
          $vehilce_exit_date,
          $time_in,
          $wb_ticket_no,
          $cfa,
          $customer_name,
          $transporter,
          $truck_no,
          $trailer_no,
          $From_Destination,
          $Customer_DN_No,
          $declared_wgt,
          $Bill_No,
          $uom,
          $qty,
          $commodity_name,
          $material_name,
          $uom,
          $gross_weight,
          $wb_tare_wt,
          $container_tare_wt,
          $container_no,
          $shipping_line,
          $no_container,
          $Lot_No,
          $size,
          $consignment_type,
          $Interchange_No,
          $remark,
         
          // $registration->user->plus_one,
          // Carbon::parse($registration->event_date)->toFormattedDateString(),
          // Carbon::parse($registration->created_at)->toFormattedDateString()
      ] ;

   }



    public function headings(): array
    {
        return [
            'Sr. No',
            'Entry Date',
            'Vehicle Exit Date',
            'Exit Time',
            'WB Ticket Number',
            'CFA',
            'Customer Name',
            'Transporter',
            'Truck No',
            'Trailer No',
            'From Destination',
            'Customer DN No',
            'Customer DN Qty./Declared Weight MT',
            'BL No.',
            'Unit',
            'BL QTY. MT.',
            'Commodity',
            'Material Name',
            'Unit',
            'Gross Weight MT.',
            'Tare Weight MT.',
            'Container Weight MT.',
            'Lot/Container No',
            'Shipping Line',
            'Containers No.',
            'Lot No',
            'Size',
            'Status',
            'Interchange No',
            'Remark'
            
        ];
    }

    
}
