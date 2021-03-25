<nav class="pcoded-navbar">
   <div class="nav-list">
      <div class="pcoded-inner-navbar main-menu">
         <div class="pcoded-navigation-label">Navigation</div>
         <ul class="pcoded-item pcoded-left-item">
            <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
               <a href="{{route('dashborad')}}" class="waves-effect waves-dark">
               <span class="pcoded-micon">
               <i class="feather icon-home"></i>
               </span>
               <span class="pcoded-mtext">Dashboard</span>
               </a>
            </li>
            @php
               $user = Auth::user();
               $user_type = explode(',',$user->user_type); 
               
            @endphp
            @if(in_array("admin", $user_type))
            <!-- active pcoded-trigger -->
               <li class="pcoded-hasmenu {{ request()->is('agent*') || request()->is('customer*') || request()->is('commodities*') || request()->is('transport*') || request()->is('material*') || request()->is('cargo*') || request()->is('consignments*') || request()->is('shipment*') || request()->is('uom*') || request()->is('location*') || request()->is('area*') || request()->is('bin*') ? 'active pcoded-trigger' : '' }}">
                  <a href="#" class="waves-effect waves-dark">
                  <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                  <span class="pcoded-hasmenu">Masters</span>
                  </a>
                  <ul class="pcoded-submenu">
                     <li class="{{ request()->is('agent*') ? 'active' : '' }}">
                        <a href="{{route('agent.index')}}" class="waves-effect waves-dark">
                        <span class="pcoded-mtext">Agent</span>
                        </a>
                     </li>
                     <li class="{{ request()->is('customer*') ? 'active' : '' }}">
                        <a href="{{route('customer.index')}}" class="waves-effect waves-dark">
                        <span class="pcoded-mtext">Customers</span>
                        </a>
                     </li>
                     <li class="{{ request()->is('commodities*') ? 'active' : '' }}">
                        <a href="{{route('commodities.index')}}" class="waves-effect waves-dark">
                        <span class="pcoded-mtext">Commodity</span>
                        </a>
                     </li>
                     <li class="{{ request()->is('uom*') ? 'active' : '' }}">
                        <a href="{{route('uom.index')}}" class="waves-effect waves-dark">
                        <span class="pcoded-mtext">UOM</span>
                        </a>
                     </li>
                     <li class="{{ request()->is('material*') ? 'active' : '' }}">
                        <a href="{{ route('material.index')}}" class="waves-effect waves-dark">
                        <span class="pcoded-mtext">Material</span>
                        </a>
                     </li>
                     <li class="{{ request()->is('transport*') ? 'active' : '' }}">
                        <a href="{{route('transport.index')}}" class="waves-effect waves-dark">
                        <span class="pcoded-mtext">Transport</span>
                        </a>
                     </li>
                     
                     <li class="{{ request()->is('cargo*') ? 'active' : '' }}">
                        <a href="{{route('cargo.index')}}" class="waves-effect waves-dark">
                        <span class="pcoded-mtext">Type of Cargo</span>
                        </a>
                     </li>
                     <li class="{{ request()->is('consignments*') ? 'active' : '' }}">
                        <a href="{{ route('consignments.index')}}" class="waves-effect waves-dark">
                        <span class="pcoded-mtext">Type of Consignment</span>
                        </a>
                     </li>
                     <li class="{{ request()->is('shipment*') ? 'active' : '' }}">
                        <a href="{{route('shipment.index')}}" class="waves-effect waves-dark">
                        <span class="pcoded-mtext">Shipment</span>
                        </a>
                     </li>
                   
                     <li class="{{ request()->is('location*') ? 'active' : '' }}">
                        <a href="{{route('location.index')}}" class="waves-effect waves-dark">
                        <span class="pcoded-mtext">Location</span>
                        </a>
                     </li>
                     <li class="{{ request()->is('area*') ? 'active' : '' }}">
                        <a href="{{route('area.index')}}" class="waves-effect waves-dark">
                        <span class="pcoded-mtext">Area</span>
                        </a>
                     </li>
                     <li class="{{ request()->is('bin*') ? 'active' : '' }}">
                        <a href="{{route('bin.index')}}" class="waves-effect waves-dark">
                        <span class="pcoded-mtext">Yard</span>
                        </a>
                     </li>
                  </ul>
               </li>
               <li class="pcoded-hasmenu {{ request()->is('user*') ? 'active pcoded-trigger' : '' }}">
                  <a href="javascript:void(0)" class="waves-effect waves-dark">
                  <span class="pcoded-micon"><i class="feather icon-sidebar"></i></span>
                  <span class="pcoded-mtext">Users</span>
                  </a>
                  <ul class="pcoded-submenu">
                     <li class="{{ request()->is('user-list') ? 'active' : '' }}">
                        <a href="{{ route('user.index')}}" class="waves-effect waves-dark">
                        <span class="pcoded-mtext">User List</span>
                        </a>
                     </li>
                     <li class="{{ request()->is('user-add') ? 'active' : '' }}">
                        <a href="{{ route('user.create')}}" class="waves-effect waves-dark">
                        <span class="pcoded-mtext">Add Users</span>
                        </a>
                     </li>
                     <li class="{{ request()->is('user-log') ? 'active' : '' }}">
                        <a href="{{ route('user.log')}}" class="waves-effect waves-dark">
                        <span class="pcoded-mtext">Users Log</span>
                        </a>
                     </li>
                  </ul>
               </li>
            @endif
            <div class="pcoded-navigation-label">User Roles</div>
            @if(in_array("admin", $user_type) || in_array("documentation_officer", $user_type))
            <li class="pcoded-hasmenu {{ request()->is('manifesto-list') || request()->is('manifesto-add') ? 'active pcoded-trigger' : '' }}">
               <a href="javascript:void(0)" class="waves-effect waves-dark">
               <span class="pcoded-micon">
               <i class="feather icon-layers"></i>
               </span>
               <span class="pcoded-mtext">Document Officer</span>
               </a>
               <ul class="pcoded-submenu">
                  <li class="{{ request()->is('manifesto-list') || request()->is('manifesto-add') ? 'active' : '' }}">
                     <a href="{{ route('manifesto.index')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Manifesto Entry</span>
                     </a>
                  </li>
               </ul>
            </li>
            @endif
            @if(in_array("admin", $user_type) || in_array("finance_officer", $user_type))
            <li class="pcoded-hasmenu {{ request()->is('manifesto-list-finance-officer') || request()->is('manifesto-show-finance-officer*') ? 'active pcoded-trigger' : '' }}">
               <a href="javascript:void(0)" class="waves-effect waves-dark">
               <span class="pcoded-micon">
               <i class="feather icon-layers"></i>
               </span>
               <span class="pcoded-mtext">Finance Officer</span>
               </a>
               <ul class="pcoded-submenu">
                  <li class="{{ request()->is('manifesto-list-finance-officer') || request()->is('manifesto-show-finance-officer*') ? 'active pcoded-trigger' : '' }}">
                     <a href="{{route('finance.officer.manifesto.index')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Approve Manifesto Entry</span>
                     </a>
                  </li>
                  <li class="">
                     <a href="{{route('release.approval.list')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Container release approval</span>
                     </a>
                  </li>
               </ul>
            </li>
            @endif
            @if(in_array("admin", $user_type) || in_array("gate1_entry_officer", $user_type))
            <li class="pcoded-hasmenu {{ request()->is('vehilce*') || request()->is('container-out-register-list') || request()->is('proceed-vehilce') || request()->is('cfs-out-proceed-list') || request()->is('cfs-out-proceed-list-cfsout') || request()->is('loading-entry-list') || request()->is('unloading-entry-list') || request()->is('loading-gate-entry-proceed-list') || request()->is('unloading-gate-entry-proceed-list') ? 'active pcoded-trigger' : '' }}">
               <a href="javascript:void(0)" class="waves-effect waves-dark">
               <span class="pcoded-micon">
               <i class="feather icon-layers"></i>
               </span>
               <span class="pcoded-mtext">Gate 1 Entry Officer</span>
               </a>
               <ul class="pcoded-submenu">
                  <li class="{{ request()->is('vehilce*') ? 'active' : '' }}">
                     <a href="{{route('vehilce.in.register.index')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Vehicle In Register</span>
                     </a>
                  </li>
                  <li class="{{ request()->is('proceed-vehilce') ? 'active' : '' }}">
                     <a href="{{ route('proceed.vehilce')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Proceed Vehicle</span>
                     </a>
                  </li>
                  <li class="{{ request()->is('container-out-register-list') ? 'active' : '' }}">
                     <a href="{{route('container.out.register.list')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Container Out Register</span>
                     </a>
                  </li>
                  <li class="{{ request()->is('cfs-out-proceed-list-cfsout') ? 'active' : '' }}">
                     <a href="{{route('cfs.out.proceed.list.cfsout')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Proceed Container Out</span>
                     </a>
                  </li>
                  <li class="{{ request()->is('cfs-out-proceed-list') ? 'active' : '' }}">
                     <a href="{{route('cfs.out.proceed.list')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">CFS OUT</span>
                     </a>
                  </li>


                  <!-- <ul class="pcoded-submenu" style="display: block;"> -->
                  <li class="pcoded-hasmenu pcoded-trigger" dropdown-icon="style1" subitem-icon="style1">
                  <a href="javascript:void(0)" class="waves-effect waves-dark">
                     <span class="pcoded-micon">
                     
                  </span>
                  <span class="pcoded-mtext">Loading</span>
                  </a>
                  <ul class="pcoded-submenu" style="display: block;">
                  <li class="{{ request()->is('loading-entry-list') ? 'active' : '' }}">
                  <a href="{{route('loading.entry.index')}}" class="waves-effect waves-dark">
                  <span class="pcoded-mtext">Vehicle Registration</span>
                  </a>
                  </li>
                  <li class="{{ request()->is('loading-gate-entry-proceed-list') ? 'active' : '' }}">
                  <a href="{{route('loading.gate.entry.proceed.index')}}" class="waves-effect waves-dark">
                  <span class="pcoded-mtext">Vehicle Allow Inside</span>
                  </a>
                  </li>

                  </ul>
                  </li>

                  <li class="pcoded-hasmenu" dropdown-icon="style1" subitem-icon="style1">
                  <a href="javascript:void(0)" class="waves-effect waves-dark">
                     <span class="pcoded-micon">
                     
                  </span>
                  <span class="pcoded-mtext">Unloading</span>
                  </a>
                  <ul class="pcoded-submenu">
                  <li class="{{ request()->is('unloading-entry-list') ? 'active' : '' }}">
                  <a href="{{route('unloading.entry.index')}}" class="waves-effect waves-dark">
                  <span class="pcoded-mtext">Vehicle Entry Form</span>
                  </a>
                  </li>
                  <li class="{{ request()->is('unloading-gate-entry-proceed-list') ? 'active' : '' }}">
                  <a href="{{route('unloading.gate.entry.proceed.index')}}" class="waves-effect waves-dark">
                  <span class="pcoded-mtext">Vehicle Allow Inside</span>
                  </a>
                  </li>

                  </ul>
                  </li>

