<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EtcAgent;
class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('agent.index');
    }

    public function agentList(Request $request){
        $aget_data = EtcAgent::query();
        if($request->tin_no){
            $aget_data->where('tin_no','=',$request->tin_no);
        }
        if($request->vrn_no){
            $aget_data->where('vrn_no','=',$request->vrn_no);
        }
        if($request->status)
        {
            $serch_status= 1;
            if($request->status==2){
                $serch_status = 0;
            }
            $aget_data->where('status','=',$serch_status);
        }
        if(isset($request->created_date))
        {
            $created_date = date('Y-m-d',strtotime($request->created_date));
            $aget_data->whereDate('created_at',$created_date);
        }

        $aget_data_list = $aget_data->get();
        return datatables()->of($aget_data_list)
            ->addColumn('action', function ($aget_data_list) {
                $return_action = '<a href="' . route('agent.edit',base64_encode($aget_data_list->agent_code)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">
                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Design\Edit.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24"/>
                <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>
                <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>
                </g>
                </svg><!--end::Svg Icon--></span>
                </a>';
                $return_action .= '<a href="' . route('agent.show',base64_encode($aget_data_list->agent_code)) . '"  class="btn btn-sm btn-clean btn-icon mr-2" title="View details">
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

            //     $delete_route = route('agent.distroy', base64_encode($aget_data_list->agent_code));
            //     $return_action .= '<button class="btn viewModal  btn-sm btn-clean btn-icon" data-title="Delete Agent " data-msg="Do you want to delete this record "  data-name ="'.ucfirst($aget_data_list->agent_name).'" data-url="'.$delete_route.'"  data-type="delete" data-id="'.base64_encode($aget_data_list->agent_code).'" data-type="delete" data-id="'.base64_encode($aget_data_list->agent_code).'" title="Delete">
            //     <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Trash.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            //     <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            //         <rect x="0" y="0" width="24" height="24"/>
            //         <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>
            //         <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>
            //     </g>
            // </svg><!--end::Svg Icon-->
            // </span>
            // </button>';
            return $return_action;
            })
            ->make(true);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agent.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'agent_name' => 'required|string',
            'agent_name' => 'required|unique:etc_agents,agent_name',
            'tin_no' => 'required',
            'vrn_no' => 'required',
            'mobile_number' => 'required',
            'email' => 'required',
            'email' => 'required',
            'country' => 'required',
            'province' => 'required',
            'place' => 'required',
            'address' => 'required',
            'status' => 'required',
        ]);
      if($validatedData){
        $data= $request->all();  
        $etc_agent = new EtcAgent();
        $etc_agent->agent_name = $data['agent_name']?$data['agent_name']:'';
        $etc_agent->tin_no = $data['tin_no']?$data['tin_no']:'';
        $etc_agent->vrn_no = $data['vrn_no']?$data['vrn_no']:'';
        $etc_agent->mobile_number = $data['mobile_number']?$data['mobile_number']:'';
        $etc_agent->email = $data['email']?$data['email']:'';
        $etc_agent->country = $data['country']?$data['country']:'';
        $etc_agent->province = $data['province']?$data['province']:'';
        $etc_agent->place = $data['place']?$data['place']:'';
        $etc_agent->pincode = $data['pincode']?$data['pincode']:'';
        $etc_agent->address = $data['address']?$data['address']:'';
        $etc_agent->status = $data['status']?$data['status']:0;
        $etc_agent->created_at = now();
        $etc_agent->created_by = 1;
        $etc_agent->updated_by = 1;
        $etc_agent->save();
        return redirect()->route('agent.index')->with('create', 'Agent Added successfully!');
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
        $agent = EtcAgent::select("*")
        ->where("agent_code", "=", base64_decode($id))
        ->first();
         return view('agent.show')->with('agent',$agent);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agent = EtcAgent::select("*")
        ->where("agent_code", "=", base64_decode($id))
        ->first();
        return view('agent.update')->with('agent',$agent);
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
            'agent_name' => 'unique:etc_agents,agent_name,'.$request->id.',agent_code',
            'tin_no' => 'required|integer',
            'vrn_no' => 'required',
            'mobile_number' => 'required',
            'email' => 'required',
            'email' => 'required',
            'country' => 'required',
            'province' => 'required',
            'place' => 'required',
            'address' => 'required',
            'status' => 'required',
        ]);
      if($validatedData){
        $data= $request->all();  
        $update_data =array(
        'agent_name' => $data['agent_name']?$data['agent_name']:'',
        'tin_no' => $data['tin_no']?$data['tin_no']:'',
        'vrn_no' => $data['vrn_no']?$data['vrn_no']:'',
        'mobile_number' => $data['mobile_number']?$data['mobile_number']:'',
        'email' => $data['email']?$data['email']:'',
        'country' => $data['country']?$data['country']:'',
        'province' => $data['province']?$data['province']:'',
        'place' => $data['place']?$data['place']:'',
         'pincode' => $data['pincode']?$data['pincode']:'',
        'address' => $data['address']?$data['address']:'',
        'status' => $data['status']?$data['status']:0,
        'updated_at' => now(),
        'updated_by' => 1
        );
        EtcAgent::where("agent_code", "=",$data['id'])->update($update_data);
        return redirect()->route('agent.index')->with('create', 'Agent Updated successfully!');
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
        EtcAgent::where("agent_code", "=",base64_decode($id))->delete();
        return redirect()->route('agent.index')->with('create', 'Agent Deleted successfully!');
    }

    public function updateStatus($type)
    {
        $status_value = $type=='active' ? 1 : 0;
        EtcAgent::query()->update(array('status' => $status_value));
        return redirect()->route('agent.index')->with('create', 'Agents updated successfully!');     
    }
}
