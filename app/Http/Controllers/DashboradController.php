<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ManifestoEntry;
use App\GateEntry;
class DashboradController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user_type = auth()->user()->user_type;
      $user_type = explode(',',$user_type);
  
      if(in_array("documentation_officer", $user_type) || in_array("finance_officer", $user_type)){
        $manifesto_entry =  ManifestoEntry::ManifestoEntryCount();
        return view('dashborad.documentation_officer_dashborad')->with('manifesto_entry',$manifesto_entry);  
      }elseif(in_array("gate1_entry_officer", $user_type)){
          $gate_entry = GateEntry::gateEntryOfficerData();
          return view('dashborad.gate1_entry_officer_dashborad')->with('gate_entry',$gate_entry);  
      }elseif(in_array("cfs_gate_officer", $user_type)){
        $gate_entry = GateEntry::getCFSOfficerData();
        return view('dashborad.cfs_gate_officer_dashborad')->with('gate_entry',$gate_entry);  
      }elseif(in_array("weigh_bridge_officer", $user_type)){
        $gate_entry = GateEntry::getWeighBridgeOfficerData();
       return view('dashborad.weigh_bridge_officer_dashborad')->with('gate_entry',$gate_entry);  
      }elseif(in_array("field_supervisor", $user_type)){
        $gate_entry = GateEntry::getFieldSupervisorData();
       return view('dashborad.field_supervisor_dashborad')->with('gate_entry',$gate_entry);  
      }elseif(in_array("sfs_operation_manager", $user_type) || in_array("admin", $user_type)){
        $gate_entry = GateEntry::getCFSOperationManagerData();
        return view('dashborad.sfs_operation_manager_dashborad')->with('gate_entry',$gate_entry);  
      }elseif( in_array("finance_controller", $user_type)){
        $gate_entry = GateEntry::getFinanceControllerData();
        return view('dashborad.finance_controller_dashborad')->with('gate_entry',$gate_entry);  
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
}
