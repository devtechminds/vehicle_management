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
<li class="breadcrumb-item"><a href="#!">User Create</a></li>
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
                        <form action="{{route('user.store')}}" id="myform" method="post">
                        @csrf
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Name</label>
                              <div class="col-sm-4">
                                 <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Enter Name">
                              </div>
                              <label class="col-sm-2 col-form-label">Email </label>
                              <div class="col-sm-4">
                                 <input type="text" name="email" value="{{old('email')}}" class="form-control" placeholder="Enter Email">
                              </div>
                              
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">User Name</label>
                              <div class="col-sm-4">
                                 <input type="text"  name="username" value="{{old('username')}}" class="form-control" placeholder="Enter User Name">
                              </div>
                              <label class="col-sm-2 col-form-label">Password</label>
                              <div class="col-sm-4">
                                 <input type="password" name="password" value="{{old('password')}}" class="form-control" placeholder="Enter Password">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Mobile Number</label>
                              <div class="col-sm-4">
                                 <input type="number" name="mobile_number" value="{{old('mobile_number')}}" class="form-control" placeholder="Enter Mobile Number">
                              </div>
                              <label class="col-sm-2 col-form-label">Designation</label>
                              <div class="col-sm-4">
                                 <input type="text" name="designation" value="{{old('designation')}}" class="form-control" placeholder="Enter Designation">
                              </div>
                           </div>
                           <div class="form-group row">
                           <label class="col-sm-2 col-form-label">User Role</label>
                              <div class="col-sm-4">
                              <select name="user_type[]" class="form-control boxbrd fill" multiple>
                              <option value=''>Select User Role</option>
                              <option value="documentation_officer" {{ old('user_type')=='documentation_officer'?'selected':'' }}>Documentation Officer</option>
                              <option value="finance_officer" {{ old('user_type')=='finance_officer'?'selected':'' }}>Finance Officer</option>
                              <option value="gate1_entry_officer" {{ old('user_type')=='gate1_entry_officer'?'selected':'' }}>Gate1 Entry Officer</option>
                              <option value="cfs_gate_officer" {{ old('user_type')=='cfs_gate_officer'?'selected':'' }}>CFS Gate Officer</option>
                              <option value="weigh_bridge_officer" {{ old('user_type')=='weigh_bridge_officer'?'selected':'' }}>Weigh Bridge Officer</option>
                              <option value="field_supervisor" {{ old('user_type')=='field_supervisor'?'selected':'' }}>Field Supervisor</option>
                              <option value="sfs_operation_manager" {{ old('user_type')=='sfs_operation_manager'?'selected':'' }}>Operation Manager</option>
                              <option value="finance_controller" {{ old('user_type')=='finance_controller'?'selected':'' }}>Finance Controller</option>
                              <option value="authorization_manager" {{ old('user_type')=='authorization_manager'?'selected':'' }}>Authorization Manager</option>
                              <option value="report_manager" {{ old('user_type')=='report_manager'?'selected':'' }}>Report Manager</option>
                              </select>
                              </div>

                              <label class="col-sm-2 col-form-label">Country </label>
                              <div class="col-sm-4">
                                 <input type="text" name="country"  value="{{old('country')}}" class="form-control" placeholder="Enter Country">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Place  </label>
                              <div class="col-sm-4">
                                 <input type="text"  name="place" value="{{ old('place')}}" class="form-control" placeholder="Enter Place">
                              </div>
                              <label class="col-sm-2 col-form-label">Address</label>
                              <div class="col-sm-4">
                                 <input type="text" name="address" value="{{old('address')}}" class="form-control" placeholder="Enter Address">
                              </div>
                           </div>
                           <div class="form-group row">
                             
                              <label class="col-sm-2 col-form-label">Pincode</label>
                              <div class="col-sm-4">
                                 <input type="number" name="pincode" value="{{old('pincode')}}" class="form-control" placeholder="Enter Pincode">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label class="col-sm-2 col-form-label">Status</label>
                              <div class="col-sm-4">
                              <select name="status" class="form-control boxbrd fill">
                              <option value=''>Select Status</option>
                              <option value="1" {{ old('status')=='1'?'selected':'' }}>Active</option>
                              <option value="0" {{ old('status')=='0'?'selected':'' }}>Inactive</option>
                              </select>
                              </div>
                           </div>
                           <div class="card">
                     <div class="card-block height">
                        <div class="row">
                           <div class="col-sm-12" style="text-align: center;">
                              <button class="btn btn-success waves-effect waves-light">Create</button>
                              <a  href="{{route('user.index')}}" class="btn btn-success waves-effect waves-light">Cancel</a>
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
<style>
 .error {
      color: red;
   }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.0/additional-methods.js"></script>
<script>

$(document).ready(function () {

$('#myform').validate({ // initialize the plugin
    rules: {
      name: {
            required: true,
            lettersonly: true
        },
        user_name: {
            required: true,
            lettersonly: true
        },
        password: {
            required: true,
            pwcheck:true
        },
        user_type: {
            required: true,
        },

        email: {
            required: true,
            email: true
        },
        username: {
            required: true,
            
        },
        mobile_number: {
            required: true,
            
        },
        status: {
            required: true,
            
        }
        
       
    },
    submitHandler: function (form) { // for demo
      $('#myform').submit();
    }
});

jQuery.validator.addMethod("lettersonly", function(value, element) {
return this.optional(element) || /^[a-z\s]+$/i.test(value);
}, "Enter vaild user name.");
});


jQuery.validator.addMethod("pwcheck",
        function(value, element, param) {
            if (this.optional(element)) {
                return true;
            } else if (!/[A-Z]/.test(value)) {
                return false;
            } else if (!/[a-z]/.test(value)) {
                return false;
            } else if (!/[0-9]/.test(value)) {
                return false;
            
            } else if (value.length<8) {
                return false;
            }

            return true;
        },
        "Password should have one uppercase and lowercase letter,length must be minimum 8 characters.");

</script>
@endsection