<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('dashboard');
});
Auth::routes();

Route::group(['middleware' => ['auth']], function () {
     //DashboradController
     Route::get('dashboard','DashboradController@index')->name('dashborad');   
    // Route::get('dashboard', 'HomeController@index')->middleware('auth');
    Route::get('logout', 'HomeController@logout')->name('logout')->middleware('auth');
    
    // Agent
    Route::get('/agent-list','AgentController@index')->name('agent.index')->middleware('role:admin');
    Route::get('/agent-add','AgentController@create')->name('agent.create')->middleware('role:admin');
    Route::post('/agent-store','AgentController@store')->name('agent.store')->middleware('role:admin');
    Route::get('/lists-agent','AgentController@agentList')->name('list.agents')->middleware('role:admin');
    Route::put('/agent-update','AgentController@update')->name('agent.update')->middleware('role:admin');
    Route::get('/agent-edit/{id}','AgentController@edit')->name('agent.edit')->middleware('role:admin');
    Route::get('/agent-show/{id}','AgentController@show')->name('agent.show')->middleware('role:admin');
    Route::get('/agent-delete/{id}','AgentController@destroy')->name('agent.distroy')->middleware('role:admin');
    Route::get('/update-agent-status/{status}','AgentController@updateStatus')->name('agent.status')->middleware('role:admin');

    // Customer
    Route::get('/customer-list','CustomersController@index')->name('customer.index')->middleware('role:admin');
    Route::get('/customer-add','CustomersController@create')->name('customer.create')->middleware('role:admin');
    Route::post('/customer-store','CustomersController@store')->name('customer.store')->middleware('role:admin');
    Route::get('/lists-customer','CustomersController@customerList')->name('list.customer')->middleware('role:admin');
    Route::get('/customer-edit/{id}','CustomersController@edit')->name('customer.edit')->middleware('role:admin');
    Route::put('/customer-update','CustomersController@update')->name('customer.update')->middleware('role:admin');
    Route::get('/customer-show/{id}','CustomersController@show')->name('customer.show')->middleware('role:admin');
    Route::get('/customer-delete/{id}','CustomersController@destroy')->name('customer.distroy')->middleware('role:admin');
    Route::get('/update-customer-status/{status}','CustomersController@updateStatus')->name('customer.status')->middleware('role:admin');

    // UOM
    Route::get('/uom-list','UOMController@index')->name('uom.index')->middleware('role:admin');
    Route::get('/uom-add','UOMController@create')->name('uom.create')->middleware('role:admin');
    Route::post('/uom-store','UOMController@store')->name('uom.store')->middleware('role:admin');
    Route::put('/uom-update','UOMController@update')->name('uom.update')->middleware('role:admin');
    Route::get('/uom-edit/{id}','UOMController@edit')->name('uom.edit')->middleware('role:admin');
    Route::get('/uom-show/{id}','UOMController@show')->name('uom.show')->middleware('role:admin');
    Route::get('/uom-delete/{id}','UOMController@destroy')->name('uom.distroy')->middleware('role:admin');
    Route::get('/update-uom-status/{status}','UOMController@updateStatus')->name('uom.status')->middleware('role:admin');

    // Location
    Route::get('/location-list','LocationController@index')->name('location.index')->middleware('role:admin');
    Route::get('/location-add','LocationController@create')->name('location.create')->middleware('role:admin');
    Route::post('/location-store','LocationController@store')->name('location.store')->middleware('role:admin');
    Route::put('/location-update','LocationController@update')->name('location.update')->middleware('role:admin');
    Route::get('/location-edit/{id}','LocationController@edit')->name('location.edit')->middleware('role:admin');
    Route::get('/location-show/{id}','LocationController@show')->name('location.show')->middleware('role:admin');
    Route::get('/location-delete/{id}','LocationController@destroy')->name('location.distroy')->middleware('role:admin');
    Route::get('/update-location-status/{status}','LocationController@updateStatus')->name('location.status')->middleware('role:admin');

    // Area
    Route::get('/area-list','AreaController@index')->name('area.index')->middleware('role:admin');
    Route::get('/area-add','AreaController@create')->name('area.create')->middleware('role:admin');
    Route::post('/area-store','AreaController@store')->name('area.store')->middleware('role:admin');
    Route::put('/area-update','AreaController@update')->name('area.update')->middleware('role:admin');
    Route::get('/area-edit/{id}','AreaController@edit')->name('area.edit')->middleware('role:admin');
    Route::get('/area-show/{id}','AreaController@show')->name('area.show')->middleware('role:admin');
    Route::get('/area-delete/{id}','AreaController@destroy')->name('area.distroy')->middleware('role:admin');
    Route::get('/update-area-status/{status}','AreaController@updateStatus')->name('area.status')->middleware('role:admin');

   // Bin
   Route::get('/bin-list','BinController@index')->name('bin.index')->middleware('role:admin');
   Route::get('/bin-add','BinController@create')->name('bin.create')->middleware('role:admin');
   Route::post('/bin-store','BinController@store')->name('bin.store')->middleware('role:admin');
   Route::put('/bin-update','BinController@update')->name('bin.update')->middleware('role:admin');
   Route::get('/bin-edit/{id}','BinController@edit')->name('bin.edit')->middleware('role:admin');
   Route::get('/bin-show/{id}','BinController@show')->name('bin.show')->middleware('role:admin');
   Route::get('/bin-delete/{id}','BinController@destroy')->name('bin.distroy')->middleware('role:admin');
   Route::get('/update-bin-status/{status}','BinController@updateStatus')->name('bin.status')->middleware('role:admin');
   //Route::get('/get-area-by-location/{id}','BinController@getAreaByLocation')->name('get-area-by-location')->middleware('role:admin');


    //Tranport
    Route::get('/transport-list','TransportsController@index')->name('transport.index')->middleware('role:admin');
    Route::get('/transport-add','TransportsController@create')->name('transport.create')->middleware('role:admin');
    Route::post('/transport-store','TransportsController@store')->name('transport.store')->middleware('role:admin');
    Route::get('/lists-transport','TransportsController@customerList')->name('list.transport')->middleware('role:admin');
    Route::get('/transport-edit/{id}','TransportsController@edit')->name('transport.edit')->middleware('role:admin');
    Route::put('/transport-update','TransportsController@update')->name('transport.update')->middleware('role:admin');
    Route::get('/transport-show/{id}','TransportsController@show')->name('transport.show')->middleware('role:admin');
    Route::get('/transport-delete/{id}','TransportsController@destroy')->name('transport.distroy')->middleware('role:admin');
    Route::get('/update-transport-status/{status}','TransportsController@updateStatus')->name('transport.status')->middleware('role:admin');

    //Commodities
    Route::get('/commodities-list','CommodityController@index')->name('commodities.index')->middleware('role:admin');
    Route::get('/commodities-add','CommodityController@create')->name('commodities.create')->middleware('role:admin');
    Route::post('/commodities-store','CommodityController@store')->name('commodities.store')->middleware('role:admin');
    Route::get('/lists-commodities','CommodityController@commoditiesList')->name('list.commodities')->middleware('role:admin');
    Route::get('/commodities-edit/{id}','CommodityController@edit')->name('commodities.edit')->middleware('role:admin');
    Route::put('/commodities-update','CommodityController@update')->name('commodities.update')->middleware('role:admin');
    Route::get('/commodities-show/{id}','CommodityController@show')->name('commodities.show')->middleware('role:admin');
    Route::get('/commodities-delete/{id}','CommodityController@destroy')->name('commodities.distroy')->middleware('role:admin');
    Route::get('/update-commodities-status/{status}','CommodityController@updateStatus')->name('commodities.status')->middleware('role:admin');

     //Cargo
     Route::get('/cargo-list','CargoController@index')->name('cargo.index')->middleware('role:admin');
     Route::get('/cargo-add','CargoController@create')->name('cargo.create')->middleware('role:admin');
     Route::post('/cargo-store','CargoController@store')->name('cargo.store')->middleware('role:admin');
     Route::get('/lists-cargo','CargoController@cargoList')->name('list.cargo')->middleware('role:admin');
     Route::get('/cargo-edit/{id}','CargoController@edit')->name('cargo.edit')->middleware('role:admin');
     Route::put('/cargo-update','CargoController@update')->name('cargo.update')->middleware('role:admin');
     Route::get('/cargo-show/{id}','CargoController@show')->name('cargo.show')->middleware('role:admin');
     Route::get('/cargo-delete/{id}','CargoController@destroy')->name('cargo.distroy')->middleware('role:admin');
     Route::get('/update-cargo-status/{status}','CargoController@updateStatus')->name('cargo.status')->middleware('role:admin');

      //Consignments
      Route::get('/consignments-list','ConsignmentController@index')->name('consignments.index')->middleware('role:admin');
      Route::get('/consignments-add','ConsignmentController@create')->name('consignments.create')->middleware('role:admin');
      Route::post('/consignments-store','ConsignmentController@store')->name('consignments.store')->middleware('role:admin');
      Route::get('/lists-consignments','ConsignmentController@consignmentsList')->name('list.consignments')->middleware('role:admin');
      Route::get('/consignments-edit/{id}','ConsignmentController@edit')->name('consignments.edit')->middleware('role:admin');
      Route::put('/consignments-update','ConsignmentController@update')->name('consignments.update')->middleware('role:admin');
      Route::get('/consignments-show/{id}','ConsignmentController@show')->name('consignments.show')->middleware('role:admin');
      Route::get('/consignments-delete/{id}','ConsignmentController@destroy')->name('consignments.distroy')->middleware('role:admin');
      Route::get('/update-consignments-status/{status}','ConsignmentController@updateStatus')->name('consignments.status')->middleware('role:admin');

      //Shipment
      Route::get('/shipment-list','ShipmentController@index')->name('shipment.index')->middleware('role:admin');
      Route::get('/shipment-add','ShipmentController@create')->name('shipment.create')->middleware('role:admin');
      Route::post('/shipment-store','ShipmentController@store')->name('shipment.store')->middleware('role:admin');
      Route::get('/lists-shipment','ShipmentController@shipmentsList')->name('list.shipment')->middleware('role:admin');
      Route::get('/shipment-edit/{id}','ShipmentController@edit')->name('shipment.edit')->middleware('role:admin');
      Route::put('/shipment-update','ShipmentController@update')->name('shipment.update')->middleware('role:admin');
      Route::get('/shipment-show/{id}','ShipmentController@show')->name('shipment.show')->middleware('role:admin');
      Route::get('/shipment-delete/{id}','ShipmentController@destroy')->name('shipment.distroy')->middleware('role:admin');
      Route::get('/update-shipment-status/{status}','ShipmentController@updateStatus')->name('shipment.status')->middleware('role:admin');

      //Material
      Route::get('/material-list','MaterialController@index')->name('material.index')->middleware('role:admin');
      Route::get('/material-add','MaterialController@create')->name('material.create')->middleware('role:admin');
      Route::post('/material-store','MaterialController@store')->name('material.store')->middleware('role:admin');
      Route::get('/lists-material','MaterialController@materialList')->name('list.material')->middleware('role:admin');
      Route::get('/material-edit/{id}','MaterialController@edit')->name('material.edit')->middleware('role:admin');
      Route::put('/material-update','MaterialController@update')->name('material.update')->middleware('role:admin');
      Route::get('/material-show/{id}','MaterialController@show')->name('material.show')->middleware('role:admin');
      Route::get('/material-delete/{id}','MaterialController@destroy')->name('material.distroy')->middleware('role:admin');
      Route::get('/update-material-status/{status}','MaterialController@updateStatus')->name('material.status')->middleware('role:admin');

     //Users
    Route::get('/user-list','UsersController@index')->name('user.index')->middleware('role:admin');
    Route::get('/user-add','UsersController@create')->name('user.create')->middleware('role:admin');
    Route::post('/user-store','UsersController@store')->name('user.store')->middleware('role:admin');
    Route::get('/lists-user','UsersController@userList')->name('list.user')->middleware('role:admin');
    Route::get('/user-edit/{id}','UsersController@edit')->name('user.edit')->middleware('role:admin');
    Route::put('/user-update','UsersController@update')->name('user.update')->middleware('role:admin');
    Route::get('/user-show/{id}','UsersController@show')->name('user.show')->middleware('role:admin');
    Route::get('/user-delete/{id}','UsersController@destroy')->name('user.distroy')->middleware('role:admin');


     //ManifestoEntry
     Route::get('/manifesto-list','ManifestoEntryController@index')->name('manifesto.index')->middleware('role:documentation_officer');
     Route::get('/manifesto-add','ManifestoEntryController@create')->name('manifesto.create')->middleware('role:documentation_officer');
     Route::post('/manifesto-store','ManifestoEntryController@store')->name('manifesto.store')->middleware('role:documentation_officer');
     Route::get('/lists-manifesto','ManifestoEntryController@manifestoList')->name('list.manifesto')->middleware('role:documentation_officer');
     Route::get('/manifesto-edit/{id}','ManifestoEntryController@edit')->name('manifesto.edit')->middleware('role:documentation_officer');
     Route::put('/manifesto-update','ManifestoEntryController@update')->name('manifesto.update')->middleware('role:documentation_officer');
     Route::get('/manifesto-show/{id}','ManifestoEntryController@show')->name('manifesto.show')->middleware('role:documentation_officer');
     Route::get('/manifesto-delete/{id}','ManifestoEntryController@destroy')->name('manifesto.distroy')->middleware('role:documentation_officer');
     Route::get('/cargo-type-changes/{type}','ManifestoEntryController@cargoTypeChanges')->name('cargotype.change')->middleware('role:documentation_officer');
     Route::get('/get-material-by-comodity/{id}','ManifestoEntryController@getMaterialByComodity')->name('get-material-by-comodity')->middleware('role:documentation_officer');
     Route::get('/lists-manifesto-by-order','ManifestoEntryController@manifestoListByOrder')->name('list.manifesto.by.order')->middleware('role:documentation_officer');
     Route::get('/get-area-by-location/{id}','ManifestoEntryController@getAreaByLocation')->name('get-material-by-comodity')->middleware('role:documentation_officer');
     Route::get('/get-bin-by-area/{id}','ManifestoEntryController@getBinByArea')->name('get-bin-by-area')->middleware('role:documentation_officer');


     //ManifestoEntry finance_officer
     Route::get('/manifesto-list-finance-officer','FinanceOfficerController@index')->name('finance.officer.manifesto.index')->middleware('role:finance_officer');
     Route::get('/lists-manifesto-finance-officer','FinanceOfficerController@financeManifestoList')->name('finance.officer.list.manifesto')->middleware('role:finance_officer');
     Route::get('/manifesto-show-finance-officer/{id}','FinanceOfficerController@show')->name('finance.officer.manifesto.show')->middleware('role:finance_officer');
     Route::get('/manifesto-finance-officer-status/{status}/{id}','FinanceOfficerController@updateStatus')->name('finance.officer.manifesto.status')->middleware('role:finance_officer');

    //Loading GateEntry CSF Gate Officer
    Route::get('/loading-entry-list','LuGateEntrieController@index')->name('loading.entry.index')->middleware('role:gate1_entry_officer');
    Route::get('/loading-entry-add','LuGateEntrieController@create')->name('loading.entry.create')->middleware('role:gate1_entry_officer');
    Route::post('/loading-entry-store','LuGateEntrieController@store')->name('loading.entry.store')->middleware('role:gate1_entry_officer');
    Route::get('/lists-loading-entry','LuGateEntrieController@loadingList')->name('list.loading.entry')->middleware('role:gate1_entry_officer');
    Route::get('/loading-entry-show/{id}','LuGateEntrieController@show')->name('loading.entry.show')->middleware('role:gate1_entry_officer');
    Route::get('/loading-entry-edit/{id}','LuGateEntrieController@edit')->name('loading.entry.edit')->middleware('role:gate1_entry_officer');
    Route::put('/loading-entry-update','LuGateEntrieController@update')->name('loading.entry.update')->middleware('role:gate1_entry_officer');


    //Unloading GateEntry CSF Gate Officer
    Route::get('/unloading-entry-list','LuGateEntrieController@unloadingIndex')->name('unloading.entry.index')->middleware('role:gate1_entry_officer');
    Route::get('/unloading-entry-add','LuGateEntrieController@unloadingCreate')->name('unloading.entry.create')->middleware('role:gate1_entry_officer');
    Route::post('/unloading-entry-store','LuGateEntrieController@unloadingStore')->name('unloading.entry.store')->middleware('role:gate1_entry_officer');
    Route::get('/lists-unloading-entry','LuGateEntrieController@unloadingList')->name('list.unloading.entry')->middleware('role:gate1_entry_officer');
    Route::get('/unloading-entry-show/{id}','LuGateEntrieController@unloadingShow')->name('unloading.entry.show')->middleware('role:gate1_entry_officer');
    Route::get('/unloading-entry-edit/{id}','LuGateEntrieController@unloadingEdit')->name('unloading.entry.edit')->middleware('role:gate1_entry_officer');
    Route::put('/unloading-entry-update','LuGateEntrieController@unloadingUpdate')->name('unloading.entry.update')->middleware('role:gate1_entry_officer');
    Route::get('/material-by-comodity/{id}','LuGateEntrieController@getMaterialByComodity')->name('material-by-comodity');
    Route::get('/uom-by-material/{id}','LuGateEntrieController@getUomByMaterial')->name('uom-by-material');

    //ManifestoEntry CSF Gate Officer
    Route::get('/vehilce-in-register','GateEntryOfficerController@index')->name('vehilce.in.register.index')->middleware('role:gate1_entry_officer');
    Route::get('/lists-vehilce-in-register','GateEntryOfficerController@vehilceList')->name('vehilce.in.register.list')->middleware('role:gate1_entry_officer');
    Route::get('/vehilce-in-show/{id}','GateEntryOfficerController@show')->name('vehilce.in.show')->middleware('role:gate1_entry_officer');
    Route::post('/vehilce-store','GateEntryOfficerController@store')->name('vehilce.store')->middleware('role:gate1_entry_officer');
    Route::get('/lists-vehilce-in-register-dashboard','GateEntryOfficerController@vehilceListdashboard')->name('vehilce.in.register.list.dashborad')->middleware('role:gate1_entry_officer');
    //  Route::get('/manifesto-finance-officer-status/{status}/{id}','FinanceOfficerController@updateStatus')->name('finance.officer.manifesto.status');
    //proceed vehilce
    Route::get('/proceed-vehilce','GateEntryOfficerController@vehilceIndex')->name('proceed.vehilce')->middleware('role:gate1_entry_officer');
    Route::get('/proceed-vehilce-list','GateEntryOfficerController@proceedVehilceList')->name('proceed.vehilce.list')->middleware('role:gate1_entry_officer');
    Route::get('/proceed-form-gate/{id}','GateEntryOfficerController@proceedVehilceShow')->name('proceed.form.gate')->middleware('role:gate1_entry_officer');
    Route::get('/proceed-form-gate-print/{id}','GateEntryOfficerController@proceedVehilcePrint')->name('proceed.form.gate.print')->middleware('role:gate1_entry_officer');
    Route::post('/proceed-form-gate-submit','GateEntryOfficerController@proceedVehilceSubmit')->name('proceed.form.gate.submit')->middleware('role:gate1_entry_officer');
    Route::get('/proceed-vehilce-list-dashboard','GateEntryOfficerController@proceedVehilceListDashboard')->name('proceed.vehilce.list.dashboard')->middleware('role:gate1_entry_officer');


    //CFSGateOfficer
    Route::get('/authorize-vehicle-in','CFSGateOfficerController@index')->name('authorize.vehicle.in.index')->middleware('role:cfs_gate_officer');
    Route::get('/lists-authorize-vehicle-in','CFSGateOfficerController@authorizeVehicleList')->name('authorize.vehicle.in.list')->middleware('role:cfs_gate_officer');
    Route::get('/lists-authorize-vehicle-in-dashborad','CFSGateOfficerController@authorizeVehicleList')->name('authorize.vehicle.in.list.dashborad')->middleware('role:cfs_gate_officer');
    Route::get('/authorize-vehicle/{id}','CFSGateOfficerController@show')->name('authorize.vehicle')->middleware('role:cfs_gate_officer');
    Route::post('/authorize-vehicle','CFSGateOfficerController@store')->name('authorize.vehicle.submit')->middleware('role:cfs_gate_officer');
   

     //CFSWeighBridge
     Route::get('/weigh-bridge-entry','CFSWeighBridgeController@index')->name('weigh.bridge.entry')->middleware('role:weigh_bridge_officer');
     Route::get('/lists-weigh-bridge-entry','CFSWeighBridgeController@weighBridgeEntryList')->name('weigh.bridge.entry.list')->middleware('role:weigh_bridge_officer');
     Route::get('/lists-weigh-bridge-entry-dashborad','CFSWeighBridgeController@dashborad')->name('weigh.bridge.entry.list.dashborad')->middleware('role:weigh_bridge_officer');
     Route::get('/weigh-bridge-officer/{id}','CFSWeighBridgeController@show')->name('weigh.bridge.officer')->middleware('role:weigh_bridge_officer');
     Route::get('/weigh-bridge-officer-print/{id}','CFSWeighBridgeController@print')->name('weigh.bridge.officer.print')->middleware('role:weigh_bridge_officer');
     Route::post('/weigh-bridge-officer-submit','CFSWeighBridgeController@store')->name('weigh.bridge.officer.submit')->middleware('role:weigh_bridge_officer');

    //Loading GateEntry CFSWeighBridge
     Route::get('/loading-weigh-bridge-entry-list','LuWeightBridgeController@index')->name('loading.weigh.bridge.entry.index')->middleware('role:weigh_bridge_officer');
     Route::get('/lists-loading-weigh-bridge-entry','LuWeightBridgeController@loadingWeightBridgeList')->name('list.loading.weigh.bridge.entry')->middleware('role:weigh_bridge_officer');
     Route::get('/loading-weigh-bridge-entry-show/{id}','LuWeightBridgeController@show')->name('loading.weigh.bridge.entry.show')->middleware('role:weigh_bridge_officer');
     Route::post('/loading-weigh-bridge-officer-submit','LuWeightBridgeController@store')->name('loading.weigh.bridge.officer.submit')->middleware('role:weigh_bridge_officer');

      //Unloading GateEntry CFSWeighBridge
      Route::get('/unloading-weigh-bridge-entry-list','LuWeightBridgeController@unloadingIndex')->name('unloading.weigh.bridge.entry.index')->middleware('role:weigh_bridge_officer');
      Route::get('/lists-unloading-weigh-bridge-entry','LuWeightBridgeController@unloadingWeightBridgeList')->name('list.unloading.weigh.bridge.entry')->middleware('role:weigh_bridge_officer');
      Route::get('/unloading-weigh-bridge-entry-show/{id}','LuWeightBridgeController@unloadingShow')->name('unloading.weigh.bridge.entry.show')->middleware('role:weigh_bridge_officer');
      Route::post('/unloading-weigh-bridge-officer-submit','LuWeightBridgeController@unloadingStore')->name('unloading.weigh.bridge.officer.submit')->middleware('role:weigh_bridge_officer');

      //Loading GateEntry Authorization Officer
     Route::get('/loading-weigh-bridge-entry-update-list','LuAuthorizationOfficerController@index')->name('loading.weigh.bridge.entry.update.index')->middleware('role:authorization_officer');
     Route::get('/lists-loading-weigh-bridge-entry-update','LuAuthorizationOfficerController@loadingWeightBridgeList')->name('list.loading.weigh.bridge.entry.update')->middleware('role:authorization_officer');
     Route::get('/loading-weigh-bridge-entry-edit/{id}','LuAuthorizationOfficerController@edit')->name('loading.weigh.bridge.entry.edit')->middleware('role:authorization_officer');
     Route::put('/loading-weigh-bridge-entry-update','LuAuthorizationOfficerController@update')->name('loading.weigh.bridge.entry.update')->middleware('role:authorization_officer');

     //unloading GateEntry Authorization Officer
     Route::get('/unloading-weigh-bridge-entry-update-list','LuAuthorizationOfficerController@unloadingIndex')->name('unloading.weigh.bridge.entry.update.index')->middleware('role:authorization_officer');
     Route::get('/lists-unloading-weigh-bridge-entry-update','LuAuthorizationOfficerController@unloadingWeightBridgeList')->name('list.unloading.weigh.bridge.entry.update')->middleware('role:authorization_officer');
     Route::get('/unloading-weigh-bridge-entry-edit/{id}','LuAuthorizationOfficerController@unloadingEdit')->name('unloading.weigh.bridge.entry.edit')->middleware('role:authorization_officer');
     Route::put('/unloading-weigh-bridge-entry-update','LuAuthorizationOfficerController@unloadingUpdate')->name('unloading.weigh.bridge.entry.update')->middleware('role:authorization_officer');

     //Loading GateEntry Authorization Manager
     Route::get('/loading-gate-entry-approval-list','LuAuthorizationManagerController@index')->name('loading.gate.entry.approval.index')->middleware('role:authorization_manager');
     Route::get('/lists-loading-gate-entry-approval','LuAuthorizationManagerController@loadingEntryApprovalList')->name('list.loading.gate.entry.approval')->middleware('role:authorization_manager');
     Route::get('/loading-gate-entry-approval-edit/{id}','LuAuthorizationManagerController@edit')->name('loading.gate.entry.approval.edit')->middleware('role:authorization_manager');
     Route::put('/loading-gate-entry-approval-process','LuAuthorizationManagerController@update')->name('loading.gate.entry.approval.process')->middleware('role:authorization_manager');


      //Unloading GateEntry Authorization Manager
      Route::get('/unloading-gate-entry-approval-list','LuAuthorizationManagerController@unloadingIndex')->name('unloading.gate.entry.approval.index')->middleware('role:authorization_manager');
      Route::get('/lists-unloading-gate-entry-approval','LuAuthorizationManagerController@unloadingEntryApprovalList')->name('list.unloading.gate.entry.approval')->middleware('role:authorization_manager');
      Route::get('/unloading-gate-entry-approval-edit/{id}','LuAuthorizationManagerController@unloadingEdit')->name('unloading.gate.entry.approval.edit')->middleware('role:authorization_manager');
      Route::put('/unloading-gate-entry-approval-process','LuAuthorizationManagerController@unloadingUpdate')->name('unloading.gate.entry.approval.process')->middleware('role:authorization_manager');
      
      //Loading GateEntry Proceed CSF Gate Officer
      Route::get('/loading-gate-entry-proceed-list','LuGateEntrieController@proceedIndex')->name('loading.gate.entry.proceed.index')->middleware('role:gate1_entry_officer');
      Route::get('/lists-loading-gate-entry-proceed','LuGateEntrieController@loadingEntryProceedlList')->name('list.loading.gate.entry.proceed')->middleware('role:gate1_entry_officer');
      Route::get('/loading-gate-entry-proceed-edit/{id}','LuGateEntrieController@proceedEdit')->name('loading.gate.entry.proceed.edit')->middleware('role:gate1_entry_officer');
      Route::put('/loading-gate-entry-proceed-process','LuGateEntrieController@proceedUpdate')->name('loading.gate.entry.proceed.process')->middleware('role:gate1_entry_officer');
      Route::get('/loading-proceed-form-gate-print/{id}','LuGateEntrieController@proceedVehilcePrint')->name('loading.proceed.form.gate.print')->middleware('role:gate1_entry_officer');

      //Unloading GateEntry Proceed CSF Gate Officer
      Route::get('/unloading-gate-entry-proceed-list','LuGateEntrieController@unloadingProceedIndex')->name('unloading.gate.entry.proceed.index')->middleware('role:gate1_entry_officer');
      Route::get('/lists-unloading-gate-entry-proceed','LuGateEntrieController@unloadingEntryProceedlList')->name('list.unloading.gate.entry.proceed')->middleware('role:gate1_entry_officer');
      Route::get('/unloading-gate-entry-proceed-edit/{id}','LuGateEntrieController@unloadingProceedEdit')->name('unloading.gate.entry.proceed.edit')->middleware('role:gate1_entry_officer');
      Route::put('/unloading-gate-entry-proceed-process','LuGateEntrieController@unloadingProceedUpdate')->name('unloading.gate.entry.proceed.process')->middleware('role:gate1_entry_officer');
      Route::get('/unloading-proceed-form-gate-print/{id}','LuGateEntrieController@unloadingProceedVehilcePrint')->name('unloading.proceed.form.gate.print')->middleware('role:gate1_entry_officer');
     
      //Loading GateEntry Return CFSWeighBridge
      Route::get('/loading-gate-entry-return-list','LuWeightBridgeController@returnIndex')->name('loading.gate.entry.return.index')->middleware('role:weigh_bridge_officer');
      Route::get('/lists-loading-gate-entry-return','LuWeightBridgeController@loadingEntryReturnlList')->name('list.loading.gate.entry.return')->middleware('role:weigh_bridge_officer');
      Route::get('/loading-gate-entry-return-edit/{id}','LuWeightBridgeController@returnEdit')->name('loading.gate.entry.return.edit')->middleware('role:weigh_bridge_officer');
      Route::put('/loading-gate-entry-return-process','LuWeightBridgeController@returnUpdate')->name('loading.gate.entry.return.process')->middleware('role:weigh_bridge_officer');

    //Unloading GateEntry Return CFSWeighBridge
     Route::get('/unloading-gate-entry-return-list','LuWeightBridgeController@unloadingReturnIndex')->name('unloading.gate.entry.return.index')->middleware('role:weigh_bridge_officer');
     Route::get('/lists-unloading-gate-entry-return','LuWeightBridgeController@unloadingEntryReturnlList')->name('list.unloading.gate.entry.return')->middleware('role:weigh_bridge_officer');
     Route::get('/unloading-gate-entry-return-edit/{id}','LuWeightBridgeController@unloadingReturnEdit')->name('unloading.gate.entry.return.edit')->middleware('role:weigh_bridge_officer');
     Route::put('/unloading-gate-entry-return-process','LuWeightBridgeController@unloadingReturnUpdate')->name('unloading.gate.entry.return.process')->middleware('role:weigh_bridge_officer');

      //Loading GateEntry Return Update Authorization Officer
      Route::get('/loading-gate-entry-return-update-list','LuAuthorizationOfficerController@returnUpdateIndex')->name('loading.gate.entry.return.update.index')->middleware('role:authorization_officer');
      Route::get('/lists-loading-gate-entry-return-update','LuAuthorizationOfficerController@loadingEntryReturnUpdatelList')->name('list.loading.gate.entry.return.update')->middleware('role:authorization_officer');
      Route::get('/loading-gate-entry-return-update-edit/{id}','LuAuthorizationOfficerController@returnUpdateEdit')->name('loading.gate.entry.return.update.edit')->middleware('role:authorization_officer');
      Route::put('/loading-gate-entry-return-update','LuAuthorizationOfficerController@returnUpdateSubmit')->name('loading.gate.entry.return.update.submit')->middleware('role:authorization_officer');

      //Loading GateEntry Return Update Authorization Officer
      Route::get('/unloading-gate-entry-return-update-list','LuAuthorizationOfficerController@unloadingReturnUpdateIndex')->name('unloading.gate.entry.return.update.index')->middleware('role:authorization_officer');
      Route::get('/lists-unloading-gate-entry-return-update','LuAuthorizationOfficerController@unloadingEntryReturnUpdatelList')->name('list.unloading.gate.entry.return.update')->middleware('role:authorization_officer');
      Route::get('/unloading-gate-entry-return-update-edit/{id}','LuAuthorizationOfficerController@unloadingReturnUpdateEdit')->name('unloading.gate.entry.return.update.edit')->middleware('role:authorization_officer');
      Route::put('/unloading-gate-entry-return-update','LuAuthorizationOfficerController@unloadingReturnUpdateSubmit')->name('unloading.gate.entry.return.update.submit')->middleware('role:authorization_officer');

       //Loading WeighBridge Return Update Authorization Officer
       Route::get('/loading-weigh-bridge-return-update-list','LuAuthorizationManagerController@afterReturnUpdateIndex')->name('loading.weigh.bridge.return.update.index')->middleware('role:authorization_manager');
       Route::get('/lists-loading-weigh-bridge-return-update','LuAuthorizationManagerController@loadingEntryAfterReturnUpdatelList')->name('list.loading.weigh.bridge.return.update')->middleware('role:authorization_manager');
       Route::get('/loading-weigh-bridge-return-update-edit/{id}','LuAuthorizationManagerController@afterReturnUpdateEdit')->name('loading.weigh.bridge.return.update.edit')->middleware('role:authorization_manager');
       Route::put('/loading-weigh-bridge-return-update','LuAuthorizationManagerController@afterReturnUpdateSubmit')->name('loading.weigh.bridge.return.update.submit')->middleware('role:authorization_manager');
       Route::get('/loading-weigh-bridge-return-update-print/{id}','LuAuthorizationManagerController@afterReturnUpdatePrint')->name('loading.weigh.bridge.return.update.print')->middleware('role:authorization_manager');

        //Unloading WeighBridge Return Update Authorization Officer
        Route::get('/unloading-weigh-bridge-return-update-list','LuAuthorizationManagerController@unloadingAfterReturnUpdateIndex')->name('unloading.weigh.bridge.return.update.index')->middleware('role:authorization_manager');
        Route::get('/lists-unloading-weigh-bridge-return-update','LuAuthorizationManagerController@unloadingEntryAfterReturnUpdatelList')->name('list.unloading.weigh.bridge.return.update')->middleware('role:authorization_manager');
        Route::get('/unloading-weigh-bridge-return-update-edit/{id}','LuAuthorizationManagerController@unloadingAfterReturnUpdateEdit')->name('unloading.weigh.bridge.return.update.edit')->middleware('role:authorization_manager');
        Route::put('/unloading-weigh-bridge-return-update','LuAuthorizationManagerController@unloadingAfterReturnUpdateSubmit')->name('unloading.weigh.bridge.return.update.submit')->middleware('role:authorization_manager');
        Route::get('/unloading-weigh-bridge-return-update-print/{id}','LuAuthorizationManagerController@unloadingAfterReturnUpdatePrint')->name('unloading.weigh.bridge.return.update.print')->middleware('role:authorization_manager');

     //FieldSupervisorController
     Route::get('/supervisor-doc-upload-entry','FieldSupervisorController@index')->name('supervisor.doc.upload.entry')->middleware('role:field_supervisor');
     Route::get('/lists-supervisor-doc-upload-entry-dashboard','FieldSupervisorController@dashboard')->name('supervisor.doc.upload.entrylist.dashboard')->middleware('role:field_supervisor');
     Route::get('/lists-supervisor-doc-upload-entry','FieldSupervisorController@supervisorEntryList')->name('supervisor.doc.upload.entrylist')->middleware('role:field_supervisor');
     Route::get('/supervisor-doc-upload/{id}','FieldSupervisorController@show')->name('supervisor.doc.upload')->middleware('role:field_supervisor');
     Route::post('/supervisor-doc-upload-submit','FieldSupervisorController@store')->name('supervisor.doc.upload.submit')->middleware('role:field_supervisor');
     Route::get('/download-document', 'FieldSupervisorController@getDownload')->name('download.document');
    
    //WeighBridgeExitController
    Route::get('/weigh-bridge-exit','WeighBridgeExitController@index')->name('weigh.bridge.exit')->middleware('role:weigh_bridge_officer');
    Route::get('/weigh-bridge-exit-dashboard','WeighBridgeExitController@dashboard')->name('weigh.bridge.exit.dashboard')->middleware('role:weigh_bridge_officer');
    Route::get('/weigh-bridge-exit-show/{id}','WeighBridgeExitController@show')->name('weigh.bridge.exit.show')->middleware('role:weigh_bridge_officer');
    Route::get('/weigh-bridge-exit-print/{id}','WeighBridgeExitController@print')->name('weigh.bridge.exit.print')->middleware('role:weigh_bridge_officer');
    Route::post('/weigh-bridge-exit-submit','WeighBridgeExitController@store')->name('weigh.bridge.exit.submit')->middleware('role:weigh_bridge_officer');
  
    //CfsGateOutController
    Route::get('/cfs-gate-out','CfsGateOutController@index')->name('cfs.gate.out')->middleware('role:cfs_gate_officer');
    Route::get('/cfs-gate-out-dashborad','CfsGateOutController@dashborad')->name('cfs.gate.out.dashborad')->middleware('role:cfs_gate_officer');
    Route::get('/cfs-gate-out-show/{id}','CfsGateOutController@show')->name('cfs.gate.out.show')->middleware('role:cfs_gate_officer');
    Route::post('/cfs-gate-out-submit','CfsGateOutController@store')->name('cfs.gate.out.submit')->middleware('role:cfs_gate_officer');


    //ApproveVehicleReturnController
    Route::get('/operation-manager-entry','ApproveVehicleReturnController@index')->name('operation.manager.entry')->middleware('role:cfs_gate_officer');
    Route::get('/operation-manager-entry-dashboard','ApproveVehicleReturnController@dashboard')->name('operation.manager.entry.dashboard');
    Route::get('/operation-manager-entry-show/{id}','ApproveVehicleReturnController@show')->name('operation.manager.entry.show')->middleware('role:cfs_gate_officer');
    Route::post('/operation-manager-entry-submit','ApproveVehicleReturnController@store')->name('operation.manager.entry.submit')->middleware('role:cfs_gate_officer');

    //PrintGatePassController
    Route::get('/gate-pass-list','PrintGatePassController@index')->name('gate.pass.list');
    Route::get('/gate-pass-show/{id}','PrintGatePassController@show')->name('gate.pass.show');
    Route::get('/gate-pass-print/{id}','PrintGatePassController@print')->name('gate.pass.print');
  
    
    //ContainerStuffingController
    Route::get('/container-stuffing-list','ContainerStuffingController@index')->name('container.stuffing.list');  
    Route::get('/container-stuffing-list-dashboard','ContainerStuffingController@dashboard')->name('container.stuffing.list.dashboard');  
    Route::get('/container-stuffing-show/{id}','ContainerStuffingController@show')->name('container.stuffing.show');
    Route::post('/container-stuffing-submit','ContainerStuffingController@store')->name('container.stuffing.submit');
   // ContainerStuffingUpdateController
    Route::get('/container-stuffing-update-list','ContainerStuffingUpdateController@index')->name('container.stuffing.update.list');  
    Route::get('/container-stuffing-update-show/{id}','ContainerStuffingUpdateController@show')->name('container.stuffing.update.show');
    Route::post('/container-stuffing-update-submit','ContainerStuffingUpdateController@store')->name('container.stuffing.update.submit');

    // StuffingApprovalController
    Route::get('/stuffing-approval-list','StuffingApprovalController@index')->name('stuffing.approval.list');  
    Route::get('/stuffing-approval-list-dashboard','StuffingApprovalController@dashboard')->name('stuffing.approval.list.dashboard');  
    Route::get('/stuffing.approval-show/{id}','StuffingApprovalController@show')->name('stuffing.approval.show');
    Route::post('/stuffing.approval-submit','StuffingApprovalController@store')->name('stuffing.approval.submit');

    // ReleaseApprovalController
    Route::get('/release-approval-list','ReleaseApprovalController@index')->name('release.approval.list');  
    Route::get('/release-approval-show/{id}','ReleaseApprovalController@show')->name('release.approval.show');
    Route::get('/release-approval-print/{id}','ReleaseApprovalController@print')->name('release.approval.print');
    Route::post('/release-approval-submit','ReleaseApprovalController@store')->name('release.approval.submit');

    
     // ContainerReleaseFinalApprovalController
     Route::get('/release-final-approval-list','ContainerReleaseFinalApprovalController@index')->name('release.final.approval.list');  
     Route::get('/release-final-approval-show/{id}','ContainerReleaseFinalApprovalController@show')->name('release.final.approval.show');
     Route::post('/release-final-approval-submit','ContainerReleaseFinalApprovalController@store')->name('release.final.approval.submit');
     Route::get('/release-final-approval-list-dashboard','ContainerReleaseFinalApprovalController@dashboard')->name('release.final.approval.list.dashboard');  
     Route::get('/release-final-approval-print/{id}','ContainerReleaseFinalApprovalController@print')->name('release.final.approval.print');

      // ContainerOutRegisterController
      Route::get('/container-out-register-list','ContainerOutRegisterController@index')->name('container.out.register.list');  
      Route::get('/container-out-register-show/{id}','ContainerOutRegisterController@show')->name('container.out.register.show');
      Route::post('/container-out-register-submit','ContainerOutRegisterController@store')->name('container.out.register.submit'); 
      Route::get('/container-out-register-list-dashborad','ContainerOutRegisterController@dashborad')->name('container.out.register.list.dashborad');  
      // GateCFSAuthorizeController
      Route::get('/gate-cfs-authorize-list','GateCFSAuthorizeController@index')->name('gate.cfs.authorize.list');  
      Route::get('/gate-cfs-authorize-list-dashborad','GateCFSAuthorizeController@dashborad')->name('gate.cfs.authorize.list.dashborad');  
      Route::get('/gate-cfs-authorize-show/{id}','GateCFSAuthorizeController@show')->name('gate.cfs.authorize.show');
      Route::post('/gate-cfs-authorize-submit','GateCFSAuthorizeController@store')->name('gate.cfs.authorize.submit');  

       // CFSOutProceedController
       Route::get('/cfs-out-proceed-list','CFSOutProceedController@index')->name('cfs.out.proceed.list');  
       Route::get('/cfs-out-proceed-list-cfsout','CFSOutProceedController@index')->name('cfs.out.proceed.list.cfsout'); 
       Route::get('/cfs-out-proceed-list-dashboard','CFSOutProceedController@dashboard')->name('cfs.out.proceed.list.dashboard');  
       Route::get('/cfs-out-proceed-show/{id}','CFSOutProceedController@show')->name('cfs.out.proceed.show');
       Route::get('/cfs-out-proceed-print/{id}','CFSOutProceedController@print')->name('cfs.out.proceed.print');
       Route::post('/cfs-out-proceed-submit','CFSOutProceedController@store')->name('cfs.out.proceed.submit'); 
       
        // WeighBridgeEntryOutController
        Route::get('/weigh-bridge-entry-out-list','WeighBridgeEntryOutController@index')->name('weigh.bridge.entry.out.list');  
        Route::get('/weigh-bridge-entry-out-list-dashboard','WeighBridgeEntryOutController@dashboard')->name('weigh.bridge.entry.out.list.dashboard');  
        Route::get('/weigh-bridge-entry-out-show/{id}','WeighBridgeEntryOutController@show')->name('weigh.bridge.entry.out.show');
        Route::post('/weigh-bridge-entry-out-submit','WeighBridgeEntryOutController@store')->name('weigh.bridge.entry.out.submit');  
        Route::get('/weigh-bridge-entry-out-print/{id}','WeighBridgeEntryOutController@print')->name('weigh.bridge.entry.out.print');
        //ContainerWeighbridgeOutController
        Route::get('/container-weigh-bridge-out-list','ContainerWeighbridgeOutController@index')->name('container.weigh.bridge.out.list');  
        Route::get('/container-weigh-bridge-out-list-dashboard','ContainerWeighbridgeOutController@dashboard')->name('container.weigh.bridge.out.list.dashboard');  
        Route::get('/container-weigh-bridge-out-show/{id}','ContainerWeighbridgeOutController@show')->name('container.weigh.bridge.out.show');
        Route::get('/container-weigh-bridge-out-print/{id}','ContainerWeighbridgeOutController@print')->name('container.weigh.bridge.out.print');
        Route::post('/container-weigh-bridge-out-submit','ContainerWeighbridgeOutController@store')->name('container.weigh.bridge.out.submit'); 
        
         //ProceedContainerOutController
         Route::get('/proceed-container-out-list','ProceedContainerOutController@index')->name('proceed.container.out.list');  
         Route::get('/proceed-container-out-list-dashborad','ProceedContainerOutController@dashborad')->name('proceed.container.out.list.dashborad');  
         Route::get('/proceed-container-out-show/{id}','ProceedContainerOutController@show')->name('proceed.container.out.show');
         Route::post('/proceed-container-out-submit','ProceedContainerOutController@store')->name('proceed.container.out.submit');  
        
         //ApproveContainerOutController
          Route::get('/approve-container-out-list','ApproveContainerOutController@index')->name('approve.container.out.list');
          Route::get('/approve-container-out-list-dashboard','ApproveContainerOutController@dashboard')->name('approve.container.out.list.dashboard');    
          Route::get('/approve-container-out-show/{id}','ApproveContainerOutController@show')->name('approve.container.out.show');
          Route::post('/approve-container-out-submit','ApproveContainerOutController@store')->name('approve.container.out.submit');  
         
           //PrintOutPassController
           Route::get('/print-out-pass-list','PrintOutPassController@index')->name('print.out.pass.list');  
           Route::get('/print-out-pass-show/{id}','PrintOutPassController@show')->name('print.out.pass.show');
           Route::post('/print-out-pass-submit','PrintOutPassController@store')->name('print.out.pass.submit');  
           Route::get('/print-out-pass/{id}','PrintOutPassController@print')->name('print.out.pass');  

           //ApproveContainerOutController
          Route::get('/search-token-list','SearchTokenController@index')->name('search.token.list');
          Route::get('/search-token-list-dashboard','SearchTokenController@dashboard')->name('search.token.list.dashboard');    
          Route::get('/search-token-show/{id}','SearchTokenController@show')->name('search.token.show');
          Route::post('/search-token-submit','SearchTokenController@store')->name('search.token.submit');  
           
          //Notifications Controller   
          Route::post('/update-notification','NotificationsController@updateNotification')->name('notification.update');  
         

        //ApproveContainerOutController
         Route::get('/cfs-daily-material-in-out-master','ReportsController@index')->name('cfs.daily.material.in.out.master');
         Route::post('/cfs-daily-material-in-out-download','ReportsController@download')->name('cfs.daily.material.in.out.download');
         Route::get('/customer/report','ReportsController@customerReport')->name('customer.report');
         Route::post('/customer/report/download','ReportsController@customerdownload')->name('customer.report.download');
         Route::get('/report/transport','TransportReportController@index')->name('transport.report');
         Route::post('/transport/report/download','TransportReportController@download')->name('transport.report.download');
         //Route::get('/report/transport/download','TransportReportController@download')->name('transport.report.download');
         Route::get('/commodity/report','CommodityReportController@index')->name('commodity.report');
         Route::post('/commodity/report/download','CommodityReportController@download')->name('commodity.report.download');
         Route::get('/datewise/report','DatewiseReportController@index')->name('datewise.report');
         Route::post('/datewise/report/download','DatewiseReportController@download')->name('datewise.report.download');
         Route::get('/token/report','TokenWiseReportsController@index')->name('token.report');
         Route::post('/token/report/download','TokenWiseReportsController@download')->name('token.report.download');

        //AdminUpdate
        Route::get('/update-entry','AdminUpdateController@entryIndex')->name('update.entry')->middleware('role:admin');
        Route::get('/update-entry-list','AdminUpdateController@proceedEntryList')->name('update.entry.list')->middleware('role:admin');
        Route::get('/update-entry-show/{id}','AdminUpdateController@proceedEntryShow')->name('update.entry.show')->middleware('role:admin');
        Route::post('/update-entry-submit','AdminUpdateController@store')->name('update.entry.submit')->middleware('role:admin');
         

        //Log
        Route::get('/user-log-list','UserLogController@index')->name('user.log')->middleware('role:admin');
        Route::get('/user-log-delete/{id}','UserLogController@destroy')->name('user.log.distroy')->middleware('role:admin');

        });