<!-- </ul> -->


               </ul>
            </li>
            @endif
            
            @if(in_array("admin", $user_type) || in_array("cfs_gate_officer", $user_type))
            <li class="pcoded-hasmenu {{ request()->is('authorize-vehicle-in') || request()->is('cfs-gate-out') || request()->is('gate-pass-list') || request()->is('gate-cfs-authorize-list') || request()->is('proceed-container-out-list') || request()->is('print-out-pass-list')  ? 'active pcoded-trigger' : '' }}">
               <a href="javascript:void(0)" class="waves-effect waves-dark">
               <span class="pcoded-micon">
               <i class="feather icon-layers"></i>
               </span>
               <span class="pcoded-mtext">CFS Gate Officer</span>
               </a>
               <ul class="pcoded-submenu">
                  <li class="{{ request()->is('authorize-vehicle-in') ? 'active' : '' }}">
                     <a href="{{route('authorize.vehicle.in.index')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Authorize Vehicle In</span>
                     </a>
                  </li>
                  <li class="{{ request()->is('cfs-gate-out') ? 'active' : '' }}">
                     <a href="{{route('cfs.gate.out')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Authorize Vehicle return</span>
                     </a>
                  </li>
                  <li class="{{ request()->is('gate-pass-list') ? 'active' : '' }}">
                     <a href="{{route('gate.pass.list')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Print gatepass</span>
                     </a>
                  </li>
                  <li class="{{ request()->is('gate-cfs-authorize-list') ? 'active' : '' }}">
                     <a href="{{ route('gate.cfs.authorize.list')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Authorize Container Out</span>
                     </a>
                  </li>
                  <li class="{{ request()->is('proceed-container-out-list') ? 'active' : '' }}">
                     <a href="{{route('proceed.container.out.list')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Proceed Container Out</span>
                     </a>
                  </li>
                  <li class="{{ request()->is('print-out-pass-list') ? 'active' : '' }}">
                     <a href="{{route('print.out.pass.list')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">CFS Print Outpass</span>
                     </a>
                  </li>
               </ul>
            </li>
            @endif
            @if(in_array("admin", $user_type) || in_array("weigh_bridge_officer", $user_type))
            
            <li class="pcoded-hasmenu {{ request()->is('weigh-bridge*') || request()->is('container-weigh-bridge-out-list') || request()->is('loading-weigh-bridge-entry-list') || request()->is('unloading-weigh-bridge-entry-list') || request()->is('loading-gate-entry-return-list') || request()->is('unloading-gate-entry-return-list') ? 'active pcoded-trigger' : '' }}">
               <a href="javascript:void(0)" class="waves-effect waves-dark">
               <span class="pcoded-micon">
               <i class="feather icon-layers"></i>
               </span>
               <span class="pcoded-mtext"> CFS Weigh Bridge</span>
               </a>
               <ul class="pcoded-submenu">
                  <li class="{{ request()->is('weigh-bridge-entry')  ? 'active' : '' }}">
                     <a href="{{route('weigh.bridge.entry')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Weigh Bridge Entry</span>
                     </a>
                  </li>
                  <li class="{{ request()->is('weigh-bridge-exit')  ? 'active' : '' }}">
                     <a href="{{route('weigh.bridge.exit')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Weigh Bridge Exit</span>
                     </a>
                  </li>
                  <li class="{{ request()->is('weigh-bridge-entry-out-list')  ? 'active' : '' }}">
                     <a href="{{route('weigh.bridge.entry.out.list')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">CFS Out Weighbridge Entry</span>
                     </a>
                  </li>
                  <li class="{{ request()->is('container-weigh-bridge-out-list')  ? 'active' : '' }}">
                     <a href="{{route('container.weigh.bridge.out.list')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">CFS Out Weighbridge Exit</span>
                     </a>
                  </li>


                  <!-- <ul class="pcoded-submenu" style="display: block;"> -->
                  <li class="pcoded-hasmenu {{ request()->is('loading-weigh-bridge-entry-list') || request()->is('unloading-weigh-bridge-entry-list') || request()->is('loading-gate-entry-return-list') || request()->is('unloading-gate-entry-return-list') ? 'active pcoded-trigger' : '' }}" dropdown-icon="style1" subitem-icon="style1">
                  <a href="javascript:void(0)" class="waves-effect waves-dark">
                     <span class="pcoded-micon">
                     
                  </span>
                  <span class="pcoded-mtext">Loading</span>
                  </a>
                  <ul class="pcoded-submenu" style="display: none;">
                  <li class="{{ request()->is('loading-weigh-bridge-entry-list')  ? 'active' : '' }}">
                  <a href="{{route('loading.weigh.bridge.entry.index')}}" class="waves-effect waves-dark">
                  <span class="pcoded-mtext">Registered Vehicle</span>
                  </a>
                  </li>
                  <li class="{{ request()->is('loading-gate-entry-return-list')  ? 'active' : '' }}">
                  <a href="{{route('loading.gate.entry.return.index')}}" class="waves-effect waves-dark">
                  <span class="pcoded-mtext">Vehicle Return After Loading</span>
                  </a>
                  </li>

                  </ul>
                  </li>

                  <li class="pcoded-hasmenu" dropdown-icon="style1" subitem-icon="style1">
                  <a href="javascript:void(0)" class="waves-effect waves-dark">
                     <span class="pcoded-micon">
                     
                  </span>
                  <span class="pcoded-mtext">Unloading</span>
                  </a>
                  <ul class="pcoded-submenu">
                  <li class="{{ request()->is('unloading-weigh-bridge-entry-list')  ? 'active' : '' }}">
                  <a href="{{route('unloading.weigh.bridge.entry.index')}}" class="waves-effect waves-dark">
                  <span class="pcoded-mtext">Registered Vehicle</span>
                  </a>
                  </li>
                  <li class="{{ request()->is('unloading-gate-entry-return-list')  ? 'active' : '' }}">
                  <a href="{{route('unloading.gate.entry.return.index')}}" class="waves-effect waves-dark">
                  <span class="pcoded-mtext">Vehicle Return After Unloading</span>
                  </a>
                  </li>

                  </ul>
                  </li>
                  <!-- </ul> -->


               </ul>
            </li>
            @endif 
            @if(in_array("admin", $user_type) || in_array("field_supervisor", $user_type))
            <li class="pcoded-hasmenu {{ request()->is('supervisor-doc-upload-entry') || request()->is('container-stuffing-list') || request()->is('container-stuffing-update-list') ? 'active pcoded-trigger' : '' }}">
               <a href="javascript:void(0)" class="waves-effect waves-dark">
               <span class="pcoded-micon">
               <i class="feather icon-layers"></i>
               </span>
               <span class="pcoded-mtext">Field Supervisor</span>
               </a>
               <ul class="pcoded-submenu">
                  <li class="{{ request()->is('supervisor-doc-upload-entry') ? 'active' : '' }}">
                     <a href="{{route('supervisor.doc.upload.entry')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Document Upload</span>
                     </a>
                  </li>
                  <li class="{{ request()->is('container-stuffing-list') ? 'active' : '' }}">
                     <a href="{{route('container.stuffing.list')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Container stuffing entry</span>
                     </a>
                  </li>
                  <li class="{{ request()->is('container-stuffing-update-list') ? 'active' : '' }}">
                     <a href="{{route('container.stuffing.update.list')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Container stuffing update</span>
                     </a>
                  </li>
               </ul>
            </li>
            @endif
            
            @if(in_array("admin", $user_type) || in_array("sfs_operation_manager", $user_type))
            <li class="pcoded-hasmenu {{ request()->is('operation-manager-entry') || request()->is('stuffing-approval-list') || request()->is('approve-container-out-list') ? 'active pcoded-trigger' : '' }}">
               <a href="javascript:void(0)" class="waves-effect waves-dark">
               <span class="pcoded-micon">
               <i class="feather icon-layers"></i>
               </span>
               <span class="pcoded-mtext">Operation Manager</span>
               </a>
               <ul class="pcoded-submenu">
                  <li class="{{ request()->is('operation-manager-entry') ? 'active' : '' }}">
                     <a href="{{route('operation.manager.entry')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Approve Vehicle return</span>
                     </a>
                  </li>
                  <li class="{{ request()->is('stuffing-approval-list') ? 'active' : '' }}">
                     <a href="{{route('stuffing.approval.list')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Container stuffing approval</span>
                     </a>
                  </li>
                  <li class="{{ request()->is('approve-container-out-list') ? 'active' : '' }}">
                     <a href="{{ route('approve.container.out.list')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Approve Container out</span>
                     </a>
                  </li>
               </ul>
            </li>
            @endif
            
            @if(in_array("admin", $user_type) || in_array("finance_controller", $user_type))
            <li class="pcoded-hasmenu {{ request()->is('release-final-approval-list') || request()->is('search-token-list') ? 'active pcoded-trigger' : '' }}">
               <a href="javascript:void(0)" class="waves-effect waves-dark">
               <span class="pcoded-micon">
               <i class="feather icon-layers"></i>
               </span>
               <span class="pcoded-mtext">Finance Controller</span>
               </a>
               <ul class="pcoded-submenu">
                  <li class="{{ request()->is('release-final-approval-list') ? 'active' : '' }}">
                     <a href="{{route('release.final.approval.list')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Container release approval</span>
                     </a>
                  </li>
                  <li class="{{ request()->is('search-token-list') ? 'active' : '' }}">
                     <a href="{{route('search.token.list')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Search / Expire Token</span>
                     </a>
                  </li>
               </ul>
            </li>
            @endif
            @if(in_array("admin", $user_type) || in_array("authorization_officer", $user_type))
            <li class="pcoded-hasmenu {{ request()->is('loading-weigh-bridge-entry-update-list') || request()->is('unloading-weigh-bridge-entry-update-list') || request()->is('loading-gate-entry-return-update-list') || request()->is('unloading-gate-entry-return-update-list')? 'active pcoded-trigger' : '' }}" dropdown-icon="style1" subitem-icon="style1">
               <a href="javascript:void(0)" class="waves-effect waves-dark">
               <span class="pcoded-micon">
               <i class="feather icon-layers"></i>
               </span>
               <span class="pcoded-mtext">Authorization Officer</span>
               </a>
               <ul class="pcoded-submenu">
                  <li class="pcoded-hasmenu" dropdown-icon="style1" subitem-icon="style1">
                     <a href="javascript:void(0)" class="waves-effect waves-dark">
                     <span class="pcoded-micon">
                     </span>
                     <span class="pcoded-mtext">Loading</span>
                     </a>
                     <ul class="pcoded-submenu">
                        <li class="{{ request()->is('loading-weigh-bridge-entry-update-list') ? 'active' : '' }}">
                           <a href="{{route('loading.weigh.bridge.entry.update.index')}}" class="waves-effect waves-dark">
                           <span class="pcoded-mtext">Weigh Bridge Entry Updates</span>
                           </a>
                        </li>
                        <li class="{{ request()->is('loading-gate-entry-return-update-list') ? 'active' : '' }}">
                           <a href="{{route('loading.gate.entry.return.update.index')}}" class="waves-effect waves-dark">
                           <span class="pcoded-mtext">Weigh Bridge Entry Updates After Return</span>
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li class="pcoded-hasmenu" dropdown-icon="style1" subitem-icon="style1">
                     <a href="javascript:void(0)" class="waves-effect waves-dark">
                     <span class="pcoded-micon">
                     </span>
                     <span class="pcoded-mtext">Unloading</span>
                     </a>
                     <ul class="pcoded-submenu">
                        <li class="{{ request()->is('unloading-weigh-bridge-entry-update-list') ? 'active' : '' }}">
                           <a href="{{route('unloading.weigh.bridge.entry.update.index')}}" class="waves-effect waves-dark">
                           <span class="pcoded-mtext">Weigh Bridge Entry Updates</span>
                           </a>
                        </li>
                        <li class="{{ request()->is('unloading-gate-entry-return-update-list') ? 'active' : '' }}">
                           <a href="{{route('unloading.gate.entry.return.update.index')}}" class="waves-effect waves-dark">
                           <span class="pcoded-mtext">Weigh Bridge Entry Updates After Return</span>
                           </a>
                        </li>
                     </ul>
                  </li>
               </ul>
            </li>
            @endif
            @if(in_array("admin", $user_type) || in_array("authorization_manager", $user_type))
            <li class="pcoded-hasmenu {{ request()->is('loading-gate-entry-approval-list') || request()->is('unloading-gate-entry-approval-list')  ? 'active pcoded-trigger' : '' }}" dropdown-icon="style1" subitem-icon="style1">
               <a href="javascript:void(0)" class="waves-effect waves-dark">
               <span class="pcoded-micon">
               <i class="feather icon-layers"></i>
               </span>
               <span class="pcoded-mtext">Authorization Manager</span>
               </a>
               <ul class="pcoded-submenu">
                  <li class="pcoded-hasmenu" dropdown-icon="style1" subitem-icon="style1">
                     <a href="javascript:void(0)" class="waves-effect waves-dark">
                     <span class="pcoded-micon">
                     </span>
                     <span class="pcoded-mtext">Loading</span>
                     </a>
                     <ul class="pcoded-submenu">
                        <li class="{{ request()->is('loading-gate-entry-approval-list') ? 'active' : '' }}">
                           <a href="{{route('loading.gate.entry.approval.index')}}" class="waves-effect waves-dark">
                           <span class="pcoded-mtext">Weigh Bridge Entry Updates</span>
                           </a>
                        </li>
                        <li class="{{ request()->is('loading-weigh-bridge-return-update-list') ? 'active' : '' }}">
                           <a href="{{route('loading.weigh.bridge.return.update.index')}}" class="waves-effect waves-dark">
                           <span class="pcoded-mtext">Weigh Bridge Entry Updates After Return</span>
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li class="pcoded-hasmenu" dropdown-icon="style1" subitem-icon="style1">
                     <a href="javascript:void(0)" class="waves-effect waves-dark">
                     <span class="pcoded-micon">
                     </span>
                     <span class="pcoded-mtext">Unloading</span>
                     </a>
                     <ul class="pcoded-submenu {{ request()->is('unloading-gate-entry-approval-list') ? 'active' : '' }}">
                        <li class="{{ request()->is('unloading-gate-entry-approval-list') ? 'active' : '' }}">
                           <a href="{{route('unloading.gate.entry.approval.index')}}" class="waves-effect waves-dark">
                           <span class="pcoded-mtext">Weigh Bridge Entry Updates</span>
                           </a>
                        </li>
                        <li class="{{ request()->is('unloading-weigh-bridge-return-update-list') ? 'active' : '' }}">
                           <a href="{{route('unloading.weigh.bridge.return.update.index')}}" class="waves-effect waves-dark">
                           <span class="pcoded-mtext">Weigh Bridge Entry Updates After Return</span>
                           </a>
                        </li>
                     </ul>
                  </li>
               </ul>
            </li>
            @endif
            @if(in_array("admin", $user_type))
            <li class="pcoded-hasmenu {{ request()->is('update-entry')  ? 'active pcoded-trigger' : '' }}">
               <a href="javascript:void(0)" class="waves-effect waves-dark">
               <span class="pcoded-micon">
               <i class="feather icon-layers"></i>
               </span>
               <span class="pcoded-mtext">Admin Update</span>
               </a>
               <ul class="pcoded-submenu">
                  <li class="{{ request()->is('update-entry') ? 'active' : '' }}">
                     <a href="{{ route('update.entry')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Update Entry</span>
                     </a>
                  </li>
               </ul>
            </li>
            @endif
         </ul>
         @if(in_array("admin", $user_type))
         <div class="pcoded-navigation-label">All Reports</div>
         <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
               <a href="javascript:void(0)" class="waves-effect waves-dark">
               <span class="pcoded-micon">
               <i class="feather icon-clipboard"></i>
               </span>
               <span class="pcoded-mtext">Reports</span>
               </a>
               <ul class="pcoded-submenu">
                  <li class="">
                     <a href="{{route('cfs.daily.material.in.out.master')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">CFS Daily Material In Out Master</span>
                     </a>
                  </li>
                  <li class="">
                     <a href="{{route('customer.report')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Customer Report</span>
                     </a>
                  </li>
                  <li class="">
                     <a href="{{route('transport.report')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Transport wise</span>
                     </a>
                  </li>
                  <li class="">
                     <a href="{{route('commodity.report')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Commodity wise</span>
                     </a>
                  </li>
                  <li class="">
                     <a href="{{route('token.report')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Token / Ticket No wise</span>
                     </a>
                  </li>
                  <li class="">
                     <a href="{{route('datewise.report')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Period wise</span>
                     </a>
                  </li>
               </ul>
            </li>
         </ul>

         <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
               <a href="javascript:void(0)" class="waves-effect waves-dark">
               <span class="pcoded-micon">
               <i class="feather icon-clipboard"></i>
               </span>
               <span class="pcoded-mtext">LU Reports</span>
               </a>
               <ul class="pcoded-submenu">
                  <li class="">
                     <a href="{{route('loading.customer.report')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Customer Wise</span>
                     </a>
                  </li>
                  <li class="">
                     <a href="{{route('loading.transport.report')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Transporter Wise</span>
                     </a>
                  </li>
                  <li class="">
                     <a href="{{route('loading.commodity.report')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Commodity Wise</span>
                     </a>
                  </li>
                  <li class="">
                     <a href="{{route('loading.token.report')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Token / Ticket No Wise</span>
                     </a>
                  </li>
                  <li class="">
                     <a href="{{route('loading.period.report')}}" class="waves-effect waves-dark">
                     <span class="pcoded-mtext">Period Wise</span>
                     </a>
                  </li>
               </ul>
            </li>
         </ul>
         @endif
      </div>
   </div>
</nav>