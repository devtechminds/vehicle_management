@extends('layouts.master')
@section('content')
<div class="page-header card">
<div class="row align-items-end">
<div class="col-lg-6">
<div class="page-header-title">
<i class="feather icon-clipboard bg-c-blue"></i>
<div class="d-inline">
<h2>Users</h2>

</div>
</div>
</div>
<div class="col-lg-6">
<div class="page-header-breadcrumb">
<ul class=" breadcrumb breadcrumb-title">
<li class="breadcrumb-item">
<a href="index.html"><i class="feather icon-home"></i></a>
</li>
<li class="breadcrumb-item"><a href="#!">Users</a></li>
<li class="breadcrumb-item"><a href="#!">User Show</a></li>
</ul>
</div>
</div>
</div>
</div>
<div class="pcoded-inner-content">
   <div class="main-body">
      <div class="page-wrapper">
         <div class="page-body">
         @if(count($errors) > 0 )
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <ul class="p-0 m-0" style="list-style: none;">
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif
            <div class="row">
               <div class="col-sm-12">
                  <div class="card">
                     <div class="card-block">
                        <form action="{{route('user.update')}}" id="myform" method="post">
                        @csrf
                        {{method_field('put')}}
                        <input type="hidden" name="id" value="{{$user->id}}">
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Name</label>
                              <div class="col-sm-4">
                                 <input type="text" readonly name="name" value="{{ $user->name?$user->name:old('name')}}" class="form-control" placeholder="Enter Name">
                              </div>
                              <label class="col-sm-2 col-form-label">Email </label>
                              <div class="col-sm-4">
                                 <input type="text" readonly name="email" value="{{ $user->email?$user->email:old('email')}}" class="form-control" placeholder="Enter Email">
                              </div>
                              
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">User Name</label>
                              <div class="col-sm-4">
                                 <input type="text" readonly name="username" value="{{ $user->username?$user->username:old('username')}}" class="form-control" placeholder="Enter User Name">
                              </div>
                              <label class="col-sm-2 col-form-label">Password</label>
                              <div class="col-sm-4">
                                 <input type="text" readonly name="password" value="{{ $user->show_password?base64_decode($user->show_password):''}}" class="form-control" placeholder="Enter Password">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Mobile Number</label>
                              <div class="col-sm-4">
                                 <input type="number" readonly name="mobile_number" value="{{ $user->mobile?$user->mobile:old('mobile_number')}}" class="form-control" placeholder="Enter Mobile Number">
                              </div>
                              <label class="col-sm-2 col-form-label">Designation</label>
                              <div class="col-sm-4">
                                 <input type="text" readonly name="designation" value="{{ $user->designation?$user->designation:old('designation')}}" class="form-control" placeholder="Enter Designation">
                              </div>
                           </div>
                           <div class="form-group row">
                           <label class="col-sm-2 col-form-label">User Role</label>
                              <div class="col-sm-4">
                              @php 
                              $type = (explode(",",$user->user_type));
                              @endphp 
                              <select name="user_type[]" class="form-control boxbrd fill" multiple disabled>
                              <option value=''>Select User Role</option>
                              <option value="documentation_officer" {{ in_array("documentation_officer", $type)?'selected':'' }}>Documentation Officer</option>
                              <option value="finance_officer" {{ in_array("finance_officer", $type)?'selected':'' }}>Finance Officer</option>
                              <option value="gate1_entry_officer" {{ in_array("gate1_entry_officer", $type)?'selected':'' }}>Gate1 Entry Officer</option>
                              <option value="cfs_gate_officer" {{  in_array("cfs_gate_officer", $type)?'selected':'' }}>CFS Gate Officer</option>
                              <option value="weigh_bridge_officer" {{ in_array("weigh_bridge_officer", $type)?'selected':'' }}>Weigh Bridge Officer</option>
                              <option value="field_supervisor" {{ in_array("field_supervisor", $type)?'selected':'' }}>Field Supervisor</option>
                              <option value="sfc_operation_manager" {{ in_array("sfc_operation_manager", $type)?'selected':'' }}>Operation Manager</option>
                              <option value="finance_controller" {{in_array("finance_controller", $type)?'selected':'' }}>Finance Controller</option>
                              </select>
                              </div>
                             

                              <label class="col-sm-2 col-form-label">Country </label>
                              <div class="col-sm-4">
                                 <input type="text" readonly name="country"  value="{{ $user->country?$user->country:old('country')}}" class="form-control" placeholder="Enter Country">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Place  </label>
                              <div class="col-sm-4">
                                 <input type="text" readonly name="place" value="{{ $user->place?$user->place:old('place')}}" class="form-control" placeholder="Enter Place">
                              </div>
                              <label class="col-sm-2 col-form-label">Address</label>
                              <div class="col-sm-4">
                                 <input type="text" readonly name="address" value="{{ $user->address?$user->address:old('address')}}" class="form-control" placeholder="Enter Address">
                              </div>
                           </div>
                           <div class="form-group row">
                             
                              <label class="col-sm-2 col-form-label">Pincode</label>
                              <div class="col-sm-4">
                                 <input type="number" readonly name="pincode" value="{{ $user->pincode?$user->pincode:old('pincode')}}" class="form-control" placeholder="Enter Pincode">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Status</label>
                              <div class="col-sm-4">
                              <select disabled name="status" class="form-control boxbrd fill">
                              <option value=''>Select Status</option>
                              <option value="1" {{ $user->is_active =='1'?'selected':'' }}>Active</option>
                              <option value="0" {{ $user->is_active =='0'?'selected':'' }}>Inactive</option>
                              </select>
                              </div>
                           </div>
                           <div class="card">
                     <div class="card-block height">
                        <div class="row">
                           <div class="col-sm-12" style="text-align: center;">
                              <a  href="{{route('user.index')}}" class="btn btn-success waves-effect waves-light">Back</a>
                           </div>
                        </div>
                     </div>
                  </div>
                        </form>
                     </div>
                  </div>
                 
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection